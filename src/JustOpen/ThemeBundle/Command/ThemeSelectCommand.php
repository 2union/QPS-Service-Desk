<?php
/**
 * Created by PhpStorm.
 * User: daniil
 * Date: 05.09.16
 * Time: 22:10
 */

namespace JustOpen\ThemeBundle\Command;

use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Helper\QuestionHelper;
use Symfony\Component\Console\Question\Question;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Yaml\Yaml;

/**
 * Class ThemeSelectCommand
 * @package JustOpen\ThemeBundle\Command
 */
class ThemeSelectCommand extends ContainerAwareCommand
{
    /** @var  OutputInterface */
    protected $output = [];
    /** @var  array */
    protected $availableThemes = [];

    protected function configure()
    {
        $this
            ->setName('qps:theme:select')
            ->addArgument('theme', InputArgument::OPTIONAL, 'Select theme to use?')
            ->setDescription('Select theme command');
    }

    protected function interact(InputInterface $input, OutputInterface $output)
    {
        $finder = new Finder();
        $finder->directories()->in($this->getContainer()->getParameter('theme_dir'))->depth(0);

        foreach ($finder as $dir) {

            $themeConfigFile = $dir->getRealPath().DIRECTORY_SEPARATOR.$dir->getFilename().'.'.'ini';

            if (file_exists($themeConfigFile)) {

                $themeConfig = parse_ini_file($themeConfigFile, true);
                if(isset($theme_config['name'])){
                    $this->availableThemes[$dir->getFilename()] = $themeConfig['name'];
                }

            }

        }

        $theme = $input->getArgument('theme');
        if (!$theme) {
            /** @type QuestionHelper $helper */
            $helper = $this->getHelper('question');

            $question = new Question("Select theme: " . implode(', ', array_keys($this->availableThemes)) . "\n");
            $question->setAutocompleterValues(array_keys($this->availableThemes));

            $theme = $helper->ask($input, $output, $question);

            /**
             * Select theme from input
             */
            if ($theme) {
                $input->setArgument('theme', $theme);
            }
        }
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $theme = $input->getArgument('theme');
        $s     = DIRECTORY_SEPARATOR;

        if (!in_array($theme, array_keys($this->availableThemes))) {
            $theme = 'default';
        }

        $this->output = $output;

        $parametersFile = $this->getContainer()->getParameter('kernel.root_dir') . $s . 'config' . $s . 'parameters.yml';
        $parameters = Yaml::parse(file_get_contents($parametersFile));
        $parameters['parameters']['current_theme'] = $theme;
        file_put_contents($parametersFile, Yaml::dump($parameters));

        $envs = ['dev', 'prod', 'cli'];
        foreach ($envs as $env) {
            $cacheDir = $this->getContainer()->getParameter('kernel.root_dir') . $s . '..' . $s . 'var' . $s . 'cache' . $s . $env;
            if (!is_dir($cacheDir)) {
                mkdir($cacheDir);
            }
            $cachedThemeFile = $cacheDir . $s . 'theme';
            file_put_contents($cachedThemeFile, $theme);
        }

        $themeConfig = parse_ini_file($this->getContainer()->getParameter('theme_dir').$s.$theme.$s.$theme.'.'.'ini');

        $this->runCommand('assets:install', ['--symlink']);

        if ( isset($themeConfig['css']['grunt']) )
            $this->runCommand('qps:theme:grunt', ['--ext', 'css']);

        if ( isset($themeConfig['css']['compiller']) )//less scss
            $this->runCommand('qps:theme:cstyle', ['--compiller', $themeConfig['css']['compiller']]);

        if ( isset($themeConfig['js']['grunt']) )
            $this->runCommand('qps:theme:grunt', ['--ext', 'js']);

        if ( isset($themeConfig['js']['bower']) )
            $this->runCommand('qps:theme:bower');

        //$this->runCommand('assetic:dump');

        $output->writeln($themeConfig['name']. ' was enabled!');
    }

    private function runCommand($command, $arguments = [])
    {
        //Prepare single args
        foreach ( $arguments AS $key => $value ) {
            if ( is_integer($key) ) {
                $arguments[$value] = $value;
                unset($arguments[$key]);
            }
        }

        $kernel = $this->getContainer()->get('kernel');
        $application = new Application($kernel);
        $application->setAutoExit(false);

        $input = new ArrayInput(array_merge(
            ['command' => $command],
            $arguments
        ));

        $application->run($input, $this->output);
    }
}
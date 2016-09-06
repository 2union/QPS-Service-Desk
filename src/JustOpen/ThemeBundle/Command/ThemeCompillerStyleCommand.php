<?php
/**
 * Created by PhpStorm.
 * User: daniil
 * Date: 06.09.16
 * Time: 11:43
 */

namespace JustOpen\ThemeBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class ThemeCompillerStyleCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('qps:theme:cstyle')
            ->addOption('compiller', null, InputOption::VALUE_NONE, 'Set compiller for css.(less or scss)')
            ->setDescription('Compile css command');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $compiller = $input->getOption('compiller');

        //TODO: move compillers to config
        if(in_array(mb_strtolower($compiller),['less','scss'])){

        }
    }
}
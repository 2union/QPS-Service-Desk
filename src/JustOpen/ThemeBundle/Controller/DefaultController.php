<?php

namespace JustOpen\ThemeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\File\Exception\FileNotFoundException;

class DefaultController extends Controller
{
    /** @var string */
    protected $s = DIRECTORY_SEPARATOR;

    /**
     * @param string $name
     * @param array $arguments
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function themeAction(string $name, array $arguments)
    {
        $localPath = $this->makeTruePath($name);

        $file = 0;

        $cache = $this->get('cache.app');

        $template = $cache->getItem('template.'.str_replace('/','_',$name));

        if (!$template->isHit()) {
            //Check template in app resources
            $appTemplate = $this->getParameter('kernel.root_dir') . $this->s . 'Resources' . $this->s . 'views' . $this->s
                . $localPath;

            if (file_exists($appTemplate)) {
                $file = $appTemplate;
            }

            //Check template in current theme
            if (!$file && $this->getParameter('current_theme') != 'default') {
                $selectedTemplate = $this->getParameter('theme_dir') . $this->s . $this->getParameter('current_theme')
                    . $this->s . 'templates' . $this->s . $localPath;

                if (file_exists($selectedTemplate)) {
                    $file = $selectedTemplate;
                }
            }

            //Check template in default theme
            if (!$file) {
                $defaultTemplate = $this->getParameter('theme_dir') . $this->s . 'default' . $this->s . 'templates'
                    . $this->s . $localPath;

                if (file_exists($defaultTemplate)) {
                    $file = $defaultTemplate;
                }
            }

            if (!$file) {
                throw new FileNotFoundException(sprintf('Theme file "%s" could not be found.', $localPath));
            }

            $template->set($file);
            $cache->save($template);
        } else {
            $file = $template->get();
        }

        return $this->render($file, $arguments);
    }

    /**
     * @param string $name
     * @return string
     */
    protected function makeTruePath(string $name)
    {
        /*preg_match_all('/([A-Z])/',$name, $matches);
        $lowNSlash = array_map([$this,'charReplacer'],$matches[0]);
        return str_replace($matches[0],$lowNSlash,$name).'.html.twig';*/
        return $name.'.html.twig';
    }

    /**
     * @param string $char
     * @return string
     */
    protected function charReplacer(string $char)
    {
        return DIRECTORY_SEPARATOR.mb_strtolower($char);
    }
}

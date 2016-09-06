<?php

namespace JustOpen\ThemeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    /**
     * ThemeSelector
     * 
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        return $this->render('JustOpenThemeBundle:Default:index.html.twig');
    }

    public function __call($name, $arguments) {
        //Взять Exception для отсутствующего шаблона
        // Замечание: значение $name регистрозависимо.
        echo "Вызов метода '$name' "
            . implode(', ', $arguments). "\n";
    }
}

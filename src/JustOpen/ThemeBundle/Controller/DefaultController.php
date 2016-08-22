<?php

namespace JustOpen\ThemeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('JustOpenThemeBundle:Default:index.html.twig');
    }
}

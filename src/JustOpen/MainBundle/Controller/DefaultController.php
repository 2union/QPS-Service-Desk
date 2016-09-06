<?php

namespace JustOpen\MainBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    /**
     * Dashboard
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(Request $request)
    {
        return $this->forward('JustOpenThemeBundle:Default:theme',[
            'name' => 'test',
            'arguments' => ['subject' => 'Test']
        ]);
        // replace this example code with whatever you need
        /*return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..'),
        ]);*/
        //return $this->render('JustOpenMainBundle:Default:index.html.twig');
    }
}

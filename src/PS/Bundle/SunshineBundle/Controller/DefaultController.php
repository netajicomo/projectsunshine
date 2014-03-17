<?php

namespace PS\Bundle\SunshineBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('SunshineBundle:Default:index.html.twig', array('name' => $name));
    }
}

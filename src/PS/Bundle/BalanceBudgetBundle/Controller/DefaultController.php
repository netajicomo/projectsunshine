<?php

namespace PS\Bundle\BalanceBudgetBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('PSBalanceBudgetBundle:Default:index.html.twig', array('name' => $name));
    }
}

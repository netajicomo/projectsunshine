<?php

namespace PS\Bundle\BalanceBudgetBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use PS\Bundle\BalanceBudgetBundle\Entity\PlannerUser;
use PS\Bundle\BalanceBudgetBundle\Form\PlannerUserType;



class RegistrationController extends Controller 
{

    public function registrationAction(Request $request){
        $em = $this->getDoctrine()->getManager(); 
        $form = $this->createForm(new PlannerUserType(), new PlannerUser());
            if ($request->request->count() > 0) { 
                    $form->bind($request);
                    $em->persist($form->getData());
                    $em->flush();
                    return new Response('Successfully Registered');
            } else {
                return $this->render('PSBalanceBudgetBundle:Registration:RegistrationForm.html.twig', array(
                    'form' => $form->createView(),
                ));
            }
    }

}


?>

<?php

namespace PS\Bundle\BalanceBudgetBundle\Controller;

use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;
use PS\Bundle\BalanceBudgetBundle\Entity\Category;
use Symfony\Component\HttpFoundation\JsonResponse;
use PS\Bundle\BalanceBudgetBundle\Entity\PlannerPostCode;

/**
 * Issue controller.
 *
 */
class DefaultController extends Controller
{


    public function CKEditorSaveAction(){

        $blockManager = $this->get('sonata.page.manager.block');
        $data = $this->getRequest()->get('data1');
        $value_array = array();
        foreach($data as $d){
            foreach($d as $value){
                $value_array[] .= $value;
            }
            $block = $blockManager->findOneBy(array('id' => str_replace('cms-block-', '', $value_array[0])));
            $block->setSettings(array('content'=>stripslashes($value_array[1])));
            $blockManager->save($block);
            $value_array = array();
        }

        return new \Symfony\Component\HttpFoundation\Response('success');
    }

    public function plannerPostcodeAction()
    {
        $em = $this->get('doctrine.orm.entity_manager');
        $host = $this->getRequest()->getHost();
        $template = $this->getRequest()->get('template')?$this->getRequest()->get('template'):'PSBalanceBudgetBundle:Planner:start_plan_postcode.html.twig';
//        $site = $em->getRepository('ApplicationSonataPageBundle:Site')->findOneBy(array('host' => $host));

        return $this->render($template);
    }

    public function updatePostCodeAction(Request $request){

        $service = $this->get('visitor_tracker_service');
        $service->createVisitor($request);
        $em = $this->getDoctrine()->getManager();
        //$issueId = $request->request->get('id');
        $value = $request->request->get('postcode');
        $session = $request->getSession();
        $sessionId = $session->get('id');
        try{
            $plannerPostCode = $em->getRepository('PSBalanceBudgetBundle:PlannerPostCode')->findOneBy(array('session_id'=>$sessionId));
        }
        catch(\Exception $exception)
        {
            echo $exception->getMessage();
        }

        if(!isset($sessionId) || !$plannerPostCode instanceof PlannerPostCode )
        {
            $session->set('id', $session->getId());
            $plannerPostCode = new PlannerPostCode();
            $plannerPostCode->setSessionId($sessionId);
        }
        $plannerPostCode->setPostCode($value);
        $em->persist($plannerPostCode);
        $em->flush();

        return $this->redirect($this->generateUrl('planner'));

    }


}


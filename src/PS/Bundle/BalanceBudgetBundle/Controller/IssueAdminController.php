<?php

namespace PS\Bundle\BalanceBudgetBundle\Controller;

use Sonata\AdminBundle\Controller\CRUDController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
class IssueAdminController extends CRUDController
{
    public function getControlTypePropertiesAction(Request $request){
        $em = $this->getDoctrine()->getManager();

        $widget = $em->getRepository('PSBalanceBudgetBundle:ControlType')->findOneById($request->request->get('id'));
   
        $properties = $widget->getProperties();
        
        $propertiesArray = explode(',',$properties);
        $results = array();
        foreach($propertiesArray as $property)
        {
            $results[$property] = '';
        } 
        
        return new JsonResponse($results);
   }
}

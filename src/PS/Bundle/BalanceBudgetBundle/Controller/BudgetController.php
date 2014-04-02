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
class BudgetController extends Controller
{

    /**
     * Lists all Issue entities.
     *
     */
    public function indexAction(Request $request)
    {
        
       
       // create the visitor
        $service = $this->get('visitor_tracker_service');
       
       $service->createVisitor($request);

       $em = $this->getDoctrine()->getManager();
       
       
        $categories = $em->getRepository('PSBalanceBudgetBundle:Category')->findAll();
        
        $budgetData = $em->getRepository('PSBalanceBudgetBundle:BudgetPlanner')->findOneById(1);
        
        // json decode the issue option values string 
        foreach($categories as $category)
        {  foreach($category->getSections() as $section){
                foreach($section->getIssues() as $issue){
                    $issue->setOptionValues(json_decode($issue->getOptionValues(), TRUE));
                }
            }
        }
        return $this->render('PSBalanceBudgetBundle:Planner:index.html.twig', array(
            'categories' => $categories,
            'budgetdata' => $budgetData,
            
        ));
    }
    
    // save the issue values
    

    public function processIssueAction(Request $request){

       $service = $this->get('visitor_tracker_service');
       $service->createVisitor($request);
       $em = $this->getDoctrine()->getManager();
       $issueId = $request->request->get('id');
       $value = $request->request->get('value');

            $issue = $em->getRepository('PSBalanceBudgetBundle:Issue')->findOneById($issueId);
          
      // get the parent
                $parentIssue =  $issue->getParent();
                if($parentIssue)
                {
              
                 
                    $parentId = $parentIssue->getId();
                    // get the siblings
                    $siblings = $parentIssue->getChildren();
                    $siblingsIds =   $em->getRepository('PSBalanceBudgetBundle:Issue')->getSiblingIds($parentId);     
                    // check to see if a reducer issue exists
                    foreach($siblings as $sibling){
                        if($sibling->getIsReduceBy())
                        {
                             $isReduceBy = true;
                             $reducerId = $sibling->getid();
                            if (($key = array_search($reducerId, $siblingsIds)) !== false) {
                            unset($siblingsIds[$key]);}
                             break;
                        }
                        else
                        {
                                $isReduceBy = false; 
                                $reducerId  = false;
                        }    
                        
                    }
                   
                   
                
                    
                  
                    $result = array('siblings' => $siblingsIds, 'parentId' => $parentId, 'value' => $value,'issueId' => $issueId, 'isReduceBy' => $isReduceBy, 'reducerId' => $reducerId);
               
                     return new JsonResponse($result); 
                    
                }
             
             
               

   
       
        
    }


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

    
     public function updateDebtAction(Request $request){
              $em = $this->getDoctrine()->getManager();
              $parentId = $request->request->get('parentId');
              $sessionId = $request->getSession()->get('id');  
              $currentDebt = $request->request->get('currentDebt');
              $debtValue = $request->request->get('debtValue');
             $reducerId = $request->request->get('reducerId');
                $issueId =  $request->request->get('issueId');
              $issueValue =  $request->request->get('value');
               $childrenValues = $request->request->get('childrenValues');
              $childrenValueArray = json_decode($childrenValues,TRUE);
              $childrenTotal = array_sum($childrenValueArray);
               $values = $em->getRepository('PSBalanceBudgetBundle:Issue')->findOneById($parentId)->getOptionValues();
                $valuesArray = json_decode($values,TRUE);
                $total = $valuesArray['total'];
          
            $em->getRepository('PSBalanceBudgetBundle:VisitorActivity')->saveActivity($sessionId,$issueId, $issueValue);              
         // to check if it has a reduction slider
         if($request->request->get('reducerId'))  
         {
            
           
              $reducerPercentage = $request->request->get('reducerPercentage');
            
         
                    
                        $newReducerValue = ($total - $childrenTotal) * $reducerPercentage/100 ;
                       if($reducerPercentage == '0')
                       {
                           $parentDebt =   $childrenTotal;
                         
                          
                       }
                       else
                      {
                           
                             $parentDebt = $childrenTotal + $newReducerValue;
                      
                        
                       }
                     
                      
                 
                   
                // savereducer slider in DB
                
                  $em->getRepository('PSBalanceBudgetBundle:VisitorActivity')->saveActivity($sessionId,$reducerId, $newReducerValue);               
                  $em->getRepository('PSBalanceBudgetBundle:VisitorActivity')->saveActivity($sessionId,$parentId, $parentDebt);             
                  
                  $totalDebt = $em->getRepository('PSBalanceBudgetBundle:VisitorActivity')->getTheSetParentValues($sessionId);        
                // echo $totalDebt.'<br>';
                  $sliderValue = $currentDebt - ($totalDebt);           
                      $result = array('newReducerValue' => $newReducerValue, 'parentDebt' => $parentDebt, 'sliderValue' => $sliderValue);
                    
         }
         else
         {
              // save to the db
                 
                         $parentDebt = $childrenTotal;
                   $em->getRepository('PSBalanceBudgetBundle:VisitorActivity')->saveActivity($sessionId,$parentId, $parentDebt);                
                
              
                  $totalDebt = $em->getRepository('PSBalanceBudgetBundle:VisitorActivity')->getTheSetParentValues($sessionId);        
                
                  $sliderValue = $currentDebt - ($totalDebt);   
                $result = array('parentDebt' => $parentDebt, 'sliderValue' => $sliderValue);
               
                    
         }    
        
       
    
         
          return new JsonResponse($result);
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


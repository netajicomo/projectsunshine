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
    public function indexAction(Request $request, $id)
    {
        
       
       // create the visitor
        $service = $this->get('visitor_tracker_service');
       
       $service->createVisitor($request);

       $sessionId = $request->getSession()->get('id');  
       $em = $this->getDoctrine()->getManager();
       
       
        $category = $em->getRepository('PSBalanceBudgetBundle:Category')->find($id);
        
        $budgetData = $em->getRepository('PSBalanceBudgetBundle:BudgetPlanner')->find(1);
        
        $currentdebt = $em->getRepository('PSBalanceBudgetBundle:VisitorActivity')->getTheSetParentValues($sessionId);   
        $sliderValue = intval($budgetData->getDebt()) - intval($currentdebt);
        
        // json decode the issue option values string 
       // foreach($categories as $category)
       // {
            foreach($category->getSections() as $section){
                foreach($section->getIssues() as $issue){
                    $optionValues = json_decode($issue->getOptionValues(), TRUE);
                  if($sessionId)
                  {
                      $savedIssue = $em->getRepository('PSBalanceBudgetBundle:VisitorActivity')->findOneBy(array('issue_id' => $issue->getId(),'session_id' => $sessionId));
                      if(isset($savedIssue))
                      {
                         if($savedIssue->getIssuePercentage())
                         {   
                           $value = $savedIssue->getIssuePercentage();
                           $cost = $savedIssue->getIssueValue();
                         }
                         else
                         {
                             $value =  $savedIssue->getIssueValue(); 
                             $cost = $savedIssue->getIssueValue(); 
                         }
                      }
                      else
                      {    
                      $value = 0;    
                       $cost = 0;    
                      }
                      
                  }  
                    
                    $optionValues['value'] = $value;
                     $optionValues['cost'] = $cost;
                    $issue->setOptionValues($optionValues);
                                       
                  
                    
                }
            }
       // }
        //exit;
        return $this->render('PSBalanceBudgetBundle:Planner:index.html.twig', array(
            'category' => $category,
            'budgetdata' => $budgetData,
            'slidervalue' => $sliderValue,
            'next' => $id+1
            
        ));
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
         
                // visitor tracking
              $service = $this->get('visitor_tracker_service');
              $service->createVisitor($request);
              
              
              
              // essential parameters from the request
             
              $currentDebt = $request->request->get('currentDebt');
              $issueId =  $request->request->get('issueId');
              $issueValue =  $request->request->get('value');
             
              // essential parameters for the work
              $sessionId = $request->getSession()->get('id');  
              $parentId = $this->getParentId($issueId);
              
              
              //instantiate other variables
                $newReducerValue = false;
                $newWogValue = 0;
                $newWogTotal = 0;
                $wogParentId = false;
                $isSlider = false;
                $wogId = $this->hasWog($issueId);
                $reducerId = $this->hasReducer($issueId);
               
              
              $em = $this->getDoctrine()->getManager();
            //calculate the regular slider value  
           $newValue = $this->isSlider($issueId, $issueValue);
           if($newValue)
           {    
            if($reducerId != $issueId)   
           
           $isSlider = $newValue;
               $em->getRepository('PSBalanceBudgetBundle:VisitorActivity')->saveActivity($sessionId,$issueId, round($newValue), $issueValue);             
           } 
           else   
           { // save the issue value to the db  
            $em->getRepository('PSBalanceBudgetBundle:VisitorActivity')->saveActivity($sessionId,$issueId, round($issueValue));              
           }
            // return the section / parent total
          
            $total = $this->getParentTotal($issueId);
              
          
         
            
           
            
          
              // for the whole of the govt logic
            
         if($wogId)
         {
             // if its the wog slider itself save  the percentage value it in the db
               if($wogId == $issueId)
               {
               
                   $em->getRepository('PSBalanceBudgetBundle:VisitorActivity')->saveActivity($sessionId,$issueId,'0',$issueValue);
             
               }
             // retreive it from the db  
             $wogPercentage = $this->getWOGPercentage($wogId, $sessionId);  
             $newWogValue = $this->calculateWOG($wogId, $wogPercentage, $sessionId);
             
             // save the wog value
             $em->getRepository('PSBalanceBudgetBundle:VisitorActivity')->saveActivity($sessionId,$wogId, round($newWogValue), $wogPercentage);               
            // now get the total wog
             $newWogTotal = $this->getWOGSectionTotal($wogId, $sessionId);
             $wogParentId = $this->getWogParent($wogId);
             // update the parent id
             $em->getRepository('PSBalanceBudgetBundle:VisitorActivity')->saveActivity($sessionId,$wogParentId, round($newWogTotal));             
           
         }     
         // to check if it has a reduction slider 
        
         if($reducerId)  
         {
            if($reducerId == $issueId)
            {
                   $em->getRepository('PSBalanceBudgetBundle:VisitorActivity')->saveActivity($sessionId,$issueId,'0',$issueValue); 
            }   
           
              $reducerPercentage = $this->getReducerPercentage($reducerId, $sessionId);
             
                $childrenTotal = $this->getSectionTotal($issueId, $sessionId)  ;
                  //  echo $total.'<br>';
                  //  echo $childrenTotal.'<br>';
                        $newReducerValue = (intval($total) - intval($childrenTotal)) * intval($reducerPercentage)/100 ;
                      
                           
                             $parentDebt = intval($childrenTotal) + intval($newReducerValue);
                      
                        
                   
                       
                 
                   
                // savereducer slider in DB
                
                  $em->getRepository('PSBalanceBudgetBundle:VisitorActivity')->saveActivity($sessionId,$reducerId, round($newReducerValue), $reducerPercentage);               
                  $em->getRepository('PSBalanceBudgetBundle:VisitorActivity')->saveActivity($sessionId,$parentId, round($parentDebt));             
                  
                  $totalDebt = $em->getRepository('PSBalanceBudgetBundle:VisitorActivity')->getTheSetParentValues($sessionId);        
                // echo $totalDebt.'<br>';
                  $sliderValue = intval($currentDebt) - intval($totalDebt); 
                  
                  
                      
                  
                    
                    
         }
         
         else
         {
              // save the  to the db
                    $childrenTotal = $this->getSectionTotal($issueId, $sessionId)  ;  
                  $parentDebt = intval($childrenTotal);
                   if($wogId != $issueId)
                  $em->getRepository('PSBalanceBudgetBundle:VisitorActivity')->saveActivity($sessionId,$parentId, round($parentDebt));                
                
              
                  $totalDebt = $em->getRepository('PSBalanceBudgetBundle:VisitorActivity')->getTheSetParentValues($sessionId);        
                
                  $sliderValue = intval($currentDebt) - intval($totalDebt);  
           
                  
                //$result = array('parentDebt' => $parentDebt, 'sliderValue' => $sliderValue,'wogValue' => $newWogValue,'wogTotal' => $newWogTotal, 'wogParentId' => $wogParentId);
               
                    
         }    
          $result = array(  
                                        'reducerId'  => $reducerId,
                                        'isSlider' => $isSlider,
                                        'newReducerValue' => round($newReducerValue), 
                                        'parentId' => $parentId,
                                        'parentDebt' => $parentDebt, 
                                        'sliderValue' => $sliderValue, 
                                        'totalDebt' => $totalDebt,
                                        'wogId' => $wogId,
                                        'wogValue' => round($newWogValue), 
                                        'wogTotal' => $newWogTotal, 
                                        'wogParentId' => $wogParentId
                              );
       
    
         
          return new JsonResponse($result);
     }
    
   
  public function calculateWOG($wogId, $wogPercentage, $sessionId){
         
      $em = $this->getDoctrine()->getManager();
       $wogIssue = $em->getRepository('PSBalanceBudgetBundle:Issue')->findOneById($wogId);
    
                      $optionValues = json_decode($wogIssue->getOptionValues(), TRUE);
                        $totalValue = $em->getRepository('PSBalanceBudgetBundle:VisitorActivity')->getCumulativeValue($sessionId, $wogId, $wogIssue->getDependency()->getId());
                      $total = $optionValues['total'] - $totalValue;
                      $newWogValue = ($total) * $wogPercentage/100 ;
                     return $newWogValue;
     
  }  
  
  public function getWOGPercentage($wogId, $session_id){
      $em = $this->getDoctrine()->getManager();
      $wog = $em->getRepository('PSBalanceBudgetBundle:VisitorActivity')->findOneBy(array('issue_id' => $wogId, 'session_id' => $session_id));
     if(isset($wog)){
         $wogPercentage = $wog->getIssuePercentage();
     }
      
      $result = isset($wogPercentage)?$wogPercentage:0;
      return $result;
      
      
  }
  
  public function getWOGSectionTotal($sessionId, $issueId){
        $em = $this->getDoctrine()->getManager();
      $wogTotal = $em->getRepository('PSBalanceBudgetBundle:VisitorActivity')->getWOGsectionTotal($sessionId, $issueId);
      $result = isset($wogTotal)?$wogTotal:0;
      return $result;
  }
  
  public function getWogParent($wogId){
         $em = $this->getDoctrine()->getManager();
         $wogIssue = $em->getRepository('PSBalanceBudgetBundle:Issue')->findOneById($wogId);
         return $wogIssue->getParent()->getId();
      
  }
  
  public function getParentTotal($issueId){
      $em = $this->getDoctrine()->getManager();
       $issue = $em->getRepository('PSBalanceBudgetBundle:Issue')->findOneById($issueId); 
       $parentIssue =  $issue->getParent();
         $values = $parentIssue->getOptionValues();
         $valuesArray = json_decode($values,TRUE);
          $total = $valuesArray['total'];
          return $total;
          
  }
  public function isSlider($issueId, $issuevalue){
       $em = $this->getDoctrine()->getManager();
       $issue = $em->getRepository('PSBalanceBudgetBundle:Issue')->find($issueId);
       if(strpos($issue->getControltype()->getName(),'slider') !== false){
            $values = $issue->getOptionValues();
         $valuesArray = json_decode($values,TRUE);
          $total = $valuesArray['total'];
          $finalvalue = $total * $issuevalue/100;
          
        
          return $finalvalue;
       }
       else
       return false;    
      
  }
  
  
  
  public function getParentId($issueId){
      $em = $this->getDoctrine()->getManager();
       $issue = $em->getRepository('PSBalanceBudgetBundle:Issue')->findOneById($issueId); 
       $parentIssue =  $issue->getParent(); 
       return $parentIssue->getId();
  }
  
  public function getSectionTotal($issueId,$sessionId){
      $result = $this->hasReducer($issueId);
      $reducerId = $result?$result:0;
       $em = $this->getDoctrine()->getManager();
      $total = $em->getRepository('PSBalanceBudgetBundle:VisitorActivity')->getSectionTotal( $issueId, $sessionId, $reducerId);
      return $total;
  }
  
  public function getReducerPercentage($reducerId, $sessionId){
      $em = $this->getDoctrine()->getManager();
      $reducer = $em->getRepository('PSBalanceBudgetBundle:VisitorActivity')->findOneBy(array('issue_id' => $reducerId,'session_id' => $sessionId));
      if(isset($reducer))
      {
          $percentage = $reducer->getIssuePercentage();
      }
      $result = isset($percentage)?$percentage:0;
      return $result;
  }

  public function hasReducer($issueId){
       $em = $this->getDoctrine()->getManager();
       $issue = $em->getRepository('PSBalanceBudgetBundle:Issue')->findOneById($issueId); 
       $parentIssue =  $issue->getParent();
       $children = $parentIssue->getChildren();
       foreach($children as $child){
          if($child->getIsReduceBy())
         {
            $reducerId = $child->getid(); 
                     
          }
           
       }
       $result = isset($reducerId)?$reducerId:false;
       return $result;
      
  }
  
  public function hasWog($issueId){
         $em = $this->getDoctrine()->getManager();
         $issue = $em->getRepository('PSBalanceBudgetBundle:Issue')->findOneById($issueId);      
        if($issue->getDependency())   
        {
             $wogIssue = $em->getRepository('PSBalanceBudgetBundle:Issue')->getTheCumulativeId($issue->getDependency()->getId()); 
             $wogId = $wogIssue->getId();
                       
        }
        
        $result = isset($wogId)?$wogId:false;
        return $result;
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


<?php

namespace PS\Bundle\BalanceBudgetBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;
use PS\Bundle\BalanceBudgetBundle\Entity\Category;
use Symfony\Component\HttpFoundation\JsonResponse;

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
          $sessionId = $request->getSession()->get('id');  
       $em = $this->getDoctrine()->getManager();
       
       
        $categories = $em->getRepository('PSBalanceBudgetBundle:Category')->findAll();
        
        $budgetData = $em->getRepository('PSBalanceBudgetBundle:BudgetPlanner')->findOneById(1);
        
        // json decode the issue option values string 
        foreach($categories as $category)
        {  foreach($category->getSections() as $section){
                foreach($section->getIssues() as $issue){
                    $optionValues = json_decode($issue->getOptionValues(), TRUE);
                      $issue->setOptionValues($optionValues);
                                       
                  
                    
                }
            }
        }
        //exit;
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
                        // get the dependents from the db
                       
                        
                    }
                   
                  // to cater to the WOG section
                    $isWog = false;
                    $wogId = false;
                  if($issue->getDependency())   
                  {
                       $wogIssue = $em->getRepository('PSBalanceBudgetBundle:Issue')->getTheCumulativeId($issue->getDependency()->getId()); 
                  
                       $wogId = $wogIssue->getId();
                        $isWog = true;
                    
                  }   
                
                    
                  
                    $result = array('siblings' => $siblingsIds, 'parentId' => $parentId, 'value' => $value,'issueId' => $issueId, 'isReduceBy' => $isReduceBy, 'reducerId' => $reducerId,'isWog' => $isWog, 'wogId' => $wogId);
               
                     return new JsonResponse($result); 
                    
                }
             
             
               
     
   
       
        
    }
    
   
    
     public function updateDebtAction(Request $request){
              $em = $this->getDoctrine()->getManager();
              $parentId = $request->request->get('parentId');
              $sessionId = $request->getSession()->get('id');  
              $currentDebt = $request->request->get('currentDebt');
              $wogId = $request->request->get('wogId');
              $wogPercentage = $request->request->get('wogPercentage');
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
         $newWogValue = false;
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
                  
                  
                  // for the whole of the govt logic
         if($wogId)
         {
             $newWogValue = $this->calculateWOG($wogId, $wogPercentage, $sessionId);
            
         }
                  
                  
                      $result = array('newReducerValue' => $newReducerValue, 'parentDebt' => $parentDebt, 'sliderValue' => $sliderValue, 'wogValue' => $newWogValue);
                    
         }
         else
         {
              // save to the db
                 
                         $parentDebt = $childrenTotal;
                   $em->getRepository('PSBalanceBudgetBundle:VisitorActivity')->saveActivity($sessionId,$parentId, $parentDebt);                
                
              
                  $totalDebt = $em->getRepository('PSBalanceBudgetBundle:VisitorActivity')->getTheSetParentValues($sessionId);        
                
                  $sliderValue = $currentDebt - ($totalDebt);  
           // for the whole of the govt logic
         if($wogId)
         {
            //if($wogId != $issueId)
             $newWogValue = $this->calculateWOG($wogId, $wogPercentage, $sessionId);
            
         }       
                  
                $result = array('parentDebt' => $parentDebt, 'sliderValue' => $sliderValue,'wogValue' => $newWogValue);
               
                    
         }    
        
       
    
         
          return new JsonResponse($result);
     }
    
   
  public function calculateWOG($wogId, $wogPercentage, $sessionId){
         
      $em = $this->getDoctrine()->getManager();
       $wogIssue = $em->getRepository('PSBalanceBudgetBundle:Issue')->findOneById($wogId);
    
                      $optionValues = json_decode($wogIssue->getOptionValues(), TRUE);
                        $totalValue = $em->getRepository('PSBalanceBudgetBundle:VisitorActivity')->getCumulativeValue($sessionId, $wogId, $wogIssue->getDependency()->getId());
                      $total = $optionValues['total'] - $totalValue;
                      echo $optionValues['total'].'<br>';
                       echo $totalValue.'<br>';
                         echo $wogPercentage.'<br>';
                     $newWogValue = ($total) * $wogPercentage/100 ;
                     return $newWogValue;
                       
    
      
      
  }   
    
}   


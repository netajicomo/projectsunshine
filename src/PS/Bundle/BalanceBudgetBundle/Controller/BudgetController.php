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
    
   
    
     public function updateDebtAction(Request $request){
              $em = $this->getDoctrine()->getManager();
              $parentId = $request->request->get('parentId');
              $sessionId = $request->getSession()->get('id');  
              $currentDebt = $request->request->get('currentDebt');
              $debtValue = $request->request->get('debtValue');
           //  $reducerDebtPercentage = $request->request->get('reducerDebtPercentage');
              $issueValue =  $request->request->get('value');
               $childrenValues = $request->request->get('childrenValues');
              $childrenValueArray = json_decode($childrenValues,TRUE);
              $childrenTotal = array_sum($childrenValueArray);
               $values = $em->getRepository('PSBalanceBudgetBundle:Issue')->findOneById($parentId)->getOptionValues();
                $valuesArray = json_decode($values,TRUE);
                $total = $valuesArray['total'];
           
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
                     
                      
                           
                       $sliderValue = $currentDebt - ($parentDebt);  
                   
                       
                    
                           
                      $result = array('newReducerValue' => $newReducerValue, 'parentDebt' => $parentDebt, 'sliderValue' => $sliderValue);
                     return new JsonResponse($result);
         }
         else
         {
              
                $parentDebt = $childrenTotal;
                 $sliderValue = $currentDebt - ($debtValue);  
                $result = array('parentDebt' => $parentDebt, 'sliderValue' => $sliderValue);
               
                     return new JsonResponse($result);
         }    
        

    
     }
    
    
    
}   


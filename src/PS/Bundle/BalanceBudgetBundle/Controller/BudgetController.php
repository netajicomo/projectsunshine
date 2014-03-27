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
    
    public function saveIssueAction(Request $request){
        
       $service = $this->get('visitor_tracker_service');
       $service->createVisitor($request);
       $em = $this->getDoctrine()->getManager();
       $issueId = $request->request->get('id');
       $value = $request->request->get('value');
       $sessionId = $request->getSession()->get('id');
       
      
       
      
            $issue = $em->getRepository('PSBalanceBudgetBundle:Issue')->findOneById($issueId);
            // check to see if its a child 
      
                $parentIssue =  $issue->getParent();
                if($parentIssue)
                {
                //  echo 'is a child<br>';
                    $em->getRepository('PSBalanceBudgetBundle:VisitorActivity')->saveActivity($sessionId,$issueId, $value);     
                    $parentId = $parentIssue->getId();
                
                    
                   $children =   $em->getRepository('PSBalanceBudgetBundle:Issue')->getChildrenIds($parentId);     
                    $result = array('children' => $children, 'parentId' => $parentId,'isChild' => true, 'value' => $value);
                }
             // else if it is a parent pass the percentage as the value
                elseif($issue->getChildren())
                {
                 // echo 'is the parent<br>';
                    $children =   $em->getRepository('PSBalanceBudgetBundle:Issue')->getChildrenIds($issueId);     
                     $result = array('children' => $children, 'percentage' => $value,'parentId' => $issueId);
                   
                }
                 return new JsonResponse($result);
     
   
       
        
    }
    
   
    
     public function updateDebtAction(Request $request){

         // to check if it is a child issue
         if($request->request->get('childDebt'))  
         {
            
            // echo 'is child<br>';
             $parentId = $request->request->get('parentId');
            $childDebt = $request->request->get('childDebt');
            $parentDebt = $request->request->get('parentDebt');
              $childrenValues = $request->request->get('childrenValues');
              $childrenValueArray = json_decode($childrenValues,TRUE);
              $childTotal = array_sum($childrenValueArray);
            $sessionId = $request->getSession()->get('id');  
             $em = $this->getDoctrine()->getManager();
        // if the the parent value is zero dont do anything but just return the total
            if($parentDebt == '0'){
               // echo ' with parent untouched<br>';        
    
                $result = array('sectiontotal' => $childTotal);
             return new JsonResponse($result);
        }
        
          else
        {
           
          //    echo ' with parent having value<br>';   
              $values = $em->getRepository('PSBalanceBudgetBundle:Issue')->findOneById($parentId)->getOptionValues();
            $valuesArray = json_decode($values,TRUE);
            $total = $valuesArray['total'];
            
             $newParentDebt = ($total - $childTotal) * $parentDebt/100 ;
          $sectionTotal = $newParentDebt + $childTotal;
       $em->getRepository('PSBalanceBudgetBundle:VisitorActivity')->saveActivity($sessionId,$parentId, $newParentDebt); 
         $result = array('newParentDebt' => $newParentDebt, 'sectiontotal' => $sectionTotal);
                    return new JsonResponse($result);
        }  
        
         }
       else
       {
      //    echo 'is parent<br>'.$parentPercentage.'<br>';   
           $parentPercentage = $request->request->get('parentPercentage');
            $childrenValues = $request->request->get('childrenValues');
               $parentId = $request->request->get('parentId');
                  $sessionId = $request->getSession()->get('id');  
              $childrenValueArray = json_decode($childrenValues,TRUE);
              $childTotal = array_sum($childrenValueArray);
           $em = $this->getDoctrine()->getManager();
          $values = $em->getRepository('PSBalanceBudgetBundle:Issue')->findOneById($parentId)->getOptionValues();
        $valuesArray = json_decode($values,TRUE);
        $total = $valuesArray['total'];  
       

        $newParentDebt = ($total - $childTotal) * $parentPercentage/100 ;
        $sectionTotal = $newParentDebt + $childTotal;

        
         $em->getRepository('PSBalanceBudgetBundle:VisitorActivity')->saveActivity($sessionId,$parentId, $newParentDebt); 
         $result = array('newParentDebt' => $newParentDebt, 'sectiontotal' => $sectionTotal);
                    return new JsonResponse($result);
       }   
       
      
        
    }
    
    
   
    
    
    
}   


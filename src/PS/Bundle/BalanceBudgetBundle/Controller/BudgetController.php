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
                    $result = array('children' => $children, 'parentId' => $parentId,'isChild' => true, 'value' => $value,'issueId' => $issueId);
                }
             // else if it is a parent pass the percentage as the value
                elseif($issue->getChildren())
                {
                 // echo 'is the parent<br>';
                    $children =   $em->getRepository('PSBalanceBudgetBundle:Issue')->getChildrenIds($issueId);     
                     $result = array('children' => $children, 'percentage' => $value,'parentId' => $issueId, 'isParent' => true);
                   
                }
               // else is an independent and does its own work but we need its siblings for the section total
                else
                {
                         $em->getRepository('PSBalanceBudgetBundle:VisitorActivity')->saveActivity($sessionId,$issueId, $value);   
                       $siblings = $em->getRepository('PSBalanceBudgetBundle:Issue')->getSiblingIssueIds($issue->getSection()->getId());  
                        $result = array('issueId' => $issueId, 'value' => $value, 'isIndependent' => true, 'children' => $siblings); 
                }
                    
                 return new JsonResponse($result);
     
   
       
        
    }
    
   
    
     public function updateDebtAction(Request $request){
              $em = $this->getDoctrine()->getManager();
         // to check if it is a child issue
         if($request->request->get('isChild'))  
         {
            
            // echo 'is child<br>';
             $parentId = $request->request->get('parentId');
            $childDebt = $request->request->get('childDebt');
            
            $parentDebt = $request->request->get('parentDebt');
              $childrenValues = $request->request->get('childrenValues');
              $childrenValueArray = json_decode($childrenValues,TRUE);
              $childTotal = array_sum($childrenValueArray);
            $sessionId = $request->getSession()->get('id');  
        
        // if the the parent value is zero dont do anything but just return the total
            if($parentDebt == '0'){
             //   echo ' with parent untouched<br>';   
             //   echo $childDebt;
               // $totalDebt = $request->request->get('currentDebt') - ($childDebt);
                 $totalDebt = $request->request->get('currentDebt') - ($childTotal);
                $result = array('sectiontotal' => $childTotal, 'currentDebt' => $totalDebt );
             return new JsonResponse($result);
        }
        
          else
        {
           
           //   echo ' with parent having value<br>'; 
                 $parentPercentageDebt = $request->request->get('parentPercentageDebt');
              $values = $em->getRepository('PSBalanceBudgetBundle:Issue')->findOneById($parentId)->getOptionValues();
            $valuesArray = json_decode($values,TRUE);
            $total = $valuesArray['total'];
            
             $newParentDebt = ($total - $childTotal) * $parentDebt/100 ;
          $sectionTotal = $newParentDebt + $childTotal;
            $em->getRepository('PSBalanceBudgetBundle:VisitorActivity')->saveActivity($sessionId,$parentId, $newParentDebt); 
        
        // $totalDebt = $request->request->get('currentDebt') - ($childDebt);
            $totalDebt = $request->request->get('currentDebt') - ($sectionTotal);
       $result = array('newParentDebt' => $newParentDebt, 'sectiontotal' => $sectionTotal, 'currentDebt' => $totalDebt);
                    return new JsonResponse($result);
        }  
        
         }
       elseif($request->request->get('isParent'))
       {
         // echo 'is parent<br>'.$parentPercentage.'<br>';   
           $parentPercentage = $request->request->get('parentPercentage');
             $parentPercentageDebt = $request->request->get('parentPercentageDebt');
            $childrenValues = $request->request->get('childrenValues');
               $parentId = $request->request->get('parentId');
                  $sessionId = $request->getSession()->get('id');  
              $childrenValueArray = json_decode($childrenValues,TRUE);
              $childTotal = array_sum($childrenValueArray);
          
          $values = $em->getRepository('PSBalanceBudgetBundle:Issue')->findOneById($parentId)->getOptionValues();
        $valuesArray = json_decode($values,TRUE);
        $total = $valuesArray['total'];  
       
 
        $newParentDebt = ($total - $childTotal) * $parentPercentage/100 ;
        $sectionTotal = $newParentDebt + $childTotal;
 $em->getRepository('PSBalanceBudgetBundle:VisitorActivity')->saveActivity($sessionId,$parentId, $newParentDebt); 
        // $totalDebt = $request->request->get('currentDebt') - ($total - $childTotal) * $parentPercentageDebt/100 ;
         $totalDebt = $request->request->get('currentDebt') - $sectionTotal;
        $em->getRepository('PSBalanceBudgetBundle:VisitorActivity')->saveActivity($sessionId,$parentId, $newParentDebt); 
         $result = array('newParentDebt' => $newParentDebt, 'sectiontotal' => $sectionTotal, 'currentDebt' => $totalDebt);
                    return new JsonResponse($result);
       } 
       
       else
       {  
             //   echo 'is an independent<br>';  
            $siblingValues = $request->request->get('siblingValues');
             $siblingValueArray = json_decode($siblingValues,TRUE);
              $siblingTotal = array_sum($siblingValueArray);
              // $totalDebt = $request->request->get('currentDebt') - $request->request->get('independentValue');
              $totalDebt = $request->request->get('currentDebt') - $sectionTotal;
              $result = array('sectiontotal' => $siblingTotal, 'currentDebt' => $totalDebt);

              
       }   
       
      
        
    }
    
    
   
    
    
    
}   


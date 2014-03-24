<?php

namespace PS\Bundle\BalanceBudgetBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;
use PS\Bundle\BalanceBudgetBundle\Entity\Category;


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
       
       $em->getRepository('PSBalanceBudgetBundle:VisitorActivity')->saveActivity($sessionId,$issueId, $value);
     
       echo "saved";
       exit;
        
    }
    
    
    
}   


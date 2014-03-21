<?php

namespace PS\Bundle\BalanceBudgetBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

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
    public function indexAction()
    {
        $service = $this->get('visitor_tracker_service');
        echo $service->createVisitor();
       //exit;
        
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
    
    
    
}   


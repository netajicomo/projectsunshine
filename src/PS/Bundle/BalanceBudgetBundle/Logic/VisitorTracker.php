<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace PS\Bundle\BalanceBudgetBundle\Logic;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Doctrine\ORM\EntityManager;
use PS\Bundle\BalanceBudgetBundle\Entity\Visitor;

class VisitorTracker
{
    private $request;
    private $session;
    private $em; 
    public function __construct(Request $request, EntityManager $entityManager) {
        $this->request = $request;
        $this->em = $entityManager;
    }
    
   
    public function getSessionId(){
        return $this->session->getId();
    }
    
    public function getIP()
    {
        return $this->request->getClientIp();
    } 
    
    public function getUserAgent(){
       
        return $this->request->headers->get('User-Agent');
    }
    
    
    public function createVisitor($request){
        
      $session = $request->getSession();
      $sessionId = $session->get('id');
      $postCode = $request->request->get('postcode');
      $visitor =  $this->em->getRepository('PSBalanceBudgetBundle:Visitor')->findOneBy(array('session_id'=>$sessionId)); 
      if(!$postCode && !$visitor)
      return false;    
      
     
      // check if the session id exists and if it exists in the DB
      if(!isset($sessionId) || !isset($visitor))
      {    
           //create the visitor object
           $session->set('id', $session->getId());
          $this->createVisitorObject($session->getId(),$postCode);
          
      }  
     return true;
        
    }



    public function createVisitorObject($sessionId, $postCode){
        
        $visitor = new Visitor();
        $visitor->setSessionId($sessionId);
        $visitor->setIp($this->getIP());
        $visitor->setUserAgent($this->getUserAgent());
        $visitor->setPostCode($postCode);
        $this->em->persist($visitor);
        $this->em->flush();
    }
    
   
    
}



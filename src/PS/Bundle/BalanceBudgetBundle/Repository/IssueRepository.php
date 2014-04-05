<?php

namespace PS\Bundle\BalanceBudgetBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * IssueRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class IssueRepository extends EntityRepository
{
    public function getSiblingIds($issueId){

        $parentIssue = $this->findOneById($issueId);
        $children = $parentIssue->getChildren();
        $childrenIdArray = array();
        foreach($children as $child)
        {
            $childrenIdArray[] = $child->getId();
        }

        return $childrenIdArray;
    }


    public function getParentIssues(){

        $q = $this->createQueryBuilder('i')
            ->where('i.is_parent = 1')
            ->getQuery();

        return $q->getResult();

   }
   
   public function getTheCumulativeId($depId){
       
        $dep = $this->getEntityManager()->getRepository('PSBalanceBudgetBundle:Dependency')->findOneById($depId);
        $deps = $dep->getDependantissues();
        
        foreach($deps as $issue)
        {
            if($issue->getIsCumulative())
                return $issue;
        }
     
    
       
   }
   
 
  
}

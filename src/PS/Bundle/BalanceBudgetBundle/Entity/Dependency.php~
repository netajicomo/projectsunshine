<?php

namespace PS\Bundle\BalanceBudgetBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Dependency
 */
class Dependency
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $name;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Dependency
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }
    
     public function __toString()
    {
          return $this->name;
    }
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $dependantissues;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->dependantissues = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add dependantissues
     *
     * @param \PS\Bundle\BalanceBudgetBundle\Entity\Issue $dependantissues
     * @return Dependency
     */
    public function addDependantissue(\PS\Bundle\BalanceBudgetBundle\Entity\Issue $dependantissues)
    {
        $this->dependantissues[] = $dependantissues;

        return $this;
    }

    /**
     * Remove dependantissues
     *
     * @param \PS\Bundle\BalanceBudgetBundle\Entity\Issue $dependantissues
     */
    public function removeDependantissue(\PS\Bundle\BalanceBudgetBundle\Entity\Issue $dependantissues)
    {
        $this->dependantissues->removeElement($dependantissues);
    }

    /**
     * Get dependantissues
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getDependantissues()
    {
        return $this->dependantissues;
    }
    
    
}

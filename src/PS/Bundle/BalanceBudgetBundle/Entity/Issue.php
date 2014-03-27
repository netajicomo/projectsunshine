<?php

namespace PS\Bundle\BalanceBudgetBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Issue
 */
class Issue
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
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $lead;

    /**
     * @var string
     */
    private $description;

    /**
     * @var string
     */
    private $option_values;

    /**
     * @var boolean
     */
    private $is_active = true;

    /**
     * @var \DateTime
     */
    private $created_at;

    

    /**
     * @var \PS\Bundle\BalanceBudgetBundle\Entity\ControlType
     */
    private $controltype;
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
     * @return Issue
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

    /**
     * Set title
     *
     * @param string $title
     * @return Issue
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set lead
     *
     * @param string $lead
     * @return Issue
     */
    public function setLead($lead)
    {
        $this->lead = $lead;

        return $this;
    }

    /**
     * Get lead
     *
     * @return string 
     */
    public function getLead()
    {
        return $this->lead;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Issue
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set option_values
     *
     * @param string $optionValues
     * @return Issue
     */
    public function setOptionValues($optionValues)
    {
        $this->option_values = $optionValues;

        return $this;
    }

    /**
     * Get option_values
     *
     * @return string 
     */
    public function getOptionValues()
    {
        return $this->option_values;
    }

    /**
     * Set is_active
     *
     * @param boolean $isActive
     * @return Issue
     */
    public function setIsActive($isActive)
    {
        $this->is_active = $isActive;

        return $this;
    }

    /**
     * Get is_active
     *
     * @return boolean 
     */
    public function getIsActive()
    {
        return $this->is_active;
    }

    /**
     * Set created_at
     *
     * @param \DateTime $createdAt
     * @return Issue
     */
    public function setCreatedAt($createdAt)
    {
        $this->created_at = $createdAt;

        return $this;
    }

    /**
     * Get created_at
     *
     * @return \DateTime 
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    
    /**
     * @ORM\PrePersist
     */
    public function setCreatedAtValue()
    {
         if(!$this->getCreatedAt()) {
            $this->created_at = new \DateTime();
        }
    }
    


    /**
     * Set controltype
     *
     * @param \PS\Bundle\BalanceBudgetBundle\Entity\ControlType $controltype
     * @return Issue
     */
    public function setControltype(\PS\Bundle\BalanceBudgetBundle\Entity\ControlType $controltype = null)
    {
        $this->controltype = $controltype;

        return $this;
    }

    /**
     * Get controltype
     *
     * @return \PS\Bundle\BalanceBudgetBundle\Entity\ControlType 
     */
    public function getControltype()
    {
        return $this->controltype;
    }
    /**
     * @var \PS\Bundle\BalanceBudgetBundle\Entity\Section
     */
    private $sectionissue;


    /**
     * Set sectionissue
     *
     * @param \PS\Bundle\BalanceBudgetBundle\Entity\Section $sectionissue
     * @return Issue
     */
    public function setSectionissue(\PS\Bundle\BalanceBudgetBundle\Entity\Section $sectionissue = null)
    {
        $this->sectionissue = $sectionissue;

        return $this;
    }

    /**
     * Get sectionissue
     *
     * @return \PS\Bundle\BalanceBudgetBundle\Entity\Section 
     */
    public function getSectionissue()
    {
        return $this->sectionissue;
    }
    
    public function getCategory()
    {
        return $this->sectionissue->getCategory();
    }        
    
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $children;

    /**
     * @var \PS\Bundle\BalanceBudgetBundle\Entity\Issue
     */
    private $parent;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->children = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add children
     *
     * @param \PS\Bundle\BalanceBudgetBundle\Entity\Issue $children
     * @return Issue
     */
    public function addChild(\PS\Bundle\BalanceBudgetBundle\Entity\Issue $children)
    {
        $this->children[] = $children;

        return $this;
    }

    /**
     * Remove children
     *
     * @param \PS\Bundle\BalanceBudgetBundle\Entity\Issue $children
     */
    public function removeChild(\PS\Bundle\BalanceBudgetBundle\Entity\Issue $children)
    {
        $this->children->removeElement($children);
    }

    /**
     * Get children
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getChildren()
    {
        return $this->children;
    }

    /**
     * Set parent
     *
     * @param \PS\Bundle\BalanceBudgetBundle\Entity\Issue $parent
     * @return Issue
     */
    public function setParent(\PS\Bundle\BalanceBudgetBundle\Entity\Issue $parent = null)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * Get parent
     *
     * @return \PS\Bundle\BalanceBudgetBundle\Entity\Issue 
     */
    public function getParent()
    {
        return $this->parent;
    }
    /**
     * @var boolean
     */
    private $is_parent;


    /**
     * Set is_parent
     *
     * @param boolean $isParent
     * @return Issue
     */
    public function setIsParent($isParent)
    {
        $this->is_parent = $isParent;

        return $this;
    }

    /**
     * Get is_parent
     *
     * @return boolean 
     */
    public function getIsParent()
    {
        return $this->is_parent;
    }
}

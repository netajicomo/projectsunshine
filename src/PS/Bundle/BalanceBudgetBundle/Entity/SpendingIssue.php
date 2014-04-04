<?php

namespace PS\Bundle\BalanceBudgetBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SpendingIssue
 */
class SpendingIssue
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
    private $is_parent;

    /**
     * @var boolean
     */
    private $is_reduceBy;

    /**
     * @var boolean
     */
    private $is_active;

    /**
     * @var \DateTime
     */
    private $created_at;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $children;

    /**
     * @var \PS\Bundle\BalanceBudgetBundle\Entity\SpendingIssue
     */
    private $parent;

    /**
     * @var \PS\Bundle\BalanceBudgetBundle\Entity\ControlType
     */
    private $controltype;

    /**
     * @var \PS\Bundle\BalanceBudgetBundle\Entity\Section
     */
    private $sectionissue;

    /**
     * @var \PS\Bundle\BalanceBudgetBundle\Entity\Dependency
     */
    private $dependency;

    /**
     * @var \PS\Bundle\BalanceBudgetBundle\Entity\IssueGroup
     */
    private $issuegroup;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->children = new \Doctrine\Common\Collections\ArrayCollection();
    }

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
     * @return SpendingIssue
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
     * @return SpendingIssue
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
     * @return SpendingIssue
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
     * @return SpendingIssue
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
     * @return SpendingIssue
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
     * Set is_parent
     *
     * @param boolean $isParent
     * @return SpendingIssue
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

    /**
     * Set is_reduceBy
     *
     * @param boolean $isReduceBy
     * @return SpendingIssue
     */
    public function setIsReduceBy($isReduceBy)
    {
        $this->is_reduceBy = $isReduceBy;

        return $this;
    }

    /**
     * Get is_reduceBy
     *
     * @return boolean 
     */
    public function getIsReduceBy()
    {
        return $this->is_reduceBy;
    }

    /**
     * Set is_active
     *
     * @param boolean $isActive
     * @return SpendingIssue
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
     * @return SpendingIssue
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
     * Add children
     *
     * @param \PS\Bundle\BalanceBudgetBundle\Entity\Issue $children
     * @return SpendingIssue
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
     * @param \PS\Bundle\BalanceBudgetBundle\Entity\SpendingIssue $parent
     * @return SpendingIssue
     */
    public function setParent(\PS\Bundle\BalanceBudgetBundle\Entity\SpendingIssue $parent = null)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * Get parent
     *
     * @return \PS\Bundle\BalanceBudgetBundle\Entity\SpendingIssue 
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Set controltype
     *
     * @param \PS\Bundle\BalanceBudgetBundle\Entity\ControlType $controltype
     * @return SpendingIssue
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
     * Set sectionissue
     *
     * @param \PS\Bundle\BalanceBudgetBundle\Entity\Section $sectionissue
     * @return SpendingIssue
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

    /**
     * Set dependency
     *
     * @param \PS\Bundle\BalanceBudgetBundle\Entity\Dependency $dependency
     * @return SpendingIssue
     */
    public function setDependency(\PS\Bundle\BalanceBudgetBundle\Entity\Dependency $dependency = null)
    {
        $this->dependency = $dependency;

        return $this;
    }

    /**
     * Get dependency
     *
     * @return \PS\Bundle\BalanceBudgetBundle\Entity\Dependency 
     */
    public function getDependency()
    {
        return $this->dependency;
    }

    /**
     * Set issuegroup
     *
     * @param \PS\Bundle\BalanceBudgetBundle\Entity\IssueGroup $issuegroup
     * @return SpendingIssue
     */
    public function setIssuegroup(\PS\Bundle\BalanceBudgetBundle\Entity\IssueGroup $issuegroup = null)
    {
        $this->issuegroup = $issuegroup;

        return $this;
    }

    /**
     * Get issuegroup
     *
     * @return \PS\Bundle\BalanceBudgetBundle\Entity\IssueGroup 
     */
    public function getIssuegroup()
    {
        return $this->issuegroup;
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
     * @var string
     */
    private $section;

    /**
     * @var string
     */
    private $category;


    /**
     * Set section
     *
     * @param string $section
     * @return SpendingIssue
     */
    public function setSection($section)
    {
        $this->section = $section;

        return $this;
    }

    /**
     * Get section
     *
     * @return string 
     */
    public function getSection()
    {
        return $this->section;
    }

    /**
     * Set category
     *
     * @param string $category
     * @return SpendingIssue
     */
    public function setCategory($category)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return string 
     */
    public function getCategory()
    {
        return $this->category;
    }

    public function __toString()
    {
        return $this->getName();
    }
}

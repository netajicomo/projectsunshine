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
     * @var \PS\Bundle\BalanceBudgetBundle\Entity\Section
     */
    private $section;

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
     * Set section
     *
     * @param \PS\Bundle\BalanceBudgetBundle\Entity\Section $section
     * @return Issue
     */
    public function setSection(\PS\Bundle\BalanceBudgetBundle\Entity\Section $section = null)
    {
        $this->section = $section;

        return $this;
    }

    /**
     * Get section
     *
     * @return \PS\Bundle\BalanceBudgetBundle\Entity\Section 
     */
    public function getSection()
    {
        return $this->section;
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
}

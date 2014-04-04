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
    private $category;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $description;

    /**
     * @var string
     */
    private $option_values;

    /**
     * @var \DateTime
     */
    private $created_at;

    /**
     * @var \PS\Bundle\BalanceBudgetBundle\Entity\SpendingSection
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
     * Set section
     *
     * @param \PS\Bundle\BalanceBudgetBundle\Entity\SpendingSection $section
     * @return SpendingIssue
     */
    public function setSection(\PS\Bundle\BalanceBudgetBundle\Entity\SpendingSection $section = null)
    {
        $this->section = $section;

        return $this;
    }

    /**
     * Get section
     *
     * @return \PS\Bundle\BalanceBudgetBundle\Entity\SpendingSection 
     */
    public function getSection()
    {
        return $this->section;
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

    public function __toString()
    {
        return $this->getName();
    }
}

<?php

namespace PS\Bundle\BalanceBudgetBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SpendingSection
 */
class SpendingSection
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
    private $file;

    /**
     * @var string
     */
    private $video;

    /**
     * @var boolean
     */
    private $is_active;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $issues;

    /**
     * @var \PS\Bundle\BalanceBudgetBundle\Entity\SpendingCategory
     */
    private $category;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->issues = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return SpendingSection
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
     * @return SpendingSection
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
     * @return SpendingSection
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
     * @return SpendingSection
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
     * Set file
     *
     * @param string $file
     * @return SpendingSection
     */
    public function setFile($file)
    {
        $this->file = $file;

        return $this;
    }

    /**
     * Get file
     *
     * @return string 
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * Set video
     *
     * @param string $video
     * @return SpendingSection
     */
    public function setVideo($video)
    {
        $this->video = $video;

        return $this;
    }

    /**
     * Get video
     *
     * @return string 
     */
    public function getVideo()
    {
        return $this->video;
    }

    /**
     * Set is_active
     *
     * @param boolean $isActive
     * @return SpendingSection
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
     * Add issues
     *
     * @param \PS\Bundle\BalanceBudgetBundle\Entity\SpendingIssue $issues
     * @return SpendingSection
     */
    public function addIssue(\PS\Bundle\BalanceBudgetBundle\Entity\SpendingIssue $issues)
    {
        $this->issues[] = $issues;

        return $this;
    }

    /**
     * Remove issues
     *
     * @param \PS\Bundle\BalanceBudgetBundle\Entity\SpendingIssue $issues
     */
    public function removeIssue(\PS\Bundle\BalanceBudgetBundle\Entity\SpendingIssue $issues)
    {
        $this->issues->removeElement($issues);
    }

    /**
     * Get issues
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getIssues()
    {
        return $this->issues;
    }

    /**
     * Set category
     *
     * @param \PS\Bundle\BalanceBudgetBundle\Entity\SpendingCategory $category
     * @return SpendingSection
     */
    public function setCategory(\PS\Bundle\BalanceBudgetBundle\Entity\SpendingCategory $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \PS\Bundle\BalanceBudgetBundle\Entity\SpendingCategory 
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

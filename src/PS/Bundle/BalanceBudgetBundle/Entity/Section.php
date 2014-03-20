<?php

namespace PS\Bundle\BalanceBudgetBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Section
 */
class Section
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
    private $media;

    /**
     * @var boolean
     */
    private $is_active = true;

    /**
     * @var \DateTime
     */
    private $created_at;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $issues;

    /**
     * @var \PS\Bundle\BalanceBudgetBundle\Entity\Category
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
     * @return Section
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
     * @return Section
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
     * @return Section
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
     * @return Section
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
     * Set media
     *
     * @param string $media
     * @return Section
     */
    public function setMedia($media)
    {
        $this->media = $media;

        return $this;
    }

    /**
     * Get media
     *
     * @return string 
     */
    public function getMedia()
    {
        return $this->media;
    }

    /**
     * Set is_active
     *
     * @param boolean $isActive
     * @return Section
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
     * @return Section
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
     * Add issues
     *
     * @param \PS\Bundle\BalanceBudgetBundle\Entity\Issue $issues
     * @return Section
     */
    public function addIssue(\PS\Bundle\BalanceBudgetBundle\Entity\Issue $issues)
    {
        $this->issues[] = $issues;

        return $this;
    }

    /**
     * Remove issues
     *
     * @param \PS\Bundle\BalanceBudgetBundle\Entity\Issue $issues
     */
    public function removeIssue(\PS\Bundle\BalanceBudgetBundle\Entity\Issue $issues)
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
     * @param \PS\Bundle\BalanceBudgetBundle\Entity\Category $category
     * @return Section
     */
    public function setCategory(\PS\Bundle\BalanceBudgetBundle\Entity\Category $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \PS\Bundle\BalanceBudgetBundle\Entity\Category 
     */
    public function getCategory()
    {
        return $this->category;
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
}

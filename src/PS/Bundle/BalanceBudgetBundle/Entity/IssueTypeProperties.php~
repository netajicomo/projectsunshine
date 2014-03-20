<?php

namespace PS\Bundle\BalanceBudgetBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * IssueTypeProperties
 */
class IssueTypeProperties
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
    private $value;

    /**
     * @var boolean
     */
    private $is_active;

    /**
     * @var \DateTime
     */
    private $created_at;

    /**
     * @var \DateTime
     */
    private $updated_at;

    /**
     * @var \PS\Bundle\BalanceBudgetBundle\Entity\IssueType
     */
    private $issuetype;


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
     * @return IssueTypeProperties
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
     * Set value
     *
     * @param string $value
     * @return IssueTypeProperties
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get value
     *
     * @return string 
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set is_active
     *
     * @param boolean $isActive
     * @return IssueTypeProperties
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
     * @return IssueTypeProperties
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
     * Set updated_at
     *
     * @param \DateTime $updatedAt
     * @return IssueTypeProperties
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updated_at = $updatedAt;

        return $this;
    }

    /**
     * Get updated_at
     *
     * @return \DateTime 
     */
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    /**
     * Set issuetype
     *
     * @param \PS\Bundle\BalanceBudgetBundle\Entity\IssueType $issuetype
     * @return IssueTypeProperties
     */
    public function setIssuetype(\PS\Bundle\BalanceBudgetBundle\Entity\IssueType $issuetype = null)
    {
        $this->issuetype = $issuetype;

        return $this;
    }

    /**
     * Get issuetype
     *
     * @return \PS\Bundle\BalanceBudgetBundle\Entity\IssueType 
     */
    public function getIssuetype()
    {
        return $this->issuetype;
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
     * @ORM\PreUpdate
     */
    public function setUpdatedAtValue()
    {
        $this->updated_at = new \DateTime();
    }
    
     public function __toString(){
      // return $this->issuetype;
   }
}

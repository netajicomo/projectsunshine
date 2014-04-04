<?php

namespace PS\Bundle\BalanceBudgetBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * VisitorSpendingActivity
 */
class VisitorSpendingActivity
{

    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $session_id;

    /**
     * @var string
     */
    private $issue_value;

    /**
     * @var integer
     */
    private $issue_percentage;

    /**
     * @var boolean
     */
    private $has_touched;

    /**
     * @var \DateTime
     */
    private $created_at;

    /**
     * @var \PS\Bundle\BalanceBudgetBundle\Entity\SpendingIssue
     */
    private $issue;


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
     * Set session_id
     *
     * @param string $sessionId
     * @return VisitorSpendingActivity
     */
    public function setSessionId($sessionId)
    {
        $this->session_id = $sessionId;

        return $this;
    }

    /**
     * Get session_id
     *
     * @return string 
     */
    public function getSessionId()
    {
        return $this->session_id;
    }

    /**
     * Set issue_value
     *
     * @param string $issueValue
     * @return VisitorSpendingActivity
     */
    public function setIssueValue($issueValue)
    {
        $this->issue_value = $issueValue;

        return $this;
    }

    /**
     * Get issue_value
     *
     * @return string 
     */
    public function getIssueValue()
    {
        return $this->issue_value;
    }

    /**
     * Set issue_percentage
     *
     * @param integer $issuePercentage
     * @return VisitorSpendingActivity
     */
    public function setIssuePercentage($issuePercentage)
    {
        $this->issue_percentage = $issuePercentage;

        return $this;
    }

    /**
     * Get issue_percentage
     *
     * @return integer 
     */
    public function getIssuePercentage()
    {
        return $this->issue_percentage;
    }

    /**
     * Set has_touched
     *
     * @param boolean $hasTouched
     * @return VisitorSpendingActivity
     */
    public function setHasTouched($hasTouched)
    {
        $this->has_touched = $hasTouched;

        return $this;
    }

    /**
     * Get has_touched
     *
     * @return boolean 
     */
    public function getHasTouched()
    {
        return $this->has_touched;
    }

    /**
     * Set created_at
     *
     * @param \DateTime $createdAt
     * @return VisitorSpendingActivity
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
     * Set issue
     *
     * @param \PS\Bundle\BalanceBudgetBundle\Entity\SpendingIssue $issue
     * @return VisitorSpendingActivity
     */
    public function setIssue(\PS\Bundle\BalanceBudgetBundle\Entity\SpendingIssue $issue = null)
    {
        $this->issue = $issue;

        return $this;
    }

    /**
     * Get issue
     *
     * @return \PS\Bundle\BalanceBudgetBundle\Entity\SpendingIssue 
     */
    public function getIssue()
    {
        return $this->issue;
    }
    /**
     * @ORM\PrePersist
     */
    public function setCreatedAtValue()
    {
        // Add your code here
    }
}

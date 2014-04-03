<?php

namespace PS\Bundle\BalanceBudgetBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * VisitorActivity
 */
class VisitorActivity
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
    private $issue_id;

    /**
     * @var string
     */
    private $issue_value;

    /**
     * @var boolean
     */
    private $has_touched;

    /**
     * @var \DateTime
     */
    private $created_at;


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
     * @return VisitorActivity
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
     * Set issue_id
     *
     * @param string $issueId
     * @return VisitorActivity
     */
    public function setIssueId($issueId)
    {
        $this->issue_id = $issueId;

        return $this;
    }

    /**
     * Get issue_id
     *
     * @return string 
     */
    public function getIssueId()
    {
        return $this->issue_id;
    }

    /**
     * Set issue_value
     *
     * @param string $issueValue
     * @return VisitorActivity
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
     * Set has_touched
     *
     * @param boolean $hasTouched
     * @return VisitorActivity
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
     * @return VisitorActivity
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
     * @var integer
     */
    private $issue_percentage;


    /**
     * Set issue_percentage
     *
     * @param integer $issuePercentage
     * @return VisitorActivity
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
}

<?php

namespace PS\Bundle\BalanceBudgetBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PlannerPostCode
 */
class PlannerPostCode
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
    private $post_code;

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
     * @return PlannerPostCode
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
     * Set post_code
     *
     * @param string $postCode
     * @return PlannerPostCode
     */
    public function setPostCode($postCode)
    {
        $this->post_code = $postCode;

        return $this;
    }

    /**
     * Get post_code
     *
     * @return string 
     */
    public function getPostCode()
    {
        return $this->post_code;
    }

    /**
     * Set created_at
     *
     * @param \DateTime $createdAt
     * @return PlannerPostCode
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
        // Add your code here
        if(!$this->getCreatedAt()) {
            $this->created_at = new \DateTime();
        }
    }
}

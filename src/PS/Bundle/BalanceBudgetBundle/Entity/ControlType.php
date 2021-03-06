<?php

namespace PS\Bundle\BalanceBudgetBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ControlType
 */
class ControlType
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
     * @var array
     */
    private $properties;


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
     * @return ControlType
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
     * Set properties
     *
     * @param array $properties
     * @return ControlType
     */
    public function setProperties($properties)
    {
        
     
        
        $this->properties = $properties;

        return $this;
    }

    /**
     * Get properties
     *
     * @return array 
     */
    public function getProperties()
    
    {
            
        return $this->properties;
    }
    
    public function __toString()
    {
          return $this->name;
    }
}

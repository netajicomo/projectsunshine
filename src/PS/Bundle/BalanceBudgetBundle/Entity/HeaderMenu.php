<?php

namespace PS\Bundle\BalanceBudgetBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * HeaderMenu
 */
class HeaderMenu
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $url_type;

    /**
     * @var string
     */
    private $url;

    /**
     * @var string
     */
    private $target;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $children;

    /**
     * @var \PS\Bundle\BalanceBudgetBundle\Entity\HeaderMenu
     */
    private $parent;

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
     * Set title
     *
     * @param string $title
     * @return HeaderMenu
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
     * Set url_type
     *
     * @param string $urlType
     * @return HeaderMenu
     */
    public function setUrlType($urlType)
    {
        $this->url_type = $urlType;

        return $this;
    }

    /**
     * Get url_type
     *
     * @return string 
     */
    public function getUrlType()
    {
        return $this->url_type;
    }

    /**
     * Set url
     *
     * @param string $url
     * @return HeaderMenu
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string 
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set target
     *
     * @param string $target
     * @return HeaderMenu
     */
    public function setTarget($target)
    {
        $this->target = $target;

        return $this;
    }

    /**
     * Get target
     *
     * @return string 
     */
    public function getTarget()
    {
        return $this->target;
    }

    /**
     * Add children
     *
     * @param \PS\Bundle\BalanceBudgetBundle\Entity\HeaderMenu $children
     * @return HeaderMenu
     */
    public function addChild(\PS\Bundle\BalanceBudgetBundle\Entity\HeaderMenu $children)
    {
        $this->children[] = $children;

        return $this;
    }

    /**
     * Remove children
     *
     * @param \PS\Bundle\BalanceBudgetBundle\Entity\HeaderMenu $children
     */
    public function removeChild(\PS\Bundle\BalanceBudgetBundle\Entity\HeaderMenu $children)
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
     * @param \PS\Bundle\BalanceBudgetBundle\Entity\HeaderMenu $parent
     * @return HeaderMenu
     */
    public function setParent(\PS\Bundle\BalanceBudgetBundle\Entity\HeaderMenu $parent = null)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * Get parent
     *
     * @return \PS\Bundle\BalanceBudgetBundle\Entity\HeaderMenu 
     */
    public function getParent()
    {
        return $this->parent;
    }

    public function getName()
    {
        return $this->getTitle();
    }

    public function __toString()
    {
        return $this->getTitle();
    }

}

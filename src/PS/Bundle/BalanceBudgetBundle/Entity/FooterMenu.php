<?php

namespace PS\Bundle\BalanceBudgetBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FooterMenu
 */
class FooterMenu
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
     * @return FooterMenu
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
     * @return FooterMenu
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
     * @return FooterMenu
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
     * @return FooterMenu
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
}

<?php

namespace Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Acme
 *
 * @Entity 
 * @Table(name="acme")
 */
class Acme
{
    /**
     * @var integer
     * 
     * @Column(name="id", type="integer")
     * @Id
     * @GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     * 
     * @Column(name="title", type="string", length=255)
     */
    private $title;

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
     * @return Menu
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
}

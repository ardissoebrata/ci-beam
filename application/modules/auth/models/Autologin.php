<?php

namespace auth\models;

/**
 * @Entity @Table(name="auth_autologin")
 *  
 */
class Autologin
{
	/**
	 * @Column(type="integer")
	 * 
	 * @var integer 
	 */
	protected $id;
	
	/**
	 * @Column(type="string", length=255)
	 * 
	 * @var string
	 */
	protected $series;
	
	/**
	 * @Column(type="string", length=255)
	 * 
	 * @var string
	 */
	protected $key;
	
	/**
	 * @Column(type="datetime")
	 * 
	 * @var DateTime
	 */
	protected $created;

    /**
     * Set id
     *
     * @param integer $id
     * @return Autologin
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
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
     * Set series
     *
     * @param string $series
     * @return Autologin
     */
    public function setSeries($series)
    {
        $this->series = $series;
        return $this;
    }

    /**
     * Get series
     *
     * @return string 
     */
    public function getSeries()
    {
        return $this->series;
    }

    /**
     * Set key
     *
     * @param string $key
     * @return Autologin
     */
    public function setKey($key)
    {
        $this->key = $key;
        return $this;
    }

    /**
     * Get key
     *
     * @return string 
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * Set created
     *
     * @param datetime $created
     * @return Autologin
     */
    public function setCreated($created)
    {
        $this->created = $created;
        return $this;
    }

    /**
     * Get created
     *
     * @return datetime 
     */
    public function getCreated()
    {
        return $this->created;
    }
}
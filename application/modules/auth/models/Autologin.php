<?php

namespace auth\models;

/**
 * @Entity @Table(name="auth_autologin")
 *  
 */
class Autologin
{
	/**
	 * @id @Column(type="integer")
	 * 
	 * @var integer 
	 */
	protected $user;
	
	/**
	 * @id @Column(type="string", length=255)
	 * 
	 * @var string
	 */
	protected $series;
	
	/**
	 * @Column(type="string", length=255)
	 * 
	 * @var string
	 */
	protected $privatekey;
	
	/**
	 * @Column(type="datetime")
	 * 
	 * @var DateTime
	 */
	protected $created;

	public function __construct($user, $series)
	{
		$this->user = $user;
		$this->series = $series;
		$this->created = new \DateTime();
	}
	
    /**
     * Get user
     *
     * @return integer 
     */
    public function getUser()
    {
        return $this->user;
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
     * Set privatekey
     *
     * @param string $key
     * @return Autologin
     */
    public function setPrivatekey($key)
    {
        $this->privatekey = $key;
        return $this;
    }

    /**
     * Get privatekey
     *
     * @return string 
     */
    public function getPrivatekey()
    {
        return $this->privatekey;
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

    /**
     * Set user
     *
     * @param integer $user
     * @return Autologin
     */
    public function setUser($user)
    {
        $this->user = $user;
        return $this;
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
}
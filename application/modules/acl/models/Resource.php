<?php

namespace acl\models;

/**
 * @Entity @Table(name="acl_resources")
 *  
 */
class Resource
{
	const TYPE_MODULE = 'module';
    const TYPE_CONTROLLER = 'controller';
	const TYPE_ACTION = 'action';
	const TYPE_OTHER = 'other';
	
	/**
	 * @id @Column(type="integer") @GeneratedValue
	 * 
	 * @var integer
	 */
	protected $id;
	
	/**
	 * @Column(type="string", length=255, nullable=false)
	 * 
	 * @var string 
	 */
	protected $name;
	
	/**
	 * @Column(type="string", length=50, nullable=false, default='other')
	 * 
	 * @var string 
	 */
	protected $type;
	
	/**
	 * @Column(type="integer")
	 * 
	 * @var integer
	 */
	protected $parent;
	
	/**
	 * @Column(type="datetime")
	 * 
	 * @var DateTime 
	 */
	protected $created;
	
	/**
	 * @Column(type="datetime")
	 * 
	 * @var DateTime
	 */
	protected $modified;
	
	public function __construct()
	{
		$this->created = new \DateTime;
		$this->modified = new \DateTime;
		$this->type = Resource::TYPE_OTHER;
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
     * Set name
     *
     * @param string $name
     * @return Resource
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
     * Set last_name
     *
     * @param string $type
     * @return Resource
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * Get type
     *
     * @return string 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set created
     *
     * @param datetime $created
     * @return Resource
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
     * Set modified
     *
     * @param datetime $modified
     * @return Resource
     */
    public function setModified($modified)
    {
        $this->modified = $modified;
        return $this;
    }

    /**
     * Get modified
     *
     * @return datetime 
     */
    public function getModified()
    {
        return $this->modified;
    }
}
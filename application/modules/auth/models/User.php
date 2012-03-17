<?php

namespace auth\models;

/**
 * @Entity @Table(name="auth_users")
 *  
 */
class User
{
	/**
	 * @id @Column(type="integer") @GeneratedValue
	 * 
	 * @var integer
	 */
	protected $id;
	
	/**
	 * @Column(type="string", length=50)
	 * 
	 * @var string 
	 */
	protected $first_name;
	
	/**
	 * @Column(type="string", length=50)
	 * 
	 * @var string 
	 */
	protected $last_name;
	
	/**
	 * @Column(type="string", length=255, unique=true, nullable=false)
	 * 
	 * @var string
	 */
	protected $username;
	
	/**
	 * @Column(type="string", length=255, unique=true, nullable=false)
	 * 
	 * @var string 
	 */
	protected $email;
	
	/**
	 * @Column(type="string", length=255)
	 * 
	 * @var string
	 */
	protected $password;
	
	/**
	 * @Column(type="string", length=2)
	 * 
	 * @var string
	 */
	protected $lang;
	
	/**
	 * @Column(type="datetime")
	 * 
	 * @var DateTime
	 */
	protected $registered;
	
	public function __construct()
	{
		$this->registered = new \DateTime;
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
     * Set first_name
     *
     * @param string $firstName
     * @return User
     */
    public function setFirstName($firstName)
    {
        $this->first_name = $firstName;
        return $this;
    }

    /**
     * Get first_name
     *
     * @return string 
     */
    public function getFirstName()
    {
        return $this->first_name;
    }

    /**
     * Set last_name
     *
     * @param string $lastName
     * @return User
     */
    public function setLastName($lastName)
    {
        $this->last_name = $lastName;
        return $this;
    }

    /**
     * Get last_name
     *
     * @return string 
     */
    public function getLastName()
    {
        return $this->last_name;
    }

    /**
     * Set username
     *
     * @param string $username
     * @return User
     */
    public function setUsername($username)
    {
        $this->username = $username;
        return $this;
    }

    /**
     * Get username
     *
     * @return string 
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set password
     *
     * @param string $password
     * @return User
     */
    public function setPassword($password)
    {
		if (!empty($password))		// Prevent empty password.
			$this->password = $this->hash($password);
        return $this;
    }

    /**
     * Get password
     *
     * @return string 
     */
    public function getPassword()
    {
        return $this->password;
    }
	
	/**
	 * Set lang
	 * 
	 * @param string $lang
	 * @return User 
	 */
	public function setLang($lang)
	{
		$this->lang = $lang;
		return $this;
	}
	
	/**
	 * Get lang
	 * 
	 * @return string
	 */
	public function getLang()
	{
		return $this->lang;
	}

    /**
     * Set registered
     *
     * @param datetime $registered
     * @return User
     */
    public function setRegistered($registered)
    {
        $this->registered = $registered;
        return $this;
    }

    /**
     * Get registered
     *
     * @return datetime 
     */
    public function getRegistered()
    {
        return $this->registered;
    }
	
    /**
     * Password hashing function
     * 
     * @param string $password
	 * @return string
     */
    public function hash($password) 
	{
		$CI =& get_instance();
        $CI->load->library('PasswordHash', array('iteration_count_log2' => 8, 'portable_hashes' => FALSE));
        
        // hash password
        return $CI->passwordhash->HashPassword($password);
    }
    
    /**
     * Compare user input password to stored hash
     * 
     * @param string $password
	 * @return boolean
     */
    public function check_password($password) 
	{
		$CI =& get_instance();
        $CI->load->library('PasswordHash', array('iteration_count_log2' => 8, 'portable_hashes' => FALSE));
        
        // check password
        return $CI->passwordhash->CheckPassword($password, $this->password);
    }
}
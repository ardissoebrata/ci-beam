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
	 * @Column(type="datetime")
	 * 
	 * @var DateTime
	 */
	protected $registered;
}

<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * User management API.
 * 
 * @package App
 * @category Controller
 * @author Ardi Soebrata
 */
class User extends Admin_Controller 
{
	public function index() 
	{
		echo $this->user_model->datatable();
	}
}
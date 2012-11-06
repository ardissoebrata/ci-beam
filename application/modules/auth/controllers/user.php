<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * User management controller.
 * 
 * @package App
 * @category Controller
 * @author Ardi Soebrata
 */
class User extends Admin_Controller 
{
	/**
	 * User form definition.
	 * 
	 * @var array
	 */
	protected $user_form = array(
		'first_name' => array(
			'label' => 'lang:first_name',
			'rules' => 'trim|max_length[50]|xss_clean',
			'helper' => 'form_inputlabel'
		),
		'last_name' => array(
			'label'	=> 'lang:last_name',
			'rules' => 'trim|max_length[50]|xss_clean',
			'helper' => 'form_inputlabel'
		),
		'id' => array(
			'helper' => 'form_hidden'
		),
		'username' => array(
			'label' => 'lang:username',
			'rules' => 'trim|required|max_length[255]|callback_unique_username|xss_clean',
			'helper' => 'form_inputlabel'
		),
		'email' => array(
			'label' => 'lang:email',
			'rules' => 'trim|required|max_length[255]|valid_email|callback_unique_email|xss_clean',
			'helper' => 'form_emaillabel'
		),
		'password' => array(
			'label' => 'lang:password',
			'rules' => 'trim|matches[confirm-password]',
			'helper' => 'form_passwordlabel',
			'value' => ''
		),
		'confirm-password' => array(
			'label' => 'lang:confirm_password',
			'rules' => 'trim',
			'helper' => 'form_passwordlabel',
			'value' => ''
		),
		'role_id' => array(
			'label' => 'lang:Role',
			'rules' => 'trim',
			'helper' => 'form_dropdownlabel'
		),
		'lang' => array(
			'label'	=> 'lang:language',
			'rules' => 'trim',
			'helper' => 'form_dropdownlabel'
		)
	);
	
	/**
	 * Redirect to index if cancel-button clicked.
	 */
	function __construct()
	{
		parent::__construct();
		
		if ($this->input->post('cancel-button'))
			redirect ('auth/user/index');
		
		$this->load->language('auth');
	}
	
	/**
	 * Display User list. 
	 */
	function index()
	{
		$query = $this->doctrine->em->createQueryBuilder();
		$query->select('u')
				->from('auth\models\user', 'u')
				->orderBy('u.last_name, u.first_name', 'ASC')
				->setFirstResult($this->uri->segment(4))
				->setMaxResults($this->config->item('rows_limit'));

		$paginator = new Doctrine\ORM\Tools\Pagination\Paginator($query);
		$this->data['users'] = $paginator;

		$this->load->library('pagination');
		$config['base_url'] = site_url('auth/user/index');
		$config['total_rows'] = $paginator->count();
		$config['per_page'] = $this->config->item('rows_limit');
		$this->pagination->initialize($config);
		
		$this->template->build('user-list');
	}
	
	function generate_options($tree, $sep = '')
	{
		$result = array();
		foreach($tree as $node)
		{
			$result[$node['id']] = $sep . $node['name'];
			if (isset($node['children']))
				$result = $result + $this->generate_options($node['children'], $sep . '&nbsp;&nbsp;');
		}
		return $result;
	}
	
	/**
	 * Edit User
	 * 
	 * @param integer $id 
	 */
	function edit($id)
	{
		$this->load->library('form_validation');
		$user_form = $this->user_form;
		$user_form['username']['rules'] = "trim|required|max_length[255]|callback_unique_username[$id]|xss_clean";
		$user_form['email']['rules'] = "trim|required|max_length[255]|valid_email|callback_unique_email[$id]|xss_clean";
		$languages = $this->config->item('languages');
		foreach($languages as $code => $language)
			$user_form['lang']['options'][$code] = $language['name'];
		
		$this->load->model('acl/role_model');
		$role_tree = $this->role_model->get_tree();
		$user_form['role_id']['options'] = array(0 => '(' . lang('none') . ')') + $this->generate_options($role_tree);
		
		$this->form_validation->init($user_form);
		
		$user = $this->doctrine->em->find('auth\models\User', $id);
		$this->form_validation->set_default($user);
		
		if ($this->form_validation->run())
		{
			$user = $this->form_validation->set_values();
			$this->doctrine->em->persist($user);
			$this->doctrine->em->flush();
			
			redirect('auth/user');
		}
		
		$this->data['form'] = $this->form_validation;
		$this->template->build('user-form');
	}
	
	/**
	 * Add a new User. 
	 */
	function add()
	{
		$this->load->library('form_validation');
		$user_form = $this->user_form;
		$languages = $this->config->item('languages');
		foreach($languages as $code => $language)
			$user_form['lang']['options'][$code] = $language['name'];
		
		$this->load->model('acl/role_model');
		$role_tree = $this->role_model->get_tree();
		$user_form['role_id']['options'] = array(0 => '(' . lang('none') . ')') + $this->generate_options($role_tree);
		
		$this->form_validation->init($this->user_form);
		
		if ($this->form_validation->run())
		{
			$user = $this->form_validation->set_values(new auth\models\User);
			$this->doctrine->em->persist($user);
			$this->doctrine->em->flush();
			
			redirect('auth/user');
		}
		
		$this->data['form'] = $this->form_validation;
		$this->template->build('user-form');
	}
	
	/**
	 * Delete a User
	 * 
	 * @param integer $id 
	 */
	function delete($id)
	{
		$user = $this->doctrine->em->find('auth\models\User', $id);
		if ($user)
		{
			$this->doctrine->em->remove($user);
			$this->doctrine->em->flush();
		}
		
		redirect('auth/user');
	}
	
	function unique_username($value, $id = 0)
	{
		$query = $this->doctrine->em->createQueryBuilder();
		$query->select('u')
				->from('auth\models\User', 'u')
				->where('u.username = :username AND u.id <> :userid')
				->setParameters(array(
					'username'	=> $value,
					'userid'	=> $id
				));
		try
		{
			$user = $query->getQuery()->getSingleResult();
			$this->form_validation->set_message('unique_username', lang('already_taken'));
			return FALSE;
		}
		catch (Doctrine\ORM\NoResultException $e)
		{
			return TRUE;
		}
	}
	
	function unique_email($value, $id = 0)
	{
		$query = $this->doctrine->em->createQueryBuilder();
		$query->select('u')
				->from('auth\models\User', 'u')
				->where('u.email = :email AND u.id <> :userid')
				->setParameters(array(
					'email'		=> $value,
					'userid'	=> $id
				));
		try
		{
			$email = $query->getQuery()->getSingleResult();
			$this->form_validation->set_message('unique_email', lang('already_taken'));
			return FALSE;
		}
		catch (Doctrine\ORM\NoResultException $e)
		{
			return TRUE;
		}
	}
	
}

/* End of file user.php */
/* Location: ./application/modules/auth/controllers/user.php */
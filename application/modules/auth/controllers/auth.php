<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Authentication controller.
 * 
 * @package App
 * @category Controller
 * @author Ardi Soebrata
 * 
 * @property BeamForm $beamform
 */
class Auth extends Admin_Controller 
{
	protected $user_form = array(
		'first_name' => array(
			'label' => 'First Name',
			'rules' => 'trim|max_length[50]|xss_clean',
			'helper' => 'form_inputlabel'
		),
		'last_name' => array(
			'label'	=> 'Last Name',
			'rules' => 'trim|max_length[50]|xss_clean',
			'helper' => 'form_inputlabel'
		),
		'username' => array(
			'label' => 'Username',
			'rules' => 'trim|required|max_length[255]|xss_clean',
			'helper' => 'form_inputlabel'
		),
		'email' => array(
			'label' => 'Email',
			'rules' => 'trim|required|max_length[255]|valid_email|xss_clean',
			'helper' => 'form_emaillabel'
		),
		'password' => array(
			'label' => 'Password',
			'rules' => 'trim|matches[confirm-password]',
			'helper' => 'form_passwordlabel',
			'value' => ''
		),
		'confirm-password' => array(
			'label' => 'Confirm Password',
			'rules' => 'trim',
			'helper' => 'form_passwordlabel',
			'value' => ''
		)
	);
	
	function __construct()
	{
		parent::__construct();
		
		if ($this->input->post('cancel-button'))
			redirect ('auth/auth/index');
	}
	
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
		$config['base_url'] = site_url('auth/auth/index');
		$config['total_rows'] = $paginator->count();
		$config['per_page'] = $this->config->item('rows_limit');
		$this->pagination->initialize($config);
		
		$this->template->build('user-list');
	}
	
	function edit($id)
	{
		$this->load->library('form_validation');
		$this->form_validation->init($this->user_form);
		
		$user = $this->doctrine->em->find('auth\models\User', $id);
		$this->form_validation->set_default($user);
		
		if ($this->form_validation->run())
		{
			$user = $this->form_validation->set_values();
			$this->doctrine->em->persist($user);
			$this->doctrine->em->flush();
			
			redirect('auth');
		}
		
		$this->data['form'] = $this->form_validation;
		$this->template->build('user-form');
	}
	
	function add()
	{
		$this->load->library('form_validation');
		$this->form_validation->init($this->user_form);
		
		if ($this->form_validation->run())
		{
			$user = $this->form_validation->set_values(new auth\models\User);
			$this->doctrine->em->persist($user);
			$this->doctrine->em->flush();
			
			redirect('auth');
		}
		
		$this->data['form'] = $this->form_validation;
		$this->template->build('user-form');
	}
}

/* End of file auth.php */
/* Location: ./application/modules/auth/controllers/auth.php */
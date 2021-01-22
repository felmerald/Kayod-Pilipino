<?php defined('BASEPATH') OR exit('No direct script access allowed');

 class Admin_controller extends CI_Controller
 {
 	public function __construct()
 	{
 		parent::__construct();
 		$this->load->model(array(
 			'admin_model',
 			'dashboard_model'
 			));
 	}

 	function do_upload()
    {
    	$config = array(
					'upload_path' => './upload/', 
					'allowed_types' => 'gif|jpg|png' 
					);
		$this->load->library('upload', $config); 
								
		if ( ! $this->upload->do_upload())
		{
			$error = array('error' => $this->upload->display_errors());
			return null;							
		}
		else
		{

			$data =  $this->upload->data();
			$file_name = $data['file_name'];
									// We we process the resize image before upload
			$configer = array(
						'image_library' => 'gd2',
                        'source_image' => $data['full_path'],
                        'create_thumb' => FALSE,
                        'maintain_ratio' => TRUE,
                        'quality' => '70%', 
                        'width' => 640,
                        'height' => 480,
						);
			$this->image_lib->clear();
			$this->image_lib->initialize($configer);
			$this->image_lib->resize();

			return $file_name;
   		 }
 	}
 	public function index()
 	{
 		
	 		$data = array(
						'title'	=>	'Kayod pilipino :: Administrator Login'
					);
	 		$this->load->view('includes/admin/session_in_login');
			$this->load->view('includes/header/login_head',$data);
			$this->load->view('admin/index');
			$this->load->view('includes/footer/login_foot');
		
 	}

 	public function view_dashboard()
 	{
 		if(!empty($this->session->userdata('login_id')) 
 				 && $this->session->userdata('login') == TRUE)
		{
			

	 		$data = array(
						'title'	=>	'Admin :: Dashoard',
						'job' =>	$this->dashboard_model->get_list_job(),
						'account_info' => $this->dashboard_model->get_account(),
						'user_account' => $this->dashboard_model->get_users(),
						'count_users'  => $this->dashboard_model->count_all_users(),
						);
	 		$this->load->view('includes/admin/session_in_dashboard');
			$this->load->view('includes/header/adminheader',$data);
			$this->load->view('admin/dashboard');
			$this->load->view('admin/modal');
			$this->load->view('includes/footer/adminfooter');

			
		}
		else
		{
			redirect(base_url().'admin/login');
			exit();
		}
 	}

 	public function add_employee_record()
 	{
 		if(!empty($this->session->userdata('login_id')) 
 				 && $this->session->userdata('login') == TRUE)
		{
			$data = array(
						'job' =>	$this->dashboard_model->get_list_job(),
						'title'	=>	'Admin :: Add Employee'
						);
			$this->load->view('includes/admin/session_in_dashboard');
			$this->load->view('includes/header/adminheader',$data);
			$this->load->view('admin/add_employee');
			$this->load->view('includes/footer/adminfooter');
		}
		else
		{
			redirect(base_url().'admin/login');
		}
 	}
 	
 	public function view_leave()
 	{
 		if(!empty($this->session->userdata('login_id')) 
 				 && $this->session->userdata('login') == TRUE)
		{
	 		$data = array(
						'title'	=>	'Admin :: Leave',
						'get_requested' => $this->dashboard_model->get_all_employees_resquest()
						);
	 		$this->load->view('includes/admin/session_in_dashboard');
			$this->load->view('includes/header/adminheader',$data);
			$this->load->view('admin/leave');
			$this->load->view('includes/footer/adminfooter');
		}
		else
		{
			redirect(base_url().'admin/login');
			exit();
		}
 	}
 	public function view_overtime()
 	{
 		if(!empty($this->session->userdata('login_id')) 
 				 && $this->session->userdata('login') == TRUE)
		{
	 		$data = array(
						'title'	=>	'Admin :: Overtime',
						'get_overtime_list' => $this->dashboard_model->get_all_employee_overtime()
						);
	 		$this->load->view('includes/admin/session_in_dashboard');
			$this->load->view('includes/header/adminheader',$data);
			$this->load->view('admin/overtime');
			$this->load->view('includes/footer/adminfooter');
		}
		else
		{
			redirect(base_url().'admin/login');
			exit();
		}
 	}
 	public function view_undertime()
 	{
 		if(!empty($this->session->userdata('login_id')) 
 				 && $this->session->userdata('login') == TRUE)
		{
	 		$data = array(
						'title'	=>	'Admin :: Undertime',
						'get_undertime_list' => $this->dashboard_model->get_all_employee_undertime()
						);
	 		$this->load->view('includes/admin/session_in_dashboard');
			$this->load->view('includes/header/adminheader',$data);
			$this->load->view('admin/undertime');
			$this->load->view('includes/footer/adminfooter');
		}
		else
		{
			redirect(base_url().'admin/login');
			exit();
		}
 	}
 	public function view_files()
 	{
 		if(!empty($this->session->userdata('login_id')) 
 				 && $this->session->userdata('login') == TRUE)
		{
	 		$data = array(
						'title'	=>	'Admin :: Images',
						'get_documents' => $this->dashboard_model->get_all_document()
						);
	 		$this->load->view('includes/admin/session_in_dashboard');
			$this->load->view('includes/header/adminheader',$data);
			$this->load->view('admin/files');
			$this->load->view('includes/footer/adminfooter');
		}
		else
		{
			redirect(base_url().'admin/login');
			exit();
		}
 	}

 	public function view_register()
 	{
 		$data = array(
					'title'	=>	'Kayod pilipino :: Administrator Register'
				);
 		$this->load->view('includes/admin/session_in_dashboard');
		$this->load->view('includes/header/login_head',$data);
		$this->load->view('admin/register');
		$this->load->view('includes/footer/login_foot');
 	}

 	public function view_search_result()
 	{
 		if(!empty($this->session->userdata('login_id')) 
 				 && $this->session->userdata('login') == TRUE)
		{
	 		$search_term = $this->input->post('userprofile');
	 		$data['get_result'] = $this->dashboard_model->show_search_result($search_term);
	 		$this->load->view('admin/search/result',$data);
	 	}
		else
		{
			redirect(base_url().'admin/login');
			exit();
		}
 	}

 	public function get_user_search()
 	{
 		if(!empty($this->session->userdata('login_id')) 
 				 && $this->session->userdata('login') == TRUE)
		{
 			$this->load->view('admin/search/viewed');
 		}
		else
		{
			redirect(base_url().'admin/login');
			exit();
		}
 	}
 	/**
 	*	Function name : register
 	*	Description   : register admin and filter with xss_clean to avoid malicious data or mysql 	 					 injecttion
 	*	@return 	  :	String
 	* 	@param 		  :	NULL
 	* 	@access public
 	*/ 
 	public function register()
 	{
 		$config = array(
 				array(
 					'field'	=>	'email',
 					'label'	=>	'Email Address',
 					'rules'	=>	'trim|valid_email|is_unique[kp_users.email]'
 					),
 				array(
 					'field'	=>	'password',
 					'label'	=>	'Password',
 					'rules' =>	'trim|min_length[6]'
 					),
 				array(
 					'field'	=>	'cpassword',
 					'label'	=>	'Confirm Password',
 					'rules'	=>	'trim|matches[password]'
 					)
 			);
 		$this->form_validation->set_rules($config);
 		if($this->form_validation->run() == FALSE)
 		{
 			$this->view_register();
 		}
 		else
 		{
 			$data = $this->input->post(NULL, TRUE);
 			$this->admin_model->register($data['email'],$data['password']);

 			$this->session->set_flashdata(array(
 				'success' => '<div class="alert alert-success">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								<strong>Success</strong> Data Successfully Register
							</div>'
 				));
 			redirect(base_url().'admin/register/form');
 			exit();

 		}
 	}
 	/**
 	*	@param 	: NULL
 	* 	@return : Data
 	*	@access public
 	* 	Function name : check_login
 	* 	Description   : Check User data for login authentication  and filter with xss_clean
 	*/ 
 	public function check_login()
 	{
 		$config = array(
					array('field'=>'email','rules'=>'trim'),
					array('field'=>'password','rules'=>'trim')
				);
		$this->form_validation->set_rules($config);
		$this->form_validation->run();

 		$data = $this->input->post(NULL, TRUE);
 		$this->admin_model->check_login($data['email'],$data['password']);
 	}
 	/**
 	*	@param 	: NULL
 	* 	@return : Data
 	*	@access private
 	* 	Function name : destroying_session
 	* 	Description   : destroy session
 	*/ 
 	public function destroying_session()
 	{
 		$data = array(
 				'last_login' => date('Y-m-d H:i:s', time())
 				);
 		$this->db->where('user_id',$this->session->userdata('login_id'))
 				 ->update('kp_users',$data);

 				$config = array(
 							'login_id' => '',
							'login_email' => '',
							'login_password'=> '',
							'login'=>''
 						);
 				$this->session->unset_userdata($config);
				$this->session->sess_destroy();
				redirect(base_url().'admin/login');
				exit();
 	}


 	public function add_employed_user()
 	{	
 		$config = array(
 					array(
 							'field'	=>	'email',
 							'label'	=>	'Email Address',
 							'rules' =>	'valid_email|is_unique[kp_users.email]'
 						)
 				);
 		$this->form_validation->set_rules($config);
 		if($this->form_validation->run() == FALSE)
 		{
 			$this->add_employee_record();
 		}
 		else
 		{
	 		$image = $this->do_upload();
	 		$data = $this->input->post(NULL, TRUE);
	 		$this->dashboard_model->add_employed_user(
	 								$image,
	 								$data['first_name'],
	 								$data['last_name'],
	 								$data['middle_name'],
	 								$data['birthday'],
	 								$data['gender'],
	 								$data['address'],
	 								$data['contact_number'],
	 								$data['status'],
	 								$data['phil_health_number'],
	 								$data['sss_number'],
	 								$data['job_position_id'],
	 								$data['email'],
	 								$data['password'],
	 								$data['company_id']
	 								);
	 		$this->session->set_flashdata(array(
	 				'success' => '<div class="alert alert-success">
									<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
									<strong>Success!</strong> Add Success
								</div>'
	 						));
	 		redirect(base_url().'admin/employee/add_worker');
	 		exit();
 		}
 		

 	}



 }
<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
*	Class Name 	: 	User_Controller
*	@author 	:	Kayod Pilipino
* 	Description :	Shows All Front End UI and Quiries
*/ 
class User_controller extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model(array('user_model'));
	}
	/**
	*	Function name 	:	index
	*	Location 		:	kayod_pilipino/application/views/user/index.php
	* 	Description 	:	Display Login Page for User
	*	@param 			:	NULL
	*	@access public
	*/ 
	public function index()
	{	
		$data = array(
					'title'	=>	'Kayod pilipino :: Log In Access'
				);
		$this->load->view('includes/user/session_in_login');
		$this->load->view('includes/header/login_head',$data);
		$this->load->view('user/index');
		$this->load->view('includes/footer/login_foot');
	}
	/**
	*	Function name 	:	index
	*	Location 		:	kayod_pilipino/application/views/user/forgot_password.php
	* 	Description 	:	Display Login Page for Forgot password
	*	@param 			:	NULL
	*	@access public
	*/ 
	public function get_forget_password()
	{
		$data = array(
					'title'	=>	'Kayod pilipino :: Forgot Password'
				);
		$this->load->view('includes/header/login_head',$data);
		$this->load->view('user/forgot_password');
		$this->load->view('includes/footer/login_foot');
	}
	/**
	*	Function name 	:	get_homepage
	*	Location 		:	kayod_pilipino/application/views/user/home.php
	*	Description 	:	Display User Dashboard
	*	@param 			: 	NULL
	*	@access private
	*/ 
	public function get_homepage()
	{
		if(!empty($this->session->userdata('login_id')) 
 				 && $this->session->userdata('login') == TRUE)
		{
			$data = array(
						'title'	=>	'Employee :: homepage',
						'get_user_info' => $this->user_model->get_user_information(),
						
					);
			$this->load->view('includes/user/session_in_dashboard');
			$this->load->view('includes/header/header',$data);
			$this->load->view('user/home');
			$this->load->view('includes/footer/footer');
		}
		else
		{
			redirect(base_url().'index');
			exit();
		}
		
	}
	/**
	*	Function name 	:	view_leave
	*	Location 		:	kayod_pilipino/application/views/user/menu/leave.php
	*	Description 	:	Display User Leave
	*	@param 			:	NULL
	*	@access private
	*/ 
	public function view_leave()
	{

		if(!empty($this->session->userdata('login_id')) 
 				 && $this->session->userdata('login') == TRUE)
		{

			$data = array(
						'title'	=>	'Employee :: Leave',
						'get_user_info' => $this->user_model->get_user_information(),
						'get_leave'	=>	$this->user_model->get_leave_type(),
						'get_leave_request' => $this->user_model->get_employee_request_leave()
					);
			$this->load->view('includes/user/session_in_dashboard');
			$this->load->view('includes/header/header',$data);
			$this->load->view('user/menu/leave');
			$this->load->view('includes/footer/footer');
		}
		else
		{
			redirect(base_url().'index');
			exit();
		}
	}

	/**
	*	Function name 	:	view_overtime
	*	Location 		:	kayod_pilipino/application/views/user/menu/view_overtime.php
	*	Description 	:	Display User overtime
	*	@param 			:	NULL
	*	@access private
	*/ 
	public function view_overtime()
	{
		if(!empty($this->session->userdata('login_id')) 
 				 && $this->session->userdata('login') == TRUE)
		{
			$data = array(
						'title'	=>	'Employee :: Overtime',
						'get_user_info' => $this->user_model->get_user_information(),
						'get_overtime' => $this->user_model->get_ovetime_list(),
					);
			$this->load->view('includes/user/session_in_dashboard');
			$this->load->view('includes/header/header',$data);
			$this->load->view('user/menu/overtime');
			$this->load->view('includes/footer/footer');
		}
		else
		{
			redirect(base_url().'index');
			exit();
		}
	}
	/**
	*	Function name 	:	view_overtime
	*	Location 		:	kayod_pilipino/application/views/user/menu/view_undertime.php
	*	Description 	:	Display User undertime
	*	@param 			:	NULL
	*	@access private
	*/ 
	public function view_undertime()
	{
		if(!empty($this->session->userdata('login_id')) 
 				 && $this->session->userdata('login') == TRUE)
		{
			$data = array(
						'title'	=>	'Employee :: Undertime',
						'get_user_info' => $this->user_model->get_user_information(),
						'get_undertime' => $this->user_model->get_employee_undertime()
					);
			$this->load->view('includes/user/session_in_dashboard');
			$this->load->view('includes/header/header',$data);
			$this->load->view('user/menu/undertime');
			$this->load->view('includes/footer/footer');
		}
		else
		{
			redirect(base_url().'index');
			exit();
		}	
	}
	/**
	*	Function name 	:	view_documents
	*	Location 		:	kayod_pilipino/application/views/user/menu/view_documents.php
	*	Description 	:	Display User scanned documents
	*	@param 			:	NULL
	*	@access private
	*/ 
	public function view_documents()
	{
		if(!empty($this->session->userdata('login_id')) 
 				 && $this->session->userdata('login') == TRUE)
		{
			$data = array(
						'title'	=>	'Employee :: Documents',
						'get_user_info' => $this->user_model->get_user_information(),
						'get_documents' => $this->user_model->get_documents_upload()
					);
			$this->load->view('includes/user/session_in_dashboard');
			$this->load->view('includes/header/header',$data);
			$this->load->view('user/menu/documents');
			$this->load->view('includes/footer/footer');
		}
		else
		{
			redirect(base_url().'index');
			exit();
		}	
	}
	/**
	*	Function name 	:	view_employees
	*	Location 		:	kayod_pilipino/application/views/user/menu/view_employees.php
	*	Description 	:	Display User employees search result
	*	@param 			:	NULL
	*	@access private
	*/ 
	public function view_employees()
	{
		if(!empty($this->session->userdata('login_id')) 
 				 && $this->session->userdata('login') == TRUE)
		{
			$data = array(
						'title'	=>	'Employees',
						'get_user_info' => $this->user_model->get_user_information()
					);
			$this->load->view('includes/user/session_in_dashboard');
			$this->load->view('includes/header/header',$data);
			$this->load->view('user/employees');
			$this->load->view('includes/footer/footer');
		}
		else
		{
			redirect(base_url().'index');
			exit();
		}
	}
	/**
	*	Function name 	:	view_request
	*	Location 		:	kayod_pilipino/application/views/user/menu/request.php
	*	Description 	:	Display User employee application request
	*	@param 			:	NULL
	*	@access private
	*/ 
	public function view_request()
	{
		if(!empty($this->session->userdata('login_id')) 
 				 && $this->session->userdata('login') == TRUE)
		{
			$data = array(
						'title'	=>	'Employees :: Application Request',
						'get_all_request' => $this->user_model->get_all_leave_request()
					);
			$this->load->view('includes/user/session_in_dashboard');
			$this->load->view('includes/header/header',$data);
			$this->load->view('user/request');
			$this->load->view('includes/footer/footer');
		}
		else
		{
			redirect(base_url().'index');
			exit();
		}
	}
}
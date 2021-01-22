<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}
	/**
	*	@param : $email , $password
	* 	@return : data
	*/ 
	function register($email, $password)
	{	$com_id = random_string('numeric',11);
		$data = array(
			'email'	=>	$email,
			'password'	=> sha1(sha1($password)),
			'created' => date('Y-m-d H:i:s', time()),
			'role'	=>	'admin',
			'company_id' => $com_id,
			'hired_date' => date('Y-m-d')
			);
		$this->db->insert('kp_users', $data);
		return TRUE;
	}
	/**
	*	@param $email, $password
	*	@return data
	*/ 
	function check_login($email, $password)
	{
		$data = array(
				'email'=>$email,
				'password'=>sha1(sha1($password)),
				'role'=>'admin'
				);
		$query = $this->db->get_where('kp_users', $data);
		if($query->num_rows() != 0 )
		{
			foreach($query->result() as $row)
			{	
					$sessionData = array(
						'login_id'		=>	$row->user_id,
						'login_email'	=>	$row->email,
						'login_password'=>	$row->password,
						'login'			=>	TRUE
						);
					$this->session->set_userdata($sessionData);
					redirect(base_url().'admin/dashboard');
					exit();
			}
		}
		else
		{
			$this->session->set_flashdata(
					array(
						'invalid'	=>	'<div class="alert alert-danger">
										<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
										<strong>Error!</strong> Email or Password Invalid
										</div>'	
						 )
				);
			redirect(base_url().'admin/login');
			exit();
		}
	}
}
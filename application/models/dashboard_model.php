<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_model extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
	}

	function get_list_job()
	{
		$query = $this->db->get('job_position');
		if($query && $query->num_rows() > 0 )
			return $query->result();
		else
			return;
	}

	function get_users()
	{
		$query = $this->db->query('SELECT user_id, company_id, hired_date, image, first_name, last_name, middle_name, birthday, address, contact_number, status, gender, role, phil_health_number, sss_number, job_position_id, created, email, password, position_title, leave_availability_hrs
								   FROM kp_users 
								   LEFT JOIN  job_position 
								   ON job_position.job_id = kp_users.job_position_id
								   WHERE role = "user" ');
		if($query && $query->num_rows() > 0 )
			return $query->result();
		else
			return;
	}

	function get_account()
	{
		$query = $this->db->query('SELECT user_id, first_name, last_name, middle_name, birthday, address, contact_number, phil_health_number, sss_number, gender, image, role, company_id, last_login 
								  FROM kp_users
								  WHERE user_id = '.$this->session->userdata('login_id').'');
		if($query && $query->num_rows() > 0 )
			return $query->result();
		else
			return;
	}

	function count_all_users()
	{
		$this->db->select('user_id')
				 ->where('role','user');
		return $this->db->count_all_results('kp_users');
	}
	function add_employed_user($image, $first_name, $last_name, $middle_name, $birthday, $gender, $address, $contact_number, $status, $phil_health_number, $sss_number, $job_position_id, $email, $password, $company_id)
	{
		$data = array(
				'image'			=>  $image,
				'first_name'	=>	$first_name,
				'last_name'		=>	$last_name,
				'middle_name'	=>	$middle_name,
				'birthday'		=>	$birthday,
				'gender'		=>	$gender,
				'address'		=>	$address,
				'contact_number'=>	$contact_number,
				'status'		=>	$status,
				'phil_health_number'=>$phil_health_number,
				'sss_number'	=>	$sss_number,
				'job_position_id'=>	$job_position_id,
				'email'			=>	$email,
				'password'		=>	sha1(sha1($password)),
				'created'		=>	date('Y-m-d H:i:s', time()),
				'role'			=>	'user',
				'hired_date'	=>	date('Y-m-d H:i:s', time()),
				'company_id'	=>	$company_id,
				'leave_availability_hrs'=>120
				);
		$this->db->insert('kp_users',$data);
		return TRUE;
	}

	function update_admin_account($first_name, $last_name, $middle_name, $birthday, $gender, $address, $contact_number, $status, $phil_health_number, $sss_number, $job_position_id)
	{

		$data = array(
				'first_name'	=>	$first_name,
				'last_name'		=>	$last_name,
				'middle_name'	=>	$middle_name,
				'birthday'		=>	$birthday,
				'gender'		=>	$gender,
				'address'		=>	$address,
				'contact_number'=>	$contact_number,
				'status'		=>	$status,
				'phil_health_number'=> $phil_health_number,
				'sss_number'	=>	$sss_number,
				'job_position_id'=> $job_position_id,
				'modified'		=>  date('Y-m-d H:i:s', time())

			);
		$this->db->where('user_id',$this->session->userdata('login_id'))
				 ->update('kp_users',$data);
				 return TRUE;
	}

	function get_upload_update($image)
	{
		if(empty($image))
		{
			$data = array(
						'modified'	=>  date('Y-m-d H:i:s', time())					
					);
			$this->db->where('user_id',$this->session->userdata('login_id'))
				 	 ->update('kp_users',$data);
				 	 return TRUE;
		}
		else
		{
			$data = array(
					'image' => $image,
					'modified'	=>  date('Y-m-d H:i:s', time())	
					);
			$this->db->where('user_id',$this->session->userdata('login_id'))
					 ->update('kp_users',$data);
					 return TRUE;
		}
	}

	function update_employees_record($image, $user_id, $first_name, $last_name, $middle_name, $birthday, $gender, $address, $contact_number, $status, $phil_health_number, $sss_number, $job_position_id)
	{
		if(empty($image))
		{
			$data = array(
						'first_name'	=>	$first_name,
						'last_name'		=>	$last_name,
						'middle_name'	=>	$middle_name,
						'birthday'		=>	$birthday,
						'gender'		=>	$gender,
						'address'		=>	$address,
						'contact_number'=>	$contact_number,
						'status'		=>	$status,
						'phil_health_number'=>$phil_health_number,
						'sss_number'	=>	$sss_number,
						'job_position_id'=>$job_position_id,
						'modified'		=>	date('Y-m-d H:i:s', time())	
					);
			$this->db->where('user_id',$user_id)->update('kp_users',$data);
			return TRUE;
		}
		else
		{
			$data = array(
						'image'			=>	$image,
						'first_name'	=>	$first_name,
						'last_name'		=>	$last_name,
						'middle_name'	=>	$middle_name,
						'birthday'		=>	$birthday,
						'gender'		=>	$gender,
						'address'		=>	$address,
						'contact_number'=>	$contact_number,
						'status'		=>	$status,
						'phil_health_number'=>$phil_health_number,
						'sss_number'	=>	$sss_number,
						'job_position_id'=>$job_position_id,
						'modified'		=>	date('Y-m-d H:i:s', time())	
					);
			$this->db->where('user_id',$user_id)->update('kp_users',$data);
			return TRUE;
		}
	}

	function delete_employee_record($id)
	{
		$this->db->where('user_id',$id)
				  ->delete('kp_users');
				  return TRUE;
	}

	function show_search_result($search_term ='')
	{
		$this->db->select('first_name, last_name, middle_name, company_id, image, user_id')
				 ->from('kp_users')
				 ->like('first_name',$search_term,'both')
				 ->or_like('last_name',$search_term,'both')
				 ->or_like('middle_name',$search_term,'both')
				 ->or_like('company_id',$search_term,'both');
		$query = $this->db->get();
		return $query;
	}

	function get_all_employees_resquest()
	{
		$this->db->select('kpl_id, leave_type_id, kp_leave.created AS filed_on, leave_hours_perday, first_name, last_name, middle_name, address, gender, leave_type, request_status, leave_start_date, leave_end_date')
				 ->from('kp_leave')
				 ->join('kp_users','kp_users.user_id = kp_leave.user_id','left')
				 ->join('add_leave','add_leave.leave_id = kp_leave.leave_type_id','left')
				 ->order_by('kp_leave.created','DESC');
				 $query = $this->db->get();
				 if($query && $query->num_rows() > 0 )
					return $query->result();
				else
					return;
	}

	function get_all_employee_overtime()
	{
		$this->db->select('ot_id, ot_date, ot_number_of_hours, ot_status, request_on, first_name, last_name, middle_name')
				 ->from('request_overtime')
				 ->join('kp_users','kp_users.user_id = request_overtime.user_id','left')
				 ->order_by('request_on','DESC');
				$query = $this->db->get();
				 if($query && $query->num_rows() > 0 )
					return $query->result();
				else
					return;
	}
	function get_all_employee_undertime()
	{
		$this->db->select('undertime_id, undertime_date, undertime_number_hours, first_name, last_name, middle_name, undertime_requested_on, undertime_status')
				 ->from('request_undertime')
				 ->join('kp_users','kp_users.user_id = request_undertime.user_id','left')
				 ->order_by('undertime_requested_on','DESC');
				 $query = $this->db->get();
				 if($query && $query->num_rows() > 0 )
					return $query->result();
				else
					return;

	}

	function approve_employee_undertime($undertime_id)
	{
		$data = array('undertime_status' => 'accept');
		$this->db->where('undertime_id',$undertime_id)
				 ->update('request_undertime', $data);
				 return TRUE;
	}
	function deactivate_approve_employee_undertime($undertime_id)
	{
		$data = array('undertime_status' => 'pending');
		$this->db->where('undertime_id',$undertime_id)
				 ->update('request_undertime', $data);
				 return TRUE;
	}
	function approve_overtime($ot_id)
	{
		$data = array('ot_status'=>'accept');
		$this->db->where('ot_id', $ot_id)
				 ->update('request_overtime',$data);
				 return TRUE;
	}

	function deactivate_approve_overtime($ot_id)
	{
		$data = array('ot_status'=>'pending');
		$this->db->where('ot_id', $ot_id)
				 ->update('request_overtime',$data);
				 return TRUE;
	}

	function activate_leave($kpl_id)
	{
		$data = array('request_status'=>'accept');
		$this->db->where('kpl_id',$kpl_id)
				 ->update('kp_leave',$data);
				 return TRUE;
	}

	function deactivate_leave($kpl_id)
	{
		$data = array('request_status'=>'pending');
		$this->db->where('kpl_id',$kpl_id)
				 ->update('kp_leave',$data);
				 return TRUE;
	}
	
	function get_all_document()
	{
		$this->db->select('document_id, document_image, document_type, first_name, last_name, middle_name, kp_documents.created AS dates')
				 ->from('kp_documents')
				 ->join('kp_users','kp_users.user_id = kp_documents.user_id','left')
				 ->order_by('kp_documents.created','DESC');
				 $query = $this->db->get();
				if($query && $query->num_rows() > 0 )
					return $query->result();
				else
					return;
	}
}
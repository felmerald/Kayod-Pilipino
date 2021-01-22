<?php defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	function check_login_authentication($email, $password)
	{
		$data = array(
				'email'=>$email,
				'password'=>sha1(sha1($password)),
				'role'=>'user'
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
					redirect(base_url().'user/home');
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
			redirect(base_url().'index');
			exit();
		}
	}

	function get_user_information()
	{
		$query = $this->db->query('SELECT user_id, company_id, hired_date, image, first_name, last_name, middle_name, birthday, contact_number, status, gender, role, phil_health_number, sss_number, job_position_id, created, modified, email, last_login, address, position_title
								  FROM kp_users
								  LEFT JOIN job_position
								  ON job_position.job_id = kp_users.job_position_id
								  WHERE user_id ='.$this->session->userdata('login_id').'');
		if($query && $query->num_rows() > 0 )
			return $query->result();
		else
			return;
	}

	function get_leave_type()
	{
		$query = $this->db->get('add_leave');
		if($query && $query->num_rows() > 0 )
			return $query->result();
		else
			return;
	}
	function update_user_picture($image)
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

	function request_user_leave($user_id, $leave_reason, $leave_type_id, $leave_start_date, $leave_end_date, $leave_hours_perday)
	{
		$data = array(
				'user_id'	=>	$user_id,
				'leave_reason'=> $leave_reason,
				'leave_type_id' => $leave_type_id,
				'leave_start_date' => $leave_start_date,
				'leave_end_date' => $leave_end_date,
				'leave_hours_perday' => $leave_hours_perday,
				'created' => date('Y-m-d H:i:s', time()),
				'request_status' => 'pending',	
				);
		$this->db->insert('kp_leave',$data);
		return TRUE;
	}

	function get_employee_request_leave()
	{
		$query = $this->db->query('SELECT kp_leave.user_id AS kp_leave_user_id, leave_reason, leave_type_id, leave_start_date, leave_end_date, leave_hours_perday, kp_leave.created, kp_leave.modified, leave_type, kp_users.user_id AS kpu_id, leave_availability_hrs, add_leave.type AS add_leave_type, leave_id, request_status
								   FROM kp_leave 
								   LEFT JOIN add_leave 
								   ON add_leave.leave_id = kp_leave.leave_type_id
								   LEFT JOIN kp_users
								   ON kp_users.user_id = kp_leave.user_id
								   WHERE request_status = "accept"
								   AND kp_leave.user_id = '.$this->session->userdata('login_id').'');
		if($query && $query->num_rows() > 0 )
			return $query->result();
		else
			return;
	}
	// Select ALL employee request
	function get_all_leave_request()
	{
		$this->db->select('kpl_id, leave_type_id, kp_leave.created AS filed_on, leave_hours_perday, first_name, last_name, middle_name, leave_type, request_status')
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

	function request_employee_overtime($user_id, $ot_date, $ot_number_of_hours)
	{
		$data = array(
					'user_id' => $user_id,
					'ot_date' => $ot_date,
					'ot_number_of_hours' => $ot_number_of_hours,
					'request_on'=> date('Y-m-d H:i:s', time()),
					'ot_status' => 'pending'
				);
		$this->db->insert('request_overtime',$data);
		return TRUE;
	}

	function get_ovetime_list()
	{
		$this->db->select('ot_id, ot_date, user_id, ot_number_of_hours, ot_status, ot_accepted_on')
						 ->from('request_overtime')
						 ->where('ot_status','accept')
						 ->where('user_id',$this->session->userdata('login_id'))
						 ->order_by('ot_accepted_on','DESC');
		$query = $this->db->get();
		if($query && $query->num_rows() > 0 )
			return $query->result();
		else
			return;
	}
	
	function request_employee_undertime($user_id, $undertime_date, $undertime_number_hours)
	{
		$data = array(
					'user_id'	=> $user_id,
					'undertime_date' => $undertime_date,
					'undertime_number_hours' => $undertime_number_hours,
					'undertime_status' => 'pending',
					'undertime_requested_on' => date('Y-m-d H:i:s', time())
				);
		$this->db->insert('request_undertime',$data);
		return TRUE;
	}

	function get_employee_undertime()
	{
		$this->db->select('undertime_id, user_id, undertime_date, undertime_number_hours, undertime_accepted_on, undertime_status')
						  ->from('request_undertime')
						  ->where('undertime_status','accept')
						  ->where('user_id',$this->session->userdata('login_id'))
						  ->order_by('undertime_accepted_on', 'DESC');
		$query = $this->db->get();
		if($query && $query->num_rows() > 0 )
			return $query->result();
		else
			return;
	}

	function employee_upload_documents($image, $user_id, $document_type)
	{
		$data = array(
					'document_image' => $image,
					'user_id' => $user_id,
					'created' => date('Y-m-d H:i:s', time()),
					'document_type' => $document_type,
				);
		$this->db->insert('kp_documents',$data);
		return TRUE;
	}

	function get_documents_upload()
	{
		$this->db->select('document_id, document_image, created, modified, user_id')
				 ->from('kp_documents')
				 ->where('user_id',$this->session->userdata('login_id'))
				 ->order_by('created','DESC');
		$query = $this->db->get();
		if($query && $query->num_rows() > 0 )
			return $query->result();
		else
			return;

	}

	function update_employee_documents($image)
	{
		if(empty($image))
		{
			$data = array(
					'modified' => date('Y-m-d H:i:s', time())
				);
			$this->db->where('user_id',$this->session->userdata('login_id'));
			$this->db->update('kp_documents', $data);
			return TRUE;
		}
		else
		{
			$data = array(
					'modified' => date('Y-m-d H:i:s', time()),
					'document_image' => $image
				);
			$this->db->where('user_id',$this->session->userdata('login_id'));
			$this->db->update('kp_documents', $data);
			return TRUE;

		}
	}

	function delete_document($id)
	{
		$this->db->where('document_id', $id)
				->delete('kp_documents');
				return TRUE;
	}

	
}
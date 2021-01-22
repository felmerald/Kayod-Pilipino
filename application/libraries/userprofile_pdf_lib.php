<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Userprofile_pdf_lib
{

	public function __construct()
	{
		$this->CI =& get_instance();
	}

	function view_user_profile($id)
	{

		$this->CI->db->select('user_id, first_name, last_name, middle_name, birthday, address, contact_number, phil_health_number, sss_number, gender, image, role, company_id, job_position_id, hired_date, status, email, position_title, password')
					 ->from('kp_users')
					 ->join('job_position','job_position.job_id = kp_users.job_position_id','left')
					 ->where('kp_users.user_id',$id);
		$query = $this->CI->db->get();
		return $query->result();
	}

}
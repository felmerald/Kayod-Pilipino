<?php 

header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
header("Pragma: no-cache");
$user_id = $this->session->userdata('login_id');
$email = $this->session->userdata('login_email');
$password = $this->session->userdata('login_password');
$sessionData = array(
	'user_id'=>$user_id,
	'email'=>$email,
	'password'=>$password
);

$checkUserSession =$this->db->get_where('kp_users',$sessionData);
if($checkUserSession->num_rows() == 0){
	foreach($checkUserSession->result() as $row):
			if($row->role =='user'){
			}else{
				$data = array(
	             'login_id' => '',
         	  	 'login_email' => '',
                 'login_password' => '',
                  'login' => ''
                );
				redirect(base_url().'index');
				$this->session->unset_userdata($data);
				exit();
			}
		endforeach;
}else{
	redirect(base_url().'user/home');
	exit();
}

?>
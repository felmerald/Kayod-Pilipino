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
$checkAdmin = $this->db->get_where('kp_users',$sessionData);
foreach($checkAdmin->result() as $row):
    if($row->role =='user'){ // lets check this credential role is equal to admin, if not redirect to template login and destroy their session
    }else{
      $data = array(
          'login_id'=>'',
          'login_email'=>'',
          'login_password'=>'',
          'login'=>''
        );
      $this->session->unset_userdata($data);
      $this->session->sess_destroy();
      redirect(base_url().'index');
      exit();
    }
endforeach;


?>
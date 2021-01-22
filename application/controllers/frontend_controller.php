<?php defined('BASEPATH') OR exit('No direct script access allowed');
// programmer:felmerald besario
 class Frontend_controller extends CI_Controller
 {
 	public function __construct()
 	{
 		parent::__construct();
 		$this->load->model(array('user_model'));
 		$this->load->library("excel");
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

 	function check_login_authentication()
 	{
 		$config = array(
					array('field'=>'email','rules'=>'trim'),
					array('field'=>'password','rules'=>'trim')
				);
		$this->form_validation->set_rules($config);
		$this->form_validation->run();

 		$data = $this->input->post(NULL, TRUE);
 		$this->user_model->check_login_authentication($data['email'],$data['password']);
 	}

 	function destroy_user_session()
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
				redirect(base_url().'index');
				exit();
 	}

 	function update_user_picture()
 	{
 		$image = $this->do_upload();

 		$this->user_model->update_user_picture($image);
 		$this->session->set_flashdata(array(
 				'success' => '<div class="alert alert-success">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								<strong>Success!</strong> Upload Success
							</div>'
 						));
 		redirect(base_url().'user/home');
 		exit();
 	}

 	function request_user_leave()
 	{
 		$data = $this->input->post(NULL, TRUE);
 		$this->user_model->request_user_leave($data['user_id'],
 											  $data['leave_reason'],
 											  $data['leave_type_id'],
 											  $data['leave_start_date'],
 											  $data['leave_end_date'],
 											  $data['leave_hours_perday']
 											  );
 		$this->session->set_flashdata(array(
 				'success' => '<div class="alert alert-success">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								<strong>Success!</strong> Request has been received by admin
							</div>'
 						));
 		redirect(base_url().'user/employee/leave');
 		exit();
 	}

 	function request_employee_overtime()
 	{
 		$data = $this->input->post(NULL, TRUE);
 		$this->user_model->request_employee_overtime($data['user_id'], 
 													 $data['ot_date'],
 													 $data['ot_number_of_hours']);
 		$this->session->set_flashdata(array(
 				'success' => '<div class="alert alert-success">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								<strong>Success!</strong> Request has been received by admin
							</div>'
 						));
 		redirect(base_url().'user/employee/overtime');
 		exit();
 	}

 	function request_employee_undertime()
 	{
 		$data = $this->input->post(NULL, TRUE);
 		$this->user_model->request_employee_undertime($data['user_id'],
 													  $data['undertime_date'],
 													  $data['undertime_number_hours']
 														);
 		$this->session->set_flashdata(array(
 				'success' => '<div class="alert alert-success">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								<strong>Success!</strong> Request has been received by admin
							</div>'
 						));
 		redirect(base_url().'user/employee/undertime');
 		exit();

 	}

 	function employee_upload_documents()
 	{
 		$image = $this->do_upload();
 		$user_id = $this->input->post('user_id');
 		$document_type = $this->input->post('document_type');
 		$this->user_model->employee_upload_documents($image, $user_id,$document_type);
 		$this->session->set_flashdata(array(
 				'success' => '<div class="alert alert-success">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								<strong>Success!</strong> upload success
							</div>'
 						));
 		redirect(base_url().'user/employee/documents');
 		exit();
 	}

 	function update_employee_documents()
 	{
 		$image = $this->do_upload();
 		$this->user_model->update_employee_documents($image);
 		$this->session->set_flashdata(array(
 				'success' => '<div class="alert alert-success">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								<strong>Success!</strong> update success
							</div>'
 						));
 		redirect(base_url().'user/employee/documents');
 		exit();
 	}

 	function delete_document()
 	{
 		$id = $this->input->get('id');
 		$this->user_model->delete_document($id);
 		$this->session->set_flashdata(array(
 				'success' => '<div class="alert alert-success">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								<strong>Success!</strong> delete success
							</div>'
 						));
 		redirect(base_url().'user/employee/documents');
 		exit();
 	}



 	function user_download_leave()
 	{
 		$objPHPExcel = new PHPExcel();
 			$objPHPExcel->setActiveSheetIndex(0);
 			$query = $this->db->query('SELECT leave_type AS LEAVE_TYPE, leave_reason AS REASON, leave_start_date AS START_DATE, leave_end_date AS END_DATE, leave_hours_perday AS HOURS_PER_DAY, leave_availability_hrs AS REMAINING_HOURS, first_name AS FIRSTNAME, last_name AS LASTNAME, middle_name AS MIDDLENAME
 										FROM kp_leave
 										LEFT JOIN kp_users
 										ON kp_users.user_id = kp_leave.user_id
 										LEFT JOIN add_leave
 										ON add_leave.leave_id = kp_leave.leave_type_id
 										WHERE request_status != "pending"
 										AND kp_users.user_id ='.$this->session->userdata('login_id').'');

 			$fields = $query->list_fields();
 			$col = 0;
 			foreach($fields as $field)
 			{
 				   $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, 1, $field);
            	   $col++;

 			}
 			$row = 2;
        	foreach($query->result() as $data)
        	{
            	$col = 0;
            	foreach ($fields as $field)
            	{
                	$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $data->$field);
                	$col++;
            	}
 
            $row++;
        	}
 
        	$objPHPExcel->setActiveSheetIndex(0);
            $objPHPExcel->getActiveSheet()->setTitle('Excel'); 
            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
 
            header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
            header("Cache-Control: no-store, no-cache, must-revalidate");
            header("Cache-Control: post-check=0, pre-check=0", false);
            header("Pragma: no-cache");
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename="employees_leave.xlsx"');
            $objWriter->save("php://output");
 	}


 	function user_download_overtime()
 	{
 		    $objPHPExcel = new PHPExcel();
 			$objPHPExcel->setActiveSheetIndex(0);
 			$query = $this->db->query('SELECT ot_date AS Overtime_date, ot_number_of_hours AS Number_Of_Hours, first_name AS First_Name, last_name AS Last_Name, middle_name AS Middle_Name, leave_availability_hrs FROM request_overtime LEFT JOIN kp_users ON kp_users.user_id = request_overtime.user_id WHERE ot_status != "pending" AND kp_users.user_id = '.$this->session->userdata('login_id').'');

 			$fields = $query->list_fields();
 			$col = 0;
 			foreach($fields as $field)
 			{
 				   $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, 1, $field);
            	   $col++;

 			}
 			$row = 2;
        	foreach($query->result() as $data)
        	{
            	$col = 0;
            	foreach ($fields as $field)
            	{
                	$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $data->$field);
                	$col++;
            	}
 
            $row++;
        	}
 
        	$objPHPExcel->setActiveSheetIndex(0);
            $objPHPExcel->getActiveSheet()->setTitle('Excel'); 
            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
 
            header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
            header("Cache-Control: no-store, no-cache, must-revalidate");
            header("Cache-Control: post-check=0, pre-check=0", false);
            header("Pragma: no-cache");
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename="employees_overtym.xlsx"');
            $objWriter->save("php://output");
 	}


 	function user_download_undertime()
 	{
 			$objPHPExcel = new PHPExcel();
 			$objPHPExcel->setActiveSheetIndex(0);
 			$query = $this->db->query('SELECT undertime_date AS DATE_UNDERTIME, undertime_number_hours AS NUMBER_OF_HOURS, first_name AS FIRSTNAME, last_name AS LASTNAME, middle_name AS MIDDLE_NAME 
 									  FROM request_undertime
 									  LEFT JOIN kp_users
 									  ON kp_users.user_id = request_undertime.user_id
 									  WHERE undertime_status != "pending"
 									  AND kp_users.user_id = '.$this->session->userdata('login_id').'');

 			$fields = $query->list_fields();
 			$col = 0;
 			foreach($fields as $field)
 			{
 				   $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, 1, $field);
            	   $col++;

 			}
 			$row = 2;
        	foreach($query->result() as $data)
        	{
            	$col = 0;
            	foreach ($fields as $field)
            	{
                	$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $data->$field);
                	$col++;
            	}
 
            $row++;
        	}
 
        	$objPHPExcel->setActiveSheetIndex(0);
            $objPHPExcel->getActiveSheet()->setTitle('Excel'); 
            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
 
            header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
            header("Cache-Control: no-store, no-cache, must-revalidate");
            header("Cache-Control: post-check=0, pre-check=0", false);
            header("Pragma: no-cache");
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename="employees_undertime.xlsx"');
            $objWriter->save("php://output");
 	}




 }
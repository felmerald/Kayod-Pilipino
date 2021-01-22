<?php defined('BASEPATH') OR exit('No direct script access allowed');

 class Dashboard_controller extends CI_Controller
 {
 	public function __construct()
 	{
 		parent::__construct();
 		$this->load->model(array('dashboard_model'));
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
 	public function excel()
 	{

 			$objPHPExcel = new PHPExcel();
 			$objPHPExcel->setActiveSheetIndex(0);
 			$query = $this->db->query('SELECT company_id, hired_date, first_name, last_name, middle_name, email, birthday, address, contact_number, status, gender, role, phil_health_number, sss_number, position_title, created
 			 							FROM kp_users
 			 							LEFT JOIN job_position
 			 							ON job_position.job_id = kp_users.job_position_id ');

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
            header('Content-Disposition: attachment;filename="kayod_users_info.xlsx"');
            $objWriter->save("php://output");
 		
 	}

 	function download_overtime()
 	{

 		$objPHPExcel = new PHPExcel();
 			$objPHPExcel->setActiveSheetIndex(0);
 			$query = $this->db->query('SELECT ot_date AS Overtime_date, ot_number_of_hours AS Number_Of_Hours, first_name AS First_Name, last_name AS Last_Name, middle_name AS Middle_Name, leave_availability_hrs FROM request_overtime LEFT JOIN kp_users ON kp_users.user_id = request_overtime.user_id WHERE ot_status != "pending"');

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


 	function download_leave()
 	{
 		$objPHPExcel = new PHPExcel();
 			$objPHPExcel->setActiveSheetIndex(0);
 			$query = $this->db->query('SELECT leave_type AS LEAVE_TYPE, leave_reason AS REASON, leave_start_date AS START_DATE, leave_end_date AS END_DATE, leave_hours_perday AS HOURS_PER_DAY, leave_availability_hrs AS REMAINING_HOURS, first_name AS FIRSTNAME, last_name AS LASTNAME, middle_name AS MIDDLENAME
 										FROM kp_leave
 										LEFT JOIN kp_users
 										ON kp_users.user_id = kp_leave.user_id
 										LEFT JOIN add_leave
 										ON add_leave.leave_id = kp_leave.leave_type_id
 										WHERE request_status != "pending"');

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

 	function download_undertime()
 	{
 			$objPHPExcel = new PHPExcel();
 			$objPHPExcel->setActiveSheetIndex(0);
 			$query = $this->db->query('SELECT undertime_date AS DATE_UNDERTIME, undertime_number_hours AS NUMBER_OF_HOURS, first_name AS FIRSTNAME, last_name AS LASTNAME, middle_name AS MIDDLE_NAME 
 									  FROM request_undertime
 									  LEFT JOIN kp_users
 									  ON kp_users.user_id = request_undertime.user_id
 									  WHERE undertime_status != "pending"');

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

 	public function update_admin_account()
 	{
 		$data = $this->input->post(NULL, TRUE);
 		$this->dashboard_model->update_admin_account(
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
 								$data['job_position_id']
 							 );
 		$this->session->set_flashdata(array(
 				'success' => '<div class="alert alert-success">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								<strong>Success!</strong> Update Success
							</div>'
 						));
 		redirect(base_url().'admin/dashboard');
 		exit();
 	}

 	function get_upload_update()
 	{
 		$image = $this->do_upload();


 		$this->dashboard_model->get_upload_update($image);
 		$this->session->set_flashdata(array(
 				'success' => '<div class="alert alert-success">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								<strong>Success!</strong> Upload Success
							</div>'
 						));
 		redirect(base_url().'admin/dashboard');
 		exit();
 	}

 	function approve_employee_undertime()
 	{
 		$undertime_id = $this->input->post('undertime_id');
 		$this->dashboard_model->approve_employee_undertime($undertime_id);
 		$this->session->set_flashdata(array(
 				'success' => '<div class="alert alert-success">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								<strong>Success!</strong> Approve Success
							</div>'
 						));
 		redirect(base_url().'admin/employees_resquest/undertime');
 		exit();
 	}

 	function deactivate_approve_employee_undertime()
 	{
 		$undertime_id = $this->input->post('undertime_id');
 		$this->dashboard_model->approve_employee_undertime($undertime_id);
 		$this->session->set_flashdata(array(
 				'success' => '<div class="alert alert-success">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								<strong>Success!</strong> Deactivate Success
							</div>'
 						));
 		redirect(base_url().'admin/employees_resquest/undertime');
 		exit();
 	}
 	function approve_overtime()
 	{
 		$ot_id = $this->input->post('ot_id');
 		$this->dashboard_model->approve_overtime($ot_id);
 		$this->session->set_flashdata(array(
 				'success' => '<div class="alert alert-success">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								<strong>Success!</strong> Approve Success
							</div>'
 						));
 		redirect(base_url().'admin/employees_resquest/overtime');
 		exit();
 	}
 	function deactivate_approve_overtime()
 	{
 		$ot_id = $this->input->post('ot_id');
 		$this->dashboard_model->deactivate_approve_overtime($ot_id);
 		$this->session->set_flashdata(array(
 				'success' => '<div class="alert alert-danger">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								<strong>Success!</strong> Approve Deactivate Success
							</div>'
 						));
 		redirect(base_url().'admin/employees_resquest/overtime');
 		exit();
 	}
 	function activate_leave()
 	{
 		$kpl_id = $this->input->post('kpl_id');
 		$this->dashboard_model->activate_leave($kpl_id);
 		$this->session->set_flashdata(array(
 				'success' => '<div class="alert alert-success">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								<strong>Success!</strong> Approve Success
							</div>'
 						));
 		redirect(base_url().'admin/employees_resquest/leave');
 		exit();
 	}

 	function deactivate_leave()
 	{
 		$kpl_id = $this->input->post('kpl_id');
 		$this->dashboard_model->deactivate_leave($kpl_id);
 		$this->session->set_flashdata(array(
 				'success' => '<div class="alert alert-danger">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								<strong>Success!</strong> Deactivate Success
							</div>'
 						));
 		redirect(base_url().'admin/employees_resquest/leave');
 		exit();
 	}

 	function update_employees_record()
 	{
 		$image = $this->do_upload();
 		$data = $this->input->post(NULL, TRUE);
 		$this->dashboard_model->update_employees_record($image,
 								$data['user_id'],
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
 								$data['job_position_id']
 								);
 		$this->session->set_flashdata(array(
 				'success' => '<div class="alert alert-success">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								<strong>Success!</strong> Update Success
							</div>'
 						));
 		redirect(base_url().'admin/dashboard');
 		exit();
 	}

 	function delete_employee_record()
 	{
 		$id = $this->input->get('id');
 		if ($file_name && file_exists($this->upload_path . "/" . $file_name)) 
		{
			unlink($this->upload_path . "/" . $file_name);
		}
 		$this->dashboard_model->delete_employee_record($id);
 		$this->session->set_flashdata(array(
 				'success' => '<div class="alert alert-success">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								<strong>Success!</strong> Delete Success
							</div>'
 						));
 		redirect(base_url().'admin/dashboard');
 		exit();
 	}

 	function profilepdf()
 	{
 		$data = [];
 		$html = $this->load->view('admin/pdf/index', $data, true);
 		$pdfFilePath = "employees_profile.pdf";
		$this->load->library('Kayodpilipino_pdf_converter');
		$param = '"en-GB-x","A4","","",10,10,10,10,6,3';
		$pdfer = new mPDF($param);
		$pdfer->WriteHTML($html);
		$pdfer->output($pdfFilePath, "D");
 	}

 	function userprofile_pdf()
 	{
 		$data = [];
 		$html = $this->load->view('admin/pdf/user_profile', $data, true);
 		$pdfFilePath = "employees_profile.pdf";
		$this->load->library('Kayodpilipino_pdf_converter');
		$param = '"en-GB-x","A4","","",10,10,10,10,6,3';
		$pdfer = new mPDF($param);
		$pdfer->WriteHTML($html);
		$pdfer->output($pdfFilePath, "D");
 	}

 }
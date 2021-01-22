		<div class="row">
			<?php include 'menu/sidebar.php'; ?>
			<div class="col-sm-9">
				<div class="card">
        <?php if($get_user_info): foreach($get_user_info as $row): ?>
					<h4><span class="glyphicon glyphicon-user"></span> <?php echo ucwords(strtolower($row->last_name.', '.$row->first_name.' '.$row->middle_name)); ?></h4>
					<h5><span class="glyphicon glyphicon-flag"></span> <?php echo ucwords($row->position_title); ?></h5>

				</div>
				<div class="card-space"></div>
				<div class="card">
					<ol class="breadcrumb">
						  <li class="active">
						  	Personal
						  </li>
						  <li>
						  	<a href="<?php echo base_url(); ?>user/employee/leave">Leave
                            <span class="badge">
                                <?php 
                                $this->db->select('kpl_id')->where('request_status','accept')->where('user_id',$this->session->userdata('login_id'));
                                 echo $this->db->count_all_results('kp_leave');
                                 ?>
                            </span>
                            </a>
						  </li>
						  <li class="active">
						  	<a href="<?php echo base_url(); ?>user/employee/overtime">Overtime
                            <span class="badge">
                                <?php
                                    $this->db->select('ot_id')->where('ot_status','accept')->where('user_id',$this->session->userdata('login_id'));
                                echo $this->db->count_all_results('request_overtime');

                                 ?>
                            </span>
                            </a>
						  </li>
						  <li class="active">
						  	<a href="<?php echo base_url(); ?>user/employee/undertime">Undertime
                            <span class="badge">
                                <?php 
                                $this->db->select('undertime_id')->where('undertime_status','accept')->where('user_id',$this->session->userdata('login_id'));
                                 echo $this->db->count_all_results('request_undertime');
                                 ?>
                            </span>

                            </a>
						  </li>
						  <li class="active">
						  	<a href="<?php echo base_url(); ?>user/employee/documents">Documents</a>
						  </li>
					</ol>
				</div>

                <h4><span class="glyphicon glyphicon-tags text-success"></span> BASIC INFORMATION</h4>
			 

                <div class="col-sm-4">
                    <div class="form-group">
                    <label>Lastname:</label>
                     <input type="text" name="" class="form-control" value="<?php echo strtoupper($row->last_name); ?>">
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                    <label>Firstname:</label>
                     <input type="text" name="" class="form-control" value="<?php echo strtoupper($row->first_name); ?>">
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                    <label>Middlename:</label>
                     <input type="text" name="" class="form-control" value="<?php echo strtoupper($row->middle_name); ?>">
                    </div>
                </div>
                <div class="col-sm-2"></div>
                <div class="col-sm-8">
                    <div class="form-group">
                        <label>AGE:</label>
                        <input type="text" name="" class="form-control" value="<?php echo strtoupper($this->kp_library->calculate_age($row->birthday)); ?>">
                    </div>
                    <div class="form-group">
                    <label>BIRTDATE:</label>
                        <input type="text" name="" class="form-control" value="<?php echo strtoupper($this->kp_library->convert_date_string($row->birthday)); ?>">
                    </div>
                    <div class="form-group">
                        <label>GENDER:</label>
                        <input type="text" name="" class="form-control" value="<?php echo strtoupper($row->gender); ?>">
                    </div>
                    <div class="form-group">
                    <label>STATUS:</label>
                        <input type="text" name="" class="form-control" value="<?php echo strtoupper($row->status); ?>">
                    </div>
                    <div class="form-group">
                    <label>ADDRESS:</label>
                        <input type="text" name="" class="form-control" value="<?php echo strtoupper($row->address); ?>">
                    </div>
                    <div class="form-group">
                    <label>PHIL HEALTH:</label>
                        <input type="text" name="" class="form-control" value="<?php echo strtoupper($row->phil_health_number); ?>">
                    </div>
                    <div class="form-group">
                    <label>SSS:</label>
                        <input type="text" name="" class="form-control" value="<?php echo strtoupper($row->sss_number); ?>">
                    </div>
                </div>
            <?php endforeach; endif; ?>



			</div>
		</div>
	
<?php echo $this->session->flashdata('success'); ?>
    <!-- modal -->
    <div id="updateuser_picture" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">UPDATE COMPANY PHOTO</div>
                <div class="modal-body">
                <?php echo form_open_multipart(base_url().'user/update_user_profile'); ?>
                    <div class="form-group">
                    <input type="file" class="filestyle" name="userfile" data-buttonBefore="true">
                    </div>
                </div>
                <div class="modal-footer">
                <input type="submit" class="btn btn-success pull-left" value="Update">
                <?php echo form_close(); ?>
                <button class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

		<div class="row">
			<?php include 'sidebar.php'; ?>
			<div class="col-sm-9">
				<div class="card">
					<?php if($get_user_info): foreach($get_user_info as $row): ?>
					<h4><span class="glyphicon glyphicon-user"></span> <?php echo ucwords(strtolower($row->last_name.', '.$row->first_name.' '.$row->middle_name)); ?></h4>
					<h5><span class="glyphicon glyphicon-flag"></span> <?php echo ucwords($row->position_title); ?></h5>
				<?php endforeach; endif;?>
				</div>
				<div class="card-space"></div>
				<div class="card">
					<ol class="breadcrumb">
						  <li class="active">
						  	<a href="<?php echo base_url(); ?>user/home">Personal</a>
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
						  Overtime
						   <span class="badge">
                                <?php
                                    $this->db->select('ot_id')->where('ot_status','accept')->where('user_id',$this->session->userdata('login_id'));
                                echo $this->db->count_all_results('request_overtime');

                                 ?>
                            </span>

						  <!-- 	<a href="<?php echo base_url(); ?>user/employee/overtime">Overtime</a> -->
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

				<br/>
				<div class="dataTable_wrapper">
						<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
								<thead>
										<tr>
										 	<th>DATE</th>
										 	<th>NUMBER OF HOURS</th>

										</tr>
								</thead>
								<tbody>
										<tr>
										<?php if($get_overtime): foreach($get_overtime as $row): ?>
											<td><?php echo $row->ot_date; ?></td>
											<td><?php echo $row->ot_number_of_hours; ?></td>
										<?php endforeach; endif; ?>
										</tr>
								</tbody>
						</table>
				</div>
				
				<a href="#request_overtime" class="btn btn-success" data-toggle="modal">
					Request
				</a>
				<a href="<?php echo base_url(); ?>user/download_overtime" class="btn btn-default" >
					EXPORT TO EXCEL
				</a>


			</div>
		</div>
	<?php echo $this->session->flashdata('success'); ?>
<!-- /////Modal///// -->

		<div id="request_overtime" class="modal fade" tabindex="-1" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<strong class="text-success">Overtime Request</strong>
						</div>
						<div class="modal-body">
						<?php echo form_open(base_url().'user/request_overtime') ?>
								<input type="hidden" name="user_id" value="<?php echo $this->session->userdata('login_id'); ?>">
								<div class="form-group">
									<small>DATE:</small>
									<input type="date" name="ot_date" class="form-control" required>
								</div>
							   <div class="form-group">
									<small>NUMBER OF HOURS:</small>
									<input type="number" name="ot_number_of_hours" class="form-control" required>
							   </div>
						</div>
						<div class="modal-footer">
								<input type="submit" class="btn btn-success" value="SAVE">
						<?php echo form_close(); ?>
								<button type="button" data-dismiss="modal" class="btn btn-danger">CLOSE</button>
						</div>
					</div>
				</div>
		</div>
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
						  		Leave
                      <span class="badge">
                                <?php 
                                $this->db->select('kpl_id')->where('request_status','accept')->where('user_id',$this->session->userdata('login_id'));
                                 echo $this->db->count_all_results('kp_leave');
                                 ?>
                            </span>
						  	<!-- <a href="<?php echo base_url(); ?>user/employee/leave">Leave</a> -->
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

    				<br/>
			 		
			 	<div class="dataTable_wrapper">
				<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                <thead>
                <tr>
                    <th>Leave type</th>
                    <th>Remaining Hours</th>
                    <th>Consumed Hours</th>
                 
                </tr>
                </thead>
                <tbody>
                  <?php if($get_leave_request): foreach($get_leave_request as $row): ?>
                		<tr>
                			<?php if($row->add_leave_type == 'unlimited'){ ?>

                				<td><?php echo ucwords(strtolower($row->leave_type)); ?></td>
                				<td>Unlimited</td>
                				<td>	
                				<?php
                						$enddate = strtotime($row->leave_end_date);
                						$startdate = strtotime($row->leave_start_date);
                						$datediff = $enddate - $startdate;
                						$calculate = floor($datediff / (60 * 60 * 24));
                						echo $calculate_hours = (8 * $calculate);
                						 ?>
                						 Hours
                				</td>

                			<?php }else{ ?>

                			<td><?php echo ucwords(strtolower($row->leave_type)); ?></td>
                			<td>
                				
                					<?php
                					// convert days between dates
                						$enddate = strtotime($row->leave_end_date);
                						$startdate = strtotime($row->leave_start_date);
                						$datediff = $enddate - $startdate;
                						$calculate = floor($datediff / (60 * 60 * 24));
                					// end
                					// now multiply by 8 hrs
                						$calculate_hours = (8 * $calculate); // 32 hrs
                			// now lets subtract our default time from users table which is 120 hrs
                					echo $total = ($row->leave_availability_hrs - $calculate_hours); //120 -32
                						?> Hours / <?php echo $row->leave_availability_hrs; ?> Hours


                			</td>
                			<td>
                						<?php
                						$enddate = strtotime($row->leave_end_date);
                						$startdate = strtotime($row->leave_start_date);
                						$datediff = $enddate - $startdate;
                						$calculate = floor($datediff / (60 * 60 * 24));
                						echo $calculate_hours = (8 * $calculate);
                						 ?>
                						 Hours
                			</td>

                			<?php } ?>
                			
                		</tr>
                <?php endforeach; endif; ?>
              	
                </tbody>
            </table>
           </div>

           <a href="#requestleave" class="btn btn-success" data-toggle="modal">Request</a>
           <a href="<?php echo base_url(); ?>user/download_leave" class="btn btn-default">EXPORT TO EXCEL</a>
               
			</div>
		</div>

<?php echo $this->session->flashdata('success'); ?>

		<!-- /////Modal///// -->

		<div id="requestleave" class="modal fade" tabindex="-1" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<strong class="text-success">Add Leave Request</strong>
						</div>
						<div class="modal-body">
				<?php echo form_open(base_url().'user/user_request_leave'); ?>
								<div class="form-group">
									<small>TYPE:</small>
									<select class="form-control" required name="leave_type_id">
										<option></option>
										<?php if($get_leave): foreach($get_leave as $row): ?>
											<option value="<?php echo $row->leave_id;?>"><?php echo ucwords(strtolower($row->leave_type)); ?></option>
										<?php endforeach; endif; ?>
										
									</select>
								</div>
									<input type="hidden" name="user_id" value="<?php echo $this->session->userdata('login_id');?>">
								<div class="form-group">
									<small>REASON:</small>
									<textarea cols="3" rows="3" class="form-control" name="leave_reason" required placeholder="Reason of leave"></textarea>
								</div>
								<div class="form-group">
									<small>START DATE:</small>
									<input type="date" name="leave_start_date" class="form-control" required>
							   </div>
							   <div class="form-group">
									<small>END DATE:</small>
									<input type="date" name="leave_end_date" class="form-control" required>
							   </div>
							   <div class="form-group">
									<small>LEAVE HOURS PER DAY:</small>
									<input type="number" name="leave_hours_perday" class="form-control" required>
							   </div>

						</div>
						<div class="modal-footer">
								<input type="submit" class="btn btn-success" value="SAVE">
						<?php echo form_close(); ?>
								<button type="button" data-dismiss="modal" class="btn btn-danger">CANCEL</button>
						</div>
					</div>
				</div>
		</div>
	

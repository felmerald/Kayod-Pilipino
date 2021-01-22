<!-- Update Admin Account -->

<div id="updateadminaccount" class="modal fade" tab-index="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				Update Account Information
			</div>
				<div class="modal-body">
				<?php echo form_open(base_url().'admin/update_account');?>

				<?php if($account_info):
						foreach($account_info as $row): ?>
					<div class="form-group">
						<label>Firstname</label>
						<input type="text" name="first_name" value="<?php echo $row->first_name ;?>" class="form-control">
					</div>
					<div class="form-group">
						<label>Lastname</label>
						<input type="text" name="last_name" value="<?php echo $row->last_name; ?>" class="form-control">
					</div>
					<div class="form-group">
						<label>Middlename</label>
						<input type="text" name="middle_name" value="<?php echo $row->middle_name; ?>" class="form-control">
					</div>
					<div class="form-group">
						<label>Birthdate</label>
						<input type="date" name="birthday" value="<?php echo $row->birthday;?>" class="form-control">
					</div>
					<div class="form-group">
						<label>Gender</label>
							<select name="gender" class="form-control">
							<option value="<?php echo $row->gender; ?>"><?php echo $row->gender ?></option>
							<option value="male">Male</option>
							<option value="female">Female</option>
						</select>
					</div>
					<div class="form-group">
						<label>Address</label>
						<input type="text" name="address" value="<?php echo $row->address;?>" class="form-control">
					</div>
					<div class="form-group">
						<label>Contact</label>
						<input type="number" name="contact_number" value="<?php echo $row->contact_number ?>" class="form-control">
					</div>
					<div class="form-group">
						<label>Status</label>
						<select name="status" class="form-control">
							<option value="single">Single</option>
							<option value="married">Married</option>
							<option value="devorse">Devorse</option>
						</select>
					</div>
					<div class="form-group">
						<label>Phil Health Number</label>
						<input type="number" name="phil_health_number" value="<?php echo $row->phil_health_number; ?>" class="form-control">
					</div>
					<div class="form-group">
						<label>SSS Number</label>
						<input type="number" name="sss_number" value="<?php echo $row->sss_number; ?>" class="form-control">
					</div>
				<?php endforeach; endif; ?>
					<div class="form-group">
						<label>Job</label>
						<select name="job_position_id" class="form-control">
							<?php if($job): foreach($job as $list): ?>
							<option value="<?php echo $list->job_id ?>">
							<?php echo ucwords(strtolower($list->position_title)) ?></option>
					<?php endforeach; endif; ?>
						</select>
			
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


<!-- update -->
<div id="update_profile" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">Update Image</div>
			<div class="modal-body">
			<?php echo form_open_multipart(base_url().'admin/update_profile'); ?>
				<div class="form-group">
					<input type="file" class="filestyle" name="userfile" data-buttonBefore="true">
				</div>
			</div>
			<div class="modal-footer">
				<input type="submit" value="Update" class="btn btn-success">
		   <?php echo form_close(); ?>
				<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>

<!-- Add Employee -->
<div id="add_employee" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">ADD EMPLOYEE</div>
			<div class="modal-body">
			<?php echo form_open_multipart(base_url().'admin/add_employee'); ?>
				<div class="form-group">
					<label>PROFILE PICTURE</label>
					<input type="file" class="filestyle" name="userfile" data-buttonBefore="true" required>
				</div>
				<div class="form-group">
					<label class="text-danger">Company ID (*Required)</label>
					<input type="number" name="company_id" placeholder="Company ID" class="form-control" required>
				</div>
				<div class="form-group">
					<label class="text-danger">First Name (*Required)</label>
					<input type="text" name="first_name" placeholder="first name" class="form-control" required>
				</div>

				<div class="form-group">
					<label class="text-danger">Middle Name (*Required)</label>
					<input type="text" name="middle_name" placeholder="middle_name" class="form-control" required>
				</div>

				<div class="form-group">
					<label class="text-danger">Last Name (*Required)</label>
					<input type="text" name="last_name" placeholder="Last_name" class="form-control" required>
				</div>

				<div class="form-group">
					<label class="text-success">Birthday</label>
					<input type="date" name="birthday" placeholder="Birthday" class="form-control" >
				</div>

				<div class="form-group">
					<label class="text-success">Address</label>
					<input type="text" name="address" placeholder="address" class="form-control">
				</div>
				<div class="form-group">
					<label class="text-success">Contact</label>
					<input type="number" name="contact_number" placeholder="Contact Number" class="form-control">
				</div>
				<div class="form-group">
					<label class="text-danger">Status (*Required)</label>
					<select name="status" class="form-control" required="">
						<option value="single">Single</option>
						<option value="married">Married</option>
						<option value="devorse">Devorse</option>
					</select>
				</div>

				<div class="form-group">
					<label class="text-danger">Gender (*Required)</label>
					<select name="gender" class="form-control" required>
						<option value="male">Male</option>
						<option value="female">Female</option>
					</select>
				</div>

				<div class="form-group">
					<label class="text-success">Phil Healt Number</label>
					<input type="number" name="phil_health_number" placeholder="Phil Health Number" class="form-control">
				</div>
				<div class="form-group">
					<label class="text-success">SSS Number</label>
					<input type="number" name="sss_number" placeholder="SSS Number" class="form-control">
				</div>
				<div class="form-group">
					<label class="text-danger">Email (*Required)</label>
					<input type="email" name="email" placeholder="email" class="form-control" required>
				</div>
				<div class="form-group">
					<label class="text-danger">Password (*Required)</label>
					<input type="text" name="password" placeholder="password" class="form-control" required>
				</div>
				<div class="form-group">
						<label class="text-danger">Job (*Required)</label>
						<select name="job_position_id" class="form-control" required="">
							<?php if($job): foreach($job as $list): ?>
							<option value="<?php echo $list->job_id ?>">
							<?php echo ucwords(strtolower($list->position_title)) ?></option>
					<?php endforeach; endif; ?>
						</select>
			
					</div>
			</div>
			<div class="modal-footer">
				<input type="submit" value="ADD" class="btn btn-success">
		   <?php echo form_close(); ?>
				<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
<?php $query = $this->db->query('SELECT user_id FROM kp_users');foreach($query->result() as $data):?>
<div id="deletEmployee<?php echo $data->user_id; ?>" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">Please confirm</div>
			<div class="modal-body">
				<h4 class="text-danger">Are you sure you want to delete this file?</h4>
			</div>
			<div class="modal-footer">
				<a href="<?php echo base_url(); ?>admin/delete_employee?id=<?php echo $data->user_id; ?>" type="submit" value="DELETE" class="btn btn-danger">DELETE</a>
	
				<button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
<?php endforeach; ?>


<?php $query = $this->db->query('SELECT user_id FROM kp_users');foreach($query->result() as $data):?>
<div id="updateEmploye<?php echo $data->user_id;?>" class="modal fade" tab-index="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				Update Employee Information
			</div>
				<div class="modal-body">
				<?php echo form_open_multipart(base_url().'admin/update_employee_info');?>

				<?php 
					$query = $this->db->query('SELECT user_id, company_id, hired_date, image, first_name, last_name, middle_name, birthday, address, contact_number, status, gender, role, phil_health_number, sss_number, job_position_id, created, email, password, position_title
								   FROM kp_users 
								   LEFT JOIN  job_position 
								   ON job_position.job_id = kp_users.job_position_id
								   WHERE role = "user"
								   AND  user_id ='.$data->user_id.'');
					foreach($query->result() as $row):
				?>
					<input type="hidden" name="user_id" value="<?php echo $row->user_id; ?>">
					<div class="form-group">
					<label>Change Picture?</label>
					<input type="file" class="filestyle" name="userfile" data-buttonBefore="true">
					</div>
					<div class="form-group">
						<label>Firstname</label>
						<input type="text" name="first_name" value="<?php echo $row->first_name ;?>" class="form-control">
					</div>
					<div class="form-group">
						<label>Lastname</label>
						<input type="text" name="last_name" value="<?php echo $row->last_name; ?>" class="form-control">
					</div>
					<div class="form-group">
						<label>Middlename</label>
						<input type="text" name="middle_name" value="<?php echo $row->middle_name; ?>" class="form-control">
					</div>
					<div class="form-group">
						<label>Birthdate</label>
						<input type="date" name="birthday" value="<?php echo $row->birthday;?>" class="form-control">
					</div>
					<div class="form-group">
						<label>Gender</label>
							<select name="gender" class="form-control">
							<option value="<?php echo $row->gender; ?>"><?php echo $row->gender ?></option>
							<option value="male">Male</option>
							<option value="female">Female</option>
						</select>
					</div>
					<div class="form-group">
						<label>Address</label>
						<input type="text" name="address" value="<?php echo $row->address;?>" class="form-control">
					</div>
					<div class="form-group">
						<label>Contact</label>
						<input type="number" name="contact_number" value="<?php echo $row->contact_number ?>" class="form-control">
					</div>
					<div class="form-group">
						<label>Status</label>
						<select name="status" class="form-control">
							<option value="single">Single</option>
							<option value="married">Married</option>
							<option value="devorse">Devorse</option>
						</select>
					</div>
					<div class="form-group">
						<label>Phil Health Number</label>
						<input type="number" name="phil_health_number" value="<?php echo $row->phil_health_number; ?>" class="form-control">
					</div>
					<div class="form-group">
						<label>SSS Number</label>
						<input type="number" name="sss_number" value="<?php echo $row->sss_number; ?>" class="form-control">
					</div>
				<?php endforeach; ?>
					<div class="form-group">
						<label>Job</label>
						<select name="job_position_id" class="form-control">
							<option value="<?php echo $row->job_position_id; ?>">
								<?php echo ucwords($row->position_title);?>
							</option>
							<?php if($job): foreach($job as $list): ?>
							<option value="<?php echo $list->job_id ?>">
							<?php echo ucwords(strtolower($list->position_title)) ?></option>
					<?php endforeach; endif; ?>
						</select>
			
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
<?php endforeach; ?>
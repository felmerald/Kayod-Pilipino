<style type="text/css">
@media (min-width: 1200px){
.container {
    width: 1170px;
    padding: 15px !important;
    margin-top: -20px !important;
    height: 1271px !important;
    box-shadow: 0 4px 4px 0 rgba(0,0,0,0.2) !important;
    transition: 0.3s;
}
</style>
<div class="row">
		<div class="col-sm-6 col-sm-offset-3">
				<?php echo  $this->session->flashdata('success'); ?>
				<?php echo validation_errors(); ?>
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
					<br/>
				<input type="submit" value="ADD" class="btn btn-success">
			</div>
				
		   <?php echo form_close(); ?>
		</div>
	
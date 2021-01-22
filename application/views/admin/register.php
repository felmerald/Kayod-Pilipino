<div class="col-sm-4 col-sm-offset-4">
	<div class="panel panel-default panel-body">
	<?php echo form_open(base_url().'admin/register/authenticate'); ?>
		<div class="form-group">
			<input type="email" required name="email" placeholder="Email Address">
		</div>
		<small class="text-danger"><?php echo form_error('email') ;?></small>
		<div class="form-group">
			<input type="password" name="password" required placeholder="Password">
		</div>
		<small class="text-danger"><?php echo form_error('password'); ?></small>
		<div class="form-group">
		<input type="password" name="cpassword" required placeholder="Password">
		</div>
		<small class="text-danger"><?php echo form_error('cpassword'); ?></small>
		<div class="form-group">
		<input type="submit" value="Submit" class="btn btn-success">
		</div>
	<?php echo form_close();?>

</div>

<?php echo $this->session->flashdata('success'); ?>
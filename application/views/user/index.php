<div class="container">
	<div class="row">
		<div class="col-sm-6 col-sm-offset-3" style="margin-top: 60px;">
			<center><h3 class="title-login">KAYOD PILIPINO</h3></center>
			<div class="panel panel-default panel-login-green" style="border-radius:0px">
				<div class="panel-body">
		<?php echo form_open(base_url().'user_login'); ?>
					<center>
						<span class="glyphicon glyphicon-lock icon-lock"></span>
						<h3 class="login-access">ACCESS</h3>
					</center>
					<div class="form-group">
						<input type="email" autocomplete="off" name="email" placeholder="Email Address" required>
					</div>
					<div class="form-group">
						<input type="password" autocomplete="off" name="password" placeholder="Your Password" required>
					</div>
					<div class="form-group">
						<input type="submit" class="btn btn-success" value="Sign In Me">

						<a href="<?php echo base_url(); ?>forgot_password" class="btn btn-danger pull-right">Forgot password? </a>
					</div>
		<?php echo form_close(); ?>
				</div>
			</div>
		</div>
	</div>
</div>

<?php echo $this->session->flashdata('invalid'); ?>
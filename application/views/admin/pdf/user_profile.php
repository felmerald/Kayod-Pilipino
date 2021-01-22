<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Kayod_employee Profile</title>
	<link rel="stylesheet" href="<?php echo base_url();?>resources/css/bootstrap.css">
	<link rel="stylesheet" href="<?php echo base_url();?>resources/css/bootstrap-theme.css">
	<style type="text/css" media="print">
		.small{
			 font-size: 1.2em !important;
		 }	
		 .spacing{
		 	 position: absolute !important;
    		left: 15em !important;
		 }
	</style>
</head>
<body>
		<div class="container" style="margin-top:10px">
			<div class="row">

				<div class="col-sm-3">
					<?php 
					$id = $this->input->get('id');
					foreach($this->userprofile_pdf_lib->view_user_profile($id) as $row): ?>
					
					<?php if(!empty($row->image)){ ?>
					<center>
					<img src="<?php echo base_url();?>upload/<?php echo $row->image; ?>" class="img-responsive" style="height:200px; width:40%;margin-right:auto !important; margin-left:auto !important">
					</center>
					<?php }else{ ?>
							<?php if($row->gender == 'male'){ ?>
								<center>
									<img src="<?php echo base_url(); ?>resources/img/boy.jpg" class="img-responsive" style="height:200px; width:40%;margin-right:auto !important; margin-left:auto !important">
								</center>
							<?php }else if($row->gender == 'female'){ ?>

								<center>
									<img src="<?php echo base_url(); ?>resources/img/female.jpg" class="img-responsive" style="height:200px; width:40%;margin-right:auto !important; margin-left:auto !important">
								</center>
							<?php } ?>

					<?php } ?>

					
					<hr/>
					<p class="text-success"><strong>Company ID:</strong></p>
					<p><?php echo $row->company_id;?></p>
					<p class="text-success"><strong>Hired On:</strong></p>
					<p><?php echo $this->kp_library->convert_date_string($row->hired_date); ?></p>
					<p class="text-success"><strong>Job Position:</strong></p>
					<p><?php echo ucwords(strtolower($row->position_title)); ?></p>	
					
				</div>
				
				<div class="col-sm-9">
					<hr/>
					<h4 class="text-success"><strong>COMPANY DETAILS</strong></h4>
					<p>
					<strong>Company Name:</strong> 
					<small class="spacing">Kayod Pilipino</small>
					</p>
					<p>
					<strong>Company Address:</strong> 
					<small class="spacing">Address Gagfa</small>
					</p>
				<hr/>
					<h4 class="text-success"><strong>PROFILE</strong></h4>
					<p>
					<strong>Full Name:</strong> 
					<small class="spacing">
						<?php echo ucwords(strtolower($row->last_name.', '.$row->first_name.' '.$row->middle_name));?>
					</small>
					</p>
					<p>
					<strong>Email:</strong> 
					<small class="spacing"><?php echo $row->email; ?></small>
					</p>
					<p>
					<strong>Contact:</strong> 
					<small class="spacing"><?php echo $row->contact_number;?></small>
					</p>
					<p>
					<strong>Address:</strong> 
					<small class="spacing"><?php echo ucwords(strtolower($row->address)); ?></small>
					</p>
					<p>
					<strong>Gender:</strong> 
					<small class="spacing"><?php echo ucfirst(strtolower($row->gender)); ?> </small>
					</p>
					<p>
					<strong>Status:</strong> 
					<small class="spacing"><?php echo ucfirst(strtolower($row->status)); ?></small>
					</p>
					<p>
					<strong>Birthday:</strong> 
					<small class="spacing">
					<?php echo $this->kp_library->convert_date_string($row->birthday); ?>
					</small>
					</p>
					<p>
					<strong>Age:</strong> 
					<small class="spacing">
						<?php echo $this->kp_library->calculate_age($row->birthday); ?>
					</small>
					</p>
					<p>
					<strong>Phil Healt Number:</strong> 
					<small class="spacing"><?php echo $row->phil_health_number; ?></small>
					</p>
					<p>
					<strong>SSS Number:</strong> 
					<small class="spacing"><?php echo $row->sss_number; ?></small>
					</p>
			<?php endforeach; ?>
				</div>
			</div>
		</div>

		<script src="<?php echo base_url(); ?>resources/js/jquery-1.10.2.js"></script>
		<script src="<?php echo base_url(); ?>resources/js/bootstrap.js"></script>
	</body>
</html>
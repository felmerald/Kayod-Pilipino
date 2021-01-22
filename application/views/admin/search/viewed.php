<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Search Result</title>
	<link rel="stylesheet" href="<?php echo base_url();?>resources/css/bootstrap.css">
	<link rel="stylesheet" href="<?php echo base_url();?>resources/css/bootstrap-theme.css">
	<link rel="stylesheet" href="<?php echo base_url();?>resources/css/dashboard.css">
  <!-- DataTables -->
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>resources/datatables/css/dataTables.bootstrap.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>resources/datatables/css/dataTables.responsive.css">
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

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">
        Administrator
      </a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
      <!--   <li class="active"> -->
      	<li>
        		<a href="<?php echo base_url();?>admin/dashboard"><?php echo ucfirst('home');?></a>
        </li>
         <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Request <span class="caret"></span></a>
          <ul class="dropdown-menu">
           <li><a href="<?php echo base_url(); ?>admin/employees_resquest/leave">Leave

            <span class="badge">
              <?php $this->db->select('kpl_id')->where('request_status','pending');
                echo $this->db->count_all_results('kp_leave'); ?>
            </span>
            </a></li>
            <li><a href="<?php echo base_url(); ?>admin/employees_resquest/overtime">Overtime
            <spam class="badge">
              <?php $this->db->select('ot_id')->where('ot_status','pending');
                 echo $this->db->count_all_results('request_overtime');?>
            </spam>
            </a></li>
            <li><a href="<?php echo base_url(); ?>admin/employees_resquest/undertime">Undertime
            <span class="badge"> 
            <?php $this->db->select('undertime_id')->where('undertime_status','pending');
              echo $this->db->count_all_results('request_undertime');
            ?>
              
            </span>
            </a></li>
            <li role="separator" class="divider"></li>
            <li><a href="<?php echo base_url(); ?>admin/employees_images/files">Documents</a></li>
          </ul>
        </li>
      
   
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li>
        	<a href="#">
        		<span class="glyphicon glyphicon-bell"></span>
              <span class="badge">
            <?php 
                $this->db->select('kpl_id')->where('request_status','pending');
                $var1 = $this->db->count_all_results('kp_leave');
                $this->db->select('ot_id')->where('ot_status','pending');
                $var2 = $this->db->count_all_results('request_overtime');
                $this->db->select('undertime_id')->where('undertime_status','pending');
                $var3 = $this->db->count_all_results('request_undertime');
                echo $var1 + $var2 + $var3 
            ?>
           </span>
        	</a>
       	</li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
	          <span class="glyphicon glyphicon-cog"></span> 
	          <span class="caret"></span>
          </a>
          <ul class="dropdown-menu">
            <li><a href="#updateadminaccount" data-toggle="modal">Update Account</a></li>
            <li><a href="<?php echo base_url(); ?>">Change Password</a></li>
            <li><a href="<?php echo base_url(); ?>admin/logout">Log-out</a></li>
          </ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
		<div class="container" style="margin-top:10px">
			<div class="row">

				<div class="col-sm-3">
					<?php 
					$id = $this->input->get('id');
					foreach($this->userprofile_pdf_lib->view_user_profile($id) as $row): ?>
					
					<?php if(!empty($row->image)){ ?>
					<center>
					<img src="<?php echo base_url();?>upload/<?php echo $row->image; ?>" class="img-responsive" style="height:200px; width:100%;margin-right:auto !important; margin-left:auto !important">
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
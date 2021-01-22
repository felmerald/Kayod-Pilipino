<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php echo strtoupper($title); ?></title>
	<link rel="stylesheet" href="<?php echo base_url();?>resources/css/bootstrap.css">
	<link rel="stylesheet" href="<?php echo base_url();?>resources/css/bootstrap-theme.css">
	<link rel="stylesheet" href="<?php echo base_url();?>resources/css/dashboard.css">
  <!-- DataTables -->
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>resources/datatables/css/dataTables.bootstrap.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>resources/datatables/css/dataTables.responsive.css">
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
        Kayod Pilipino
      </a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
      <!--   <li class="active"> -->
      	<li>
        		<a href="<?php echo base_url();?>user/home"><?php echo ucfirst('home');?></a>
        </li>
        <li>
        		<a href="<?php echo base_url();?>user/employee/application_request"><?php echo ucfirst('application Request');?></a>
        </li>
   
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li>
        	<a href="#">
        		<span class="glyphicon glyphicon-bell"></span>
              <span class="badge">
            <?php 
                $this->db->select('kpl_id')->where('request_status','accept')->where('user_id',$this->session->userdata('login_id'));
                $var1 = $this->db->count_all_results('kp_leave');
                $this->db->select('ot_id')->where('ot_status','accept')->where('user_id',$this->session->userdata('login_id'));
                $var2 = $this->db->count_all_results('request_overtime');
                $this->db->select('undertime_id')->where('undertime_status','accept')->where('user_id',$this->session->userdata('login_id'));
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
            <li><a href="<?php echo base_url(); ?>user/logout">Log-out</a></li>
          </ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

<div class="container">



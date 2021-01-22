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
            <li><a href="<?php echo base_url(); ?>admin/employees_resquest/leave">Leave</a></li>
            <li><a href="<?php echo base_url(); ?>admin/employees_resquest/overtime">Overtime</a></li>
            <li><a href="<?php echo base_url(); ?>admin/employees_resquest/undertime">Undertime</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="<?php echo base_url(); ?>admin/employees_images/files">Documents</a></li>
          </ul>
        </li>
      
   
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li>
        	<a href="#">
        		<span class="glyphicon glyphicon-bell"></span>
            <span class="badge text-danger">1</span>
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
				<div class="col-sm-12">
				<p class="text-success"><span class="glyphicon glyphicon-search"></span> Search Result</p>
				<p>Hint: Search by name or By Workers ID</p>
				<a href="<?php echo base_url();?>admin/dashboard" class="btn btn-success">Search Again</a>
				<hr/>
				<div class="table-responsive">
				<table class="table table-bordered">
					<thead>
						<tr>
							<th>Profile</th>
							<th>Fullname</th>
						</tr>
					</thead>
					<tbody>
					<?php 
						if($get_result->num_rows() > 0 )
						{
							foreach($get_result->result() as $row)
							{
					?>
						<tr>
							<td>
			<?php if(!empty($row->image)){ ?>
					
					<img src="<?php echo base_url();?>upload/<?php echo $row->image; ?>" class="img-responsive" style="height:80px; width:80px;">
				
			<?php }else{ ?>
					<?php if($row->gender == 'male'){ ?>
						
							<img src="<?php echo base_url(); ?>resources/img/boy.jpg" class="img-responsive" style="height:80px; width:80px;">
						
					<?php }else if($row->gender == 'female'){ ?>

					
							<img src="<?php echo base_url(); ?>resources/img/female.jpg" class="img-responsive" style="height:80px; width:80px;">
					
					<?php } ?>

			<?php } ?>
							</td>
							<td>
							<a href="<?php echo base_url();?>admin/search/result/employee?id=<?php echo $row->user_id; ?>">
							<?php echo ucwords(strtoupper($row->last_name.', '.$row->first_name.' '.$row->middle_name)); ?>
							</a>
							</td>
						</tr>
					<?php 
							}
						}
						else
						{
					?>
						<tr>
							<td>No result found</td>
						</tr>
				<?php } ?>
					</tbody>
				</table>
				</div>
				</div>
			</div>
		</div>

		<script src="<?php echo base_url(); ?>resources/js/jquery-1.10.2.js"></script>
		<script src="<?php echo base_url(); ?>resources/js/bootstrap.js"></script>
	</body>
</html>
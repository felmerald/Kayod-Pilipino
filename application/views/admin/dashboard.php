<div class="card">
	<div class="row">
		<div class="col-sm-12">
	<?php if($account_info): foreach($account_info as $row): ?>
			<div class="media">
			  <div class="media-left">
			  	<?php 
			  	if(!empty($row->image))
			  	{
			  	 ?>
			  	 	<a href="#update_profile" data-toggle="modal">
			  	 	<img src="<?php echo base_url();?>upload/<?php echo $row->image; ?>" class="media-object media-img" >
			  	 	</a>
				 <?php	
				 }
				 else
				 {
					  if($row->gender == 'male')
					  	{ 
					  	?>
					    <a href="#update_profile" data-toggle="modal">
					      <img class="media-object media-img" src="<?php echo base_url(); ?>resources/img/boy.jpg">
					    </a>
					    <?php 
						}
						else if($row->gender == 'female')
						{
				?>
						<a href="#update_profile" data-toggle="modal">
					      <img class="media-object media-img" src="<?php echo base_url(); ?>resources/img/girl.jpg">
					    </a>
				<?php 
						}
				 }
				?>
			  </div>
			  <div class="media-body">
			    <a href="#view_profile" data-toggle="modal">
			    	<h4 class="media-heading text-black">
			    	<?php echo ucwords(strtolower($row->last_name.', '.$row->first_name.' '.$row->middle_name)); ?>
			    	</h4>
			    </a>
			    	<p class="text-success">WORKER ID: <?php echo $row->company_id; ?></p>
			    	<p><span class="glyphicon glyphicon-tag text-success"></span> TYPE: <?php echo strtoupper($row->role);?></p>
			    	<p>
			    	<?php if($row->last_login != '0000-00-00 00:00:00'){ ?>
			    	<span class="glyphicon glyphicon-time text-danger"></span> 
			    	Last Log-in: <?php echo $this->time_ago_lib->time_ago($row->last_login); ?>
			    	</p>
			    	<?php }else{ ?>
			    	<span class="glyphicon glyphicon-time text-danger"></span> 
			    	Last Log-in: No Found
			    	</p>
			    	<?php } ?>
		<?php endforeach; endif; ?>
			    	<a href="<?php echo base_url(); ?>admin/employee/add_worker" class="btn btn-success" data-toggle="modal">
			    		<span class="glyphicon glyphicon-plus"></span> ADD EMPLOYEE
			    	</a>

			    	<a href="<?php echo base_url(); ?>admin/download_excel" class="btn btn-info"><span class="glyphicon glyphicon-download"></span> EXPORT TO EXCEL</a>
			    	<a href="<?php echo base_url();?>admin/download_pdf" class="btn btn-primary"><span class="glyphicon glyphicon-print"></span> PDF / PRINT</a>
			    	
			    	<style type="text/css">
			    		.label1 {
					    display: inline;
					    padding: .2em .6em .3em;
					    font-size: 75%;
					    font-weight: bold;
					    line-height: 1;
					    color: #fff;
					    text-align: center;
					    white-space: nowrap;
					    vertical-align: baseline;
					    border-radius: .25em;
						}
			    	</style>
			    	<label class="label1 label-default">Employees Total:
			    	<span class="badge">
			    		<?php echo $count_users; ?>
			    	</span>  
			    	</label>
			  </div>
			</div>

		</div>
	</div>
</div>
<br/>

<center><h4><strong class="text-success">EMPLOYEE'S LIST</strong></h4></center>

<br/>
<div class="dataTable_wrapper">
						<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
								<thead>
										<tr>
										 	<th>WORKERS ID</th>
										 	<th>FULLNAME</th>
										 	<th>ADDRESS</th>	
										 	<th>JOB POSITION</th>
											<th>HIRED ON</th>
											<th>OPTION</th>
										</tr>
								</thead>
								<tbody>
								<?php if($user_account): foreach($user_account as $row):?>
										<tr>

											<td><?php echo $row->company_id; ?></td>
											<td>
												<?php echo ucwords(strtolower($row->last_name.', '.$row->first_name.' '.$row->middle_name));?>
											</td>
											<td><?php echo ucwords(strtolower($row->address)); ?></td>
											<td><?php echo ucwords($row->position_title); ?></td>
											<td>
												<?php echo $this->kp_library->convert_date_string($row->hired_date); ?>
											</td>
											<td>
										
												<a href="<?php echo base_url(); ?>admin/user_profile_pdf?id=<?php echo $row->user_id; ?>" class="btn btn-xs btn-default">
													<span class="glyphicon glyphicon-print"></span>
												</a>
												<a href="#updateEmploye<?php echo $row->user_id;?>" data-toggle="modal" class="btn btn-xs btn-success">
													<span class="glyphicon glyphicon-edit"></span>
												</a>
												<a href="#deletEmployee<?php echo $row->user_id; ?>" data-toggle="modal" class="btn btn-xs btn-danger">
													<span class="glyphicon glyphicon-trash"></span>
												</a>
											</td>

										</tr>
									<?php endforeach; endif; ?>
								</tbody>
						</table>
				</div>
<?php echo  $this->session->flashdata('success'); ?>




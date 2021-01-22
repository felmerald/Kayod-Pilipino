<div class="col-sm-3">
<?php if($get_user_info): foreach($get_user_info as $row):  ?>
	<?php 
			if(!empty($row->image))
			{
	?>	
			 <img src="<?php echo base_url();?>upload/<?php echo $row->image; ?>" class="img-responsive profile">
	<?php  }
		   else
		   { 
	?>			
				<?php if($row->gender == 'male'){ ?>
					<img src="<?php echo base_url();?>resources/img/boy.jpg" class="img-responsive profile">
				<?php }else if($row->gender == 'female'){ ?>
					<img src="<?php echo base_url();?>resources/img/female.jpg" class="img-responsive profile">
				<?php } ?>	

	<?php  } ?>
				<br/>
				<p>
					<span class="glyphicon glyphicon-earphone text-success"></span> <?php echo $row->contact_number; ?>
				</p>
				<hr/>
				<p>
					<span class="glyphicon glyphicon-time text-success"></span>
					<strong>HIRE DATE:</strong>
					<br/>
					<?php echo $this->kp_library->convert_date_string($row->hired_date); ?>
				</p>
<?php endforeach; endif; ?>
				<hr/>
				<a href="#updateuser_picture" data-toggle="modal" class="btn btn-success">
					<span class="glyphicon glyphicon-picture" data-toggle="tooltip" title="Click to change photo"></span>
					Update Company Photo
				</a>
</div>
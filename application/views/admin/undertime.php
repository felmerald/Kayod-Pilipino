<center><h4><strong class="text-success">EMPLOYEE'S UNDERTIME</strong></h4></center>
<?php echo $this->session->flashdata('success'); ?>
<a href="<?php echo base_url();?>admin/download_undertime" class="btn btn-default">
	EXPORT
</a>
<hr/>
<div class="dataTable_wrapper">
						<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
								<thead>
										<tr>
										 	<th>FULL NAME</th>
										 	<th>DATE</th>
										 	<th>NUMBER OF HOURS</th>
											<th>OPTION</th>
										</tr>
								</thead>
								<tbody>
							<?php if($get_undertime_list): foreach($get_undertime_list as $row): ?>
										<tr>
											<td><?php echo ucwords(strtolower($row->last_name.', '.$row->first_name.' '.$row->middle_name)); ?></td>
											<td><?php echo $row->undertime_date; ?></td>
											<td><?php echo $row->undertime_number_hours;?></td>
											<td>
									<?php echo form_open(base_url().'admin/approve_employee_undertime'); ?>
											<input type="hidden" name="undertime_id" value="<?php echo $row->undertime_id ?>">
											<?php if($row->undertime_status == 'accept'):?>
													<input type="submit" class="btn btn-xs btn-default" value="APPROVE" disabled="">
											<?php else: ?>
													<input type="submit" class="btn btn-xs btn-default" value="APPROVE">
											<?php endif;?>
									<?php echo form_close(); ?>
				<?php echo form_open(base_url().'admin/deactivate_approve_employee_undertime'); ?>			
									<input type="hidden" name="undertime_id" value="<?php echo $row->undertime_id ?>">		
									<button type="submit" class="btn btn-xs btn-default">
										<span class="glyphicon glyphicon-trash"></span>
									</button>
						<?php echo form_close(); ?>
											</td>
										</tr>
								<?php endforeach; endif; ?>
								</tbody>
						</table>
				</div>
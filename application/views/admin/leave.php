<center><h4><strong class="text-success">EMPLOYEE'S LEAVE</strong></h4></center>
<?php echo $this->session->flashdata('success'); ?>
<a href="<?php echo base_url(); ?>admin/download_leave" class="btn btn-default">EXPORT</a>
<hr/>
<div class="dataTable_wrapper">
						<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
								<thead>
										<tr>
										 	<th>FULL NAME</th>
										 	<th>LEAVE TYPE</th>
										 	<th>REASON</th>
										 	<th>START</th>	
										 	<th>END</th>
											<th>HOURS PEDAY</th>
											<th>OPTION</th>
										</tr>
								</thead>
								<tbody>
								<?php if($get_requested): foreach($get_requested as $row): ?>
										<tr>
										
											<td><?php echo ucwords(strtolower($row->last_name.', '.$row->first_name.' '.$row->middle_name)); ?></td>
											<td><?php echo ucwords(strtolower($row->leave_type)); ?></td>
											<td><?php echo ucwords(strtolower($row->address)); ?></td>
											<td><?php echo $row->leave_start_date; ?></td>
											<td><?php echo $row->leave_end_date; ?></td>
											<td><?php echo $row->leave_hours_perday?></td>
											<td>
								<?php echo form_open(base_url().'admin/activate_leave'); ?>
											<input type="hidden" name="kpl_id" value="<?php echo $row->kpl_id ?>">
										<?php if($row->request_status == 'accept'): ?>
											<input type="submit" class="btn btn-xs btn-default" value="APPROVE" disabled="">
										<?php else: ?>
											<input type="submit" class="btn btn-xs btn-default" value="APPROVE">
										<?php endif; ?>
								<?php echo form_close(); ?>
								<?php echo form_open(base_url().'admin/deactivate_leave'); ?>
											<input type="hidden" name="kpl_id" value="<?php echo $row->kpl_id ?>">
												<button type="submit" class="btn btn-xs btn-danger">
													<span class="glyphicon glyphicon-trash"></span>
												</button>
								<?php echo form_close(); ?>
											</td>
										
										</tr>
										<?php endforeach; endif; ?>
								</tbody>
						</table>
				</div>
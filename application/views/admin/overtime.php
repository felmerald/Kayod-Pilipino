<center><h4><strong class="text-success">EMPLOYEE'S OVERTIME</strong></h4></center>
<a href="<?php echo base_url();?>admin/download_overtime" class="btn btn-default">Export</a>
<hr/>
<?php echo $this->session->flashdata('success'); ?>
<br/>
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
								<?php if($get_overtime_list): foreach($get_overtime_list as $row): ?>
										<tr>
											<td><?php echo ucwords(strtolower($row->last_name.', '.$row->first_name.' '.$row->middle_name)); ?></td>
											<td><?php echo $row->ot_date;?></td>
											<td><?php echo $row->ot_number_of_hours; ?></td>
											<td>
							<?php echo form_open(base_url().'admin/approve_overtime'); ?>
								<input type="hidden" name="ot_id" value="<?php echo $row->ot_id ?>">
								<?php if($row->ot_status == 'accept'): ?>
								<button type="submit" class="btn btn-xs btn-default" disabled="">
													APPROVE
												</button>
									<?php else: ?>
										<button type="submit" class="btn btn-xs btn-default">
													APPROVE
												</button>
									<?php endif; ?>
							<?php echo form_close(); ?>
							<?php echo form_open(base_url().'admin/deactivate_approve_overtime'); ?>
											<input type="hidden" name="ot_id" value="<?php echo $row->ot_id ?>">
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
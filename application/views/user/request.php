<br/>
<div class="dataTable_wrapper">
						<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
								<thead>
										<tr>
										 	<th>Employee Name</th>
										 	<th>Leave Type</th>
										 	<th>Filed On</th>
										 	<th>Number of Hours</th>
										 	<th>REMARKS</th>	
										</tr>
								</thead>
								<tbody>
									<?php if($get_all_request): foreach($get_all_request as $row): ?>
										<tr>
											<td><?php echo ucwords(strtolower($row->last_name.', '.$row->first_name.' '.$row->middle_name)); ?></td>
											<td><?php echo ucwords(strtolower($row->leave_type)); ?></td>
											<td><?php echo $this->time_ago_lib->time_ago($row->filed_on); ?></td>
											<td><?php echo $row->leave_hours_perday; ?></td>
											<td>
												<?php if($row->request_status == "pending"){ ?>
													<p class="text-danger">PENDING</p>
												<?php }else if($row->request_status == "accept"){ ?>
													<p class="text-success">APPROVE</p>
												<?php } ?>


											</td>
										</tr>
									<?php endforeach; endif; ?>
										
								</tbody>
						</table>
				</div>
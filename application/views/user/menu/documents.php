		<div class="row">
			<?php include 'sidebar.php'; ?>
			<div class="col-sm-9">
				<div class="card">
					<?php if($get_user_info): foreach($get_user_info as $row): ?>
					<h4><span class="glyphicon glyphicon-user"></span> <?php echo ucwords(strtolower($row->last_name.', '.$row->first_name.' '.$row->middle_name)); ?></h4>
					<h5><span class="glyphicon glyphicon-flag"></span> <?php echo ucwords($row->position_title); ?></h5>
				<?php endforeach; endif;?>
				</div>
				<div class="card-space"></div>
				<div class="card">
					<ol class="breadcrumb">
						  <li>
						  	<a href="<?php echo base_url(); ?>user/home">Personal</a>
						  </li>
						  <li>
						  	<a href="<?php echo base_url(); ?>user/employee/leave">Leave
						  		 <span class="badge">
                                <?php 
                                $this->db->select('kpl_id')->where('request_status','accept')->where('user_id',$this->session->userdata('login_id'));
                                 echo $this->db->count_all_results('kp_leave');
                                 ?>
                            </span>

						  	</a>
						  </li>
						  <li>
						  	<a href="<?php echo base_url(); ?>user/employee/overtime">Overtime

						  		<span class="badge">
                                <?php
                                    $this->db->select('ot_id')->where('ot_status','accept')->where('user_id',$this->session->userdata('login_id'));
                                echo $this->db->count_all_results('request_overtime');

                                 ?>
                            </span>
						  	</a>
						  </li>
						  <li>
						  	<a href="<?php echo base_url(); ?>user/employee/undertime">Undertime
						  		<span class="badge">
                                <?php 
                                $this->db->select('undertime_id')->where('undertime_status','accept')->where('user_id',$this->session->userdata('login_id'));
                                 echo $this->db->count_all_results('request_undertime');
                                 ?>
                            </span>
						  	</a>
						  </li>
						  <li class="active">
						  Documents
						  	<!-- <a href="<?php echo base_url(); ?>user/employee/documents">Documents</a> -->
						  </li>
					</ol>
				</div>

				<br/>
				<div class="dataTable_wrapper">
						<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
								<thead>
										<tr>
										 	
										 	<th>Image</th>
										 	<th>Created</th>
										 	<th>Modified</th>
										 	<th>Option</th>	
										</tr>
								</thead>
								<tbody>
								<?php if($get_documents): foreach($get_documents as $row):?>
										<tr>
										
											<td><img src="<?php echo base_url(); ?>upload/<?php echo $row->document_image; ?>" style="height:50px;width:50px;"></td>
											<td><?php echo $this->time_ago_lib->time_ago($row->created); ?></td>
											<td>
												<?php if($row->modified != '0000-00-00 00:00:00'){ ?>
													<?php echo $this->time_ago_lib->time_ago($row->modified); ?>
												<?php }else{ ?>
													not yet modified
												<?php } ?>
											</td>
											<td>
												<a href="#update<?php echo $row->document_id; ?>" class="btn btn-default" data-toggle="modal">
													<span class="glyphicon glyphicon-edit"></span>
												</a>
												<a href="#delete<?php echo $row->document_id; ?>" class="btn btn-default" data-toggle="modal">
													<span class="glyphicon glyphicon-trash"></span>
												</a>
											</td>
										
										</tr>
										<?php endforeach; endif; ?>
								</tbody>
						</table>
				</div>
				<a href="#upload" class="btn btn-success" data-toggle="modal">
					Upload File Image
				</a>


			</div>
		</div>
	<?php echo $this->session->flashdata('success'); ?>
<!-- /////Modal///// -->

		<div id="upload" class="modal fade" tabindex="-1" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<strong class="text-success">Upload Scanned SSS or Phil health</strong>
						</div>
						<div class="modal-body">
						<?php echo form_open_multipart(base_url().'user/upload_documents'); ?>
							<input type="hidden" name="user_id" value="<?php echo $this->session->userdata('login_id'); ?>">

							<div class="form-group">
								<label>Type of Document</label>
								<select name="document_type" class="form-control" required>
								<?php $query = $this->db->get('social');
								foreach($query->result() as $row): ?>
								<option value="<?php echo $row->social_is; ?>">
								<?php echo ucwords(strtolower($row->name)); ?>
								</option>
									<?php endforeach; ?>
								</select>
							</div>

							<div class="form-group">
							<input type="file" name="userfile" class="filestyle" data-buttonBefore="true" required>
							</div>			
						</div>
						<div class="modal-footer">
								<input type="submit" class="btn btn-success" value="SAVE">
						<?php echo form_close(); ?>
								<button type="button" data-dismiss="modal" class="btn btn-danger">CLOSE</button>
						</div>
					</div>
				</div>
		</div>

		<?php $query = $this->db->get('kp_documents'); foreach($query->result() as $row): ?>
		<div id="update<?php echo $row->document_id; ?>" class="modal fade" tabindex="-1" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<strong class="text-success">Update</strong>
						</div>
						<div class="modal-body">
						<?php echo form_open_multipart(base_url().'user/upload_documents_update'); ?>
						
							<div class="form-group">
							<input type="file" name="userfile" class="filestyle" data-buttonBefore="true">
							</div>			
						</div>
						<div class="modal-footer">
								<input type="submit" class="btn btn-success" value="SAVE">
						<?php echo form_close(); ?>
								<button type="button" data-dismiss="modal" class="btn btn-danger">CLOSE</button>
						</div>
					</div>
				</div>
		</div>
	<?php endforeach;?>

<?php $query = $this->db->get('kp_documents'); foreach($query->result() as $row): ?>
	<div id="delete<?php echo $row->document_id; ?>" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">Please confirm</div>
			<div class="modal-body">
				<h4 class="text-danger">Are you sure you want to delete this file?</h4>
			</div>
			<div class="modal-footer">
				<a href="<?php echo base_url(); ?>user/delete_document?id=<?php echo $row->document_id; ?>" type="submit" value="DELETE" class="btn btn-danger">DELETE</a>
	
				<button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
<?php endforeach;?>
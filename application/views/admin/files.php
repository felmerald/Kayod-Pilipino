<div class="row">


<div class="col-sm-12">

<p><span class="glyphicon glyphicon-search"></span> SEARCH DOCUMENT:</p>

						<div class="dataTable_wrapper">
						<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
								<thead>
									<tr>
										<th>IMAGE</th>
										<th>OWNER</th>
										<th>TYPE</th>
									</tr>
								</thead>
								<tbody>
								<?php if($get_documents): foreach($get_documents as $row): ?>
									<tr>
										<td>
											<a href="#zoom<?php echo $row->document_id; ?>" data-toggle="modal">
												<img src="<?php echo base_url(); ?>upload/<?php echo $row->document_image; ?>" class="img-responsive" style="height:50px; width:50px">
											</a>	
										</td>
										<td>
											<?php echo ucwords(strtolower($row->last_name.', '.$row->first_name.' '.$row->middle_name)); ?>
										</td>
										<td>
											<?php echo strtoupper($row->document_type); ?>
										</td>
									</tr>
								<?php endforeach; endif; ?>
								</tbody>


						</table>
						</div>

</div>

</div>

<!-- modal -->

<?php $query = $this->db->get('kp_documents'); foreach($query->result() as $row): ?>
<div id="zoom<?php echo $row->document_id; ?>" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" data-dismiss="modal" class="btn btn-default">Close</button>
			</div>
			<div class="modal-body">
			<?php $this->db->where('document_id',$row->document_id); $query = $this->db->get('kp_documents'); foreach($query->result() as $data): ?>
					<img src="<?php echo base_url(); ?>upload/<?php echo $data->document_image ;?>" class="img-responsive";>
		<?php endforeach; ?>
			</div>
		</div>
	</div>
</div>
<?php endforeach; ?>

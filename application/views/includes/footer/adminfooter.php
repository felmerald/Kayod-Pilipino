		
		</div> <!--end of container-->

		<script src="<?php echo base_url(); ?>resources/js/jquery.min.js"></script>
		<script src="<?php echo base_url(); ?>resources/js/bootstrap.js"></script>
		<!-- DataTables -->
  <script type="text/javascript" src="<?php echo base_url();?>resources/datatables/js/jquery.dataTables.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url();?>resources/datatables/js/dataTables.bootstrap.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url();?>resources/datatables/js/dataTables.responsive.js"></script>
	<!-- Added by fel -->
	<script type="text/javascript" src="<?php echo base_url();?>resources/js/bootstrap-filestyle.min.js"></script>
	 <script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
                responsive: true
        });
    });
    </script>
    	<script type="text/javascript">
    			// tooltip
			$(function () { $('[data-toggle="tooltip"]').tooltip()});
			// filestyle
			$(":file").filestyle({buttonBefore: true});
		</script>
		<script type="text/javascript">
			  window.setTimeout(function(){
			      $(".alert").slideUp(500, function(){
			        $this.remove();
			      });
			  }, 7000);
		</script>
		<script type="text/javascript">
			  window.setTimeout(function(){
			      $(".label").slideUp(500, function(){
			        $this.remove();
			      });
			  }, 10000);
		</script>
		<script type="text/javascript">
			var loadimage = function(event){
  			var upload8 = document.getElementById('upload8');
 		    upload8.src = URL.createObjectURL(event.target.files[0]);
			};
		</script>
		<script type="text/javascript">
			function getsearchQuery(){
  			var form = document.getElementById("myform");
  			var keyword = document.getElementById("userprofile");
  			form.action = "http://localhost/kayod_pilipino/admin/employees/search?keyword="+escape(keyword.value);
  			return true;
 			}
		</script>
		
	</body>
</html>
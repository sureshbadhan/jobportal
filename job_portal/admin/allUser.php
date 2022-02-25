<?php
$path = __DIR__;
require($path."/../include/main.php");		
include($path."/../include/adminHeader.php");

if(!isset($_SESSION['adminDetail']['id'])){
	header("Location:index.php");
} ?>
<div class="page-title">All Users</div>
<div class="container job-listing">
	<!-- job listing start here -->
	<div class="panel panel-default panel-order">
		<div class="panel-body">
			<div class="row">
				<div class="row"><!-- left content-->
					<div class="container">
						<div class="col-md-12  animated fadeInUp">
							<div class="widget">
								<div class="table-responsive"><br><br>
									<table class="table user-list">
									</table>
								</div>
							</div>
						</div><!-- end timeline content-->
					</div>
				</div>
			</div>	
		</div>			 
	</div><!-- job listing end here -->
</div>
<script type="text/javascript">
	$(document).ready(function(){
		$.ajax({
			type: 'POST',
			url: 'allUserListingAjax.php?allJobs=1',
			success: function(data){
				$('.user-list').html(data);
			}
		});
	});

	function deleteFun(deleteid){
		var conf = confirm("Are you sure you want to delete this User!");
		if(conf == true){
			$.ajax({
				type: 'POST',
				url: 'deleteUser.php',
				data:{deleteid:deleteid},
			});
		}
	}

	function blockFun(blockId){
		var conf = confirm("Are you sure you want to Block this User!");
		if(conf == true){
			$.ajax({
				type: 'POST',
				url: 'blockUser.php',
				data:{blockId:blockId},
			});
		}
	}

	function unblockFun(unblockId){
			$.ajax({
				type: 'POST',
				url: 'activeUser.php',
				data:{unblockId:unblockId},
			});
	}
</script>
<?php include($path."/../include/adminFooter.php");?>
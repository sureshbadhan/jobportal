<?php
$path = __DIR__;
require($path."/../include/main.php");		
include($path."/../include/adminHeader.php");

if(!isset($_SESSION['adminDetail']['id'])){
	header("Location:index.php");
}?>
<div id="deactive"></div>
<div class="page-title">All Jobs</div>
<div class="container job-listing" id="listing"><!-- job listing start here -->
	<div class="panel panel-default panel-order">
		<div class="panel-body">
			<div class="row"><!-- left content-->
				<div class="row">
					<div class="container">
						<div class="col-md-12  animated fadeInUp">
							<div class="widget">
								<div class="table-responsive"><br><br>
									<table class="table job-list">
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
<?php include($path."/../include/adminFooter.php"); ?>

<script type="text/javascript">
$(document).ready(function(){
	$.ajax({
        type: 'POST',
        url: 'allJobsListingAjax.php?allJobs=1',
		success: function(data){
			$('.job-list').html(data);
		}
	});
});

function deleteFun(deleteid){
	var conf = confirm("Are you sure you want to delete this Job!");
	if(conf == true){
		$.ajax({
			type: 'POST',
			url: 'job_delete.php',
			data:{deleteid:deleteid},
		});
	}
}

function deactiveFun(deactiveId){
	var conf = confirm("Are you sure you want to deactivate this Job!");
	if(conf == true){
		$.ajax({
			type: 'POST',
			url: 'deactiveJob.php',
			data:{deactiveId:deactiveId},
		});
	}
}

function activeFun(activeId){
		$.ajax({
			type: 'POST',
			url: 'activateJob.php',
			data:{activeId:activeId},
		});
}
</script>
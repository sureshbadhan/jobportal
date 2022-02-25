<?php
$path = __DIR__;
require($path."/../include/main.php");		
include($path."/../include/adminHeader.php");

if(!isset($_SESSION['adminDetail']['id'])){
	header("Location:index.php");
}?>
<div id="deactive"></div>
<div class="page-title">All CMS </div>
<div class="container job-listing"><!-- job listing start here -->
	<div class="panel panel-default panel-order">
		<div class="panel-body">
			<div class="row"><!-- left content-->
				<div class="row ">
					<div class="container">
						<div class="col-md-12 animated fadeInUp">
							<div class="widget">
								<div class="table-responsive"><br><br>
									<table class="table cms-list">
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
        url: 'allCmsListingAjax.php?allJobs=1',
		success: function(data){
			$('.cms-list').html(data);
		}
	});
});

function deleteFun(deleteid){
	var conf = confirm("Are you sure you want to delete this Content!");
	if(conf == true){
		$.ajax({
			type: 'POST',
			url: 'deleteContent.php',
			data:{deleteid:deleteid},
		});
	}
}

function unPublish(id){
	$.ajax({
		type: 'POST',
		url: 'unPublish.php',
		data:{id:id},
	});
}

function publishFun(id){
	$.ajax({
		type: 'POST',
		url: 'publish.php',
		data:{id:id},
	});
}
</script>
<?php include($path."/../include/adminFooter.php"); ?>
<?php
$path = __DIR__;
require($path."/../include/main.php");		
include($path."/../include/adminHeader.php");

if(!isset($_SESSION['adminDetail']['id'])){
	header("Location:index.php");
}
$id = $_GET['id'];
$row = $admin->getcmsPageDetail($id);
?>

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
									<table class="table cms-list">
										<?php echo ucfirst($row['description']);?>
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
<?php include($path."/../include/adminFooter.php");?>
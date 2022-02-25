<?php
$dirPath = __DIR__;
require($dirPath."/include/main.php");					
include($dirPath."/include/header.php");

if(!isset($_SESSION['userDetail']['id'])){
	header("Location:index.php");
}
$UserId = $_SESSION['userDetail']['id'];
$jobDetails = $user->getMyJobs($UserId);
?>
<div class="page-title">My jobs</div>
<br>
<div class="container job-listing">
	<?php if(isset($jobDetails) && is_array($jobDetails) && count($jobDetails)>0){
				foreach ($jobDetails as $key=>$value){ if(isset($value['job_active']) && $value['job_active']==0){?>
					<div class="panel panel-default panel-order">
						<div class="panel-body">
							<div class="row">
								<div class="col-sm-2 img-area-product"><?php echo (isset($_SESSION['userDetail']['company_logo']))? "<img src='gallery/employerLogo/".$_SESSION['userDetail']['company_logo']."' class='media-object'>":"";?></div>		
								<div class="col-sm-10 right-area">
									<div class="row">
											<div class="col-sm-2 pull-right price-status">
												<div class="pull-right">
													<a href="job_edit.php?job_id=<?php echo (isset($value['jobid']))?$value['jobid']:""; ?>" class="btn btn-primary" role="button"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>&nbsp;&nbsp;
													<a href="delete_job.php?job_id=<?php echo (isset($value['jobid']))?$value['jobid']:""; ?>" class="btn btn-danger" role="button" onclick="return confirm('Are you sure you want to delete this job?');"><i class="fa fa-trash" aria-hidden="true"></i></a>
												</div>
											</div>
									  <div class="col-sm-10 right-top-area">
										<div class="product-title-dashboard">
											<a href="job_detail.php?job_id=<?php echo (isset($value['jobid']))?$value['jobid']:""; ?>"><?php echo ucfirst($value['job_title']) ?></a>
										</div>							
										<div class="job-description">
											<?php echo (isset($value['description']))?ucfirst($value['description']):"";?>&nbsp;&nbsp;<a class="see-more-btn" href="job_detail.php?job_id=<?php echo (isset($value['jobid']))?$value['jobid']:""; ?>"><small>See detail</small></a>
										</div>
									  </div>
									  <div class="col-sm-12 right-bottom-area">
										Posted on: <?php echo (isset($value['date_time']))?$value['date_time']:""; ?>
									  </div>
									</div>
								</div>
							</div>
						</div>
					</div>
	<?php		}			
			}	
		}else{
			echo "<h4><center>You have not created any jobs yet !</h4><center>";
		}?>
</div>			
<?php include($dirPath."/include/footer.php");?>
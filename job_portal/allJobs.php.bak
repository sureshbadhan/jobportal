<?php
$dirPath = __DIR__;
require($dirPath."/include/main.php");					
include($dirPath."/include/header.php");

if(!isset($_SESSION['userDetail']['id'])){
	header("Location:index.php");
}
$allJobs=$user->getAlljobs();

if(isset($_POST['submit'])){
	$job_id =$_POST['jobId'];
	$userId = $_SESSION['userDetail']['id'];
	$description = $_POST['description'];
	$fileExtension = pathinfo($_FILES['upload_cv']['name'], PATHINFO_EXTENSION);
	if($fileExtension != "doc" &&  $fileExtension != "docx" && $fileExtension != "pdf"){
		$msg = "Please choose document doc, docx, pdf file only !";
		$_SESSION['msg'] = $msg; 
		$_SESSION['status'] = 'error';
		header('location:create_job.php');
		exit();
	}else{
		$document_name = uniqid().'.'.$_FILES['upload_cv']['name'];
		$temp_name = $_FILES['upload_cv']['tmp_name'];
		$moveToFolder = "gallery/seekerDocument/".$document_name;
		move_uploaded_file($temp_name,$moveToFolder);
	}
	$result = $user->apply_job($job_id,$userId,$description,$document_name);
	if(isset($result) && $result>0){
		$msg = "Application submitted successfully!";
		$_SESSION['msg'] = $msg; 
		$_SESSION['status'] = 'success';
		header("location:alljobs.php");
		exit();
	}else{
		$msg = "Application not submitted successfully!";
		$_SESSION['msg'] = $msg; 
		$_SESSION['status'] = 'error';
		header("location:alljobs.php");
		exit();
	}
}?>
<div class="page-title">All jobs</div>
<br>
<?php 
if(isset($allJobs) && is_array($allJobs) && count($allJobs)>0){
	foreach ($allJobs as $key=>$value){
		$appliedJobDetail = $user->getAppliedJob($_SESSION['userDetail']['id'],$value['jobid']);?>
		<div class="container job-listing">
			<div class="panel panel-default panel-order">
				<div class="panel-body">
					<div class="row">
						<div class="col-sm-2 img-area-product"><?php echo "<img src='gallery/employerLogo/".$value['company_logo']."' class='media-object'>";?></div>
						<div class="col-sm-10 right-area">
							<div class="row">
								<?php if(isset($appliedJobDetail) && empty($appliedJobDetail)){ ?>
								<div class="col-sm-2 pull-right price-status">
									<div class="pull-right">
										<i button type="button" class="btn btn-info btn-lg" id="mybtn" data-toggle="modal" data-target="#myModal" data-id="<?php echo (isset($value['jobid']))? $value['jobid'] : ""; ?>">Apply</button></i>
									</div>
								</div>
								<?php } ?>
								<div class="col-sm-10 right-top-area">
									<div class="product-title-dashboard">
										<a href="job_detail.php?job_id=<?php echo $value['jobid']; ?>"><?php echo (isset($value['job_title']))? ucfirst($value['job_title']) : ""; ?></a>
									</div>	
									<div class="job-description">
										<?php echo (isset($value['description'])) ? ucfirst($value['description']) : "";?>&nbsp;&nbsp;<a class="see-more-btn" href="job_detail.php?job_id=<?php echo (isset($value['jobid']))? $value['jobid'] : "";?>"><small>See detail</small></a>
									</div>
								</div>
							  <div class="col-sm-12 right-bottom-area">
								Posted on: <?php echo (isset($value['date_time']))? $value['date_time']: ""; ?>
							  </div>
							</div>
						</div>
					</div>	
				</div>
			</div>
		</div>
<?php }
}else{
	echo "Job not Found!";
}?>	
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
			  <button type="button" class="close" data-dismiss="modal">&times;</button>
			  <h4 class="modal-title">Complete your some requirement</h4>
			</div>
			<form method="post" name="modal_form" id="modal_form" enctype="multipart/form-data" >
				<div class="modal-body">
					<div class="form-group">		
					</div>
					<div class="form-group">
						<label class="col-sm-10" >About your self</label>
						<div class="col-sm-15">
							<textarea name="description" rows="7" cols="76" class="form-control" id="description"></textarea>
						</div><br>
						<label class="col-sm-10" >Upload Cv</label>
						<div class="col-sm-15">
							<input type="file" name="upload_cv"  value="browse" class="form-email form-control" id="upload_cv" />
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<div class="col-sm-3 pull-right">
						<button type="submit" name="submit" class="btn btn-block">save</button>
					</div>
				</div>
				<input type="hidden" name="jobId" id="job_Id" value= "">
			</form>
      </div>
    </div>
 </div>	
<script>
$(document).ready(function(){
  $('#myModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); 
        var id = button.data('id');
        $(this).find('#job_Id').val(id);
    });
});
</script>
<?php include($dirPath."/include/footer.php");?>
<?php 
$path = __DIR__;
include($path."/../include/main.php");		
include($path."/../include/adminHeader.php");

if(!isset($_SESSION['adminDetail']['id'])){
	header("Location:index.php");
}
$jobId = $_GET['jobId'];
$jobDetail = $user->jobDetails($jobId);
?>

<div class="page-title">Job Detail</div>
<div class="container job-listing">
	<div class="thumbnail" style="height:auto;overflow:hidden;">
		<div class="col-sm-2">
			<div style="border:1px solid #ccc;margin-top: 20px;">
				<?php echo "<img src='../gallery/employerLogo/".$jobDetail['company_logo']."' class='media-object'>";?>
			</div>
		</div>
		<div class="col-sm-10">			
			<div class="caption-full">
				<h4 class="pull-right"><?php echo $jobDetail['salary'];?></h4>
				<h4>
					<a href=""><?php echo ucfirst($jobDetail['job_title']); ?></a>
					<label style="font-size:12px;display:block;color: #999;margin-top: 5px;"><strong>Posted On:</strong>
						<?php if(isset($_SESSION['userDetail']['user_type']) && $_SESSION['userDetail']['user_type']=='Employer'){
									echo $jobDetail['date_time']; echo " by "; echo $_SESSION['userDetail']['first_name']." ".$_SESSION['userDetail']['last_name'];
								}else{
									echo $jobDetail['date_time']; echo " by "; echo $jobDetail['first_name']." ".$jobDetail['last_name'];
								}?>
					</label>
				</h4>
				<p><?php echo (isset($jobDetail['description']))?ucfirst($jobDetail['description']):""; ?></p>
				<br>
				<div class="other-desc">Other Information</div>
				<div class="other-desc-full">
					<div class="row">
						<div class="col-sm-9">
							<table class="table table-bordered">
								<tr>
									<td width="50%;"><strong>Age:</strong> <?php echo (isset($jobDetail['age']))?$jobDetail['age']:""; ?></td>
									<td width="50%;"><strong>Experience:</strong> <?php echo     (isset($jobDetail['experience']))?$jobDetail['experience']:""; ?></td>
								</tr>
								<tr>
									<td width="50%;"><strong>Skills:</strong> <?php echo (isset($jobDetail['skills']))?$jobDetail['skills']:""; ?></td>
									<td width="50%;"><strong>Location:</strong> <?php echo (isset($jobDetail['address']))?$jobDetail['address']:""; ?> </td>
								</tr>
								<tr>
									<td width="50%;"><strong>Salary:</strong> <?php echo (isset($jobDetail['salary']))?$jobDetail['salary']:""; ?></td>
									<td width="50%;"><strong>Designation:</strong> <?php echo (isset($jobDetail['designation']))?$jobDetail['designation']:""; ?></td>
								</tr>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="form-top-left">
		<h3>Applicants</h3><br>
	</div>
	<?php $Applied_jobDetails = $user->getApplied_jobdetails();
	if(isset($Applied_jobDetails) && is_array($Applied_jobDetails) && count($Applied_jobDetails)>0){
			foreach ($Applied_jobDetails as $key=>$value){
				if($_GET['jobId']==$value['job_id']){?>
					<div class="job-listing">
						<div class="row">
							<div class="col-sm-6">
								<div class="thumbnail">
									<div class="caption">
										<p style="white-space:nowrap;overflow:hidden;text-overflow:ellipsis"><b>Name:</b>
											<?php echo (isset($value['first_name']))?$value['first_name']." ":""; echo (isset($value['last_name']))?$value['last_name']:""; ?></p>
											<b>Applied On:</b><?php echo (isset($value['date_time']))?$value['date_time']:""; ?></p>
											<b>CV:</b><a href="gallery/seekerDocument/<?php echo (isset($value['cv']))?$value['cv']:""; ?>"><?php echo (isset($value['cv']))?$value['cv']:""; ?></a>
											</p>
									</div>
								</div>
							</div>
						</div>
					</div>
	<?php 		}
			}
		}?>
	</div>		
<?php include($path."/../include/adminFooter.php"); ?>	
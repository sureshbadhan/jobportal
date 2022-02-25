<?php
$dirPath = __DIR__;
require($dirPath."/include/main.php");					
include($dirPath."/include/header.php");

if(!isset($_SESSION['userDetail']['id'])){
	header("Location:index.php");
}
if(isset($_SESSION['userDetail']['user_type']) && $_SESSION['userDetail']['user_type']=='Employer'){
	$jobId = $_GET['job_id'];
	$jobDetail = $user->jobDetails($jobId);
	$Apply_jobDetails = $user->getApplied_jobdetails();
}
else{
	$jobId = $_GET['job_id'];
	$jobDetail=$user->jobDetails($jobId);
	$Apply_jobDetails = $user->getApplied_jobdetails();
}?>

<div class="page-title">Job Detail</div>
<div class="container job-listing">
	<div class="thumbnail" style="height:auto;overflow:hidden;">
		<div class="col-sm-2">
			<div style="border:1px solid #ccc;margin-top: 20px;">
				<?php if(isset($_SESSION['userDetail']['user_type']) && $_SESSION['userDetail']['user_type']=='Employer'){
							echo "<img src='gallery/employerLogo/".$_SESSION['userDetail']['company_logo']."' class='media-object'>";
						}else{ 
							echo "<img src='gallery/employerLogo/".$jobDetail['company_logo']."' class='media-object'>";
							}
				?>
			</div>
		</div>
		<div class="col-sm-10">			
			<div class="caption-full">
				<h4 class="pull-right"><?php echo (isset($jobDetail['salary'])) ? $jobDetail['salary'] : "";?></h4>
				<h4>
					<a href=""><?php echo (isset($jobDetail['job_title']))? ucfirst($jobDetail['job_title']) : ""; ?></a>
					<label style="font-size:12px;display:block;color: #999;margin-top: 5px;"><strong>Posted On:</strong>
						<?php if(isset($_SESSION['userDetail']['user_type']) && $_SESSION['userDetail']['user_type']=='Employer'){
									echo (isset($jobDetail['date_time'])) ? $jobDetail['date_time'] : ""; echo " by "; echo $_SESSION['userDetail']['first_name']." ".$_SESSION['userDetail']['last_name'];
								}else{
									echo (isset($jobDetail['date_time'])) ? $jobDetail['date_time'] : ""; echo " by "; echo (isset($jobDetail['first_name'])) ? $jobDetail['first_name']." " : ""; echo (isset($jobDetail['last_name'])) ? $jobDetail['last_name'] : "";
								}?>
					</label>
				</h4>
				<p><?php echo (isset($jobDetail['description'])) ? ucfirst($jobDetail['description']) : ""; ?></p>
				<br>
				<div class="other-desc">Other Information</div>
				<div class="other-desc-full">
					<div class="row">
						<div class="col-sm-9">
							<table class="table table-bordered">
								<tr
									<td width="50%;"><strong>Age:</strong> <?php echo (isset($jobDetail['age'])) ? $jobDetail['age']: ""; ?> </td>
									<td width="50%;"><strong>Experience:</strong> <?php echo (isset($jobDetail['experience'])) ? $jobDetail['experience'] : ""; ?></td>
								</tr>
								<tr>
									<td width="50%;"><strong>Skills:</strong> <?php echo (isset($jobDetail['skills']))?$jobDetail['skills']:""; ?></td>
									<td width="50%;"><strong>Location:</strong> <?php echo (isset($jobDetail['address']))?$jobDetail['address'] : ""; ?> </td>
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
	<div class="col-sm-7">
		<div class="form-top-left">
			<h3>Applicants</h3><br>
		</div>
		<style>
			#applicant {
				  word-wrap: break-word;
				}
		</style>
		<?php if(isset($_SESSION['userDetail']['user_type']) && $_SESSION['userDetail']['user_type']=='Employer'){
				if(isset($Apply_jobDetails) && is_array($Apply_jobDetails) && count($Apply_jobDetails)>0){
					foreach ($Apply_jobDetails as $key=>$value){
						if($_GET['job_id']==$value['job_id']){?>
							<div class="job-listing">
								<div class="row">
									<div class="col-sm-6">
										<div class="thumbnail" id="applicant">
											<div class="caption">
												<p style="white-space:nowrap;overflow:hidden;text-overflow:ellipsis"><b>Name:</b>
													<?php echo (isset($value['first_name']))?$value['first_name']." ":""; echo (isset($value['last_name']))?$value['last_name']:"";?></p>
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
				}
		}else{ $appliedJobDetail = $user->getAppliedJob($_SESSION['userDetail']['id'],$jobId);
			if(isset($appliedJobDetail) && is_array($appliedJobDetail) && count($appliedJobDetail)>0){
					foreach ($appliedJobDetail as $key=>$value){?>
						<div class="job-listing">
							<div class="row">
								<div class="col-sm-6">
									<div class="thumbnail" id="applicant">
										<div class="caption">
											<p style="white-space:nowrap;overflow:hidden;text-overflow:ellipsis"><b>Name:</b>
												<?php echo (isset($_SESSION['userDetail']['first_name']))?$_SESSION['userDetail']['first_name']." ":""; echo (isset($_SESSION['userDetail']['last_name']))?$_SESSION['userDetail']['last_name']:"";?></p>
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
	<div class="col-sm-5">
		<?php if(isset($_SESSION['userDetail']['user_type']) && $_SESSION['userDetail']['user_type']=="Seeker"){?>	
			<div id="map_canvas"></div>	
			<style>
			  #map_canvas {
				height: 400px; 
				width: 102%;
			   }
			</style>
			<div id="map_canvas"></div>
		<?php }?>	
	</div>
</div>
<script async defer
	src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCM3MHXq2-bKKzDj-5hjIIeswLAc80FUTc&callback=initialize">
</script>
<script>
  var geocoder;
  var map;
  function initialize() {
	geocoder = new google.maps.Geocoder();
	var mapOptions = {
	  zoom: 12,
	  mapTypeId: google.maps.MapTypeId.ROADMAP
	}
	map = new google.maps.Map(document.getElementById('map_canvas'), mapOptions);
	var address = "<?php echo $jobDetail['address']; ?>"; 
			console.log(address);
	geocoder.geocode( { 'address': address}, function(results, status) {
	  if (status == google.maps.GeocoderStatus.OK) {
		map.setCenter(results[0].geometry.location);
		var marker = new google.maps.Marker({
			map: map,
			position: results[0].geometry.location
		});
	  } else {
		alert('Geocode was not successful for the following reashttps://maps.googleapis.com/maps/api/js?key=AIzaSyCM3MHXq2-bKKzDj-5hjIIeswLAc80FUTc&callback=initializeon: ' + status);
	  }
	});

  }
</script>
<?php include($dirPath."/include/footer.php");?>
<?php
$dirPath = __DIR__;
require($dirPath."/include/main.php");					
include($dirPath."/include/header.php");

if(!isset($_SESSION['userDetail']['id'])){
	header("Location:index.php");
}
$jobId = $_GET['job_id'];
$jobDetail=$user->jobDetails($jobId);

if(isset($_POST['submit'])){
	$jobId = $_GET['job_id'];
	$job_title = $_POST['job_title'];
	$description = $_POST['description'];
	$salary = $_POST['salary'];
	$age = $_POST['age'];
	$experience = $_POST['experience'];
	$skill = $_POST['skill'];
	$location = $_POST['location'];
	$designation = $_POST['designation'];
	if(isset($_FILES['upload_document']['name']) && !empty($_FILES['upload_document']['name'])){
		$fileExtension = pathinfo($_FILES['upload_document']['name'], PATHINFO_EXTENSION);
		if($fileExtension != "doc" &&  $fileExtension != "docx" && $fileExtension != "pdf"){
			$msg = "Please choose document doc, docx, pdf file only !";
			$_SESSION['msg'] = $msg; 
			$_SESSION['status'] = 'error';
			header('location:create_job.php');
			exit();
		}else{
			$document_name = uniqid().'.'.$_FILES['upload_document']['name'];
			$temp_name = $_FILES['upload_document']['tmp_name'];
			$moveToFolder = "gallery/employerDocument/".$document_name;
			(isset($row['company_logo']))? unlink($dirPath."/gallery/employerDocument/".$row['document']):"";
			move_uploaded_file($temp_name,$moveToFolder);
		}
	}
	$result=$user->jobEdit($job_title, $description, $salary, $age, $experience, $skill, $location, $designation, $document_name,$jobId);
	if(isset($result) && $result>0){
		$msg = "Record has been updated sucessfully!";
		$_SESSION['msg'] = $msg; 
		$_SESSION['status'] = 'success';
		header("location:my_jobs.php");
	}else{
		$msg = "Record has been not updated sucessfully!";
		$_SESSION['msg'] = $msg; 
		$_SESSION['status'] = 'error';
		header("location:job_edit.php?job_id=$jobId");
	}
}?>
<div class="container">
	<div class="col-sm-12">
		<div class="form-box">
			<div class="form-top">
				<div class="form-top-left">
					<h3>Edit job</h3>
				</div>
				<div class="form-top-right">
					<i class="fa fa-key"></i>
				</div>
			</div>
			<div class="form-bottom">
				<form role="form" action="" method="POST" enctype="multipart/form-data" class="form-horizontal" id="editJob_form" name="editJob_form"> 
					<div class="form-group">
						<label class="col-sm-2">Job title</label>
						<div class="col-sm-9">
							<input type="text" name="job_title" placeholder="Job title..." class="form-control" id="form-job-title" value="<?php echo (isset($jobDetail['job_title']))?$jobDetail['job_title']:""; ?>">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2">Description</label>
						<div class="col-sm-9">
							<textarea  name="description" rows="5" cols="75" placeholder="Description..." class="form-control" id="form-des"><?php echo (isset($jobDetail['description']))?$jobDetail['description']:""; ?></textarea>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2">Salary</label>
						<div class="col-sm-9">
							<label for="salary"></label>
							<input type="text" id="salary" name="salary" style="border:0; color:#f6931f; font-weight:bold;" value="">
							<div id="salary-range"></div>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2">Age</label>
						<div class="col-sm-9">
							<input type="text" name="age" placeholder="Age..." class="form-control" id="form-age" value="<?php echo (isset($jobDetail['age']))?$jobDetail['age']:""; ?>">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2">Experience</label>
						<div class="col-sm-9">
							<label for="experience"></label>
							<input type="text" id="experience" name="experience" style="border:0; color:#f6931f; font-weight:bold;" value="">
							<div id="experience-range"></div>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2">Skills</label>
						<div class="col-sm-9">
							<input type="text" name="skill" placeholder="Skills..." class="form-control" id="seeker_skill" value="<?php echo (isset($jobDetail['skills']))?$jobDetail['skills']:""; ?>">	
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2">Location</label>
						<div class="col-sm-9">
							<input type="text" name="location" placeholder="Location..." class=" form-control" id="form-location" value="<?php echo (isset($jobDetail['address']))?$jobDetail['address']:""; ?>">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2">Designation</label>
						<div class="col-sm-9">
							<input type="text" name="designation" placeholder="Designation..." class="form-control" id="form-designation" value="<?php echo (isset($jobDetail['designation']))?$jobDetail['designation']:""; ?>">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2" >Upload document</label>
						<div class="col-sm-9">
							<input name="upload_document" type="file" id="fileToUpload" placeholder="..." enctype="multipart/form-data" class="form-email form-control" value="">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2" ></label>
						<div class="col-sm-9">
							<button type="submit" name="submit" class="btn" style="width:auto;">Update</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
$(document).ready(function (){
	$( function() {
		$( "#salary-range" ).slider({
		  range: true,
		  min: 0,
		  max: 50,
		  values: [1, 5],
		  slide: function( event, ui ) {
			$( "#salary" ).val(ui.values[ 0 ] + " - " + ui.values[ 1 ]+ " in Lakhs" );
		  }
		});
		$( "#salary" ).val(  $( "#salary-range" ).slider( "values", 0  ) +
		  " - " + $( "#salary-range" ).slider( "values", 1 ) +" in Lakhs");
	});
});	

$(document).ready(function (){
	$( function() {
		$( "#experience-range" ).slider({
		  range: true,
		  min: 0,
		  max: 30,
		  values: [1,5],
		  slide: function( event, ui ) {
			$( "#experience" ).val(ui.values[ 0 ] + " - " + ui.values[ 1 ]+ " Year" );
		  }
		});
		$( "#experience" ).val(  $( "#experience-range" ).slider( "values", 0  ) +
		  " - " + $( "#experience-range" ).slider( "values", 1 ) +" Year");
	});
});

$(document).ready(function (){
	var availabelskills = ["Core Php","Html","Javascript","Css","Wordpress","Mysql","jQuery","Ajax","Good Communication","Java","Python","Angular"];
	$("#seeker_skill").autocomplete({
		source:availabelskills,
	});   
});	
	
$(document).ready( function (){
	$("#upload_document").change(function () {
        var fileExtension = ['doc', 'docx', 'pdf'];
        if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
            alert("Only formats are allowed : "+fileExtension.join(', '));
        }
    });
 });	
</script>
<?php include($dirPath."/include/footer.php");?>			
			
			
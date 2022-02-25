<?php
$dirPath = __DIR__;
include($dirPath."/include/connection.php");
include($dirPath."/include/main.php");					

$jobId = $_GET['job_id'];
$result = $user->deleteJob($jobId);
if(isset($result) && $result>0){
	$msg = "Job has been Deleted sucessfully!";
		$_SESSION['msg'] = $msg; 
		$_SESSION['status'] = 'success';
		header("location:my_jobs.php");
		
	}else{
		$msg = "Job has been not Deleted sucessfully!";
		$_SESSION['msg'] = $msg; 
		$_SESSION['status'] = 'error';
		header("location:job_management.php");
	}
?>
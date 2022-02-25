<?php  
$path = __DIR__;
require($path."/../include/main.php");			

if(!isset($_SESSION['adminDetail']['id'])){
	header("Location:index.php");
}
if(isset($_POST['deactiveId'])){
	$jobId=$_POST['deactiveId'];
	$result = $admin->deactiveJob($jobId);
	if($result){
		$msg = "Job has been deactive Successfully!";
		$_SESSION['msg'] = $msg; 
		$_SESSION['status'] = 'success';
	}else{
		$msg = "Job has been not deactive Successfully!";
		$_SESSION['msg'] = $msg; 
		$_SESSION['status'] = 'error';
	}
}?>
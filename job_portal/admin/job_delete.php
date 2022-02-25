<?php 
$path = __DIR__;
require($path."/../include/main.php");			

if(!isset($_SESSION['adminDetail']['id'])){
	header("Location:index.php");
}
if(isset($_POST['deleteid'])){
	$jobId=$_POST['deleteid'];
	$result = $user->deleteJob($jobId);
	if($result){
		$msg = "Job has been deleted Successfully!";
		$_SESSION['msg'] = $msg; 
		$_SESSION['status'] = 'success';
	}else{
		$msg = "Job has been not deleted Successfully!";
		$_SESSION['msg'] = $msg; 
		$_SESSION['status'] = 'error';
	}
}?>
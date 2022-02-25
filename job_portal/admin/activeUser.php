<?php  
$path = __DIR__;
require($path."/../include/main.php");			

if(!isset($_SESSION['adminDetail']['id'])){
	header("Location:index.php");
}
if(isset($_POST['unblockId'])){
	$userId=$_POST['unblockId'];
	$result = $admin->activeUser($userId);
	if($result){
		$msg = "Job has been active Successfully!";
		$_SESSION['msg'] = $msg; 
		$_SESSION['status'] = 'success';
	}else{
		$msg = "Job has been not active Successfully!";
		$_SESSION['msg'] = $msg; 
		$_SESSION['status'] = 'error';
	}
}?>
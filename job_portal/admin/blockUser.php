<?php  
$path = __DIR__;
require($path."/../include/main.php");			

if(!isset($_SESSION['adminDetail']['id'])){
	header("Location:index.php");
}
if(isset($_POST['blockId'])){
	$userId=$_POST['blockId'];
	$result = $admin->deactiveUser($userId);
	if($result){
		$msg = "Job has been Block Successfully!";
		$_SESSION['msg'] = $msg; 
		$_SESSION['status'] = 'success';
	}else{
		$msg = "Job has been not Block Successfully!";
		$_SESSION['msg'] = $msg; 
		$_SESSION['status'] = 'error';
	}
}?>
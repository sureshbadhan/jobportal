<?php 
$path = __DIR__;
require($path."/../include/main.php");		

if(!isset($_SESSION['adminDetail']['id'])){
	header("Location:index.php");
}
if(isset($_POST['deleteid'])){
	$userId = $_POST['deleteid'];
	$result = $admin->deleteUser($userId);
	if($result){
		$msg = "User has been delete Successfully!";
		$_SESSION['msg'] = $msg; 
		$_SESSION['status'] = 'success';
	}else{
		$msg = "User has been not delete Successfully!";
		$_SESSION['msg'] = $msg; 
		$_SESSION['status'] = 'error';
	}
}?>
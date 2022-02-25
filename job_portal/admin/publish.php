<?php  
$path = __DIR__;
require($path."/../include/main.php");

if(!isset($_SESSION['adminDetail']['id'])){
	header("Location:index.php");
}
if(isset($_POST['id'])){
	$id=$_POST['id'];
	$result = $admin->publish($id);
	if($result){
		$msg = "Content has been Published Successfully!";
		$_SESSION['msg'] = $msg; 
		$_SESSION['status'] = 'success';
	}else{
		$msg = "Content has been not Publish Successfully!";
		$_SESSION['msg'] = $msg; 
		$_SESSION['status'] = 'error';
	}
}?>
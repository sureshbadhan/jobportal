<?php 
$path = __DIR__;
require($path."/../include/main.php");	

if(!isset($_SESSION['adminDetail']['id'])){
	header("Location:index.php");
}
if(isset($_POST['deleteid'])){
	$id=$_POST['deleteid'];
	$result = $admin->deleteContent($id);
	if($result){
		$msg = "Content has been deleted Successfully!";
		$_SESSION['msg'] = $msg; 
		$_SESSION['status'] = 'success';
	}else{
		$msg = "Content has been not deleted Successfully!";
		$_SESSION['msg'] = $msg; 
		$_SESSION['status'] = 'error';
		exit();
	}
}?>
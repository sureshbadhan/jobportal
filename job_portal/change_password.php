<?php
$dirPath = __DIR__;
require($dirPath."/include/main.php");					
include($dirPath."/include/header.php");

if(!isset($_SESSION['userDetail']['id'])){
	header("Location:index.php");
}

if(isset($_POST['submit'])){
	$UserId = $_SESSION['userDetail']['id'];
	$oldPass = $_SESSION['userDetail']['password'];
	if(isset($_POST['current_psw']) && !empty($_POST['current_psw']) && md5($_POST['current_psw']) == $oldPass){
		$current_psw = md5($_POST['current_psw']);
	}else{
		$msg = "Current password doesn't match !";
		$_SESSION['msg'] = $msg; 
		$_SESSION['status'] = 'error';
		header("location:change_password.php");
		exit();
	}
	$new_password =md5($_POST['password']);
	$result = $user->change_password($current_psw, $new_password,$UserId);
	if(isset($result) && $result>0){
		$msg = "your password change sucessfully!";
		$_SESSION['msg'] = $msg; 
		$_SESSION['status'] = 'success';
		header("location:change_password.php");

	}
}?>
<div class="container">
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<div class="form-box">
				<div class="form-top">
					<div class="form-top-left">
						<h3>Change password</h3>
						<p>Enter current password and new password :</p>
					</div>
					<div class="form-top-right">
						<i class="fa fa-key"></i>
					</div>
				</div>
				<div class="form-bottom">
					<form role="form" action="" method="POST" class="change-psw-form" id="changePsw_form" name="changePsw_form">
						<div class="form-group">
							<label class="sr-only" for="form-current-password">Current password</label>
							<input type="password" name="current_psw" placeholder="Current password..." class=" form-control" id="current_psw">
						</div>
						<div class="form-group">
							<label class="sr-only" for="form-new-password">new password</label>
							<input type="password" name="password" placeholder="New password..." class=" form-control" id="password">
						</div>
						<div class="form-group">
							<label class="sr-only" for="form-retype-new-password">Retype-new password</label>
							<input type="password" name="conform_password" placeholder="Re-type new password..." class=" form-control" id="conform_password">
						</div>
						<div class="form-group">
							<button type="submit" name="submit" class="btn" id="save" style="width:auto;">Save change</button>
							&nbsp&nbsp&nbsp&nbsp;
						</div>
					</form>
				</div>
			</div>   
		</div>
	</div>
</div>

<?php include($dirPath."/include/footer.php");?>
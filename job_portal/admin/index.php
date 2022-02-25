<?php
$path = __DIR__;
require($path."/../include/main.php");		
include($path."/../include/adminHeader.php");

if(isset($_POST['login'])){
	$email = $_POST['email'];
	$password = md5($_POST['password']);
	$adminDetail = $admin->login($email,$password);
	if(isset($adminDetail) && count($adminDetail)>0 && $adminDetail['user_type']=="Admin"){
		$msg = "Log in successfully!";
		$_SESSION['msg'] = $msg; 
		$_SESSION['status'] = 'success';
		$_SESSION['adminDetail']=$adminDetail;
		header("location:adminProfile.php");
	}else{
		$msg = " You have enter wrong email and password!";
		$_SESSION['msg'] = $msg; 
		$_SESSION['status'] = 'error';
		header("location:index.php");
		exit();
	}	
}?>
<div class="container">
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
		   <div class="form-box">
				<div class="form-top">
					<div class="form-top-left">
					   <h3>Login to Admin</h3>
					   <p>Enter email and password to log on:</p>
					</div>
					<div class="form-top-right">
						<i class="fa fa-key"></i>
					</div>
				</div>
				<div class="form-bottom">
					<form role="form" action="" method="POST" class="login-form" name="login_form" id="login_form">
						<div class="form-group">
							<label class="sr-only" for="form-email-id">Email id</label>
							<input type="text" name="email" placeholder="Email id..." class="form-email-id form-control" id="email" >
						</div>
						<div class="form-group">
							<label class="sr-only" for="form-password">Password</label>
							<input type="password" name="password"  placeholder="Password..." class="form-password form-control" id="Password" class>
						</div>
						<button type="submit" name="login" class="btn">Sign in!</button>
					</form>
				</div>
			</div>	
		</div>
	</div>
</div>
<?php include($path."/../include/adminFooter.php"); ?>
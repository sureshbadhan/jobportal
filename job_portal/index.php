<?php
$dirPath = __DIR__;
include($dirPath."/include/main.php");					
require($dirPath."/include/header.php");

if(isset($_POST['login'])){
	$email = $_POST['email'];
	$password = md5($_POST['password']);
	$userDetail = $user->login($email,$password);
	if(isset($userDetail) && count($userDetail)>0){
		if(isset($userDetail['active']) && $userDetail['active']==0){
			$msg = " Log in sucessfully!";
			$_SESSION['msg'] = $msg; 
			$_SESSION['status'] = 'success';
			$_SESSION['userDetail'] = $userDetail;
			$user_type = $userDetail['user_type'];
			if(isset($user_type) && $user_type=='Employer'){
				header("Location:employer_profile.php");
			}elseif(isset($user_type) && $user_type=='Seeker'){
				header("Location:seeker_profile.php");
			}else{
				$msg = "You have enter wrong email and password!";
				$_SESSION['msg'] = $msg; 
				$_SESSION['status'] = 'error';
				header('location:index.php');
			}
		}else{
			$msg = "Your Id has been blocked!";
			$_SESSION['msg'] = $msg; 
			$_SESSION['status'] = 'error';
			header('location:index.php');
		}
	}else{
		$msg = "You have enter wrong email and password!";
		$_SESSION['msg'] = $msg; 
		$_SESSION['status'] = 'error';
		header('location:index.php');
	}
}?>
<div class="container">
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
		   <div class="form-box">
				<div class="form-top">
					<div class="form-top-left">
					   <h3>Login to our site</h3>
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
<?php include($dirPath."/include/footer.php"); ?>
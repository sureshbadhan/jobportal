<?php
$path = __DIR__;
require($path."/../include/main.php");		
include($path."/../include/adminHeader.php");

if(!isset($_SESSION['adminDetail']['id'])){
	header("Location:index.php");
}
if(isset($_POST['submit'])){
    $first_name = $_POST['first_name'];
	$last_name = $_POST['last_name'];
	$contact = $_POST['contact'];
	$email = $_POST['email'];
	$password = md5($_POST['password']);
	$gender = $_POST['gender'];
	$user_type = $_POST['user_type'];
	$result = $user->registeration($first_name,$last_name,$contact,$email,$password,$gender,$user_type);
	if($result){
		$msg = "Sign up Sucessfully!";
		$_SESSION['msg'] = $msg; 
		$_SESSION['status'] = 'success';
		header('location:addUser.php');
	}else{
		$msg = "sign up not sucessfully!";
		$_SESSION['msg'] = $msg; 
		$_SESSION['status'] = 'error';
		header('location:addUser.php');
		exit();
	}
}?>
<div class="container">
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<div class="form-box">
				<div class="form-top">
					<div class="form-top-left">
						<h3>User add now</h3>
						<p>Fill in the form below to get instant access:</p>
					</div>
					<div class="form-top-right">
						<i class="fa fa-pencil"></i>
					</div>
				</div>
				<div class="form-bottom">
				   <form role="form" action="" method="POST" class="registration-form" name="form_register"  id="form_register">
						<div class="form-group">
							<label class="sr-only" for="form-first-name">First name</label>
							<input type="text" name="first_name" placeholder="First name..." class="form-first-name form-control" id="firstName" >	
						</div>
						<div class="form-group">
							<label class="sr-only" for="form-last-name">Last name</label>
							<input type="text" name="last_name" placeholder="Last name..." class="form-last-name form-control" id="lastName" >
						</div>
						<div class="form-group">
							<label class="sr-only" for="form-contact-no">Contactno</label>
							<input type="text" name="contact" placeholder="Contact no..." class="form-contact-no form-control" id="contactNo" >
						</div>
						<div class="form-group">
							<label class="sr-only" for="form-email">Email</label>
							<input type="text" name="email" placeholder="Email..." class="form-email form-control" id="email" >
						</div>
						<div class="form-group">
							<label class="sr-only" for="form-password">Password</label>
							<input type="password" name="password" placeholder="Password..." 
							class="form-password form-control" id="Password" >
						</div>
						<div class="form-group">
							<label class="sr-only" for="form-password">Conform Password</label>
							<input type="password" name="conform_password" placeholder="Confirm Password..." 
							class="form-password form-control" id="conform_password" >
						</div>
						<div class="form-group"> 
							<label class="gender" name="gender" id="gender">Gender:</label>
							<br>
							<div class="radio-inline">
							  <label><input type="radio" name="gender" value="male" >Male</label>
							</div>
							<div class="radio-inline">
							  <label><input type="radio" name="gender" value="female" >Female</label>
							</div>
						</div>
						<div class="form-group">
							<label class="sr-only" for="form-select-user-type" >Select-user-type</label>
							<select name="user_type" class="form-control" id="user_type" name="user_type">
								<option value="" disabled selected>Select user type...</option>
								<option value="Employer">Employer</option>
								<option value="Seeker">Seeker</option>
								<option value="Admin">Admin</option>
							</select>
						</div>
						<button type="submit" name="submit" class="btn">Sign me up!</button>
					</form>
				</div>
			</div>
		</div>
	</div>	    
</div>  
<?php include($path."/../include/adminFooter.php"); ?>	
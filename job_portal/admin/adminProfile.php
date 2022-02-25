<?php
$path = __DIR__;
require($path."/../include/main.php");		
include($path."/adminHeader.php");

if(!isset($_SESSION['adminDetail']['id'])){
	header("Location:index.php");
}
$adminDetails=$admin->getAdminDetails();

if(isset($_POST['submit'])){
	$adminId = $_SESSION['adminDetail']['id'];
	if(isset($_FILES['imageToupload']['name']) && !empty($_FILES['imageToupload']['name'])){
		$fileExtension = pathinfo($_FILES['imageToupload']['name'], PATHINFO_EXTENSION);
		if($fileExtension != "jpg" &&  $fileExtension != "jpeg" && $fileExtension != "png"){
			$msg = "Please choose jpg, jpeg, png file only !";
			$_SESSION['msg'] = $msg; 
			$_SESSION['status'] = 'error';
			header('location:adminProfile.php');
			exit();
		}else{
			$adminprofleImage = uniqid().'.'.$_FILES['imageToupload']['name'];
			$temp_name = $_FILES['imageToupload']['tmp_name'];
			$moveToFolder = "../gallery/adminProfileImage/".$adminprofleImage;
			$_SESSION['adminDetail']['profile_image'] =$adminprofleImage;
			(isset($adminDetails['profile_image']))?unlink("../gallery/adminProfileImage/".$adminDetails['profile_image']):"";
			move_uploaded_file($temp_name,$moveToFolder);
		}
	}
	$firstName = $_POST['firstname'];
	$lastName = $_POST['lastname'];
	$contactNo = $_POST['contactno'];
	$result = $admin->updateAdmin_profile($firstName,$lastName,$contactNo,$adminprofleImage,$adminId);
	if($result){
		$msg = "Record has been updated sucessfully!";
		$_SESSION['msg'] = $msg; 
		$_SESSION['status'] = 'success';
		header("location:adminProfile.php");
		exit();
	}else{
		$msg = "Record has been not updated sucessfully!";
		$_SESSION['msg'] = $msg; 
		$_SESSION['status'] = 'error';
		header("location:adminProfile.php");
		exit();
	}	
}?>
<div class="container">
	<form role="form" action="" method="POST" class="form-horizontal" name="admin_form" id="admin_form" enctype="multipart/form-data" >
		<div class="row">
			<div class="col-sm-3">
				<div class="user-profileleft">
					<div class="userIMG">
						<?php if(isset($adminDetails['profile_image']) && empty($adminDetails['profile_image'])){?>
								<img src="../gallery/adminProfileImage/default.jpg"/>
						<?php }else{
									echo "<img src='../gallery/adminProfileImage/".$adminDetails['profile_image']."'/>";
								}
						?>		
					</div>
					<input name="imageToupload" type="file"   placeholder="..." class="form-" id="form-upload-photo">
				</div>
			</div>
			<div class="col-sm-9">
				<div class="form-box">
					<div class="form-top">
						<div class="form-top-left">
							<h3><?php echo (isset($adminDetails['first_name']))?$adminDetails['first_name']." ":""; echo (isset($adminDetails['last_name']))?$adminDetails['last_name']:"";?></h3>
						</div>
						<div class="form-top-right">
							<i class="fa fa-key"></i>
						</div>
					</div>
					<div class="form-bottom">
						<div class="form-group">
							<label class="col-sm-2" >First Name</label>
							<div class="col-sm-9">
								<input class="form-control" type="text" name="firstname" value="<?php echo (isset($adminDetails['first_name']))?$adminDetails['first_name']:"";?>" id="first_name"/>
							</div>		
						</div>
						<div class="form-group">
							<label class="col-sm-2" >Last Name</label>
							<div class="col-sm-9">
								<input class="form-control" type="text" name="lastname" value="<?php echo (isset($adminDetails['last_name']))?$adminDetails['last_name']:"";?>" id="last_name"/>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2" >Contact no</label>
							<div class="col-sm-9">
								<input class="form-control" type="text" name="contactno" value="<?php echo (isset($adminDetails['contact']))?$adminDetails['contact']:"";?>" id="contact"/> 
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2" >Email</label>
							<div class="col-sm-9">
								<input class="form-control" type="text" name="email" value="<?php echo (isset($adminDetails['email']))?$adminDetails['email']:"";?>" readonly/>
							</div>		
						</div>
						<div class="form-group">
							<label class="col-sm-2" >Usertype</label>
							<div class="col-sm-9">
								<input class="form-control" type="text" name="usertype" value="<?php echo (isset($adminDetails['user_type']))?$adminDetails['user_type']:"";?>" readonly/>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2" ></label>
							<div class="col-sm-9">
								<button type="submit" name="submit" class="btn btn-block">Update</button>
							</div>
						</div>
					</div>
				</div>   
			</div>
		</div>
	</form>
</div>
<script type="text/javascript">
   $(document).on('change', '#form-upload-photo', function(event){
	   $('.userIMG img').attr('src', URL.createObjectURL(event.target.files[0]));
});
</script>
<?php include($path."/../include/adminFooter.php"); ?>	
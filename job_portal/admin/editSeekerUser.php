<?php
$path = __DIR__;
require($path."/../include/main.php");		
include($path."/../include/adminHeader.php");

if(!isset($_SESSION['adminDetail']['id'])){
	header("Location:index.php");
}
$userId=$_GET['Id'];
$userDetail=$admin->UserDetails($userId);

if(isset($_POST['submit'])){
	if(isset($_FILES['imageToUpload']['name']) && !empty($_FILES['imageToUpload']['name'])){
		$fileExtension = pathinfo($_FILES['imageToUpload']['name'], PATHINFO_EXTENSION);
		if($fileExtension != "jpg" &&  $fileExtension != "jpeg" && $fileExtension != "png"){
			$msg = "Please choose jpg, jpeg, png file only !";
			$_SESSION['msg'] = $msg; 
			$_SESSION['status'] = 'error';
			header('location:editSeekerUser.php?Id='.$userId);
			exit();
		}else{
			$userprofleImage = uniqid().'.'.$_FILES['imageToUpload']['name'];
			$temp_name = $_FILES['imageToUpload']['tmp_name'];
			$moveToFolder = "../gallery/userProfile/".$userprofleImage;
			$_SESSION['userDetail']['profile_image'] =$userprofleImage;
			(isset($userDetail['profile_image']))?unlink("../gallery/userProfile/".$userDetail['profile_image']):"";
			$update = $admin->updateUserProfileImage($userprofleImage,$userId);
			if(isset($update) && $update>0){
				move_uploaded_file($temp_name,$moveToFolder);
				$msg = "Profile Image has been updated Successfully!";
				$_SESSION['msg'] = $msg; 
				$_SESSION['status'] = 'success';
				header('location:editSeekerUser.php?Id='.$userId);
				exit();
			}else{
				$msg = "Profile Image has been not updated Successfully!";
				$_SESSION['msg'] = $msg; 
				$_SESSION['status'] = 'error';
				header('location:editSeekerUser.php?Id='.$userId);
				exit();
			}
		}
	}
	$first_name =$_POST['first_name'];
	$last_name =$_POST['last_name'];
	$contact =$_POST['contact'];
	$address =$_POST['address'];
	$_SESSION['userDetail']['first_name'] = $first_name;
	$_SESSION['userDetail']['last_name'] = $last_name;
	$result = $admin->editSeekerUser($first_name,$last_name,$contact, $address,$userId);
	if($result){
		$msg = "Record has been updated sucessfully!";
		$_SESSION['msg'] = $msg; 
		$_SESSION['status'] = 'success';
		header('location:editSeekerUser.php?Id='.$userId);
	}else{
		$msg = "Record has been not updated sucessfully!";
		$_SESSION['msg'] = $msg; 
		$_SESSION['status'] = 'error';
		header('location:editSeekerUser.php?Id='.$userId);
		exit();
	}
}?>
<div class="container">
	<form role="form" action="" method="POST" class="form-horizontal" name="employer_form" id="employer_form" enctype="multipart/form-data" >
		<div class="row">
			<div class="col-sm-3">
				<div class="user-profileleft">
					<div class="userIMG">
						<?php if(empty($userDetail['profile_image'])){
						echo "<img src='../gallery/userProfile/user_default.jpg' />";}else{
						echo "<img src='../gallery/userProfile/".$userDetail['profile_image']."' />"; }?>
					</div>
					<input type="file"  name="imageToUpload" placeholder="..." class="form-" id="uploadPhoto">
					<div id="filereuired"></div>
				</div>
			</div>
			<div class="col-sm-9">
				<div class="form-box">
					<div class="form-top">
						<div class="form-top-left">
							<h3><?php echo ucfirst($userDetail['first_name']." ".$userDetail['last_name']); ?></h3>
						</div>
							<div class="form-top-right">
								<i class="fa fa-key"></i>
							</div>
					</div>
					<div class="form-bottom">
						
						
						<div class="form-group">
							<label class="col-sm-2" >First Name</label>
							<div class="col-sm-9">
								<input class="form-control" type="text" name="first_name" value="<?php echo $userDetail['first_name']; ?>"/>
							</div>		
						</div>
						<div class="form-group">
							<label class="col-sm-2" >Last Name</label>
							<div class="col-sm-9">
								<input class="form-control" type="text" name="last_name" value="<?php echo $userDetail['last_name']; ?>"/>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2" >Contact no</label>
							<div class="col-sm-9">
								<input class="form-control" type="text" name="contact" value="<?php echo $userDetail['contact']; ?>"/> 
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2" >Email</label>
							<div class="col-sm-9">
								<input class="form-control" type="text" name="email" value="<?php echo $userDetail['email']; ?>" readonly/>
							</div>		
						</div>
						<div class="form-group">
							<label class="col-sm-2" >Usertype</label>
							<div class="col-sm-9">
								<input class="form-control" type="text" name="user_type" value="<?php echo $userDetail['user_type']; ?>" readonly/>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2" >Address</label>
							<div class="col-sm-9">
								<textarea name="address" rows="5" cols="76" class="form-control" ><?php echo $userDetail['address']; ?></textarea>
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
$(document).ready( function (){
	$("#uploadPhoto").change(function (event) {
        var fileExtension = ['jpg', 'png', 'jpeg'];
        if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
            $('#filereuired').text('File type: ' + fileExtension.join(', '));
        }else{
			$('.userIMG img').attr('src', URL.createObjectURL(event.target.files[0]));
		}
    });
 });
</script>
<?php include($path."/../include/adminFooter.php"); ?>	
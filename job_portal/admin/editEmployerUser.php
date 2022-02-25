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
	if(isset($_FILES['profile_image']['name']) && !empty($_FILES['profile_image']['name'])){
		$fileExtension = pathinfo($_FILES['profile_image']['name'], PATHINFO_EXTENSION);
		if($fileExtension != "jpg" &&  $fileExtension != "jpeg" && $fileExtension != "png"){
			$msg = "Please choose jpg, jpeg, png file only !";
			$_SESSION['msg'] = $msg; 
			$_SESSION['status'] = 'error';
			header('location:editEmployerUser.php?Id='.$userId);
			exit();
		}else{
			$userprofleImage = uniqid().'.'.$_FILES['profile_image']['name'];
			$temp_name = $_FILES['profile_image']['tmp_name'];
			$moveToFolder = "../gallery/userProfile/".$userprofleImage;
			(isset($userDetail['profile_image']))?unlink("../gallery/userProfile/".$userDetail['profile_image']):"";
			$update = $admin->updateUserProfileImage($userprofleImage,$userId);
			if(isset($update) && $update>0){
				move_uploaded_file($temp_name,$moveToFolder);
				$msg = "Profile Image has been updated Successfully!";
				$_SESSION['msg'] = $msg; 
				$_SESSION['status'] = 'success';
				header('location:editEmployerUser.php?Id='.$userId);
				exit();
			}else{
				$msg = "Profile Image has been not updated Successfully!";
				$_SESSION['msg'] = $msg; 
				$_SESSION['status'] = 'error';
				header('location:editEmployerUser.php?Id='.$userId);
				exit();
			}
		}
	}
	$first_name =$_POST['first_name'];
	$last_name =$_POST['last_name'];
	$contact =$_POST['contact'];
	$Company_name =$_POST['company_name'];
	if(isset($_FILES['upload_logo']['name']) && !empty($_FILES['upload_logo']['name'])){
		$fileExtension = pathinfo($_FILES['upload_logo']['name'], PATHINFO_EXTENSION);
		if($fileExtension != "jpg" &&  $fileExtension != "jpeg" && $fileExtension != "png"){
			$msg = "Please choose jpg, jpeg, png file only !";
			$_SESSION['msg'] = $msg; 
			$_SESSION['status'] = 'error';
			header('location:editEmployerUser.php?Id=$userId');
			exit();
		}else{
			$companyLogo_name = uniqid().'.'.$_FILES['upload_logo']['name'];
			$temp_name = $_FILES['upload_logo']['tmp_name'];
			$moveToFolder = "gallery/employerLogo/".$companyLogo_name;
			(isset($userDetail['company_logo']))?unlink($dirPath."/gallery/employerLogo/".$userDetail['company_logo']):"";
			move_uploaded_file($temp_name,$moveToFolder);	
		}
	}
	$address =$_POST['address'];
	$website =$_POST['website'];
	$description =$_POST['description'];
	$_SESSION['userDetail']['first_name'] = $first_name;
	$_SESSION['userDetail']['last_name'] = $last_name;
	$result = $admin->editEmployerUser($first_name,$last_name,$contact,$Company_name,$companyLogo_name,$address,$website,$description,$userId);
	if(isset($result) && count($result)>0){
		$msg = "Record has been updated sucessfully!";
		$_SESSION['msg'] = $msg; 
		$_SESSION['status'] = 'success';
		header('location:editEmployerUser.php?Id='.$userId);
	}else{
		$msg = "Record has been not updated sucessfully!";
		$_SESSION['msg'] = $msg; 
		$_SESSION['status'] = 'error';
		header('location:editEmployerUser.php?Id='.$userId);
		exit();
	}	
} ?>
<div class="container">
	<form role="form" action="" method="POST" class="form-horizontal" name="employer_form" id="employer_form" enctype="multipart/form-data" >
		<div class="row">
			<div class="col-sm-3">
				<div class="user-profileleft">
					<div class="userIMG">
						<?php if(isset($userDetail['profile_image']) && empty($userDetail['profile_image'])){
							echo "<img src='../gallery/userProfile/user_default.jpg' />";}else{
							echo "<img src='../gallery/userProfile/".$userDetail['profile_image']."' />"; }?>
					</div>
					<input type="file"  name="profile_image" placeholder="..." class="form-" id="form-upload-photo">
					<div id="filereuired"></div>
				</div>
			</div>
			<div class="col-sm-9">
				<div class="form-box">
					<div class="form-top">
						<div class="form-top-left">
							<h3><?php echo (isset($userDetail['first_name']))?ucfirst($userDetail['first_name'])." ":""; echo (isset($userDetail['last_name']))?ucfirst($userDetail['last_name']):"";?></h3>
						</div>
						<div class="form-top-right">
							<i class="fa fa-key"></i>
						</div>
					</div>
					<div class="form-bottom">
						<div class="form-group">
							<label class="col-sm-2" >First Name</label>
							<div class="col-sm-9">
								<input class="form-control" type="text" name="first_name" value="<?php echo (isset($userDetail['first_name']))?$userDetail['first_name']:"";?>"/>
							</div>		
						</div>
						<div class="form-group">
							<label class="col-sm-2" >Last Name</label>
							<div class="col-sm-9">
								<input class="form-control" type="text" name="last_name" value="<?php echo (isset($userDetail['last_name']))?$userDetail['last_name']:""; ?>"/>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2" >Contact no</label>
							<div class="col-sm-9">
								<input class="form-control" type="text" name="contact" value="<?php echo (isset($userDetail['contact']))?$userDetail['contact']:""; ?>"/> 
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2" >Email</label>
							<div class="col-sm-9">
								<input class="form-control" type="text" name="email" value="<?php echo (isset($userDetail['email']))?$userDetail['email']:"";?>" readonly/>
							</div>		
						</div>
						<div class="form-group">
							<label class="col-sm-2" >Usertype</label>
							<div class="col-sm-9">
								<input class="form-control" type="text" name="user_type" value="<?php echo (isset($userDetail['user_type']))?$userDetail['user_type']:""; ?>" readonly/>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2" >Company name</label>
							<div class="col-sm-9">
								<input type="text" name="company_name" class="form-control" id="form-company-name" value="<?php echo (isset($userDetail['company_name']))?$userDetail['company_name']:""; ?>"/>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2" >Upload logo</label>
							<div class="col-sm-9">
								<input type="file" name="upload_logo" class="form-email form-control" id="form-upload-logo" />
								<div id="fileType"></div>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2" >Address</label>
							<div class="col-sm-9">
								<textarea name="address" rows="5" cols="76" class="form-control" ><?php echo (isset($userDetail['address']))?$userDetail['address']:""; ?></textarea>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2" >Website</label>
							<div class="col-sm-9">
								<input type="text" name="website" class="form-control" value="<?php echo (isset($userDetail['website']))?$userDetail['website']:""; ?>">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2" >Description</label>
							<div class="col-sm-9">
								<textarea name="description" class="form-control" rows="5" cols="76"><?php echo (isset($userDetail['description']))?$userDetail['description']:"";?></textarea>
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
	$("#form-upload-photo").change(function (event) {
        var fileExtension = ['jpg', 'png', 'jpeg'];
        if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
			$('#filereuired').text('File type: ' + fileExtension.join(', '));
        }else{
			$('.userIMG img').attr('src', URL.createObjectURL(event.target.files[0]));
		}
    });
	
	$("#form-upload-logo").change(function (event) {
        var fileExtension = ['jpg', 'png', 'jpeg'];
        if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
			$('#fileType').text('File type: ' + fileExtension.join(', '));
        }else{
		}
    });
 });
</script>
<?php include($path."/../include/adminFooter.php"); ?>	
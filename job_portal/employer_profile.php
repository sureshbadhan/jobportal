<?php
$dirPath = __DIR__;
require($dirPath."/include/main.php");					
include($dirPath."/include/header.php");

if(!isset($_SESSION['userDetail']['id'])){
	header("Location:index.php");
}
$UserId = $_SESSION['userDetail']['id'];
$row=$user->getUserDetails($UserId);

if(isset($_POST['submit'])){
	if(isset($_FILES['profileImage']['name']) && !empty($_FILES['profileImage']['name'])){
		$fileExtension = pathinfo($_FILES['profileImage']['name'], PATHINFO_EXTENSION);
		if($fileExtension != "jpg" &&  $fileExtension != "jpeg" && $fileExtension != "png"){
			$msg = "Please choose jpg, jpeg, png file only !";
			$_SESSION['msg'] = $msg; 
			$_SESSION['status'] = 'error';
			header('location:employer_profile.php');
			exit();
		}else{
			$userprofleImage = uniqid().'.'.$_FILES['profileImage']['name'];
			$temp_name = $_FILES['profileImage']['tmp_name'];
			$moveToFolder = "gallery/userProfile/".$userprofleImage;
			$_SESSION['userDetail']['profile_image'] =$userprofleImage;
			(isset($row['profile_image']))?unlink($dirPath."/gallery/userProfile/".$row['profile_image']):"";
			$update = $user->updateProfileImage($userprofleImage,$UserId);
			if(isset($update) && $update>0){
				move_uploaded_file($temp_name,$moveToFolder);
				$msg = "Profile Image has been updated Successfully!";
				$_SESSION['msg'] = $msg; 
				$_SESSION['status'] = 'success';
				header('location:employer_profile.php');
				exit();
			}else{
				$msg = "Profile Image has been not updated Successfully!";
				$_SESSION['msg'] = $msg; 
				$_SESSION['status'] = 'error';
				header('location:employer_profile.php');
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
			header('location:employer_profile.php');
			exit();
		}else{
			$companyLogo_name = uniqid().'.'.$_FILES['upload_logo']['name'];
			$temp_name = $_FILES['upload_logo']['tmp_name'];
			$moveToFolder = "gallery/employerLogo/".$companyLogo_name;
			$_SESSION['userDetail']['company_logo'] =$companyLogo_name;
			(isset($row['company_logo']))?unlink($dirPath."/gallery/employerLogo/".$row['company_logo']):"";
			move_uploaded_file($temp_name,$moveToFolder);
			
		}
	}
	$address =$_POST['address'];
	$website =$_POST['website'];
	$description =$_POST['description'];
	$_SESSION['userDetail']['first_name'] = $first_name;
	$_SESSION['userDetail']['last_name'] = $last_name;
	$result = $user->updateEmployerProfile($first_name,$last_name,$contact,$Company_name,$companyLogo_name,$address,$website,$description,$UserId);
	if(isset($result) && count($result)>0){
		$msg = "Record has been updated sucessfully!";
		$_SESSION['msg'] = $msg; 
		$_SESSION['status'] = 'success';
		header("location:employer_profile.php");
	}else{
		$msg = "Record has been not updated sucessfully!";
		$_SESSION['msg'] = $msg; 
		$_SESSION['status'] = 'error';
		header("location:employer_profile.php");
		exit();
	}	
} ?>
<div class="container">
	<form role="form" action="" method="POST" class="form-horizontal" name="employer_form" id="employer_form" enctype="multipart/form-data" >
		<div class="row">
			<div class="col-sm-3">
				<div class="user-profileleft">
					<div class="userIMG">
						<?php if(empty($row['profile_image'])){
							echo "<img src='gallery/userProfile/user_default.jpg' />";}else{
							echo "<img src='gallery/userProfile/".$row['profile_image']."' />"; }?>
					</div>
					<input type="file"  name="profileImage" placeholder="..." class="form-" id="profileImage">
					<div id="filereuired"></div>
				</div>
			</div>
			<div class="col-sm-9">
				<div class="form-box">
					<div class="form-top">
						<div class="form-top-left">
							<h3><?php echo (isset($row['first_name']))? ucfirst($row['first_name'])." ": ""; echo (isset($row['last_name'])) ? ucfirst($row['last_name']) : ""; ?></h3>
						</div>
						<div class="form-top-right">
							<i class="fa fa-key"></i>
						</div>
					</div>
					<div class="form-bottom">
						<div class="form-group">
							<label class="col-sm-2" >First Name</label>
							<div class="col-sm-9">
								<input class="form-control" type="text" name="first_name" value="<?php echo (isset($row['first_name'])) ? $row['first_name'] : ""; ?>"/>
							</div>		
						</div>
						<div class="form-group">
							<label class="col-sm-2" >Last Name</label>
							<div class="col-sm-9">
								<input class="form-control" type="text" name="last_name" value="<?php echo (isset($row['last_name'])) ? $row['last_name'] : ""; ?>"/>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2" >Contact no</label>
							<div class="col-sm-9">
								<input class="form-control" type="text" name="contact" value="<?php echo (isset($row['contact']))? $row['contact']: ""; ?>"/> 
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2" >Email</label>
							<div class="col-sm-9">
								<input class="form-control" type="text" name="email" value="<?php echo (isset($row['email']))? $row['email'] : ""; ?>" readonly/>
							</div>		
						</div>
						<div class="form-group">
							<label class="col-sm-2" >Usertype</label>
							<div class="col-sm-9">
								<input class="form-control" type="text" name="user_type" value="<?php echo (isset($row['user_type']))? $row['user_type'] : ""; ?>" readonly/>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2" >Company name</label>
							<div class="col-sm-9">
								<input type="text" name="company_name" class="form-control" id="form-company-name" value="<?php echo (isset($row['company_name']))?$row['company_name'] : ""; ?>"/>
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
								<textarea name="address" rows="5" cols="76" class="form-control" ><?php echo (isset($row['address']))? $row['address'] : ""; ?></textarea>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2" >Website</label>
							<div class="col-sm-9">
								<input type="text" name="website" class="form-control" value="<?php echo (isset($row['website'])) ? $row['website'] : ""; ?>">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2" >Description</label>
							<div class="col-sm-9">
								<textarea name="description" class="form-control" rows="5" cols="76"><?php echo(isset($row['description']))? $row['description'] : "";?></textarea>
						   </div>
						</div>
						<div class="form-group">
							<label class="col-sm-2" ></label>
							<div class="col-sm-9">
								<button type="submit" name="submit" id="submit" class="btn btn-block">Update</button>
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
	$("#profileImage").change(function (event) {
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
<?php include($dirPath."/include/footer.php");?>
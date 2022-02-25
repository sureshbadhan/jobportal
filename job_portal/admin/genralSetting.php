<?php
$path = __DIR__;
require($path."/../include/main.php");		
include($path."/../include/adminHeader.php");

if(!isset($_SESSION['adminDetail']['id'])){
	header("Location:index.php");
}
$row = $admin->getGeneralSetingDetail();
if(isset($_POST['submit'])){
	$email = $_POST['email'];
	$url = $_POST['url'];
	$titleName = $_POST['title'];
	if(isset($_FILES['logo']['name']) && !empty($_FILES['logo']['name'])){
		$fileExtension = pathinfo($_FILES['logo']['name'], PATHINFO_EXTENSION);
		if($fileExtension != "jpg" &&  $fileExtension != "jpeg" && $fileExtension != "png"){
			$msg = "Please choose jpg, jpeg, png file only !";
			$_SESSION['msg'] = $msg; 
			$_SESSION['status'] = 'error';
			header('location:genralSetting.php');
			exit();
		}else{
			$titleLogoName = uniqid().'.'.$_FILES['logo']['name'];
			$temp_name = $_FILES['logo']['tmp_name'];
			$moveToFolder = "../gallery/generalSettingImage/".$titleLogoName;
			(isset($row['logo']))?unlink("../gallery/generalSettingImage/".$row['logo']):"";
			move_uploaded_file($temp_name,$moveToFolder);
			$fieldValue = array("email"=>$email,"url"=>$url,"title"=>$titleName,"logo"=>$titleLogoName,"address"=>$address,"contact"=>$contactNo);
		}
	}
	$address = $_POST['address'];
	$contactNo = $_POST['contact_no'];
	$fieldValue = array("email"=>$email,"url"=>$url,"title"=>$titleName,"address"=>$address,"contact"=>$contactNo);
	$result = $admin->generalSetting($fieldValue);
	if(isset($result) && count($result)>0){
		$msg = "Setting has been update Successfully!";
		$_SESSION['msg'] = $msg; 
		$_SESSION['status'] = 'success';
		header('location:genralSetting.php');
	}else{
		$msg = "Setting has been not updated Successfully!";
		$_SESSION['msg'] = $msg; 
		$_SESSION['status'] = 'error';
		header('location:genralSetting.php');
		exit();
	}
}?>
<div class="container">
	<div class="col-sm-12">
		<div class="form-box">
			<div class="form-top">
				<div class="form-top-left">
					<h3>General Setting</h3>
				</div>
				<div class="form-top-right">
					<i class="fa fa-key"></i>
				</div>
			</div>
			<div class="form-bottom">
				<form role="form" action="" method="POST" enctype="multipart/form-data" class="form-horizontal" id="genral_setting" name="genral_setting"> 
					<div class="form-group">
						<label class="col-sm-2">Email</label>
						<div class="col-sm-9">
							<input type="text" name="email" placeholder="Email..." class="form-control" id="email" value="<?php echo (isset($row['email']))  ? $row['email'] : "";?>">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2">Url</label>
						<div class="col-sm-9">
							<input type="text" name="url" placeholder="Url..." class="form-control" id="url" value="<?php echo (isset($row['url']))? $row['url'] : "";?>">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2">Site Title</label>
						<div class="col-sm-9">
							<input type="text" name="title" placeholder="Site title..." class=" form-control" id="title" value="<?php echo (isset($row['title']))? $row['title'] : "";?>">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2" >Site Logo</label>
						<div class="col-sm-9">
							<input name="logo" type="file" id="fileToUpload" placeholder="..." enctype="multipart/form-data" class="form-email form-control" >
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2">Address</label>
						<div class="col-sm-9">
							<textarea  name="address" rows="5" cols="75" placeholder="Address..." class="form-control" id="form-des"><?php echo (isset($row['address']))? $row['address'] : "";?></textarea>	
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2">Contact No</label>
						<div class="col-sm-9">
							<input type="text" name="contact_no" placeholder="Contact No..." class="form-control" id="contact_no" value="<?php echo (isset($row['contact'])) ? $row['contact'] : ""?>">	
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2" ></label>
						<div class="col-sm-9">
							<button type="submit" name="submit" class="btn" style="width:auto;">Save</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<?php 
include($path."/../include/adminFooter.php"); ?>	
<?php
$path = __DIR__;
require($path."/../include/main.php");		
include($path."/../include/adminHeader.php");

if(!isset($_SESSION['adminDetail']['id'])){
	header("Location:index.php");
}
$id = $_GET['id'];
$row = $admin->getcmsPageDetail($id);

if(isset($_POST['submit'])){
	$tittle = $_POST['tittle'];
	$content = ucfirst($_POST['content']);
	$result = $admin->editCmsPage($id,$tittle,$content);
	if($result){
		$msg = "Content has been Update Successfully!";
		$_SESSION['msg'] = $msg; 
		$_SESSION['status'] = 'success';
		header('location:allCmsPages.php');
	}else{
		$msg = "Content has been not Update Successfully!";
		$_SESSION['msg'] = $msg; 
		$_SESSION['status'] = 'error';
		header('location:editCmsPage');
		exit();
	}
}?>
<div class="container">
	<form action="" method="POST" enctype="multipart/form-data" id="cmsForm">
		<div class="row">
			<div class="">
				<label class="sr-only" for="tittle">Tittle</label>
				<input type="text" name="tittle" id="tittle" placeholder="Tittle..." class=" form-control" value="<?php echo (isset($row['title']))?$row['title']:"";?>">
			</div><br>
			<div class="">
				<textarea class="ckeditor" name="content" cols="10" rows="60" id="content"><?php echo (isset($row['description']))?$row['description']:"";?></textarea>
			</div><br>
			<div class="" style="text-align:left;">
				<button type="submit" name="submit" class="btn">Upload</button>
			</div>
			
		</div>
	</form>	
</div>
<?php include($path."/../include/adminFooter.php");?>
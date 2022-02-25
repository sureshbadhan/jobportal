<?php
$path = __DIR__;
require($path."/../include/main.php");		
include($path."/../include/adminHeader.php");

if(!isset($_SESSION['adminDetail']['id'])){
	header("Location:index.php");
}
if(isset($_POST['submit'])){
	if(isset($_POST['content']) && !empty($_POST['content'])){
		$tittle = $_POST['tittle'];
		$content = $_POST['content'];
	}
	$result = $admin->insertContent($tittle, $content);
	if($result){
		$msg = "Content has been Uploaded Successfully!";
		$_SESSION['msg'] = $msg; 
		$_SESSION['status'] = 'success';
		header('location:allCmsPages.php');
	}else{
		$msg = "Content has been not Upload Successfully!";
		$_SESSION['msg'] = $msg; 
		$_SESSION['status'] = 'error';
		header('location:createCms.php');
		exit();
	}
}?>
<div class="container">
	<form action="" method="POST" enctype="multipart/form-data" name="cmsForm"  id="cmsForm" onsubmit="return validateForm()">
		<div class="row">
			<div class="">
				<label class="sr-only" for="tittle">Tittle</label>
				<input type="text" name="tittle" placeholder="Tittle..." class=" form-control" id="tittle">
			</div><br>
			<div class="">
				<textarea class="ckeditor" name="content" cols="10" rows="60" id="content"></textarea>
				<div id="ckeditor" style="color:red;text-align:left;"></div>
			</div>
			<br>
			<div class="" style="text-align:left;">
				<button type="submit" name="submit" class="btn">Upload</button>
			</div>
		</div>
	</form>	
</div>
<script>
	CKEDITOR.replace( 'content' );
	$("form").submit( function(e) {
		var messageLength = CKEDITOR.instances['content'].getData().replace(/<[^>]*>/gi, '').length;
		if( !messageLength ) {
			var text="<b>*Please Enter Text</b>";
			document.getElementById("ckeditor").innerHTML=text;
			e.preventDefault();
		}
	});
</script>
<?php include($path."/../include/adminFooter.php"); ?>	
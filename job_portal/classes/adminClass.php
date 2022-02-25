<?php 
class adminClass{
	public function login($email,$password){
		global $con;
		$sql = "SELECT * FROM user WHERE email='".$email."' AND password ='".$password."'";
		$query = mysqli_query($con,$sql);
		$result = mysqli_fetch_assoc($query);
		return 	$result;
	}
	
	public function getAdminDetails(){
		global $con;
		$adminId = $_SESSION['adminDetail']['id'];
		$sql = "SELECT * FROM user WHERE id= '".$adminId."'";
		$query = mysqli_query($con,$sql);
		$row = mysqli_fetch_assoc($query);
		return $row;	
	}
	
	public function updateAdmin_profile($firstName,$lastName,$contactNo,$adminprofleImage,$adminId){
		global $con;
		$sql = "UPDATE user SET first_name='".$firstName."',last_name='".$lastName."',contact='".$contactNo."',profile_image='".$adminprofleImage."' WHERE id='".$adminId."'";
		$query = mysqli_query($con,$sql);
		return $query;
	}
	
	public function adminChangePassword($new_password,$adminId){
		global $con;
		$sql = ("UPDATE user SET password='".$new_password."' WHERE id= '".$adminId."' ");
		$query = mysqli_query($con,$sql);
		return $query;
	}
	
	public function deactiveJob($jobId){
	global $con;
	$deactiveJob = "Deactivated";
	$deactive=1;
	$sql = "UPDATE job_management SET status='".$deactiveJob."', job_active='".$deactive."' WHERE jobid='".$jobId."'";
	$query = mysqli_query($con,$sql);
	return $query;
	}
	
	public function activeJob($jobId){
		global $con;
		$activeJob = "Active";
		$active=0;
		$sql = "UPDATE job_management SET status='".$activeJob."', job_active='".$active."' WHERE jobid='".$jobId."'";
		$query = mysqli_query($con,$sql);
		return $query;
	}
	
	public function getAllUser(){
		global $con;
		$sql = "SELECT * FROM user WHERE id ";
		$query = mysqli_query($con,$sql);
		$row = mysqli_fetch_all($query,MYSQLI_ASSOC);
		return $row;
	}
	
	public function UserDetails($userId){
		global $con;
		$sql = "SELECT * FROM user WHERE id='".$userId."'";
		$query = mysqli_query($con,$sql);
		$row = mysqli_fetch_assoc($query);
		return $row;	
	}
	
	public function updateUserProfileImage($userprofleImage,$userId){
		global $con;
		$sql = "UPDATE user SET profile_image='".$userprofleImage."' WHERE id= '".$userId."'";
		$query = mysqli_query($con,$sql);
		return $query;
	}
	
	public function editSeekerUser($first_name,$last_name,$contact, $address,$userId){
		global $con;
		$sql = ("UPDATE user SET first_name='".$first_name."', last_name='".$last_name."', contact='".$contact."', address='".$address."' WHERE id='".$userId."' ");
		$query = mysqli_query($con,$sql);
		return $query;
	}
	
	public function editEmployerUser($first_name,$last_name,$contact,$Company_name,$companyLogo_name,$address,$website,$description,$userId){
		global $con;
		$sql = "UPDATE user SET first_name='".$first_name."', last_name='".$last_name."', contact='".$contact."',company_name='".$Company_name."',
				company_logo='".$companyLogo_name."', address='".$address."', website='".$website."', description='".$description."' WHERE id='".$userId."'";
		$query = mysqli_query($con,$sql);
		return $query;
	}
	
	public function deleteUser($userId){
		global $con;
		$sql = ("DELETE FROM user WHERE id='".$userId."'");
		$query = mysqli_query($con,$sql);
		return $query;
	
	}
	
	public function deactiveUser($userId){
	global $con;
	$blockStatus = "Blocked";
	$block=1;
	$sql = "UPDATE user SET status='".$blockStatus."', active='".$block."' WHERE id='".$userId."'";
	$query = mysqli_query($con,$sql);;
	return $query;
	}
	
	public function activeUser($userId){
		global $con;
		$unblockStatus = "Active";
		$unblock=0;
		$sql = "UPDATE user SET status='".$unblockStatus."', active='".$unblock."' WHERE id='".$userId."'";
		$query = mysqli_query($con,$sql);
		return $query;
	}
	
	public function insertContent($tittle, $content){
		global $con;
		$sql = "INSERT INTO cms_management(title,description) VALUES ('".$tittle."', '".$content."')";
		$query = mysqli_query($con,$sql);
		return $query;
	}
	
	public function getAllContentDetails(){
		global $con;
		$sql = "SELECT * FROM cms_management";
		$query = mysqli_query($con,$sql);
		$result = mysqli_fetch_all($query,MYSQLI_ASSOC);
		return $result;
	}
	
	public function getcmsPageDetail($id){
		global $con;
		$sql = "SELECT * FROM cms_management WHERE id='".$id."'";
		$query = mysqli_query($con,$sql);
		$fetch = mysqli_fetch_assoc($query);
		return $fetch;
	}
	
	public function editCmsPage($id,$tittle,$content){
		global $con;
		$sql = "UPDATE cms_management SET title='".$tittle."',description='".$content."' WHERE id='".$id."'";
		$query = mysqli_query($con,$sql);
		return $query;
	}
	
	public function deleteContent($id){
		global $con;
		$sql = "DELETE FROM cms_management WHERE id='".$id."'";
		$query =mysqli_query($con,$sql);
		return $query;
	}
	
	public function unPublish($id){
	global $con;
	$unPublish = "Unpublished";
	$deactive=1;
	$sql = "UPDATE cms_management SET status='".$unPublish."', publish='".$deactive."' WHERE id='".$id."'";
	$query = mysqli_query($con,$sql);;
	return $query;
	}
	
	public function publish($id){
		global $con;
		$publish = "Published";
		$active=0;
		$sql = "UPDATE cms_management SET status='".$publish."', publish='".$active."' WHERE id='".$id."'";
		$query = mysqli_query($con,$sql);
		return $query;
	}
	public function generalSetting($fieldValue){
		global $con;
		$row = $this->getGeneralSetingDetail();
		if(isset($row) && !empty($row)){
			foreach($fieldValue as $key=>$value){
				$sql = "UPDATE general_setting SET field_name='".$key."',field_value='".$value."' WHERE field_name='".$key."' ";
				$query = mysqli_query($con,$sql);
			}
		}else{
			foreach($fieldValue as $key=>$value){
				$sql = ("INSERT INTO general_setting(admin_id,field_name,field_value) VALUES ('".$adminId."','".$key."','".$value."')"); 	
				$query = mysqli_query($con,$sql);
			}
		}
		return $query;
	}
	public function getGeneralSetingDetail(){
		global $con;
		$generalSettingArray = array();
		$sql = "SELECT * FROM general_setting ";
		$query = mysqli_query($con,$sql);
		while($row = mysqli_fetch_assoc($query)){
			$generalSettingArray[$row['field_name']]=$row['field_value'];
		}
		return $generalSettingArray;
	}
}
?>
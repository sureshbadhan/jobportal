<?php
class user_class{
	public function registeration($first_name,$last_name,$contact,$email,$password,$gender,$user_type){
		global $con;
		$sql_1 = "SELECT * FROM user WHERE email = '".$email."' OR contact='".$contact."'";
		$result = mysqli_query($con,$sql_1);
		$row =mysqli_num_rows($result);
		if($row>0){
			$msg = "Account Already Exits, Please Login to continue!";
			$_SESSION['msg'] = $msg; 
			$_SESSION['status'] = 'error';
			header("location:index.php");
			exit();
		}else{
			$sql = ("INSERT INTO user(first_name,last_name,contact,email,password,gender,user_type) VALUES
					('".$first_name."','".$last_name."','".$contact."','".$email."','".$password."','".$gender."','".$user_type."')"); 	
			$query = mysqli_query($con,$sql);
			return $query;
		}
	}

	public function login($email,$password){
		global $con;
		$sql = "SELECT * FROM user WHERE email='".$email."' AND password ='".$password."'";
		$query = mysqli_query($con,$sql);
		$result = mysqli_fetch_assoc($query);
		return 	$result;
	}

	public function getUserDetails($UserId){
		global $con;
		$sql = "SELECT * FROM user WHERE id= '".$UserId."'";
		$query = mysqli_query($con,$sql);
		$row = mysqli_fetch_assoc($query);
		return $row;	
	}

	public function updateEmployerProfile($first_name,$last_name,$contact,$Company_name,$companyLogo_name,$address,$website,$description,$UserId){
		global $con;
		$sql = "UPDATE user SET first_name='".$first_name."', last_name='".$last_name."', contact='".$contact."',company_name='".$Company_name."',
				company_logo='".$companyLogo_name."', address='".$address."', website='".$website."', description='".$description."' WHERE id='".$UserId."'";
		$query = mysqli_query($con,$sql);
		return $query;
	}

	public function updateSeekerProfile($first_name,$last_name,$contact,$address,$UserId){
		global $con;
		$sql = ("UPDATE user SET first_name='".$first_name."', last_name='".$last_name."', contact='".$contact."', address='".$address."' WHERE id='".$UserId."' ");
		$query = mysqli_query($con,$sql);
		return $query;
	}

	public function updateProfileImage($userprofleImage,$UserId){
		global $con;			
		$sql = "UPDATE user SET profile_image='".$userprofleImage."' WHERE id= '".$UserId."'";
		$query = mysqli_query($con,$sql);
		return $query;
	}

	public function createJob($job_title, $description, $salary, $age, $experience, $skill, $location, $designation, $document_name,$UserId){
		global $con;
		$sql =("INSERT INTO job_management(user_id,job_title,description,salary,age,experience,skills,address,designation,document)VALUES('".$UserId."',
			  '".$job_title."','".$description."','".$salary."','".$age."','".$experience."','".$skill."','".$location."','".$designation."','".$document_name."')");
		$query = mysqli_query($con,$sql);
		return $query;
	}
	
	public function getMyJobs($UserId){
		global $con;
		$sql = "SELECT * FROM job_management WHERE user_id = '".$UserId."' ";
		$query = mysqli_query($con,$sql);
		$rows = mysqli_fetch_all($query,MYSQLI_ASSOC);
		return $rows;	 
	}
	
	public function jobDetails($jobId){
		global $con;		
		$sql = "SELECT * FROM user INNER JOIN job_management ON user.id=job_management.user_id  WHERE jobid= '".$jobId."' ";
		$query = mysqli_query($con,$sql);
		$row = mysqli_fetch_assoc($query);
		return $row;	 	
	}
	
	public function jobEdit($job_title,$description,$salary,$age,$experience,$skill,$location,$designation,$document_name,$jobId){
		global $con;
		$sql = ("UPDATE job_management SET job_title='".$job_title."',description='".$description."',salary='".$salary."',age='".$age."',experience='".$experience."',
				skills='".$skill."',address='".$location."',designation='".$designation."', document='".$document_name."' WHERE jobid= '".$jobId."' ");
		$query = mysqli_query($con,$sql);
		return $query;
	}	
	
	public function change_password($current_psw, $new_password,$UserId){
		global $con;
		$sql = ("UPDATE user SET password='".$new_password."' WHERE id= '".$UserId."' ");
		$query = mysqli_query($con,$sql);
		return $query;
	}

	public function deleteJob($jobId){
		global $con;
		$sql = "DELETE FROM job_management WHERE jobid = '".$jobId."'";
		$query = mysqli_query($con,$sql);
		return $query;
	}

	public function getAlljobs(){
		global $con;
		$sql = "Select * from user INNER JOIN job_management ON user.id=job_management.user_id";
		$query = mysqli_query($con,$sql);
		$row = mysqli_fetch_all($query,MYSQLI_ASSOC);
		return $row;	 
	}
	
	public function apply_job($job_id,$userId,$description,$document_name){
		global $con;
		$sql = ("INSERT INTO apply_job(job_id,user_id,cv,description) VALUES('".$job_id."','".$userId."','".$document_name."','".$description ."')");	
		$query = mysqli_query($con,$sql);
		return $query;	
	}
	public function getApplied_jobdetails(){
		global $con;
		$sql = "Select * from apply_job INNER JOIN user ON user.id=apply_job.user_id";
		$query = mysqli_query($con,$sql);
		$row = mysqli_fetch_all($query,MYSQLI_ASSOC);
		return $row;
	}
	public function getAppliedJob($userId,$jobId){
		global $con;
		$sql = "Select * from apply_job where user_id ='".$userId."' and job_id ='".$jobId."'";
		$query = mysqli_query($con,$sql);
		$row = mysqli_fetch_all($query,MYSQLI_ASSOC);
		return $row;
	}
	
	public function getCmsDetail(){
		global $con;
		$sql = "SELECT * FROM cms_management";
		$query = mysqli_query($con,$sql);
		$row = mysqli_fetch_all($query,MYSQLI_ASSOC);
		return $row;
	}
}

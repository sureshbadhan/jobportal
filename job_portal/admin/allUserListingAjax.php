<?php 
$path = __DIR__;
require($path."/../include/main.php");		

if(isset($_REQUEST['allJobs']) && ($_REQUEST['allJobs'])=='1'){ 
	$result=$admin->getAllUser();
	if(isset($result) && is_array($result) && count($result)>0){ ?>
		<thead>
			<tr>
				<th><span>Profile Image</span></th>
				<th><span>&nbsp;&nbsp;&nbsp;Name</span></th>
				<th><span>&nbsp;&nbsp;&nbsp;Email</span></th>
				<th>UserType</th>
				<th><span>Address</span></th>
				<th><span>Status</span></th>
				
			</tr>
		</thead>
		<tbody>
			<?php foreach($result as $row){ 
					if(isset($row['user_type']) && $row['user_type']=="Admin"){
						continue;
					}?>	
				<tr>
					<td>
						<?php if(empty($row['profile_image'])){ 
								echo "<img src='../gallery/userProfile/user_default.jpg' / width='100px' height='100px'>";
							}else{
								echo "<img src='../gallery/userProfile/".$row['profile_image']."' width='100px' height='100px'>";
							}?>
					</td>
					<td>
						<?php echo (isset($row['first_name']))?ucfirst($row['first_name'])." ":""; echo (isset($row['last_name']))?ucfirst($row['last_name']):"";?>
					</td>
					<td>
						<?php echo (isset($row['email']))?$row['email']:"";?>
					</td>

					<td>
						<?php
						echo (isset($row['user_type']))?$row['user_type']:"";?>
					</td>
					<td>
						<?php echo (isset($row['address']))?$row['address']:"";?>
					</td>
					<td>
						<?php echo (isset($row['status']))?$row['status']:"";?>
					</td>
					<?php if(isset($row['user_type']) && $row['user_type']=="Employer"){?>
					<td>
						<a href="editEmployerUser.php?Id=<?php echo (isset($row['id']))?$row['id']:"";?>" class="btn btn-primary" role="button"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>
							</a>
					</td>
					<?php }else{?>
					<td>
						<a href="editSeekerUser.php?Id=<?php echo (isset($row['id']))?$row['id']:"";?>" class="btn btn-primary" role="button"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>
						</a>
					</td>
					<?php }?>
					<td>
						<a href="" class="btn btn-danger" role="button" id="delete" onclick="deleteFun('<?php echo $row['id'];?>')"><i class="fa fa-trash" aria-hidden="true"></i>
						</a>
					</td>
					<?php
					if($row['active']=='0'){?>
					<td>
					<a href="" class="btn btn-danger" onclick="blockFun('<?php echo (isset($row['id']))?$row['id']:"";?>')">Block
					</a>
					</td>
					<?php
					}else{?>
						<td>
						<a href="" class="btn btn-success" onclick="unblockFun('<?php echo (isset($row['id']))?$row['id']:"";?>')">Unblock
						</a>
						</td>
					<?php
					}?>	 
				</tr>
			<?php }?>
		</tbody>
	<?php }
} ?>	

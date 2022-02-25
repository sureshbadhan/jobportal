<?php 
$path = __DIR__;
require($path."/../include/main.php");		
		
if(isset($_REQUEST['allJobs']) && ($_REQUEST['allJobs'])=='1'){
	$result=$user->getAlljobs();
	if(isset($result) && is_array($result) && count($result)>0){ ?>
		<thead>
			<tr>
				<th><span>Job Title</span></th>
				<th><span>Location</span></th>
				<th>Description</th>
				<th>&nbsp &nbsp &nbsp Owner</th>
				<th><span>Added On</span></th>
				<th><span>Status</span></th>
				<th>&nbsp;</th>
				<th>&nbsp;</th>
				<th>&nbsp;</th>
				<th>&nbsp;</th>
			</tr>
		</thead>
		<tbody><?php 
			foreach($result as $row){ ?>
				<tr>
					<td>
						<a href="job_detail.php?jobId=<?php echo $row['jobid'];?>"><?php echo (isset($row['job_title']))?$row['job_title']:"";?></a>
					</td>		
					<td>
						<?php echo (isset($row['address']))?ucfirst($row['address']):"";?>
					</td>
					<td>
						<?php echo (isset($row['description']))?ucfirst($row['description']):"";?>
					</td>
					<td>
						<?php echo (isset($row['first_name']))?ucfirst($row['first_name'])." ":""; echo (isset($row['last_name']))?$row['last_name']:"";?>
					</td>
					<td>
						<?php echo (isset($row['date_time']))?$row['date_time']:"";?>
					</td>
					<td>
						<?php echo (isset($row['status']))?$row['status']:"";?>
					</td>
					<td>
						<a href="" class="btn btn-danger" role="button" id="delete" onclick="deleteFun('<?php echo (isset($row['jobid']))?$row['jobid']:"";?>')"><i class="fa fa-trash" aria-hidden="true"></i>
						</a>
					</td>
					<?php if(isset($row['job_active']) && $row['job_active']=='0'){ ?>
							<td>
								<a href="" id="btn" class="btn btn-danger" onclick="deactiveFun('<?php echo (isset($row['jobid']))?$row['jobid']:"";?>')">Deactivate
								</a>
							</td>
					<?php }else{?>
							<td>
								<a href="" id="btn" class="btn btn-success" onclick="activeFun('<?php echo (isset($row['jobid']))?$row['jobid']:"";?>')">Activate
								</a>
							</td>
					<?php }?>
				</tr>
			<?php } ?>
		</tbody> 
	<?php }
}?>
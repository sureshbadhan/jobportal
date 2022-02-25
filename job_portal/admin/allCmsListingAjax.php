<?php 
$path = __DIR__;
require($path."/../include/main.php");		
	
if(isset($_REQUEST['allJobs']) && ($_REQUEST['allJobs'])=='1'){
	$allContenetDetail = $admin->getAllContentDetails();
	if(isset($allContenetDetail) && is_array($allContenetDetail) && count($allContenetDetail)>0){ ?>
		<thead>
			<tr>
				<th>Title</th>
				<th>Description</th>
				<th>Status</th>
				<th width="180"></th>
				
			</tr>
		</thead>
		<tbody><?php 
			foreach($allContenetDetail as $row){ ?>
				<tr>
					<td>
						<?php echo (isset($row['title']))?$row['title']:"";?>
					</td>		
					<td>
						<?php echo substr($row['description'],0,80);?><a class="see-more-btn" href="discriptionDetail.php?id=<?php echo (isset($row['id']))?$row['id']:"";?>"><small>See detail</small></a>
					</td>
					<td>
						<?php echo (isset($row['status']))?$row['status']:"";?>
					</td>
					<td>
						<a href="editCmsPage.php?id=<?php echo (isset($row['id']))?$row['id']:"";?>" class="btn btn-primary" role="button"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>
						</a>
						&nbsp;
						<a href="" class="btn btn-danger" role="button" onclick="deleteFun('<?php echo (isset($row['id']))?$row['id']:"";?>')"><i class="fa fa-trash" aria-hidden="true"></i>
						</a>
						&nbsp;
						<?php if(isset($row['publish']) && $row['publish']=='0'){ ?>
							<a href="" id="btn" class="btn btn-danger" onclick="unPublish('<?php echo (isset($row['id']))?$row['id']:"";?>')">Unpublish
							</a>
						<?php }else{ ?>
							<a href="" id="btn" class="btn btn-success" onclick="publishFun('<?php echo (isset($row['id']))?$row['id']:"";?>')">Publish
							</a>
						<?php }?>
					</td>
				</tr>
			<?php } ?>
		</tbody> 
	<?php }
}?>

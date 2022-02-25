<?php
$dirPath = __DIR__;
require($dirPath."/include/main.php");					
include($dirPath."/include/header.php");

$smsDetail = $user->getCmsDetail();
if(isset($smsDetail) && is_array($smsDetail) && count($smsDetail)>0){?>
	<div class="page-title">History</div>
	<div class="container job-listing">
		<div class="panel panel-default panel-order">
			<div class="panel-body">
				<div class="row">
				<!-- left content-->
					<div class="row">
						<div class="container">
							<div class="col-md-12  animated fadeInUp">
								<?php foreach($smsDetail as $key=>$value){ 
										if(isset($value['publish']) && $value['publish']==0){
											if(isset($value['title']) && $value['title']=="history"){?>
												<p><?php echo $value['description'];?> </p>
									<?php 	}
										}
								}?>	
							</div>
						</div>
					</div>	
				</div>
			</div>
		</div>
	</div>	
<?php }
	include($dirPath."/include/footer.php");
?>
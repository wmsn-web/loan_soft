<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
	<?php $this->load->view("inc/layout"); ?>
</head>
<body>
	<!--Top Bar-->
<?php include("inc/headers.php"); ?>
<!--Top Bar end-->
<div class="container-fluid">
	<div class="row">
		<?php include("inc/menu.php"); ?>
		<div class="main_content">
			<div class="row">
				<div class="col-md-12">
					<div class="card">
						<div class="card-body">
							<h5>All Users</h5>
							<div class="table-responsive">
								<table class="table table-bordered" id="example2">
									<thead>
										<tr>
											<th>SL</th>
											<th>Name</th>
											<th>username</th>
											<th>Email</th>
											<th>Phone</th>
											<th>Role</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										<?php if(!empty($all_users)): ?>
											<?php $s = 1; foreach($all_users as $usr): $sl = $s++; ?>
												<tr>
													<td><?= $sl; ?></td>
													<td><?= $usr['name']; ?></td>
													<td><?= $usr['user_admin']; ?></td>
													<td><?= $usr['email']; ?></td>
													<td><?= $usr['phone']; ?></td>
													<td><?= $usr['role']; ?></td>
													<td>
														<a href="<?= base_url('dashboard/All_user/Edit_user/'.$usr['id']); ?>">
														<button class="btn btn-warning btn-sm">Edit / View User</button></a>
														<?php if($usr['status']==0):
															$sts = "<span class='text-danger'>Deactive</span>";

														else:
															$sts = "<span class='text-success'>Active</span>";
														endif; 
														 ?>
														 <input type="hidden" id="status" value="<?=$usr['status']; ?>">
															<a id="ac__<?= $usr['id']; ?>" href="#" onclick="changeUserStatus('<?= $usr['id']; ?>')" class="text-danger">
																<?= $sts; ?>
															</a>
														
													</td>
												</tr>
											<?php endforeach; ?>
										<?php endif; ?>
												
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php include("inc/footer.php"); ?>
<?php $this->load->view("inc/js");?>
<script type="text/javascript">
	function changeUserStatus(id)
	{
		var sts = $("#status").val();
		if(sts == 0)
		{
			var res = confirm("Activate this user? Please Click OK to Proceed.");
			if(res == true)
			{
				//logic to activate
				$.post("<?= base_url('dashboard/AjaxController/change_user_status'); ?>",{
					id: id
				},function(resp){
					$("#ac__"+id).html('<span class="text-success">Active</span>');
					$("#ac__"+id).css("color","#090");
					$("#status").val(1);
				})
				

			}
		}
		else
		{
			var res = confirm("Deactivate this user? Please Click OK to Proceed.");
			if(res == true)
			{
				//logic to Deactivate
				$.post("<?= base_url('dashboard/AjaxController/change_user_status'); ?>",{
					id: id
				},function(resp){
					$("#ac__"+id).html('<span class="text-danger">Deactive</span>');
					$("#ac__"+id).css("color","#f00");
					$("#status").val(0);
				})
					
			}
		}
	}
</script>
</body>
</html>
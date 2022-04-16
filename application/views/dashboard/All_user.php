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
<div class="top-bar">
	<div class="main_logo">
		<div class="logo">
			<h3>Software Name</h3>
		</div>
	</div>
	<div class="right_panel">
		<div class="logout">
			<a href="<?= base_url('dashboard/Home/logout'); ?>">Logout</a>
		</div>
	</div>
</div>
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
													<td><?= $usr['email']; ?></td>
													<td><?= $usr['phone']; ?></td>
													<td><?= $usr['role']; ?></td>
													<td>
														<a href="<?= base_url('dashboard/All_user/Edit_user/'.$usr['id']); ?>">
														<button class="btn btn-warning btn-sm">Edit / View User</button>
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
	
</script>
</body>
</html>
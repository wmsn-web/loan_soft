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
				<div class="col-md-4">
					<div class="card">
						<div class="card-body">
							<form action="<?= base_url('dashboard/Agents/add_agents'); ?>" method="post" data-parsley-validate novalidate>
								<div class="form-group">
									<label>Agent Name</label>
									<input type="text" name="agent_name" class="form-control" required>
								</div>
								<div class="form-group">
									<label>Agent Mobile Number</label>
									<input type="text" name="mob" class="form-control" required>
								</div>
								<div class="form-group">
									<label>Agent Code</label>
									<input type="text" name="agent_code" class="form-control" required value="<?= mt_rand(0000000,9999999); ?>" readonly>
								</div>
								<div class="form-group">
									<button class="btn_new">Add Agent</button>
								</div>
							</form>
						</div>
					</div>
				</div>
				<div class="col-md-8">
					<div class="card">
						<div class="card-body">
							<h5>All Users</h5>
							<div class="table-responsive">
								<table class="table table-bordered" id="example2">
									<thead>
										<tr>
											<th>SL</th>
											<th>Name</th>
											<th>Phone</th>
											<th>Agent Code</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										<?php if(!empty($data)): ?>
											<?php $s = 1; foreach($data as $usr): $sl = $s++; ?>
												<tr>
													<td><?= $sl; ?></td>
													<td><?= $usr['agent_name']; ?></td>
													<td><?= $usr['mob']; ?></td>
													<td><?= $usr['agent_code']; ?></td>
													<td>
														<?php if($usr['status']==1): ?>
															<a href="<?= base_url('dashboard/Agents/change_status/'.$usr['id']); ?>">
																<button class="btn btn-warning btn-sm" type="button">Block</button>
															</a>
														<?php else: ?>
															<a href="<?= base_url('dashboard/Agents/change_status/'.$usr['id']); ?>">
																<button class="btn btn-danger btn-sm" type="button">Unblock</button>
															</a>
														<?php endif; ?>
													</td>
												</tr>
											<?php endforeach; ?>
										<?php endif; ?>
									</tbody>
									<tfoot>
										<tr>
											<th>SL</th>
											<th>Name</th>
											<th>Phone</th>
											<th>Agent Code</th>
											<th>Action</th>
										</tr>
									</tfoot>
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
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
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-12">
						<div class="card">
							<div class="card-header">
								<h4 class="card-title">All Customers</h4>
							</div>
							<div class="card-body">
								<div class="table-responsive">
									<table class="table table-bordered" id="example2">
										<thead>
											<tr>
												<th>SL</th>
												<th>Full Name</th>
												<th>Gender</th>
												<th>Mobile</th>
												<th>Email</th>
												<th>PAN</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody>
											<?php if(!empty($data)): ?>
												<?php $s = 1; foreach($data as $key): $sl = $s++; ?>
													<tr>
														<td><?= $sl; ?></td>
														<td><?= $key['full_name']; ?></td>
														<td><?= $key['gender']; ?></td>
														<td><?= $key['cont_number']; ?></td>
														<td><?= $key['email']; ?></td>
														<td><?= $key['pan_no']; ?></td>
														<td>
															<a href="<?= base_url('dashboard/All_customers/Edit_customer/'.$key['id']); ?>">
															<button class="btn btn-warning btn-sm">Edit</button>

															<button class="btn btn-danger btn-sm">Delete</button>
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
</div>
<?php include("inc/footer.php"); ?>
<?php include("inc/modals.php"); ?>
<?php $this->load->view("inc/js");?>
<script type="text/javascript">

</script>
</body>
</html>
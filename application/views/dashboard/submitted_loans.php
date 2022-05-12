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
			<div class="top_menu">
				<?php include("inc/apply_loan_menu.php"); ?>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="card">
						<div class="card-body">
							<h5>Submitted Loans</h5>
							<div class="table-responsive">
								<table class="table table-bordered" id="example2">
									<thead>
										<tr>
											<th>SL</th>
											<th>Application ID</th>
											<th>Loan A/c</th>
											<th>Name</th>
											<th>Contact Number</th>
											<th>Status</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										<?php if(!empty($data)): ?>
											<?php $s = 1; foreach($data as $key): $sl = $s++; ?>
											<?php $gtadmin = $this->UserModel->get_profiles($key['submitted_by']); ?>
												<tr>
													<td><?= $sl; ?></td>
													<td>
														<?= $key['application_id']; ?><br>
														<b class="text-info"> <?=  $gtadmin['name']; ?></b><br><span class="text-danger"><?= unslugify($key['loan_type']); ?></span>
													</td>
													<td><?= $key['loan_ac_no']; ?></td>
													<td><?= $key['full_name']; ?></td>
													<td><?= $key['cont_number']; ?></td>
													<td>
														<?php if($key['closing_status']=="open"): ?>
															<?= unslugify($key['loan_status']); ?>
														<?php else:?>
															<?= unslugify($key['closing_status']); ?>
														<?php endif; ?>
													</td>
													<td>
														<?php if($prof['role_slug']=="data-entry-operator" && $key['loan_status']=="pending" || $prof['role_slug']=="super_admin"): ?>
															<a href="<?= base_url('dashboard/Apply_loan/create_account/step1/'.$key['application_id']); ?>">
															<button class="btn btn-warning btn-sm">Edit / View</button></a>
														<?php else: ?>
															<?php if(@$parmsn->review_account=="1" || $prof['role']=="Super_admin"): ?>
																<?php if($key['loan_status']=="under-review"): ?>
																	<a href="<?= base_url('dashboard/Apply_loan/create_account/step1/'.$key['application_id']); ?>"><button class="btn btn-warning btn-sm">Review Loan</button></a>
																<?php elseif(@$parmsn->disburs_loan=="1" || $prof['role']=="Super_admin"): ?>
																	<?php if($key['loan_status']=="approved"): ?>
																		<a href="">
																			<button class="btn btn-primary btn-sm">Disburse Loan</button>
																		</a>
																		<a href="<?= base_url('dashboard/Apply_loan/create_account/step1/'.$key['application_id']); ?>"><button class="btn btn-warning btn-sm">Loan Details</button></a>
																	<?php endif; ?>
																	<?php endif; ?>
																
															<?php else: ?>
														<button disabled class="btn btn-warning btn-sm">Edit / View</button>
														<?php endif; ?>
													
														<?php endif; ?>
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
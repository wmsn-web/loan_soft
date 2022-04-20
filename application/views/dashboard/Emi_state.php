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
						<div class="card-header">
							<h5>Add EMI State</h5>
						</div>
						<div class="card-body">
							<form action="<?= base_url('dashboard/Emi_state/add_emi_state'); ?>" method="post">
								<div class="form-group">
									<label>Add Number of Month</label>
									<input type="number" name="month_num" class="form-control" required>
								</div>
								<div class="form-group">
									<label>Rate Of Interest (% / A)</label>
									<input type="number" name="int_rate" class="form-control" required>
								</div>
								<div class="form-group">
									<button class="btn_new">Save</button>
								</div>
							</form>
						</div>
					</div>
				</div>
				<div class="col-md-8">
					<div class="card">
						<div class="card-body">
							<h5>EMI States</h5>
							<div class="table-responsive">
								<table class="table table-bordered" id="example2">
									<thead>
										<tr>
											<th>SL</th>
											<th>Number Of Months</th>
											<th>Rate Of Interest (% / A)</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										<?php if(!empty($loan_setup)): ?>
											<?php $s = 1; foreach($loan_setup as $lsetup): $sl = $s++; ?>
												<tr>
													<td><?= $sl; ?></td>
													<td><?= $lsetup['month_num']; ?> Months</td>
													<td><?= $lsetup['int_rate']; ?>%</td>
													
													<td>
														<button onclick="delEmiState('<?= $lsetup['id']; ?>')" class="btn btn-danger btn-sm">Delete</button>
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
	function delEmiState(ids)
	{
		var res = confirm("Are you sure to delete this EMI State? Please Click OK to Proceed.");
		if(res == true)
		{
			location.href = "<?= base_url('dashboard/Emi_state/delete_emi/'); ?>"+ids;
		}
	}
</script>
</body>
</html>
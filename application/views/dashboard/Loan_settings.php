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
						<a href="<?= base_url('dashboard/Emi_state'); ?>"><button class="btn_new">EMI Tenure</button></a>
						<a href="<?= base_url('dashboard/Loan_settings'); ?>"><button class="btn_new">Loan Settings</button></a>
						<a href="<?= base_url('dashboard/Loan_Category'); ?>"><button class="btn_new">Loan Category</button></a>
					</div>
				</div>
				<div class="row justify-content-center">
					<div class="col-md-8">
						<div class="card">
							<div class="card-header">
								<h5>Loan Settings</h5>
							</div>
							<div class="card-body">
								<?php $data = loan_setup(); ?>
								<form action="<?= base_url('dashboard/Loan_settings/save_setting'); ?>" method="post">
									<div class="row">
										<div class="form-group col-md-6">
											<label>Forclose Charge (%)</label>
											<input type="number" name="forclose_precent" class="form-control" required value="<?= $data['forclose_precent']; ?>">
										</div>
										<div class="form-group col-md-6">
											<label>Repayment Delay Maximum (Days)</label>
											<input type="number" name="maximum_days" class="form-control" required value="<?= $data['maximum_days']; ?>">
										</div>
										<div class="form-group col-md-6">
											<label>Repayment Delay Charge</label>
											<input type="number" name="repay_delay_chgs" class="form-control" required value="<?= $data['repay_delay_chgs']; ?>">
										</div>
										<div class="col-md-12 form-group">
											<button class="btn btn-primary btn-sm">Save</button>
										</div>

								</form>
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
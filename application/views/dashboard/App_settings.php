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
					<div class="col-md-12"></div>
				</div>
				<div class="row justify-content-center">
					<div class="col-md-10">
						<div class="card">
							<div class="card-header">
								<h4 class="card-title">App Settings</h4>
							</div>
							<?php $data = all_settings(); ?>
							<div class="card-body">
								<form action="<?= base_url('dashboard/App_settings/save_app_settings'); ?>" method="post">
									<div class="row">
										<div class="form-group col-md-12">
											<label><b>Company Setup</b></label>
										</div>
										<div class="form-group col-md-4">
											<label>App Name</label>
											<input type="text" name="app_name" class="form-control" required value="<?= $data['app_name']; ?>">
										</div>
										<div class="form-group col-md-4">
											<label>Company Name</label>
											<input type="text" name="company_name" class="form-control" required value="<?= $data['company_name']; ?>">
										</div>
										<div class="form-group col-md-4">
											<label> Company Address</label>
											<input type="text" name="company_addr" class="form-control"  value="<?= $data['company_addr']; ?>">
										</div>
										<div class="form-group col-md-4">
											<label>City</label>
											<input type="text" name="company_city" class="form-control" value="<?= $data['company_city']; ?>" >
										</div>
										<div class="form-group col-md-4">
											<label>State</label>
											<input type="text" name="company_state" class="form-control" value="<?= $data['company_state']; ?>" >
										</div>
										<div class="form-group col-md-4">
											<label>ZIP/PIN</label>
											<input type="text" name="company_pin" class="form-control" value="<?= $data['company_pin']; ?>" >
										</div>
										<div class="form-group col-md-12">
											<label><b>SMTP Setup</b></label>
										</div>
										<div class="form-group col-md-4">
											<label>SMTP Host</label>
											<input type="text" name="smtp_host" class="form-control"  value="<?= $data['smtp_host']; ?>">
										</div>
										<div class="form-group col-md-4">
											<label>SMTP Port</label>
											<input type="text" name="smtp_port" class="form-control"  value="<?= $data['smtp_port']; ?>">
										</div>
										<div class="form-group col-md-4">
											<label>SMTP User</label>
											<input type="text" name="smtp_user" class="form-control"  value="<?= $data['smtp_user']; ?>">
										</div>
										<div class="form-group col-md-4">
											<label>SMTP Password</label>
											<input type="text" name="smtp_password" class="form-control" value="<?= $data['smtp_password']; ?>" >
										</div>
										<div class="form-group col-md-4">
											<label>Email Notifications</label>
											<select name="notification_email" class="form-control" >
												<?php if($data['notification_email']==1)
												{
													$slct1 = "selected"; $slct2 = "";
												}else{$slct1 = ""; $slct2 = "selected";} ?>
												<option <?= $slct1; ?> value="1">Yes</option>
												<option <?= $slct2; ?> value="0">No</option>
											</select>
										</div>
										<div class="form-group col-md-4">
											<label>Email for Transactions</label>
											<select name="transaction_email" class="form-control" >
												<?php if($data['transaction_email']==1)
												{
													$slct1 = "selected"; $slct2 = "";
												}else{$slct1 = ""; $slct2 = "selected";} ?>
												<option <?= $slct1; ?> value="1">Yes</option>
												<option <?= $slct2; ?> value="0">No</option>
											</select>
										</div>
										<div class="form-group col-md-12">
											<button class="btn btn-primary btn-sm">Save Settings</button>
										</div>
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
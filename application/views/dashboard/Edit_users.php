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
			<div class="row justify-content-center">
				<div class="col-md-10">
					<div class="card">
						<div class="card-header">
							<h5 class="card-title">Add User</h5>
						</div>
						<div class="card-body">
							<form action="<?= base_url('dashboard/Add_user/update_user'); ?>" method="post"  data-parsley-validate novalidate>
								<div class="row">
									<div class="form-group col-md-6">
										<label>Name</label>
										<input type="text" name="name" class="form-control" required value="<?= $data['name']; ?>">
									</div>
									<div class="form-group col-md-6">
										<label>Email</label>
										<input type="email"  name="email" class="form-control" required value="<?= $data['email']; ?>">
									</div>
									<div class="form-group col-md-6">
										<label>Phone / Mobile Number</label>
										<input type="text" name="phone" maxlength="10" class="form-control" required value="<?= $data['phone']; ?>">
									</div>
									<div class="form-group col-md-6">
										<label>Username</label>
										<input type="text" readonly name="user_admin" class="form-control" required value="<?= $data['user_admin']; ?>">
										<span id="msg1"></span>
									</div>
									<?php $parm = json_decode($data['permissions']);
										
									?>
									
									<div class="form-group col-md-4">
										<label>User Role</label>
										<select name="role" class="form-control" required>
											<option><?= $data['role']; ?></option>
											<option>Data Entry Operator</option>
											<option>Reviewer</option>
											<option>Manager</option>
											<option>Loan Admin</option>
										</select>
									</div>
									<div class="form-group col-md-8">
										<label>Permissions</label>
										<div class="row">
											<div class="col-md-4">
												<?php if($parm->create_account == '1'){$chk = "checked";}else{$chk = "";} ?>
												<input <?= $chk; ?> type="checkbox" name="create_account" value="1">
												<label>Create Account</label>
											</div>
											<div class="col-md-4">
												<?php if($parm->review_account == '1'){$chk = "checked";}else{$chk = "";} ?>
												<input <?= $chk; ?> type="checkbox" name="review_account" value="1">
												<label>Review Account</label>
											</div>
											<div class="col-md-4">
												<?php if($parm->disburs_loan == '1'){$chk = "checked";}else{$chk = "";} ?>
												<input <?= $chk; ?>  type="checkbox" name="disburs_loan" value="1">
												<label>Disburs Loan</label>
											</div>
											<div class="col-md-4">
												<?php if($parm->manage_repayment == '1'){$chk = "checked";}else{$chk = "";} ?>
												<input <?= $chk; ?> type="checkbox" name="manage_repayment" value="1">
												<label>Accept Repayments</label>
											</div>
											<div class="col-md-4">
												<?php if($parm->user_manage == '1'){$chk = "checked";}else{$chk = "";} ?>
												<input <?= $chk; ?> type="checkbox" name="user_manage" value="1">
												<label>User Managment</label>
											</div>
											<div class="col-md-4">
												<?php if($parm->enquery == '1'){$chk = "checked";}else{$chk = "";} ?>
												<input <?= $chk; ?> type="checkbox" name="enquery" value="1">
												<label>Enquery</label>
											</div>
										</div>
									</div>
									<div class="form-group col-md-12">
										<input type="hidden" name="id" value="<?= $data['id']; ?>">
										<button id="reg"  class="btn_new">Update User</button>
									</div>
								</div>
							</form>
							<form action="<?= base_url('dashboard/Add_user/update_pass'); ?>" method="post">
								<h5><b>Change Password</b></h5>
								<div class="row">
									<div class="form-group col-md-4">
										<label>New Password</label>
										<input type="password" name="new_pass" class="form-control" required>
									</div>
									<div class="form-group col-md-4">
										<label>&nbsp;</label><br>
										<input type="hidden" name="id" value="<?= $data['id']; ?>">
										<button class="btn_new">Update Password</button>
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
<?php include("inc/footer.php"); ?>
<?php $this->load->view("inc/js");?>

</body>
</html>
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
			<div class="row justify-content-center">
				<div class="col-md-10">
					<div class="card">
						<div class="card-header">
							<h5 class="card-title">Add User</h5>
						</div>
						<div class="card-body">
							<form action="<?= base_url('dashboard/Add_user/save_user'); ?>" method="post"  data-parsley-validate novalidate>
								<div class="row">
									<div class="form-group col-md-6">
										<label>Name</label>
										<input type="text" name="name" class="form-control" required>
									</div>
									<div class="form-group col-md-6">
										<label>Email</label>
										<input type="email"  name="email" class="form-control" required>
									</div>
									<div class="form-group col-md-6">
										<label>Phone / Mobile Number</label>
										<input type="text" name="phone" maxlength="10" class="form-control" required>
									</div>
									<div class="form-group col-md-6">
										<label>Username</label>
										<input type="text" onblur="validate_user(this.value)" name="user_admin" class="form-control" required>
										<span id="msg1"></span>
									</div>
									<div class="form-group col-md-6">
										<label>Password</label>
										<input type="password" id="pass" class="form-control" required>
									</div>
									<div class="form-group col-md-6">
										<label>Confirm Password</label>
										<input type="password" onkeyup="validate_pass()" name="password" id="conpass" class="form-control" required>
										<span id="msg"></span>
									</div>
									<div class="form-group col-md-4">
										<label>User Role</label>
										<select name="role" class="form-control" required>
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
												<input type="checkbox" name="create_account" value="1">
												<label>Create Account</label>
											</div>
											<div class="col-md-4">
												<input type="checkbox" name="review_account" value="1">
												<label>Review Account</label>
											</div>
											<div class="col-md-4">
												<input type="checkbox" name="disburs_loan" value="1">
												<label>Disburs Loan</label>
											</div>
											<div class="col-md-4">
												<input type="checkbox" name="manage_repayment" value="1">
												<label>Accept Repayments</label>
											</div>
											<div class="col-md-4">
												<input type="checkbox" name="user_manage" value="1">
												<label>User Managment</label>
											</div>
											<div class="col-md-4">
												<input type="checkbox" name="enquery" value="1">
												<label>Enquery</label>
											</div>
										</div>
									</div>
									<div class="form-group col-md-12">
										<button id="reg" disabled class="btn_new">Save User</button>
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
<script type="text/javascript">
	
	function validate_pass()
	{
		var pass = $("#pass").val();
		var conpass = $("#conpass").val();
		if(conpass == pass)
		{
			$("#msg").html("<b style='color:#090'>Password Matched.</b>");
			$("#reg").attr("disabled",false);
		}
		else
		{
			$("#msg").html("<b style='color:#f00'>Password Does Not Match!.</b>");
			$("#reg").attr("disabled",true);
		}
	}
	function validate_user(vals)
	{
		if(vals == '')
		{
			$("#msg1").html("<b style='color:#f00'>Please Add Username.</b>");
			$("#reg").attr("disabled",true);
		}
		else
		{
			$.post("<?= base_url('dashboard/AjaxController/validate_user'); ?>",{
				user_admin: vals
			},function(resp){
				if(resp > 0)
				{
					$("#msg1").html("<b style='color:#f00'>Username Already Exist!.</b>");
					$("#reg").attr("disabled",true);
					$("#pass").val("");
					$("#conpass").val("");
				}
				else
				{
					$("#msg1").html("<b style='color:#090'><i class='fas fa-check'></i> Valid User");
					$("#reg").attr("disabled",false);
					$("#pass").val("");
					$("#conpass").val("");
				}
			});
		}
			
	}

	$("#pass").blur(function(){
		validate_pass();
	});
</script>
</body>
</html>
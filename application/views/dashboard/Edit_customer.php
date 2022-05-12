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
			<form action="<?= base_url('dashboard/Add_customer/update_customer'); ?>" method="post" data-parsley-validate novalidate>
				<div class="container-fluid">
					<div class="row">
						<div class="form-group col-md-12 bg-grey">
							<h5>Customer Information</h5>
						</div>
						<div class="form-group col-md-4">
							<label>Full Name</label>
							<input type="text" name="full_name" class="form-control"  required value="<?= $data['full_name']; ?>">
						</div>
						<div class="form-group col-md-4">
							<label>Gender</label>
							<select name="gender" class="form-control" required>
								<option value="<?= $data['gender']; ?>"><?= $data['gender']; ?></option>
								<option value="Male">Male</option>
								<option value="Female">Female</option>
								<option value="Transgender">Transgender</option>
							</select>
						</div>
						<div class="form-group col-md-4">
							<label>Date of Birth</label>
							<input type="date" name="dob" class="form-control" value="<?= $data['dob']; ?>" required>
						</div>
						<div class="col-md-9">
							<div class="row">
								<div class="form-group col-md-6">
									<label>Contact Number</label>
									<input type="text" name="cont_number" class="form-control"  required value="<?= $data['cont_number']; ?>">
								</div>
								<div class="form-group col-md-6">
									<label>Email Address</label>
									<input type="email" name="email" class="form-control"  required value="<?= $data['email']; ?>">
								</div>
								<div class="form-group col-md-12">
									<b>Current Address</b><br>
								</div>
								<div class="form-group col-md-12">
									<label>Address</label>
									<input type="text" id="addr1" name="adress" class="form-control"  required value="<?= $data['adress']; ?>">
								</div>
								<div class="form-group col-md-4">
									<label>City</label>
									<input type="text" id="city1" name="city" class="form-control"  required value="<?= $data['city']; ?>">
								</div>
								<div class="form-group col-md-4">
									<label>ZIP/PIN</label>
									<input type="text" id="pin1" name="pin" class="form-control"  required value="<?= $data['pin']; ?>">
								</div>
								<div class="form-group col-md-4">
									<label>State</label>
									<input type="text" id="state1" name="state" class="form-control"  required value="<?= $data['state']; ?>">
								</div>
							</div>
						</div>
						
						<div class="form-group col-md-12">
							<b>Residence Address</b><br>
							<?php if($data['same_addr']=="yes"){ $chkd = "Checked";}else{$chkd = "";} ?>
								<input <?= $chkd; ?> id="sameAddr" type="checkbox" onclick="same_addressxx()"  value="yes">
							
							<input type="hidden" id="smAdr" name="same_addr" value="<?= $data['same_addr']; ?>" >
							<label>Same as Current Address?</label>
						</div>
						<div class="form-group col-md-12">
							<label>Address</label>
							<input type="text" id="addr2" name="r_adress" class="form-control"  required value="<?= $data['r_adress']; ?>">
						</div>
						<div class="form-group col-md-4">
							<label>City</label>
							<input type="text" id="city2" name="r_city" class="form-control"  required value="<?= $data['r_city']; ?>">
						</div>
						<div class="form-group col-md-4">
							<label>ZIP/PIN</label>
							<input type="text" id="pin2" name="r_pin" class="form-control" required value="<?= $data['r_pin']; ?>">
						</div>
						<div class="form-group col-md-4">
							<label>State</label>
							<input type="text" id="state2" name="r_state" class="form-control"  required value="<?= $data['r_state']; ?>">
						</div>
						<div class="form-group col-md-4">
							<label>Voter ID Card Number</label>
							<input type="text" name="v_id" class="form-control"   required value="<?= $data['v_id']; ?>">
						</div>
						<div class="form-group col-md-4">
							<label>Adhaar Number</label>
							<input type="text"  name="adhar_no" class="form-control"   required value="adhar_no">
						</div>
						<div class="form-group col-md-4">
							<label>PAN Number</label>
							<input onblur="check_pans(this.value)" type="text" name="pan_no" class="form-control" value="<?= $data['pan_no']; ?>" readonly required>
						</div>
						<div class="form-group col-md-12">
							<input type="hidden" name="id" value="<?= $data['id']; ?>">
							<button type="submit" id="submit_stepx" class="btn_new">Save & Next</button>
							<?= br(3); ?>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
<?php include("inc/footer.php"); ?>
<?php $this->load->view("inc/js");?>
<script type="text/javascript">
	function same_addressxx()
	{
		if ($('input#sameAddr').is(':checked')) 
		{
			$("#addr2").val($("#addr1").val());
			$("#city2").val($("#city1").val());
			$("#pin2").val($("#pin1").val());
			$("#state2").val($("#state1").val());
			$("#smAdr").val("yes");
		}
		else
		{
			$("#addr2").val("");
			$("#city2").val("");
			$("#pin2").val("");
			$("#state2").val("");
			$("#smAdr").val("no");
		}
	}
	
</script>
</body>
</html>
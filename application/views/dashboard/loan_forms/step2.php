<?php $apl_id =  $this->uri->segment(5); ?>
<form id="step_form" action="<?= base_url('dashboard/Loan_application_submit/submit_step2'); ?>" method="post" enctype="multipart/form-data">
	<h4>Application ID: <?= $this->uri->segment(5); ?></h4><?= br(2); ?>
	<h6 class="text-info">Select Borrower Information from Existing Account</h6>
	<div class="form-group col-md-4">
		<select onchange="fillExistinUser(this.value,'<?= $apl_id; ?>')" class="form-control">
			<option value="">Select From Existing Account</option>
			<option value="xx">New User</option>
			<?php if(!empty($users)): ?>
				<?php foreach($users as $usr): ?>
					<option value="<?= $usr['id']; ?>"><?= $usr['full_name']; ?></option>
				<?php endforeach; ?>
			<?php endif; ?>
		</select>
	</div>
	<div class="row">
		<div class="form-group col-md-12 bg-grey">
			<h5>BORROWER INFORMATION</h5>
		</div>
		<div id="xxx"></div>
		<div class="form-group col-md-4">
			<label>Full Name</label>
			<input type="text" name="full_name" class="form-control" value="<?= $loanData['full_name']; ?>" required>
		</div>
		<div class="form-group col-md-4">
			<label>Gender</label>
			<select name="gender" class="form-control" required>
				<option value="<?= $loanData['gender']; ?>"><?= $loanData['gender']; ?></option>
				<option value="Male">Male</option>
				<option value="Female">Female</option>
				<option value="Transgender">Transgender</option>
			</select>
		</div>
		<div class="form-group col-md-4">
			<label>Date of Birth</label>
			<input type="date" name="dob" class="form-control" value="<?= $loanData['dob']; ?>" required>
		</div>
		<div class="col-md-9">
			<div class="row">
				<div class="form-group col-md-6">
					<label>Contact Number</label>
					<input type="text" name="cont_number" class="form-control" value="<?= $loanData['cont_number']; ?>" required>
				</div>
				<div class="form-group col-md-6">
					<label>Email Address</label>
					<input type="email" name="email" class="form-control" value="<?= $loanData['email']; ?>" required>
				</div>
				<div class="form-group col-md-12">
					<b>Current Address</b><br>
				</div>
				<div class="form-group col-md-12">
					<label>Address</label>
					<input type="text" id="addr1" name="adress" class="form-control" value="<?= $loanData['adress']; ?>" required>
				</div>
				<div class="form-group col-md-4">
					<label>City</label>
					<input type="text" id="city1" name="city" class="form-control" value="<?= $loanData['city']; ?>" required>
				</div>
				<div class="form-group col-md-4">
					<label>ZIP/PIN</label>
					<input type="text" id="pin1" name="pin" class="form-control" value="<?= $loanData['pin']; ?>" required>
				</div>
				<div class="form-group col-md-4">
					<label>State</label>
					<input type="text" id="state1" name="state" class="form-control" value="<?= $loanData['state']; ?>" required>
				</div>
			</div>
		</div>
		<div class="col-md-3">
			<label class="upl_pic" for="uplPic">
				<?php if(empty($loanData['pro_img']))
					{
						$img = base_url('assets/img/default.jpg');
					}
					else
					{
						$img = base_url("uploads/".$apl_id."/".$loanData['pro_img']);
					} ?>
				<img src="<?= $img; ?>" id="blahImg" class="img-responsive" />
			</label>
			
			<input type="file" id="uplPic" name="pro_img" class="hide" accept="image/*" onchange="document.getElementById('blahImg').src = window.URL.createObjectURL(this.files[0])">
		</div>
		<div class="form-group col-md-12">
			<b>Residence Address</b><br>
			<?php if($loanData['same_addr']=="yes"): ?>
				<input id="sameAddr" checked type="checkbox" onclick="same_address()" value="yes">
			<?php else: ?>
				<input id="sameAddr" type="checkbox" onclick="same_address()"  value="yes">
			<?php endif; ?>
			<input type="hidden" id="smAdr" name="same_addr" value="<?= $loanData['same_addr']; ?>">
			<label>Same as Current Address?</label>
		</div>
		<div class="form-group col-md-12">
			<label>Address</label>
			<input type="text" id="addr2" name="r_adress" value="<?= $loanData['r_adress']; ?>" class="form-control" required>
		</div>
		<div class="form-group col-md-4">
			<label>City</label>
			<input type="text" id="city2" name="r_city" class="form-control" value="<?= $loanData['r_city']; ?>" required>
		</div>
		<div class="form-group col-md-4">
			<label>ZIP/PIN</label>
			<input type="text" id="pin2" name="r_pin" class="form-control" value="<?= $loanData['r_pin']; ?>" required>
		</div>
		<div class="form-group col-md-4">
			<label>State</label>
			<input type="text" id="state2" name="r_state" class="form-control"  value="<?= $loanData['r_state']; ?>" required>
		</div>
		<div class="form-group col-md-4">
			<label>Voter ID Card Number</label>
			<input type="text" name="v_id" class="form-control"  value="<?= $loanData['v_id']; ?>" required>
		</div>
		<div class="form-group col-md-4">
			<label>Adhaar Number</label>
			<input type="text"  name="adhar_no" class="form-control"  value="<?= $loanData['adhar_no']; ?>" required>
		</div>
		<div class="form-group col-md-4">
			<label>PAN Number</label>
			<input type="text" name="pan_no" class="form-control"  value="<?= $loanData['pan_no']; ?>" required>
		</div>
		<div class="form-group col-md-12">
			<input type="hidden"  name="application_id" class="form-control" required value="<?= $this->uri->segment(5); ?>">
			<button type="button" id="submit_step" class="btn_new">Save & Next</button>
			<?= br(3); ?>
		</div>
	</div>
</form>
<?php if($loanData['status_code'] > 1 && $prof['role_slug']=="data-entry-operator"): ?>
	<script type="text/javascript">
		location.href = "<?= base_url('dashboard/Apply_loan/Submitted_accounts'); ?>";
	</script>
<?php endif; ?>
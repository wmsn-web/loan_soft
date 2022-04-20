<?php $apl_id = $this->uri->segment(5); ?>
<form id="step_form" action="<?= base_url('dashboard/Loan_application_submit/submit_step3'); ?>" method="post" enctype="multipart/form-data" data-parsley-validate novalidate>
	<h4>Application ID: <?= $this->uri->segment(5); ?></h4><?= br(2); ?>
	<div class="row">
		<div class="form-group col-md-12 bg-grey">
			<h5>GUARANTOR INFORMATION</h5>
		</div>
		<div class="form-group col-md-4">
			<label>Full Name</label>
			<input type="text" name="g_full_name" class="form-control" value="<?= $loanData['g_full_name']; ?>" required>
		</div>
		<div class="form-group col-md-4">
			<label>Gender</label>
			<select name="g_gender" class="form-control" required>
				<option value="<?= $loanData['g_gender']; ?>"><?= $loanData['g_gender']; ?></option>
				<option value="Male">Male</option>
				<option value="Female">Female</option>
				<option value="Transgender">Transgender</option>
			</select>
		</div>
		<div class="form-group col-md-4">
			<label>Date of Birth</label>
			<input type="date" name="g_dob" class="form-control" value="<?= $loanData['g_dob']; ?>" required>
		</div>
		<div class="col-md-9">
			<div class="row">
				<div class="form-group col-md-6">
					<label>Contact Number</label>
					<input type="text" name="g_cont_number" value="<?= $loanData['g_cont_number']; ?>" class="form-control" required>
				</div>
				<div class="form-group col-md-6">
					<label>Email Address</label>
					<input type="email" name="g_email" value="<?= $loanData['g_email']; ?>" class="form-control" required>
				</div>
				<div class="form-group col-md-12">
					<b>Current Address</b><br>
				</div>
				<div class="form-group col-md-12">
					<label>Address</label>
					<input type="text" id="addr1" name="g_adress" value="<?= $loanData['g_adress']; ?>" class="form-control" required>
				</div>
				<div class="form-group col-md-4">
					<label>City</label>
					<input type="text" id="city1" name="g_city" value="<?= $loanData['g_city']; ?>" class="form-control" required>
				</div>
				<div class="form-group col-md-4">
					<label>ZIP/PIN</label>
					<input type="text" id="pin1" name="g_pin" value="<?= $loanData['g_city']; ?>" class="form-control" required>
				</div>
				<div class="form-group col-md-4">
					<label>State</label>
					<input type="text" id="state1" name="g_state" value="<?= $loanData['g_state']; ?>" class="form-control" required>
				</div>
			</div>
		</div>
		<div class="col-md-3">
			<label class="upl_pic" for="uplPic">
				<?php if(empty($loanData['g_pro_img']))
				{
					$img = base_url('assets/img/default.jpg');
				}
				else
				{
					$img = base_url("uploads/".$apl_id."/".$loanData['g_pro_img']);
				} ?>
				<img src="<?= $img; ?>" id="blahImg" class="img-responsive" />
			</label>
			<input type="file" id="uplPic" name="g_pro_img" class="hide" accept="image/*" onchange="document.getElementById('blahImg').src = window.URL.createObjectURL(this.files[0])">
		</div>
		<div class="form-group col-md-12">
			<b>Residence Address</b><br>
			<?php if($loanData['g_same_addr']=="yes"): ?>
				<input id="sameAddr" checked type="checkbox" onclick="same_address()" value="yes">
			<?php else: ?>
				<input id="sameAddr" type="checkbox" onclick="same_address()"  value="yes">
			<?php endif; ?>
			<input type="hidden" id="smAdr" name="g_same_addr" value="<?= $loanData['same_addr']; ?>">
			<label>Same as Current Address?</label>
		</div>
		<div class="form-group col-md-12">
			<label>Address</label>
			<input type="text" id="addr2" name="g_r_adress" value="<?= $loanData['g_r_adress']; ?>" class="form-control" required>
		</div>
		<div class="form-group col-md-4">
			<label>City</label>
			<input type="text" id="city2" name="g_r_city" value="<?= $loanData['g_r_city']; ?>" class="form-control" required>
		</div>
		<div class="form-group col-md-4">
			<label>ZIP/PIN</label>
			<input type="text" id="pin2" name="g_r_pin" class="form-control" value="<?= $loanData['g_r_pin']; ?>" required>
		</div>
		<div class="form-group col-md-4">
			<label>State</label>
			<input type="text" id="state2" name="g_r_state" class="form-control" value="<?= $loanData['g_r_state']; ?>" required>
		</div>
		<div class="form-group col-md-4">
			<label>Voter ID Card Number</label>
			<input type="text" name="g_v_id" class="form-control"  value="<?= $loanData['g_v_id']; ?>" required onblur="checkKyc('<?= $this->uri->segment(5); ?>','v_id',this.value)">
		</div>
		<div class="form-group col-md-4">
			<label>Adhaar Number</label>
			<input type="text"  name="g_adhar_no" class="form-control"  value="<?= $loanData['g_adhar_no']; ?>" onblur="checkKyc('<?= $this->uri->segment(5); ?>','adhar_no',this.value)" required>
		</div>
		<div class="form-group col-md-4">
			<label>PAN Number</label>
			<input type="text" name="g_pan_no" class="form-control"  value="<?= $loanData['g_pan_no']; ?>" required onblur="checkKyc('<?= $this->uri->segment(5); ?>','pan_no',this.value)">
		</div>
		<div class="form-group col-md-12">
			<input type="hidden"  name="application_id" class="form-control" required value="<?= $this->uri->segment(5); ?>">
			<button type="button" id="submit_step" class="btn_new">Save & Next</button>
			<?= br(3); ?>
		</div>
	</div>
</form>
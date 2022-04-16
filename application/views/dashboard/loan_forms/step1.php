<?php if($this->uri->segment(5)): ?>
	<form action="<?= base_url('dashboard/Loan_application_submit/update_step1'); ?>" method="post">
<?php else: ?>
	<form action="<?= base_url('dashboard/Loan_application_submit/submit_step1'); ?>" method="post">
<?php endif; ?>
	<div class="row">
		<div class="form-group col-md-12 bg-grey">
			<h5>Loan Request Information</h5>
		</div>
		<div class="form-group col-md-4">
			<label>Effective Date</label>
			<input type="date" name="affective_date" class="form-control" value="<?= $loanData['affective_date']; ?>" required>
		</div>
		<div class="form-group col-md-4">
			<label>Type of Loan</label>
			<select id="loanType" onchange="check_downPay(this.value)" name="loan_type" class="form-control" required>
				<option value="">Select</option>
				<?php if(!empty($loan_type)): ?>
					<?php foreach($loan_type as $lt): ?>
						<?php if($loanData['loan_type']==$lt['type_slug']){$slct = "selected";}else{$slct="";} ?>
						<option <?= $slct; ?> value="<?= $lt['type_slug']; ?>"><?= $lt['type_name']; ?></option>
					<?php endforeach; ?>
				<?php endif; ?>
			</select>
		</div>
		<div id="dpay" class="form-group col-md-4 hide">
			<label>Down Payment</label>
			<select id="dpys" onchange="set_dPay(this.value)" class="form-control down_pay" name="down_pay">
				<?php if($loanData['down_pay']=="yes"){ $ck = "selected"; $ck2 = "";}else{$ck = "";$ck2="selected";} ?>
				<option value="">Select</option>
				<option <?= $ck; ?> value="yes">Yes</option>
				<option <?= $ck2; ?> value="no">No</option>
			</select>
		</div>
		<div id="dpAmt" class="form-group col-md-4 hide">
			<label>Down Payment Amount</label>
			<input type="text" name="down_pay_amt" class="form-control down_pay_amt" value="<?= $loanData['down_pay_amt']; ?>">
		</div>
		<div class="form-group col-md-4">
			<label>Requested Amount</label>
			<input type="text" name="request_amount" class="form-control" value="<?= $loanData['request_amount']; ?>">
		</div>
		<div class="form-group col-md-4">
			<label>EMI Period (Months)</label>
			<input type="number" name="emi_period" class="form-control" required  value="<?= $loanData['emi_period']; ?>">
		</div>
		<div class="form-group col-md-12">
			<?php if($this->uri->segment(5)): ?>
				<input type="hidden" name="application_id" value="<?= $this->uri->segment(5); ?>">
			<?php else: ?>
				<input type="hidden" name="application_id" value="<?= 'AP-'.date('y').'-'.mt_rand(00000000,99999999); ?>">
			<?php endif; ?>
			<input type="hidden" name="submitted_by" value="<?= $this->session->userdata('userAdmin'); ?>">
			<button class="btn_new">Save & Next</button>
		</div>
	</div>
</form>
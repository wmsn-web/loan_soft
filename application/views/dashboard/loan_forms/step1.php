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
			<input type="text" id="ra" name="request_amount" class="form-control" value="<?= $loanData['request_amount']; ?>">
		</div>
		<div class="form-group col-md-4">
			<label>EMI Period (Months)</label>
			<select id="pom" onchange="get_interest(this.value)" name="emi_period" class="form-control" required>
				<option value="">Select</option>
				<?php $loan_setup = loan_settings();?>
				<?php if(!empty($loan_setup)): ?>
					<?php foreach($loan_setup as $lsetup): ?>
						<?php if($loanData['emi_period'] == $lsetup['month_num']){$slct = "selected";}else{$slct = "";} ?>
						<option <?= $slct; ?> value="<?= $lsetup['month_num']; ?>"><?= $lsetup['month_num']; ?> Months </option>
					<?php endforeach; ?>
				<?php endif; ?>
			</select>
		</div>
		<div class="form-group col-md-4">
			<label>Rate of Interest (<span id="roi_lbl">%</span> / Annual)</label>
			<input type="text" id="roi" name="rate_of_interest" class="form-control" value="0" required>
		</div>
		<div class="form-group col-md-12">
			<?php if($this->uri->segment(5)): ?>
				<input type="hidden" name="application_id" value="<?= $this->uri->segment(5); ?>">
				<input type="hidden" name="updated_by" value="<?= $this->session->userdata('userAdmin'); ?>">
			<?php else: ?>
				<input type="hidden" name="application_id" value="<?= 'AP-'.date('y').'-'.mt_rand(00000000,99999999); ?>">
				<input type="hidden" name="submitted_by" value="<?= $this->session->userdata('userAdmin'); ?>">
			<?php endif; ?>
			
			<button class="btn_new">Save & Next</button>
			<button onclick="CalEmi()" type="button">Calculate</button>
		</div>

	</div>
</form>
<div id="calCulateDiv" style="display: none;">
	<div class="col-md-12 text-center">
		<div class="card">
			<div class="card-body">
				<div class="row justify-content-center">
					<div class="col-md-4">
						<table class="table table-bordered">
							<tr>
								<th>Principle Amount:</th>
								<td id="princ_amt"></td>
							</tr>
							<tr>
								<th>Rate of Interest:</th>
								<td id="intr_rate_amt"></td>
							</tr>
							<tr>
								<th>Interest per Month:</th>
								<td id="intr_amt"></td>
							</tr>
							<tr>
								<th>EMI Per Month:</th>
								<td id="emi_amt"></td>
							</tr>
							<tr>
								<th>Total Repayment Amount:</th>
								<td id="tot_amt"></td>
							</tr>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
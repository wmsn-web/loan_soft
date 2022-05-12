<?php if($this->uri->segment(5)): ?>
	<form  action="<?= base_url('dashboard/Loan_application_submit/update_step1'); ?>" method="post">
<?php else: ?>
	<form action="<?= base_url('dashboard/Loan_application_submit/submit_step1'); ?>" method="post">
<?php endif; ?>
	<div class="row">
		<div class="form-group col-md-12 bg-grey">
			<h5>Loan Request Information</h5>
		</div>
		<div class="form-group col-md-4">
			<label>Effective Date</label>
			<input type="date" name="affective_date" class="form-control" value="<?= @$loanData['affective_date']; ?>" required>
		</div>
		<div class="form-group col-md-4">
			<label>Type of Loan</label>
			<select id="loanType" onchange="check_downPay(this.value)" name="loan_type" class="form-control" required>
				<option value="">Select</option>
				<?php if(!empty($loan_type)): ?>
					<?php foreach($loan_type as $lt): ?>
						<?php if(@$loanData['loan_type']==$lt['type_slug']){$slct = "selected";}else{$slct="";} ?>
						<option <?= $slct; ?> value="<?= $lt['type_slug']; ?>"><?= $lt['type_name']; ?></option>
					<?php endforeach; ?>
				<?php endif; ?>
			</select>
		</div>
		<div id="dpay" class="form-group col-md-4 hide">
			<label>Down Payment</label>
			<select id="dpys" onchange="set_dPay(this.value)" class="form-control down_pay" name="down_pay">
				<?php if(@$loanData['down_pay']=="yes"){ $ck = "selected"; $ck2 = "";}else{$ck = "";$ck2="selected";} ?>
				<option value="">Select</option>
				<option <?= $ck; ?> value="yes">Yes</option>
				<option <?= $ck2; ?> value="no">No</option>
			</select>
		</div>
		<div id="dpAmt" class="form-group col-md-4 hide">
			<label>Down Payment Amount</label>
			<input type="text" name="down_pay_amt" class="form-control down_pay_amt" value="<?= @$loanData['down_pay_amt']; ?>">
		</div>
		<div class="form-group col-md-4">
			<label>Requested Amount</label>
			<input type="text" id="ra" name="request_amount" class="form-control" value="<?= @$loanData['request_amount']; ?>">
		</div>
		<div class="form-group col-md-4">
			<label>EMI Period (Months)</label>
			<select id="pom" onchange="get_interest(this.value)" name="emi_period" class="form-control" required>
				<option value="">Select</option>
				<?php $loan_setup = loan_settings();?>
				<?php if(!empty($loan_setup)): ?>
					<?php foreach($loan_setup as $lsetup): ?>
						<?php if(@$loanData['emi_period'] == $lsetup['month_num']){$slct = "selected";}else{$slct = "";} ?>
						<option <?= $slct; ?> value="<?= $lsetup['month_num']; ?>"><?= $lsetup['month_num']; ?> Months </option>
					<?php endforeach; ?>
				<?php endif; ?>
			</select>
		</div>
		<div class="form-group col-md-4">
			<label>Rate of Interest (<span id="roi_lbl">%</span> / Annual)</label>
			<input type="text" id="roi" name="rate_of_interest" class="form-control" value="<?= @$loanData['rate_of_interest']; ?>" required>
		</div>
		<div class="form-group col-md-4">
			<label>Select Agent</label>
			<select name="agent_code" class="form-control" value="0" required>
				<option value="">Select Agent</option>
				<?php $agents = get_agents(); ?>
				<?php if(!empty($agents)): ?>
					<?php foreach($agents as $key): ?>
						<?php if(@$loanData['agent_code']==$key['agent_code']){$slct = "selected";}else{$slct = "";} ?>
						<option <?= $slct; ?> value="<?= $key['agent_code']; ?>"><?= $key['agent_name']; ?></option>
					<?php endforeach; ?>
				<?php endif; ?>
			</select>
		</div>
	</div>
		<div id="products" class="row" style="display:block">
		<div class="form-group col-md-12 bg-grey">
			<h5>Product Information</h5>
		</div>
		<div class="col-md-12 form-group">
				<span class="text-danger"><em>Please Add Product details in case of Product Loan Or Pay later.</em></span>
			</div>
			<div class="form-group col-md-4">
				<label>Product Type</label>
				<input type="text" name="product_type" class="form-control hd_pro" value="<?= @$loanData['product_type']; ?>">
			</div>
			<div class="form-group col-md-4">
				<label>Product</label>
				<input type="text" name="product" class="form-control hd_pro" value="<?= @$loanData['product']; ?>">
			</div>
			<div class="form-group col-md-4">
				<label>Invoice ID</label>
				<input type="text" name="inv_id" class="form-control hd_pro" value="<?= @$loanData['inv_id']; ?>">
			</div>
			<div class="form-group col-md-4">
				<label>IEMI1 / IEMI2</label>
				<textarea name="iemis" class="form-control hd_pro"><?= @$loanData['iemis']; ?></textarea>
			</div>
			<div class="form-group col-md-4">
				<label>Serial Number</label>
				<input type="text" name="pro_serial" class="form-control hd_pro" value="<?= @$loanData['pro_serial']; ?>">
			</div>
		</div>
		<div id="business" class="row" style="display:block">
			<div class="form-group col-md-12 bg-grey">
				<h5>Business Information</h5>
			</div>
			<div class="form-group col-md-4">
				<label>Business / Company Name</label>
				<input type="text" name="business_name" class="form-control hd_bus" value="<?= @$loanData['business_name']; ?>">
			</div>
			<div class="form-group col-md-4">
				<label>Business / Company Type</label>
				<select name="company_type" class="form-control hd_bus">
					<option value="<?= @$loanData['company_type']; ?>"><?= @$loanData['company_type']; ?></option>
					<option value="">Select</option>
					<option value="Partnership">Partnership</option>
					<option value="LLP">LLP</option>
					<option value="Private Limited">Private Limited</option>
					<option value="Public Ltd">Public Ltd</option>
					<option value="HUF">HUF</option>
					<option value="Proprietorship">Proprietorship</option>
				</select>
			</div>
			<div class="form-group col-md-4">
				<label>Business Nature</label>
				<select name="business_nature" class="form-control hd_bus">
					<option value="<?= @$loanData['business_nature']; ?>"><?= @$loanData['business_nature']; ?></option>
					<option value="">Select</option>
					<option value="Agriculture and Allied Consultation">Agriculture & Allied Consultation</option>
					<option value="Manufacturing">Manufacturing</option>
					<option value="Retail Trading">Retail Trading</option>
					<option value="Wholesale Trading">Wholesale Trading</option>
					<option value="Service">Service</option>
				</select>
			</div>
			<div class="form-group col-md-4">
				<label>Date of Incorporation</label>
				<input type="date" name="date_incorporation" value="<?= @$loanData['date_incorporation']; ?>" class="form-control hd_bus">
			</div>
			<div class="form-group col-md-4">
				<label>Business PAN</label>
				<input type="text" name="business_pan" value="<?= @$loanData['business_pan']; ?>" class="form-control hd_bus">
			</div>
			<div class="form-group col-md-4">
				<label>Yearly Turnover</label>
				<input type="number" name="turnover" value="<?= @$loanData['turnover']; ?>" class="form-control hd_bus">
			</div>
			<div class="form-group col-md-12">
				<h5>Office Address</h5>
			</div>
			<div class="form-group col-md-4">
				<label>City</label>
				<input type="text" name="b_city" value="<?= @$loanData['b_city']; ?>" class="form-control hd_bus">
			</div>
			<div class="form-group col-md-4">
				<label>State</label>
				<input type="text" name="b_state" value="<?= @$loanData['b_state']; ?>" class="form-control hd_bus">
			</div>
			<div class="form-group col-md-4">
				<label>PIN</label>
				<input type="text" name="b_pin" value="<?= @$loanData['b_state']; ?>" class="form-control hd_bus">
			</div>
		</div>
		<div class="row" id="vehicals" style="display:none">
			<div class="form-group col-md-12 bg-grey">
				<h5>Information of vehical to be purchased</h5>
			</div>
			<div class="form-group col-md-4">
				<label>Maker and Model of Vehical</label>
				<input type="text" name="vehical_model" class="form-control hd_veh" value="<?= @$loanData['vehical_model']; ?>">
			</div>
			<div class="form-group col-md-4">
				<label>Dealer Name</label>
				<input type="text" name="dealer_name" class="form-control hd_veh" value="<?= @$loanData['dealer_name']; ?>">
			</div>
			<div class="form-group col-md-4">
				<label>Chassis Number</label>
				<input type="text" name="chassis_no" class="form-control hd_veh" value="<?= @$loanData['chassis_no']; ?>">
			</div>
			<div class="form-group col-md-4">
				<label>On Road Price of Vehical</label>
				<input type="text" name="vehical_price" class="form-control hd_veh" value="<?= @$loanData['vehical_price']; ?>">
			</div>
		</div>
		<div class="row">
		<div class="form-group col-md-12">
			<?php if($this->uri->segment(5)): ?>
				<input type="hidden" name="application_id" value="<?= $this->uri->segment(5); ?>">
				<input type="hidden" name="updated_by" value="<?= $this->session->userdata('userAdmin'); ?>">
			<?php else: ?>
				<input type="hidden" name="application_id" value="<?= 'AP-'.date('y').'-'.mt_rand(00000000,99999999); ?>">
				<input type="hidden" name="submitted_by" value="<?= $this->session->userdata('userAdmin'); ?>">
			<?php endif; ?>
			
			<button  class="btn_new">Save & Next</button>
			<!--button onclick="CalEmi()" type="button">Calculate</button-->
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
<?php if(@$loanData['status_code'] > 1 && $prof['role_slug']=="data-entry-operator"): ?>
	<script type="text/javascript">
		location.href = "<?= base_url('dashboard/Apply_loan/Submitted_accounts'); ?>";
	</script>
<?php endif; ?>
<?php if(@$parmsn->review_account==1 || $prof['role']=="Super_admin"): ?>
<?php $apl_id = $this->uri->segment(5); ?>
<form action="<?= base_url('dashboard/Loan_application_submit/update_step5'); ?>" method="post" data-parsley-validate novalidate>
	<h4>Application ID: <?= $this->uri->segment(5); ?></h4><?= br(2); ?>
	<input type="hidden" id="loanType" value="<?= $loanData['loan_type']; ?>">
	<div id="products" class="row">
		<div class="form-group col-md-12 bg-grey">
			<h5>Office Use</h5>
		</div>
		<?php if($loanData['loan_type']=="product-loan-emi" || $loanData['loan_type']=="product-loan-pay-later"): ?>
			<div class="col-md-12 form-group">
				<span class="text-danger"><em>Please Add Product details in case of Product Loan Or Pay later.</em></span>
			</div>
			<div class="form-group col-md-4">
				<label>Product Type</label>
				<input type="text" name="product_type" class="form-control" value="<?= $loanData['product_type']; ?>" required>
			</div>
			<div class="form-group col-md-4">
				<label>Product</label>
				<input type="text" name="product" class="form-control" value="<?= $loanData['product']; ?>" required>
			</div>
			<div class="form-group col-md-4">
				<label>Invoice ID</label>
				<input type="text" name="inv_id" class="form-control" value="<?= $loanData['inv_id']; ?>" required>
			</div>
			<div class="form-group col-md-4">
				<label>IEMI1 / IEMI2</label>
				<textarea name="iemis" class="form-control"><?= $loanData['iemis']; ?></textarea>
			</div>
			<div class="form-group col-md-4">
				<label>Serial Number</label>
				<input type="text" name="pro_serial" class="form-control" value="<?= $loanData['pro_serial']; ?>">
			</div>
			<div class="form-group col-md-4"></div>
		<?php endif; ?>
	</div>
		<div id="business" class="row" style="display:none">
			<div class="form-group col-md-12 bg-grey">
				<h5>Business Information</h5>
			</div>
			<div class="form-group col-md-4">
				<label>Business / Company Name</label>
				<input type="text" name="business_name" class="form-control" value="<?= $loanData['business_name']; ?>">
			</div>
			<div class="form-group col-md-4">
				<label>Business / Company Type</label>
				<select name="company_type" class="form-control">
					<option value="<?= $loanData['company_type']; ?>"><?= $loanData['company_type']; ?></option>
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
				<select name="business_nature" class="form-control">
					<option value="<?= $loanData['business_nature']; ?>"><?= $loanData['business_nature']; ?></option>
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
				<input type="date" name="date_incorporation" value="<?= $loanData['date_incorporation']; ?>" class="form-control">
			</div>
			<div class="form-group col-md-4">
				<label>Business PAN</label>
				<input type="text" name="business_pan" value="<?= $loanData['business_pan']; ?>" class="form-control">
			</div>
			<div class="form-group col-md-4">
				<label>Yearly Turnover</label>
				<input type="number" name="turnover" value="<?= $loanData['turnover']; ?>" class="form-control">
			</div>
			<div class="form-group col-md-12">
				<h5>Office Address</h5>
			</div>
			<div class="form-group col-md-4">
				<label>City</label>
				<input type="text" name="b_city" value="<?= $loanData['b_city']; ?>" class="form-control">
			</div>
			<div class="form-group col-md-4">
				<label>State</label>
				<input type="text" name="b_state" value="<?= $loanData['b_state']; ?>" class="form-control">
			</div>
			<div class="form-group col-md-4">
				<label>PIN</label>
				<input type="text" name="b_pin" value="<?= $loanData['b_state']; ?>" class="form-control">
			</div>
		</div>
		<div class="row" id="vehicals" style="display:none">
			<div class="form-group col-md-12 bg-grey">
				<h5>Information of vehical to be purchased</h5>
			</div>
			<div class="form-group col-md-4">
				<label>Maker and Model of Vehical</label>
				<input type="text" name="vehical_model" class="form-control hd_veh" value="<?= $loanData['vehical_model']; ?>">
			</div>
			<div class="form-group col-md-4">
				<label>Dealer Name</label>
				<input type="text" name="dealer_name" class="form-control hd_veh" value="<?= $loanData['dealer_name']; ?>">
			</div>
			<div class="form-group col-md-4">
				<label>Chassis Number</label>
				<input type="text" name="chassis_no" class="form-control hd_veh" value="<?= $loanData['chassis_no']; ?>">
			</div>
			<div class="form-group col-md-4">
				<label>On Road Price of Vehical</label>
				<input type="text" name="vehical_price" class="form-control hd_veh" value="<?= $loanData['vehical_price']; ?>">
			</div>
		</div>
		<div class="row">
		<div class="form-group col-md-3">
			<label>Approved Amount</label>
			<input type="text" name="approve_amount" value="<?= $loanData['approve_amount']; ?>" class="form-control" required>
		</div>
		<div class="form-group col-md-3">
			<label>Rate Of Interest</label>
			<input type="text" value="<?= $loanData['rate_of_interest']; ?>" class="form-control" readonly>
		</div>
		<div class="form-group col-md-3">
			<label>EMI Start Date</label>
			<input type="date" name="emi_start_date" class="form-control" value="<?= $loanData['emi_start_date']; ?>" required>
		</div>
		<div class="form-group col-md-3">
			<label>EMI End Date</label>
			<input type="date" name="emi_end_date" value="<?= $loanData['emi_end_date']; ?>" class="form-control" required>
		</div>
		<div class="form-group col-md-3">
			<label>Disbursed Amount</label>
			<input type="text" name="disburs_amount" value="<?= $loanData['disburs_amount']; ?>" class="form-control" required>
		</div>
		<div class="form-group col-md-12">
			<input type="hidden" name="application_id" value="<?= $apl_id; ?>">
			<button class="btn_new">Save</button>
		</div>
	</div>
</form>
<form id="final_doc_form" action="<?= base_url('dashboard/Loan_application_submit/final_documents_upload'); ?>" method="post" enctype="multipart/form-data">
	<h4>Upload Agreements and documents</h4>
	<div class="row">
		<?php $allDoc = all_final_docs($apl_id); ?>
		<?php if(!empty($allDoc)): ?>
			<?php foreach($allDoc as $docs): ?>
				<div id="dcs__<?= $docs['id']; ?>" class="col-md-3 mt-4">
					<span onclick="del_final_doc('<?= $docs['id']; ?>')" style="display:inline-block; float: right; cursor: pointer;">
						<i class="fas fa-times text-danger fa-2x"></i>
					</span>
					<div class="img_boxes">
						<img src="<?= base_url('uploads/'.$appl_id.'/'.$docs['docs']); ?>" >
					</div>
				</div>
			<?php endforeach; ?>
		<?php endif; ?>
		<div class="form-group col-md-3 text-center  mt-4">
			<div class="upl_box">
				<label class="uplDocs" for="upl">
					<i class="fas fa-file-upload fa-4x"></i><br>
					Upload Here
				</label>
				<input type="file" onchange="final_doc_upload()" name="docs" id="upl" style="display:none">
				<input type="hidden" name="application_id" value="<?= $apl_id; ?>">
			</div>
		</div>
	</div>
</form>
<?php endif; ?>
<div class="row">
	<div class="col-md-12 text-right">
		<?php if(@$parmsn->review_account==1 || $prof['role']=="Super_admin"): ?>
				<a href="<?= base_url('dashboard/Apply_loan/reject_loan/'.$this->uri->segment(5)); ?>">
					<button class="btn btn-danger">Reject Application</button>
				</a>
		<?php endif; ?>
		<?php if($loanData['step']=='6'): ?>
			<?php if($loanData['loan_status']=="under-review"): ?>
				<?php if(@$parmsn->review_account==1 || $prof['role']=="Super_admin"): ?>
					<a href="<?= base_url('dashboard/Apply_loan/approve_loan/'.$this->uri->segment(5)); ?>">
						<button class="btn btn-success">Approve Application</button>
					</a>
				<?php endif; ?>
			<?php elseif($loanData['loan_status']=="approved"): ?>
				<?php if(@$parmsn->disburs_loan==1 || $prof['role']=="Super_admin"): ?>
					<a href="<?= base_url('dashboard/Apply_loan/disburs_loan/'.$this->uri->segment(5)); ?>">
						<button class="btn btn-success">Disburs Loan</button>
					</a>
				<?php endif; ?>
			<?php elseif($loanData['loan_status']=="rejected" && $prof['role']=="Super_admin"): ?>
				<a href="<?= base_url('dashboard/Apply_loan/approve_loan/'.$this->uri->segment(5)); ?>">
						<button class="btn btn-success">Approve Application</button>
					</a>
			<?php endif; ?>
		<?php endif; ?>
		<?= br(5); ?>
	</div>
</div>
<?php if($loanData['status_code'] > 1 && $prof['role_slug']=="data-entry-operator"): ?>
	<script type="text/javascript">
		location.href = "<?= base_url('dashboard/Apply_loan/Submitted_accounts'); ?>";
	</script>
<?php endif; ?>
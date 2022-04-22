<?php if(@$parmsn->review_account==1 || $prof['role']=="Super_admin"): ?>
<?php $apl_id = $this->uri->segment(5); ?>
<form action="<?= base_url('dashboard/Loan_application_submit/update_step5'); ?>" method="post" data-parsley-validate novalidate>
	<h4>Application ID: <?= $this->uri->segment(5); ?></h4><?= br(2); ?>
	<div class="row">
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
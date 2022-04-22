<form action="<?= base_url('dashboard/Loan_application_submit/upload_docs'); ?>" method="post" enctype="multipart/form-data">
	<?php $get_docs = $this->LoanApplicationModel->get_docs($this->uri->segment(5)); ?>
	<div class="row">
		<?php if(!empty($get_docs)): ?>
			<?php foreach($get_docs as $docs): ?>
				<div onclick="show_docs('<?= $docs['doc_img']; ?>','<?= $this->uri->segment(5); ?>')" class="col-md-3 text-center">
					<img src="<?= base_url('uploads/'.$this->uri->segment(5).'/'.$docs['doc_img']); ?>" class="img-responsive" /><br>
					<b><?= $docs['doc_name']; ?></b><br>
					<button onclick="del_docs('<?= $docs['id']; ?>')" type="button" class="btn btn-danger btn-sm">Delete</button>
				</div>
			<?php endforeach; ?>
		<?php endif; ?>
		<div class="col-md-3">
			<div class="form-group">
				<input type="text" name="doc_name" placeholder="Document Name" class="form-control" required>
			</div>
			<div class="form-group">
				<label class="upl_pic" for="uplPic">
					<img src="<?= base_url('assets/img/docs2.png'); ?>" id="blahImg" class="img-responsive" />
					<input type="file" name="doc_img" class="hide" id="uplPic"onchange="document.getElementById('blahImg').src = window.URL.createObjectURL(this.files[0])">
				</label>
			</div>
			<div class="form-group text-center">
				<input type="hidden" name="application_id" value="<?= $this->uri->segment(5); ?>">
				<button class="btn_new"><i class="fas fa-upload"></i> Upload</button>
			</div>
		</div>
	</div>
</form>
<div class="row">
	<div class="col-md-12">
		<?php if($loanData['loan_status']=="pending"): ?>
			<a href="<?= base_url('dashboard/Apply_loan/Submitted_accounts'); ?>">
				<button class="btn_new">Submit</button>
			</a>
			<a href="<?= base_url('dashboard/Apply_loan/submit_to_review/'.$this->uri->segment(5)); ?>">
			<button class="btn_new">Submit to Review</button></a>
		<?php endif; ?>
		<?php if(@$parmsn->review_account ==1 || $prof['role'] == "Super_admin"): ?>
			<a href="<?= base_url('dashboard/Apply_loan/create_account/step5/'.$this->uri->segment(5)); ?>">
				<button class="btn_new">Go to Office use</button>
			</a>
		<?php endif; ?>
	</div>
</div>
<?php if($loanData['status_code'] > 1 && $prof['role_slug']=="data-entry-operator"): ?>
	<script type="text/javascript">
		location.href = "<?= base_url('dashboard/Apply_loan/Submitted_accounts'); ?>";
	</script>
<?php endif; ?>
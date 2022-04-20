<ul>
	<?php $uri3 = $this->uri->segment(3); ?>
	<?php if(@$parmsn->create_account ==1 || $prof['role'] == "Super_admin"): ?>
		<?php if($uri3 == "create_account"){$act = "active";}else{$act = "";} ?>
		<li><a class="<?= $act; ?>" href="<?= base_url('dashboard/Apply_loan/create_account/step1'); ?>">Create Account</a></li>
	<?php endif; ?>
	<?php if(@$parmsn->create_account ==1 || $prof['role'] == "Super_admin" || @$parmsn->review_account ==1): ?>
		<?php if($uri3 == "Submitted_accounts"){$act = "active";}else{$act = "";} ?>
		<li><a href="<?= base_url('dashboard/Apply_loan/Submitted_accounts'); ?>" class="<?= $act; ?>">Submitted accounts</a></li>
	<?php endif; ?>
	<?php if(@$parmsn->review_account ==1 || $prof['role'] == "Super_admin"): ?>
		<?php if($uri3 == "review_account"){$act = "active";}else{$act = "";} ?>
		<li><a class="<?= $act; ?>" href="<?= base_url('dashboard/Apply_loan/review_account/'); ?>">Review Account</a></li>
	<?php endif; ?>
	
</ul>
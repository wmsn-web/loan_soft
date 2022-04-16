<div class="footer">
	Developed By WMSN
</div>
<?php if($err= $this->session->flashdata("err")): ?>
	<div class="flasgd-danger"><?= $err; ?></div>
<?php endif; ?>
<?php if($feed= $this->session->flashdata("Feed")): ?>
	<div class="flasgd-success"><?= $feed; ?></div>
<?php endif; ?>
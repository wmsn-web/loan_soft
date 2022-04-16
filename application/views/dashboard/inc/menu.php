<?php $prof = $this->UserModel->get_profiles($this->session->userdata("userAdmin")); ?>
<?php $parmsn = json_decode($prof['permissions']); ?>
<div class="side_menu">
	<div class="prof">
			<h3><?= $prof['user_admin']; ?></h3>
			<span><?= $prof['role']; ?></span>
		</div>
	<div class="side_nav">
		
		<ul>
			<li><a href="<?= base_url(); ?>"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
			<?php if(@$parmsn->create_account ==1 || $prof['role'] == "Super_admin"): ?>
				<li>Loan</li>
				
				<li><a data-toggle="dropdown" id="dropdownMenu1" class="dropdown"data-toggle="dropdown dropdown-toggle" aria-haspopup="true" aria-expanded="false" href="#"><i class="fas fa-users"></i> Apply Loan <i class="fas fa-chevron-down"></i></a>
					<ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
						<li class="">
							<a href="<?= base_url('dashboard/Apply_loan/create_account/step1'); ?>"><i class="fas fa-compact-disc"></i> Create Account</a>
						</li>
						<li class=""><a href="<?= base_url('dashboard/Apply_loan/Submitted_accounts'); ?>">
							<i class="fas fa-compact-disc"></i> Submitted Accounts</a>
						</li>
					</ul>
				</li>
			<?php endif; ?>
			<?php if(@$parmsn->review_account ==1 || $prof['role'] == "Super_admin"): ?>
				<li>Administration</li>
				<li><a href=""><i class="fas fa-address-card"></i> View Loans</a></li>
			<?php endif; ?>
			<?php if(@$parmsn->user_manage =='1' || $prof['role'] == "Super_admin"): ?>
				<li>Users</li>
				<li><a data-toggle="dropdown" id="dropdownMenu2" class="dropdown"data-toggle="dropdown dropdown-toggle" aria-haspopup="true" aria-expanded="false" href="#"><i class="fas fa-users"></i> Users <i class="fas fa-chevron-down"></i></a>
					<ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
						<li class="">
							<a href="<?= base_url('dashboard/Add_user'); ?>"><i class="fas fa-compact-disc"></i> Add User</a>
						</li>
						<li class=""><a href="<?= base_url('dashboard/All_user'); ?>">
							<i class="fas fa-compact-disc"></i> View Users</a>
						</li>
					</ul>
				</li>
			<?php endif; ?>
			
		</ul>
	</div>
</div>
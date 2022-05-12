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
			<li><a href="<?= base_url('dashboard/Calculator'); ?>"><i class="fas fa-calculator"></i> EMI Calculation</a></li>
			<?php if(@$parmsn->create_account ==1 || $prof['role'] == "Super_admin" || @$parmsn->review_account ==1 ): ?>
				<li>Loan</li>
				
				<li><a data-toggle="dropdown" id="dropdownMenu1" class="dropdown"data-toggle="dropdown dropdown-toggle" aria-haspopup="true" aria-expanded="false" href="#"><i class="fas fa-rupee-sign"></i> Loan Accounts <i class="fas fa-chevron-down"></i></a>
					<ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
						<?php if(@$parmsn->create_account ==1 || $prof['role'] == "Super_admin"): ?>
						<li class="">
							<a href="<?= base_url('dashboard/Apply_loan/create_account/step1'); ?>"><i class="fas fa-compact-disc"></i> Create Account</a>
						</li>
						<?php endif; ?>
						<li class=""><a href="<?= base_url('dashboard/Apply_loan/Submitted_accounts'); ?>">
							<i class="fas fa-compact-disc"></i> Submitted Accounts</a>
						</li>
					</ul>
				</li>
			<?php endif; ?>
			<?php if(@$parmsn->manage_repayment ==1 || $prof['role'] == "Super_admin"): ?>
				<li>Loan Repayments</li>
				<li><a href="<?= base_url('dashboard/View_loans'); ?>"><i class="fas fa-address-card"></i> View Loans</a></li>
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
			<?php if(@$parmsn->create_account ==1 || $prof['role'] == "Super_admin" || @$parmsn->review_account ==1 || @$parmsn->user_manage == '1' ): ?>
				<li><a data-toggle="dropdown" id="dropdownMenu2" class="dropdown"data-toggle="dropdown dropdown-toggle" aria-haspopup="true" aria-expanded="false" href="#"><i class="fas fa-users"></i> Customer Accounts <i class="fas fa-chevron-down"></i></a>
					<ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
						<li class="">
							<a href="<?= base_url('dashboard/Add_customer'); ?>"><i class="fas fa-compact-disc"></i> Add Customer</a>
						</li>
						<li class=""><a href="<?= base_url('dashboard/All_customers'); ?>">
							<i class="fas fa-compact-disc"></i> View Customers</a>
						</li>
					</ul>
				</li>
			<?php endif; ?>
			<?php if($prof['role'] == "Super_admin"): ?>
				<li><a href="<?= base_url('dashboard/Agents'); ?>"><i class="fas fa-address-card"></i> Agents</a></li>
				<li><a href="<?= base_url('dashboard/Investors'); ?>"><i class="fas fa-piggy-bank"></i> Investors</a></li>
			<?php endif; ?>
			<?php if($prof['role'] == "Super_admin" || $prof['role_slug'] == "manager"): ?>
				<li>Acconts</li>
				<li><a href="<?= base_url('dashboard/Fund'); ?>"><i class="fas fa-piggy-bank"></i> Fund</a></li>
				<li><a href="<?= base_url('dashboard/Transactions'); ?>"><i class="fas fa-exchange-alt"></i> A/c Transaction</a></li>
			<?php endif; ?>
			<?php if($prof['role'] == "Super_admin"): ?>
				<li>Settings</li>
				<li class=""><a data-toggle="dropdown" id="dropdownMenu3" class="dropdown"data-toggle="dropdown dropdown-toggle" aria-haspopup="true" aria-expanded="true" href="#"><i class="fas fa-cog"></i> Settings <i class="fas fa-chevron-down"></i></a>
					<ul class="dropdown-menu" aria-labelledby="dropdownMenu3">
						<li>
							<a href="<?= base_url('dashboard/App_settings'); ?>"><i class="fas fa-compact-disc"></i> App Setting</a>
						</li>
						<li>
							<a href="<?= base_url('dashboard/Loan_settings'); ?>"><i class="fas fa-compact-disc"></i> Loan settings</a>
						</li>
						
					</ul>
				</li>
			<?php endif; ?>
			
		</ul>
	</div>
</div>
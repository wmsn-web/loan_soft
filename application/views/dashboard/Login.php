<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Login</title>
	<?php $this->load->view("inc/layout"); ?>
</head>
<body>
	<div class="container-fluid">
		<div class="midle_content">
			<div class="row justify-content-center">
				<div class="col-md-4">
					<div class="card bg-dash">
						<div class="card-header">
							<h5 class="card-title">Login Dashboard</h5>
							<p class="text-danger">
								<?php if($err = $this->session->flashdata("err")): ?>
									<?= $err; ?>
								<?php endif; ?>
							</p>
						</div>
						<div class="card-body">
							<form action="<?= base_url('dashboard/Login/login_process'); ?>" method="post">
								<div class="form-group">
									<label>Username</label>
									<input type="text" name="user" class="form-control" autocomplete="off" />
								</div>
								<div class="form-group">
									<label>Password</label>
									<input type="password" name="pass" class="form-control" />
								</div>
								<div class="form-group text-center">
									<button class="btn_new btn_new_block">Login</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
					
		</div>
	</div>

<?php $this->load->view("inc/js");?>
</body>
</html>
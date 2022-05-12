<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
	<?php $this->load->view("inc/layout"); ?>
</head>
<body>
	<!--Top Bar-->
<?php include("inc/headers.php"); ?>
<!--Top Bar end-->
<div class="container-fluid">
	<div class="row">
		<?php include("inc/menu.php"); ?>
		<div class="main_content">
			<div class="row">
				<div class="col-md-4">
					<div class="card">
						<div class="card-header">
							<h4 class="card-title">Add Investor</h4>
						</div>
						<div class="card-body">
							<form action="<?= base_url('dashboard/Investors/save_investor'); ?>" method="post">
								<div class="form-group">
									<label>Investor Name</label>
									<input type="text" name="investor_name" class="form-control" required>
								</div>
								<div class="form-group">
									<label>Mobile Number</label>
									<input type="text" name="mobile" class="form-control" required>
								</div>
								<div class="form-group">
									<label>Email</label>
									<input type="text" name="email" class="form-control" required>
								</div>
								<div class="form-group">
									<button class="btn_new btn_new_block">Save</button>
								</div>
							</form>
						</div>
					</div>
				</div>
				<?php
					$this->db->select_sum("wallet_balance");
					$gets = $this->db->get("investors")->row();
					$totBal = $gets->wallet_balance;
				?>
				<div class="col-md-8">
					<div class="card">
						<div class="card-header">
							<h4 class="card-title">All Investor</h4>
							<b class="text-danger">Total Investor Credit: &#8377;<?= number_format($totBal); ?></b>
						</div>

						<div class="card-body">
							<div class="table-responsive">
								<table class="table table-bordered" id="example2">
									<thead>
										<tr>
											<th>SL</th>
											<th>Investor Name</th>
											<th>Email</th>
											<th>Mobile</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										<?php if(!empty($data)): ?>
											<?php $s = 1; foreach($data as $key): $sl = $s++ ?>
												<tr>
													<td><?= $sl; ?></td>
													<td><?= $key['investor_name']; ?><br>
														<span class="text-danger"><em>Cr: <?= number_format($key['wallet_balance']); ?></em></span>
													</td>
													<td><?= $key['email']; ?></td>
													<td><?= $key['mobile']; ?></td>
													<td>
														<button onclick="edit_investor('<?= $key['id']; ?>')" class="btn btn-warning btn-sm">Edit</button>
														<button onclick="delete_investor('<?= $key['id']; ?>')" class="btn btn-danger btn-sm">delete</button>
													</td>
												</tr>
											<?php endforeach; ?>
										<?php endif; ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php include("inc/footer.php"); ?>
<?php include("inc/investor_modal.php"); ?>
<?php $this->load->view("inc/js");?>
<script type="text/javascript">
	function edit_investor(id)
	{
		$.post("<?= base_url('dashboard/AjaxController/get_investor_by_id'); ?>",{
			id: id
		},function(resp){
			var obj = JSON.parse(resp);
			$("#investor_name").val(obj.investor_name);
			$("#email").val(obj.email);
			$("#mobile").val(obj.mobile);
			$("#ids").val(obj.id);
			$("#edtModal").modal('show');
		})
	}
	function delete_investor(ids)
	{
		var res = confirm("Are you sure to delete this Investor? Please Click OK to Proceed");
		if(res == true)
		{
			location.href = "<?= base_url('dashboard/Investors/deleteInvestor/'); ?>"+ids;
		}
	}
</script>
</body>
</html>
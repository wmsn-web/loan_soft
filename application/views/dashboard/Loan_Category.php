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
				<div class="col-md-12">
					<a href="<?= base_url('dashboard/Emi_state'); ?>"><button class="btn_new">EMI Tenure</button></a>
					<a href="<?= base_url('dashboard/Loan_settings'); ?>"><button class="btn_new">Loan Settings</button></a>
					<a href="<?= base_url('dashboard/Loan_Category'); ?>"><button class="btn_new">Loan Category</button></a>
				</div>
				<div class="col-md-4">
					<div class="card">
						<div class="card-header">
							<h5>Add Category</h5>
						</div>
						<div class="card-body">
							<form action="<?= base_url('dashboard/Loan_Category/add_categories'); ?>" method="post">
								<div class="form-group">
									<label>Category Name</label>
									<input type="text" name="type_name" class="form-control" required>
								</div>
								<div class="form-group">
									<label>Select Type</label>
									<select class="form-control" name="loan_cat" required>
										<option value="">Select</option>
										<option value="product_mobile">Product/Mobile</option>
										<option value="business">Business</option>
										<option value="personal">Personal</option>
										<option value="vehical">Vehical</option>
									</select>
								</div>
								<div class="form-group">
									<label>Down Payment</label>
									<select name="down_payment" class="form-control" required>
										<option value="enable">Enable</option>
										<option value="disabled">Disable</option>
									</select>
								</div>
								<div class="form-group">
									<button class="btn_new">Save</button>
								</div>
							</form>
						</div>
					</div>
				</div>
				<div class="col-md-8">
					<div class="card">
						<div class="card-body">
							<h5>Loan Categories</h5>
							<div class="table-responsive">
								<table class="table table-bordered" id="example2">
									<thead>
										<tr>
											<th>SL</th>
											<th>Loan Category/Type</th>
											<th>Down payment</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										<?php if(!empty($loan_setup)): ?>
											<?php $s = 1; foreach($loan_setup as $lsetup): $sl = $s++; ?>
												<tr>
													<td><?= $sl; ?></td>
													<td><?= $lsetup['type_name']; ?><br>
														<small><em class="text-info"><?= $lsetup['loan_cat']; ?></em></small>
													</td>
													<td><?= unslugify($lsetup['down_payment']); ?></td>
													
													<td>
														<button onclick="editCats('<?= $lsetup['id']; ?>')" class="btn btn-warning btn-sm">Edit</button>
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
<?php include("inc/modals.php"); ?>
<?php $this->load->view("inc/js");?>
<script type="text/javascript">
	function editCats(ids)
	{
		$.get("<?= base_url('dashboard/AjaxController/get_loantype_id/'); ?>"+ids,function(data){
			var obj = JSON.parse(data);
			$("#LnType").val(obj.type_name);
			$("#LnCat").val(obj.loan_cat);
			$("#dnPay").val(obj.down_payment);
		})
		$("#loanCatId").val(ids);
		$("#edtCatys").modal('show');
	}
</script>
</body>
</html>
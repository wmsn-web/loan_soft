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
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-12">
						<div class="card">
							<div class="card-header">
								<h4 class="card-title">Open Loans</h4>
							</div>
							<div class="card-body">
								<a href="<?= base_url('dashboard/view_loans'); ?>">
									<button class="btn_new">Open Loans</button>
								</a>
								<a href="<?= base_url('dashboard/view_loans/closed_loans'); ?>">
									<button class="btn_new">Closed Loans</button>
								</a>
								<?= br(2); ?>
								<div class="table-responsive">
									<table class="table table-bordered" id="example2">
										<thead>
											<tr>
												<th>SL</th>
												<th>Loan A/c</th>
												<th>Name</th>
												<th>Sanction Amount</th>
												<th>Status</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody>
											<?php if(!empty($data)): ?>
												<?php $s = 1; foreach($data as $key): $sl = $s++; ?>
												<?php $gtadmin = $this->UserModel->get_profiles($key['submitted_by']); ?>
													<tr>
														<td><?= $sl; ?></td>
														
														<td><?= $key['loan_ac_no']; ?></td>
														<td><?= $key['full_name']; ?></td>
														<td><?= $key['approve_amount']; ?></td>
														<td><?= unslugify($key['closing_status']); ?></td>
														<td>
															<a onclick="getFullLoan('<?= $key['id']; ?>')" href="#">View Details</a>
															<?= nbs(5); ?>
															<a href="<?= base_url('dashboard/TestEmi/index/'.$key['id']); ?>">Repayments</a>
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
</div>
<?php include("inc/footer.php"); ?>
<?php include("inc/full_loan_modal.php"); ?>
<?php $this->load->view("inc/js");?>
<script type="text/javascript">
	//$("#loanModal").modal('show');
	function getFullLoan(id)
	{
		$.post("<?= base_url('dashboard/LoanAjax/view_loans'); ?>",{
			id: id
		},function(resp){
			$("#doccs").html(resp);
			$("#loanModal").modal('show');
		})
		
	}

	function lf_show()
	{
		$("#lf").show();
		$("#gu").hide();
	}
	function gu_show()
	{
		$("#lf").hide();
		$("#gu").show();
	}
	function all_show()
	{
		$("#lf").show();
		$("#gu").show();
	}
	function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
}
</script>
</body>
</html>
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
					<div class="col-md-3">
						<div class="card">
							<div class="card-header">
								<h4 class="card-title">
									Add Fund
								</h4>
							</div>
							<div class="card-body">
								<form action="<?= base_url('dashboard/Fund/add_fund'); ?>" method="post">
									<div class="form-group">
										<label>Amount</label>
										<input type="text" name="amount" class="form-control" required>
									</div>
									<div class="form-group">
										<label>Invested By</label>
										<select name="inv_by" class="form-control">
											<option value="self">Self</option>
											<?php if(!empty($investors)): ?>
												<?php foreach($investors as $invs): ?>
													<option value="<?= $invs['id']; ?>"><?= $invs['investor_name']; ?></option>
												<?php endforeach; ?>
											<?php endif; ?>
										</select>
									</div>
									<div class="form-group">
										<label>Notes</label>
										<textarea name="notes" class="form-control" required></textarea>
									</div>
									<div class="form-group">
										<button class="btn_new">Add Amount</button>
									</div>
								</form>
							</div>
						</div>
					</div>
					<div class="col-md-9">
						<div class="card">
							<div class="card-header">
								<h4 class="card-title">Account Transactions</h4>
								<span style="display:inline-block; float:right; font-size: 18px;">Fund Balance: <b>&#8377; <?= number_format($fundBal,2); ?></b></span>
							</div>
							<div class="card-body">
								<div class="table-responsive">
									<table class="table table-bordered" id="example">
										<thead>
											<tr>
												<th>SL</th>
												<th>Date</th>
												<th>Notes</th>
												<th>Debit</th>
												<th>Credit</th>
											</tr>
										</thead>
										<tbody>
											<?php if(!empty($data)): ?>
												<?php $s = 1; foreach($data as $key): $sl = $s++; ?>
												<?php $dt = date_create($key['dates']); ?>
												<?php if($key['investor']==null)
												{
													$notess = "";
												}
												elseif($key['investor']=="self")
												{
													$notess = "Invested By Self";
												}
												else
												{
													$getInvestor = $this->InvestorModel->get_investorBYId($key['investor']);
													$notess = "Invested By ".$getInvestor['investor_name'];
												} ?>
													<tr>
														<td><?= $sl; ?></td>
														<td><?= date_format($dt, 'd-m-Y'); ?></td>
														<td>
															<?= html_entity_decode($key['notes']); ?><br><b class="text-info"><?= $notess; ?></b>
														</td>
														<td>&#8377;<?= $key['in_amt']; ?></td>
														<td>&#8377;<?= $key['out_amt']; ?></td>
													</tr>
												<?php endforeach ?>
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
<?php $this->load->view("inc/js");?>
<script type="text/javascript">
	
</script>
</body>
</html>
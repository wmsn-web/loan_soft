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
					<div class="col-md-6">
						<div class="row">
							<div class="form-group col-md-12 bg-grey">
								<h5>EMI Calculation</h5>
							</div>
							<div class="form-group col-md-12">
								<label>Requested Amount</label>
								<input type="text" id="ra" name="request_amount" class="form-control" value="0">
							</div>
							<div class="form-group col-md-12">
								<label>EMI Period (Months)</label>
								<select id="pom" onchange="get_interest(this.value)" name="emi_period" class="form-control" required>
									<option value="">Select</option>
									<?php $loan_setup = loan_settings();?>
									<?php if(!empty($loan_setup)): ?>
										<?php foreach($loan_setup as $lsetup): ?>
											
											<option  value="<?= $lsetup['month_num']; ?>"><?= $lsetup['month_num']; ?> Months </option>
										<?php endforeach; ?>
									<?php endif; ?>
								</select>
							</div>
							<div class="form-group col-md-12">
								<label>Rate of Interest (<span id="roi_lbl">%</span> / Annual)</label>
								<input type="text" id="roi" name="rate_of_interest" class="form-control" value="0" required>
							</div>
							<div class="col-md-12">
								<button onclick="CalEmi()" type="button">Calculate</button>
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div id="calCulateDiv" style="display: block;">
							<div class="col-md-12 text-center">
								<div class="card">
									<div class="card-body">
										<div class="row justify-content-center">
											<div class="col-md-18">
												<table class="table table-bordered">
													<tr>
														<th>Principle Amount:</th>
														<td id="princ_amt">0</td>
													</tr>
													<tr>
														<th>Rate of Interest:</th>
														<td id="intr_rate_amt">0</td>
													</tr>
													<tr>
														<th>Interest per Month:</th>
														<td id="intr_amt">0</td>
													</tr>
													<tr>
														<th>EMI Per Month:</th>
														<td id="emi_amt">0</td>
													</tr>
													<tr>
														<th>Total Repayment Amount:</th>
														<td id="tot_amt">0</td>
													</tr>
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
			</div>
		</div>
	</div>

<?php include("inc/footer.php"); ?>
<?php $this->load->view("inc/js");?>
<script type="text/javascript">
	function CalEmi()
	{
		var ra = $("#ra").val();
		var pom = $("#pom").val();
		var roi = $("#roi").val();

		$.post("<?= base_url('dashboard/AjaxController/calculate_estimate_emi/'); ?>",{
			ra: ra,
			pom: pom,
			roi: roi
		},function(resp){
			obj = JSON.parse(resp);
			$("#princ_amt").html("&#8377;"+ra);
			$("#intr_rate_amt").html(roi+"%");
			$("#intr_amt").html("&#8377;"+obj.intr_month+"/Month");
			$("#emi_amt").html("&#8377;"+obj.emi+"/Month");
			$("#tot_amt").html("&#8377;"+obj.totAmt);
			$("#calCulateDiv").show();
		})
	}
</script>
</body>
</html>
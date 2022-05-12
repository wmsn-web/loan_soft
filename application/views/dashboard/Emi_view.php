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
<?php $lnSetup = loan_setup(); ?>
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
								<h4 class="card-title">Loan A/c: <?= $this->uri->segment(4); ?></h4>
								<h5>Schedule EMIs</h5>
							</div>
							<div class="card-body">
								<?php $chkLstatus = $this->LoanApplicationModel->check_loan_closing_status($this->uri->segment(4)); ?>
								<?php if($chkLstatus['closing_status']=="open" || $chkLstatus['closing_status']=="closed"): ?>
								<?php if($chkLstatus['closing_status']=="open"): ?>
									<button class="btn_new">Loan Settlement</button>
									<button onclick="set_forclose('<?= $this->uri->segment(4); ?>')" class="btn_new">Forclose</button>
								<?php endif; ?>
								<div class="table-responsive">
									<table class="table table-striped table-bordered">
										<thead>
											<tr>
												<th>SL</th>
									            <th>Payment Date</th>
									            <th>Monthly EMI</th>
									            <th>Interest Paid</th>
									            <th>Principal Paid</th>
									            <th>Extra Charges</th>
									            <th>Balance</th>
									            <th>Action</th>
											</tr>
										</thead>
										<tbody>
											<?php if(!empty($data)): ?>
												<?php $s = 1; foreach($data as $key): $sl = $s++; ?>
												<?php $dt = date_create($key['payment_date']); ?>
												<?php $totPay = $key['monthly_emi']+$key['extra_chgs']; ?>
													<tr>
														<td><?= $sl; ?></td>
														<td><?= date_format($dt, 'd-m-Y') ?></td>
														<td>
															<?= "&#8377;".number_format($key['monthly_emi'],2); ?>
														</td>
														<td>
															<?= "&#8377;".number_format($key['intr_pay'],2); ?>
														</td>
														<td>
															<?= "&#8377;".number_format($key['principal_pay'],2); ?>
														</td>
														<td>
															<?= "&#8377;".number_format($key['extra_chgs'],2); ?>
														</td>
														<td>
															<?= "&#8377;".number_format($key['balance'],2); ?>
														</td>
														<td>
															<?php if($key['status']=="unpaid"): ?>
															<button onclick="payEmi('<?= $totPay; ?>','<?= $key['id']; ?>')" class="btn btn-success btn-sm">Pay &#8377; <?= $totPay; ?>.00</a>
															<?php else: ?>
															<span class="text-success">Paid</span><br>
															<span class="text-info">
															<?= oblics($key['pay_method']); ?><br>
															<?= $key['tr_no']; ?></span>
															<?php endif; ?>
														</td>
													</tr>
												<?php endforeach; ?>
											<?php endif; ?>
										</tbody>
									</table>
								</div>
							<?php elseif($chkLstatus['closing_status']=="forclose"): ?>
								<?php $fcloseData = $this->LoanApplicationModel->get_forclose_data($this->uri->segment(4)); ?>
								<div class="row justify-content-center">
									<div class="col-md-5">
										<h4 class="text-center text-success"><b>Account Forclosed</b></h4>
										<table class="tbl_new">
						                    <tr>
						                        <th>Loan A/c</th>
						                        <td><?= $fcloseData['loan_no']; ?></td>
						                    </tr>
						                    <tr>
						                        <th>Loan Sanction Amount</th>
						                        <td>&#8377;<?= number_format($fcloseData['approve_amount'],2); ?></td>
						                    </tr>
						                    <tr>
						                        <th>Paid Amount</th>
						                        <td>&#8377;<?= number_format($fcloseData['emi_paid'],2); ?></td>
						                    </tr>
						                    <tr>
						                        <th>Remain Balance</th>
						                        <td>&#8377;<?= number_format($fcloseData['remain_bal'],2); ?></td>
						                    </tr>
						                    <tr>
						                        <th>Forcolsure Charge </th>
						                        <td>&#8377;<?= number_format($fcloseData['forclose_charge'],2); ?></td>
						                    </tr>
						                    <tr>
						                        <th>Forclosure Amount</th>
						                        <td>&#8377;<?= number_format($fcloseData['amount'],2); ?></td>
						                    </tr>
						                    <tr>
						                        <th>Payment Date</th>
						                        <td><?= $fcloseData['dates']; ?></td>
						                    </tr>
						                </table>
									</div>
								</div>
							<?php else: ?>
							<?php endif; ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php include("inc/footer.php"); ?>
<?php include("inc/emi_modal.php"); ?>
<?php $this->load->view("inc/js");?>
<script type="text/javascript">
	function set_forclose(id)
	{
		$.post("<?= base_url('dashboard/AjaxController/get_emi_forclosure'); ?>",{
			loan_no: id
		},function(resp){
			if(resp == "unpaid")
			{
				alert("No EMIs Paid Before.Foreclosure applicable after 1 EMI paid successfully.");
			}
			else
			{
				var obj = JSON.parse(resp);
				$("#loanAc").html(obj.loan_ac);
				$("#loanAmt").html("&#8377;"+obj.sanctionAmt+".00");
				$("#paidAmt").html("&#8377;"+obj.paidAmt+".00");
				$("#bal").html("&#8377;"+obj.remain+".00");
				$("#fCharge").html("&#8377;"+obj.fCharge+".00");
				$("#fAmount").html("&#8377;"+obj.fAmount+".00");
				$("#lnAcNo").val(obj.loan_ac);
				$("#emiModal").modal('show');
			}
		})
		//$("#emiModal").modal('show');
	}
	function payEmi(vals,id)
	{
		/*
		var res = confirm("Confirm payment of "+vals);
		if(res == true)
		{
			location.href="<?= base_url('dashboard/View_loans/payEmi/'); ?>"+id;
		}
		*/
		var vl = Number(vals).toFixed(2);
		$("#EmiAmts").html(vl);
		$("#emiId").val(id);
		$("#payEmiModal").modal('show');
	}
	function setForcloseLoan()
	{
		$("#loaderFclose").show();
		$("#setFcloseBtn").hide();
		var id = $("#lnAcNo").val();
		var res = confirm("Are you sure? Forclose this loan ? Please Click OK to Proceed.");
		if(res == true)
		{
			$.post("<?= base_url('dashboard/AjaxController/set_loan_emi_forclosure'); ?>",{
			loan_no: id
		},function(resp){
			if(resp == "succ")
			{
				location.href = "";
			}
		})
		}
		else
		{
			$("#loaderFclose").hide();
			$("#setFcloseBtn").show();
		}

	}
</script>
</body>
</html>
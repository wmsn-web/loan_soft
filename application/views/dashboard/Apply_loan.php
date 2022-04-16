<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Apply Loan</title>
	<?php $this->load->view("inc/layout"); ?>
</head>
<body>
	<?php include("inc/topbar.php"); ?>
<!--Top Bar end-->
<div class="container-fluid">
	<div class="row">
		<?php include("inc/menu.php"); ?>
		<div class="main_content">
			<div class="top_menu">
				<?php include("inc/apply_loan_menu.php"); ?>
			</div>
			<?php if($this->uri->segment(4)): ?>
			<div class="row">
				<div class="col-md-12">
					<div class="card bg-dash-info">
						<div class="card-header">
							Create New Account
						</div>
						<div class="card-body">
							<?php if($this->uri->segment(5)): ?>
								<?php $stp = $loanData['step']; $appl_id =$this->uri->segment(5);  ?>
								<ul class="tab_menu">
									<?php $uri4 = $this->uri->segment(4);
									if($uri4 == "step1"){$act = "current";}else{$act = "";} ?>
									<li <?php if($stp >= 2){echo "class='active ".$act."'";}else{ echo "class='disb'"; }?>>
										<a href="<?= base_url('dashboard/Apply_loan/create_account/step1/'.$appl_id); ?>">Loan Information</a>
									</li>
									<?php if($uri4 == "step2"){$act = "current";}else{$act = "";} ?>
									<li <?php if($stp >= 2){echo "class='active ".$act."'";}else{ echo "class='disb'"; }?>>
										<a href="<?= base_url('dashboard/Apply_loan/create_account/step2/'.$appl_id); ?>">Borrower Information</a>
									</li>
									<?php if($uri4 == "step3"){$act = "current";}else{$act = "";} ?>
									<li <?php if($stp >= 3){echo "class='active ".$act."'";}else{ echo "class='disb'"; }?>>
										<a href="<?= base_url('dashboard/Apply_loan/create_account/step3/'.$appl_id); ?>">Guarantor Information</a>
									</li>
									<?php if($uri4 == "step4"){$act = "current";}else{$act = "";} ?>
									<li <?php if($stp >= 4){echo "class='active ".$act."'";}else{ echo "class='disb'"; }?>>
										<a href="<?= base_url('dashboard/Apply_loan/create_account/step4/'.$appl_id); ?>">Documents</a>
									</li>
									<?php if($uri4 == "step5"){$act = "current";}else{$act = "";} ?>
									<li <?php if($stp >= 5){echo "class='active ".$act."'";}else{ echo "class='disb'"; }?>>
										<a href="<?= base_url('dashboard/Apply_loan/create_account/step5/'.$appl_id); ?>">Office Uses</a>
									</li>
								</ul>
							<?php endif; ?>
							<?php if($this->uri->segment(4)=="step1"): ?>
								<?php include("loan_forms/step1.php"); ?>
							<?php endif; ?>
							<?php if($this->uri->segment(4)=="step2" && !$this->uri->segment(5)==''): ?>
								<?php include("loan_forms/step2.php"); ?>
							<?php endif; ?>
							<?php if($this->uri->segment(4)=="step3" && !$this->uri->segment(5)==''): ?>
								<?php include("loan_forms/step3.php"); ?>
							<?php endif; ?>
							<?php if($this->uri->segment(4)=="step4" && !$this->uri->segment(5)==''): ?>
								<?php include("loan_forms/step4.php"); ?>
							<?php endif; ?>
						</div>
					</div>
				</div>
			</div>
		<?php endif; ?>
		</div>
	</div>
</div>
<?php include("inc/footer.php"); ?>
<?php include("inc/modals.php"); ?>
<?php $this->load->view("inc/js");?>
<script type="text/javascript">
	$(document).ready(function(){
		var vals = $("#loanType").val();
		var dpay = $("#dpys").val();
		$.post("<?= base_url('dashboard/AjaxController/check_down_payment'); ?>",{
			type_slug: vals
		},function(resp){
			var obj = JSON.parse(resp);
			if(obj.down_payment == "enabled")
			{
				$("#dpay").show();
				$(".down_pay").attr("required",true);
			}
			else
			{
				$("#dpay").hide();
				$(".down_pay").attr("required",false);
				$(".down_pay").val("");
				$("#dpAmt").hide();
				$(".down_pay_amt").attr("required",false);
				$(".down_pay_amt").val("");
			}
		});
		if(dpay == "yes")
		{
			$("#dpAmt").show();
			$(".down_pay_amt").attr("required",true);
		}
		else
		{
			$("#dpAmt").hide();
			$(".down_pay_amt").attr("required",false);
			$(".down_pay_amt").val("");
		}
	});
	function check_downPay(vals)
	{
		$.post("<?= base_url('dashboard/AjaxController/check_down_payment'); ?>",{
			type_slug: vals
		},function(resp){
			var obj = JSON.parse(resp);
			if(obj.down_payment == "enabled")
			{
				$("#dpay").show();
				$(".down_pay").attr("required",true);
			}
			else
			{
				$("#dpay").hide();
				$(".down_pay").attr("required",false);
				$(".down_pay").val("");
				$("#dpAmt").hide();
				$(".down_pay_amt").attr("required",false);
				$(".down_pay_amt").val("");
			}
		})
	}

	function set_dPay(vals)
	{
		if(vals == "yes")
		{
			$("#dpAmt").show();
			$(".down_pay_amt").attr("required",true);
		}
		else
		{
			$("#dpAmt").hide();
			$(".down_pay_amt").attr("required",false);
			$(".down_pay_amt").val("");
		}
	}
	function same_address()
	{
		if ($('input#sameAddr').is(':checked')) 
		{
			$("#addr2").val($("#addr1").val());
			$("#city2").val($("#city1").val());
			$("#pin2").val($("#pin1").val());
			$("#state2").val($("#state1").val());
			$("#smAdr").val("yes");
		}
		else
		{
			$("#addr2").val("");
			$("#city2").val("");
			$("#pin2").val("");
			$("#state2").val("");
			$("#smAdr").val("no");
		}
	}
	function del_docs(ids)
	{
		var res = confirm("Are you sure to delete this Document? Please Click OK to Proceed.");
		if(res == true)
		{
			location.href = "<?= base_url('dashboard/Apply_loan/delete_doc/'); ?>"+ids;
		}
	}
	function show_docs(files,folders)
	{
		var imgs = "<img src='<?= base_url(); ?>uploads/"+folders+"/"+files+"' class='img-responsive' />";
		$("#doccs").html(imgs);
		$("#showDocs").modal('show');
	}
	$("#submit_step").click(function(){
		var pics = $("#uplPic").val();
		if(pics == '')
		{
			alert("please Upload Passport size Photo");
		}
		else
		{
			$("#step_form").submit();
		}
	})
</script>
</body>
</html>
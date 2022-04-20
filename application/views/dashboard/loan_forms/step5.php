<form>
	<div class="row">
		<?php if($loanData['loan_type']=="product-loan-emi" || $loanData['loan_type']=="product-loan-pay-later"): ?>
			<div class="form-group col-md-4">
				<label>Product Type</label>
			</div>
		<?php endif; ?>
	</div>
</form>
<?php $data = loan_setup(); ?>
<div class="modal fade" id="emiModal" role="dialog">
    <div class="modal-dialog modal-md">
    <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h5>Forclose Loan</h5>
            </div>
            <div class="modal-body">
                <table class="tbl_new">
                    <tr>
                        <th>Loan A/c</th>
                        <td id="loanAc"></td>
                    </tr>
                    <tr>
                        <th>Loan Sanction Amount</th>
                        <td id="loanAmt"></td>
                    </tr>
                    <tr>
                        <th>Paid Amount</th>
                        <td id="paidAmt"></td>
                    </tr>
                    <tr>
                        <th>Remain Balance</th>
                        <td id="bal"></td>
                    </tr>
                    <tr>
                        <th>Forcolsure Charge (<span><?= $data['forclose_precent']; ?>%</span>)</th>
                        <td id="fCharge"></td>
                    </tr>
                    <tr>
                        <th>Forclosure Amount</th>
                        <td id="fAmount"></td>
                    </tr>
                </table>
                <div class="col-md-12 text-center">
                    <br><br>
                    <input type="hidden" id="lnAcNo">
                    <button id="setFcloseBtn" onclick="setForcloseLoan()" class="btn_new">Forclose Account</button>
                    <img id="loaderFclose" src="<?= base_url('assets/img/loader.gif'); ?>" width="65" style="display: none;">
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="payEmiModal" role="dialog">
    <div class="modal-dialog modal-md">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-body">
            <h5><b>EMI Amount: &#8377;<span id="EmiAmts"></span></b></h5>
            <form action="<?= base_url('dashboard/View_loans/payEmi/'); ?>" method="post">
                <div class="form-group">
                    <label>Payment Method</label>
                    <select name="pay_method" class="form-control" required>
                        <option value="">Select</option>
                        <option value="Cash">Cash</option>
                        <option value="Cheque">Cheque</option>
                        <option value="UPI-NEFT-RTGS-FundTransser">UPI/NEFT/RTGS/Fund Transser</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Cheque No./Transaction No.</label>
                    <input type="text" name="tr_no" class="form-control">
                </div>
                <div class="form-group">
                    <input type="hidden" id="emiId" name="id">
                    <button class="btn btn-success">Pay EMI</button>
                </div>
            </form>
        </div>
      </div>
    </div>
 </div>
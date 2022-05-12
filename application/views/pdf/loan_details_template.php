<style>
	.header_title{
	width: 100%;
	padding: 6px;
	background: #ccc;
}
.header_title span{
	font-size: 18px;
	font-weight: bold;
}
.tbl_new{
	width: 100%;
	border: solid 1px #ccc;
	border-collapse: collapse;
}
.tbl_new th{
	border: solid 1px #ccc;
	padding: 4px;
	font-size: 12px;
}
.tbl_new td{
	border: solid 1px #ccc;
	padding: 4px;
	font-size: 12px;
}
</style>
<div style="margin-top:25px; padding-left: 15px; padding-right: 15px;">
                        <div class="header_title">
                            <span>Loan Information</span>
                        </div>
                        <table class="tbl_new">
                        	<tr>
                        		<th>Loan A/C</th>
                        		<td><?= $data['loan_ac_no']; ?></td>
                        	</tr>
                        </table>
                        <table class="tbl_new">
                            <tr>
                                <th>Loan Effective Date</th>
                                <td><?= $data['affective_date']; ?></td>
                                <th>Type of Loan</th>
                                <td><?= unslugify($data['loan_type']); ?></td>
                            </tr>
                            <tr>
                                <th>Requested Amount</th>
                                <td>&#8377; <?= number_format($data['request_amount'],2); ?></td>
                                 <th>EMI Period (Months)</th>
                                <td><?= $data['emi_period']; ?> Months</td>
                            </tr>
                            <tr>
                                <th>Rate of Interest (% / Annual)</th>
                                <td><?= $data['rate_of_interest']; ?>%</td>
                                <th>Approved Amount</th>
                                <td>&#8377; <?= $data['approve_amount']; ?></td>
                            </tr>
                            <tr>
                                <th>Loan Processing Charge</th>
                                <td>&#8377;<?= $data['approve_amount'] - $data['disburs_amount']; ?></td>
                                <th>Approved Amount</th>
                                <td>&#8377; <?= number_format($data['disburs_amount'],2); ?></td>
                            </tr>
                        </table>
                        <?php if($data['loan_type']=="product-loan-emi" || $data['loan_type']=="product-loan-pay-later"): ?>
                        	<table class="tbl_new">
                        		<tr>
                        			<th>Product Type</th>
                        			<td><?= $data['product_type']; ?></td>
                        			<th>Product</th>
                        			<td><?= $data['product']; ?></td>
                        			
                        		</tr>
                        		<tr>
                        			<th>Serial Number</th>
                        			<td><?= $data['pro_serial']; ?></td>
                        			<th>Invoice Number</th>
                        			<td><?= $data['inv_id']; ?></td>
                        		</tr>
                        		<tr>
                        			<th>IEMI Numbers</th>
                        			<td><?= $data['iemis']; ?></td>
                        			<th>Down Payment</th>
                        			<td><?= $data['down_pay_amt']; ?></td>
                        		</tr>
                        	</table>
                    	<?php endif; ?>
                        <div class="header_title">
                            <span>Borrower Information</span>
                        </div>
                        <table class="tbl_new">
                            <tr>
                                <th>Full Name</th>
                                <td><?= $data['full_name']; ?></td>
                                <th>Gender</th>
                                <td><?= $data['gender']; ?></td>
                                <th>DOB</th>
                                <td><?= $data['dob']; ?></td>
                            </tr>
                            <tr>
                                <td>
                                    <img src="<?= base_url('uploads/'.$data['application_id'].'/'.$data['pro_img']); ?>" width="100" height="100">
                                </td>
                                <th>Contact Number</th>
                                <td><?= $data['cont_number']; ?> </td>
                                <th>Email</th>
                                <td><?= $data['email']; ?></td>
                            </tr>
                        </table>
                        <table class="tbl_new">
                            <tr style="background: #CCC;">
                                <th width="100%">Current Address</th>
                            </tr>
                        </table>
                        <table class="tbl_new">
                            <tr>
                                <th>Address</th>
                                <td><?= $data['adress']; ?></td>
                                <th>City</th>
                                <td><?= $data['city']; ?></td>
                            </tr>
                            <tr>
                                <th>PIN/ZIP</th>
                                <td><?= $data['pin']; ?></td>
                                <th>State</th>
                                <td><?= $data['state']; ?></td>
                            </tr>
                        </table>
                        <table class="tbl_new">
                            <tr style="background: #CCC;">
                                <th width="100%">Permanent Address</th>
                            </tr>
                        </table>
                        <table class="tbl_new">
                            <tr>
                                <th>Address</th>
                                <td><?= $data['r_adress']; ?></td>
                                <th>City</th>
                                <td><?= $data['r_city']; ?></td>
                            </tr>
                            <tr>
                                <th>PIN/ZIP</th>
                                <td><?= $data['r_pin']; ?></td>
                                <th>State</th>
                                <td><?= $data['r_state']; ?></td>
                            </tr>
                        </table>
                        <table class="tbl_new">
                        	<tr>
                        		<th>Voter ID No.</th>
                        		<td><?= $data['v_id']; ?></td>
                        		<th>Adhaar Number</th>
                        		<td><?= $data['adhar_no']; ?></td>
                        		<th>PAN Number</th>
                        		<td><?= $data['pan_no']; ?></td>
                        	</tr>
                        </table>
                    </div>
                    <div style="margin-top:25px; padding-left: 15px; padding-right:15px;" id="gu">
                        <div class="header_title">
                            <span>Guarantor Information</span>
                        </div>
                        <table class="tbl_new">
                            <tr>
                                <th>Full Name</th>
                                <td><?= $data['g_full_name']; ?></td>
                                <th>Gender</th>
                                <td><?= $data['g_gender']; ?></td>
                                <th>DOB</th>
                                <td><?= $data['g_dob']; ?></td>
                            </tr>
                            <tr>
                                <td>
                                	<img src="<?= pdf_img_dir($data['g_pro_img'],$data['application_id']); ?>" width="100" height="100">
                                </td>
                                <th>Contact Number</th>
                                <td><?= $data['g_cont_number']; ?></td>
                                <th>Email</th>
                                <td><?= $data['g_email']; ?></td>
                            </tr>
                        </table>
                        <table class="tbl_new">
                            <tr style="background: #CCC;">
                                <th width="100%">Current Address</th>
                            </tr>
                        </table>
                        <table class="tbl_new">
                        	<tr>
                                <th>Address</th>
                                <td><?= $data['g_adress']; ?></td>
                                <th>City</th>
                                <td><?= $data['g_city']; ?></td>
                            </tr>
                            <tr>
                                <th>PIN/ZIP</th>
                                <td><?= $data['g_pin']; ?></td>
                                <th>State</th>
                                <td><?= $data['g_state']; ?></td>
                            </tr>
                            
                        </table>
                        <table class="tbl_new">
                            <tr style="background: #CCC;">
                                <th width="100%">Permanent Address</th>
                            </tr>
                        </table>
                        <table class="tbl_new">
                            <tr>
                                <th>Address</th>
                                <td><?= $data['g_r_adress']; ?></td>
                                <th>City</th>
                                <td><?= $data['g_r_city']; ?></td>
                            </tr>
                            <tr>
                                <th>PIN/ZIP</th>
                                <td><?= $data['g_r_pin']; ?></td>
                                <th>State</th>
                                <td><?= $data['g_r_state']; ?></td>
                            </tr>
                        </table>
                        <table class="tbl_new">
                        	<tr>
                        		<th>Voter ID No.</th>
                        		<td><?= $data['g_v_id']; ?></td>
                        		<th>Adhaar Number</th>
                        		<td><?= $data['g_adhar_no']; ?></td>
                        		<th>PAN Number</th>
                        		<td><?= $data['g_pan_no']; ?></td>
                        	</tr>
                        </table>
                    </div>
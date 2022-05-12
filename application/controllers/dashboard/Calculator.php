<?php /**
 * 
 */
class Calculator extends CI_controller
{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->helper("slugifyhelp");
		if(!$this->session->userdata("userAdmin"))
		{
			return redirect(base_url('dashboard/Login'));
		}
	}

	public function index()
	{
		$this->load->view("dashboard/Calculator_new2");
	}

	public function get_emi()
	{
	    $postData = $this->input->post();
	    $balance = $postData['ra'];
	    $payment_date = $postData['start_date'];
	    $emi = $this->PMT($postData['roi'],$postData['pom'],$postData['ra']);
	    ?>

	    <h3 class="text-center">EMI Schedule</h3>
	    <h4 class="text-center">Total Repayment: &#8377;<?= round($emi*$postData['pom']); ?>.00</h4>
        <hr>
        <div class="card">
        	<div class="card-body">
        		<span class="text-info"><b>Loan Amount:</b> &#8377;<?= $postData['ra']; ?>.00</span><br>
        		<span class="text-info"><b>Rate of Interest:</b> <?= $postData['roi']; ?>%</span><br>
        		<span class="text-info"><b>Period of Months:</b> <?= $postData['pom']; ?> Months</span><br>
        		<span class="text-info"><b>Total Repayment Amount:</b> &#8377;<?= round($emi*$postData['pom']); ?>.00</span>
        	</div>
        </div>
        <table class="table table-striped table-bordered">
          <thead>
            <tr>
              <th>SN</th>
              <th>Payment Date</th>
              <th>Monthly EMI</th>
              <th>Interest Paid</th>
              <th>Principal Paid</th>
              <th>Balance</th>
            </tr>
          </thead>
          <tbody>
            <?php for($i=1;$i<=$postData['pom'];$i++){?>
              <?php 
                $interest = (($postData['roi']/100)*$balance)/12;
                $principal = $emi - $interest;
                $balance = $balance - $principal;
                $payment_date = date('Y-m-d',strtotime("+1 month",strtotime($payment_date)));
              ?>
              <tr>
                <td><?php echo $i;?></td>
                <td><?php $this->showDate($payment_date);?></td>
                <td><?php $this->showValue($emi);?></td>
                <td><?php $this->showValue($interest);?></td>
                <td><?php $this->showValue($principal);?></td>
                <td><?php $this->showValue($balance);?></td>
              </tr>
            <?php } ?>
          </tbody>
        </table>

<?php
	    
	}

	public function PMT($interest,$period,$loan_amount)
	{
	  $interest = (float)$interest;
	  $period = (float)$period;
	  $loan_amount = (float)$loan_amount;
	  $period = $period;
	  $interest = $interest / 1200;
	  $amount = $interest * -$loan_amount * pow((1+$interest),$period) / (1 - pow((1+$interest), $period));
	  return $amount;
	}
	public function showValue($value){
	  echo "&#8377;".round($value,).".00";
	}
	public function showDate($date){
	  echo date('d-m-Y',strtotime($date));
	}
}
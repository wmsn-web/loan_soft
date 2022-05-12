<?php /**
 * 
 */
class TestEmi extends CI_controller
{
	
	function __construct()
	{
		parent::__construct();
	}

	public function index($id)
	{
		$this->db->where("id",$id);
		$data = $this->db->get("loans")->row_array();
		$this->db->where("loan_no",$data['loan_ac_no']);
		$chk = $this->db->get("loan_emis")->num_rows();
		if($chk > 0)
		{
			return redirect(base_url('dashboard/View_loans/Emi/'.$data['loan_ac_no']));
		}
		else
		{
			$tenure = $data['emi_period'];
			$ra = $data['approve_amount'];
			$pom =$tenure;
			$roi = $data['rate_of_interest'];
			$balance = $ra;
			$payment_date = $data['emi_start_date'];
			if($data['loan_type']=="product-loan-pay-later")
			{
				if($data['rate_of_interest']==0)
				{
					$roi = 0;
				}
				else
				{
					$roi = $data['rate_of_interest'] / 100;
				}
				$em = $ra*$roi;
				$emi = $ra+$em;
				$emiData = array(
			        	"loan_no"			=>$data['loan_ac_no'],
			        	"payment_date"		=>date('Y-m-d',strtotime($payment_date)),
			        	"monthly_emi"		=>round($emi),
			        	"intr_pay"			=>round($em),
			        	"principal_pay"		=>round($ra),
			        	"balance"			=>0,
			        	"extra_chgs"		=>0,
			        	"status"			=>"unpaid"

			        );
				$this->db->insert("loan_emis",$emiData);
			}
			else
			{
				$emi = $this->PMT($roi,$pom,$ra);
				
				
				for($i=1;$i<=$pom;$i++):
			        $interest = (($roi/100)*$balance)/12;
			        $principal = $emi - $interest;
			        $balance = abs($balance - $principal);
			        $payment_date = date('Y-m-d',strtotime("+1 month",strtotime($payment_date)));
			        $emiData = array(
			        	"loan_no"			=>$data['loan_ac_no'],
			        	"payment_date"		=>date('Y-m-d',strtotime($payment_date)),
			        	"monthly_emi"		=>round($emi),
			        	"intr_pay"			=>round($interest),
			        	"principal_pay"		=>round($principal),
			        	"balance"			=>round($balance),
			        	"extra_chgs"		=>0,
			        	"status"			=>"unpaid"

			        );

			        $this->db->insert("loan_emis",$emiData);
			        
			    endfor;
			}
		    return redirect(base_url('dashboard/View_loans/Emi/'.$data['loan_ac_no']));
		}

             
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

}
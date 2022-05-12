<?php /**
 * 
 */
class CreateCron extends CI_controller
{
	
	function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		
		//Cronjob for EMI date check and add Extra charge
		$this->emi_cronjob();
		$this->emi_notify_cronjob();
	}
	/*
			$config = array(
            'protocol' => 'smtp', 
	        'smtp_host' => 'ssl://smtp.gmail.com', 
	        'smtp_port' => 465, 
	        'smtp_user' => 'solutions.web2019@gmail.com', 
	        'smtp_pass' => 'Goodnight88$', 
	        'mailtype' => 'html', 
	        'charset' => 'iso-8859-1'
			);
			*/

	public function emi_cronjob()
	{
		$setups = all_settings();
		date_default_timezone_set('Asia/Kolkata');
		$lnSetup = loan_setup();
		$this->db->where(["extra_chgs"=>0,"status"=>"unpaid"]);
		$get = $this->db->get("loan_emis");
		if($get->num_rows()==0)
		{

		}
		else
		{
			$res = $get->result();
			foreach($res as $key)
			{
				$today = time();
				$payment_date = strtotime($key->payment_date);
				$diff = $today - $payment_date;
				$difDay = round($diff / (60 * 60 * 24));
				if($difDay > $lnSetup['maximum_days'])
				{
					$this->db->where("id",$key->id);
					$this->db->update("loan_emis",["extra_chgs"=>$lnSetup['repay_delay_chgs']]);
					if($setups['transaction_email']==1)
					{
						$this->send_od_charge_email($key->loan_no,$key->payment_date,$lnSetup['repay_delay_chgs']);
					}
				}
			}
		}
	}

	public function send_od_charge_email($loan_no,$payment_date,$amount)
	{
		$setups = all_settings();
		$config = array(
            'protocol' => 'smtp', 
	        'smtp_host' => $setups['smtp_host'], 
	        'smtp_port' => $setups['smtp_port'], 
	        'smtp_user' => $setups['smtp_user'], 
	        'smtp_pass' => $setups['smtp_password'], 
	        'mailtype' => 'html', 
	        'charset' => 'iso-8859-1'
			);
		$this->email->initialize($config);
		$this->email->set_mailtype("html");
		$this->email->set_newline("\r\n");

		$this->db->where("loan_ac_no",$loan_no);
		$row = $this->db->get("loans")->row_array();
		$email = $row['email'];
		
		$data['company'] = $setups['company_name'];
		$data['header'] = "Loan Over Due Charge Applied";
		$data["message"] = "Dear ".$row['full_name'].",<br>Your due EMI date (".$payment_date.") was exceed the repayment day limit. The over due charge Rs.".$amount." has been applied. <br>Please repay the emi to avoid other charges.";

		$htmlContent = $this->load->view("emails/over_due_notice",$data,TRUE);
		$this->email->to($email);
		$this->email->from("info@loanac.com",$setups['company_name']);
		$this->email->subject('Over Due EMI Charge');
		$this->email->message($htmlContent);
		 
		//Send email
		$sends = $this->email->send();
	}

	public function emi_notify_cronjob()
	{
		$setups = all_settings();
		date_default_timezone_set('Asia/Kolkata');
		$date = date('Y-m-d');
		$lnSetup = loan_setup();
		$this->db->where(["status"=>"unpaid"]);
		$get = $this->db->get("loan_emis");
		if($get->num_rows()==0)
		{

		}
		else
		{
			$res = $get->result();
			foreach($res as $key)
			{
				$today = time();
				$payment_date = strtotime($key->payment_date);
				$day5Ago = date('Y-m-d', strtotime('-5 days', strtotime($key->payment_date)));
				$ago = strtotime($day5Ago);
				if($ago <= $today && $today < $payment_date)
				{
					$this->db->where("loan_ac_no",$key->loan_no);
					$row = $this->db->get("loans")->row_array();
					$this->db->where(["dates"=>$date,"email"=>$row['email']]);
					$chk = $this->db->get("emi_notice")->num_rows();
					if($chk > 0)
					{

					}
					else
					{
						if($setups['notification_email']==1)
						{
							$this->db->insert("emi_notice",["dates"=>$date,"email"=>$row['email']]);
							$this->send_emi_notification_email($key->loan_no,$key->payment_date,$key->monthly_emi);
						}

					}
				}

				
			}
		}
	}

	public function send_emi_notification_email($loan_no,$payment_date,$amount)
	{
		$setups = all_settings();
		$config = array(
            'protocol' => 'smtp', 
	        'smtp_host' => $setups['smtp_host'], 
	        'smtp_port' => $setups['smtp_port'], 
	        'smtp_user' => $setups['smtp_user'], 
	        'smtp_pass' => $setups['smtp_password'], 
	        'mailtype' => 'html', 
	        'charset' => 'iso-8859-1'
			);
		$this->email->initialize($config);
		$this->email->set_mailtype("html");
		$this->email->set_newline("\r\n");

		$this->db->where("loan_ac_no",$loan_no);
		$row = $this->db->get("loans")->row_array();
		$email = $row['email'];
		$data['company'] = $setups['company_name'];
		$data['header'] = "Loan Over Due Charge Applied";
		$data["message"] = "Dear ".$row['full_name'].",<br>Your ".$loan_no." due EMI date is on ".$payment_date.". The EMI amount is <b>Rs.".number_format($amount,2)."</b> <br>Please repay the emi to avoid other charges.";

		$htmlContent = $this->load->view("emails/over_due_notice",$data,TRUE);
		$this->email->to($email);
		$this->email->from("info@loanac.com",$setups['company_name']);
		$this->email->subject('Loan EMI Notification');
		$this->email->message($htmlContent);
		 
		//Send email
		$sends = $this->email->send();
	}
}
<?php /**
 * 
 */
class View_loans extends CI_controller
{
	
	public function __construct()
	{
		parent::__construct();
		if(!$this->session->userdata("userAdmin"))
		{
			return redirect(base_url('dashboard/Login'));
		}
	}

	public function index()
	{
		$data = $this->LoanApplicationModel->get_disbursed_loans_open();
		//print_r($data);
		$this->load->view("dashboard/View_loans",["data"=>$data]);
	}
	public function closed_loans()
	{
		$data = $this->LoanApplicationModel->get_disbursed_loans_closed();
		//print_r($data);
		$this->load->view("dashboard/View_loans",["data"=>$data]);
	}

	public function Emi($loanAc)
	{
		$emiCronjob = $this->LoanApplicationModel->emi_cronjob();
		$getEmis = $this->LoanApplicationModel->get_emis($loanAc);
		$this->load->view("dashboard/Emi_view",["data"=>$getEmis]);
	}

	public function payEmi()
	{
		$id = $this->input->post("id");
		$pay_method = $this->input->post("pay_method");
		$tr_no = $this->input->post("tr_no");
		$setups = all_settings();
		$this->db->where("id",$id);
		$get = $this->db->get("loan_emis")->row();
		$amt = $get->monthly_emi + $get->extra_chgs;
		if($pay_method == "Cash")
		{
			$trn = "";
		}
		else
		{
			$trn = "Transaction number is ".$tr_no;
		}
		$dataTrans = array(
			"notes"			=>"Loan Repayment Against Loan A/c- ".$get->loan_no." The payment method is ".oblics($pay_method)." ".$trn,
			"dates"			=>date('Y-m-d'),
			"year"			=>date('Y'),
			"loan_no"		=>$get->loan_no,
			"types"			=>"repay",
			"in_amt"		=>$amt
		);

		$this->db->insert("transactions",$dataTrans);
		$this->db->where("id",$get->id);
		$this->db->update("loan_emis",["status"=>"paid","pay_method"=>$pay_method,"tr_no"=>$tr_no]);
		if($setups['transaction_email']==1)
		{
			$this->db->where("loan_ac_no",$get->loan_no);
			$rows = $this->db->get("loans")->row_array();
			$this->send_transactional_email($rows['email'],$amt,$rows['loan_ac_no'],$pay_method,$tr_no);
		}
		$this->db->where(["loan_no"=>$get->loan_no,"status"=>"unpaid"]);
		$chks = $this->db->get("loan_emis")->num_rows();
		if($chks == 0)
		{
			$this->db->where("loan_ac_no",$get->loan_no);
			$this->db->update("loans",["closing_status"=>"closed"]);
		}
		$this->session->set_flashdata("Feed","Payment Added successfully");
		return redirect(back());
	}

	function send_transactional_email($email,$amount,$loan_no,$pay_method,$tr_no)
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

		if($pay_method == "Cash")
		{
			$trn = "";
		}
		else
		{
			$trn = "Transaction number is ".$tr_no;
		}

		$this->db->where("loan_ac_no",$loan_no);
		$row = $this->db->get("loans")->row_array();
		$data['company'] = $setups['company_name'];
		$data['header'] = "EMI successfully paid";
		$data["message"] = "Dear ".$row['full_name'].",<br>Your ".$loan_no."  amount of <b>Rs.".number_format($amount,2)."</b> <br>successfully paid. The amount paid by ".oblics($pay_method). " ".$trn;

		$htmlContent = $this->load->view("emails/over_due_notice",$data,TRUE);
		$this->email->to($email);
		$this->email->from("info@loanac.com",$setups['company_name']);
		$this->email->subject('Loan EMI Payment Success');
		$this->email->message($htmlContent);
		 
		//Send email
		$sends = $this->email->send();
	}
}
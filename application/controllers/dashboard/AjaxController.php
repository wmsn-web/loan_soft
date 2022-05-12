<?php /**
 * 
 */
class AjaxController extends CI_controller
{
	
	function __construct()
	{
		parent::__construct();
	}

	public function check_down_payment()
	{
		$conditions = $this->input->post();
		$this->db->where($conditions);
		$data = $this->db->get("loan_types")->row_array();
		echo json_encode($data);
	}

	public function validate_user()
	{
		$data = $this->input->post();
		$this->db->where($data);
		$num = $this->db->get("admin")->num_rows();
		echo $num;
	}
	public function check_kyc_with_guarantor()
	{
		$field = $this->input->post("field");
		$apl_id = $this->input->post("apl_id");
		$vals = $this->input->post("vals");
		$data = array(
			$field => $vals,
			"application_id"=>$apl_id
		);

		$this->db->where($data);
		$chk = $this->db->get("loans")->num_rows();
		echo $chk;

	}

	public function get_interest()
	{
		$data = $this->input->post();
		$this->db->where($data);
		$get = $this->db->get("emi_states")->row_array();
		echo $get['int_rate'];
	}

	public function calculate_estimate_emi()
	{
		$ra = $this->input->post("ra");
		$pom = $this->input->post("pom");
		$roi = $this->input->post("roi");
		
		$monthlyIntr = $roi/12/100;
		$intBymonth = $monthlyIntr*$ra;
		$monthlyPrinc = $ra/$pom;
		$emi = $monthlyPrinc + $intBymonth;
		$totAmt = $emi*$pom;

		$data = array(
			"intr_month" => number_format($intBymonth,2),
			"month_principal" => number_format($monthlyPrinc,2),
			"emi"	=> number_format($emi,2),
			"totAmt" =>number_format($totAmt,2)
		);
		echo json_encode($data,true);
	}

	public function del_finalDocs()
	{
		$id = $this->input->post("id");
		$this->db->where("id",$id);
		$get = $this->db->get("final_docs")->row_array();
		$path = "./uploads/".$get['application_id']."/".$get['docs'];
		@unlink($path);
		$this->db->where("id",$id);
		$this->db->delete("final_docs");
	}

	public function change_user_status()
	{
		$id = $this->input->post("id");
		$this->db->where("id",$id);
		$get = $this->db->get("admin")->row_array();
		if($get['status'] == 0)
		{
			$this->db->where("id",$id);
			$this->db->update("admin",["status"=>1]);
		}
		else
		{
			$this->db->where("id",$id);
			$this->db->update("admin",["status"=>0]);
		}
	}

	public function fill_user()
	{
		$id = $this->input->post("id");
		$app_id = $this->input->post("app_id");
		$this->db->where("id",$id);
		$get = $this->db->get("users");
		if($get->num_rows()==0)
		{
			$usr['full_name'] = "";
			$usr['gender'] =  "";
			$usr['dob'] =  "";
			$usr['cont_number'] =  "";
			$usr['email'] =  "";
			$usr['adress'] =  "";
			$usr['city'] =  "";
			$usr['pin'] =  "";
			$usr['state'] =  "";
			$usr['same_addr'] =  "";
			$usr['r_adress'] =  "";
			$usr['r_city'] =  "";
			$usr['r_pin'] =  "";
			$usr['r_state'] =  "";
			$usr['v_id'] =  "";
			$usr['adhar_no'] =  "";
			$usr['pan_no'] =  "";
			$this->db->where("application_id",$app_id);
			$this->db->update("loans",$usr);
		}
		else
		{
			$this->db->where("id",$id);
			$getx = $this->db->get("users")->row_array();
			$usr['full_name'] = $getx['full_name'];
			$usr['gender'] =  $getx['gender'];
			$usr['dob'] =  $getx['dob'];
			$usr['cont_number'] =  $getx['cont_number'];
			$usr['email'] =  $getx['email'];
			$usr['adress'] =$getx['adress'];
			$usr['city'] =  $getx['city'];
			$usr['pin'] =  $getx['pin'];
			$usr['state'] =  $getx['state'];
			$usr['same_addr'] =  $getx['same_addr'];
			$usr['r_adress'] =  $getx['r_adress'];
			$usr['r_city'] =  $getx['r_city'];
			$usr['r_pin'] =  $getx['r_pin'];
			$usr['r_state'] =  $getx['r_state'];
			$usr['v_id'] =  $getx['v_id'];
			$usr['adhar_no'] =  $getx['adhar_no'];
			$usr['pan_no'] =  $getx['pan_no'];
			$this->db->where("application_id",$app_id);
			$this->db->update("loans",$usr);
			//echo json_encode($data, TRUE);
			//print_r($data);
		}

		
	}

	public function check_pans()
	{
		$vals = $this->input->post("vals");
		$this->db->where("pan_no",$vals);
		$data = $this->db->get("users")->num_rows();
		echo $data;
	}

	public function get_emi_forclosure()
	{
		$loan_no = $this->input->post("loan_no");
		$this->db->where("loan_no",$loan_no);
		$get = $this->db->get("loan_emis")->row_array();

		$this->db->where(["loan_no"=>$get['loan_no'],"status"=>"paid"]);
		$this->db->select_sum("principal_pay");
		$row = $this->db->get("loan_emis")->row();
		$tot_paid = $row->principal_pay;

		$this->db->where("loan_ac_no",$get['loan_no']);
		$loan = $this->db->get("loans")->row_array();

		$set = $this->db->get("loan_setups")->row_array();
		$fPercent = $set['forclose_precent'] /100;
		$fCharge = $fPercent*$get['balance'];
		$approve_amount = $loan['approve_amount'];
		$remain = $approve_amount - $tot_paid;
		$fCharge = $fPercent*$remain;
		$fAmount = $fCharge + $remain;

		if($tot_paid == 0)
		{
			echo "unpaid";
		}
		else
		{

			$data = array(
				"loan_ac"		=>$get['loan_no'],
				"sanctionAmt"	=>$approve_amount,
				"paidAmt"		=>round($tot_paid),
				"remain"		=>round($remain),
				"fCharge"		=>round($fCharge),
				"fAmount"		=>round($fAmount)
			);

			echo json_encode($data, TRUE);
		}

	}

	public function set_loan_emi_forclosure()
	{
		$setups = all_settings();
		$loan_no = $this->input->post("loan_no");
		$this->db->where("loan_no",$loan_no);
		$get = $this->db->get("loan_emis")->row_array();

		$this->db->where(["loan_no"=>$loan_no,"status"=>"paid"]);
		$this->db->select_sum("principal_pay");
		$row = $this->db->get("loan_emis")->row();
		$tot_paid = $row->principal_pay;

		$this->db->where("loan_ac_no",$loan_no);
		$loan = $this->db->get("loans")->row_array();

		$set = $this->db->get("loan_setups")->row_array();
		$fPercent = $set['forclose_precent'] /100;
		$fCharge = $fPercent*$get['balance'];
		$approve_amount = $loan['approve_amount'];
		$remain = $approve_amount - $tot_paid;
		$fCharge = $fPercent*$remain;
		$fAmount = $fCharge + $remain;

		if($tot_paid == 0)
		{
			$retrn = "succ";
		}
		else
		{

			$data = array(
				"loan_no"			=>$get['loan_no'],
				"status"			=>"forclose",
				"approve_amount"	=>$approve_amount,
				"emi_paid"			=>round($tot_paid),
				"remain_bal"		=>round($remain),
				"forclose_charge"	=>round($fCharge),
				"amount"			=>round($fAmount),
				"dates"				=>date('Y-m-d')
			);

			$dataTrans = array(
			"notes"			=>"Loan forclosed Against Loan A/c- ".$loan_no,
			"dates"			=>date('Y-m-d'),
			"year"			=>date('Y'),
			"loan_no"		=>$loan_no,
			"types"			=>"repay",
			"in_amt"		=>$fAmount
		);


			$this->db->where("loan_no",$loan_no);
			$chk = $this->db->get("loan_closing_status")->num_rows();
			if($chk > 0)
			{
			
			}
			else
			{
				$this->db->insert("loan_closing_status",$data);
				$this->db->where("loan_ac_no",$loan_no);
				$this->db->update("loans",["closing_status"=>"forclose"]);
				$this->db->insert("transactions",$dataTrans);
				
				if($setups['transaction_email']==1)
				{
					
					$this->db->where("loan_ac_no",$loan_no);
					$rows = $this->db->get("loans")->row_array();
					$this->send_transactional_email($rows['email'],$fAmount,$rows['loan_ac_no']);
					$retrn = "succ";

					
				}
				else
				{
					$retrn = "succ";
				}
				
			}
		}

		echo $retrn;
	}

	public function send_transactional_email($email,$amount,$loan_no)
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
		$data['company'] = $setups['company_name'];
		$data['header'] = "EMI successfully paid";
		$data["message"] = "Dear ".$row['full_name'].",<br>Your request for Forclosure of <b>".$loan_no."</b> has been accepted and the loan A/c has been forclosed successfully. Payment of Rs.".$amount." received. <br> We will provide you NOC after 30 Days from the forclosure date.<br> Thank you <br>".$setups['company_name'];

		$htmlContent = $this->load->view("emails/over_due_notice",$data,TRUE);
		$this->email->to($email);
		$this->email->from("info@loanac.com",$setups['company_name']);
		$this->email->subject('Loan forclosed Successfully');
		$this->email->message($htmlContent);
		 
		//Send email
		$sends = $this->email->send();
	}

	public function get_loantype_id($id = '')
	{
		$this->db->where("id",$id);
		$data = $this->db->get("loan_types")->row_array();
		echo json_encode($data, TRUE);
	}

	public function get_investor_by_id()
	{
		$id = $this->input->post("id");
		$this->db->where("id",$id);
		$data = $this->db->get("investors")->row_array();
		echo json_encode($data);
	}

}
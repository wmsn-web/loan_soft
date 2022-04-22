<?php /**
 * 
 */
class Apply_loan extends CI_controller
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
		$loanTypes = $this->LoanApplicationModel->get_loan_types();
		$this->load->view("dashboard/Apply_loan",["loan_type"=>$loanTypes]);
	}

	public function create_account()
	{
		if(!empty($this->uri->segment(5)))
		{
			$loanData = $this->LoanApplicationModel->get_loan_data_by_id($this->uri->segment(5));
			$loanTypes = $this->LoanApplicationModel->get_loan_types();
			$this->load->view("dashboard/Apply_loan",["loan_type"=>$loanTypes,"loanData"=>$loanData]);
		}
		else
		{
			$loanTypes = $this->LoanApplicationModel->get_loan_types();
			$loanData = $this->LoanApplicationModel->get_loan_data_by_id(11);
			$this->load->view("dashboard/Apply_loan",["loan_type"=>$loanTypes,"loanData"=>$loanData]);
		}
	}

	public function review_account()
	{
		echo "string";
	}

	public function Submitted_accounts()
	{
		$prof = $this->UserModel->get_profiles($this->session->userdata("userAdmin"));
		if($prof['role_slug']=="data-entry-operator")
		{
			$userId = $this->session->userdata("userAdmin");
			$conditions = array("submitted_by"=>$userId);
			$data = $this->LoanApplicationModel->get_submitted_loans($conditions);
		}
		else
		{
			$conditions = array();
			$data = $this->LoanApplicationModel->get_submitted_loans($conditions);
		}

		$this->load->view("dashboard/submitted_loans",["data"=>$data]);
		//echo "<pre>";
		//print_r($data);
		
	}

	public function submit_to_review($application_id='')
	{
		$this->db->where("application_id",$application_id);
		$this->db->update("loans",["loan_status"=>"under-review",'status_code'=>2]);
		return redirect(base_url('dashboard/Apply_loan/Submitted_accounts'));
	}

	public function delete_doc($ids)
	{
		$this->db->where("id",$ids);
		$this->db->delete("loan_documents");
		return redirect(back());
	}

	public function approve_loan($application_id='')
	{
		$loan_no = "LN-".mt_rand(00000000000,99999999999);
		$this->db->where("application_id",$application_id);
		$this->db->update("loans",["loan_status"=>"approved","loan_ac_no"=>$loan_no]);
		$this->session->set_flashdata("mdl","Loan Approved. Loan Account Number:<br> ".$loan_no);
		return redirect(back());
	}

	public function reject_loan($application_id='')
	{
		$this->db->where("application_id",$application_id);
		$this->db->update("loans",["loan_status"=>"rejected","loan_ac_no"=>null]);
		return redirect(back());
	}

	public function disburs_loan($application_id)
	{
		$this->db->where("application_id",$application_id);
		$get = $this->db->get("loans");
		if($get->num_rows()==0)
		{

		}
		else
		{
			$row = $get->row();
			//Check Wallet Balance
			$this->db->select_sum("in_amt");
			$in = $this->db->get("transactions")->row();
			$tot_in = $in->in_amt;

			$this->db->select_sum("out_amt");
			$out = $this->db->get("transactions")->row();
			$tot_out = $out->out_amt;

			$reamin = $tot_in - $tot_out;
			$bal = $reamin;
			//Check Wallet Balance
			if($bal < $row->approve_amount)
			{
				$this->session->set_flashdata("err","Insufficient Fund!");
				return redirect(back());
			}
			else
			{
				$process_charge = $row->approve_amount - $row->disburs_amount;
				$this->db->where("agent_code",$row->agent_code);
				$gtAgnt = $this->db->get("agents")->row();
				$prcnt = $gtAgnt->commission/100;
				$agent_commission = $process_charge*$prcnt;

				//Admin Trans
				$notes1 = "Loan Processing Charge against <b>".$row->loan_ac_no."</b>";
				$data1 = array(
					"notes"		=>htmlentities($notes1),
					"dates"		=>date('Y-m-d'),
					"year"		=>date('Y'),
					"loan_no"	=>$row->loan_ac_no,
					"in_amt"	=>$process_charge
				);
				$notes2 = "Agent (".$row->agent_code.") Commission Applied against <b>".$row->loan_ac_no."</b>";
				$data2 = array(
					"notes"		=>htmlentities($notes2),
					"dates"		=>date('Y-m-d'),
					"year"		=>date('Y'),
					"loan_no"	=>$row->loan_ac_no,
					"agent_code"	=>$row->agent_code,
					"out_amt"	=>$agent_commission
				);
				$notes3 = "Amount disbursed to customer A/c Against <b>".$row->loan_ac_no."</b>";
				$data3 = array(
					"notes"		=>htmlentities($notes3),
					"dates"		=>date('Y-m-d'),
					"year"		=>date('Y'),
					"loan_no"	=>$row->loan_ac_no,
					"out_amt"	=>$row->approve_amount
				);

				$this->db->where("application_id",$application_id);
				$this->db->update("loans",["loan_status"=>"disbursed"]);

				$this->db->insert("transactions",$data3);
				$this->db->insert("transactions",$data2);
				$this->db->insert("transactions",$data1);
				

				$this->session->set_flashdata("Feed","Loan Disbursed Successfully");
				return redirect(back());
			}
				
		}
	}
}
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
		$this->db->update("loans",["loan_status"=>"under-review"]);
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
		return redirect(back());
	}

	public function reject_loan($application_id='')
	{
		$this->db->where("application_id",$application_id);
		$this->db->update("loans",["loan_status"=>"rejected","loan_ac_no"=>null]);
		return redirect(back());
	}
}
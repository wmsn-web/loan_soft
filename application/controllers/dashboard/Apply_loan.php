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

	public function delete_doc($ids)
	{
		$this->db->where("id",$ids);
		$this->db->delete("loan_documents");
		return redirect(back());
	}
}
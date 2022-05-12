<?php /**
 * 
 */
class Fund extends CI_controller
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
		$investors = $this->AccountModel->get_investors();
		$fundBal = fund_bal(); //$this->AccountModel->get_fund_balance();
		$transaction = $this->AccountModel->get_transactions();
		$this->load->view("dashboard/Fund",["data"=>$transaction, "fundBal"=>$fundBal,"investors"=>$investors]);
	}

	public function add_fund()
	{
		$fundBal = fund_bal();
		$amount = $this->input->post("amount");
		$notes = $this->input->post("notes");
		$investor = $this->input->post("inv_by");
		if($investor == "self")
		{
			$investorBal = 0;
		}
		else
		{
			$investorBal = investor_bal($investor);
		}
		$bal = $fundBal+$amount;

		$data1 = array(
				"notes"		=>htmlentities($notes),
				"dates"		=>date('Y-m-d'),
				"year"		=>date('Y'),
				"investor"  =>$investor,
				"types"		=>"fund",
				"in_amt"	=>$amount
			);
		
		$balInv = $investorBal+$amount;
		$this->db->insert("transactions",$data1);
		modify_fund_bal($bal);
		modify_investor_bal($investor,$balInv);
		$this->session->set_flashdata("Feed","Fund Added Successfully");
		return redirect(back());
		
	}
}
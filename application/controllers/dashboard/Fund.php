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
		$fundBal = $this->AccountModel->get_fund_balance();
		$transaction = $this->AccountModel->get_transactions();
		$this->load->view("dashboard/Fund",["data"=>$transaction, "fundBal"=>$fundBal]);
	}

	public function add_fund()
	{
		$amount = $this->input->post("amount");
		$notes = $this->input->post("notes");

		$data1 = array(
				"notes"		=>htmlentities($notes),
				"dates"		=>date('Y-m-d'),
				"year"		=>date('Y'),
				"types"		=>"fund",
				"in_amt"	=>$amount
			);
		$this->db->insert("transactions",$data1);
		$this->session->set_flashdata("Feed","Fund Added Successfully");
		return redirect(back());
	}
}
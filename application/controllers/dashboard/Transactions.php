<?php /**
 * 
 */
class Transactions extends CI_controller
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
		$transaction = $this->AccountModel->get_transactions();
		$this->load->view("dashboard/Transactions",["data"=>$transaction]);
	}
}
<?php /**
 * 
 */
class All_customers extends CI_controller
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
		$data = $this->CustomerModel->get_customers();
		$this->load->view("dashboard/All_customers",["data"=>$data]);
	}

	public function Edit_customer($id='')
	{
		$data = $this->CustomerModel->get_customers_by_id($id);
		$this->load->view("dashboard/Edit_customer",["data"=>$data]);
	}
}
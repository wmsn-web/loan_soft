<?php /**
 * 
 */
class Loan_settings extends CI_controller
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
		$this->load->view("dashboard/Loan_settings");
	}

	public function save_setting()
	{
		$data = $this->input->post();
		$this->db->update("loan_setups",$data);
		$this->session->set_flashdata("Feed","Settings updated successfully.");
		return redirect(back());
	}
}
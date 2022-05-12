<?php /**
 * 
 */
class App_settings extends CI_controller
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
		$this->load->view("dashboard/App_settings");
	}

	public function save_app_settings()
	{
		$data = $this->input->post();
		$this->db->update("settings",$data);
		$this->session->set_flashdata("Feed","Settings Up[dated Successfully");
		return redirect(back());
	}
}
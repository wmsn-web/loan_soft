<?php /**
 * 
 */

class Home extends CI_controller
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
		$this->load->view("dashboard/Home");
	}
	public function logout()
	{
		$this->session->unset_userdata("userAdmin");
		return redirect(base_url('dashboard/Login'));
	}
}
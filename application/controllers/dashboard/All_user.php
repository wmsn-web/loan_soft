<?php /**
 * 
 */
class All_user extends CI_controller
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
		$data['all_users'] = $this->UserModel->get_all_users();
		$this->load->view("dashboard/All_user",$data);
	}	
	public function Edit_user($id)
	{
		$user = $this->UserModel->get_user_by_id($id);
		$this->load->view("dashboard/Edit_users",["data"=>$user]);
	}
}
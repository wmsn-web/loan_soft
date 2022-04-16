<?php /**
 * 
 */
class Login extends CI_controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->helper("slugifyhelp");
		if($this->session->userdata("userAdmin"))
		{
			return redirect(base_url('dashboard/'));
		}
	}

	public function index()
	{
		$this->load->view("dashboard/Login");
	}

	public function login_process()
	{
		$user = $this->input->post("user");
		$pass = $this->input->post("pass");

		$this->db->where(["user_admin"=>$user,"status"=>1]);
		$chk = $this->db->get("admin");
		if($chk->num_rows()==0)
		{
			$this->session->set_flashdata("err","Invalid Username or Password!");
			return redirect(back());
		}
		else
		{
			$row = $chk->row();
			if(password_verify($pass, $row->password))
			{
				$this->session->set_userdata("userAdmin",$row->id);
				$this->session->set_userdata("user_profile",$row);
				return redirect(base_url('dashboard/'));
			}
			else
			{
				$this->session->set_flashdata("err","Invalid Username or Password!");
				return redirect(back());
			}
		}
	}
}
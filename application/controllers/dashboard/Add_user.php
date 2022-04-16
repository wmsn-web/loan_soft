<?php /**
 * 
 */

class Add_user extends CI_controller
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
		$this->load->view("dashboard/Add_user");
	}

	public function save_user()
	{
		$inp = $this->input->post();
		$data['name'] = $inp['name'];
		$data['email'] = $inp['email'];
		$data['phone'] = $inp['phone'];
		$data['user_admin'] = $inp['user_admin'];
		$data['role'] = $inp['role'];
		$data['password'] = password_hash($inp['password'], PASSWORD_DEFAULT);
		$parm = array(
			"create_account"	=>@$inp['create_account'],
			"review_account"	=>@$inp['review_account'],
			"manage_repayment"	=>@$inp['manage_repayment'],
			"user_manage"		=>@$inp['user_manage'],
			"enquery"			=>@$inp['enquery']
		);
		$data['permissions'] = json_encode($parm,true);
		
		$this->db->where("email",$data['email']);
		$chkmail = $this->db->get("admin")->num_rows();
		$this->db->where("phone",$data['phone']);
		$chkmob = $this->db->get("admin")->num_rows();
		$this->db->where("user_admin",$data['user_admin']);
		$chkuser = $this->db->get("admin")->num_rows();

		if($chkuser > 0)
		{
			$this->session->set_flashdata("err","Username Already Exist!");
			return redirect(back());
		}
		elseif($chkmob > 0)
		{
			$this->session->set_flashdata("err","Phone Already Exist!");
			return redirect(back());
		}
		elseif($chkmail)
		{
			$this->session->set_flashdata("err","Email Already Exist!");
			return redirect(back());
		}
		else
		{
			$this->db->insert("admin",$data);
			$this->session->set_flashdata("Feed","User added Successfully");
			return redirect(back());
		}
	}

	public function update_user()
	{
		$id = $this->input->post('id');
		$inp = $this->input->post();
		$data['name'] = $inp['name'];
		$data['email'] = $inp['email'];
		$data['phone'] = $inp['phone'];
		$data['user_admin'] = $inp['user_admin'];
		$data['role'] = $inp['role'];
		
		$parm = array(
			"create_account"	=>@$inp['create_account'],
			"review_account"	=>@$inp['review_account'],
			"manage_repayment"	=>@$inp['manage_repayment'],
			"user_manage"		=>@$inp['user_manage'],
			"enquery"			=>@$inp['enquery']
		);
		$data['permissions'] = json_encode($parm,true);
		$this->db->where("id",$id);
		$this->db->update("admin",["permissions"=>null]);

		$this->db->where("id",$id);
		$this->db->update("admin",$data);
		$this->session->set_flashdata("Feed","User Updated Successfully");
		return redirect(back());
	}
}
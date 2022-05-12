<?php /**
 * 
 */
class Add_customer extends CI_controller
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
		$this->load->view("dashboard/Add_customer");
	}

	public function save_customer()
	{
		$data = $this->input->post();
		$this->db->where("pan_no",$data['pan_no']);
		$chk = $this->db->get("users")->num_rows();
		if($chk > 0)
		{
			$this->session->set_flashdata("err","User Already Exist!");
			return redirect(back());
		}
		else
		{
			$this->db->insert("users",$data);
			$this->session->set_flashdata("Feed","Customer Added Successfully");
			return redirect(back());
		}
	}

	public function update_customer()
	{
		$id = $this->input->post("id");
		$data = $this->input->post();
		$this->db->where("id",$id);
		$this->db->update("users",$data);
		$this->session->set_flashdata("Feed","Customer Updated Successfully");
		return redirect(back());
	}
}
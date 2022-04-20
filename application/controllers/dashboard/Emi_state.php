<?php 
/**
 * 
 */
class Emi_state extends CI_controller
{
	
	public function __construct()
	{
		parent::__construct();
		//$this->load->helper("slugifyhelp");
		if(!$this->session->userdata("userAdmin"))
		{
			return redirect(base_url('dashboard/Login'));
		}
	}

	public function index()
	{
		$this->load->view("dashboard/Emi_state",["loan_setup"=>loan_settings()]);

	}

	public function add_emi_state()
	{
		$data = $this->input->post();
		$this->db->where("month_num",$data['month_num']);
		$chk = $this->db->get("emi_states")->num_rows();
		if($chk > 0)
		{
			$this->session->set_flashdata("err","Month Already Exists!");
			return redirect(back());
		}
		else
		{
			$this->db->insert("emi_states",$data);
			$this->session->set_flashdata("Feed","Month Added Successfully");
			return redirect(back());
		}
	}

	public function delete_emi($id)
	{
		$this->db->where("id",$id);
		$this->db->delete("emi_states");
		$this->session->set_flashdata("Feed","EMI State Deleted Successfully");
		return redirect(back());
	}
}
<?php /**
 * 
 */
class Investors extends CI_controller
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
		$this->db->order_by("id","DESC");
		$data = $this->db->get("investors")->result_array();
		$this->load->view("dashboard/Investors",["data"=>$data]);
	}

	public function save_investor()
	{
		$data = $this->input->post();
		$this->db->where("mobile",$data['mobile']);
		$chk = $this->db->get("investors")->num_rows();
		if($chk > 0)
		{
			$this->session->set_flashdata("err","Mobile Number already Exists!");
			return redirect(back());
		}
		else
		{
			$this->db->insert("investors",$data);
			$this->session->set_flashdata("Feed","Investor Added Successfully");
			return redirect(back());
		}
	}

	public function Update_investor()
	{
		$id = $this->input->post("id");
		$data['investor_name'] = $this->input->post("investor_name");
		$data['email'] = $this->input->post("email");
		$data['mobile'] = $this->input->post("mobile");

		$this->db->where("mobile",$data['mobile']);
		$chk = $this->db->get("investors");
		if($chk->num_rows() > 0)
		{
			$row = $chk->row();
			if($row->id == $id)
			{
				$this->db->where("id",$id);
				$this->db->update("investors",$data);
				$this->session->set_flashdata("Feed","Investor Updated Successfully");
				return redirect(back());
			}
			else
			{
				$this->session->set_flashdata("err","Mobile number Already Exists!");
				return redirect(back());
			}
		}
		else
		{
			$this->db->where("id",$id);
			$this->db->update("investors",$data);
			$this->session->set_flashdata("Feed","Investor Updated Successfully");
			return redirect(back());
		}
	}

	public function deleteInvestor($id)
	{
		$this->db->where("id",$id);
		$this->db->delete("investors");
		$this->session->set_flashdata("Feed","Investor Deleted Successfully");
		return redirect(back());
	}
}
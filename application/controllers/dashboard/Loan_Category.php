<?php /**
 * 
 */
class Loan_Category extends CI_controller
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
		$data = $this->LoanApplicationModel->get_loan_types();
		$this->load->view("dashboard/Loan_Category",["loan_setup"=>$data]); 
	}
	public function edit_categories()
	{
		$id = $this->input->post("id");
		$data['type_name'] = $this->input->post("type_name");
		$data['loan_cat'] = $this->input->post("loan_cat");
		$data['down_payment'] = $this->input->post("down_payment");
		$data['type_slug'] = slugify($data['type_name']);

		$this->db->where("type_slug",$data['type_slug']);
		$gt = $this->db->get("loan_types");
		if($gt->num_rows() > 0)
		{
			$row = $gt->row();
			if($row->id == $id)
			{
				$this->db->where("id",$id);
				$this->db->update("loan_types",$data);
				$this->session->set_flashdata("Feed","Category Updated Successfully");
				return redirect(back());
			}
			else
			{
				$this->session->set_flashdata("err","Category Already Exists");
				return redirect(back());
			}
		}
		else
		{
			$this->db->where("id",$id);
			$this->db->update("loan_types",$data);
			$this->session->set_flashdata("Feed","Category Updated Successfully");
			return redirect(back());
		}
	}

	public function add_categories()
	{
		$data = $this->input->post();
		$data['type_slug'] = slugify($data['type_name']);
		$this->db->where("type_slug",$data['type_slug']);
		$gt = $this->db->get("loan_types")->num_rows();
		if($gt > 0)
		{
			$this->session->set_flashdata("err","Category Already Exists");
			return redirect(back());
		}
		else
		{
			$this->db->insert("loan_types",$data);
			$this->session->set_flashdata("Feed","Category Added Successfully");
			return redirect(back());
		}
	}
}
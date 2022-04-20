<?php /**
 * 
 */
class Agents extends CI_controller
{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model("AgentModels");
		if(!$this->session->userdata("userAdmin"))
		{
			return redirect(base_url('dashboard/Login'));
		}
	}	

	public function index()
	{
		$allAgents = $this->AgentModels->get_all_agents();
		$this->load->view("dashboard/Agents",["data"=>$allAgents]);
	}

	public function add_agents()
	{
		$data = $this->input->post();
		$this->db->where("mob",$data['mob']);
		$chk = $this->db->get("agents")->num_rows();
		if($chk > 0)
		{
			$this->session->set_flashdata("err","Mobile Number Already Exist!");
			return redirect(back());
		}
		else
		{
			$this->db->insert("agents",$data);
			$this->session->set_flashdata("Feed","Agent Added Successfully");
			return redirect(back());
		}
	}

	public function change_status($id)
	{
		$this->db->where("id",$id);
		$get = $this->db->get("agents")->row_array();
		if($get['status']==1)
		{
			$this->db->where("id",$id);
			$this->db->update("agents",["status"=>0]);
			return redirect(back());
		}
		else
		{
			$this->db->where("id",$id);
			$this->db->update("agents",["status"=>1]);
			return redirect(back());
		}
	}
/*
	public function import_database() {
	    $temp_line = '';
	    $lines = file(APPPATH.'/sql_data/loan_soft.sql'); 
	    //echo "<pre>";
	    //print_r($lines);
	    
	    foreach ($lines as $line)
	    {
	        if (substr($line, 0, 2) == '--' || $line == '' || substr($line, 0, 1) == '#')
	            continue;
	        $temp_line .= $line;
	        if (substr(trim($line), -1, 1) == ';')
	        {
	            $this->db->query($temp_line);
	            $temp_line = '';
	        }
	    }
	    
	}
	*/
}
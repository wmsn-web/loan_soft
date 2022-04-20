<?php /**
 * 
 */
class AgentModels extends CI_model
{
	
	public function get_all_agents()
	{
		$this->db->order_by("agent_name","ASC");
		$data = $this->db->get("agents")->result_array();
		return $data;
	}
}
<?php /**
 * 
 */
class CustomerModel extends CI_model
{
	
	public function get_customers()
	{
		$this->db->order_by("full_name","ASC");
		$data = $this->db->get("users")->result_array();
		return $data;
	}

	public function get_customers_by_id($id)
	{
		$this->db->where("id",$id);
		$data = $this->db->get("users")->row_array();
		return $data;
	}
}
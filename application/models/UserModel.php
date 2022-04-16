<?php /**
 * 
 */
class UserModel extends CI_model
{
	
	public function get_all_users()
	{
		$this->db->order_by("id","DESC");
		$this->db->where(["role!="=>"Super_admin"]);
		$data = $this->db->get("admin")->result_array();
		return $data;
	}

	public function get_user_by_id($id)
	{
		$this->db->where(["id"=>$id,"role!="=>"Super_admin"]);
		$data = $this->db->get("admin")->row_array();
		return $data;
	}
	public function get_profiles($id)
	{
		$this->db->where(["id"=>$id,"status"=>1]);
		$data = $this->db->get("admin")->row_array();
		return $data;
	}
}
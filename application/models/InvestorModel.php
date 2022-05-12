<?php /**
 * 
 */
class InvestorModel extends CI_model
{
	
	public function get_investorBYId($id)
	{
		$this->db->where("id",$id);
		$data = $this->db->get("investors")->row_array();
		return $data;
	}
}
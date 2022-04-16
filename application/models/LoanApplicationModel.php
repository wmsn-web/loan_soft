<?php /**
 * 
 */
class LoanApplicationModel extends CI_model
{
	
	public function get_loan_types()
	{
		$data = $this->db->get("loan_types")->result_array();
		return $data;
	}

	public function get_loan_data_by_id($application_id)
	{
		$this->db->where("application_id",$application_id);
		$getLoan = $this->db->get("loans")->row_array();
		return $getLoan;
	}

	public function get_docs($application_id)
	{
		$this->db->where("application_id",$application_id);
		$data = $this->db->get("loan_documents")->result_array();
		return $data;
	}
}
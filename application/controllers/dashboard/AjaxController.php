<?php /**
 * 
 */
class AjaxController extends CI_controller
{
	
	function __construct()
	{
		parent::__construct();
	}

	public function check_down_payment()
	{
		$conditions = $this->input->post();
		$this->db->where($conditions);
		$data = $this->db->get("loan_types")->row_array();
		echo json_encode($data);
	}

	public function validate_user()
	{
		$data = $this->input->post();
		$this->db->where($data);
		$num = $this->db->get("admin")->num_rows();
		echo $num;
	}
}
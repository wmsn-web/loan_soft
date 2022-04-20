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
	public function check_kyc_with_guarantor()
	{
		$field = $this->input->post("field");
		$apl_id = $this->input->post("apl_id");
		$vals = $this->input->post("vals");
		$data = array(
			$field => $vals,
			"application_id"=>$apl_id
		);

		$this->db->where($data);
		$chk = $this->db->get("loans")->num_rows();
		echo $chk;

	}

	public function get_interest()
	{
		$data = $this->input->post();
		$this->db->where($data);
		$get = $this->db->get("emi_states")->row_array();
		echo $get['int_rate'];
	}

	public function calculate_estimate_emi()
	{
		$ra = $this->input->post("ra");
		$pom = $this->input->post("pom");
		$roi = $this->input->post("roi");
		
		$monthlyIntr = $roi/12/100;
		$intBymonth = $monthlyIntr*$ra;
		$monthlyPrinc = $ra/$pom;
		$emi = $monthlyPrinc + $intBymonth;
		$totAmt = $emi*$pom;

		$data = array(
			"intr_month" => $intBymonth,
			"month_principal" => $monthlyPrinc,
			"emi"	=> $emi,
			"totAmt" =>$totAmt
		);
		echo json_encode($data,true);
	}

}
<?php /**
 * 
 */
class LoanApplicationModel extends CI_model
{
	
	public function get_loan_types()
	{
		$this->db->order_by("type_name","ASC");
		$data = $this->db->get("loan_types")->result_array();
		return $data;
	}

	public function get_loan_data_by_id($application_id='')
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

	public function get_submitted_loans($conditions)
	{
		$this->db->where($conditions);
		//$this->db->where("loan_status","pending");
		$data = $this->db->get("loans")->result_array();
		return $data;
	}

	public function get_disbursed_loans()
	{
		$this->db->where("loan_status","disbursed");
		$data = $this->db->get("loans")->result_array();
		return $data;
	}

	public function get_disbursed_loans_open()
	{
		$this->db->order_by("id","DESC");
		$this->db->where(["loan_status"=>"disbursed","closing_status"=>"open"]);
		$data = $this->db->get("loans")->result_array();
		return $data;
	}

	public function get_disbursed_loans_closed()
	{
		$this->db->order_by("id","DESC");
		$this->db->where(["loan_status"=>"disbursed","closing_status !="=>"open"]);
		$data = $this->db->get("loans")->result_array();
		return $data;
	}

	public function get_existing_users()
	{
		$this->db->order_by("full_name","ASC");
		$data = $this->db->get("users")->result_array();
		return $data; 
	}

	public function get_emis($loanAc)
	{
		$this->db->where("loan_no",$loanAc);
		$data = $this->db->get("loan_emis")->result_array();
		return $data;
	}

	public function emi_cronjob()
	{
		date_default_timezone_set('Asia/Kolkata');
		$lnSetup = loan_setup();
		$this->db->where("status","unpaid");
		$get = $this->db->get("loan_emis");
		if($get->num_rows()==0)
		{

		}
		else
		{
			$res = $get->result();
			foreach($res as $key)
			{
				$today = time();
				$payment_date = strtotime($key->payment_date);
				$diff = $today - $payment_date;
				$difDay = round($diff / (60 * 60 * 24));
				if($difDay > $lnSetup['maximum_days'])
				{
					$this->db->where("id",$key->id);
					$this->db->update("loan_emis",["extra_chgs"=>$lnSetup['repay_delay_chgs']]);
				}
			}
		}
	}

	public function check_loan_closing_status($loan_no)
	{
		$this->db->where("loan_ac_no",$loan_no);
		$data = $this->db->get("loans")->row_array();
		return $data;
	}

	public function get_forclose_data($loan_no)
	{
		$this->db->where("loan_no",$loan_no);
		$data = $this->db->get("loan_closing_status")->row_array();
		return $data;
	}
	
}
<?php /**
 * 
 */
class AccountModel extends CI_model
{
	
	public function get_transactions()
	{
		$this->db->order_by("id","DESC");
		$data = $this->db->get("transactions")->result_array();
		return $data;
	}

	public function get_fund_balance()
	{
		$get = $this->db->get("transactions");
		if($get->num_rows()==0)
		{
			$bal = 0;
		}
		else
		{
			$row = $get->row();
			

			$this->db->select_sum("in_amt");
			$in = $this->db->get("transactions")->row();
			$tot_in = $in->in_amt;

			$this->db->select_sum("out_amt");
			$out = $this->db->get("transactions")->row();
			$tot_out = $out->out_amt;

			$reamin = $tot_in - $tot_out;
			$bal = $reamin;
		}

		return $bal;
	}
}
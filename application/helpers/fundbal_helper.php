<?php 
if(!function_exists("fund_bal"))
{
	function fund_bal()
	{
		$CI = get_instance();
		$data = $CI->db->get("fund_wallet")->row_array();
		return $data['balance'];
	}
}

if(!function_exists("modify_fund_bal"))
{
	function modify_fund_bal($bal)
	{
		$CI = get_instance();
		$CI->db->update("fund_wallet",["balance"=>$bal]);
	}
}

if(!function_exists("investor_bal"))
{
	function investor_bal($id)
	{
		$CI = get_instance();
		$CI->db->where("id",$id);
		$data = $CI->db->get("investors")->row_array();
		return $data['wallet_balance'];
	}
}

if(!function_exists("modify_investor_bal"))
{
	function modify_investor_bal($id,$balance)
	{
		$CI = get_instance();
		$CI->db->where("id",$id);
		$data = $CI->db->update("investors",["wallet_balance"=>$balance]);
	}
}
<?php 
if(!function_exists('loan_settings')) {
  function loan_settings() { 
      
      $CI = get_instance();
      $CI->db->order_by("month_num","ASC");
      $get = $CI->db->get("emi_states")->result_array();
      return $get;
  } 
}

if(!function_exists('get_agents')) {
  function get_agents() { 
      
      $CI = get_instance();
      $CI->db->order_by("agent_name","ASC");
      $get = $CI->db->get("agents")->result_array();
      return $get;
  } 
}
if(!function_exists('all_final_docs'))
{
  function all_final_docs($application_id)
  {
    $CI = get_instance();
    $CI->db->where("application_id",$application_id);
    $data = $CI->db->get("final_docs")->result_array();
    return $data;
  }
}
if(!function_exists('loan_setup')) {
  function loan_setup() { 
      
      $CI = get_instance();
      $get = $CI->db->get("loan_setups")->row_array();
      return $get;
  } 
}

if(!function_exists('all_settings')) {
  function all_settings() { 
      
      $CI = get_instance();
      $get = $CI->db->get("settings")->row_array();
      return $get;
  } 
}

if(!function_exists('pdf_img_dir'))
{
  function pdf_img_dir($img,$dir)
  {
    $str = $_SERVER["DOCUMENT_ROOT"].'/myPro/loan_soft/uploads/'.$dir.'/'.$img;
    return $str;
  }
}
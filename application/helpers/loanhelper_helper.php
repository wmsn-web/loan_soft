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
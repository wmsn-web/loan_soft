<?php 
if(!function_exists('loan_settings')) {
  function loan_settings() { 
      
      $CI = get_instance();
      $CI->db->order_by("month_num","ASC");
      $get = $CI->db->get("emi_states")->result_array();
      return $get;
  } 
}
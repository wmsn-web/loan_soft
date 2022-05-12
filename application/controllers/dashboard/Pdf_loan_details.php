<?php /**
 * 
 */
class Pdf_loan_details extends CI_controller
{
	
	function __construct()
	{
		// code...
		parent::__construct();
		$this->load->library('Pdf');
	}
	
	public function pdf_view($id = '')
	{
		$this->db->where("id",$id);
		$datax = $this->db->get("loans")->row_array();
		$data['data'] = $datax;
		$this->load->view("pdf/loan_details_template",$data);

		$filename = $datax['application_id'];
		$html = $this->load->view("emails/test",$data,TRUE);
		$this->pdf->create($html, $filename);
		//$this->pdf->save_files($html,$filename);
	}
}
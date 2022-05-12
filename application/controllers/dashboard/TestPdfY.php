<?php /**
 * 
 */
set_time_limit(500); 
class TestPdfY extends CI_controller
{
	
	function __construct()
	{
		// code...
		parent::__construct();
		$this->load->library('Pdf');
	}
	
	public function index()
	{
		$this->db->where("id",2);
		$data['data'] = $this->db->get("loans")->row_array();
		//print_r($data);
		$this->load->view("emails/test",$data);

		//echo $_SERVER["DOCUMENT_ROOT"];
		
		$filename = "Document_name";
		$html = $this->load->view("emails/test",$data,TRUE);
		$this->pdf->create($html, $filename);
		
		
	}
}
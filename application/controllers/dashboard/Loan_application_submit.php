<?php /**
 * 
 */
class Loan_application_submit extends CI_controller
{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->helper("slugifyhelp");
		if(!$this->session->userdata("userAdmin"))
		{
			return redirect(base_url('dashboard/Login'));
		}
	}

	public function submit_step1()
	{
		$data = $this->input->post();
		$data['step'] = 2;
		$this->db->where("application_id",$data['application_id']);
		$chk = $this->db->get("loans")->num_rows();
		if($chk > 0)
		{
			$this->session->set_flashdata("err","Application Already Exist!");
			return redirect(back());
		}
		else
		{
			$this->db->insert("loans",$data);
			return redirect(base_url('dashboard/Apply_loan/create_account/step2/'.$data['application_id']));

		}
	}

	public function update_step1()
	{
		$data = $this->input->post();
		$loanData = $this->LoanApplicationModel->get_loan_data_by_id($data['application_id']);
		if($loanData['step'] < 2)
		{
			$data['step'] = 2;
		}
		$this->db->where("application_id",$data['application_id']);
		$chk = $this->db->get("loans")->num_rows();
		if($chk > 0)
		{
			$this->db->where("application_id",$data['application_id']);
			$this->db->update("loans",$data);
			$this->session->set_flashdata("Feed","Application Updated Successfully!");
			return redirect(base_url('dashboard/Apply_loan/create_account/step2/'.$data['application_id']));
			
		}
		else
		{
			
			return redirect(back());

		}
	}

	public function submit_step2()
	{
		$data['same_addr'] = "no";
		$data = $this->input->post();
		$loanData = $this->LoanApplicationModel->get_loan_data_by_id($data['application_id']);
		if($loanData['step'] < 3)
		{
			$data['step'] = 3;
		}
		$this->db->where("application_id",$data['application_id']);
		$chk = $this->db->get("loans")->num_rows();
		if($chk > 0)
		{
			$usr['full_name'] = $data['full_name'];
			$usr['gender'] = $data['gender'];
			$usr['dob'] = $data['dob'];
			$usr['cont_number'] = $data['cont_number'];
			$usr['email'] = $data['email'];
			$usr['adress'] = $data['adress'];
			$usr['city'] = $data['city'];
			$usr['pin'] = $data['pin'];
			$usr['state'] = $data['state'];
			$usr['same_addr'] = $data['same_addr'];
			$usr['r_adress'] = $data['r_adress'];
			$usr['r_city'] = $data['r_city'];
			$usr['r_pin'] = $data['r_pin'];
			$usr['r_state'] = $data['r_state'];
			$usr['v_id'] = $data['v_id'];
			$usr['adhar_no'] = $data['adhar_no'];
			$usr['pan_no'] = $data['pan_no'];

			$this->db->where("pan_no",$usr['pan_no']);
			$chkUser = $this->db->get("users")->num_rows();
			if($chkUser == 0)
			{
				$this->db->insert("users",$usr);
			}
			
			$pro_img = $_FILES['pro_img']['name'];
			if(!empty($pro_img))
			{
				$dir_name ='./uploads/'.$data['application_id'];
						if (!is_dir($dir_name)) {
						mkdir($dir_name);
					}
				$config['upload_path'] = './uploads/'.$data['application_id'].'/';
		        $config['max_size'] = '*';
				$config['allowed_types'] = 'png|jpg|PNG|JPG|jpeg|JPEG|gif|GIF'; 
				$config['remove_spaces'] = TRUE;
				$fileName = uniqid();
				$config['file_name'] = $fileName;
				$this->load->library('upload', $config);
				$this->load->library('upload', $config);
				if ( ! $this->upload->do_upload('pro_img'))
		        {
		        	$this->db->where("application_id",$data['application_id']);
					$this->db->update("loans",$data);
		            $error = array('error' => $this->upload->display_errors());
		            $this->session->set_flashdata("Feed",$this->upload->display_errors());
		            return redirect(back());
		                
		        }
		        else
		        {
		            $upload_data = $this->upload->data();
					$data['pro_img'] = $upload_data['file_name'];
					$this->db->where("application_id",$data['application_id']);
					$this->db->update("loans",$data);
					$this->session->set_flashdata("Feed","Application Updated Successfully!");
					return redirect(base_url('dashboard/Apply_loan/create_account/step3/'.$data['application_id']));
				}
			}
			else
			{
				$this->db->where("application_id",$data['application_id']);
				$this->db->update("loans",$data);
				return redirect(base_url('dashboard/Apply_loan/create_account/step3/'.$data['application_id']));
			}
			
		}
		else
		{
			$this->session->set_flashdata("err","Application Does Not Exist!");
			return redirect(back());
		}
	}

	public function submit_step3()
	{
		$data['g_same_addr'] = "no";
		$data = $this->input->post();
		$loanData = $this->LoanApplicationModel->get_loan_data_by_id($data['application_id']);
		if($loanData['step'] < 4)
		{
			$data['step'] = 4;
		}
		$this->db->where("application_id",$data['application_id']);
		$chk = $this->db->get("loans")->num_rows();
		if($chk > 0)
		{
			
			$pro_img = $_FILES['g_pro_img']['name'];
			if(!empty($pro_img))
			{
				$dir_name ='./uploads/'.$data['application_id'];
						if (!is_dir($dir_name)) {
						mkdir($dir_name);
					}
				$config['upload_path'] = './uploads/'.$data['application_id'].'/';
		        $config['max_size'] = '*';
				$config['allowed_types'] = 'png|jpg|PNG|JPG|jpeg|JPEG|gif|GIF'; 
				$config['remove_spaces'] = TRUE;
				$fileName = uniqid();
				$config['file_name'] = $fileName;
				$this->load->library('upload', $config);
				if ( ! $this->upload->do_upload('g_pro_img'))
		        {
		        	$this->db->where("application_id",$data['application_id']);
					$this->db->update("loans",$data);
		            $error = array('error' => $this->upload->display_errors());
		            $this->session->set_flashdata("Feed",$this->upload->display_errors());
		            return redirect(back());
		                
		        }
		        else
		        {
		            $upload_data = $this->upload->data();
					$data['g_pro_img'] = $upload_data['file_name'];
					$this->db->where("application_id",$data['application_id']);
					$this->db->update("loans",$data);
					return redirect(base_url('dashboard/Apply_loan/create_account/step3/'.$data['application_id']));
				}
			}
			else
			{
				$this->db->where("application_id",$data['application_id']);
				$this->db->update("loans",$data);
				return redirect(base_url('dashboard/Apply_loan/create_account/step4/'.$data['application_id']));
			}
			
		}
		else
		{
			$this->session->set_flashdata("err","Application Does Not Exist!");
			return redirect(back());
		}
	}
	public function upload_docs()
	{
		$application_id = $this->input->post("application_id");
		$data['doc_name'] = $this->input->post("doc_name");
		$data['application_id'] = $application_id;
		$loanData = $this->LoanApplicationModel->get_loan_data_by_id($data['application_id']);
		
		$dir_name ='./uploads/'.$application_id;
				if (!is_dir($dir_name)) {
				mkdir($dir_name);
			}
		$config['upload_path'] = './uploads/'.$application_id.'/';
        $config['max_size'] = '*';
		$config['allowed_types'] = 'png|jpg|PNG|JPG|jpeg|JPEG|gif|GIF'; 
		$config['remove_spaces'] = TRUE;
		$fileName = uniqid();
		$config['file_name'] = $fileName;
		$this->load->library('upload', $config);
		if ( ! $this->upload->do_upload('doc_img'))
        {
            $error = array('error' => $this->upload->display_errors());
            $this->session->set_flashdata("Feed",$this->upload->display_errors());
            return redirect(back());
                
        }
        else
        {
        	if($loanData['step'] < 5)
			{
				$datax['step'] = 5;
			}
			else
			{
				$datax['step'] = $loanData['step'];
			}
            $upload_data = $this->upload->data();
			$data['doc_img'] = $upload_data['file_name'];
			$this->db->insert("loan_documents",$data);
			$this->db->where("application_id",$application_id);
			$this->db->update("loans",$datax);
			return redirect(base_url('dashboard/Apply_loan/create_account/step4/'.$data['application_id']));
		}
	}

	public function update_step5()
	{
		$data = $this->input->post();
		$loanData = $this->LoanApplicationModel->get_loan_data_by_id($data['application_id']);
		if($loanData['step'] < 6)
			{
				$data['step'] = 6;
			}
			
		$this->db->where("application_id",$data['application_id']);
		$this->db->update("loans",$data);
		return redirect(back());

	}

	public function final_documents_upload()
	{
		$application_id = $this->input->post("application_id");
		$data['application_id'] = $application_id;
		$dir_name ='./uploads/'.$application_id;
				if (!is_dir($dir_name)) {
				mkdir($dir_name);
			}
		$config['upload_path'] = './uploads/'.$application_id.'/';
        $config['max_size'] = '*';
		$config['allowed_types'] = 'png|jpg|PNG|JPG|jpeg|JPEG|gif|GIF'; 
		$config['remove_spaces'] = TRUE;
		$fileName = uniqid();
		$config['file_name'] = $fileName;
		$this->load->library('upload', $config);
		if ( ! $this->upload->do_upload('docs'))
        {
            $error = array('error' => $this->upload->display_errors());
            $this->session->set_flashdata("err",$this->upload->display_errors());
            return redirect(back());
                
        }
        else
        {
        	
            $upload_data = $this->upload->data();
			$data['docs'] = $upload_data['file_name'];
			$this->db->insert("final_docs",$data);
			 return redirect(back());
		}
	}
}
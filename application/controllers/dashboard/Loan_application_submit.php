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
			$this->session->set_flashdata("err","Application Updated Successfully!");
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
				return redirect(base_url('dashboard/Apply_loan/create_account/step3/'.$data['application_id']));
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
            $upload_data = $this->upload->data();
			$data['doc_img'] = $upload_data['file_name'];
			$this->db->insert("loan_documents",$data);
			return redirect(base_url('dashboard/Apply_loan/create_account/step4/'.$data['application_id']));
		}
	}
}
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Infopages extends MY_Controller {
	
    public function __construct() {
		parent::__construct();
		$this->load->helper('file');
    }
	
	
	public function managesprivacypolicy()
    {
        /*$data['checkper'] = $this->Global_model->checkpermission('30',$_SESSION['user_ids']);   //print_r($data['checkper']);exit();
        if($data['checkper']['create_per'] == '2' && $data['checkper']['edit_per'] == '2')
        {
          redirect(base_url('dashboard'));
          exit();
        }*/   
        
       $data['menu_page'] = 'Settings'; 
       if ($this->input->server('REQUEST_METHOD') === 'POST') 
       {
         $this->form_validation->set_rules('dec_eng', my_caption('albm_dec_eng'), 'trim|required');
       	 $this->form_validation->set_rules('dec_mrt', my_caption('albm_dec_mrt'), 'trim|required');
       	 
       	 if ($this->form_validation->run() == TRUE)
	     {
		    
		    $res = $this->Global_model->save_infodetail('1','Privacy Policy');
			if ($res['result']) {
				$this->session->set_flashdata('flash_success', $res['message']);
				redirect(base_url('infopages/managesprivacypolicy'));
				exit();
			}
			else {
				$this->session->set_flashdata('flash_danger', $res['message']);
				
			}
		 }
		   
       } 
      
        $data['title1'] = 'Privacy Policy';
        $data['titlelinkstatus1'] = 'active';
        $data['titlelink1'] = '#';
      
        $data['abt_info'] = $this->db->where('infpg_id','1')->get('infopages')->row();
		my_load_view($this->setting->theme, 'Backend/infopages/policy', $data);
    }
    
    public function managestermscondition()
    {
        /*$data['checkper'] = $this->Global_model->checkpermission('30',$_SESSION['user_ids']);   //print_r($data['checkper']);exit();
        if($data['checkper']['create_per'] == '2' && $data['checkper']['edit_per'] == '2')
        {
          redirect(base_url('dashboard'));
          exit();
        }*/   
        
       $data['menu_page'] = 'Settings'; 
       if ($this->input->server('REQUEST_METHOD') === 'POST') 
       {
         $this->form_validation->set_rules('dec_eng', my_caption('albm_dec_eng'), 'trim|required');
       	 $this->form_validation->set_rules('dec_mrt', my_caption('albm_dec_mrt'), 'trim|required');
       	 
       	 if ($this->form_validation->run() == TRUE)
	     {
		    
		    $res = $this->Global_model->save_infodetail('2','Terms Condition');
			if ($res['result']) {
				$this->session->set_flashdata('flash_success', $res['message']);
				redirect(base_url('infopages/managestermscondition'));
				exit();
			}
			else {
				$this->session->set_flashdata('flash_danger', $res['message']);
				
			}
		 }
		   
       } 
      
        $data['title1'] = 'Privacy Policy';
        $data['titlelinkstatus1'] = 'active';
        $data['titlelink1'] = '#';
      
        $data['abt_info'] = $this->db->where('infpg_id','1')->get('infopages')->row();
		my_load_view($this->setting->theme, 'Backend/infopages/policy', $data);
    }
    
   
	public function manageprivacypolicy()
    {
        $data['title1'] = 'Privacy Policy';
        $data['titlelinkstatus1'] = 'active';
        $data['titlelink1'] = '';
        
       $data['menu_page'] = 'Superadmin Site Setting'; 
       if ($this->input->server('REQUEST_METHOD') === 'POST') 
       {
         $this->form_validation->set_rules('dec_eng', my_caption('albm_dec_eng'), 'trim|required');
       	
       	 
       	 if ($this->form_validation->run() == TRUE)
	     {
		    
		    $res = $this->Global_model->save_infodetail('6','Privacy Policy');
			if ($res['result']) {
				$this->session->set_flashdata('flash_success', $res['message']);
				redirect(base_url('infopages/manageprivacypolicy'));
				exit();
			}
			else {
				$this->session->set_flashdata('flash_danger', $res['message']);
				
			}
		 }
		   
       } 
      
        $data['abt_info'] = $this->db->where('infpg_id','6')->get('infopages')->row();
		my_load_view($this->setting->theme, 'Backend/infopages/adminpolicy', $data);
    }
	
	public function managetermcondition()
    {
        $data['title1'] = 'Terms & Condition';
        $data['titlelinkstatus1'] = 'active';
        $data['titlelink1'] = '';
        $data['menu_page'] = 'Superadmin Site Setting'; 
       if ($this->input->server('REQUEST_METHOD') === 'POST') 
       {
         $this->form_validation->set_rules('dec_eng', my_caption('albm_dec_eng'), 'trim|required');
       	 
       	 if ($this->form_validation->run() == TRUE)
	     {
		    
		    $res = $this->Global_model->save_infodetail('7','Terms & Condition');
			if ($res['result']) {
				$this->session->set_flashdata('flash_success', $res['message']);
				redirect(base_url('infopages/managetermcondition'));
				exit();
			}
			else {
				$this->session->set_flashdata('flash_danger', $res['message']);
				
			}
		 }
		   
       } 
      
        $data['abt_info'] = $this->db->where('infpg_id','7')->get('infopages')->row();
		my_load_view($this->setting->theme, 'Backend/infopages/adminterms', $data);
    }
	
	
	public function privacypolicy()
    {
       $data['menu_page'] = ''; 
       $data['page_title'] = 'Privacy Policy';
       $data['page_type'] = '1';
       $data['data_info'] = $this->db->where('infpg_id','6')->get('infopages')->row();
	   my_load_view($this->setting->theme, 'Backend/infopages/viewinfo', $data);
    }
    
    public function terms_condition()
    {
       $data['menu_page'] = ''; 
       $data['page_title'] = 'Terms & Condition';
       $data['page_type'] = '1';
       $data['data_info'] = $this->db->where('infpg_id','7')->get('infopages')->row();
	   my_load_view($this->setting->theme, 'Backend/infopages/viewinfo', $data);
    }
    
    public function faq()
    {
       $data['menu_page'] = ''; 
       $data['page_title'] = "FAQ's";
       $data['page_type'] = '2';
       
        $data['data_info'] = $this->db->order_by('faq_id','DESC')->get('faqadmin')->result();
		my_load_view($this->setting->theme, 'Backend/infopages/viewinfo', $data);
    }
	
	
	public function managefaq()
    {
       $data['title1'] = "FAQ's";
        $data['titlelinkstatus1'] = 'active';
        $data['titlelink1'] = '';
        
        $data['menu_page'] = 'Superadmin Site Setting'; 
        $data['info_data'] = $this->db->order_by('faq_id','DESC')->get('faqadmin')->result();
		my_load_view($this->setting->theme, 'Backend/infopages/list_adminfaq', $data);
    }
    
    
	public function managesfaq($id = null)
    {
       $data['title1'] = "FAQ's";
       $data['titlelinkstatus1'] = '';
       $data['titlelink1'] = base_url('infopages/managefaq');
       
       if($id == null)
       {
         $data['title2'] = "Add";
         $data['titlelinkstatus2'] = 'active';
         $data['titlelink2'] = '';  
       }
       else
       {
          $data['title2'] = "Edit";
          $data['titlelinkstatus2'] = 'active';
          $data['titlelink2'] = '';  
       }
       
        $data['menu_page'] = 'Superadmin Site Setting'; 
       if ($this->input->server('REQUEST_METHOD') === 'POST') 
       {
        
         $this->form_validation->set_rules('name_eng', 'Question', 'trim|required');
       	 $this->form_validation->set_rules('dec_eng', 'Answer', 'trim|required');
       	 
       	 
       	 if ($this->form_validation->run() == TRUE)
	     {
		    
		    $res = $this->Global_model->save_faq_admin($id);
			if ($res['result']) {
				$this->session->set_flashdata('flash_success', $res['message']);
				redirect(base_url('infopages/managefaq'));
				exit();
			}
			else {
				$this->session->set_flashdata('flash_danger', $res['message']);
				
			}
		 }
		   
       } 
      
        $data['data_info'] = $this->db->where('faq_id',$id)->get('faqadmin')->row();
		my_load_view($this->setting->theme, 'Backend/infopages/manage_adminfaq', $data);
    }
	
	public function deletefaq() {
	    $query_get = $this->db->get_where('faqadmin',array('faq_id'=>my_uri_segment(3)))->row(); 
        $value_sort = $query_get->faq_sort;
        $query_sort = $this->db->get_where('faqadmin',array('faq_sort >'=>$value_sort))->result_array(); 
     
        foreach($query_sort as $valdatafet)
        {
          $data['faq_sort'] = $valdatafet['faq_sort'] - 1;
          $this->db->where('faq_id',$valdatafet['faq_id']);
          $this->db->update('faqadmin',$data);
        }
		
		$act_type = 'Admin Faq Deleted';
		$act_module = 'Admin Faq Deleted';
		$act_modulename = $query_get->faq_que;
		$getdetail = $this->Global_model->getalldata('faq_id',my_uri_segment(3),'faqadmin');
	    $datadetail = json_encode($getdetail);
	    setactivity($act_type,$act_module,$act_modulename,$datadetail);
		setnotification($act_module,$act_modulename);
		
		$this->db->delete('faqadmin', array('faq_id'=>my_uri_segment(3)));
		echo '{"result":true, "title":"Deleted", "text":"You request has been completed", "redirect":"' . base_url('infopages/managefaq') . '"}';
	}
	
	public function SortFaq($str2,$str,$str1)
	{
	     
	     $this->db->set('faq_sort',$str);
	     $this->db->where('faq_id',$str1);
	     $this->db->update('faqadmin');
	}
	
	
	
}
?>
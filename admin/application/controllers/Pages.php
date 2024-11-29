<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends MY_Controller {
	
    public function __construct() {
		parent::__construct();
		$this->load->helper('file');
    }
	
	
	public function index() {
		redirect(base_url('pages/manageaboutus'));
	}
	

	public function manageaboutus()
    {
       $data['menu_page'] = 'Pages'; 
       /* $data['checkper'] = $this->Global_model->checkpermission('19',$_SESSION['user_ids']);   //print_r($data['checkper']);exit();
        if($data['checkper']['create_per'] == '2' && $data['checkper']['edit_per'] == '2')
        {
           redirect(base_url('dashboard'));
           exit();
        }
       */
       
       
       if ($this->input->server('REQUEST_METHOD') === 'POST') 
       {
         
         
         $this->form_validation->set_rules('vision', 'Vision', 'trim|required');
       	 /*$this->form_validation->set_rules('name_mrt', my_caption('albm_name_mrt'), 'trim|required');
       	 $this->form_validation->set_rules('dec_eng', my_caption('albm_dec_eng'), 'trim|required');
       	 $this->form_validation->set_rules('dec_mrt', my_caption('albm_dec_mrt'), 'trim|required');*/
       	 
       	 
       	 if ($this->form_validation->run() == TRUE)
	     {
		    
		    $res = $this->Global_model->save_about();
			if ($res['result']) {
				$this->session->set_flashdata('flash_success', $res['message']);
				redirect(base_url('pages/manageaboutus'));
				exit();
			}
			else {
				$this->session->set_flashdata('flash_danger', $res['message']);
				
			}
		 }
		   
       } 
      
        $data['abt_info'] = $this->db->where('id','1')->get('aboutus')->row();
		my_load_view($this->setting->theme, 'Backend/pages/about', $data);
    }
	
     public function managehighlights()
    {
        $data['title1'] = 'Highlights';
        $data['titlelinkstatus1'] = 'active';
        $data['titlelink1'] = '';
       
        $data['menu_page'] = 'Masters';                    
        $data['info_data'] = $this->db->order_by('id','desc')->get('highlights')->result();
		my_load_view($this->setting->theme, 'Backend/pages/highlights_list', $data);
    }
    public function managewhyus()
    {
        $data['title1'] = 'Why Choose Us';
        $data['titlelinkstatus1'] = 'active';
        $data['titlelink1'] = '';
       
        $data['menu_page'] = 'Masters';                    
        $data['info_data'] = $this->db->order_by('id','desc')->get('why_choose_us')->result();
		my_load_view($this->setting->theme, 'Backend/pages/whyus_list', $data);
    }
    public function manageourteam()
    {
        $data['title1'] = 'Our Team';
        $data['titlelinkstatus1'] = 'active';
        $data['titlelink1'] = '';
       
        $data['menu_page'] = 'Masters';                    
        $data['info_data'] = $this->db->order_by('id','desc')->get('our_team')->result();
		my_load_view($this->setting->theme, 'Backend/pages/ourteam_list', $data);
    }
    public function managetestimonial()
    {
        $data['title1'] = 'Testimonials';
        $data['titlelinkstatus1'] = 'active';
        $data['titlelink1'] = '';
       
        $data['menu_page'] = 'Masters';                    
        $data['info_data'] = $this->db->order_by('id','desc')->get('testimonials')->result();
		my_load_view($this->setting->theme, 'Backend/pages/testimonial_list', $data);
    }
    public function manageblog()
    {
        $data['title1'] = 'Blog';
        $data['titlelinkstatus1'] = 'active';
        $data['titlelink1'] = '';
       
        $data['menu_page'] = 'Masters';                    
        $data['info_data'] = $this->db->order_by('id','desc')->get('blogs')->result();
		my_load_view($this->setting->theme, 'Backend/pages/blog_list', $data);
    }
    public function manageadvertise2()
    {
        $data['title1'] = 'Advertise2';
        $data['titlelinkstatus1'] = 'active';
        $data['titlelink1'] = '';
       
        $data['menu_page'] = 'Masters';                    
        $data['info_data'] = $this->db->order_by('id','desc')->get('advertisement2')->result();
		my_load_view($this->setting->theme, 'Backend/pages/advertise2_list', $data);
    }
    public function manageadvertise1()
    {
        $data['title1'] = 'Advertise1';
        $data['titlelinkstatus1'] = 'active';
        $data['titlelink1'] = '';
       
        $data['menu_page'] = 'Masters';                    
        $data['info_data'] = $this->db->order_by('id','desc')->get('advertisement1')->result();
		my_load_view($this->setting->theme, 'Backend/pages/advertise1_list', $data);
    }
    public function manageadvertise3()
    {
        $data['title1'] = 'Advertise3';
        $data['titlelinkstatus1'] = 'active';
        $data['titlelink1'] = '';
       
        $data['menu_page'] = 'Masters';                    
        $data['info_data'] = $this->db->order_by('id','desc')->get('advertisement3')->result();
		my_load_view($this->setting->theme, 'Backend/pages/advertise3_list', $data);
    }
	public function manageshighlights($id = null)
    {
        $data['title1'] = 'Highlights';
        $data['titlelinkstatus1'] = '';
        $data['titlelink1'] = base_url('pages/managehighlights');
       
        if($id == null)
        {
          $data['title2'] = 'Add';
          $data['titlelinkstatus2'] = 'active';
          $data['titlelink2'] = '';  
        }
        else
        {
          $data['title2'] = 'Edit';
          $data['titlelinkstatus2'] = 'active';
          $data['titlelink2'] = '';  
        }
       
       $data['menu_page'] = 'Masters';
       if ($this->input->server('REQUEST_METHOD') === 'POST') 
       {
        
         $this->form_validation->set_rules('title', 'Title', 'trim|required');
       	 
       	 if($id == null)
       	 {
       	    $this->form_validation->set_rules('infopic', '', 'callback_file_check'); 
       	 }
       	 else
       	 {
       	     if(!empty($_FILES['infopic']['name']))
       	     {
       	        $this->form_validation->set_rules('infopic', '', 'callback_file_check');  
       	     }
       	 }
         
       	 
       	 
       	 
       	 if ($this->form_validation->run() == TRUE)
	     {
		   $res = $this->Global_model->save_highlights($id);
//                   echo $this->db->last_query();die;
		   if ($res['result']) {
				$this->session->set_flashdata('flash_success', $res['message']);
				redirect(base_url('pages/managehighlights'));
				exit();
			}
			else {
				$this->session->set_flashdata('flash_danger', $res['message']);
				
			}
		 }
		   
       } 
        
        $data['info_data'] = $this->db->where('id',$id)->get('highlights')->row();
		my_load_view($this->setting->theme, 'Backend/pages/highlights_manages', $data);
    }
    public function manageswhyus($id = null)
    {
        $data['title1'] = 'Why Choose Us';
        $data['titlelinkstatus1'] = '';
        $data['titlelink1'] = base_url('pages/managewhyus');
       
        if($id == null)
        {
          $data['title2'] = 'Add';
          $data['titlelinkstatus2'] = 'active';
          $data['titlelink2'] = '';  
        }
        else
        {
          $data['title2'] = 'Edit';
          $data['titlelinkstatus2'] = 'active';
          $data['titlelink2'] = '';  
        }
       
       $data['menu_page'] = 'Masters';
       if ($this->input->server('REQUEST_METHOD') === 'POST') 
       {
        
         $this->form_validation->set_rules('title', 'Title', 'trim|required');
       	 
       	 if($id == null)
       	 {
       	    $this->form_validation->set_rules('infopic', '', 'callback_file_check'); 
       	 }
       	 else
       	 {
       	     if(!empty($_FILES['infopic']['name']))
       	     {
       	        $this->form_validation->set_rules('infopic', '', 'callback_file_check');  
       	     }
       	 }
         
       	 
       	 
       	 
       	 if ($this->form_validation->run() == TRUE)
	     {
		   $res = $this->Global_model->save_whyus($id);
//                   echo $this->db->last_query();die;
		   if ($res['result']) {
				$this->session->set_flashdata('flash_success', $res['message']);
				redirect(base_url('pages/managewhyus'));
				exit();
			}
			else {
				$this->session->set_flashdata('flash_danger', $res['message']);
				
			}
		 }
		   
       } 
        
        $data['info_data'] = $this->db->where('id',$id)->get('why_choose_us')->row();
		my_load_view($this->setting->theme, 'Backend/pages/whyus_manages', $data);
    }
    public function managesourteam($id = null)
    {
        $data['title1'] = 'Our Team';
        $data['titlelinkstatus1'] = '';
        $data['titlelink1'] = base_url('pages/manageourteam');
       
        if($id == null)
        {
          $data['title2'] = 'Add';
          $data['titlelinkstatus2'] = 'active';
          $data['titlelink2'] = '';  
        }
        else
        {
          $data['title2'] = 'Edit';
          $data['titlelinkstatus2'] = 'active';
          $data['titlelink2'] = '';  
        }
       
       $data['menu_page'] = 'Masters';
       if ($this->input->server('REQUEST_METHOD') === 'POST') 
       {
        
         $this->form_validation->set_rules('title', 'Title', 'trim|required');
       	 
       	 if($id == null)
       	 {
       	    $this->form_validation->set_rules('infopic', '', 'callback_file_check'); 
       	 }
       	 else
       	 {
       	     if(!empty($_FILES['infopic']['name']))
       	     {
       	        $this->form_validation->set_rules('infopic', '', 'callback_file_check');  
       	     }
       	 }
         
       	 
       	 
       	 
       	 if ($this->form_validation->run() == TRUE)
	     {
		   $res = $this->Global_model->save_ourteam($id);
//                   echo $this->db->last_query();die;
		   if ($res['result']) {
				$this->session->set_flashdata('flash_success', $res['message']);
				redirect(base_url('pages/manageourteam'));
				exit();
			}
			else {
				$this->session->set_flashdata('flash_danger', $res['message']);
				
			}
		 }
		   
       } 
        
        $data['info_data'] = $this->db->where('id',$id)->get('our_team')->row();
		my_load_view($this->setting->theme, 'Backend/pages/ourteam_manages', $data);
    }
    
    public function managestestimonial($id = null)
    {
        $data['title1'] = 'Testimonials';
        $data['titlelinkstatus1'] = '';
        $data['titlelink1'] = base_url('pages/managetestimonial');
       
        if($id == null)
        {
          $data['title2'] = 'Add';
          $data['titlelinkstatus2'] = 'active';
          $data['titlelink2'] = '';  
        }
        else
        {
          $data['title2'] = 'Edit';
          $data['titlelinkstatus2'] = 'active';
          $data['titlelink2'] = '';  
        }
       
       $data['menu_page'] = 'Masters';
       if ($this->input->server('REQUEST_METHOD') === 'POST') 
       {
        
         $this->form_validation->set_rules('user_name', 'User Name', 'trim|required');
//         $this->form_validation->set_rules('user_designation', 'User Designation', 'trim|required');
         $this->form_validation->set_rules('short_desc', 'Comment', 'trim|required');
       	 
       	 if($id == null)
       	 {
       	    $this->form_validation->set_rules('infopic1', '', 'callback_file_check1'); 
       	 }
       	 else
       	 {
       	     if(!empty($_FILES['infopic1']['name']))
       	     {
       	        $this->form_validation->set_rules('infopic1', '', 'callback_file_check1');  
       	     }
       	 }
         
       	 
       	 
       	 
       	 if ($this->form_validation->run() == TRUE)
	     {
		   $res = $this->Global_model->save_testimonial($id);
//                   echo $this->db->last_query();die;
		   if ($res['result']) {
				$this->session->set_flashdata('flash_success', $res['message']);
				redirect(base_url('pages/managetestimonial'));
				exit();
			}
			else {
				$this->session->set_flashdata('flash_danger', $res['message']);
				
			}
		 }
		   
       } 
        
        $data['info_data'] = $this->db->where('id',$id)->get('testimonials')->row();
		my_load_view($this->setting->theme, 'Backend/pages/testimonial_manages', $data);
    }
    public function managesblog($id = null)
    {
        $data['title1'] = 'Blog';
        $data['titlelinkstatus1'] = '';
        $data['titlelink1'] = base_url('pages/manageblog');
       
        if($id == null)
        {
          $data['title2'] = 'Add';
          $data['titlelinkstatus2'] = 'active';
          $data['titlelink2'] = '';  
        }
        else
        {
          $data['title2'] = 'Edit';
          $data['titlelinkstatus2'] = 'active';
          $data['titlelink2'] = '';  
        }
       
       $data['menu_page'] = 'Masters';
       if ($this->input->server('REQUEST_METHOD') === 'POST') 
       {
        
         $this->form_validation->set_rules('title', 'Title', 'trim|required');
       	 $this->form_validation->set_rules('date', 'Date', 'required');
       	 if($id == null)
       	 {
       	    $this->form_validation->set_rules('infopic', '', 'callback_file_check'); 
       	 }
       	 else
       	 {
       	     if(!empty($_FILES['infopic']['name']))
       	     {
       	        $this->form_validation->set_rules('infopic', '', 'callback_file_check');  
       	     }
       	 }
         
       	 
       	 
       	 
       	 if ($this->form_validation->run() == TRUE)
	     {
		   $res = $this->Global_model->save_blog($id);
//                   echo $this->db->last_query();die;
		   if ($res['result']) {
				$this->session->set_flashdata('flash_success', $res['message']);
				redirect(base_url('pages/manageblog'));
				exit();
			}
			else {
				$this->session->set_flashdata('flash_danger', $res['message']);
				
			}
		 }
		   
       } 
        
        $data['info_data'] = $this->db->where('id',$id)->get('blogs')->row();
		my_load_view($this->setting->theme, 'Backend/pages/blog_manages', $data);
    }
    public function managesadvertise2($id = null)
    {
        $data['title1'] = 'Advertise2';
        $data['titlelinkstatus1'] = '';
        $data['titlelink1'] = base_url('pages/manageadvertise2');
       
        if($id == null)
        {
          $data['title2'] = 'Add';
          $data['titlelinkstatus2'] = 'active';
          $data['titlelink2'] = '';  
        }
        else
        {
          $data['title2'] = 'Edit';
          $data['titlelinkstatus2'] = 'active';
          $data['titlelink2'] = '';  
        }
       
       $data['menu_page'] = 'Masters';
       if ($this->input->server('REQUEST_METHOD') === 'POST') 
       {
        
         $this->form_validation->set_rules('title', 'Title', 'trim|required');
//       	 $this->form_validation->set_rules('date', 'Date', 'required');
       	 if($id == null)
       	 {
       	    $this->form_validation->set_rules('infopic', '', 'callback_file_check'); 
       	 }
       	 else
       	 {
       	     if(!empty($_FILES['infopic']['name']))
       	     {
       	        $this->form_validation->set_rules('infopic', '', 'callback_file_check');  
       	     }
       	 }
         
       	 
       	 
       	 
       	 if ($this->form_validation->run() == TRUE)
	     {
		   $res = $this->Global_model->save_advertise2($id);
//                   echo $this->db->last_query();die;
		   if ($res['result']) {
				$this->session->set_flashdata('flash_success', $res['message']);
				redirect(base_url('pages/manageadvertise2'));
				exit();
			}
			else {
				$this->session->set_flashdata('flash_danger', $res['message']);
				
			}
		 }
		   
       } 
        
        $data['info_data'] = $this->db->where('id',$id)->get('advertisement2')->row();
		my_load_view($this->setting->theme, 'Backend/pages/advertise2_manages', $data);
    }
    public function managesadvertise1($id = null)
    {
        $data['title1'] = 'Advertise1';
        $data['titlelinkstatus1'] = '';
        $data['titlelink1'] = base_url('pages/manageadvertise1');
       
        if($id == null)
        {
          $data['title2'] = 'Add';
          $data['titlelinkstatus2'] = 'active';
          $data['titlelink2'] = '';  
        }
        else
        {
          $data['title2'] = 'Edit';
          $data['titlelinkstatus2'] = 'active';
          $data['titlelink2'] = '';  
        }
       
       $data['menu_page'] = 'Masters';
       if ($this->input->server('REQUEST_METHOD') === 'POST') 
       {
        
         $this->form_validation->set_rules('link', 'Link', 'trim|required');
//       	 $this->form_validation->set_rules('date', 'Date', 'required');
       	 if($id == null)
       	 {
       	    $this->form_validation->set_rules('infopic', '', 'callback_file_check'); 
       	 }
       	 else
       	 {
       	     if(!empty($_FILES['infopic']['name']))
       	     {
       	        $this->form_validation->set_rules('infopic', '', 'callback_file_check');  
       	     }
       	 }
         
       	 
       	 
       	 
       	 if ($this->form_validation->run() == TRUE)
	     {
		   $res = $this->Global_model->save_advertise1($id);
//                   echo $this->db->last_query();die;
		   if ($res['result']) {
				$this->session->set_flashdata('flash_success', $res['message']);
				redirect(base_url('pages/manageadvertise1'));
				exit();
			}
			else {
				$this->session->set_flashdata('flash_danger', $res['message']);
				
			}
		 }
		   
       } 
        
        $data['info_data'] = $this->db->where('id',$id)->get('advertisement1')->row();
		my_load_view($this->setting->theme, 'Backend/pages/advertise1_manages', $data);
    }
    public function managesadvertise3($id = null)
    {
        $data['title1'] = 'Advertise3';
        $data['titlelinkstatus1'] = '';
        $data['titlelink1'] = base_url('pages/manageadvertise3');
       
        if($id == null)
        {
          $data['title2'] = 'Add';
          $data['titlelinkstatus2'] = 'active';
          $data['titlelink2'] = '';  
        }
        else
        {
          $data['title2'] = 'Edit';
          $data['titlelinkstatus2'] = 'active';
          $data['titlelink2'] = '';  
        }
       
       $data['menu_page'] = 'Masters';
       if ($this->input->server('REQUEST_METHOD') === 'POST') 
       {
        
         $this->form_validation->set_rules('link', 'Link', 'trim|required');
//       	 $this->form_validation->set_rules('date', 'Date', 'required');
       	 if($id == null)
       	 {
       	    $this->form_validation->set_rules('infopic', '', 'callback_file_check'); 
       	 }
       	 else
       	 {
       	     if(!empty($_FILES['infopic']['name']))
       	     {
       	        $this->form_validation->set_rules('infopic', '', 'callback_file_check');  
       	     }
       	 }
         
       	 
       	 
       	 
       	 if ($this->form_validation->run() == TRUE)
	     {
		   $res = $this->Global_model->save_advertise3($id);
//                   echo $this->db->last_query();die;
		   if ($res['result']) {
				$this->session->set_flashdata('flash_success', $res['message']);
				redirect(base_url('pages/manageadvertise3'));
				exit();
			}
			else {
				$this->session->set_flashdata('flash_danger', $res['message']);
				
			}
		 }
		   
       } 
        
        $data['info_data'] = $this->db->where('id',$id)->get('advertisement3')->row();
		my_load_view($this->setting->theme, 'Backend/pages/advertise3_manages', $data);
    }
	public function file_check($str){
        $allowed_mime_type_arr = array('jpg','jpeg','png','x-png');
        
        $mime = pathinfo($_FILES['infopic']['name'], PATHINFO_EXTENSION);     
        if(isset($_FILES['infopic']['name']) && $_FILES['infopic']['name']!=""){
            if(in_array($mime, $allowed_mime_type_arr)){
                $flssize = $_FILES['infopic']['size'];
                if($flssize > $this->setting->imgfilesize)
                {
                  $this->form_validation->set_message('file_check', $this->setting->imgfilesizeerrormsg);
                  return false;  
                }
                return true;
            }else{
                $this->form_validation->set_message('file_check', 'Please select only jpg/png/jpeg file.');
                return false;
            }
        }else{
            $this->form_validation->set_message('file_check', 'Please choose a file to upload.');
            return false;
        }
    }
    public function file_check1($str){
        $allowed_mime_type_arr = array('jpg','jpeg','png','x-png','mp4');
        
        $mime = pathinfo($_FILES['infopic1']['name'], PATHINFO_EXTENSION);     
        if(isset($_FILES['infopic1']['name']) && $_FILES['infopic1']['name']!=""){
            if(in_array($mime, $allowed_mime_type_arr)){
                $flssize = $_FILES['infopic1']['size'];
                if($flssize > 10485800)
                {
                  $this->form_validation->set_message('file_check1', 'File Size too Long. Please Upload Maximum 10MB File.');
                  return false;  
                }
                return true;
            }else{
                $this->form_validation->set_message('file_check1', 'Please select only jpg/png/jpeg/mp4 file.');
                return false;
            }
        }else{
            $this->form_validation->set_message('file_check1', 'Please choose a file to upload.');
            return false;
        }
    }
	public function removeimage()
	{
	    $get_data = $this->db->where(array('id'=>my_uri_segment(3)))->get('highlights')->row();
	    unlink($get_data->image);
	    
	    $get_data = $this->db->where(array('id'=>my_uri_segment(3)))->set('image','')->update('highlights');
		echo '{"result":true, "title":"Deleted", "text":"You request has been completed", "redirect":"' . base_url('pages/manageshighlights/'.my_uri_segment(3)) . '"}';
	}
        public function removeimage1()
	{
	    $get_data = $this->db->where(array('id'=>my_uri_segment(3)))->get('why_choose_us')->row();
	    unlink($get_data->image);
	    
	    $get_data = $this->db->where(array('id'=>my_uri_segment(3)))->set('image','')->update('why_choose_us');
		echo '{"result":true, "title":"Deleted", "text":"You request has been completed", "redirect":"' . base_url('pages/manageswhyus/'.my_uri_segment(3)) . '"}';
	}
        public function removeimage2()
	{
	    $get_data = $this->db->where(array('id'=>my_uri_segment(3)))->get('our_team')->row();
	    unlink($get_data->image);
	    
	    $get_data = $this->db->where(array('id'=>my_uri_segment(3)))->set('image','')->update('our_team');
		echo '{"result":true, "title":"Deleted", "text":"You request has been completed", "redirect":"' . base_url('pages/managesourteam/'.my_uri_segment(3)) . '"}';
	}
        public function removeimage5()
	{
	    $get_data = $this->db->where(array('id'=>my_uri_segment(3)))->get('testimonials')->row();
//	    unlink($get_data->user_image);
	    
	    $get_data = $this->db->where(array('id'=>my_uri_segment(3)))->set('user_image','')->update('testimonials');
		echo '{"result":true, "title":"Deleted", "text":"You request has been completed", "redirect":"' . base_url('pages/managestestimonial/'.my_uri_segment(3)) . '"}';
	}
        public function removeimage3()
	{
	    $get_data = $this->db->where(array('id'=>my_uri_segment(3)))->get('blogs')->row();
	    unlink($get_data->image);
	    
	    $get_data = $this->db->where(array('id'=>my_uri_segment(3)))->set('image','')->update('blogs');
		echo '{"result":true, "title":"Deleted", "text":"You request has been completed", "redirect":"' . base_url('pages/managesblog/'.my_uri_segment(3)) . '"}';
	}
        public function removeimage4()
	{
	    $get_data = $this->db->where(array('id'=>my_uri_segment(3)))->get('advertisement2')->row();
	    unlink($get_data->image);
	    
	    $get_data = $this->db->where(array('id'=>my_uri_segment(3)))->set('image','')->update('advertisement2');
		echo '{"result":true, "title":"Deleted", "text":"You request has been completed", "redirect":"' . base_url('pages/managesadvertise2/'.my_uri_segment(3)) . '"}';
	}
   
	public function deletehighlights()
    {
        
        $this->db->where("id",my_uri_segment(3));
        $this->db->delete('highlights');
		echo '{"result":true, "title":"Deleted", "text":"You request has been completed", "redirect":"' . base_url('pages/managehighlights') . '"}';
    }
    public function deletewhyus()
    {
        
        $this->db->where("id",my_uri_segment(3));
        $this->db->delete('why_choose_us');
		echo '{"result":true, "title":"Deleted", "text":"You request has been completed", "redirect":"' . base_url('pages/managewhyus') . '"}';
    }
    public function deleteourteam()
    {
        
        $this->db->where("id",my_uri_segment(3));
        $this->db->delete('our_team');
		echo '{"result":true, "title":"Deleted", "text":"You request has been completed", "redirect":"' . base_url('pages/manageourteam') . '"}';
    }
    public function deletetestimonial()
    {
        
        $this->db->where("id",my_uri_segment(3));
        $this->db->delete('testimonials');
		echo '{"result":true, "title":"Deleted", "text":"You request has been completed", "redirect":"' . base_url('pages/managetestimonial') . '"}';
    }
    public function deleteblog()
    {
        
        $this->db->where("id",my_uri_segment(3));
        $this->db->delete('blogs');
		echo '{"result":true, "title":"Deleted", "text":"You request has been completed", "redirect":"' . base_url('pages/manageblog') . '"}';
    }
    public function deleteadvertise2()
    {
        
        $this->db->where("id",my_uri_segment(3));
        $this->db->delete('advertisement2');
		echo '{"result":true, "title":"Deleted", "text":"You request has been completed", "redirect":"' . base_url('pages/manageadvertise2') . '"}';
    }
    public function deleteadvertise1()
    {
        
        $this->db->where("id",my_uri_segment(3));
        $this->db->delete('advertisement1');
		echo '{"result":true, "title":"Deleted", "text":"You request has been completed", "redirect":"' . base_url('pages/manageadvertise1') . '"}';
    }
    public function deleteadvertise3()
    {
        
        $this->db->where("id",my_uri_segment(3));
        $this->db->delete('advertisement3');
		echo '{"result":true, "title":"Deleted", "text":"You request has been completed", "redirect":"' . base_url('pages/manageadvertise3') . '"}';
    }
}
?>
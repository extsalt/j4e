<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Packages extends MY_Controller {
	
    public function __construct() {
		parent::__construct();
		$this->load->helper('file');
		$this->load->model('Package_model');
    }
	
	
	
	public function index() {
		redirect(base_url('packages/managepackage'));
	}
	
	
    public function managepackage()
    {
        $data['title1'] = 'Package';
        $data['titlelinkstatus1'] = 'active';
        $data['titlelink1'] = '';
        
        $data['menu_page'] = 'Packages';  
        $data['pack_data'] = $this->db->order_by('pack_id','asc')->get('packages')->result();
		my_load_view($this->setting->theme, 'Backend/packages/list_package', $data);
    }
    
    public function managespackage($id = null)
    {
        $data['title1'] = 'Package';
        $data['titlelinkstatus1'] = '';
        $data['titlelink1'] = base_url('packages/managepackage');
       
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
       
       $data['menu_page'] = 'Packages';  
       if ($this->input->server('REQUEST_METHOD') === 'POST') 
       {
        
         $this->form_validation->set_rules('pack_name', my_caption('pack_name'), 'trim|required|max_length[50]');
       	 $this->form_validation->set_rules('pack_desc', my_caption('pack_desc'), 'trim|required');
       	 $this->form_validation->set_rules('pack_duration', my_caption('pack_duration'), 'trim|required');
       	 $this->form_validation->set_rules('pack_price', my_caption('pack_price'), 'trim|required|numeric|max_length[6]');
       	 
       	 if ($this->form_validation->run() == TRUE)
	     {
		   //  $data = $this->input->post();
    	// print_r($data);
    	// die();
		    $res = $this->Package_model->save_package($id);
		      // print_r($res);
    	// die();
			if ($res['result']) {
				$this->session->set_flashdata('flash_success', $res['message']);
				redirect(base_url('packages/managepackage'));
				exit();
			}
			else {
				$this->session->set_flashdata('flash_danger', $res['message']);
				
			}
		 }
		   
       } 
        $data['fet_info'] = $this->db->get('features')->result();
        $data['pack_info'] = $this->db->where('ids',$id)->get('packages')->row();
		my_load_view($this->setting->theme, 'Backend/packages/manage_packages', $data);
    }
	
	public function deletepackage() {
            $info = $this->db->where('ids',my_uri_segment(3))->get('packages')->row();
            $pinfo = $this->db->where('seq_no >',$info->seq_no)->get('packages')->result();
            if(!empty($pinfo))
            {
                foreach ($pinfo as $v)
                {
                    $sno = $v->seq_no - 1;
                    $q = $this->db->set('seq_no',$sno)->where('pack_id',$v->pack_id)->update('packages');
                }
            }
		$this->db->delete('packages', array('ids'=>my_uri_segment(3)));
		echo '{"result":true, "title":"Deleted", "text":"You request has been completed", "redirect":"' . base_url('packages/managepackage') . '"}';
	}
	
	
	
	public function managefeature()
    {
        $data['title1'] = 'Packages';
        $data['titlelinkstatus1'] = '';
        $data['titlelink1'] = base_url('packages');
        
        $data['title2'] = 'Feature';
        $data['titlelinkstatus2'] = 'active';
        $data['titlelink2'] = base_url('packages/managefeature');
        
        $data['menu_page'] = 'Packages'; 
        $data['fet_data'] = $this->db->order_by('feature_order','asc')->get('features')->result();
		my_load_view($this->setting->theme, 'Backend/packages/list_feature', $data);
    }

    public function reorderfeature()
    {
        $data['menu_page'] = 'Packages'; 
    	$data = $this->input->post('page_id_array');
    	// print_r($data);
    	// die();
    	 for($count = 0;  $count < count($data); $count++)
		  {
		  	$res = $this->Package_model->update_package($count+1,$data[$count]);
		  	// echo $data[$count];
		   // $abc[] = $count;
		  	// echo $data['count'];
		   // echo $count;
		   // echo $count+1;
		  }
		  // print_r($count);
    // }
		// my_load_view($this->setting->theme, 'Backend/packages/list_feature', $data);
    }
	
	public function managesfeature($id = null)
    {$data['menu_page'] = 'Packages'; 
       
        $data['title1'] = 'Packages';
        $data['titlelinkstatus1'] = '';
        $data['titlelink1'] = base_url('packages');
        
        $data['title2'] = 'Feature';
        $data['titlelinkstatus2'] = '';
        $data['titlelink2'] = base_url('packages/managefeature');
       
         if($id == null)
         {
           $data['title3'] = 'Add';
           $data['titlelinkstatus3'] = 'active';
           $data['titlelink3'] = '';
         
         }
         else
         {
           $data['title3'] = 'Edit';
           $data['titlelinkstatus3'] = 'active';
           $data['titlelink3'] = ''; 
         }
       
       if ($this->input->server('REQUEST_METHOD') === 'POST') 
       {
        
         $this->form_validation->set_rules('fet_name', my_caption('fet_name'), 'trim|required|max_length[50]');
       	
       	 
       	 if ($this->form_validation->run() == TRUE)
	     {
		    
		    $res = $this->Package_model->save_feature($id);  
			if ($res['result']) {
				$this->session->set_flashdata('flash_success', $res['message']);
				redirect(base_url('packages/managefeature'));
				exit();
			}
			else {
				$this->session->set_flashdata('flash_danger', $res['message']);
				
			}
		 }
		   
       } 
      
        $data['fet_info'] = $this->db->where('ids',$id)->get('features')->row();
		my_load_view($this->setting->theme, 'Backend/packages/manage_feature', $data);
    }
    
    public function deletefeature() {
		$this->db->delete('features', array('ids'=>my_uri_segment(3)));
		echo '{"result":true, "title":"Deleted", "text":"You request has been completed", "redirect":"' . base_url('packages/managefeature') . '"}';
	}
	public function update_package_sequence(){
        $postData = $this->input->post('seq');
//        print_r($postData);
        if(!empty($postData))
        {
            for($i=0;$i<count($postData);$i++)
            {
                $q = $this->db->set('seq_no',$postData[$i]['new_seq'])->where('pack_id',$postData[$i]['pack_id'])->update('packages');
            }
        }
        echo true;
//        $data = $this->product_model->getProductList($postData);
//        echo json_encode($data);
    } 
}
?>
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Global_model extends CI_Model {



	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set($this->config->item('time_reference'));
	}
	
		public function getrolename($roleids)
	{
	    $query = $this->db->get_where('role',array('ids'=>$roleids))->row();
	    return $query->name;
	}
	
	public function get_menu($menu_parent)
	{
	   return $this->db->order_by('menu_sort','ASC')->get_where('menu',array('menu_parent'=>$menu_parent,'menu_status'=>1));
	}

	public function get_menu_form()
	{
	   return $this->db->get('menu');
	}

    public function check_permission($parent_id,$role_id)
    {
       return $this->db->get_where('module_permission',array('menu_id'=>$parent_id,'role_id'=>$role_id))->row_array(); 
    }
    
    
    public function save_faq_admin($id)
    {
		$ids = my_random();     
		              $this->db->order_by('faq_sort','DESC');
		$get_roleid = $this->db->get('faqadmin')->row();
		
		$form_data['faq_que'] = my_post('name_eng');
		$form_data['faq_ans'] = my_post('dec_eng');
			
		 	
		    if($id == null)
		    {
		       
		        $form_data['faq_sort'] = $get_roleid->faq_sort + '1';
		        $this->db->insert('faqadmin',$form_data);
		        $message =  'Admin Faq Added';
				$act_type = 'Admin Faq';
    		    $act_module = $message;
    		    $act_modulename = $form_data['faq_que'];
    		    $datadetail = json_encode($form_data); 		        
				return array('result'=>TRUE, 'message'=>$message);
		    }
		    else
		    {
		       
		        $this->db->where('faq_id',$id);
		        $this->db->update('faqadmin',$form_data);
		        $message = 'Admin Faq Edited';
				
    		    $act_type = 'Admin Faq';
    		    $act_module = $message;
    		    $act_modulename = $form_data['faq_que'];
    		    $datadetail = json_encode($form_data); 		        
				return array('result'=>TRUE, 'message'=>$message);
		    }
		
		 
	}
    
    public function save_turn_over($id)
    {
		  $form_data['turn_over_value'] = my_post('event_title');
		   if($id == null)
		    {
		        $query = $this->db->insert('turn_over',$form_data);
		        $message = 'Turn Over Added';
				
				return array('result'=>TRUE, 'message'=>$message);
		    }
		    else
		    {
		       $this->db->where('turn_over_id',$id);
		        $this->db->update('turn_over',$form_data);
		        $message = 'Turn Over Edited';
				
		        
				
				return array('result'=>TRUE, 'message'=>$message);
		    }
		
		 
	}
    
    
    
    public function save_eventcategory($id)
    {
		  $form_data['event_cat_name'] = my_post('event_title');
		  $form_data['event_j4e_meet'] = my_post('is_global');
		  
		   
		  
		   
		    if($id == null)
		    {
		        $query = $this->db->insert('event_category',$form_data);
		        $message = 'Event Category Added';
				
				return array('result'=>TRUE, 'message'=>$message);
		    }
		    else
		    {
		       
		        $this->db->where('event_cat_id',$id);
		        $this->db->update('event_category',$form_data);
		        $message = 'Event Category Edited';
				
		        
				
				return array('result'=>TRUE, 'message'=>$message);
		    }
		
		 
	}
	
    public function save_infodetail($id,$type)
    {
		
		$form_data['infpg_desc_eng'] = my_post('dec_eng');
		$form_data['infpg_desc_mrt'] = my_post('dec_mrt');
		
		if(!empty($_FILES['infopic']['name']))
        {
          $config['upload_path'] = 'upload/general/';
          $config['allowed_types'] = 'jpg|jpeg|png|gif';
          $config['file_name'] = 'TYPE-'.$date_string.$ids;
                
          $this->load->library('upload',$config);
          $this->upload->initialize($config);
                
          if($this->upload->do_upload('infopic'))
          {
            $uploadData = $this->upload->data();
            $pub_type_img = 'upload/general/'.$uploadData['file_name'];
          }
          else
          {
            $pub_type_img = 'upload/noimage.png';
          }
        }
        else
        {
            $pub_type_img = 'upload/noimage.png';
        }
		
		if($id == '5')
		{
		    $form_data['infpg_image'] = $pub_type_img;
		}
		
		
		$this->db->where('infpg_id',$id);
		$this->db->update('infopages',$form_data);
		$message = $type.' Edited';
		
    	$act_type = $type;
    	$act_module = $message;
    	$act_modulename = $type.' Detail';
    	$datadetail = json_encode($form_data); 		        
		return array('result'=>TRUE, 'message'=>$message);
	}
    
    
    public function save_about()
    {
		$ids = my_random();                  
			
		
		//echo $this->input->post('shortaboutdetail', FALSE);exit();
		
			
			$form_data['vision'] =$this->input->post('vision', FALSE); // my_post('dec_eng');
			$form_data['mission'] = $this->input->post('mission', FALSE); //my_post('dec_mrt');
			$form_data['achievement'] =$this->input->post('achievement', FALSE); // my_post('dec_eng');
			$form_data['details'] = $this->input->post('aboutdetail', FALSE); //my_post('dec_mrt');
			$form_data['shortabout'] = $this->input->post('shortaboutdetail', FALSE);
			$form_data['email'] =$this->input->post('email', FALSE); // my_post('dec_eng');
			$form_data['phonenumber'] = $this->input->post('contactno', FALSE); //my_post('dec_mrt');
			$form_data['whatsappnumber'] =$this->input->post('whatsappno', FALSE); // my_post('dec_eng');
			$form_data['website'] = $this->input->post('website', FALSE); //my_post('dec_mrt');
			$form_data['address'] = $this->input->post('address', FALSE); //my_post('dec_mrt');
		    $form_data['longitude'] = $this->input->post('longitude', FALSE);
		    $form_data['latitude'] = $this->input->post('latitude', FALSE);
		 	$form_data['maplink'] = $this->input->post('maplink', FALSE);
		 	$form_data['facebook'] = $this->input->post('facebook', FALSE);
		 	$form_data['twitter'] = $this->input->post('twitter', FALSE);
		 	$form_data['linkdin'] = $this->input->post('linkdin', FALSE);
		    
		    $this->db->where('id','1');
		    $this->db->update('aboutus',$form_data);
		    $message = 'Details Edited';
		    
		    
			return array('result'=>TRUE, 'message'=>$message);
		    
		
		 
	}


    public function save_event($id)
    {
		   $userids = $this->db->select('id')->get_where("user",array("ids"=>$_SESSION['user_ids']))->row();          			      
 
            $starttimesss= my_post('event_start_time');
            $endtimesss= my_post('event_end_time');
 
           
		    $startdate = date("Y-m-d", strtotime(my_post('event_start_date'))); 
		    $startnewdate = date("d M Y", strtotime(my_post('event_start_date'))); 
		    $startdates = date("D", strtotime($startdate)).', '.$startnewdate. ' '. date("g:i a", strtotime("$starttimesss UTC"));; 
		    
		    $enddate = date("m/d/Y", strtotime(my_post('event_end_date'))); 
		    $endnewdate = date("d M Y", strtotime(my_post('event_end_date'))); 
		    $ensdates = date("D", strtotime($enddate)).', '.$endnewdate. ' '. date("g:i a", strtotime("$endtimesss UTC"));; 
		        
		    $form_data['event_userid'] = $userids->id;
		    $form_data['event_cat_id'] = my_post('event_cat_id');
		    $form_data['event_title'] = my_post('event_title');
		    $form_data['event_description'] = my_post('dec_eng');     
		    $form_data['event_address'] = my_post('evt_address');
		    $form_data['event_date'] = $startdate; 
		    $form_data['event_startdate'] = $startdates; 
		    $form_data['event_enddate'] = $ensdates; 
		    $form_data['event_fees'] = my_post('evt_fee'); 
		    $form_data['event_guestfees'] = my_post('evt_guest_fee'); 
		    $form_data['event_ticketqty'] = my_post('evt_qty'); 
		    //$form_data['event_thumbnil'] = my_post('evt_times_mod');
		    $form_data['event_creatdate'] = date('Y-m-d');
		    $form_data['event_creattime'] = date('H:i:s');
                    $form_data['event_permission'] = implode(',', my_post('event_permisssion'));
		   
		    if($id == null)
		    {
		       date_default_timezone_set('Asia/Kolkata');
               $currentTime = date( 'd-m-Y h:i:s A', time () );
               $date_string = strtotime($currentTime);
                if(!empty($_FILES['infopic']['name']))
                {
                  $config['upload_path'] = 'upload/events/';
                  $config['allowed_types'] = 'jpg|jpeg|png|gif|svg';
                  $config['file_name'] = $date_string;
                
                  $this->load->library('upload',$config);
                  $this->upload->initialize($config);
                
                  if($this->upload->do_upload('infopic'))
                  {
                    $uploadData = $this->upload->data();
                    $sld_img = $uploadData['file_name'];
                  }
                  else
                  {
                    $sld_img = 'noimage.png';
                  }
                }else{
                    $sld_img = 'noimage.png';
                }
		       
		        
		        $form_data['event_thumbnil'] = $sld_img;
		        $query = $this->db->insert('events',$form_data);
		        $message = 'Event Added';
				
				
				if($query)
				{
				    $evtids = $this->db->insert_id();
                                    $rs_email = $this->db->where('purpose', 'invitation')->get('email_template')->row(); 
            $event_info = $this->db->where('event_id',$evtids)->get('events')->row();
            $web_setting = $this->db->get('website_settings')->row();
            $setting = my_global_setting('all_fields');
            $data['setting'] = $setting;
            $data['web_setting'] = $web_setting;
            $data['template'] = $rs_email;
            $data['event'] = $event_info;
            $CI = &get_instance();
                        $body = $CI->load->view('themes/default/Mail/event_invitation', $data,true);
//            echo $body;
            $user_info = $this->db->where_in('membership_type',array('1','2'))->where('user_delete','1')->get('user')->result();
            if(!empty($user_info))
            {
                foreach($user_info as $val)
                {
            $email = array(
			  'email_to' => $val->email_address,
			  'email_subject' => $rs_email->subject,
			  'email_body' => $body
		    );
		$res = my_send_email($email);
                }
            }
//                print_r($res);
                                    $data_insert1=array(
	           "post_userid"=>$form_data['event_userid'],
	           "post_catid"=>0,
	           "post_description"=>$form_data['event_description'],
	           "post_image"=>$form_data['event_thumbnil'],
	           "post_date"=>date('Y-m-d',strtotime($form_data['event_creatdate'])),
	           "post_time"=>date('H:i:s',strtotime($form_data['event_creattime'])),
                       "post_type"=>3,
                       "post_type_id"=>$evtids
	        );
	        
	        $ress1=$this->db->insert('postdetail',$data_insert1);
				    $files = $this->input->post("files", true); 
		 	     	$target_path = 'upload/events/event_details/';
		 	     	
		 	     	if (!empty($files) && is_array($files))
		 	     	{
                       foreach ($files as $key => $file)
                       {
                         if (!empty($file))
                         {
                    
                          $file_name = $this->input->post('file_name_' . $file, true);
                        //   $new_file_name = move_temp_file($file_name, $target_path);
                        //   $file_ext = explode(".", $new_file_name);
                        //   $is_image = check_image_extension($new_file_name);

                          $form_img_data['event_gallery_image'] =  $file_name; 
                          $form_img_data['event_gallery_eventid'] = $evtids;
                          $form_img_data['event_gallery_userid'] = $userids->id;
                      
                          
                          $this->db->insert('event_gallery',$form_img_data);
            
		                }
                       }
                    }
				}
				
		        
				return array('result'=>TRUE, 'message'=>$message);
		    }
		    else
		    {
		        date_default_timezone_set('Asia/Kolkata');
                $currentTime = date( 'd-m-Y h:i:s A', time () );
                $date_string = strtotime($currentTime);
                if(!empty($_FILES['infopic']['name']))
                {
                  $config['upload_path'] = 'upload/events/';
                  $config['allowed_types'] = 'jpg|jpeg|png|gif|svg';
                  $config['file_name'] = $date_string;
                
                  $this->load->library('upload',$config);
                  $this->upload->initialize($config);
                
                  if($this->upload->do_upload('infopic'))
                  {
                    $uploadData = $this->upload->data();
                    $form_data['event_thumbnil'] = $uploadData['file_name'];;
                  }
                } 
		        
		                 $this->db->where('event_id',$id);
		        $query = $this->db->update('events',$form_data);
		        $message = 'Event Edited';
				
					if($query)
				{
				    $evtids = $id;
				    $files = $this->input->post("files", true); 
		 	     	$target_path = 'upload/events/event_details/';
		 	     	
		 	     	if (!empty($files) && is_array($files))
		 	     	{
		 	     	   
                       foreach ($files as $key => $file)
                       {
                         if (!empty($file))
                         {
                    
                          $file_name = $this->input->post('file_name_' . $file, true);
                        //   $new_file_name = $this->move_temp_file($file_name, $target_path);
                        //   $file_ext = explode(".", $new_file_name);
                        //   $is_image = check_image_extension($new_file_name);

                          $form_img_data['event_gallery_image'] =  $file_name; 
                          $form_img_data['event_gallery_eventid'] = $evtids;
                          $form_img_data['event_gallery_userid'] = $userids->id;
                      
                          
                          $this->db->insert('event_gallery',$form_img_data);
            
		                }
                       }
                    }
				}
		        
				return array('result'=>TRUE, 'message'=>$message);
		    }
		
		 
	}
// 	function move_temp_file($file_name, $target_path, $related_to = "", $source_path = NULL, $static_file_name = "")
//     {
//         $new_filename = $file_name;
//         //if not provide any source path we'll fi   nd the default path
//         if (!$source_path) {
//             $source_path = getcwd() . "/uploads/temp/" . $file_name;
//         }

//         //check destination directory. if not found try to create a new one
//         if (!is_dir($target_path)) {
//             if (!mkdir($target_path, 0777, true)) {
//                 die('Failed to create file folders.');
//             }
//         }

//         //overwrite extisting logic and use static file name
//         if ($static_file_name) {
//             $new_filename = $static_file_name;
//         }

//         //check the file type is data or file. then copy to destination and remove temp file
//         if (starts_with($source_path, "data")) {
//             copy_text_based_image($source_path, $target_path . $new_filename);
//             return $new_filename;
//         } else {
//             if (file_exists($source_path)) {
//                 copy($source_path, $target_path . $new_filename);
//                 unlink($source_path);
//                 return $new_filename;
//             }
//         }
//         return false;
//     }
	
	public function save_group($id)
    {
		  $form_data['group_title'] = my_post('title');
		  $form_data['group_description'] = my_post('decs');
		  $form_data['created_by'] = $this->session->userdata('user_id');
		   
		  
		   
		    if($id == null)
		    {
		       date_default_timezone_set('Asia/Kolkata');
               $currentTime = date( 'd-m-Y h:i:s A', time () );
               $date_string = strtotime($currentTime);
                if(!empty($_FILES['infopic']['name']))
                {
                  $config['upload_path'] = 'upload/group/';
                  $config['allowed_types'] = 'jpg|jpeg|png|gif';
                  $config['file_name'] = $date_string.$ids;
                
                  $this->load->library('upload',$config);
                  $this->upload->initialize($config);
                
                  if($this->upload->do_upload('infopic'))
                  {
                    $uploadData = $this->upload->data();
                    $sld_img = 'upload/group/'.$uploadData['file_name'];
                    $form_data['group_image'] = $sld_img;
                  }
                  else{
                    $sld_img = 'upload/group/default.jpg';
                }
                  
                }
                else{
                    $sld_img = 'upload/group/default.jpg';
                }
		       
		        
		        $form_data['group_image'] = $sld_img;
		        $query = $this->db->insert('groups',$form_data);
		        $message = 'Group Added';
				
				return array('result'=>TRUE, 'message'=>$message);
		    }
		    else
		    {
		        date_default_timezone_set('Asia/Kolkata');
                $currentTime = date( 'd-m-Y h:i:s A', time () );
                $date_string = strtotime($currentTime);
                if(!empty($_FILES['infopic']['name']))
                {
                  $config['upload_path'] = 'upload/group/';
                  $config['allowed_types'] = 'jpg|jpeg|png|gif';
                  $config['file_name'] = $date_string.$ids;
                
                  $this->load->library('upload',$config);
                  $this->upload->initialize($config);
                
                  if($this->upload->do_upload('infopic'))
                  {
                    $uploadData = $this->upload->data();
                    $sld_img = 'upload/group/'.$uploadData['file_name'];
                    $form_data['group_image'] = $sld_img;
                  }
                  
                }
		        
                
		        
		        $this->db->where('group_id',$id);
		        $this->db->update('groups',$form_data);
		        $message = 'Group Edited';
				
		        
				
				return array('result'=>TRUE, 'message'=>$message);
		    }
		
		 
	}
	
	
	public function save_notification($id)
    {
		 $get_user_data = $this->db->where(array('user_delete'=>'1','membership_type'=>'2'))->get('user')->result();
		 
		 foreach($get_user_data as $val_data)
		 {
		  $form_data['ids'] = my_random(); 
		  $form_data['by_user_ids']=$val_data->id;
		  $form_data['to_user_ids'] = '0'; 
		  $form_data['subject']= my_post('title');
		  $form_data['body']= my_post('dec_eng');
		  $form_data['request_for'] = 'system_notification';
		  $form_data['request_id'] = '0';
		  $form_data['is_read'] = '0';
		   
		  $query = $this->db->insert('notification',$form_data);
		  $notifyid =$this->db->insert_id();
	      $this->checkcodefcm_post($notifyid);
		 } 
		  
		  
		  
		  $message = 'Notification Added';
		  return array('result'=>TRUE, 'message'=>$message);
		    
		    
		
		 
	}
	
	
	
	public function save_badge($id)
    {
		  $form_data['badge_title'] = my_post('title');
		  $form_data['badge_allow_member'] = my_post('allow_user');
		  
		   
		  
		   
		    if($id == null)
		    {
		       date_default_timezone_set('Asia/Kolkata');
               $currentTime = date( 'd-m-Y h:i:s A', time () );
               $date_string = strtotime($currentTime);
                if(!empty($_FILES['infopic']['name']))
                {
                  $config['upload_path'] = 'upload/batches/';
                  $config['allowed_types'] = 'jpg|jpeg|png|gif';
                  $config['file_name'] = $date_string.$ids;
                
                  $this->load->library('upload',$config);
                  $this->upload->initialize($config);
                
                  if($this->upload->do_upload('infopic'))
                  {
                    $uploadData = $this->upload->data();
                    $sld_img = 'upload/batches/'.$uploadData['file_name'];
                    $form_data['badge_image'] = $sld_img;
                  }
                  else{
                    $sld_img = 'upload/group/default.jpg';
                }
                  
                }
                else{
                    $sld_img = 'upload/group/default.jpg';
                }
		       
		        
		        $form_data['badge_image'] = $sld_img;
		        $query = $this->db->insert('badge',$form_data);
		        $message = 'Badge Added';
				
				return array('result'=>TRUE, 'message'=>$message);
		    }
		    else
		    {
		        date_default_timezone_set('Asia/Kolkata');
                $currentTime = date( 'd-m-Y h:i:s A', time () );
                $date_string = strtotime($currentTime);
                if(!empty($_FILES['infopic']['name']))
                {
                  $config['upload_path'] = 'upload/batches/';
                  $config['allowed_types'] = 'jpg|jpeg|png|gif';
                  $config['file_name'] = $date_string.$ids;
                
                  $this->load->library('upload',$config);
                  $this->upload->initialize($config);
                
                  if($this->upload->do_upload('infopic'))
                  {
                    $uploadData = $this->upload->data();
                    $sld_img = 'upload/batches/'.$uploadData['file_name'];
                    $form_data['badge_image'] = $sld_img;
                  }
                  
                }
		        
                
		        
		        $this->db->where('badge_id',$id);
		        $this->db->update('badge',$form_data);
		        $message = 'Badge Edited';
				
		        
				
				return array('result'=>TRUE, 'message'=>$message);
		    }
		
		 
	}
	
	
	
	public function save_functional_area($id)
    {
		                  
		
		
			$form_data['functional_area'] = my_post('name');
			
		    if($id == null)
		    {
		    	
		       date_default_timezone_set('Asia/Kolkata');
               $currentTime = date( 'd-m-Y h:i:s A', time () );
               $date_string = strtotime($currentTime);
                if(!empty($_FILES['infopic']['name']))
                {
                  $config['upload_path'] = 'upload/functional_area/';
                  $config['allowed_types'] = 'jpg|jpeg|png|gif';
                  $config['file_name'] = $date_string;
                
                  $this->load->library('upload',$config);
                  $this->upload->initialize($config);
                
                  if($this->upload->do_upload('infopic'))
                  {
                    $uploadData = $this->upload->data();
                    $pic_img = 'upload/functional_area/'.$uploadData['file_name'];
                  }
                  else
                  {
                    $pic_img = 'upload/noimage.png';
                  }
                }else{
                    $pic_img = 'upload/noimage.png';
                }
		    	
		    	$form_data['functional_area_thumbnil'] = $pic_img;
		    	
		        $this->db->insert('tbl_functional_area',$form_data);
		        $message = 'Functional Area  Added';
		        return array('result'=>TRUE, 'message'=>$message);
				// return $form_data;
		    }
		    else
		    {
		        date_default_timezone_set('Asia/Kolkata');
               $currentTime = date( 'd-m-Y h:i:s A', time () );
               $date_string = strtotime($currentTime);
                if(!empty($_FILES['infopic']['name']))
                {
                  $config['upload_path'] = 'upload/functional_area/';
                  $config['allowed_types'] = 'jpg|jpeg|png|gif';
                  $config['file_name'] = $date_string;
                
                  $this->load->library('upload',$config);
                  $this->upload->initialize($config);
                
                  if($this->upload->do_upload('infopic'))
                  {
                    $uploadData = $this->upload->data();
                    $pic_img = 'upload/functional_area/'.$uploadData['file_name'];
                    $form_data['functional_area_thumbnil'] = $pic_img;
                  }
                  
                }
		        
		        
		        
		        $this->db->where('functional_area_id',$id);
		        $this->db->update('tbl_functional_area',$form_data);
		        $message = 'Functional Area Edited';
				return array('result'=>TRUE, 'message'=>$message);
		    }
		
		 
	}
        
        public function save_recognition($id)
    {
		                  
		$form_data['recognition_userid'] = my_post('recognition_userid');
		$form_data['recognition_title'] = my_post('recognition_title');
			$form_data['recognition_description'] = my_post('recognition_description');
                        
			
		    if($id == null)
		    {
		    	
		       date_default_timezone_set('Asia/Kolkata');
               $currentTime = date( 'd-m-Y h:i:s A', time () );
               $date_string = strtotime($currentTime);
                if(!empty($_FILES['infopic']['name']))
                {
                  $config['upload_path'] = 'upload/recognition/';
                  $config['allowed_types'] = 'jpg|jpeg|png|gif';
                  $config['file_name'] = $date_string;
                
                  $this->load->library('upload',$config);
                  $this->upload->initialize($config);
                
                  if($this->upload->do_upload('infopic'))
                  {
                    $uploadData = $this->upload->data();
                    $pic_img = $uploadData['file_name'];
                  }
                  else
                  {
                    $pic_img = '';
                  }
                }else{
                    $pic_img = '';
                }
		    	$form_data['recognition_creatdate'] = date('Y-m-d');
                        $form_data['recognition_creattime'] = date('H:i:s');
		    	$form_data['recognition_image'] = $pic_img;
		    	$form_data['type'] = 1;
		        $this->db->insert('recognition',$form_data);
                        $insert_id = $this->db->insert_id();
                        $rs_email = $this->db->where('purpose', 'recognition')->get('email_template')->row(); 
            $recognition_info = $this->db->where('recognition_id',$insert_id)->get('recognition')->row();
            $web_setting = $this->db->get('website_settings')->row();
            $setting = my_global_setting('all_fields');
            $data['setting'] = $setting;
            $data['web_setting'] = $web_setting;
            $data['template'] = $rs_email;
            $data['recognition'] = $recognition_info;
            $CI = &get_instance();
                        $body = $CI->load->view('themes/default/Mail/recognition', $data,true);
//            echo $body;
            $user_info = $this->db->where('id',$form_data['recognition_userid'])->get('user')->row();
            $email = array(
			  'email_to' => $user_info->email_address,
			  'email_subject' => $rs_email->subject,
			  'email_body' => $body
		    );
		$res = my_send_email($email);
//                print_r($res);
		        $message = 'Recognition Added';
		        return array('result'=>TRUE, 'message'=>$message);
				// return $form_data;
		    }
		    else
		    {
		        date_default_timezone_set('Asia/Kolkata');
               $currentTime = date( 'd-m-Y h:i:s A', time () );
               $date_string = strtotime($currentTime);
                if(!empty($_FILES['infopic']['name']))
                {
                  $config['upload_path'] = 'upload/recognition/';
                  $config['allowed_types'] = 'jpg|jpeg|png|gif';
                  $config['file_name'] = $date_string;
                
                  $this->load->library('upload',$config);
                  $this->upload->initialize($config);
                
                  if($this->upload->do_upload('infopic'))
                  {
                    $uploadData = $this->upload->data();
                    $pic_img = $uploadData['file_name'];
                    $form_data['recognition_image'] = $pic_img;
                  }
                  
                }
		        
		        
		        
		        $this->db->where('recognition_id',$id);
		        $this->db->update('recognition',$form_data);
		        $message = 'Recognition Edited';
				return array('result'=>TRUE, 'message'=>$message);
		    }
		
		 
	}
        
        public function save_intro_screen($id)
    {
		                  
		
		
			$form_data['screen_title'] = my_post('screen_title');
                        $form_data['screen_desc'] = my_post('screen_desc');
			
		    if($id == null)
		    {
		    	
		       date_default_timezone_set('Asia/Kolkata');
               $currentTime = date( 'd-m-Y h:i:s A', time () );
               $date_string = strtotime($currentTime);
                if(!empty($_FILES['infopic']['name']))
                {
                  $config['upload_path'] = 'upload/';
                  $config['allowed_types'] = 'jpg|jpeg|png|gif';
                  $config['file_name'] = $date_string;
                
                  $this->load->library('upload',$config);
                  $this->upload->initialize($config);
                
                  if($this->upload->do_upload('infopic'))
                  {
                    $uploadData = $this->upload->data();
                    $pic_img = 'upload/'.$uploadData['file_name'];
                  }
                  else
                  {
                    $pic_img = 'upload/noimage.png';
                  }
                }else{
                    $pic_img = 'upload/noimage.png';
                }
		    	
		    	$form_data['screen_image'] = $pic_img;
		    	
		        $this->db->insert('intro_screen',$form_data);
		        $message = 'Intro Screen  Added';
		        return array('result'=>TRUE, 'message'=>$message);
				// return $form_data;
		    }
		    else
		    {
		        date_default_timezone_set('Asia/Kolkata');
               $currentTime = date( 'd-m-Y h:i:s A', time () );
               $date_string = strtotime($currentTime);
                if(!empty($_FILES['infopic']['name']))
                {
                  $config['upload_path'] = 'upload/';
                  $config['allowed_types'] = 'jpg|jpeg|png|gif';
                  $config['file_name'] = $date_string;
                
                  $this->load->library('upload',$config);
                  $this->upload->initialize($config);
                
                  if($this->upload->do_upload('infopic'))
                  {
                    $uploadData = $this->upload->data();
                    $pic_img = 'upload/'.$uploadData['file_name'];
                    $form_data['screen_image'] = $pic_img;
                  }
                  
                }
		        
		        
		        
		        $this->db->where('screen_id',$id);
		        $this->db->update('intro_screen',$form_data);
		        $message = 'Intro Screen Edited';
				return array('result'=>TRUE, 'message'=>$message);
		    }
		
		 
	}

         public function save_highlights($id)
    {
		                  
		
		
			$form_data['title'] = my_post('title');
                        $form_data['description'] = my_post('description');
			
		    if($id == null)
		    {
		    	
		       date_default_timezone_set('Asia/Kolkata');
               $currentTime = date( 'd-m-Y h:i:s A', time () );
               $date_string = strtotime($currentTime);
                if(!empty($_FILES['infopic']['name']))
                {
                  $config['upload_path'] = 'upload/images/icon/';
                  $config['allowed_types'] = 'jpg|jpeg|png';
                  $config['file_name'] = $date_string;
                
                  $this->load->library('upload',$config);
                  $this->upload->initialize($config);
                
                  if($this->upload->do_upload('infopic'))
                  {
                    $uploadData = $this->upload->data();
                    $pic_img = 'upload/images/icon/'.$uploadData['file_name'];
                  }
                  else
                  {
                    $pic_img = 'upload/noimage.png';
                  }
                }else{
                    $pic_img = 'upload/noimage.png';
                }
		    	
		    	$form_data['image'] = $pic_img;
		    	
		        $this->db->insert('highlights',$form_data);
		        $message = 'Highlights  Added';
		        return array('result'=>TRUE, 'message'=>$message);
				// return $form_data;
		    }
		    else
		    {
		        date_default_timezone_set('Asia/Kolkata');
               $currentTime = date( 'd-m-Y h:i:s A', time () );
               $date_string = strtotime($currentTime);
                if(!empty($_FILES['infopic']['name']))
                {
                  $config['upload_path'] = 'upload/images/icon/';
                  $config['allowed_types'] = 'jpg|jpeg|png';
                  $config['file_name'] = $date_string;
                
                  $this->load->library('upload',$config);
                  $this->upload->initialize($config);
                
                  if($this->upload->do_upload('infopic'))
                  {
                    $uploadData = $this->upload->data();
                    $pic_img = 'upload/images/icon/'.$uploadData['file_name'];
                    $form_data['image'] = $pic_img;
                  }
                  
                }
		        
		        
		        
		        $this->db->where('id',$id);
		        $this->db->update('highlights',$form_data);
		        $message = 'Highlights Edited';
				return array('result'=>TRUE, 'message'=>$message);
		    }
		
		 
	}
        
        public function save_whyus($id)
    {
		                  
		
		
			$form_data['title'] = my_post('title');
                        $form_data['description'] = my_post('description');
			
		    if($id == null)
		    {
		    	
		       date_default_timezone_set('Asia/Kolkata');
               $currentTime = date( 'd-m-Y h:i:s A', time () );
               $date_string = strtotime($currentTime);
                if(!empty($_FILES['infopic']['name']))
                {
                  $config['upload_path'] = 'upload/images/icon/';
                  $config['allowed_types'] = 'jpg|jpeg|png';
                  $config['file_name'] = $date_string;
                
                  $this->load->library('upload',$config);
                  $this->upload->initialize($config);
                
                  if($this->upload->do_upload('infopic'))
                  {
                    $uploadData = $this->upload->data();
                    $pic_img = 'upload/images/icon/'.$uploadData['file_name'];
                  }
                  else
                  {
                    $pic_img = 'upload/noimage.png';
                  }
                }else{
                    $pic_img = 'upload/noimage.png';
                }
		    	
		    	$form_data['image'] = $pic_img;
		    	
		        $this->db->insert('why_choose_us',$form_data);
		        $message = 'Record Added';
		        return array('result'=>TRUE, 'message'=>$message);
				// return $form_data;
		    }
		    else
		    {
		        date_default_timezone_set('Asia/Kolkata');
               $currentTime = date( 'd-m-Y h:i:s A', time () );
               $date_string = strtotime($currentTime);
                if(!empty($_FILES['infopic']['name']))
                {
                  $config['upload_path'] = 'upload/images/icon/';
                  $config['allowed_types'] = 'jpg|jpeg|png';
                  $config['file_name'] = $date_string;
                
                  $this->load->library('upload',$config);
                  $this->upload->initialize($config);
                
                  if($this->upload->do_upload('infopic'))
                  {
                    $uploadData = $this->upload->data();
                    $pic_img = 'upload/images/icon/'.$uploadData['file_name'];
                    $form_data['image'] = $pic_img;
                  }
                  
                }
		        
		        
		        
		        $this->db->where('id',$id);
		        $this->db->update('why_choose_us',$form_data);
		        $message = 'Record Edited';
				return array('result'=>TRUE, 'message'=>$message);
		    }
		
		 
	}
        public function save_ourteam($id)
    {
		                  
		
		
			$form_data['title'] = my_post('title');
                        $form_data['description'] = my_post('description');
			
		    if($id == null)
		    {
		    	
		       date_default_timezone_set('Asia/Kolkata');
               $currentTime = date( 'd-m-Y h:i:s A', time () );
               $date_string = strtotime($currentTime);
                if(!empty($_FILES['infopic']['name']))
                {
                  $config['upload_path'] = 'upload/images/user/';
                  $config['allowed_types'] = 'jpg|jpeg|png';
                  $config['file_name'] = $date_string;
                
                  $this->load->library('upload',$config);
                  $this->upload->initialize($config);
                
                  if($this->upload->do_upload('infopic'))
                  {
                    $uploadData = $this->upload->data();
                    $pic_img = 'upload/images/user/'.$uploadData['file_name'];
                  }
                  else
                  {
                    $pic_img = 'upload/noimage.png';
                  }
                }else{
                    $pic_img = 'upload/noimage.png';
                }
		    	
		    	$form_data['image'] = $pic_img;
		    	
		        $this->db->insert('our_team',$form_data);
		        $message = 'Record Added';
		        return array('result'=>TRUE, 'message'=>$message);
				// return $form_data;
		    }
		    else
		    {
		        date_default_timezone_set('Asia/Kolkata');
               $currentTime = date( 'd-m-Y h:i:s A', time () );
               $date_string = strtotime($currentTime);
                if(!empty($_FILES['infopic']['name']))
                {
                  $config['upload_path'] = 'upload/images/user/';
                  $config['allowed_types'] = 'jpg|jpeg|png';
                  $config['file_name'] = $date_string;
                
                  $this->load->library('upload',$config);
                  $this->upload->initialize($config);
                
                  if($this->upload->do_upload('infopic'))
                  {
                    $uploadData = $this->upload->data();
                    $pic_img = 'upload/images/user/'.$uploadData['file_name'];
                    $form_data['image'] = $pic_img;
                  }
                  
                }
		        
		        
		        
		        $this->db->where('id',$id);
		        $this->db->update('our_team',$form_data);
		        $message = 'Record Edited';
				return array('result'=>TRUE, 'message'=>$message);
		    }
		
		 
	}
        
         public function save_testimonial($id)
    {
		                  
		
		
			$form_data['user_name'] = my_post('user_name');
                        $form_data['user_designation'] = my_post('user_designation');
                        $form_data['short_desc'] = my_post('short_desc');
                        $form_data['long_desc'] = my_post('long_desc');
                        $form_data['is_featured'] = my_post('is_featured');
			
		    if($id == null)
		    {
		    	
		       date_default_timezone_set('Asia/Kolkata');
               $currentTime = date( 'd-m-Y h:i:s A', time () );
               $date_string = strtotime($currentTime);
                if(!empty($_FILES['infopic']['name']))
                {
                  $config['upload_path'] = 'upload/images/user/';
                  $config['allowed_types'] = 'jpg|jpeg|png';
                  $config['file_name'] = $date_string;
                
                  $this->load->library('upload',$config);
                  $this->upload->initialize($config);
                
                  if($this->upload->do_upload('infopic'))
                  {
                    $uploadData = $this->upload->data();
                    $pic_img = 'upload/images/user/'.$uploadData['file_name'];
                  }
                  else
                  {
                    $pic_img = 'upload/noimage.png';
                  }
                }else{
                    $pic_img = 'upload/noimage.png';
                }
		    	
                if(!empty($_FILES['infopic1']['name']))
                {
                  $config['upload_path'] = 'upload/images/';
                  $config['allowed_types'] = 'jpg|jpeg|png|mp4';
                  $config['file_name'] = $date_string;
                
                  $this->load->library('upload',$config);
                  $this->upload->initialize($config);
                
                  if($this->upload->do_upload('infopic1'))
                  {
                    $uploadData = $this->upload->data();
                    $pic_img1 = 'upload/images/'.$uploadData['file_name'];
                  }
                  else
                  {
                      $pic_img1 = "";
                  }
                  $mime = pathinfo($_FILES['infopic1']['name'], PATHINFO_EXTENSION);   
                    if($mime == "mp4")
                    {
                        $form_data['video'] = $pic_img1;
                    }
                    else
                    {
                        $form_data['image'] = $pic_img1;
                    }
                }
                
		    	$form_data['user_image'] = $pic_img;
		    	$form_data['date']=date('Y-m-d');
		        $this->db->insert('testimonials',$form_data);
		        $message = 'Record Added';
		        return array('result'=>TRUE, 'message'=>$message);
				// return $form_data;
		    }
		    else
		    {
		        date_default_timezone_set('Asia/Kolkata');
               $currentTime = date( 'd-m-Y h:i:s A', time () );
               $date_string = strtotime($currentTime);
                if(!empty($_FILES['infopic']['name']))
                {
                  $config['upload_path'] = 'upload/images/user/';
                  $config['allowed_types'] = 'jpg|jpeg|png';
                  $config['file_name'] = $date_string;
                
                  $this->load->library('upload',$config);
                  $this->upload->initialize($config);
                
                  if($this->upload->do_upload('infopic'))
                  {
                    $uploadData = $this->upload->data();
                    $pic_img = 'upload/images/user/'.$uploadData['file_name'];
                    $form_data['user_image'] = $pic_img;
                  }
                  
                }
                
                if(!empty($_FILES['infopic1']['name']))
                {
                  $config['upload_path'] = 'upload/images/';
                  $config['allowed_types'] = 'jpg|jpeg|png|mp4';
                  $config['file_name'] = $date_string;
                
                  $this->load->library('upload',$config);
                  $this->upload->initialize($config);
                
                  if($this->upload->do_upload('infopic1'))
                  {
                    $uploadData = $this->upload->data();
                    $pic_img1 = 'upload/images/'.$uploadData['file_name'];
                    $mime = pathinfo($_FILES['infopic1']['name'], PATHINFO_EXTENSION);   
                    if($mime == "mp4")
                    {
                        $form_data['video'] = $pic_img1;
                        $form_data['image'] = "";
                    }
                    else
                    {
                        $form_data['image'] = $pic_img1;
                        $form_data['video'] = "";
                    }
                  }
                  
                }
		        
		        
		        
		        $this->db->where('id',$id);
		        $this->db->update('testimonials',$form_data);
		        $message = 'Record Edited';
				return array('result'=>TRUE, 'message'=>$message);
		    }
		
		 
	}
        
        public function save_blog($id)
    {
		                  
		
		
			$form_data['title'] = my_post('title');
                        $form_data['description'] = my_post('description');
			$form_data['date'] = my_post('date');
		    if($id == null)
		    {
		    	
		       date_default_timezone_set('Asia/Kolkata');
               $currentTime = date( 'd-m-Y h:i:s A', time () );
               $date_string = strtotime($currentTime);
                if(!empty($_FILES['infopic']['name']))
                {
                  $config['upload_path'] = 'upload/images/blogs/';
                  $config['allowed_types'] = 'jpg|jpeg|png';
                  $config['file_name'] = $date_string;
                
                  $this->load->library('upload',$config);
                  $this->upload->initialize($config);
                
                  if($this->upload->do_upload('infopic'))
                  {
                    $uploadData = $this->upload->data();
                    $pic_img = 'upload/images/blogs/'.$uploadData['file_name'];
                  }
                  else
                  {
                    $pic_img = 'upload/noimage.png';
                  }
                }else{
                    $pic_img = 'upload/noimage.png';
                }
		    	
		    	$form_data['image'] = $pic_img;
		    	
		        $this->db->insert('blogs',$form_data);
		        $message = 'Record Added';
		        return array('result'=>TRUE, 'message'=>$message);
				// return $form_data;
		    }
		    else
		    {
		        date_default_timezone_set('Asia/Kolkata');
               $currentTime = date( 'd-m-Y h:i:s A', time () );
               $date_string = strtotime($currentTime);
                if(!empty($_FILES['infopic']['name']))
                {
                  $config['upload_path'] = 'upload/images/blogs/';
                  $config['allowed_types'] = 'jpg|jpeg|png';
                  $config['file_name'] = $date_string;
                
                  $this->load->library('upload',$config);
                  $this->upload->initialize($config);
                
                  if($this->upload->do_upload('infopic'))
                  {
                    $uploadData = $this->upload->data();
                    $pic_img = 'upload/images/blogs/'.$uploadData['file_name'];
                    $form_data['image'] = $pic_img;
                  }
                  
                }
		        
		        
		        
		        $this->db->where('id',$id);
		        $this->db->update('blogs',$form_data);
		        $message = 'Record Edited';
				return array('result'=>TRUE, 'message'=>$message);
		    }
		
		 
	}
         public function save_advertise2($id)
    {
		                  
		
		
			$form_data['title'] = my_post('title');
//                        $form_data['description'] = my_post('description');
//			$form_data['date'] = my_post('date');
		    if($id == null)
		    {
		    	
		       date_default_timezone_set('Asia/Kolkata');
               $currentTime = date( 'd-m-Y h:i:s A', time () );
               $date_string = strtotime($currentTime);
                if(!empty($_FILES['infopic']['name']))
                {
                  $config['upload_path'] = 'upload/images/';
                  $config['allowed_types'] = 'jpg|jpeg|png';
                  $config['file_name'] = $date_string;
                
                  $this->load->library('upload',$config);
                  $this->upload->initialize($config);
                
                  if($this->upload->do_upload('infopic'))
                  {
                    $uploadData = $this->upload->data();
                    $pic_img = 'upload/images/'.$uploadData['file_name'];
                  }
                  else
                  {
                    $pic_img = 'upload/noimage.png';
                  }
                }else{
                    $pic_img = 'upload/noimage.png';
                }
		    	
		    	$form_data['image'] = $pic_img;
		    	
		        $this->db->insert('advertisement2',$form_data);
		        $message = 'Record Added';
		        return array('result'=>TRUE, 'message'=>$message);
				// return $form_data;
		    }
		    else
		    {
		        date_default_timezone_set('Asia/Kolkata');
               $currentTime = date( 'd-m-Y h:i:s A', time () );
               $date_string = strtotime($currentTime);
                if(!empty($_FILES['infopic']['name']))
                {
                  $config['upload_path'] = 'upload/images/';
                  $config['allowed_types'] = 'jpg|jpeg|png';
                  $config['file_name'] = $date_string;
                
                  $this->load->library('upload',$config);
                  $this->upload->initialize($config);
                
                  if($this->upload->do_upload('infopic'))
                  {
                    $uploadData = $this->upload->data();
                    $pic_img = 'upload/images/'.$uploadData['file_name'];
                    $form_data['image'] = $pic_img;
                  }
                  
                }
		        
		        
		        
		        $this->db->where('id',$id);
		        $this->db->update('advertisement2',$form_data);
		        $message = 'Record Edited';
				return array('result'=>TRUE, 'message'=>$message);
		    }
		
		 
	}
        public function save_advertise1($id)
    {
		                  
		
		
			$form_data['link'] = my_post('link');
//                        $form_data['description'] = my_post('description');
//			$form_data['date'] = my_post('date');
		    if($id == null)
		    {
		    	
		       date_default_timezone_set('Asia/Kolkata');
               $currentTime = date( 'd-m-Y h:i:s A', time () );
               $date_string = strtotime($currentTime);
                if(!empty($_FILES['infopic']['name']))
                {
                  $config['upload_path'] = 'upload/images/';
                  $config['allowed_types'] = 'jpg|jpeg|png';
                  $config['file_name'] = $date_string;
                
                  $this->load->library('upload',$config);
                  $this->upload->initialize($config);
                
                  if($this->upload->do_upload('infopic'))
                  {
                    $uploadData = $this->upload->data();
                    $pic_img = 'upload/images/'.$uploadData['file_name'];
                  }
                  else
                  {
                    $pic_img = 'upload/noimage.png';
                  }
                }else{
                    $pic_img = 'upload/noimage.png';
                }
		    	
		    	$form_data['image'] = $pic_img;
		    	
		        $this->db->insert('advertisement1',$form_data);
		        $message = 'Record Added';
		        return array('result'=>TRUE, 'message'=>$message);
				// return $form_data;
		    }
		    else
		    {
		        date_default_timezone_set('Asia/Kolkata');
               $currentTime = date( 'd-m-Y h:i:s A', time () );
               $date_string = strtotime($currentTime);
                if(!empty($_FILES['infopic']['name']))
                {
                  $config['upload_path'] = 'upload/images/';
                  $config['allowed_types'] = 'jpg|jpeg|png';
                  $config['file_name'] = $date_string;
                
                  $this->load->library('upload',$config);
                  $this->upload->initialize($config);
                
                  if($this->upload->do_upload('infopic'))
                  {
                    $uploadData = $this->upload->data();
                    $pic_img = 'upload/images/'.$uploadData['file_name'];
                    $form_data['image'] = $pic_img;
                  }
                  
                }
		        
		        
		        
		        $this->db->where('id',$id);
		        $this->db->update('advertisement1',$form_data);
		        $message = 'Record Edited';
				return array('result'=>TRUE, 'message'=>$message);
		    }
		
		 
	}
        public function save_advertise3($id)
    {
		                  
		
		
			$form_data['link'] = my_post('link');
//                        $form_data['description'] = my_post('description');
//			$form_data['date'] = my_post('date');
		    if($id == null)
		    {
		    	
		       date_default_timezone_set('Asia/Kolkata');
               $currentTime = date( 'd-m-Y h:i:s A', time () );
               $date_string = strtotime($currentTime);
                if(!empty($_FILES['infopic']['name']))
                {
                  $config['upload_path'] = 'upload/images/';
                  $config['allowed_types'] = 'jpg|jpeg|png';
                  $config['file_name'] = $date_string;
                
                  $this->load->library('upload',$config);
                  $this->upload->initialize($config);
                
                  if($this->upload->do_upload('infopic'))
                  {
                    $uploadData = $this->upload->data();
                    $pic_img = 'upload/images/'.$uploadData['file_name'];
                  }
                  else
                  {
                    $pic_img = 'upload/noimage.png';
                  }
                }else{
                    $pic_img = 'upload/noimage.png';
                }
		    	
		    	$form_data['image'] = $pic_img;
		    	
		        $this->db->insert('advertisement3',$form_data);
		        $message = 'Record Added';
		        return array('result'=>TRUE, 'message'=>$message);
				// return $form_data;
		    }
		    else
		    {
		        date_default_timezone_set('Asia/Kolkata');
               $currentTime = date( 'd-m-Y h:i:s A', time () );
               $date_string = strtotime($currentTime);
                if(!empty($_FILES['infopic']['name']))
                {
                  $config['upload_path'] = 'upload/images/';
                  $config['allowed_types'] = 'jpg|jpeg|png';
                  $config['file_name'] = $date_string;
                
                  $this->load->library('upload',$config);
                  $this->upload->initialize($config);
                
                  if($this->upload->do_upload('infopic'))
                  {
                    $uploadData = $this->upload->data();
                    $pic_img = 'upload/images/'.$uploadData['file_name'];
                    $form_data['image'] = $pic_img;
                  }
                  
                }
		        
		        
		        
		        $this->db->where('id',$id);
		        $this->db->update('advertisement3',$form_data);
		        $message = 'Record Edited';
				return array('result'=>TRUE, 'message'=>$message);
		    }
		
		 
	}
     public function checkcodefcm_post($notifyid)
     {
        
        $notifydata = $this->db->get_where('notification',array('id'=>$notifyid))->row();       
        
        $by_user =$notifydata->by_user_ids;
        $from_user =$notifydata->to_user_ids;
        $sellerdata = $this->db->get_where('user',array('id'=>$by_user))->row(); 
        
        
        
               
           
               $visitorid = $from_user;
               $notifydate = $notifydata->created_time;
               $notifytime = $notifydata->created_time;
               $title = $notifydata->subject;
               $msg = $notifydata->body;  
               $username = $from_user;  

                $visitordata = $this->db->get_where('user',array('id'=>$visitorid))->row();  
                $visitorname = $visitordata->first_name;
                $visitorprofile = base_url().'upload/avatar/'.$visitordata->avatar;
       
                $request_for = $notifydata->request_for;    
	      
       
       
       
       
	    
	    
	    
	    
	    
	       $req_id = $notifydata->request_id;
	       $getthumbnil = base_url().'upload/j4e.png';
	      

       $curl = curl_init();
       $tockentake = $sellerdata->device_token;
       
       
       curl_setopt_array($curl, array(
          CURLOPT_URL => 'https://fcm.googleapis.com/fcm/send',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS =>'{
                "to": "'.$tockentake.'",
                "notification": {
                    "title": "'.$title.'",
                    "message": "'.$msg.'",
                    "image": "'.$getthumbnil.'",
                    "sound": "audio.mp3"
                },
                "data": {
                    
                    "from_user_id": "'.$visitorid.'",
                    "body": "'.$title.'",
                    "Msg": "'.$msg.'",
                    "Date": "'.$notifydate.'",
                    "Time": "'.$notifytime.'",
                    "type": "'.$request_for.'",
		            "id": "'.$req_id.'",
		            "thumbnil": "'.$getthumbnil.'"
		    
                }
}',
  CURLOPT_HTTPHEADER => array(
    //'Authorization: key=AAAAuc1Wnwo:APA91bFnP03hGfE3EwNQYSIg8SHZRNYgEEpb7fD8tbr0jARxkCqTsOhI2f9YiuE9UmbOZBpvvWBfAz0-kw2Cen8WayxcF69EMX1FGhhXKfqJNTeb1SfW78ph8bnTfSdYknU2sgYrP7P0',
    'Authorization: key=AAAAidYY9zQ:APA91bGq1ZcpHK_YQxgHMx_pyEz8qiZE2Bh1wKXVvG2BpFlB_3VRSCYh4g5KylpIAYy7Nf4Zb_jXYGVCOfDFGyCJb6pShoHMQ2-EHIZZwil1vnUIe-A1ZDAOm3fL4tqqzAmaP5nJc7Gs',
    'Content-Type: application/json'
  ),
));
       
    

$response = curl_exec($curl);

curl_close($curl);
//echo $response;
   }


}
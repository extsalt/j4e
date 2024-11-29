<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Group extends MY_Controller {
	
    public function __construct() {
		parent::__construct();
		$this->load->helper('file');
		$this->load->model('Package_model');
    }
	
	
	
	public function index() {
		redirect(base_url('group/mange'));
	}
	
	public function sendmessagedata() 
		{
	    $smscode =  rand(0,9).rand(0,9).rand(0,9).rand(0,9); 
                $data_ins = array(
                       'otp'=> $smscode,
                       'datetime'=> date('Y-m-d'),
                    );
                
                           $system_name = "KBBF";
                
                $apikey="0LvamRT5R0aR5Mnrb2X3Sw";
                $sender_id="APPLEX";
                $curl = curl_init();
                $recipients = '9824878764';
                $messagetext = "One Time Password ".$smscode." to Login for Ecommerce App.If you didn't initiate, report as FRAUD on 9673304412 Applex Group";
                curl_setopt_array($curl, array(
                CURLOPT_URL => "http://sms.applex360.in/api/mt/SendSMS?APIKey=".$apikey."&senderid=".$sender_id."&channel=Trans&DCS=0&flashsms=0&number=".$recipients."&text=".urlencode($messagetext)."&route=8&peid=1001799727186398183",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",
                CURLOPT_SSL_VERIFYHOST => 0,
                CURLOPT_SSL_VERIFYPEER => 0,));
                // echo "http://sms.applex360.in/api/mt/SendSMS?APIKey=".$apikey."&senderid=".$sender_id."&channel=Trans&DCS=0&flashsms=0&number=".$recipients."&text=".$messagetext."&route=7";
                $response = curl_exec($curl);
                curl_close($curl);
                
                
               
                
	}
	
// http://sms.applex360.in/api/mt/SendSMS?APIKey=0LvamRT5R0aR5Mnrb2X3Sw&senderid=APPLEX&channel=Trans=0&flashsms=0&number=9824878764&text=One Time Password 2542 to Login forKBBF.If you didn't initiate, report as FRAUD on 209673304412 Applex Group&route=8&peid=1001799727186398183	
// http://sms.applex360.in/api/mt/SendSMS?APIKey=0LvamRT5R0aR5Mnrb2X3Sw&senderid=APPLEX&channel=Trans&DCS=8&flashsms=0&number=9673008827&text=One%20Time%20Password%20123456%20to%20Login%20for%20KBBF.If%20you%20didn%27t%20initiate,%20report%20as%20FRAUD%20on%209673304412%20Applex%20Group&route=8&peid=1001799727186398183	
	public function mange() {
		$data['title1'] = 'Group';
        $data['titlelinkstatus1'] = 'active';
        $data['titlelink1'] = '';
		
		
		$data['menu_page'] = 'Groups';
		$data['info_data'] = $this->db->order_by('group_id','desc')->get('groups')->result();
		my_load_view($this->setting->theme, 'Backend/group/list_group', $data);
	}
   
    
	public function manages($id = null)
    {  
        $data['title1'] = 'Group';
        $data['titlelinkstatus1'] = '';
        $data['titlelink1'] = base_url('group/mange');
        
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
        
        
        $data['menu_page'] = 'Groups';
        /*
        $data['checkper'] = $this->Global_model->checkpermission('51',$_SESSION['user_ids']);   //print_r($data['checkper']);exit();
        if($data['checkper']['create_per'] == '2' && $data['checkper']['edit_per'] == '2')
        {
           redirect(base_url('backend/dashboard'));
           exit();
        }
        */
	      
       if ($this->input->server('REQUEST_METHOD') === 'POST') 
       {
        
         $this->form_validation->set_rules('title', 'Group Title', 'trim|required');
         $this->form_validation->set_rules('decs', 'Description', 'trim|required');
       	 
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
		    
		    $res = $this->Global_model->save_group($id);
			if ($res['result']) {
			    $this->load->library('firebase');   
                $factory = $this->firebase->init();
                $db = $factory->getDatabase();
        //         if($this->session->userdata('user_id') == 1)
		      //  {
		      //      $uinfo = $this->db->where(array('membership_type'=>0,'firebase_uid !='=>""))->get('user')->row();
		      //      $auser = $uinfo->user_id;
		      //  }
		      //  else
		      //  {
		            $auser = $this->session->userdata('user_id');
		      //  }
			    if(empty($id))
			    {
			         $user_info = $this->db->where('id',$auser)->get('user')->row();
			         if(!empty($user_info->firebase_uid))
			         {
			        $admin = "";
			        
			        $group_info1 = $this->db->order_by('group_id','DESC')->get('groups')->row();
			        $group_user['groupid']=$group_info1->group_id;
			        $group_user['userid']=$uinfo->user_id;
			        
			        
			        $this->db->insert('users_group',$group_user);
                   
                    if(!empty($user_info))
                    {
                        $admin = "+91".$user_info->phone;
                    }
                    if(empty($group_info1->group_image))
                    {
                    $photo = "https://firebasestorage.googleapis.com/v0/b/j4e-app.appspot.com/o/default_group_profile.png?alt=media&token=5efe4b73-92eb-4f11-8661-d60bbbb3ed95";
                    $img = "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\n";
                    }else{
                    $photo = base_url($group_info1->group_image);
                    $img = base64_encode(file_get_contents($photo));
                    }
                    $time = time();
                    $name = my_post('title');
                    $group_info = array('createdBy'=>$admin,'name'=>$name,'onlyAdminsCanPost'=>false,'photo'=>$photo,'thumbImg'=>$img,'timestamp'=>$time);
                    $member = array();
                    $member[$user_info->firebase_uid] = true;
                    $fdata = [
                      'info' => $group_info,
                      'users' => $member
                    ];
                    $ref = "groups/";
                    $postdata = $db->getReference($ref)->push($fdata);
                    $postKey = $postdata->getKey();
                    
                    $ref5 = "newGroups/";
                    $fetchdata3 = $db->getReference($ref5)->getValue();
                    $flag = 0;
                    foreach($fetchdata3 as $key5=>$row5)
                    {
                        if($key5 == $user_info->firebase_uid)
                        {
                            $flag = 1;
                        }
                    }    
                    if($flag == 0)
                    {
                        $postdata5 = $db->getReference($ref5.$user_info->firebase_uid."/")->set(array($postKey => array('event'=>'new_group','groupId'=>$postKey,'groupName'=>$name)));
                    }
                    else
                    {
                        $fdata5 = array();
                        $fetchdata5 = $db->getReference($ref5.$user_info->firebase_uid."/")->getValue();
                         foreach($fetchdata5 as $key6=>$row6)
                        {
                            $fdata5[$key6] = $row6;
                        }
                        $fdata5[$postKey] = array('event'=>'new_group','groupId'=>$postKey,'groupName'=>$name);
                        $postdata5 = $db->getReference($ref5.$user_info->firebase_uid."/")->set($fdata5);
                    }
                    
                    $ref3 = "groupEvents/";
                    $fdata3 = ['contextEnd' => $admin,'contextStart' => $admin,'eventType' => 6,'timestamp'=>strval($time)];
                    $postdata3 = $db->getReference($ref3.$postKey."/")->push($fdata3);
                    
                    // $ref5 = "groupEvents/";
                    // $fdata5 = ['contextEnd' => '+917350123885','contextStart' => $admin,'eventType' => 2,'timestamp'=>time()];
                    // $postdata5 = $db->getReference($ref5.$postKey."/")->push($fdata5);
                    
                    // $ref6 = "groupEvents/";
                    // $fdata6 = ['contextEnd' => '+919922432049','contextStart' => $admin,'eventType' => 2,'timestamp'=>time()];
                    // $postdata6 = $db->getReference($ref6.$postKey."/")->push($fdata6);
                    
                    $ref7 = "groupEvents/";
                    $fdata7 = ['contextEnd' => $admin,'contextStart' => $admin,'eventType' => 1,'timestamp'=>strval($time)];
                    $postdata7 = $db->getReference($ref7.$postKey."/")->push($fdata7);
                    
                    $ref4 = "groupTypingStat/";
                    $postdata6 = $db->getReference($ref4.$postKey."/")->set(array($user_info->firebase_uid=>0));
                    
                    $ref1 = "groupsByUser/";
                    if(!empty($user_info))
                    {
                        $fetchdata = $db->getReference($ref1)->getValue();
                        $flag = 0;
                        foreach($fetchdata as $key=>$row)
                        {
                            if($key == $user_info->firebase_uid)
                            {
                                $flag = 1;
                            }
                        }
                        if($flag == 0)
                        {
                            $postdata4 = $db->getReference($ref1.$user_info->firebase_uid."/")->set(array($postKey => true));
                        }
                        else
                        {
                            $fdata1 = array();
                            $fetchdata1 = $db->getReference($ref1.$user_info->firebase_uid."/")->getValue();
                             foreach($fetchdata1 as $key1=>$row1)
                            {
                                $fdata1[$key1] = $row1;
                            }
                            $fdata1[$postKey] = true;
                            $postdata1 = $db->getReference($ref1.$user_info->firebase_uid."/")->set($fdata1);
                        }
                    }
                    
                    $ref2 = "groupMemberAddedBy/";
                    if(!empty($user_info))
                    {
                        $fetchdata = $db->getReference($ref2)->getValue();
                        $flag = 0;
                        foreach($fetchdata as $key=>$row)
                        {
                            if($key == $user_info->firebase_uid)
                            {
                                $flag = 1;
                            }
                        }
                        if($flag == 0)
                        {
                            $postdata4 = $db->getReference($ref2.$user_info->firebase_uid."/")->set(array($postKey => $admin));
                        }
                        else
                        {
                            $fdata2 = array();
                            $fetchdata2 = $db->getReference($ref2.$user_info->firebase_uid."/")->getValue();
                            foreach($fetchdata2 as $key2=>$row2)
                            {
                                $fdata2[$key2] = $row2;
                            }
                            $fdata2[$postKey] = $admin;
                            $postdata2 = $db->getReference($ref2.$user_info->firebase_uid."/")->set($fdata2);
                        }
                    }
                    
                    // $ref6 = "groupsMessages/".$postKey."/";
                    // $fdata6 = [
                    //     'content' => 'Hello, Welcome to J4E..!!',
                    //     'fromId' => $user_info->firebase_uid,
                    //     'fromPhone' => $admin,
                    //     'timestamp' => time(),
                    //     'type' => 1
                    //     ];
                    // $postdata6 = $db->getReference($ref6)->push($fdata6);
                    // $postKey6 = $postdata6->getKey();
                    
                    $this->db->where('group_id',$group_info1->group_id)->update('groups',array('firebase_uid'=>$postKey));
			         }
			    }
			    else
			    {
			        $group_info1 = $this->db->where('group_id',$id)->get('groups')->row();
			        $admin = "";
			        $user_info = $this->db->where('id',$auser)->get('user')->row();
                    if(!empty($user_info))
                    {
                        $admin = "+91".$user_info->phone;
                    }
                    $name = my_post('title');
                    $time = time();
                    if(empty($group_info1->group_image))
                    {
                    $photo = "https://firebasestorage.googleapis.com/v0/b/j4e-app.appspot.com/o/default_group_profile.png?alt=media&token=5efe4b73-92eb-4f11-8661-d60bbbb3ed95";
                    $img = "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\n";
                    }else{
                    $photo = base_url($group_info1->group_image);
                    $img = base64_encode(file_get_contents($photo));
                    }
                    // $group_info = array('createdBy'=>$admin,'name'=>$name,'onlyAdminsCanPost'=>false,'photo'=>$photo,'thumbImg'=>$img,'timestamp'=>$time);
                    $fdata = [
                      'name'=>$name,
                      'photo'=>$photo,
                      'thumbImg'=>$img
                    ];
                    $token = $group_info1->firebase_uid;
                    $ref = "groups/".$token."/info/";
                    $postdata = $db->getReference($ref)->update($fdata);
			    }
				$this->session->set_flashdata('flash_success', $res['message']);
				redirect(base_url('group/mange'));
				exit();
			}
			else {
				$this->session->set_flashdata('flash_danger', $res['message']);
				
			}
		 }
		   
       } 
      
        
        $data['info_data'] = $this->db->where('group_id',$id)->get('groups')->row();
		my_load_view($this->setting->theme, 'Backend/group/manage_group', $data);
    }
	
	
	public function removeimage()
	{
	    $get_data = $this->db->where(array('group_id'=>my_uri_segment(3)))->get('groups')->row();
	    unlink($get_data->group_image);
	    
	    $get_data = $this->db->where(array('group_id'=>my_uri_segment(3)))->set('group_image','')->update('groups');
		echo '{"result":true, "title":"Deleted", "text":"You request has been completed", "redirect":"' . base_url('group/manages/'.my_uri_segment(3)) . '"}';
	}
	
	
public function file_check($str){
        $allowed_mime_type_arr = array('gif','jpg','jpeg','pjpeg','png','x-png','svg');
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
                $this->form_validation->set_message('file_check', 'Please select only jpeg/jpg/png/svg file.');
                return false;
            }
        }else{
            $this->form_validation->set_message('file_check', 'Please choose a file to upload.');
            return false;
        }
    }
    
    
    public function deletegroup()
    {
        $get_data = $this->db->get_where('users_group',array('groupid'=>my_uri_segment(3)))->result();
        
        foreach($get_data as $valdata)
        {
            $this->db->delete('users_group', array('usergroupid'=>$valdata->usergroupid));
        }
        
        
        
        $this->db->delete('group_id', array('id'=>my_uri_segment(3)));
		echo '{"result":true, "title":"Deleted", "text":"You request has been completed", "redirect":"' . base_url('group/mange') . '"}';
    }
    
    
    public function manageuser($id)
    {
        $data['menu_page'] = 'Groups';
        
        $data['title1'] = 'Groups';
        $data['titlelinkstatus1'] = '';
        $data['titlelink1'] = base_url('group/mange');
        
        $data['title2'] = 'Assign Users List';
        $data['titlelinkstatus2'] = 'active';
        $data['titlelink2'] = '';
        
        $data['group_data'] = $this->db->where('group_id',$id)->get('groups')->row();
        
                             $this->db->select("users_group.*, CONCAT_WS(' ',user.first_name,user.middle_name,user.last_name) as full_name");
                             $this->db->join('user','users_group.userid = user.id','INNER');
        $data['info_data'] = $this->db->where('groupid',$id)->get('users_group')->result();
		my_load_view($this->setting->theme, 'Backend/group/list_groupuser', $data);
        
    }
    
    public function manageusers($groupid = null,$groupuserid = null)
    {  
        
        $data['title1'] = 'Groups';
        $data['titlelinkstatus1'] = '';
        $data['titlelink1'] = base_url('group/mange');
        
        $data['title2'] = 'Assign Users';
        $data['titlelinkstatus2'] = '';
        $data['titlelink2'] = base_url('group/manageuser/'.$groupid);
        
        $data['title3'] = 'Assign';
        $data['titlelinkstatus3'] = 'active';
        $data['titlelink3'] = '';
        
        
        $data['menu_page'] = 'Groups';
        $global_setting = my_global_setting('all_fields');
        $roles = $global_setting->default_role;
        
        /*
        $data['checkper'] = $this->Global_model->checkpermission('51',$_SESSION['user_ids']);   //print_r($data['checkper']);exit();
        if($data['checkper']['create_per'] == '2' && $data['checkper']['edit_per'] == '2')
        {
           redirect(base_url('backend/dashboard'));
           exit();
        }
        */
	      
       if ($this->input->server('REQUEST_METHOD') === 'POST') 
       {
        
        $usesdata = my_post('users');
         foreach($usesdata as $valusers)
         {
            
            $get_data = $this->db->get_where('users_group',array('groupid'=>$groupid,'userid'=>$valusers))->num_rows();
            
            if($get_data == '0'){
             $data_array = array(
                 'groupid'=>$groupid,
                 'userid'=>$valusers,
                 );
            $this->db->insert('users_group',$data_array);  
            $auser = $this->db->where('group_id',$groupid)->get('groups')->row()->created_by;
                $group_uid = $this->db->where('group_id',$groupid)->get('groups')->row()->firebase_uid;
                $user_info = $this->db->where('id',$valusers)->get('user')->row();
                $user_info1 = $this->db->where('id',$auser)->get('user')->row();
                $postKey = $user_info->firebase_uid;
                $time = time();
                $this->load->library('firebase');   
                $factory = $this->firebase->init();
                $db = $factory->getDatabase();
                $ref2 = "groups/".$group_uid."/users/";
                $fdata2 = array();
                $fetchdata2 = $db->getReference($ref2)->getValue();
                foreach($fetchdata2 as $key2=>$row2)
                {
                    $fdata2[$key2] = $row2;
                }
                $fdata2[$postKey] = false;
                $postdata2 = $db->getReference($ref2)->set($fdata2);
                
                $ref3 = "groupMemberAddedBy/";
                $added_by = "";
                if(!empty($user_info))
                {
                    $added_by = "+91".$user_info1->phone;
                }
                $fetchdata = $db->getReference($ref3)->getValue();
                $flag = 0;
                foreach($fetchdata as $key=>$row)
                {
                    if($key == $postKey)
                    {
                        $flag = 1;
                    }
                }
                if($flag == 0)
                {
                    $postdata3 = $db->getReference($ref3.$postKey."/")->set(array($group_uid => $added_by));
                }
                else
                {
                    $fdata2 = array();
                    $fetchdata2 = $db->getReference($ref3.$postKey."/")->getValue();
                    foreach($fetchdata2 as $key2=>$row2)
                    {
                        $fdata2[$key2] = $row2;
                    }
                    $fdata2[$group_uid] = $added_by;
                    $postdata3 = $db->getReference($ref3.$postKey."/")->set($fdata2);
                }
                
                $ref4 = "groupEvents/";
                $fdata3 = ['contextEnd' => '+91'.$user_info->phone,'contextStart' => $added_by,'eventType' => 2,'timestamp'=>strval($time)];
                $postdata1 = $db->getReference($ref4.$group_uid."/")->push($fdata3);
                
                $ref5 = "groupsByUser/";
                $fetchdata1 = $db->getReference($ref5)->getValue();
                $flag = 0;
                foreach($fetchdata1 as $key1=>$row1)
                {
                    if($key1 == $postKey)
                    {
                        $flag = 1;
                    }
                }
                if($flag == 0)
                {
                    $postdata5 = $db->getReference($ref5.$postKey."/")->set(array($group_uid => false));
                }
                else
                {
                    $fdata5 = array();
                    $fetchdata5 = $db->getReference($ref5.$postKey."/")->getValue();
                    foreach($fetchdata5 as $key5=>$row5)
                    {
                        $fdata5[$key5] = $row5;
                    }
                    $fdata5[$group_uid] = false;
                    $postdata5 = $db->getReference($ref5.$postKey."/")->set($fdata5);
                }
            }    
         }
		    
		    
				$this->session->set_flashdata('flash_success', $res['message']);
				redirect(base_url('group/manageuser/'.$groupid));
				exit();
			
		 
		   
       } 
      
        $data['groupids'] = $groupid;
        $data['user_data'] = $this->db->where(array('role_ids'=>$roles))->where('membership_type','2')->get('user')->result();
        $data['info_data'] = $this->db->where(array('usergroupid'=>$groupuserid))->get('users_group')->row(); //'group_id'=>$groupid,
		my_load_view($this->setting->theme, 'Backend/group/manage_assignuser', $data);
    }
    
    
    public function deleteusers()
    {
        $info = $this->db->where('usergroupid',my_uri_segment(4))->get('users_group')->row();
        $auser = $this->db->where('group_id',$info->groupid)->get('groups')->row()->created_by;
        $group_uid = $this->db->where('group_id',$info->groupid)->get('groups')->row()->firebase_uid;
        $user_info = $this->db->where('id',$info->userid)->get('user')->row();
        $user_info1 = $this->db->where('id',$auser)->get('user')->row();
        $time = time();
        $postKey = $user_info->firebase_uid;
        $this->load->library('firebase');   
        $factory = $this->firebase->init();
        $db = $factory->getDatabase();
        $ref2 = "groups/".$group_uid."/users/".$postKey;
        $fetchdata2 = $db->getReference($ref2)->remove();
        
        $ref4 = "groupEvents/";
        $fdata3 = ['contextEnd' => '+91'.$user_info->phone,'contextStart' => '+91'.$user_info1->phone,'eventType' => 3,'timestamp'=>strval($time)];
        $postdata1 = $db->getReference($ref4.$group_uid."/")->push($fdata3);
        
        $ref3= "groupsByUser/".$postKey."/".$group_uid;
        $fetchdata3 = $db->getReference($ref3)->remove();
        
        $this->db->delete('users_group', array('usergroupid'=>my_uri_segment(4)));
		echo '{"result":true, "title":"Deleted", "text":"You request has been completed", "redirect":"' . base_url('group/manageuser/'.my_uri_segment(3)) . '"}';
    }
    
    
}
?>
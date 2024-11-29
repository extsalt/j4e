<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Globalfile extends MY_Controller {
	
    public function __construct() {
		parent::__construct();
                $this->load->model('user_model'); 
		
    }
	
	
	
	public function index() {
		redirect(base_url('files/file_manager'));
	}
	
	public function managemenu()
	{
	    $data['menu_data'] = $this->db->get('menu')->result_array();
		my_load_view($this->setting->theme, 'Backend/menu/menu_list', $data);
	}
	
	
	public function managesmenu($id = null)
    {
       if ($this->input->server('REQUEST_METHOD') === 'POST') 
       {
        
          $pagedata['menu_name'] = $this->input->post('menu_name');
          $menu_link = $this->input->post('links');
          $menu_parent = $this->input->post('parents');
          
          if($menu_link == '')
          {
              $pagedata['menu_link'] = "#";
          }
          else
          {
              $pagedata['menu_link'] = $menu_link;
          }
          
          if($menu_parent == '')
          {
              $pagedata['menu_parent'] = "0";
          }
          else
          {
              $pagedata['menu_parent'] = $menu_parent;
          }
          
          if($id == '')
          {
            $pagedata['ids'] = my_random();
              $pagedata['menu_status'] = '1';
              $this->db->insert('menu', $pagedata);
              $last_id = $this->db->insert_id();
              
              if($last_id != '0' || $last_id != '')
              {
                  $get_role = $this->db->get('role')->result_array();
                  $get_menu = $this->db->get('menu')->result_array();
                  
                  foreach($get_role as $valrole)
                  {
                     
                          $perdata = array(
                              'menu_id' => $last_id,
                              'role_id' => $valrole['ids'],
                              'view_per' => '2',
                              'create_per'=>'2',
                              'edit_per' => '2',
                              'delete_per' => '2',
                              );
                          $this->db->insert('module_permission',$perdata);      
                       
                  }
                  
                  
                  
              }
              
              
              
              $this->session->set_flashdata('flash_success', my_caption('menu_new_success'));
    		  redirect(base_url('Globalfile/managemenu'));exit();
            }
            else
            {
              // print_r($pagedata);
              // die();
              // echo $id;
              // die();
              $this->db->where('ids',$id);
              $this->db->update('menu',$pagedata);
              $this->session->set_flashdata('flash_success', my_caption('menu_update_success'));
    		  redirect(base_url('Globalfile/managemenu'));exit();
            }
       } 
        
        
        // $data['menu_data'] = $this->Global_model->get_menu(0)->result_array();  
        $data['menu_data'] = $this->Global_model->get_menu_form()->result_array();  
        $data['menu_info'] = $this->db->where('ids',$id)->get('menu')->row_array();
		my_load_view($this->setting->theme, 'Backend/menu/menu_manage', $data);
    }
	
	public function managepermission()
	{
	    $data['role_data'] = $this->db->get('role')->result_array();
		my_load_view($this->setting->theme, 'Backend/permission/permission_list', $data);
	}
	
	public function managespermission($role_id,$role_ids)
	{
	    $data['role'] = $role_ids;
	    $data['roleid'] = $role_id;
	    $data['menu_data'] = $this->db->get('menu')->result_array();
	    // print_r($data);
     //  die();
	    my_load_view($this->setting->theme, 'Backend/permission/permission_manages_data', $data);
	    
		//my_load_view($this->setting->theme, 'Backend/permission/permission_manages', $data);
	    
	}
	
public function updatepermission($role_id)
	{
	     $menudata = $this->db->get('menu')->result_array();
	    
	    
	    foreach ($menudata as $key => $v_menu)
	    {
            
            $view = $this->input->post('vewper_' . $v_menu['menu_id']); 
            $create = $this->input->post('created_' . $v_menu['menu_id']);
            
            $edit = $this->input->post('edtper_' . $v_menu['menu_id']); 
            $delete = $this->input->post('delper_' . $v_menu['menu_id']); 
            
            if(!empty($view)) { $checkper['view_per'] = '1';}   
            else { $checkper['view_per'] = '2';} 
            
            if(!empty($create)) { $checkper['create_per'] = '1';}   
            else { $checkper['create_per'] = '2';} 
            
            if(!empty($edit)) { $checkper['edit_per'] = '1';}   
            else { $checkper['edit_per'] = '2';} 
            
            if(!empty($delete)) { $checkper['delete_per'] = '1';}   
            else { $checkper['delete_per'] = '2';} 
            
            $this->db->where('role_id',$role_id);
	        $this->db->where('menu_id',$v_menu['menu_id']);
	        $this->db->update('module_permission',$checkper);
            
        }
        
        $getrole = $this->db->get_where('role',array('ids'=>$role_id))->row();
                $act_type = 'Permission Updated';
		        $act_module = 'Permission Updated';
		        $act_modulename = 'Role : '.$getrole->name;
		        
        
	    $this->session->set_flashdata('flash_success', my_caption('menu_permission_success'));
	    redirect(base_url('admin/role'));
	}
	
	public function buildChild($parent, $menu)
    {
        if (isset($menu['parents'][$parent])) {
            foreach ($menu['parents'][$parent] as $ItemID) {
                if (!isset($menu['parents'][$ItemID->menu_id])) {
                    $result[$ItemID->menu_name] = $ItemID->menu_id;
                }
                if (isset($menu['parents'][$ItemID->menu_id])) {
                    $result[$ItemID->menu_name][$ItemID->menu_id] = self::buildChild($ItemID->menu_id, $menu);
                }
            }
        }
        return $result;
    }
    
//    public function upload_file()
//    {
//        $target_path = getcwd() .'/upload/events/event_details/';
//        //upload_file_to_temp($target_path);
//        if (!empty($_FILES)) {
//            
//            $temp_file = $_FILES['file']['tmp_name'];
//            $file_name = $_FILES['file']['name'];
//            
//            // if (!is_valid_file_to_upload($file_name) || $_FILES['file']['size'] > 5000000)
//            //     return false;
//
//            // $target_path = getcwd() . '/uploads/temp/';
//            if (!is_dir($target_path)) {
//                if (!mkdir($target_path, 0777, true)) {
//                    die('Failed to create file folders.');
//                }
//            }
//            $target_file = $target_path . $file_name;
//            copy($temp_file, $target_file);
//            // echo $target_file;
//            
//        }
//        // echo 'hello';
//    }
        function upload_file()
    {
        $target_path = 'upload/events/event_details/';
        upload_file_to_temp($target_path);
    }
    
    function validate_project_file()
    {
        return validate_post_file($this->input->post("file_name",true));
    } 
    public function import_user()
	{
	   $data['menu_name'] = '';
	   
	   if ($this->input->server('REQUEST_METHOD') === 'POST')
	   {
	       $chapter_id = my_post('chpt_id');
	       
	       
	       $this->load->library('excel');
        ob_start();
        $file = $_FILES["upload_file"]["tmp_name"];
        if (!empty($file)) {
            $valid = false;
            $types = array('Excel2007', 'Excel5');
            foreach ($types as $type) {
                $reader = PHPExcel_IOFactory::createReader($type);
                if ($reader->canRead($file)) {
                    $valid = true;
                }
            }
            if (!empty($valid)) {
                try {
                    $objPHPExcel = PHPExcel_IOFactory::load($file);
                } catch (Exception $e) {
                    die("Error loading file :" . $e->getMessage());
                }
                $sheetData = array();
                //All data from excel
//                $sheetData = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);   //echo count($sheetData);exit();
                $cell_collection = $objPHPExcel->getActiveSheet()->getCellCollection();
               
                foreach ($cell_collection as $cell) {
                $column = $objPHPExcel->getActiveSheet()->getCell($cell)->getColumn();
                $row = $objPHPExcel->getActiveSheet()->getCell($cell)->getRow();
                if($column == "Y" || $column == "Z" || $column == "I")
                {
                    $data_value = $objPHPExcel->getActiveSheet()->getCell($cell)->getFormattedValue();
                }
                else
                {
                    $data_value = $objPHPExcel->getActiveSheet()->getCell($cell)->getCalculatedValue();
                }
//                echo $data_value;die;
//                The header will/should be in row 1 only. of course, this can be modified to suit your need.
                if ($row == 1 || $row == 2) {
                    $header[$row][$column] = $data_value;
                } else {
                    $sheetData[$row][$column] = $data_value;
                }
                }
                $total_rows = count($sheetData);
                $total_imported = 0;
                $total_skipped = 0;
                $rows_skipped = array();
                $package_id = $this->input->post('package_id');
                $package_info = $this->db->where('pack_id',$package_id)->get('packages')->row();
                if(!empty($package_info))
                {
//                    print_r($sheetData);die;
                    for ($i = 1; $i <= count($sheetData); $i++)
                    {
                        $x=$i+2;
                        // **********************
                        // Save Into tasks table
                        // **********************           
                        $phone = trim($sheetData[$x]["G"]);
                        $uinfo = $this->db->where('phone',$phone)->get('user')->result();
                        if(empty($uinfo)&&!empty(trim($sheetData[$x]["C"]))&&!empty(trim($sheetData[$x]["E"]))&&!empty(trim($sheetData[$x]["F"]))&&!empty(trim($sheetData[$x]["G"]))&&filter_var(trim($sheetData[$x]["F"]), FILTER_VALIDATE_EMAIL)&&strlen(preg_replace("/[^\d]/", "", trim($sheetData[$x]["G"]))) == 10)
                        {
                            $otp=rand(1111,9874); 

                              $user_array = array(
                                        'phone'=>$phone,
                                            'otp'=>$otp
                               );

                              $ressuu=$this->db->insert('user_temp', $user_array);
                          $get_category = $no_emp= $turnover = '';
                          
                        $category = trim($sheetData[$x]["P"]);
                        if($category != '')
                        {
                          $get_category_info = $this->db->select('functional_area_id')->where(array('functional_area'=>$category))->get('tbl_functional_area')->row();
                          if(!empty($get_category_info))
                          {
                              $get_category = $get_category_info->functional_area_id;
                          }
                          else
                          {
                              $q = $this->db->insert('tbl_functional_area',array('functional_area'=>$category,'created_date'=>date('Y-m-d H:i:s'),'status'=>1));
                              $get_category = $this->db->insert_id();
                          }
                        }


                        $emp = trim($sheetData[$x]["T"]);
                        if($emp != '')
                        {
                            $no_emp_info = $this->db->select('id')->where(array('title'=>$emp))->get('employee')->row();
                            if(!empty($no_emp_info))
                            {
                                $no_emp = $no_emp_info->id;
                            }
                            else
                            {
                                $q = $this->db->insert('employee',array('title'=>$emp));
                                $no_emp = $this->db->insert_id();
                            }
                        }

                        $to = trim($sheetData[$x]["U"]);
                        if($to != '')
                        {
                            $turnover_info = $this->db->select('turn_over_id')->where(array('turn_over_value'=>$to))->get('turn_over')->row();
                            if(!empty($turnover_info))
                            {
                                $turnover = $turnover_info->turn_over_id;
                            }
                            else
                            {
                                $q = $this->db->insert('turn_over',array('turn_over_value'=>$to));
                                $turnover = $this->db->insert_id();
                            }
                        }  
                        if(empty(trim($sheetData[$x]["Y"])))
                        {
                            $sd = date('Y-m-d');
                        }
                        else
                        {
                            $sd = date('Y-m-d',strtotime(trim($sheetData[$x]["Y"])));
                        }
                        if(empty(trim($sheetData[$x]["Z"])))
                        {
                            $duration = $package_info->pack_duration;
                            $ed = date("Y-m-d", strtotime("+$duration month"));
                        }
                        else
                        {
                            $ed = date('Y-m-d',strtotime(trim($sheetData[$x]["Z"])));
                        }
//                        echo $ed;die;
                        $form_data['api_key'] = my_random();
                        $form_data['balance'] = '{"usd":0}';
                        $form_data['avatar'] = 'default.jpg';
                        $form_data['timezone'] = $this->config->item('time_reference');
                        $form_data['date_format'] = 'Y-m-d';
                        $form_data['time_format'] = 'H:i:s';
                        $form_data['language'] = '';
                        $form_data['currency'] = 'USD';
                        $form_data['membership_type'] = $package_info->pack_type;
                        $form_data['packages_id'] = $package_id;
                        $form_data['ids'] = my_random();
    //			        $form_data['api_key'] = my_random();
                        $form_data['signup_source'] = 'Import';
                        $form_data['role_ids'] = '';
                        $form_data['created_time'] = my_server_time();
                        $form_data['update_time'] = my_server_time();		            
                        $form_data['affiliate_earning'] = '{}';        
                        $form_data['prefix'] = trim($sheetData[$x]["B"]);
                        $form_data['first_name'] = trim($sheetData[$x]["C"]);
                        $form_data['middle_name'] = trim($sheetData[$x]["D"]);
                        $form_data['last_name'] = trim($sheetData[$x]["E"]);
                        $form_data['email_address'] = trim($sheetData[$x]["F"]);
                        $form_data['phone'] = trim($sheetData[$x]["G"]);
                        $form_data['gender'] = trim($sheetData[$x]["H"]);
                        $form_data['dob'] = trim($sheetData[$x]["I"]);                   
                        $form_data['packages_startDate'] = strtotime($sd);
                        $form_data['packages_endDate'] = strtotime($ed);
                        $form_data['business_category'] = $get_category;
    //                        $this->db->insert('user',$form_data);     
    //                        $insert_id = $this->db->insert_id();
    //                        $user_info = $this->db->where('id',$insert_id)->get('user')->row();
    //				        
    //				        $pur_array = array(
    //    	                'user_id'=>$insert_id,
    //    	                'plan_id'=>$get_chapter_data->pack_id,
    //    	                'plan_startdate'=>trim($sheetData[$x]["V"]),
    //    	                'plan_enddate'=>trim($sheetData[$x]["W"]),
    //    	                'plan_status'=>'Active'
    //    	                );
    //    	                $this->db->insert('user_package_purchase',$pur_array); 	        
                        $form_data['company'] = trim($sheetData[$x]["K"]);
                        $form_data['designation'] = trim($sheetData[$x]["J"]);
                        $form_data['total_experience'] = trim($sheetData[$x]["L"]);
                        $form_data['company_address'] = trim($sheetData[$x]["M"]);
                        $form_data['company_contact'] = trim($sheetData[$x]["N"]);
                        $form_data['about_company'] = trim($sheetData[$x]["O"]);
                        $form_data['business_entity'] = trim($sheetData[$x]["Q"]);
                        $form_data['business_type'] = trim($sheetData[$x]["R"]);
                        $form_data['business_experties'] = trim($sheetData[$x]["S"]);
                        $form_data['no_of_employees'] = $no_emp;
                        $form_data['turn_over'] = $turnover;
                        $form_data['working_from'] = trim($sheetData[$x]["V"]);
                        $form_data['target_audiance'] = trim($sheetData[$x]["W"]);
                        $form_data['website'] = trim($sheetData[$x]["X"]); 
                        $form_data['referral_code'] = substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz'), 0, 6);
                        $rc = trim($sheetData[$x]["AA"]);
                          if(!empty($rc))
                          {
                              $rc_info = $this->db->where('phone',$rc)->get('user')->row();
                              if(!empty($rc_info))
                              {
                                  $form_data['referred_by'] = $rc_info->id;
                              }
                          }
                        $q1 =  $this->db->insert('user',$form_data);
                        if($q1)
                        {
                            if(!empty($form_data['referred_by']))
                    {
                    $this->user_model->add_reward_point('GuestBecomeMember',$form_data['referred_by'],date('Y-m-d'),date('H:i:s'),$form_data['first_name']);  
                    }
//                        echo $this->db->last_query();die;
                        //print_r($form_cmp_data);exit();
                        $insert_id = $this->db->insert_id();
                            $user_info = $this->db->where('id',$insert_id)->get('user')->row();
    				         if(!empty($user_info)){
                                             $rs_email = $this->db->where('purpose', 'welcome')->get('email_template')->row(); 
            $user_info = $this->db->where('id',$insert_id)->get('user')->row();
            $web_setting = $this->db->get('website_settings')->row();
            $setting = my_global_setting('all_fields');
            $data['setting'] = $setting;
            $data['web_setting'] = $web_setting;
            $data['template'] = $rs_email;
            $data['user'] = $user_info;
            $CI = &get_instance();
                        $body = $CI->load->view('themes/default/Mail/welcome', $data,true);
//            echo $body;
            $email = array(
			  'email_to' => $user_info->email_address,
			  'email_subject' => $rs_email->subject,
			  'email_body' => $body
		    );
		$res = my_send_email($email);
//                print_r($res);
                                             $pur_array = array(
	                'user_id'=>$insert_id,
	                'plan_id'=>$package_id,
	                'plan_startdate'=>date('Y-m-d',strtotime($sd)),
	                'plan_enddate'=>date('Y-m-d',strtotime($ed)),
	                'plan_status'=>'Active'
	                );
	                $this->db->insert('user_package_purchase',$pur_array); 
    				             //firebase insertion
//    				             $this->load->library('firebase');
//                                $factory = $this->firebase->init();
//                                $db = $factory->getDatabase();
//                                $auth = $factory->getAuth();
//            
//                                if(empty($user_info->avatar))
//                                {
//                                $avatar = 'https://firebasestorage.googleapis.com/v0/b/j4e-app.appspot.com/o/default_user_img.png?alt=media&token=d65a3232-b36d-4386-8814-c23986808d83';
//                                $avatar1 = base64_encode(file_get_contents($avatar));
//                                }else{
//                                $avatar = base_url('upload/avatar/'.$user_info->avatar);
//                                $avatar1 = base64_encode(file_get_contents($avatar));
//                                }
//                                //$email1 = 'radhesh.applex360@gmail.com';
//                                $mobile1 = '+91'.$user_info->phone;
//                                $pass = 'Applex@2021';
//                                $dname = $user_info->first_name;
//                                if(!empty($user_info->middle_name))
//                                {
//                                $dname .= " ".$user_info->middle_name;
//                                }
//                                $dname .= " ".$user_info->last_name;
//            
//                                $fdata = [
//                                    'name' => $dname,
//                                    'phone' => $mobile1,
//                                  'photo' => $avatar,
//                                  'status' => 'Hey I am using J4E App',
//                                  'thumbImg' => $avatar1,
//                                  'designation' => $user_info->designation,
//                                  'email' => $user_info->email_address,
//                                  'company_name' => $user_info->company,
//                                  'company_address' => $user_info->company_address,
//                                  'ver' => '1.0'
//                                 
//                                ];
//                                // print_r($fdata);die;
//                                $ref = "users/";
//                              
//                                    $postdata = $db->getReference($ref)->push($fdata);
//                                    
//                                    $postKey = $postdata->getKey();
//                                    $userProperties = [
//                                        'uid' => $postKey,
//                                    'phoneNumber' => $mobile1,
//                                    'password' => $pass,
//                                    'displayName' => $dname,
//                                    'photoUrl' => $avatar,
//                                    'disabled' => false,
//                                ];
//    
//                                $user = $auth->createUser($userProperties);
//    				    
//                                $res = $this->db->where('id',$user_info->id)->update('user',array('firebase_uid'=>$postKey));
                        }
                            $total_imported++;
                        }
                        else{
                            $total_skipped++;
                            array_push($rows_skipped, $x);
                        }
                        }
                        else
                        {
                            $total_skipped++;
                            array_push($rows_skipped, $x);
                        }
                    }
                }
                else {
//            $type = 'error';
//            $message = "You did not Select File! please upload XLS/CSV File ";
            $this->session->set_flashdata('flash_success', 'Invalid Package');
        }
//                 redirect($_SERVER['HTTP_REFERER']);
                //save data into table.
            } 
            else {
//            $type = 'error';
//            $message = "You did not Select File! please upload XLS/CSV File ";
            $this->session->set_flashdata('flash_success', 'Invalid File');
        }
        } else {
//            $type = 'error';
//            $message = "You did not Select File! please upload XLS/CSV File ";
            $this->session->set_flashdata('flash_success', 'You did not Select File! please upload XLS/CSV File');
        }
//        set_message($type, $message);
        $data1['total_rows'] = $total_rows;
        $data1['total_imported'] = $total_imported;
        $data1['total_skipped'] = $total_skipped;
        $data1['rows_skipped'] = "";
        if(!empty($rows_skipped))
        {
            for($i=0;$i<count($rows_skipped);$i++)
            {
                if($i==0)
                {
                    $data1['rows_skipped'] = $rows_skipped[$i];
                }
                else
                {
                    $data1['rows_skipped'] .= ", ".$rows_skipped[$i];
                }
            }
        }
        $this->session->set_userdata($data1);
        if (empty($_SERVER['HTTP_REFERER'])) {
            redirect('globalfile/import_user');
        } else {
            redirect($_SERVER['HTTP_REFERER']);
        }
	   }
	   $data['menu_page'] = '';
	   $data['package_data'] = $this->db->select('pack_id,pack_name')->get('packages')->result();
	   
	   my_load_view($this->setting->theme, 'Backend/master/import_user', $data); 
	}
	
}
?>
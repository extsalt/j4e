<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rewards_model extends CI_Model {



	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set($this->config->item('time_reference'));
	}
	
	
	public function save_reward($id)
    {
		                  
		
		
			$form_data['rewards_title'] = my_post('reward_name');
			$form_data['rewards_point'] = my_post('reward_point');
			$form_data['rewards_days'] = my_post('reward_day');
			$form_data['rewards_description'] = my_post('Description');
		    if($id == null)
		    {
		    	
		       date_default_timezone_set('Asia/Kolkata');
               $currentTime = date( 'd-m-Y h:i:s A', time () );
               $date_string = strtotime($currentTime);
                if(!empty($_FILES['infopic']['name']))
                {
                  $config['upload_path'] = 'upload/rewards/';
                  $config['allowed_types'] = 'jpg|jpeg|png|gif';
                  $config['file_name'] = $date_string;
                
                  $this->load->library('upload',$config);
                  $this->upload->initialize($config);
                
                  if($this->upload->do_upload('infopic'))
                  {
                    $uploadData = $this->upload->data();
                    $pic_img = 'upload/rewards/'.$uploadData['file_name'];
                  }
                  else
                  {
                    $pic_img = 'upload/noimage.png';
                  }
                }else{
                    $pic_img = 'upload/noimage.png';
                }
		    	
		    	$form_data['reward_thumbnil'] = $pic_img;
		    	
		        $this->db->insert('rewards',$form_data);
		        $message = 'Rewards Added';
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
                  $config['upload_path'] = 'upload/rewards/';
                  $config['allowed_types'] = 'jpg|jpeg|png|gif';
                  $config['file_name'] = $date_string.$ids;
                
                  $this->load->library('upload',$config);
                  $this->upload->initialize($config);
                
                  if($this->upload->do_upload('infopic'))
                  {
                    $uploadData = $this->upload->data();
                    $pic_img = 'upload/rewards/'.$uploadData['file_name'];
                    $form_data['reward_thumbnil'] = $pic_img;
                  }
                  
                }
		        
		        
		        
		        $this->db->where('rewards_id',$id);
		        $this->db->update('rewards',$form_data);
		        $message = 'Rewards Edited';
				return array('result'=>TRUE, 'message'=>$message);
		    }
		
		 
	}
	
	public function save_assignreward($id)
    {
            $rewid = my_post('rewardid');
		    $getreward = $this->db->get_where("rewards",array('rewards_id'=>$rewid))->row(); 
		     
		    $startdate =  date('d-m-Y', strtotime(my_post('start_date')));
		    $dayscount = $getreward->rewards_days;  
		    $EndDate= date('d M Y', strtotime($startdate. ' + '.$dayscount.' days')); 
		
			$form_data['reward_rewardsid'] = my_post('rewardid');
			$form_data['reward_userdid'] = my_post('user_name');
			$form_data['reward_startdate'] = Date('d M Y', strtotime(my_post('start_date')));
			$form_data['reward_enddate'] = $EndDate;
			$form_data['reward_dates'] = my_post('start_date');
			
		    if($id == null)
		    {
		    	
		        $this->db->insert('user_reward',$form_data);
		        $message = 'User Assign Rewards Added';
		        return array('result'=>TRUE, 'message'=>$message);
				// return $form_data;
		    }
		    else
		    {
		        $this->db->where('rewards_id',$id);
		        $this->db->update('rewards',$form_data);
		        $message = 'User Assign Rewards Edited';
				return array('result'=>TRUE, 'message'=>$message);
		    }
		
		 
	}

	public function update_package($order,$id)
	{
		// echo $order;
		// echo $id;
		$this->db->where('fet_id',$id);
		$this->db->set('feature_order',$order);
		        $this->db->update('features');
		//         $message = 'Order Edited';
		// 		return array('result'=>TRUE, 'message'=>$message);
	}
	
	
}
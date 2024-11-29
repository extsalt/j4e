<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Package_model extends CI_Model {



	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set($this->config->item('time_reference'));
	}
	
	
	public function save_package($id)
    {
		                  
		
		
			$form_data['pack_name'] = my_post('pack_name');
			$form_data['pack_desc'] = my_post('pack_desc');
			$form_data['pack_price'] = my_post('pack_price');
			$form_data['pack_duration'] = my_post('pack_duration');
                        $form_data['pack_type'] = my_post('pack_type');
			$form_data['pack_for'] = "Yearly";
                        $feature = my_post('feature');
                        $features = array();
                        if(!empty($feature))
                        {
                            for($i=0;$i<count($feature);$i++)
                            {
                                if(my_post('is_allowed')[$i] == 1)
                                {
                                    array_push($features,$feature[$i]);
                                }
                            }
                        }
			$form_data['pack_fet'] = implode("/",$features);
			
			
			// return $form_data;
			// die();
		 	
		    if($id == null)
		    {
		    	// $form_data['ids'] = my_random();
		    	$form_data['ids'] = my_random();
                        $info = $this->db->select('max(seq_no) as seq_no')->get('packages')->row();
                        if(empty($info))
                        {
                            $form_data['seq_no'] = 1;
                        }
                        else
                        {
                            $form_data['seq_no'] = $info->seq_no + 1;
                        }
		        $this->db->insert('packages',$form_data);
		        $message = 'Packages Added';
		        return array('result'=>TRUE, 'message'=>$message);
				// return $form_data;
		    }
		    else
		    {
		        $this->db->where('ids',$id);
		        $this->db->update('packages',$form_data);
                        $pinfo = $this->db->where('ids',$id)->get('packages')->row();
                        if(!empty($feature))
                        {
                            for($i=0;$i<count($feature);$i++)
                            {
                                $info = $this->db->where(array('package_id'=>$pinfo->pack_id,'feature_id'=>$feature[$i]))->get('package_features')->row();
                                if(empty($info))
                                {
                                    $form_data1['package_id'] = $pinfo->pack_id;
                                    $form_data1['feature_id'] = $feature[$i];
                                    $form_data1['is_allowed'] = my_post('is_allowed')[$i];
                                    $form_data1['count_allowed'] = my_post('count_allowed')[$i];
                                    $this->db->insert('package_features',$form_data1);
                                }
                                else
                                {
                                    $form_data1['package_id'] = $pinfo->pack_id;
                                    $form_data1['feature_id'] = $feature[$i];
                                    $form_data1['is_allowed'] = my_post('is_allowed')[$i];
                                    $form_data1['count_allowed'] = my_post('count_allowed')[$i];
                                    $this->db->where('id',$info->id);
                                    $this->db->update('package_features',$form_data1);
                                }
                            }
                        }
		        $message = 'Packages Edited';
				return array('result'=>TRUE, 'message'=>$message);
		    }
		
		 
	}
	
	public function save_rewardpoint($id)
    {
		                  
		
		
			$form_data['activity'] = my_post('activity');
			$form_data['description'] = my_post('description');
			$form_data['point'] = my_post('point');
			
			
			
			// return $form_data;
			// die();
		 	
		    
		        $this->db->where('id',$id);
		        $this->db->update('reward_point',$form_data);
                        
		        $message = 'Reward Point Edited';
				return array('result'=>TRUE, 'message'=>$message);
		    
		
		 
	}
        
        public function save_feature($id)
    {
		$form_data['fet_name'] = my_post('fet_name');
		$form_data['fet_description'] = my_post('fet_description');	
		 	
		    if($id == null)
		    {
		    	$form_data['ids'] = my_random();
		        $this->db->insert('features',$form_data);
		        $message = 'Features Added';
				return array('result'=>TRUE, 'message'=>$message);
		    }
		    else
		    {
		        $this->db->where('ids',$id);
		        $this->db->update('features',$form_data);
		        $message = 'Features Edited';
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
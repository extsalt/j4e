<?php

class Homemodel extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }

    public function check_login($email,$password)
	{
	    $pass = md5($password);
	    $this->db->where('username',$email);
	    //$this->db->or_like('auth_username',$email);
	    
	    $query = $this->db->get_where('login', array('password'=>$password, 'delete_status'=>'0'));
        
        if($query->num_rows())
		{
			$user_data = $query->row_array();
			$this->session->set_userdata(array(
				
				'username' => $user_data['username'],
				'id' => $user_data['id'],
				'is_user_login' => true
				)
			);
			return 1;
        }else{
            return 0;
        }
	}

	public function get_seq($tablename)
	{
		 $this->db->select_max('seq_no');
   		 $res1 = $this->db->get($tablename);

   		 return $res1;
	}

	
		public function get_seq_benefit($tablename , $service)
	{
		 $this->db->select_max('seq_no');
		 $query = $this->db->get_where($tablename, array('service'=>$service));
   		 //$res1 = $this->db->get($tablename);

   		 return $query;
	}

		public function get_seq_category($tablename , $type)
	{
		 $this->db->select_max('seq_no');
		 $query = $this->db->get_where($tablename, array('type'=>$type));
   		 //$res1 = $this->db->get($tablename);

   		 return $query;
	}

		public function get_seq_subcategory($tablename , $category)
	{
		 $this->db->select_max('seq_no');
		 $query = $this->db->get_where($tablename, array('category'=>$category));
   		 //$res1 = $this->db->get($tablename);

   		 return $query;
	}

	public function check_user($tablename , $username)
	{
		$query = $this->db->get_where($tablename, array('username'=>$username));
		 if($query->num_rows())
		{
			return 1;
        }else{
            return 0;
        }
	}


	public function add_data($tablename,$data_form)
    {
        $method = $this->db->insert($tablename,$data_form);
        return $method;
    }

    public function get_details($tablename , $id)
    {
    	$query = $this->db->get_where($tablename, array('id'=>$id));
		 if($query->num_rows())
		{
			return 1;
        }else{
            return 0;
        }
    }

    public function update_data($tablename , $data  , $id)
    {
    	$this->db->where('id', $id);
		$method = $this->db->update($tablename, $data);
		return $method;
    }

    public function delete_data($tablename , $id)
    {
		$this->db->where('id', $id);
		$method =$this->db->delete($tablename);
		return $method;
    }
}
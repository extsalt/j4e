<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Post extends MY_Controller {
	
    public function __construct() {
		parent::__construct();
		$this->load->helper('file');
		//$this->load->model('Requirement_model');
    }
	
	
	
	public function index() {
		redirect(base_url('post/managepost'));
	}
	
	
    public function managepost()
    {
        $data['title1'] = 'Post';
        $data['titlelinkstatus1'] = 'active';
        $data['titlelink1'] = '';
        
        $data['checkper'] = checkpermissions('3');       
        if($data['checkper']['view_per'] == '2')
        {
           redirect(base_url('dashboard'));
           exit();
        }
        
        
        
        $data['menu_page'] = 'Posts';
                            $this->db->select("postdetail.*,CONCAT_WS(' ',first_name,middle_name,last_name) as full_name");
                            $this->db->join('user','postdetail.post_userid = user.id','LEFT');
        $data['req_data'] = $this->db->order_by('post_id','DESC')->get('postdetail')->result();
		my_load_view($this->setting->theme, 'Backend/post/post_list', $data);
    }
    
    public function managesdetail($id)
    {
        
        $data['title1'] = 'Post';
        $data['titlelinkstatus1'] = '';
        $data['titlelink1'] = base_url('post/managepost');
        
        
        
        $data['title2'] = 'View Detail';
        $data['titlelinkstatus2'] = 'active';
        $data['titlelink2'] = '';
        
        
        $data['menu_page'] = 'Posts';
                             $this->db->join('postcategory','postcategory.cat_id = postdetail.post_catid','INNER');
        $data['info_data'] = $this->db->where("post_id",$id)->order_by('post_id','asc')->get('postdetail')->row();
        $data['poost_ids'] = $id;
		my_load_view($this->setting->theme, 'Backend/post/post_detail', $data);
    }
	
	public function updatestatus()
    {
        $this->db->set("post_status",my_uri_segment(4));
        $this->db->where("post_id",my_uri_segment(3));
        $this->db->update('postdetail');
		echo '{"result":true, "title":"Status Updated", "text":"You request has been completed", "redirect":"' . base_url('post') . '"}';
    }
	
	
	
	public function manageslike($id)
    {
        $data['title1'] = 'Post';
        $data['titlelinkstatus1'] = '';
        $data['titlelink1'] = base_url('post/managepost');
        
        
        
        $data['title2'] = 'Like Detail';
        $data['titlelinkstatus2'] = 'active';
        $data['titlelink2'] = '';
        
        $data['menu_page'] = 'Posts';
        $data['info_data'] = $this->db->where("post_like_dislike_postid",$id)->order_by('post_like_dislike_id','DESC')->get('post_like_dislike')->result();
        $data['poost_ids'] = $id;
		my_load_view($this->setting->theme, 'Backend/post/post_like_detail', $data);
    }
    
    public function managescomment($id)
    {
        $data['title1'] = 'Post';
        $data['titlelinkstatus1'] = '';
        $data['titlelink1'] = base_url('post/managepost');
        
        
        
        $data['title2'] = 'Comments Detail';
        $data['titlelinkstatus2'] = 'active';
        $data['titlelink2'] = '';
        
        $data['menu_page'] = 'Posts';
        $data['info_data'] = $this->db->where("post_cmt_postid",$id)->order_by('post_cmt_id','DESC')->get('post_comment')->result();
        $data['poost_ids'] = $id;
		my_load_view($this->setting->theme, 'Backend/post/post_comment_detail', $data);
    }
    
	 public function updatecommentstatus()
    {
        $this->db->set("post_cmt_status",my_uri_segment(4));
        $this->db->where("post_cmt_id",my_uri_segment(3));
        $this->db->update('post_comment');
		echo '{"result":true, "title":"Status Updated", "text":"You request has been completed", "redirect":"' . base_url('post/managescomment/'.my_uri_segment(5)) . '"}';
    }
	
	
	
	public function managecategory()
	{
	    $data['title1'] = 'Post Category';
        $data['titlelinkstatus1'] = 'active';
        $data['titlelink1'] = '';
	    
	    $data['menu_page'] = 'Masters';
	    $data['info_data'] = $this->db->order_by('cat_id','asc')->get('postcategory')->result();
		my_load_view($this->setting->theme, 'Backend/post/post_category_list', $data);
	}
	
	public function getusername($userid)
	{
	    $getdata = $this->db->query("select id,CONCAT_WS(' ',first_name,middle_name,last_name) as full_name from user where `id`=$userid ")->row();  //AND `role_ids` = 'S4ZhmaqIO1a311dffa9b3cace791c8993964e5cd95dJi4Nj3F'
        echo $getdata->full_name;
	}
	
	
	public function getpostliketotal($postid)
	{
	    $getdata = $this->db->query("select count(post_like_dislike_id) as totallike from post_like_dislike where `post_like_dislike_postid`=$postid ")->row();  //AND `role_ids` = 'S4ZhmaqIO1a311dffa9b3cace791c8993964e5cd95dJi4Nj3F'
        if(empty($getdata))
        {
            echo 0;
        }
        else
        {
           echo $getdata->totallike; 
        }
        
	}
	
	public function getpostcommenttotal($postid)
	{
	    $getdata = $this->db->query("select count(post_cmt_id) as totalcomment from post_comment where `post_cmt_postid`=$postid ")->row();  //AND `role_ids` = 'S4ZhmaqIO1a311dffa9b3cace791c8993964e5cd95dJi4Nj3F'
        if(empty($getdata))
        {
            echo 0;
        }
        else
        {
           echo $getdata->totalcomment; 
        }
        
	}
	
	public function deletepostcomment()
	{
        $this->db->delete('post_comment', array('post_cmt_id'=>my_uri_segment(3)));
		echo '{"result":true, "title":"Deleted", "text":"You request has been completed", "redirect":"' . base_url('post/managescomment/'.my_uri_segment(4)) . '"}';
	}
	
}
?>
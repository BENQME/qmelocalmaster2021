<?php
// defined('BASEPATH') OR exit('No direct script access allowed');

class Detail extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
		$this->load->helper("url");
    }

	public function index()
	{  
	$s_user_id = $this->session->userdata('user_id');
		//if($s_user_id>0){
	 $site_id = site_id();
	$slug = $this->uri->segment(2);
	
	//$this->uri->segment(2);
			$data['spotlight'] = $spotlight = $this->db->get_where('spotlights',array('postSlug'=>$slug))->row();
			if(!isset($data['spotlight'])) redirect('dashboard');
			$user_id = $spotlight->userid;
			
			$this->db->where('userID', $user_id );
		    $this->db->from('users');
			$data['userinfo'] = $this->db->get()->row();

			$this->db->where('user_id', $user_id );
		    $this->db->from('user_profile');
			$userprofile= $this->db->get()->row();

			$data['page_type'] = "post_detail";
			$data['View'] = "enduser/post_detail";
			
			$data['likes_data']= $this->db->where(array('itemID'=> $spotlight->postID,'userID'=>$user_id))->from('likes')->get()->row();
			//print_r($spotlight);
            $user_level = $this->session->userdata('user_level');
		     if(isset($data['userinfo']) && ($data['userinfo']->level == 1 || $data['userinfo']->level == 3)){
				 $data['relevant_users']="";
			 }else{
			$preferences_arr = json_decode($userprofile->preferences);
			$inc=1;
			$prefwhere='';
			$prefwhere .=' AND (';
			foreach($preferences_arr as $preference){
				if($inc==1){
					$prefwhere .=" up.preferences LIKE '%".$preference."%'";
				}else{
					$prefwhere .=" OR up.preferences LIKE '%".$preference."%'";
				}	
				$inc++;
			}
			$prefwhere .=' )';
			/*echo '<pre>';
			echo "SELECT u.userID, u.first_name, u.last_name, u.photo  
				FROM users u 
				INNER JOIN user_profile up
				ON u.userID=up.user_id 
				WHERE  
				1=1
				".$prefwhere."  
				ORDER BY user_id ASC";exit;*/

			$data['relevant_users'] = $this->db->query("SELECT u.userID, u.first_name, u.last_name, u.photo  
				FROM users u 
				INNER JOIN user_profile up
				ON u.userID=up.user_id 
				WHERE  
				1=1 
				AND u.userID!=".$user_id." AND u.site_id =".$site_id." AND u.level =0 GROUP BY u.site_id 
				".$prefwhere."  
				ORDER BY user_id ASC")->result_array();
			 }

			if($spotlight){
				//print_r($spotlight);
				$spotlight_id = $spotlight->postID;
				//$this->db->where('spotlight_id', $spotlight_id);
				//$this->db->from('spotlights_images');
				$data['gallery']= $this->db->order_by('sort_order','asc')->get_where('spotlights_images',array('spotlight_id'=>$spotlight_id))->result();
				//$data['gallery'] = $this->db->get()->result();
				$sp_type =$sp_category="";
				//$sp_type  = $spotlight->spotlight_type;
				//echo  $sp_category; die;
				
				$data['related_posts'] = 
				
				$this->db->query("SELECT s.*, 
				u.first_name,
				u.last_name,
				u.photo,
			u.site_id,
			u.level,
			r.spotlight_id,
			r.web_id,
			
			(SELECT count(likeID) FROM likes l WHERE l.userID=".$user_id." AND s.postID=l.itemID) AS likecount
			FROM spotlights s 
			LEFT JOIN region_spotlights r ON (r.spotlight_id=s.postID AND r.web_id=$site_id)	
			INNER JOIN users u ON s.userid=u.userID AND ((r.web_id=".$site_id." AND u.level = 3) OR (u.level != 3 AND u.site_id  =$site_id)) 
			WHERE spotlight_type = '".$spotlight->spotlight_type."'   AND   postID !=".$spotlight_id." AND s.status=1 ORDER BY s.created_at DESC limit 3")->result_array();
				
				
				
				/*$this->db->query("SELECT s.*, 
				u.first_name,
				u.last_name,
				u.photo,
				(SELECT count(likeID) FROM likes l WHERE l.userID=".$user_id." AND s.postID=l.itemID) AS likecount
				 FROM spotlights s INNER JOIN users u ON s.userid=u.userID AND u.site_id =".$site_id."
				  WHERE spotlight_type = '".$spotlight->spotlight_type."' AND postID !=".$spotlight_id." ORDER BY s.created_at DESC limit 2")->result_array();*/
				
				
				/* $this->db->where('spotlight_type',  $spotlight->spotlight_type);
				$this->db->where('postID !=', $spotlight_id);
				$this->db->limit(2);
				$this->db->from('spotlights');*/
				//$data['related_posts'] = $this->db->get()->result();
				$this->add_count($spotlight->postSlug);
				$data['media_posts'] = $this->db->query("SELECT s.*, 
			u.site_id,
			u.level,
			r.spotlight_id,
			r.web_id 
			FROM spotlights s 
			LEFT JOIN region_spotlights r ON (r.spotlight_id=s.postID AND r.web_id=$site_id)	
			INNER JOIN users u ON s.userid=u.userID AND ((r.web_id=".$site_id." AND u.level = 3) OR (u.level != 3 AND u.site_id  =$site_id)) 
			WHERE s.spotlight_type='Media/Podcast'  AND s.status=1")->result();
			}else{
			}
			
			$current_user = $this->db->get_where('users',array('userID'=> $this->session->userdata('user_id')))->row();
			 $user_level = $this->session->userdata('user_level');
			 $data['page_content'] = $this->load->view($data['View'], $data, true);
			if($user_level==1){
				$this->load->view('admin/layouts/dashboard', $data);
			}elseif($user_level==3){
				$this->load->view('superadmin/layouts/dashboard', $data);
			}else{
			$this->load->view('enduser/layouts/dashboard', $data);
			}
		//}
	//}else{
	//	redirect('login');
	//}
    }

	function add_count($slug){
		$this->load->helper('cookie');
	  $check_visitor = $this->input->cookie(urldecode($slug), FALSE);
		$ip = $this->input->ip_address();
		if ($check_visitor == false) {
			$cookie = array(
				"name"   => urldecode($slug),
				"value"  => "$ip",
				"expire" =>  time() + 7200,
				"secure" => false
			);
			$this->input->set_cookie($cookie);
			$this->update_counter(urldecode($slug));
		}
	}
	
	
	
	function update_counter($slug) {
	// return current article views 
		$this->db->where('postSlug', urldecode($slug));
		$this->db->select('visits_count');
		$count = $this->db->get('spotlights')->row();
	// then increase by one 
		$this->db->where('postSlug', urldecode($slug));
		$this->db->set('visits_count', ($count->visits_count + 1));
		$this->db->update('spotlights');
	}
}
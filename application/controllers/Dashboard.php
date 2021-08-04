<?php
// defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->library('encryption');
		$this->load->library('email');
		$this->load->helper('url','form');
        $this->load->library("pagination");
        $this->load->model('enduser/login_model');
		$this->load->helper("url");
    }
	public function index()
	{  
	$site_id = site_id();
		$user_id = $this->session->userdata('user_id');
		if($user_id>0){
			$this->db->where('userID', $user_id );
		    $this->db->from('users');
			$data['userinfo'] = $this->db->get()->row();
			$data['topic_cover'] =  $this->db->get('spotlights_category')->num_rows();
			
			
			$userprofileinfo = $this->db->get_where('user_profile',array('user_id'=>$user_id))->row();
			$preferences_arr = json_decode($userprofileinfo->preferences);
			$preferences_str = implode('|', $preferences_arr);
			$data['events'] = $this->db->query("SELECT s.*, 
			u.site_id,
			u.level,
			r.spotlight_id,
			r.web_id 
			FROM spotlights s 
			LEFT JOIN region_spotlights r ON (r.spotlight_id=s.postID AND r.web_id=$site_id)	
			INNER JOIN users u ON s.userid=u.userID AND ((r.web_id=".$site_id." AND u.level = 3) OR (u.level != 3 AND u.site_id  =$site_id)) 
			WHERE s.category REGEXP '^(".$preferences_str.")' AND s.spotlight_type='Events'  AND s.status=1")->result();
				 
			$data['promotions'] = $this->db->query("SELECT s.*, 
			u.site_id,
			u.level,
			r.spotlight_id,
			r.web_id 
			FROM spotlights s 
			LEFT JOIN region_spotlights r ON (r.spotlight_id=s.postID AND r.web_id=$site_id)	
			INNER JOIN users u ON s.userid=u.userID AND ((r.web_id=".$site_id." AND u.level = 3) OR (u.level != 3 AND u.site_id  =$site_id)) 
			WHERE s.category REGEXP '^(".$preferences_str.")' AND s.spotlight_type='Spotit Spotlight'  AND s.status=1")->result();
				
			$data['jobs'] = $this->db->query("SELECT s.*, 
				u.site_id,
				u.level,
				r.spotlight_id,
				r.web_id 
				FROM spotlights s 
				LEFT JOIN region_spotlights r ON (r.spotlight_id=s.postID AND r.web_id=$site_id)	
				INNER JOIN users u ON s.userid=u.userID AND ((r.web_id=".$site_id." AND u.level = 3) OR (u.level != 3 AND u.site_id  =$site_id)) 
				WHERE s.category REGEXP '^(".$preferences_str.")' AND s.spotlight_type='Job Posting'  AND s.status=1")->result();
		
			$data['relevant'] = $this->db->query("SELECT s.* , u.userID,	u.site_id, u.level,
				r.spotlight_id,
				r.web_id 
			FROM spotlights s 
			LEFT JOIN region_spotlights r ON (r.spotlight_id=s.postID AND r.web_id=$site_id)	
				INNER JOIN users u ON s.userid=u.userID AND ((r.web_id=".$site_id." AND u.level = 3) OR (u.level != 3 AND u.site_id  =$site_id)) 
			WHERE s.category REGEXP '^(".$preferences_str.")' AND s.status=1")->result();
			 $data['admin_spotlights'] = $this->db->query("SELECT s.*, 
				u.first_name,
				u.last_name,
				u.photo,
					u.site_id,
					u.level,
					r.spotlight_id,
				r.web_id,
				(SELECT count(likeID) FROM likes l WHERE l.userID=".$user_id." AND s.postID=l.itemID) AS likecount
				  FROM spotlights s 
				   LEFT JOIN region_spotlights r ON (r.web_id=".$site_id." AND r.spotlight_id=s.postID)
				  INNER JOIN users u ON s.userid=u.userID AND u.level = 1
				  
				  
				  WHERE s.category REGEXP '^(".$preferences_str.")' AND s.status=1  ORDER BY s.created_at DESC")->result();	
				  
			$data['View'] = "enduser/dashboard";
				 
				//$this->db->last_query(); die;
				$data['page_type']='user_deshboard';
			$data['View'] = "enduser/dashboard";
			
			$data['page_content'] = $this->load->view($data['View'], $data, true);
			$this->load->view('enduser/layouts/dashboard', $data);
		}else{
			redirect('login');
		}
    }
    public function check_user(){
    $user_id = $this->uri->segment(3);
	$this->db->where('userID', $user_id);
	$this->db->from('users');
	$query = $this->db->get()->row();
	  $this->session->set_userdata("user_id", $query->userID);
	  $complete_check = $this->db->get_where('user_profile', array('user_id' => $query->userID))->row();
	  if(!$this->session->userdata('online'))
						{
							$ip		= getenv('remote_addr');
							$this->session->set_userdata('online', TRUE);
							insertVisitor();
						}
	  
	  if(isset($complete_check->complete_profile) && $complete_check->complete_profile == 1){
	     //echo $site_url; die;
			redirect('dashboard');
		}else{
		redirect('login/complete_profile');
		}
    
    
}
    function mychart(){
		$site_id = site_id();
    	header('Content-Type: application/json');
    	$user_id = $this->session->userdata('user_id');
		if($user_id>0){
    	$user_montly = $this->db->query("SELECT s.userid,  COUNT(s.`postID`) as total,MONTH(date(s.created_at)) as month, u.site_id,u.userID 
					FROM spotlights s INNER JOIN users u ON s.userid=u.userID  
					WHERE s.userid = ".$user_id." AND u.site_id = ".$site_id." AND s.status=1 
					AND YEAR(date(s.created_at)) =  YEAR(date(NOW()))
					GROUP BY MONTH(date(s.created_at))")->result();
		/*echo '<pre>'; 
		print_r($user_montly[0]->month);
		exit;*/
		$month_arr = array(1,2,3,4,5,6,7,8,9,10,11,12);
		$i=0;
		$user_month_data=array();
		$ii=0;
		foreach ($month_arr as $month_value) {
			
			if(!empty($user_montly[$i]->month) && $month_value==$user_montly[$i]->month){
				$user_month_data[$ii]=(int)$user_montly[$i]->total;
				$i++;
			}else{
				$user_month_data[$ii]=0;
			}
			$ii++;
		}
		
		echo json_encode($user_month_data,JSON_NUMERIC_CHECK);	
		}
    }
	public function preference()
	{  
		$user_id = $this->session->userdata('user_id');
		if($user_id>0){
			$this->db->where('userID', $user_id );
		    $this->db->from('users');
			$data['userinfo'] = $this->db->get()->row();
			$check_data="";
		 $this->db->where('user_id', $user_id );
	    $this->db->from('user_profile');
		
		$check_data = $this->db->get()->row();

		
			$data['preferences'] = $check_data->preferences;
			
			
			if($check_data && $this->input->post('submit')==1)
				{
					 $data['preferences'] = $check_data->preferences;
					 $preferences = $check_data->preferences;
					$data = array(
						'preferences' => json_encode($this->input->post('preferences')),
						
					);	
				   
				   $this->db->update('user_profile',$data, array('user_id'=>$user_id));
					$this->session->set_flashdata('sucesess', 'Updated Sucessfully');
					redirect('dashboard/preference');
			   }
			
			
			$data['page_type']='complete_profile';
			
			$data['View'] = "enduser/preference";
			$data['page_content'] = $this->load->view($data['View'], $data, true);
			$this->load->view('enduser/layouts/dashboard', $data);
		}else{
			redirect('login');
		}
    }
    public function userprofile(){
    	$user_id = $this->session->userdata('user_id');
		if($user_id>0){
			$this->db->where('userID', $user_id );
		    $this->db->from('users');
			$data['userinfo'] = $this->db->get()->row();

			$this->db->where('user_id', $user_id );
			$this->db->from('user_profile');
			$data['userprofileinfo'] = $this->db->get()->row();
			$data['page_type']='user_profile';
			$data['View'] = "enduser/userprofile";
			$data['page_content'] = $this->load->view($data['View'], $data, true);
			$this->load->view('enduser/layouts/dashboard', $data);
		}else{
			redirect('login');
		}
    }

    public function publicprofile(){
		
    	$public_id = $this->uri->segment(3);
    	
		if($public_id>0){
			$user_id = $this->session->userdata('user_id');
			if($user_id>0){
				$this->db->where('userID', $user_id );
			    $this->db->from('users');
				$data['userinfo'] = $this->db->get()->row();

				$this->db->where('user_id', $user_id );
				$this->db->from('user_profile');
				$data['userprofileinfo'] = $this->db->get()->row();
			}else{
				$data['userinfo']=(object)array(
									'first_name' => '',
									'last_name' => '',
									'email' => '',
									'photo' => ''
									);
				$data['userprofileinfo']=(object)array();
			}
			$this->db->where('userID', $public_id );
		    $this->db->from('users');
			$data['publicuserinfo'] = $this->db->get()->row();

			$this->db->where('user_id', $public_id );
			$this->db->from('user_profile');
			$data['publicuserprofileinfo'] = $this->db->get()->row();

			$data['page_type']='user_profile';
			$data['View'] = "enduser/publicprofile";
			$data['page_content'] = $this->load->view($data['View'], $data, true);
			$this->load->view('enduser/layouts/profile', $data);
		}else{
			redirect('login');
		}
    }

    function logout()
	{
	    $user_data = $this->session->all_userdata();
		$user_id = $this->session->userdata('user_id');
		$this->db->update('visitors',array('is_online'=>0), array('user_id'=>$user_id));
		foreach ($user_data as $key => $value) {
			if ($key != 'session_id' && $key != 'ip_address' && $key != 'user_agent' && $key != 'last_activity') {
				$this->session->unset_userdata($key);
			}
		}
		
	    $this->session->sess_destroy();
	    redirect('home');
	}
	function myspotlight(){
		$user_level =0;
		$user_id = $this->session->userdata('user_id');
		$user_level = $this->session->userdata('user_level');
	if($user_id>0){
			$this->db->where('userID', $user_id );
		    $this->db->from('users');
			$data['userinfo'] = $this->db->get()->row();
			$this->db->where('user_id', $user_id );
			$this->db->from('user_profile');
			$data['userprofileinfo'] = $this->db->get()->row();
		$url_sigment = $this->uri->segment(3);
		if(!$this->uri->segment(3)) $url_sigment='all';
			if($url_sigment =='news'){
				$where_filter = " AND s.spotlight_type='News / Blog'";
			}elseif($url_sigment =='media'){
				$where_filter = " AND s.spotlight_type='Media/Podcast'";
				
			}elseif($url_sigment =='jobs'){
				 $where_filter = " AND s.spotlight_type='Job Posting'";
			}elseif($url_sigment =='events'){
					 $where_filter = " AND s.spotlight_type='Events'";
			}elseif($url_sigment =='spotit'){	
			$where_filter = " AND s.spotlight_type='Spotit Spotlight'";
			}elseif($url_sigment =='hbcu'){	
			$where_filter = " AND s.spotlight_type='HBCU News'";
			}else{
				$where_filter ="";
			}
			if(!empty($this->input->get('search'))){
				$data['search_text'] = $this->input->get('search');
				$search_filter = " AND (s.postTitle LIKE '%".$data['search_text']."%' OR s.postContent LIKE '%".$data['search_text']."%')";
				$s_qstring= "?search=".$data['search_text'];

			}else{
				$data['search_text'] = '';
				$search_filter ="";
				$s_qstring= "";
			}
			$totalcount = $this->db->query("SELECT s.*, 
				u.first_name,
				u.last_name,
				u.photo,
				(SELECT count(likeID) FROM likes l WHERE l.userID=".$user_id." AND s.postID=l.itemID) AS likecount  FROM spotlights s INNER JOIN users u ON s.userid=u.userID WHERE s.userid=".$user_id." ".$where_filter.$search_filter." ORDER BY s.created_at DESC")->num_rows();
			
			
$config = array();
			$config["base_url"] = base_url()."dashboard/myspotlight/". $url_sigment;
			$config["total_rows"] = $totalcount;
			$config["per_page"] = 12;
			$config["uri_segment"] =4;
			//$config['first_url'] = $config['base_url'].'?'.$s_qstring;
			/*$config['enable_query_strings'] = TRUE;
			$config['use_page_numbers'] = TRUE;
			$config['query_string_segment'] = 'page';*/
			$config['full_tag_open'] = '<nav aria-label="Page navigation example"><ul class="pagination justify-content-center pagination-separated">';
			$config['full_tag_close'] = '</ul></nav>';            
			$config['prev_link'] = '<i data-feather="chevron-left"></i>';
			$config['first_tag_open'] = '<li class="page-item">';
			$config['first_tag_close'] = '</li>';
			$config['prev_tag_open'] = '<li class="page-item">';
			$config['prev_tag_close'] = '</li>';
			$config['next_link'] = '<i data-feather="chevron-right"></i>';
			$config['next_tag_open'] = '<li class="page-item">';
			$config['next_tag_close'] = '</li>';
			$config['last_tag_open'] = '<li class="page-item">';
			$config['last_tag_close'] = '</li>';
			$config['cur_tag_open'] = '<li class="page-item active"><a>';
			$config['cur_tag_close'] = '</a></li>';
			$config['num_tag_open'] = '<li class="page-item">';
			$config['num_tag_close'] = '</li>';
			$config['reuse_query_string'] = true;
			$this->pagination->initialize($config);
           $page = ($this->uri->segment(4))? $this->uri->segment(4) : 0;

			$data["links"] = $this->pagination->create_links();
			
			$data['spotlight_posts'] = $this->db->query("SELECT s.*, 
				u.first_name,
				u.last_name,
				u.photo,
				(SELECT count(likeID) FROM likes l WHERE l.userID=".$user_id." AND s.postID=l.itemID) AS likecount  FROM spotlights s INNER JOIN users u ON s.userid=u.userID WHERE s.userid=".$user_id." ".$where_filter.$search_filter." ORDER BY s.created_at DESC limit ".$config["per_page"]." OFFSET ".$page)->result_array();
				$data['media_total'] = $this->db->query("SELECT s.*, 
				u.first_name,
				u.last_name,
				u.photo,
				(SELECT count(likeID) FROM likes l WHERE l.userID=".$user_id." AND s.postID=l.itemID) AS likecount  FROM spotlights s INNER JOIN users u ON s.userid=u.userID WHERE s.userid=".$user_id." AND s.spotlight_type='Media/Podcast' ".$search_filter." ORDER BY s.created_at DESC")->num_rows();
$data['news_total'] = $this->db->query("SELECT s.*, 
				u.first_name,
				u.last_name,
				u.photo,
				(SELECT count(likeID) FROM likes l WHERE l.userID=".$user_id." AND s.postID=l.itemID) AS likecount  FROM spotlights s INNER JOIN users u ON s.userid=u.userID WHERE s.userid=".$user_id." AND s.spotlight_type='News / Blog' ".$search_filter." ORDER BY s.created_at DESC")->num_rows();
$data['event_total'] = $this->db->query("SELECT s.*, 
				u.first_name,
				u.last_name,
				u.photo,
				(SELECT count(likeID) FROM likes l WHERE l.userID=".$user_id." AND s.postID=l.itemID) AS likecount  FROM spotlights s INNER JOIN users u ON s.userid=u.userID WHERE s.userid=".$user_id." AND s.spotlight_type='Events' ".$search_filter." ORDER BY s.created_at DESC")->num_rows();
				
$data['hbsu_total'] = $this->db->query("SELECT s.*, 
				u.first_name,
				u.last_name,
				u.photo,
				(SELECT count(likeID) FROM likes l WHERE l.userID=".$user_id." AND s.postID=l.itemID) AS likecount  FROM spotlights s INNER JOIN users u ON s.userid=u.userID WHERE s.userid=".$user_id." AND s.spotlight_type='HBCU News' ".$search_filter." ORDER BY s.created_at DESC")->num_rows();
				$data['job_total'] = $this->db->query("SELECT s.*, 
				u.first_name,
				u.last_name,
				u.photo,
				(SELECT count(likeID) FROM likes l WHERE l.userID=".$user_id." AND s.postID=l.itemID) AS likecount  FROM spotlights s INNER JOIN users u ON s.userid=u.userID WHERE s.userid=".$user_id." AND s.spotlight_type='Job Posting' ".$search_filter." ORDER BY s.created_at DESC")->num_rows();				
				
$data['spotit_total'] =$this->db->query("SELECT s.*, 
				u.first_name,
				u.last_name,
				u.photo,
				(SELECT count(likeID) FROM likes l WHERE l.userID=".$user_id." AND s.postID=l.itemID) AS likecount  FROM spotlights s INNER JOIN users u ON s.userid=u.userID WHERE s.userid=".$user_id." AND s.spotlight_type='Spotit Spotlight' ".$search_filter." ORDER BY s.created_at DESC")->num_rows();
			$data['View'] = "enduser/myspotlight";
			$data['page_content'] = $this->load->view($data['View'], $data, true);
			$this->load->view('enduser/layouts/dashboard', $data);
		}else{
			redirect('login');
		}	
	}
	function myspotlight_old(){
		$user_id = $this->session->userdata('user_id');
		if($user_id>0){
			$this->db->where('userID', $user_id );
		    $this->db->from('users');
			$data['userinfo'] = $this->db->get()->row();

			$this->db->where('user_id', $user_id );
			$this->db->from('user_profile');
			$data['userprofileinfo'] = $this->db->get()->row();

			$data['spotlight_posts'] = $this->db->query("SELECT s.*, 
				u.first_name,
				u.last_name,
				u.photo,
				(SELECT count(likeID) FROM likes l WHERE l.userID=".$user_id." AND s.postID=l.itemID) AS likecount  FROM spotlights s INNER JOIN users u ON s.userid=u.userID WHERE s.userid=".$user_id."  ORDER BY s.created_at DESC")->result_array();

			if(!empty($this->input->post('search')))
			{
				$data['search_text'] = $this->input->post('search');
				$data['spotlight_posts'] = $this->db->query("SELECT s.*, 
				u.first_name,
				u.last_name,
				u.photo,
				(SELECT count(likeID) FROM likes l WHERE l.userID=".$user_id." AND s.postID=l.itemID) AS likecount
				 FROM spotlights s INNER JOIN users u ON s.userid=u.userID WHERE s.userid=".$user_id." AND (s.postTitle LIKE '%".$data['search_text']."%' OR s.postContent LIKE '%".$data['search_text']."%')  ORDER BY s.created_at DESC")->result_array();


			}else{
				$data['search_text'] = '';
			}


			$data['View'] = "enduser/myspotlight";
			$data['page_content'] = $this->load->view($data['View'], $data, true);
			$this->load->view('enduser/layouts/dashboard', $data);
		}else{
			redirect('login');
		}	
	}

/*	function activities(){
		$user_id = $this->session->userdata('user_id');
		if($user_id>0){
			$this->db->where('userID', $user_id );
		    $this->db->from('users');
			$data['userinfo'] = $this->db->get()->row();

			$this->db->where('user_id', $user_id );
			$this->db->from('user_profile');
			$data['userprofileinfo'] = $this->db->get()->row();

			$data['spotlight_posts'] = $this->db->query("SELECT s.*, 
				u.first_name,
				u.last_name,
				u.photo,
				(SELECT count(likeID) FROM likes l WHERE l.userID=".$user_id." AND s.postID=l.itemID) AS likecount  FROM spotlights s INNER JOIN users u ON s.userid=u.userID WHERE s.userid=".$user_id."  ORDER BY s.created_at DESC")->result_array();

			if(!empty($this->input->post('search')))
			{
				$data['search_text'] = $this->input->post('search');
				$data['spotlight_posts'] = $this->db->query("SELECT s.*, 
				u.first_name,
				u.last_name,
				u.photo,
				(SELECT count(likeID) FROM likes l WHERE l.userID=".$user_id." AND s.postID=l.itemID) AS likecount
				 FROM spotlights s INNER JOIN users u ON s.userid=u.userID WHERE s.userid=".$user_id." AND (s.postTitle LIKE '%".$data['search_text']."%' OR s.postContent LIKE '%".$data['search_text']."%')  ORDER BY s.created_at DESC")->result_array();


			}else{
				$data['search_text'] = '';
			}


			$data['View'] = "enduser/activities";
			$data['page_content'] = $this->load->view($data['View'], $data, true);
			$this->load->view('enduser/layouts/dashboard', $data);
		}else{
			redirect('login');
		}	
	}*/
  function public_spotlight(){
         $site_id = site_id();
		$user_id = $this->session->userdata('user_id');
		if($user_id>0){
			$this->db->where('userID', $user_id );
			
		    $this->db->from('users');
			$data['userinfo'] = $this->db->get()->row();

			$this->db->where('user_id', $user_id );
			$this->db->from('user_profile');
			$data['userprofileinfo'] = $this->db->get()->row();

			$preferences_arr = json_decode($data['userprofileinfo']->preferences);
			$preferences_str = implode('|', $preferences_arr);
		

			if(!empty($this->input->get('search'))){
				$data['search_text'] = $this->input->get('search');
				$search_filter = " AND (s.postTitle LIKE '%".$data['search_text']."%' OR s.postContent LIKE '%".$data['search_text']."%')";
				$s_qstring= "?search=".$data['search_text'];

			}else{
				$data['search_text'] = '';
				$search_filter ="";
				$s_qstring= "";
			}

			$totalcount = $this->db->query("SELECT s.*, 
				u.first_name,
				u.last_name,
				u.photo,
				u.site_id,
				f.is_following, 
				(SELECT count(likeID) FROM likes l WHERE l.userID=".$user_id." AND s.postID=l.itemID) AS likecount 
				  FROM spotlights s 
				  INNER JOIN users u ON s.userid=u.userID
				  INNER JOIN followers f ON s.userid=f.is_following
				  WHERE s.status=1 AND u.site_id =$site_id".$search_filter." GROUP BY s.postID ORDER BY s.created_at DESC")->num_rows();
            $url_sigment=$s_qstring;
			$config = array();
			$config["base_url"] = base_url() . "/dashboard/public_spotlight/";
			$config["total_rows"] = $totalcount;
			$config["per_page"] = 12;
			$config["uri_segment"] = 3;

			$config['full_tag_open'] = '<nav aria-label="Page navigation example"><ul class="pagination justify-content-center pagination-separated">';
			$config['full_tag_close'] = '</ul></nav>';            
			$config['prev_link'] = '<i data-feather="chevron-left"></i>';
			$config['first_tag_open'] = '<li class="page-item">';
			$config['first_tag_close'] = '</li>';
			$config['prev_tag_open'] = '<li class="page-item">';
			$config['prev_tag_close'] = '</li>';
			$config['next_link'] = '<i data-feather="chevron-right"></i>';
			$config['next_tag_open'] = '<li class="page-item">';
			$config['next_tag_close'] = '</li>';
			$config['last_tag_open'] = '<li class="page-item">';
			$config['last_tag_close'] = '</li>';
			$config['cur_tag_open'] = '<li class="page-item active"><a>';
			$config['cur_tag_close'] = '</a></li>';
			$config['num_tag_open'] = '<li class="page-item">';
			$config['num_tag_close'] = '</li>';
			$config['reuse_query_string'] = true;
			$this->pagination->initialize($config);

			$page = ($this->uri->segment(3))? $this->uri->segment(3) : 0;

			$data["links"] = $this->pagination->create_links();
            
			$data['spotlight_posts'] = $this->db->query("SELECT s.*, 
				u.first_name,
				u.last_name,
				u.photo,
				u.site_id,
				f.is_following, 
				(SELECT count(likeID) FROM likes l WHERE l.userID=".$user_id." AND s.postID=l.itemID) AS likecount 
				  FROM spotlights s 
				  INNER JOIN users u ON s.userid=u.userID
				  INNER JOIN followers f ON s.userid=f.is_following
				  WHERE s.status=1 AND u.site_id =$site_id".$search_filter." GROUP BY s.postID ORDER BY s.created_at DESC
				  	 limit ".$config["per_page"]." OFFSET ".$page)->result_array();
				  
			$data['page_type']='feed';
				$data['View'] = "enduser/public_spotlight";
			$data['page_content'] = $this->load->view($data['View'], $data, true);
			$this->load->view('enduser/layouts/dashboard', $data);
		}else{
			redirect('login');
		}	
	}
	function public_spotlight_old(){
		$site_id = site_id();
		$user_id = $this->session->userdata('user_id');
		if($user_id>0){
			$this->db->where('userID', $user_id );
		    $this->db->from('users');
			$data['userinfo'] = $this->db->get()->row();

			$this->db->where('user_id', $user_id );
			$this->db->from('user_profile');
			$data['userprofileinfo'] = $this->db->get()->row();

			$data['spotlight_posts'] = $this->db->query("SELECT s.*, 
				u.first_name,
				u.last_name,
				u.photo,
				(SELECT count(likeID) FROM likes l WHERE l.userID=".$user_id." AND s.postID=l.itemID) AS likecount
				FROM spotlights s 
				INNER JOIN users u ON s.userid=u.userID  WHERE s.status=1 ORDER BY s.created_at DESC")->result_array();

			if(!empty($this->input->post('search')))
			{
				$data['search_text'] = $this->input->post('search');
				$data['spotlight_posts'] = $this->db->query("SELECT s.*, 
				u.first_name,
				u.last_name,
				u.photo,
				u.site_id,
				(SELECT count(likeID) FROM likes l WHERE l.userID=".$user_id." AND s.postID=l.itemID) AS likecount
				 FROM spotlights s INNER JOIN users u ON s.userid=u.userID WHERE s.userid=u.userID AND u.site_id =$site_id AND (s.postTitle LIKE '%".$data['search_text']."%' OR s.postContent LIKE '%".$data['search_text']."%')  ORDER BY s.created_at DESC")->result_array();


			}else{
				$data['search_text'] = '';
			}

			$data['View'] = "enduser/public_spotlight";
			$data['page_content'] = $this->load->view($data['View'], $data, true);
			$this->load->view('enduser/layouts/dashboard', $data);
		}else{
			redirect('login');
		}	
	}

	function create_new_spotlight(){
		$user_id = $this->session->userdata('user_id');
		if($user_id>0){
			$this->db->where('userID', $user_id );
		    $this->db->from('users');
			$data['userinfo'] = $this->db->get()->row();

			$this->db->where('user_id', $user_id );
			$this->db->from('user_profile');
			$data['userprofileinfo'] = $this->db->get()->row();
			 if(isset($_GET['region']) && $_GET['region']){
			 
			  $reg ='?region=1';
			  $region = 1;
			 }else{
				 $reg='';
				 $region = NULL;
			 }
			$spotid = $this->uri->segment(3);
			if(!empty($spotid) && $spotid>0){
				$this->db->where('postID', $spotid );
			    $this->db->from('spotlights');
				$data['spotlight'] = $this->db->get()->row();
				$data['region_info'] = $this->db->get_where('region_spotlights',array('spotlight_id'=>$spotid))->result();
			}else{
				$data['spotlight'] = (object)array(
					'spotlight_type' => '',
					'postTitle' => '',
					'category' => '',
					'contact_email' => '',
					'contact_phone' => '',
					'coupon_status' => '',
					'coupon' => '',
					'salary_range' => '',
					'job_position' => '',
					'event_start_date' => '',
					'event_start_time' => '',
					'event_end_date' => '',
					'event_end_time' => '',
					'event_location' => '',
					'event_register' => '',
					'postContent' => '',
					'timezone_offset' => '',
					
					'tags' => ''
					);
			}
			$this->form_validation->set_rules('wysiwyg', 'Content', 'required|trim');
			if($this->form_validation->run()) {
				$submit = $this->input->post('submit');
				if($submit)
				{
				    $slug = url_title($this->input->post('postTitle'), "dash", TRUE);
					if(!empty($spotid)){
						$query =$this->db->get_where('spotlights',array('postSlug'=> $slug,'postID !='=>$spotid));
					}else{
						$query =$this->db->get_where('spotlights',array('postSlug'=> $slug));
					}
					 if($query->num_rows()>0){
						 $slug=$slug.'-'.time();
					 }
					$data = array(
						'spotlight_type' => $this->input->post('spotlight_type'),
						'postSlug' =>$slug,
						'userid' =>$user_id,
						'postTitle' => $this->input->post('postTitle'),
						'category' => $this->input->post('category'),
						'contact_email' => $this->input->post('contact_email'),
						'contact_phone' => $this->input->post('contact_phone'),
						'coupon_status' => $this->input->post('coupon_status'),
						'coupon' => $this->input->post('coupon'),
						'salary_range' => $this->input->post('salary_range'),
						'job_position' => $this->input->post('job_position'),
						'event_start_date' => $this->input->post('event_start_date'),
						'event_start_time' => $this->input->post('event_start_time'),
						'event_end_date' => $this->input->post('event_end_date'),
						'event_end_time' => $this->input->post('event_end_time'),
						'timezone_offset' => $this->input->post('timezone_offset'),
						'event_location' => $this->input->post('event_location'),
						'postContent' => $this->input->post('wysiwyg'),
						'tags' => $this->input->post('tags'),
						'region' =>$region,
						'event_register' => $this->input->post('event_register'),
						'hbcu_cat' =>$this->input->post('hbcu_cat')
						);
					if(!empty($spotid)){
						$this->db->update('spotlights',$data, array('postID' => $spotid));
						
						if($region_field = $this->input->post('region')){
							foreach($region_field as $value){
								$this->db->update('region_spotlights',array('web_id'=>$value,'spotlight_id'=>$spotid),array('web_id'=>$value,'spotlight_id'=>$spotid));
							}
						}else{
							 $this->db->select('*');
							$this->db->from('admin_urls');
							if($websites = $this->db->get()->result()){
								foreach($websites as $value){
								$this->db->update('region_spotlights',array('web_id'=>$value->id,'spotlight_id'=>$spotid),array('web_id'=>$value->id,'spotlight_id'=>$spotid));
								}
							}
						}
				    if($submit == 'publish'){
						$this->db->update('spotlights',array('status'=>1),array('postID'=>$spotid));
						redirect('dashboard/myspotlight');
					}elseif($submit == 'draft'){
						$this->db->update('spotlights',array('status'=>2),array('postID'=>$spotid));
						redirect('dashboard/myspotlight');
					}else{
						redirect('dashboard/create_new_spotlight_step2/'.$spotid.$reg);
					}
					}else{
					$status = array('status'=>2,'created_at' => date('Y-m-d H:i:s'));
					$this->db->insert('spotlights',array_merge($status,$data));
					$insert_id = $this->db->insert_id();
					if($region_field = $this->input->post('region')){
							foreach($region_field as $value){
									$this->db->insert('region_spotlights',array('web_id'=>$value,'spotlight_id'=>$insert_id));
							}
					}else{
						 $this->db->select('*');
						$this->db->from('admin_urls');
						if($websites = $this->db->get()->result()){
							foreach($websites as $value){
									$this->db->insert('region_spotlights',array('web_id'=>$value->id,'spotlight_id'=>$insert_id));
							}
						}
						
						
					}
					redirect('dashboard/create_new_spotlight_step2/'.$insert_id.$reg);
					}
				}
			}
				/* $this->form_validation->set_rules('wysiwyg', 'Content', 'required|trim');
        		if($this->form_validation->run()) {
				   $slug = url_title($this->input->post('postTitle'), "dash", TRUE);
					$data = array(
					'userid' => $user_id,
					'spotlight_type' => $this->input->post('spotlight_type'),
					'postTitle' => $this->input->post('postTitle'),
					'category' => $this->input->post('category'),
					 'postSlug' =>$slug,
					'contact_email' => $this->input->post('contact_email'),
					'contact_phone' => $this->input->post('contact_phone'),
					'coupon_status' => $this->input->post('coupon_status'),
					'coupon' => $this->input->post('coupon'),
					'salary_range' => $this->input->post('salary_range'),
					'job_position' => $this->input->post('job_position'),
					'event_date' => $this->input->post('event_date'),
					'event_time' => $this->input->post('event_time'),
					'event_location' => $this->input->post('event_location'),
					'postContent' => $this->input->post('wysiwyg'),
					'created_at' => date('Y-m-d H:i:s'),
					);	

					$this->db->insert('spotlights',$data);
					$insert_id = $this->db->insert_id();

					redirect('dashboard/create_new_spotlight_step2/'.$insert_id);
				}
		   }*/



			$data['View'] = "enduser/create_new_spotlight";
			$data['page_type']='spotlight';
			$data['page_content'] = $this->load->view($data['View'], $data, true);
			$this->load->view('enduser/layouts/dashboard', $data);
		}else{
			redirect('login');
		}	
	}

	function create_new_spotlight_step2(){
		$user_id = $this->session->userdata('user_id');
		if($user_id>0){
			$this->db->where('userID', $user_id );
		    $this->db->from('users');
			$data['userinfo'] = $this->db->get()->row();

			$this->db->where('user_id', $user_id );
			$this->db->from('user_profile');
			$data['userprofileinfo'] = $this->db->get()->row();
			$spotlightid = $this->uri->segment(3);
			if(!empty($spotlightid) && $spotlightid>0){
				$this->db->where('postID', $spotlightid );
			    $this->db->from('spotlights');
				$data['spotlight'] = $this->db->get()->row();
			}
			$data['spotlight_images'] = $this->db->query("SELECT * FROM spotlights_images WHERE spotlight_id=".$spotlightid)->result_array();
				
			$data['View'] = "enduser/create_new_spotlight_step2";
			$data['page_type']='spotlight3';
			$data['page_content'] = $this->load->view($data['View'], $data, true);
			$this->load->view('enduser/layouts/dashboard', $data);	
				
		}else{
			redirect('login');
		}	
	}
	function create_new_spotlight_step3(){
		//print_r($_POST); die;
		$user_id = $this->session->userdata('user_id');
		if($user_id>0){
			$this->db->where('userID', $user_id );
		    $this->db->from('users');
			$data['userinfo'] = $this->db->get()->row();
$em_video = $this->input->post('em_video');
			$this->db->where('user_id', $user_id );
			$this->db->from('user_profile');
			$data['userprofileinfo'] = $this->db->get()->row();
			$spotlightid = $this->uri->segment(3);
		
			if(!empty($spotlightid) && $spotlightid>0){
				$this->db->where('postID', $spotlightid );
			    $this->db->from('spotlights');
				$data['spotlight'] = $this->db->get()->row();
			}
			if($this->input->post('submit')==3)
			{
				$updateData = array('em_video' => $em_video);
        		$this->db->update('spotlights', $updateData, array('postID' => $spotlightid, 'userid'=>$user_id));
        		redirect('dashboard/create_new_spotlight_step3/'.$spotlightid);
			}
			if($this->input->post('submit')==1)
			{
				//$updateData = array('status' => '1');
				$updateData = array('em_video' => $em_video,'status' => '1');
        		$this->db->update('spotlights', $updateData, array('postID' => $spotlightid, 'userid'=>$user_id));
        		redirect('dashboard/myspotlight');
			}
			if($this->input->post('submit')==2  )
			{
				//$updateData = array('status' => '2');
				$updateData = array('em_video' => $em_video,'status' => '2');
        		$this->db->update('spotlights', $updateData, array('postID' => $spotlightid, 'userid'=>$user_id));
        		redirect('dashboard/myspotlight');
			}	

			$data['View'] = "enduser/create_new_spotlight_step3";
			$data['page_type']='spotlight2';
			$data['page_content'] = $this->load->view($data['View'], $data, true);
			$this->load->view('enduser/layouts/dashboard', $data);	
				
		}else{
			redirect('login');
		}	
	}
	function display_image(){
		$spotlightid = $this->uri->segment(3);
		$spotlight_images = $this->db->order_by('sort_order','asc')->get_where('spotlights_images',array('spotlight_id'=>$spotlightid))->result_array();
		
		//$this->db->query("SELECT * FROM spotlights_images  WHERE spotlight_id='$spotlightid' ORDER BY spotlights_images.sort_order DESC" )->result_array();

		foreach ($spotlight_images as $spotlight_image) {
			$obj['name'] = $spotlight_image['image_name'];
			$obj['fileid'] = $spotlight_image['id'];
			$obj['filelink'] = FCPATH ."uploads/profile_img/".$spotlight_image['image_name'];
            $obj['size'] = '1000';
            $result[] = $obj;
		}
		header('Content-type: text/json');              //3
		header('Content-type: application/json');
		echo json_encode($result);

	}
function multi_image_upload(){
	$spotlightid = $this->uri->segment(3);
	
	$this->db->where('postID', $spotlightid );
    $this->db->from('spotlights');
	$spotlight = $this->db->get()->row();

	$filename = "";
    $target_path = base_url() . "uploads/spotlights/";


    if ($_FILES['file']['name']!="" ) {

       	$target_path = $target_path . basename($_FILES['file']['name']);

        $config['upload_path'] = './uploads/spotlights/';
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
     	$config['max_size'] = '1024'; // max_size in kb
     	$config['file_name'] = $_FILES['file']['name'];
        //$config['max_width']  = '1024';
        //$config['max_height']  = '768';
        $this->load->library('upload', $config);

        if ($this->upload->do_upload('file')){
			$upload_data = $this->upload->data();

            $insData = array(
            			'image_name' => $upload_data['file_name'],
        				'spotlight_id' => $spotlightid,
        				'image_type' => 'featured',
        				'created_at' => date('Y-m-d H:i:s'));
            $this->db->insert('spotlights_images',$insData);
            $insert_id = $this->db->insert_id();
            $filelink=FCPATH."uploads/spotlights/".$config['file_name'];
            echo json_encode(array("status"=>"success", "filelink"=>$filelink,"image_id"=>"$insert_id"));
			die();
        }
    }
    echo json_encode(array("status"=>"0", "image_id"=>"0"));
	die();
}
function delete_image(){
	$imageid = $this->uri->segment(3);

	@unlink($this->input->post('file_name'));

	$this->db->where('id', $imageid);
    $this->db->delete('spotlights_images'); 
    echo json_encode(array("status"=>"success"));
	die();
}

public function ajax_coverphoto_upload()
    {
	   $user_id = $this->session->userdata('user_id');
        $data = $_POST['image'];
     	$spotlightid = $this->uri->segment(3);

		if($_POST['submit'] == 1){
			$updateData = array('status' => '1');
		}else{
		$updateData = array('status' => '2');
		}
       $reasda =  $this->db->update('spotlights', $updateData, array('postID' => $spotlightid));
        list($type, $data) = explode(';', $data);
        list(, $data)      = explode(',', $data);
     	$this->db->from('spotlights');
		$this->db->where('postID', $spotlightid);
		$check_img = $this->db->get()->row();
		if($photo = $check_img->cover_photo){
			@unlink(FCPATH ."images/cover_photo/".$photo);
		}
        $data = base64_decode($data);
		
		if(!$check_img->cover_photo && !$data){
			echo 'Please Upload Picture'; die;
		}else{
        $imageName = time().'.png';
        file_put_contents(FCPATH .'images/cover_photo/'.$imageName, $data);
		$insData = array('cover_photo' => $imageName);
        $this->db->update('spotlights', $insData, array('postID' => $spotlightid));
		  
			echo 'Image Upload Suceessfully'; die;
		}
    }
public function uploads()
	{
	if(!$this->input->is_ajax_request()) return error(404);
	
	if(!$this->session->userdata('user_id'))
	{
		echo json_encode(array('status' => 403, 'messages' => phrase('please_login_to_change_photo_or_cover')));
	}
	else
	{
		$type = $_GET['type'];
		
		if($type == 'photo')
		{
			$config['upload_path'] 	= 'uploads/profile_img';
		}
		elseif($type == 'cover')
		{
			$config['upload_path'] 	= 'images';
		}
		else
		{
			return false;
		}
		$config['allowed_types'] 	= 'jpg|jpeg|png';
		$config['max_size']      	= 1024*2; // 2MB
		$config['encrypt_name']	 	= TRUE;
		$this->load->library('upload', $config);
		
		if(!$this->upload->do_upload())
		{
			echo json_encode(array('status' => 1024, 'messages' => array(str_replace(array('<p>', '</p>'),'', $this->upload->display_errors()
			
			.'<br> Max Upload File Size 2MB'))));
		} 
		else
		{
			if($type == 'photo')
			{
				$this->upload_data['userfile'] = $this->upload->data();
	
				//upload successful generate a thumbnail
				$config['image_library'] 	= 'gd2';
				$config['source_image'] 	= 'images/' . $this->upload_data['userfile']['file_name'];
				$config['create_thumb'] 	= FALSE;
				$config['maintain_ratio'] 	= TRUE;
				$config['width']     		= 500;
				$config['height']   		= 500;
	
				$this->load->library('image_lib', $config);
				$this->image_lib->initialize($config);
	
				if($this->image_lib->resize())
				{
					$this->image_lib->clear();
					generateThumbnail('users', $this->upload_data['userfile']['file_name']);
				}
			}
			elseif($type == 'cover')
			{
				$this->upload_data['userfile'] = $this->upload->data();
	
				//upload successful generate a thumbnail
				$config['image_library'] 	= 'gd2';
				$config['source_image'] 	= 'uploads/covers/' . $this->upload_data['userfile']['file_name'];
				$config['create_thumb'] 	= FALSE;
				$config['maintain_ratio'] 	= TRUE;
				$config['width']     		= 1024;
				$config['height']   		= 400;
	
				$this->load->library('image_lib', $config);
				$this->image_lib->initialize($config);
	
				$this->image_lib->resize();
				$this->image_lib->clear();
			}
			
			$this->db->select($type);
			$this->db->where('userID', $this->session->userdata('userID'));
			$this->db->limit(1);
			$query = $this->db->get('users');
			
			if($query->num_rows() > 0)
			{
				foreach($query->result_array() as $row)
				{
					if($type == 'photo' && file_exists('uploads/profile_img/' . $row['photo']))
					{
						unlink('uploads/users/' . $row['photo']);
						if(file_exists('uploads/profile_img/thumbs/' . $row['photo']))
						{
							unlink(FCPATH .'uploads/users/thumbs/' . $row['photo']);
						}
					}
					elseif($type == 'cover')
					{
						unlink(FCPATH .'uploads/covers/' . $row['cover']);
					}
				}
			}
			 $upload_data = $this->upload->data();
			 if($type  =='cover'){
				 $tbl_col ='cover';
			 }else{
				  $tbl_col ='photo';
			 }
			 $insData = array( $tbl_col => $upload_data['file_name']);
			if($this->db->update('users', $insData, array('userID' => $this->session->userdata('user_id')) )){
				echo json_encode(array('status' => 200, 'messages' =>'Uploaded sucessfully'));
			}
			else
			{
				echo json_encode(array('status' => 500, 'messages' =>'unable to upload'));
			}
		}
	}
	}
	
	function delete_spotlight(){
		if(empty($this->session->userdata('user_id'))){
				redirect('dashboard/myspotlight');		
		}
		$spotlightid = $this->uri->segment(3);
		$user_id = $this->session->userdata('user_id');
		$this->db->where('userid', $user_id);
		$this->db->where('postID', $spotlightid);
		$this->db->delete('spotlights');
		
		
		$this->db->where('spotlight_id',$spotlightid);
		$this->db->delete('region_spotlights');

		redirect('dashboard/myspotlight');
	}

      function myfeed_old(){
         $site_id = site_id();
		$user_id = $this->session->userdata('user_id');
		if($user_id>0){
			$this->db->where('userID', $user_id );
			
		    $this->db->from('users');
			$data['userinfo'] = $this->db->get()->row();

			$this->db->where('user_id', $user_id );
			$this->db->from('user_profile');
			$data['userprofileinfo'] = $this->db->get()->row();

			$preferences_arr = json_decode($data['userprofileinfo']->preferences);
			$preferences_str = implode('|', $preferences_arr);
			
			
			
			$url_sigment = $this->uri->segment(3);
			if($url_sigment =='news'){
				$where_filter = " AND s.spotlight_type='News / Blog'";
			}elseif($url_sigment =='jobs'){
				 $where_filter = " AND s.spotlight_type='Job Posting'";
			}elseif($url_sigment =='events'){
				 	 $where_filter = " AND s.spotlight_type='Events'";
			}elseif($url_sigment =='spotit'){	 
			$where_filter = " AND s.spotlight_type='Spotit Spotlight'";
			}else{
				$where_filter ="";
			}

			if(!empty($this->input->get('search'))){
				$data['search_text'] = $this->input->get('search');
				$search_filter = " AND (s.postTitle LIKE '%".$data['search_text']."%' OR s.postContent LIKE '%".$data['search_text']."%')";
				$s_qstring= "?search=".$data['search_text'];

			}else{
				$data['search_text'] = '';
				$search_filter ="";
				$s_qstring= "";
			}

			$totalcount = $this->db->query("SELECT s.*, 
				u.first_name,
				u.last_name,
				u.photo,
				u.site_id,
				f.is_following, 
				(SELECT count(likeID) FROM likes l WHERE l.userID=".$user_id." AND s.postID=l.itemID) AS likecount 
				  FROM spotlights s 
				  INNER JOIN users u ON s.userid=u.userID
				  INNER JOIN followers f ON s.userid=f.is_following
				  WHERE s.status=1 AND s.userid !=".$user_id.$where_filter.$search_filter." GROUP BY s.postID ORDER BY s.created_at DESC")->num_rows();
		    
           if(!$url_sigment) $url_sigment='all'.$s_qstring;
			$config = array();
			$config["base_url"] = base_url() . "/dashboard/myfeed/". $url_sigment;
			$config["total_rows"] = $totalcount;
			$config["per_page"] = 12;
			$config["uri_segment"] = 4;

			$config['full_tag_open'] = '<nav aria-label="Page navigation example"><ul class="pagination justify-content-center pagination-separated">';
			$config['full_tag_close'] = '</ul></nav>';            
			$config['prev_link'] = '<i data-feather="chevron-left"></i>';
			$config['first_tag_open'] = '<li class="page-item">';
			$config['first_tag_close'] = '</li>';
			$config['prev_tag_open'] = '<li class="page-item">';
			$config['prev_tag_close'] = '</li>';
			$config['next_link'] = '<i data-feather="chevron-right"></i>';
			$config['next_tag_open'] = '<li class="page-item">';
			$config['next_tag_close'] = '</li>';
			$config['last_tag_open'] = '<li class="page-item">';
			$config['last_tag_close'] = '</li>';
			$config['cur_tag_open'] = '<li class="page-item active"><a>';
			$config['cur_tag_close'] = '</a></li>';
			$config['num_tag_open'] = '<li class="page-item">';
			$config['num_tag_close'] = '</li>';
			$config['reuse_query_string'] = true;
			$this->pagination->initialize($config);

			$page = ($this->uri->segment(4))? $this->uri->segment(4) : 0;

			$data["links"] = $this->pagination->create_links();
            
			$data['spotlight_all'] = $this->db->query("SELECT s.*, 
				u.first_name,
				u.last_name,
				u.photo,
				u.site_id,
				fl.is_following, 
				(SELECT count(likeID) FROM likes l WHERE l.userID=".$user_id." AND s.postID=l.itemID) AS likecount 
				  FROM spotlights s 
				  INNER JOIN followers fl ON s.userid=fl.is_following
				  INNER JOIN users u ON s.userid=u.userID
				  WHERE s.status=1 AND s.userid !=".$user_id.$where_filter.$search_filter." GROUP BY s.postID ORDER BY s.created_at DESC
				  	 limit ".$config["per_page"]." OFFSET ".$page)->result_array();
				  
				  
				  
				  
      $data['news_total'] = $this->db->query("SELECT s.*, 
				u.first_name,
				u.last_name,
				u.photo,
				u.site_id,
				f.is_following,
				(SELECT count(likeID) FROM likes l WHERE l.userID=".$user_id." AND s.postID=l.itemID) AS likecount
				  FROM spotlights s 
				  INNER JOIN users u ON s.userid=u.userID  
				  INNER JOIN followers f ON s.userid=f.is_following
				  WHERE  s.spotlight_type='News / Blog'  AND s.status=1 AND s.userid !=".$user_id.$search_filter." GROUP BY s.postID")->num_rows();
				  
				  
				  
	   $data['job_total'] = $this->db->query("SELECT s.*, 
				u.first_name,
				u.last_name,
					u.site_id,
				u.photo,
				(SELECT count(likeID) FROM likes l WHERE l.userID=".$user_id." AND s.postID=l.itemID) AS likecount
				  FROM spotlights s 
				  INNER JOIN users u ON s.userid=u.userID
				  INNER JOIN followers f ON s.userid=f.is_following
				  WHERE  s.spotlight_type='Job Posting'  AND s.status=1  AND s.userid !=".$user_id.$search_filter." GROUP BY s.postID")->num_rows();
				  
				  
				  
     $data['event_total'] = $this->db->query("SELECT s.*, 
				u.first_name,
				u.last_name,
				u.photo,
					u.site_id,
				(SELECT count(likeID) FROM likes l WHERE l.userID=".$user_id." AND s.postID=l.itemID) AS likecount
				  FROM spotlights s 
				  INNER JOIN users u ON s.userid=u.userID
				  INNER JOIN followers f ON s.userid=f.is_following
				  WHERE  s.spotlight_type='Events' AND s.status=1 AND s.userid !=".$user_id.$search_filter." GROUP BY s.postID")->num_rows();
				  
				  
				  
				  
  $data['spotit_total'] = $this->db->query("SELECT s.*, 
				u.first_name,
				u.last_name,
				u.photo,
					u.site_id, 
				(SELECT count(likeID) FROM likes l WHERE l.userID=".$user_id." AND s.postID=l.itemID) AS likecount
				  FROM spotlights s 
				  INNER JOIN users u ON s.userid=u.userID
				  INNER JOIN followers f ON s.userid=f.is_following
				  WHERE  s.spotlight_type='Spotit Spotlight' AND s.status=1 AND s.userid !=".$user_id.$search_filter." GROUP BY s.postID")->num_rows();
			
			/*if(!empty($this->input->post('search')))
			{
				$data['search_text'] = $this->input->post('search');

				$data['spotlight_all'] = $this->db->query("SELECT s.*, 
				u.first_name,
				u.last_name,
				u.photo,
				(SELECT count(likeID) FROM likes l WHERE l.userID=".$user_id." AND s.postID=l.itemID) AS likecount
				 FROM spotlights s INNER JOIN users u ON s.userid=u.userID   WHERE s.category REGEXP '^(".$preferences_str.")'  AND s.status=1 AND (s.postTitle LIKE '%".$data['search_text']."%' OR s.postContent LIKE '%".$data['search_text']."%')  ORDER BY s.created_at DESC")->result_array();
				$data['spotlight_news'] = $this->db->query("SELECT s.*, 
				u.first_name,
				u.last_name,
				u.photo,
				(SELECT count(likeID) FROM likes l WHERE l.userID=".$user_id." AND s.postID=l.itemID) AS likecount
				 FROM spotlights s INNER JOIN users u ON s.userid=u.userID WHERE s.spotlight_type='News / Blog' AND s.category REGEXP '^(".$preferences_str.")' AND s.status=1 AND (s.postTitle LIKE '%".$data['search_text']."%' OR s.postContent LIKE '%".$data['search_text']."%')  ORDER BY s.created_at DESC")->result_array();
				$data['spotlight_spotit'] = $this->db->query("SELECT s.*, 
				u.first_name,
				u.last_name,
				u.photo,
				(SELECT count(likeID) FROM likes l WHERE l.userID=".$user_id." AND s.postID=l.itemID) AS likecount
				FROM spotlights s INNER JOIN users u ON s.userid=u.userID WHERE spotlight_type='Spotit Spotlight' AND s.category REGEXP '^(".$preferences_str.")' AND s.status=1 AND (s.postTitle LIKE '%".$data['search_text']."%' OR s.postContent LIKE '%".$data['search_text']."%')  ORDER BY s.created_at DESC")->result_array();
				$data['spotlight_job'] = $this->db->query("SELECT s.*, 
				u.first_name,
				u.last_name,
				u.photo,
				(SELECT count(likeID) FROM likes l WHERE l.userID=".$user_id." AND s.postID=l.itemID) AS likecount
				FROM spotlights s INNER JOIN users u ON s.userid=u.userID WHERE s.spotlight_type='Job Posting' AND s.category REGEXP '^(".$preferences_str.")' AND s.status=1 AND (s.postTitle LIKE '%".$data['search_text']."%' OR s.postContent LIKE '%".$data['search_text']."%')  ORDER BY s.created_at DESC")->result_array();
				$data['spotlight_event'] = $this->db->query("SELECT s.*, 
				u.first_name,
				u.last_name,
				u.photo,
				(SELECT count(likeID) FROM likes l WHERE l.userID=".$user_id." AND s.postID=l.itemID) AS likecount
				FROM spotlights s INNER JOIN users u ON s.userid=u.userID WHERE s.spotlight_type='Events' AND s.category REGEXP '^(".$preferences_str.")' AND s.status=1 AND (s.postTitle LIKE '%".$data['search_text']."%' OR s.postContent LIKE '%".$data['search_text']."%')  ORDER BY s.created_at DESC")->result_array();

			}else{
				$data['search_text'] = '';
			}*/

			$data['page_type']='feed';
			$data['View'] = "enduser/feed";
			$data['page_content'] = $this->load->view($data['View'], $data, true);
			$this->load->view('enduser/layouts/dashboard', $data);
		}else{
			redirect('login');
		}	
	}


	function myfeed_old_can_del(){
		$user_id = $this->session->userdata('user_id');
		if($user_id>0){
			$this->db->where('userID', $user_id );
			
		    $this->db->from('users');
			$data['userinfo'] = $this->db->get()->row();

			$this->db->where('user_id', $user_id );
			$this->db->from('user_profile');
			$data['userprofileinfo'] = $this->db->get()->row();

			$preferences_arr = json_decode($data['userprofileinfo']->preferences);
			$preferences_str = implode('|', $preferences_arr);
			
			/*echo "SELECT s.*, 
				u.first_name,
				u.last_name,
				u.photo,
				(SELECT count(likeID) FROM likes l WHERE l.userID=".$user_id." AND s.postID=l.itemID) AS likecount
				  FROM spotlights s INNER JOIN users u ON s.userid=u.userID  WHERE s.category REGEXP '^(".$preferences_str.")'  AND s.status=1";exit;*/
			
			/*-----*/
			$totalcount = $this->db->count_all("spotlights");

			$config = array();
			$config["base_url"] = base_url() . "/dashboard/myfeed";
			$config["total_rows"] = $totalcount;
			$config["per_page"] = 1;
			$config["uri_segment"] = 3;

			$this->pagination->initialize($config);


			$page = ($this->uri->segment(3))? $this->uri->segment(3) : 0;

			$data["links"] = $this->pagination->create_links();

			$data['spotlight_all'] = $this->db->query("SELECT s.*, 
				u.first_name,
				u.last_name,
				u.photo,
				(SELECT count(likeID) FROM likes l WHERE l.userID=".$user_id." AND s.postID=l.itemID) AS likecount
				  FROM spotlights s INNER JOIN users u ON s.userid=u.userID  WHERE s.category REGEXP '^(".$preferences_str.")'  AND s.status=1 limit ".$config["per_page"].",".$page)->result_array();




			/*-------*/







			$data['spotlight_news'] = $this->db->query("SELECT s.*, 
				u.first_name,
				u.last_name,
				u.photo,
				(SELECT count(likeID) FROM likes l WHERE l.userID=".$user_id." AND s.postID=l.itemID) AS likecount
				  FROM spotlights s INNER JOIN users u ON s.userid=u.userID WHERE s.spotlight_type='News / Blog' AND s.category REGEXP '^(".$preferences_str.")' AND s.status=1")->result_array();
			$data['spotlight_spotit'] = $this->db->query("SELECT s.*, 
				u.first_name,
				u.last_name,
				u.photo,
				(SELECT count(likeID) FROM likes l WHERE l.userID=".$user_id." AND s.postID=l.itemID) AS likecount  
				FROM spotlights s INNER JOIN users u ON s.userid=u.userID WHERE s.spotlight_type='Spotit Spotlight' AND s.category REGEXP '^(".$preferences_str.")' AND s.status=1")->result_array();
			$data['spotlight_job'] = $this->db->query("SELECT s.*, 
				u.first_name,
				u.last_name,
				u.photo,
				(SELECT count(likeID) FROM likes l WHERE l.userID=".$user_id." AND s.postID=l.itemID) AS likecount
				  FROM spotlights s INNER JOIN users u ON s.userid=u.userID WHERE s.spotlight_type='Job Posting' AND s.category REGEXP '^(".$preferences_str.")' AND s.status=1")->result_array();
			$data['spotlight_event'] = $this->db->query("SELECT s.*, 
				u.first_name,
				u.last_name,
				u.photo,
				(SELECT count(likeID) FROM likes l WHERE l.userID=".$user_id." AND s.postID=l.itemID) AS likecount
				 FROM spotlights s INNER JOIN users u ON s.userid=u.userID WHERE s.spotlight_type='Events' AND s.category REGEXP '^(".$preferences_str.")' AND s.status=1")->result_array();
			
			if(!empty($this->input->post('search')))
			{
				$data['search_text'] = $this->input->post('search');

				$data['spotlight_all'] = $this->db->query("SELECT s.*, 
				u.first_name,
				u.last_name,
				u.photo,
				(SELECT count(likeID) FROM likes l WHERE l.userID=".$user_id." AND s.postID=l.itemID) AS likecount
				 FROM spotlights s INNER JOIN users u ON s.userid=u.userID   WHERE s.category REGEXP '^(".$preferences_str.")'  AND s.status=1 AND (s.postTitle LIKE '%".$data['search_text']."%' OR s.postContent LIKE '%".$data['search_text']."%')  ORDER BY s.created_at DESC")->result_array();
				$data['spotlight_news'] = $this->db->query("SELECT s.*, 
				u.first_name,
				u.last_name,
				u.photo,
				(SELECT count(likeID) FROM likes l WHERE l.userID=".$user_id." AND s.postID=l.itemID) AS likecount
				 FROM spotlights s INNER JOIN users u ON s.userid=u.userID WHERE s.spotlight_type='News / Blog' AND s.category REGEXP '^(".$preferences_str.")' AND s.status=1 AND (s.postTitle LIKE '%".$data['search_text']."%' OR s.postContent LIKE '%".$data['search_text']."%')  ORDER BY s.created_at DESC")->result_array();
				$data['spotlight_spotit'] = $this->db->query("SELECT s.*, 
				u.first_name,
				u.last_name,
				u.photo,
				(SELECT count(likeID) FROM likes l WHERE l.userID=".$user_id." AND s.postID=l.itemID) AS likecount
				FROM spotlights s INNER JOIN users u ON s.userid=u.userID WHERE spotlight_type='Spotit Spotlight' AND s.category REGEXP '^(".$preferences_str.")' AND s.status=1 AND (s.postTitle LIKE '%".$data['search_text']."%' OR s.postContent LIKE '%".$data['search_text']."%')  ORDER BY s.created_at DESC")->result_array();
				$data['spotlight_job'] = $this->db->query("SELECT s.*, 
				u.first_name,
				u.last_name,
				u.photo,
				(SELECT count(likeID) FROM likes l WHERE l.userID=".$user_id." AND s.postID=l.itemID) AS likecount
				FROM spotlights s INNER JOIN users u ON s.userid=u.userID WHERE s.spotlight_type='Job Posting' AND s.category REGEXP '^(".$preferences_str.")' AND s.status=1 AND (s.postTitle LIKE '%".$data['search_text']."%' OR s.postContent LIKE '%".$data['search_text']."%')  ORDER BY s.created_at DESC")->result_array();
				$data['spotlight_event'] = $this->db->query("SELECT s.*, 
				u.first_name,
				u.last_name,
				u.photo,
				(SELECT count(likeID) FROM likes l WHERE l.userID=".$user_id." AND s.postID=l.itemID) AS likecount
				FROM spotlights s INNER JOIN users u ON s.userid=u.userID WHERE s.spotlight_type='Events' AND s.category REGEXP '^(".$preferences_str.")' AND s.status=1 AND (s.postTitle LIKE '%".$data['search_text']."%' OR s.postContent LIKE '%".$data['search_text']."%')  ORDER BY s.created_at DESC")->result_array();

			}else{
				$data['search_text'] = '';
			}

			$data['page_type']='feed';
			$data['View'] = "enduser/feed";
			$data['page_content'] = $this->load->view($data['View'], $data, true);
			$this->load->view('enduser/layouts/dashboard', $data);
		}else{
			redirect('login');
		}	
	}
	
	
	function main_search(){
	    $site_id = site_id();
		$user_id = $this->session->userdata('user_id');
		if($user_id>0){
			$this->db->where('userID', $user_id );
			
		    $this->db->from('users');
			$data['userinfo'] = $this->db->get()->row();

			$this->db->where('user_id', $user_id );
			$this->db->from('user_profile');
			$data['userprofileinfo'] = $this->db->get()->row();

			/*$preferences_arr = json_decode($data['userprofileinfo']->preferences);
			$preferences_str = implode('|', $preferences_arr);*/
			
			$url_sigment = $this->uri->segment(3);
			if($url_sigment =='news'){
				$where_filter = " AND s.spotlight_type='News / Blog'";
			}elseif($url_sigment =='jobs'){
				 $where_filter = " AND s.spotlight_type='Job Posting'";
			}elseif($url_sigment =='events'){
				 	 $where_filter = " AND s.spotlight_type='Events'";
			}elseif($url_sigment =='spotit'){	 
			$where_filter = " AND s.spotlight_type='Spotit Spotlight'";
			}else{
				$where_filter ="";
			}

			if(!empty($this->input->get('search'))){
				$data['search_text'] = $this->input->get('search');
				$search_filter = " AND (s.postTitle LIKE '%".$data['search_text']."%' OR s.postContent LIKE '%".$data['search_text']."%')";
				$s_qstring= "?search=".$data['search_text'];

			}else{
				$data['search_text'] = '';
				$search_filter ="";
				$s_qstring= "";
			}
			
			
			/*---------------*/
			$totalcount = $this->db->query("SELECT s.*, 
				u.first_name,
				u.last_name,
				u.photo,
				u.site_id,
					 r.spotlight_id,
				r.web_id,
				(SELECT count(likeID) FROM likes l WHERE l.userID=".$user_id." AND s.postID=l.itemID) AS likecount
				  FROM spotlights s
				  
				    LEFT JOIN region_spotlights r ON (r.web_id=".$site_id." AND r.spotlight_id=s.postID)
				  INNER JOIN users u ON s.userid=u.userID AND ((u.level = 3 AND r.web_id=".$site_id.") OR (u.level != 3 AND u.site_id  =$site_id)) 
				  
				    WHERE 1=1 ".$where_filter."  AND s.status=1 AND u.site_id= $site_id ".$search_filter)->num_rows();
		    
			$config = array();
			$config["base_url"] = base_url() . "/dashboard/main_search/". $url_sigment;
			$config["total_rows"] = $totalcount;
			$config["per_page"] = 12;
			$config["uri_segment"] = 4;
			
			$config['full_tag_open'] = '<nav aria-label="Page navigation example"><ul class="pagination justify-content-center pagination-separated">';
			$config['full_tag_close'] = '</ul></nav>';            
			$config['prev_link'] = '<i data-feather="chevron-left"></i>';
			$config['first_tag_open'] = '<li class="page-item">';
			$config['first_tag_close'] = '</li>';
			$config['prev_tag_open'] = '<li class="page-item">';
			$config['prev_tag_close'] = '</li>';
			$config['next_link'] = '<i data-feather="chevron-right"></i>';
			$config['next_tag_open'] = '<li class="page-item">';
			$config['next_tag_close'] = '</li>';
			$config['last_tag_open'] = '<li class="page-item">';
			$config['last_tag_close'] = '</li>';
			$config['cur_tag_open'] = '<li class="page-item active"><a>';
			$config['cur_tag_close'] = '</a></li>';
			$config['num_tag_open'] = '<li class="page-item">';
			$config['num_tag_close'] = '</li>';
			$config['reuse_query_string'] = true;
			$this->pagination->initialize($config);

			$page = ($this->uri->segment(4))? $this->uri->segment(4) : 0;

			$data["links"] = $this->pagination->create_links();
			

			if(!empty($this->input->get('search'))){
				$user_search_filter = " AND (u.first_name LIKE '%".$data['search_text']."%' OR u.last_name LIKE '%".$data['search_text']."%')";
			}else{
				$user_search_filter ="";
			}

			if($url_sigment =='users'){
				$data['spotlight_all'] = $this->db->query("SELECT  u.userID,
				u.first_name,
				u.last_name,
				u.photo,
				u.site_id,
				up.complete_profile,
				up.user_id 
				FROM users u 
				INNER JOIN user_profile up ON up.user_id=u.userID  
				
				 WHERE 1=1 AND up.complete_profile=1 AND u.site_id =$site_id AND u.userID!=".$user_id." ".$user_search_filter." ORDER BY u.userID ASC limit ".$config["per_page"]." OFFSET ".$page)->result_array();
				/*$data['spotlight_all'] = $this->db->query("SELECT  u.userID,
				u.first_name,
				u.last_name,
				u.photo
				FROM users u WHERE 1=1 AND u.is_email_verified=1 AND u.userID!=".$user_id." ".$user_search_filter." ORDER BY u.userID ASC limit ".$config["per_page"]." OFFSET ".$page)->result_array();*/
			}else{
				$data['spotlight_all'] = $this->db->query("SELECT s.*, 
				u.first_name,
				u.last_name,
				u.photo,
					u.site_id,
					 r.spotlight_id,
				r.web_id,
				(SELECT count(likeID) FROM likes l WHERE l.userID=".$user_id." AND s.postID=l.itemID) AS likecount
				  FROM spotlights s 
				  
	
				   LEFT JOIN region_spotlights r ON (r.web_id=".$site_id." AND r.spotlight_id=s.postID)
				  INNER JOIN users u ON s.userid=u.userID AND ((u.level = 3 AND r.web_id=".$site_id.") OR (u.level != 3 AND u.site_id  =$site_id)) 
				  
				    WHERE 1=1 ".$where_filter." AND s.status=1 ".$search_filter." ORDER BY s.created_at DESC limit ".$config["per_page"]." OFFSET ".$page)->result_array();
			}	  
				  
				  
      $data['news_total'] = $this->db->query("SELECT s.*, 
				u.first_name,
				u.last_name,
				u.photo,
				u.site_id,
				 r.spotlight_id,
				r.web_id,
				(SELECT count(likeID) FROM likes l WHERE l.userID=".$user_id." AND s.postID=l.itemID) AS likecount
				  FROM spotlights s
				  
				   LEFT JOIN region_spotlights r ON (r.web_id=".$site_id." AND r.spotlight_id=s.postID)
				  INNER JOIN users u ON s.userid=u.userID AND ((u.level = 3 AND r.web_id=".$site_id.") OR (u.level != 3 AND u.site_id  =$site_id)) 
				  
				  WHERE 1=1 AND s.spotlight_type='News / Blog'  AND s.status=1".$search_filter)->num_rows();
				  
				  
				  
	   $data['job_total'] = $this->db->query("SELECT s.*, 
				u.first_name,
				u.last_name,
				u.photo,
				u.site_id,
				 r.spotlight_id,
				r.web_id,
				(SELECT count(likeID) FROM likes l WHERE l.userID=".$user_id." AND s.postID=l.itemID) AS likecount
				  FROM spotlights s 
				   LEFT JOIN region_spotlights r ON (r.web_id=".$site_id." AND r.spotlight_id=s.postID)
				  INNER JOIN users u ON s.userid=u.userID AND ((u.level = 3 AND r.web_id=".$site_id.") OR (u.level != 3 AND u.site_id  =$site_id)) 
				  
				    WHERE 1=1 AND s.spotlight_type='Job Posting'  AND s.status=1".$search_filter)->num_rows();
				  
				  
				  
     $data['event_total'] = $this->db->query("SELECT s.*, 
				u.first_name,
				u.last_name,
				u.photo,
				u.site_id,
				 r.spotlight_id,
				r.web_id,
				(SELECT count(likeID) FROM likes l WHERE l.userID=".$user_id." AND s.postID=l.itemID) AS likecount
				  FROM spotlights s 
				  
				    LEFT JOIN region_spotlights r ON (r.web_id=".$site_id." AND r.spotlight_id=s.postID)
				  INNER JOIN users u ON s.userid=u.userID AND ((u.level = 3 AND r.web_id=".$site_id.") OR (u.level != 3 AND u.site_id  =$site_id)) 
				   WHERE 1=1 AND s.spotlight_type='Events' AND s.status=1".$search_filter)->num_rows();
				  
				  
				  
				  
		  $data['spotit_total'] = $this->db->query("SELECT s.*, 
						u.first_name,
						u.last_name,
						u.photo,
						u.site_id,
						 r.spotlight_id,
				r.web_id,
						(SELECT count(likeID) FROM likes l WHERE l.userID=".$user_id." AND s.postID=l.itemID) AS likecount
						  FROM spotlights s 
						  
						    LEFT JOIN region_spotlights r ON (r.web_id=".$site_id." AND r.spotlight_id=s.postID)
				  INNER JOIN users u ON s.userid=u.userID AND ((u.level = 3 AND r.web_id=".$site_id.") OR (u.level != 3 AND u.site_id  =$site_id)) 
						    WHERE 1=1 AND s.spotlight_type='Spotit Spotlight' AND s.status=1".$search_filter)->num_rows();

		  

		  $data['user_total'] = 
		  
		  $this->db->query("SELECT  u.userID,
				u.first_name,
				u.last_name,
				u.photo,
				up.complete_profile,
				up.user_id,
				u.site_id 
				FROM users u 
				INNER JOIN user_profile up ON up.user_id=u.userID  
				
				 WHERE 1=1 AND u.site_id =$site_id AND up.complete_profile=1 AND u.userID!=".$user_id." ".$user_search_filter)->num_rows();
		  
		  /*$this->db->query("SELECT  u.userID,
						u.first_name,
						u.last_name,
						u.photo
						  FROM users u WHERE 1=1 AND u.is_email_verified=1 AND u.userID!=".$user_id." ".$user_search_filter)->num_rows();*/
			
			
			
			
			
			
			/*-------------------*/

			
			
			if(!empty($this->input->get('search')))
			{
				

			}else{
				$data['search_text'] = '';
			}

			$data['page_type']='mainsearch';
			$data['View'] = "enduser/main_search";
			$data['page_content'] = $this->load->view($data['View'], $data, true);
			$this->load->view('enduser/layouts/dashboard', $data);
		}else{
			redirect('login');
		}	
	}
	
	function admin_activities(){
	    $site_id = site_id();
		$user_id = $this->session->userdata('user_id');
		if($user_id>0){
			$this->db->where('userID', $user_id );
			
		    $this->db->from('users');
			$data['userinfo'] = $this->db->get()->row();

			$this->db->where('user_id', $user_id );
			$this->db->from('user_profile');
			$data['userprofileinfo'] = $this->db->get()->row();
$url_sigment = $this->uri->segment(3);
$where_filter  =" AND u.level != 0";
			$preferences_arr = json_decode($data['userprofileinfo']->preferences);
			$preferences_str = implode('|', $preferences_arr);
			$totalcount = $this->db->query("SELECT s.*, 
				u.first_name,
				u.last_name,
				u.photo,
				u.level,
				u.site_id,
				r.spotlight_id,
				r.web_id
				  FROM spotlights s 
				   LEFT JOIN region_spotlights r ON (r.web_id=".$site_id." AND r.spotlight_id=s.postID)
				 INNER JOIN users u ON s.userid=u.userID AND ((u.level = 3 AND r.web_id=".$site_id.") OR (u.level != 3 AND u.site_id  =$site_id)) 
				 		  
				   WHERE s.category REGEXP '^(".$preferences_str.")' AND s.status=1 AND u.site_id= $site_id ".$where_filter)->num_rows();
			
			
		
		    
   
			$config = array();
			$config["base_url"] = base_url() . "/dashboard/admin_activities/". $url_sigment;
			$config["total_rows"] = $totalcount;
			$config["per_page"] = 12;
			$config["uri_segment"] = 4;
			//$config['first_url'] = $config['base_url'].'?'.$s_qstring;
			/*$config['enable_query_strings'] = TRUE;
			$config['use_page_numbers'] = TRUE;
			$config['query_string_segment'] = 'page';*/
			$config['full_tag_open'] = '<nav aria-label="Page navigation example"><ul class="pagination justify-content-center pagination-separated">';
			$config['full_tag_close'] = '</ul></nav>';            
			$config['prev_link'] = '<i data-feather="chevron-left"></i>';
			$config['first_tag_open'] = '<li class="page-item">';
			$config['first_tag_close'] = '</li>';
			$config['prev_tag_open'] = '<li class="page-item">';
			$config['prev_tag_close'] = '</li>';
			$config['next_link'] = '<i data-feather="chevron-right"></i>';
			$config['next_tag_open'] = '<li class="page-item">';
			$config['next_tag_close'] = '</li>';
			$config['last_tag_open'] = '<li class="page-item">';
			$config['last_tag_close'] = '</li>';
			$config['cur_tag_open'] = '<li class="page-item active"><a>';
			$config['cur_tag_close'] = '</a></li>';
			$config['num_tag_open'] = '<li class="page-item">';
			$config['num_tag_close'] = '</li>';
			$config['reuse_query_string'] = true;
			$this->pagination->initialize($config);

			$page = ($this->uri->segment(4))? $this->uri->segment(4) : 0;

			$data["links"] = $this->pagination->create_links();
            $data['spotlight_all'] = $this->db->query("SELECT s.*, 
				u.first_name,
				u.last_name,
				u.photo,
					u.site_id,
					u.level,
					r.spotlight_id,
				r.web_id,
				(SELECT count(likeID) FROM likes l WHERE l.userID=".$user_id." AND s.postID=l.itemID) AS likecount
				  FROM spotlights s 
				  
				   LEFT JOIN region_spotlights r ON (r.web_id=".$site_id." AND r.spotlight_id=s.postID)
				  INNER JOIN users u ON s.userid=u.userID AND ((u.level = 3 AND r.web_id=".$site_id.") OR (u.level != 3 AND u.site_id  =$site_id)) 
				  
				  
				  WHERE s.category REGEXP '^(".$preferences_str.")' AND s.status=1   ".$where_filter." ORDER BY s.created_at DESC limit ".$config["per_page"]." OFFSET ".$page)->result_array();
			$data['page_type']='activities_admin';
			$data['View'] = "enduser/admin_activities";
			$data['page_content'] = $this->load->view($data['View'], $data, true);
			$this->load->view('enduser/layouts/dashboard', $data);
		}else{
			redirect('login');
		}	
	}
	function activities_old(){
	    $site_id = site_id();
		$user_id = $this->session->userdata('user_id');
		if($user_id>0){
			$this->db->where('userID', $user_id );
			
		    $this->db->from('users');
			$data['userinfo'] = $this->db->get()->row();

			$this->db->where('user_id', $user_id );
			$this->db->from('user_profile');
			$data['userprofileinfo'] = $this->db->get()->row();

			$preferences_arr = json_decode($data['userprofileinfo']->preferences);
			$preferences_str = implode('|', $preferences_arr);
			
			
			
			$url_sigment = $this->uri->segment(3);
			if($url_sigment =='news'){
				$where_filter = " AND s.spotlight_type='News / Blog'";
			}elseif($url_sigment =='jobs'){
				 $where_filter = " AND s.spotlight_type='Job Posting'";
			}elseif($url_sigment =='events'){
				 	 $where_filter = " AND s.spotlight_type='Events'";
			}elseif($url_sigment =='spotit'){	 
			$where_filter = " AND s.spotlight_type='Spotit Spotlight'";
			}else{
				$where_filter ="";
			}

			if(!empty($this->input->get('search'))){
				$data['search_text'] = $this->input->get('search');
				$search_filter = " AND (s.postTitle LIKE '%".$data['search_text']."%' OR s.postContent LIKE '%".$data['search_text']."%')";
				$s_qstring= "?search=".$data['search_text'];

			}else{
				$data['search_text'] = '';
				$search_filter ="";
				$s_qstring= "";
			}
			$totalcount = $this->db->query("SELECT s.*, 
				u.first_name,
				u.last_name,
				u.photo,
				u.level,
				u.site_id,
				r.spotlight_id,
				r.web_id
				  FROM spotlights s 
				   LEFT JOIN region_spotlights r ON (r.web_id=".$site_id." AND r.spotlight_id=s.postID)
				  INNER JOIN users u ON s.userid=u.userID AND ((u.level = 3 AND r.web_id=".$site_id.") OR (u.level != 3 AND u.site_id  =$site_id)) 
				 		  
				   WHERE s.category REGEXP '^(".$preferences_str.")' AND s.status=1".$where_filter." ".$search_filter)->num_rows();
			
			
		
		    
           /*if(!empty($this->input->get('search'))){ 
           		$url_sigment='all';
		   }else{
				$url_sigment= $url_sigment;
		   }*/
			$config = array();
			$config["base_url"] = base_url() . "/dashboard/activities/". $url_sigment;
			$config["total_rows"] = $totalcount;
			$config["per_page"] = 12;
			$config["uri_segment"] = 4;
			//$config['first_url'] = $config['base_url'].'?'.$s_qstring;
			/*$config['enable_query_strings'] = TRUE;
			$config['use_page_numbers'] = TRUE;
			$config['query_string_segment'] = 'page';*/
			$config['full_tag_open'] = '<nav aria-label="Page navigation example"><ul class="pagination justify-content-center pagination-separated">';
			$config['full_tag_close'] = '</ul></nav>';            
			$config['prev_link'] = '<i data-feather="chevron-left"></i>';
			$config['first_tag_open'] = '<li class="page-item">';
			$config['first_tag_close'] = '</li>';
			$config['prev_tag_open'] = '<li class="page-item">';
			$config['prev_tag_close'] = '</li>';
			$config['next_link'] = '<i data-feather="chevron-right"></i>';
			$config['next_tag_open'] = '<li class="page-item">';
			$config['next_tag_close'] = '</li>';
			$config['last_tag_open'] = '<li class="page-item">';
			$config['last_tag_close'] = '</li>';
			$config['cur_tag_open'] = '<li class="page-item active"><a>';
			$config['cur_tag_close'] = '</a></li>';
			$config['num_tag_open'] = '<li class="page-item">';
			$config['num_tag_close'] = '</li>';
			$config['reuse_query_string'] = true;
			$this->pagination->initialize($config);

			$page = ($this->uri->segment(4))? $this->uri->segment(4) : 0;

			$data["links"] = $this->pagination->create_links();
            $data['spotlight_all'] = $this->db->query("SELECT s.*, 
				u.first_name,
				u.last_name,
				u.photo,
					u.site_id,
					u.level,
					r.spotlight_id,
				r.web_id,
				(SELECT count(likeID) FROM likes l WHERE l.userID=".$user_id." AND s.postID=l.itemID) AS likecount
				  FROM spotlights s 
				   LEFT JOIN region_spotlights r ON (r.web_id=".$site_id." AND r.spotlight_id=s.postID)
				  INNER JOIN users u ON s.userid=u.userID AND ((u.level = 3 AND r.web_id=".$site_id.") OR (u.level != 3 AND u.site_id  =$site_id)) 
				 
				  
				  
				  WHERE s.category REGEXP '^(".$preferences_str.")' AND s.status=1   ".$where_filter." ".$search_filter." ORDER BY s.created_at DESC limit ".$config["per_page"]." OFFSET ".$page)->result_array();
				  
				  
			/*$data['spotlight_all'] = $this->db->query("SELECT s.*, 
				u.first_name,
				u.last_name,
				u.photo,
				u.site_id,
				(SELECT count(likeID) FROM likes l WHERE l.userID=".$user_id." AND s.postID=l.itemID) AS likecount
				  FROM spotlights s INNER JOIN users u ON s.userid=u.userID  WHERE s.category REGEXP '^(".$preferences_str.")' ".$where_filter." AND s.status=1 AND u.site_id= $site_id ".$search_filter." ORDER BY s.created_at DESC limit ".$config["per_page"]." OFFSET ".$page)->result_array();*/
				  
			$data['news_total'] = $this->db->query("SELECT s.*, 
			u.site_id,
					u.level,
					r.spotlight_id,
	r.web_id 
      FROM spotlights s 
	  		  LEFT JOIN region_spotlights r ON (r.spotlight_id=s.postID AND r.web_id=$site_id)	
      INNER JOIN users u ON s.userid=u.userID AND ((r.web_id=".$site_id." AND u.level = 3) OR (u.level != 3 AND u.site_id  =$site_id)) 
				
      WHERE s.category REGEXP '^(".$preferences_str.")' AND s.spotlight_type='News / Blog'  AND s.status=1 ".$search_filter)->num_rows();	  
				  
				  
				  
	$data['job_total'] = $this->db->query("SELECT s.*, 
		u.site_id,
		u.level,
		r.spotlight_id,
		r.web_id 
		FROM spotlights s 
		LEFT JOIN region_spotlights r ON (r.spotlight_id=s.postID AND r.web_id=$site_id)	
		INNER JOIN users u ON s.userid=u.userID AND ((r.web_id=".$site_id." AND u.level = 3) OR (u.level != 3 AND u.site_id  =$site_id)) 
		WHERE s.category REGEXP '^(".$preferences_str.")' AND s.spotlight_type='Job Posting'  AND s.status=1 ".$search_filter)->num_rows();	
				  
				  
	  $data['event_total'] = $this->db->query("SELECT s.*, 
		u.site_id,
		u.level,
		r.spotlight_id,
		r.web_id 
		FROM spotlights s 
		LEFT JOIN region_spotlights r ON (r.spotlight_id=s.postID AND r.web_id=$site_id)	
		INNER JOIN users u ON s.userid=u.userID AND ((r.web_id=".$site_id." AND u.level = 3) OR (u.level != 3 AND u.site_id  =$site_id)) 
		WHERE s.category REGEXP '^(".$preferences_str.")' AND s.spotlight_type='Events'  AND s.status=1 ".$search_filter)->num_rows();
		
		$data['spotit_total'] = $this->db->query("SELECT s.*, 
		u.site_id,
		u.level,
		r.spotlight_id,
		r.web_id 
		FROM spotlights s 
		LEFT JOIN region_spotlights r ON (r.spotlight_id=s.postID AND r.web_id=$site_id)	
		INNER JOIN users u ON s.userid=u.userID AND ((r.web_id=".$site_id." AND u.level = 3) OR (u.level != 3 AND u.site_id  =$site_id)) 
		WHERE s.category REGEXP '^(".$preferences_str.")' AND s.spotlight_type='Spotit Spotlight'  AND s.status=1 ".$search_filter)->num_rows();

			/*-------------------*/

			/*$data['spotlight_news'] = $this->db->query("SELECT s.*, 
				u.first_name,
				u.last_name,
				u.photo,
				(SELECT count(likeID) FROM likes l WHERE l.userID=".$user_id." AND s.postID=l.itemID) AS likecount
				  FROM spotlights s INNER JOIN users u ON s.userid=u.userID WHERE s.spotlight_type='News / Blog' AND s.category REGEXP '^(".$preferences_str.")' AND s.status=1")->result_array();
			$data['spotlight_spotit'] = $this->db->query("SELECT s.*, 
				u.first_name,
				u.last_name,
				u.photo,
				(SELECT count(likeID) FROM likes l WHERE l.userID=".$user_id." AND s.postID=l.itemID) AS likecount  
				FROM spotlights s INNER JOIN users u ON s.userid=u.userID WHERE s.spotlight_type='Spotit Spotlight' AND s.category REGEXP '^(".$preferences_str.")' AND s.status=1")->result_array();
			$data['spotlight_job'] = $this->db->query("SELECT s.*, 
				u.first_name,
				u.last_name,
				u.photo,
				(SELECT count(likeID) FROM likes l WHERE l.userID=".$user_id." AND s.postID=l.itemID) AS likecount
				  FROM spotlights s INNER JOIN users u ON s.userid=u.userID WHERE s.spotlight_type='Job Posting' AND s.category REGEXP '^(".$preferences_str.")' AND s.status=1")->result_array();
			$data['spotlight_event'] = $this->db->query("SELECT s.*, 
				u.first_name,
				u.last_name,
				u.photo,
				(SELECT count(likeID) FROM likes l WHERE l.userID=".$user_id." AND s.postID=l.itemID) AS likecount
				 FROM spotlights s INNER JOIN users u ON s.userid=u.userID WHERE s.spotlight_type='Events' AND s.category REGEXP '^(".$preferences_str.")' AND s.status=1")->result_array();*/
			
			if(!empty($this->input->get('search')))
			{
				/*$data['search_text'] = $this->input->get('search');

				$data['spotlight_all'] = $this->db->query("SELECT s.*, 
				u.first_name,
				u.last_name,
				u.photo,
				(SELECT count(likeID) FROM likes l WHERE l.userID=".$user_id." AND s.postID=l.itemID) AS likecount
				 FROM spotlights s INNER JOIN users u ON s.userid=u.userID   WHERE s.category REGEXP '^(".$preferences_str.")'  AND s.status=1 AND (s.postTitle LIKE '%".$data['search_text']."%' OR s.postContent LIKE '%".$data['search_text']."%')  ORDER BY s.created_at DESC")->result_array();
				$data['spotlight_news'] = $this->db->query("SELECT s.*, 
				u.first_name,
				u.last_name,
				u.photo,
				(SELECT count(likeID) FROM likes l WHERE l.userID=".$user_id." AND s.postID=l.itemID) AS likecount
				 FROM spotlights s INNER JOIN users u ON s.userid=u.userID WHERE s.spotlight_type='News / Blog' AND s.category REGEXP '^(".$preferences_str.")' AND s.status=1 AND (s.postTitle LIKE '%".$data['search_text']."%' OR s.postContent LIKE '%".$data['search_text']."%')  ORDER BY s.created_at DESC")->result_array();
				$data['spotlight_spotit'] = $this->db->query("SELECT s.*, 
				u.first_name,
				u.last_name,
				u.photo,
				(SELECT count(likeID) FROM likes l WHERE l.userID=".$user_id." AND s.postID=l.itemID) AS likecount
				FROM spotlights s INNER JOIN users u ON s.userid=u.userID WHERE spotlight_type='Spotit Spotlight' AND s.category REGEXP '^(".$preferences_str.")' AND s.status=1 AND (s.postTitle LIKE '%".$data['search_text']."%' OR s.postContent LIKE '%".$data['search_text']."%')  ORDER BY s.created_at DESC")->result_array();
				$data['spotlight_job'] = $this->db->query("SELECT s.*, 
				u.first_name,
				u.last_name,
				u.photo,
				(SELECT count(likeID) FROM likes l WHERE l.userID=".$user_id." AND s.postID=l.itemID) AS likecount
				FROM spotlights s INNER JOIN users u ON s.userid=u.userID WHERE s.spotlight_type='Job Posting' AND s.category REGEXP '^(".$preferences_str.")' AND s.status=1 AND (s.postTitle LIKE '%".$data['search_text']."%' OR s.postContent LIKE '%".$data['search_text']."%')  ORDER BY s.created_at DESC")->result_array();
				$data['spotlight_event'] = $this->db->query("SELECT s.*, 
				u.first_name,
				u.last_name,
				u.photo,
				(SELECT count(likeID) FROM likes l WHERE l.userID=".$user_id." AND s.postID=l.itemID) AS likecount
				FROM spotlights s INNER JOIN users u ON s.userid=u.userID WHERE s.spotlight_type='Events' AND s.category REGEXP '^(".$preferences_str.")' AND s.status=1 AND (s.postTitle LIKE '%".$data['search_text']."%' OR s.postContent LIKE '%".$data['search_text']."%')  ORDER BY s.created_at DESC")->result_array();*/

			}else{
				$data['search_text'] = '';
			}

			$data['page_type']='activities';
			$data['View'] = "enduser/activities";
			$data['page_content'] = $this->load->view($data['View'], $data, true);
			$this->load->view('enduser/layouts/dashboard', $data);
		}else{
			redirect('login');
		}	
	}
	
	function activities(){
	    $site_id = site_id();
		$user_id = $this->session->userdata('user_id');
		if($user_id>0){
			$this->db->where('userID', $user_id );
			
		    $this->db->from('users');
			$data['userinfo'] = $this->db->get()->row();

			$this->db->where('user_id', $user_id );
			$this->db->from('user_profile');
			$data['userprofileinfo'] = $this->db->get()->row();

			$preferences_arr = json_decode($data['userprofileinfo']->preferences);
			$preferences_str = implode('|', $preferences_arr);
			
			
			
			$url_sigment = $this->uri->segment(3);
			if($url_sigment =='news'){
				$where_filter = " AND s.spotlight_type='News / Blog'";
			}elseif($url_sigment =='jobs'){
				 $where_filter = " AND s.spotlight_type='Job Posting'";
			}elseif($url_sigment =='events'){
				 	 $where_filter = " AND s.spotlight_type='Events'";
			}elseif($url_sigment =='spotit'){	 
			$where_filter = " AND s.spotlight_type='Spotit Spotlight'";
			}elseif($url_sigment =='media'){	 
			$where_filter = " AND s.spotlight_type='Media/Podcast'";
			}else{
				$where_filter ="";
			}

			if(!empty($this->input->get('search'))){
				$data['search_text'] = $this->input->get('search');
				$search_filter = " AND (s.postTitle LIKE '%".$data['search_text']."%' OR s.postContent LIKE '%".$data['search_text']."%')";
				$s_qstring= "?search=".$data['search_text'];

			}else{
				$data['search_text'] = '';
				$search_filter ="";
				$s_qstring= "";
			}
			$totalcount = $this->db->query("SELECT s.*, 
				u.first_name,
				u.last_name,
				u.photo,
				u.level,
				u.site_id,
				r.spotlight_id,
				r.web_id
				FROM spotlights s 
				LEFT JOIN region_spotlights r ON (r.web_id=".$site_id." AND r.spotlight_id=s.postID)
				INNER JOIN users u ON s.userid=u.userID AND ((u.level = 3 AND r.web_id=".$site_id.") OR (u.level != 3 AND u.site_id  =$site_id)) 
					  
				WHERE s.status=1".$where_filter." ".$search_filter)->num_rows();
			
			
		
		    
           /*if(!empty($this->input->get('search'))){ 
           		$url_sigment='all';
		   }else{
				$url_sigment= $url_sigment;
		   }*/
			$config = array();
			$config["base_url"] = base_url() . "/dashboard/activities/". $url_sigment;
			$config["total_rows"] = $totalcount;
			$config["per_page"] = 12;
			$config["uri_segment"] = 4;
			//$config['first_url'] = $config['base_url'].'?'.$s_qstring;
			/*$config['enable_query_strings'] = TRUE;
			$config['use_page_numbers'] = TRUE;
			$config['query_string_segment'] = 'page';*/
			$config['full_tag_open'] = '<nav aria-label="Page navigation example"><ul class="pagination justify-content-center pagination-separated">';
			$config['full_tag_close'] = '</ul></nav>';            
			$config['prev_link'] = '<i data-feather="chevron-left"></i>';
			$config['first_tag_open'] = '<li class="page-item">';
			$config['first_tag_close'] = '</li>';
			$config['prev_tag_open'] = '<li class="page-item">';
			$config['prev_tag_close'] = '</li>';
			$config['next_link'] = '<i data-feather="chevron-right"></i>';
			$config['next_tag_open'] = '<li class="page-item">';
			$config['next_tag_close'] = '</li>';
			$config['last_tag_open'] = '<li class="page-item">';
			$config['last_tag_close'] = '</li>';
			$config['cur_tag_open'] = '<li class="page-item active"><a>';
			$config['cur_tag_close'] = '</a></li>';
			$config['num_tag_open'] = '<li class="page-item">';
			$config['num_tag_close'] = '</li>';
			$config['reuse_query_string'] = true;
			$this->pagination->initialize($config);

			$page = ($this->uri->segment(4))? $this->uri->segment(4) : 0;

			$data["links"] = $this->pagination->create_links();
            $data['spotlight_all'] = $this->db->query("SELECT s.*, 
				u.first_name,
				u.last_name,
				u.photo,
					u.site_id,
					u.level,
					r.spotlight_id,
				r.web_id,
				(SELECT count(likeID) FROM likes l WHERE l.userID=".$user_id." AND s.postID=l.itemID) AS likecount
				  FROM spotlights s 
				   LEFT JOIN region_spotlights r ON (r.web_id=".$site_id." AND r.spotlight_id=s.postID)
				  INNER JOIN users u ON s.userid=u.userID AND ((u.level = 3 AND r.web_id=".$site_id.") OR (u.level != 3 AND u.site_id  =$site_id)) 
				 
				  
				  
				  WHERE s.status=1   ".$where_filter." ".$search_filter." ORDER BY s.created_at DESC limit ".$config["per_page"]." OFFSET ".$page)->result_array();
				  
				  
			/*$data['spotlight_all'] = $this->db->query("SELECT s.*, 
				u.first_name,
				u.last_name,
				u.photo,
				u.site_id,
				(SELECT count(likeID) FROM likes l WHERE l.userID=".$user_id." AND s.postID=l.itemID) AS likecount
				  FROM spotlights s INNER JOIN users u ON s.userid=u.userID  WHERE s.category REGEXP '^(".$preferences_str.")' ".$where_filter." AND s.status=1 AND u.site_id= $site_id ".$search_filter." ORDER BY s.created_at DESC limit ".$config["per_page"]." OFFSET ".$page)->result_array();*/
				  
			$data['news_total'] = $this->db->query("SELECT s.*, 
			u.site_id,
					u.level,
					r.spotlight_id,
	r.web_id 
      FROM spotlights s 
	  		  LEFT JOIN region_spotlights r ON (r.spotlight_id=s.postID AND r.web_id=$site_id)	
      INNER JOIN users u ON s.userid=u.userID AND ((r.web_id=".$site_id." AND u.level = 3) OR (u.level != 3 AND u.site_id  =$site_id)) 
				
      WHERE s.spotlight_type='News / Blog'  AND s.status=1 ".$search_filter)->num_rows();
	  $data['media_total'] = $this->db->query("SELECT s.*, 
			u.site_id,
					u.level,
					r.spotlight_id,
	r.web_id 
      FROM spotlights s 
	  		  LEFT JOIN region_spotlights r ON (r.spotlight_id=s.postID AND r.web_id=$site_id)	
      INNER JOIN users u ON s.userid=u.userID AND ((r.web_id=".$site_id." AND u.level = 3) OR (u.level != 3 AND u.site_id  =$site_id)) 
				
      WHERE s.spotlight_type='Media/Podcast'  AND s.status=1 ".$search_filter)->num_rows();	  
				  
				  
				  
	$data['job_total'] = $this->db->query("SELECT s.*, 
		u.site_id,
		u.level,
		r.spotlight_id,
		r.web_id 
		FROM spotlights s 
		LEFT JOIN region_spotlights r ON (r.spotlight_id=s.postID AND r.web_id=$site_id)	
		INNER JOIN users u ON s.userid=u.userID AND ((r.web_id=".$site_id." AND u.level = 3) OR (u.level != 3 AND u.site_id  =$site_id)) 
		WHERE s.spotlight_type='Job Posting'  AND s.status=1 ".$search_filter)->num_rows();	
				  
				  
	  $data['event_total'] = $this->db->query("SELECT s.*, 
		u.site_id,
		u.level,
		r.spotlight_id,
		r.web_id 
		FROM spotlights s 
		LEFT JOIN region_spotlights r ON (r.spotlight_id=s.postID AND r.web_id=$site_id)	
		INNER JOIN users u ON s.userid=u.userID AND ((r.web_id=".$site_id." AND u.level = 3) OR (u.level != 3 AND u.site_id  =$site_id)) 
		WHERE s.spotlight_type='Events'  AND s.status=1 ".$search_filter)->num_rows();
		
		$data['spotit_total'] = $this->db->query("SELECT s.*, 
		u.site_id,
		u.level,
		r.spotlight_id,
		r.web_id 
		FROM spotlights s 
		LEFT JOIN region_spotlights r ON (r.spotlight_id=s.postID AND r.web_id=$site_id)	
		INNER JOIN users u ON s.userid=u.userID AND ((r.web_id=".$site_id." AND u.level = 3) OR (u.level != 3 AND u.site_id  =$site_id)) 
		WHERE s.spotlight_type='Spotit Spotlight'  AND s.status=1 ".$search_filter)->num_rows();

			/*-------------------*/

			/*$data['spotlight_news'] = $this->db->query("SELECT s.*, 
				u.first_name,
				u.last_name,
				u.photo,
				(SELECT count(likeID) FROM likes l WHERE l.userID=".$user_id." AND s.postID=l.itemID) AS likecount
				  FROM spotlights s INNER JOIN users u ON s.userid=u.userID WHERE s.spotlight_type='News / Blog' AND s.category REGEXP '^(".$preferences_str.")' AND s.status=1")->result_array();
			$data['spotlight_spotit'] = $this->db->query("SELECT s.*, 
				u.first_name,
				u.last_name,
				u.photo,
				(SELECT count(likeID) FROM likes l WHERE l.userID=".$user_id." AND s.postID=l.itemID) AS likecount  
				FROM spotlights s INNER JOIN users u ON s.userid=u.userID WHERE s.spotlight_type='Spotit Spotlight' AND s.category REGEXP '^(".$preferences_str.")' AND s.status=1")->result_array();
			$data['spotlight_job'] = $this->db->query("SELECT s.*, 
				u.first_name,
				u.last_name,
				u.photo,
				(SELECT count(likeID) FROM likes l WHERE l.userID=".$user_id." AND s.postID=l.itemID) AS likecount
				  FROM spotlights s INNER JOIN users u ON s.userid=u.userID WHERE s.spotlight_type='Job Posting' AND s.category REGEXP '^(".$preferences_str.")' AND s.status=1")->result_array();
			$data['spotlight_event'] = $this->db->query("SELECT s.*, 
				u.first_name,
				u.last_name,
				u.photo,
				(SELECT count(likeID) FROM likes l WHERE l.userID=".$user_id." AND s.postID=l.itemID) AS likecount
				 FROM spotlights s INNER JOIN users u ON s.userid=u.userID WHERE s.spotlight_type='Events' AND s.category REGEXP '^(".$preferences_str.")' AND s.status=1")->result_array();*/
			
			if(!empty($this->input->get('search')))
			{
				/*$data['search_text'] = $this->input->get('search');

				$data['spotlight_all'] = $this->db->query("SELECT s.*, 
				u.first_name,
				u.last_name,
				u.photo,
				(SELECT count(likeID) FROM likes l WHERE l.userID=".$user_id." AND s.postID=l.itemID) AS likecount
				 FROM spotlights s INNER JOIN users u ON s.userid=u.userID   WHERE s.category REGEXP '^(".$preferences_str.")'  AND s.status=1 AND (s.postTitle LIKE '%".$data['search_text']."%' OR s.postContent LIKE '%".$data['search_text']."%')  ORDER BY s.created_at DESC")->result_array();
				$data['spotlight_news'] = $this->db->query("SELECT s.*, 
				u.first_name,
				u.last_name,
				u.photo,
				(SELECT count(likeID) FROM likes l WHERE l.userID=".$user_id." AND s.postID=l.itemID) AS likecount
				 FROM spotlights s INNER JOIN users u ON s.userid=u.userID WHERE s.spotlight_type='News / Blog' AND s.category REGEXP '^(".$preferences_str.")' AND s.status=1 AND (s.postTitle LIKE '%".$data['search_text']."%' OR s.postContent LIKE '%".$data['search_text']."%')  ORDER BY s.created_at DESC")->result_array();
				$data['spotlight_spotit'] = $this->db->query("SELECT s.*, 
				u.first_name,
				u.last_name,
				u.photo,
				(SELECT count(likeID) FROM likes l WHERE l.userID=".$user_id." AND s.postID=l.itemID) AS likecount
				FROM spotlights s INNER JOIN users u ON s.userid=u.userID WHERE spotlight_type='Spotit Spotlight' AND s.category REGEXP '^(".$preferences_str.")' AND s.status=1 AND (s.postTitle LIKE '%".$data['search_text']."%' OR s.postContent LIKE '%".$data['search_text']."%')  ORDER BY s.created_at DESC")->result_array();
				$data['spotlight_job'] = $this->db->query("SELECT s.*, 
				u.first_name,
				u.last_name,
				u.photo,
				(SELECT count(likeID) FROM likes l WHERE l.userID=".$user_id." AND s.postID=l.itemID) AS likecount
				FROM spotlights s INNER JOIN users u ON s.userid=u.userID WHERE s.spotlight_type='Job Posting' AND s.category REGEXP '^(".$preferences_str.")' AND s.status=1 AND (s.postTitle LIKE '%".$data['search_text']."%' OR s.postContent LIKE '%".$data['search_text']."%')  ORDER BY s.created_at DESC")->result_array();
				$data['spotlight_event'] = $this->db->query("SELECT s.*, 
				u.first_name,
				u.last_name,
				u.photo,
				(SELECT count(likeID) FROM likes l WHERE l.userID=".$user_id." AND s.postID=l.itemID) AS likecount
				FROM spotlights s INNER JOIN users u ON s.userid=u.userID WHERE s.spotlight_type='Events' AND s.category REGEXP '^(".$preferences_str.")' AND s.status=1 AND (s.postTitle LIKE '%".$data['search_text']."%' OR s.postContent LIKE '%".$data['search_text']."%')  ORDER BY s.created_at DESC")->result_array();*/

			}else{
				$data['search_text'] = '';
			}

			$data['page_type']='activities';
			$data['View'] = "enduser/activities";
			$data['page_content'] = $this->load->view($data['View'], $data, true);
			$this->load->view('enduser/layouts/dashboard', $data);
		}else{
			redirect('login');
		}	
	}
	function myfeed(){
	    $site_id = site_id();
		$user_id = $this->session->userdata('user_id');
		if($user_id>0){
			$this->db->where('userID', $user_id );
			
		    $this->db->from('users');
			$data['userinfo'] = $this->db->get()->row();

			$this->db->where('user_id', $user_id );
			$this->db->from('user_profile');
			$data['userprofileinfo'] = $this->db->get()->row();

			$preferences_arr = json_decode($data['userprofileinfo']->preferences);
			$preferences_str = implode('|', $preferences_arr);
			
			
			
			$url_sigment = $this->uri->segment(3);
			if($url_sigment =='news'){
				$where_filter = " AND s.spotlight_type='News / Blog'";
			}elseif($url_sigment =='jobs'){
				 $where_filter = " AND s.spotlight_type='Job Posting'";
			}elseif($url_sigment =='events'){
				 	 $where_filter = " AND s.spotlight_type='Events'";
			}elseif($url_sigment =='spotit'){	 
			$where_filter = " AND s.spotlight_type='Spotit Spotlight'";
			}elseif($url_sigment =='media'){	 
			$where_filter = " AND s.spotlight_type='Media/Podcast'";
			}else{
				$where_filter ="";
			}
			$group_by =' GROUP BY s.postID';

			if(!empty($this->input->get('search'))){
				$data['search_text'] = $this->input->get('search');
				$search_filter = " AND (s.postTitle LIKE '%".$data['search_text']."%' OR s.postContent LIKE '%".$data['search_text']."%')";
				$s_qstring= "?search=".$data['search_text'];

			}else{
				$data['search_text'] = '';
				$search_filter ="";
				$s_qstring= "";
			}
			
			$totalcount = $this->db->query("SELECT s.*, 
				u.first_name,
				u.last_name,
				u.photo,
				u.level,
				u.site_id,
				r.spotlight_id,
				r.web_id,
				f.is_following
				  FROM spotlights s 
				   LEFT JOIN region_spotlights r ON (r.web_id=".$site_id." AND r.spotlight_id=s.postID)
				  INNER JOIN followers f ON s.userid=f.is_following 
				  INNER JOIN users u ON s.userid=u.userID AND ((u.level = 3 AND r.web_id=".$site_id.") OR (u.level != 3 AND u.site_id  =$site_id)) 
				 	
				   WHERE ( s.category REGEXP '^(".$preferences_str.")' OR s.userid=f.is_following)  AND s.status=1".$where_filter." ".$search_filter ." ".$group_by)->num_rows();
			
		
			
			
		
		    
           /*if(!empty($this->input->get('search'))){ 
           		$url_sigment='all';
		   }else{
				$url_sigment= $url_sigment;
		   }*/
			$config = array();
			$config["base_url"] = base_url() . "/dashboard/myfeed/". $url_sigment;
			$config["total_rows"] = $totalcount;
			$config["per_page"] = 12;
			$config["uri_segment"] = 4;
			//$config['first_url'] = $config['base_url'].'?'.$s_qstring;
			/*$config['enable_query_strings'] = TRUE;
			$config['use_page_numbers'] = TRUE;
			$config['query_string_segment'] = 'page';*/
			$config['full_tag_open'] = '<nav aria-label="Page navigation example"><ul class="pagination justify-content-center pagination-separated">';
			$config['full_tag_close'] = '</ul></nav>';            
			$config['prev_link'] = '<i data-feather="chevron-left"></i>';
			$config['first_tag_open'] = '<li class="page-item">';
			$config['first_tag_close'] = '</li>';
			$config['prev_tag_open'] = '<li class="page-item">';
			$config['prev_tag_close'] = '</li>';
			$config['next_link'] = '<i data-feather="chevron-right"></i>';
			$config['next_tag_open'] = '<li class="page-item">';
			$config['next_tag_close'] = '</li>';
			$config['last_tag_open'] = '<li class="page-item">';
			$config['last_tag_close'] = '</li>';
			$config['cur_tag_open'] = '<li class="page-item active"><a>';
			$config['cur_tag_close'] = '</a></li>';
			$config['num_tag_open'] = '<li class="page-item">';
			$config['num_tag_close'] = '</li>';
			$config['reuse_query_string'] = true;
			$this->pagination->initialize($config);

			$page = ($this->uri->segment(4))? $this->uri->segment(4) : 0;

			$data["links"] = $this->pagination->create_links();
            $data['spotlight_all'] = $this->db->query("SELECT s.*, 
				u.first_name,
				u.last_name,
				u.photo,
					u.site_id,
					u.level,
					r.spotlight_id,
				r.web_id,
				f.is_following,
				(SELECT count(likeID) FROM likes l WHERE l.userID=".$user_id." AND s.postID=l.itemID) AS likecount
				  FROM spotlights s 
				   LEFT JOIN region_spotlights r ON (r.web_id=".$site_id." AND r.spotlight_id=s.postID)
				   INNER JOIN followers f ON s.userid=f.is_following 
				  INNER JOIN users u ON s.userid=u.userID AND ((u.level = 3 AND r.web_id=".$site_id.") OR (u.level != 3 AND u.site_id  =$site_id)) 
				 
				  
				  WHERE ( s.category REGEXP '^(".$preferences_str.")' OR s.userid=f.is_following) AND s.status=1   ".$where_filter." ".$search_filter." ".$group_by." ORDER BY s.created_at DESC  limit ".$config["per_page"]." OFFSET ".$page)->result_array();
				  
				  
			/*$data['spotlight_all'] = $this->db->query("SELECT s.*, 
				u.first_name,
				u.last_name,
				u.photo,
				u.site_id,
				(SELECT count(likeID) FROM likes l WHERE l.userID=".$user_id." AND s.postID=l.itemID) AS likecount
				  FROM spotlights s INNER JOIN users u ON s.userid=u.userID  WHERE s.category REGEXP '^(".$preferences_str.")' ".$where_filter." AND s.status=1 AND u.site_id= $site_id ".$search_filter." ORDER BY s.created_at DESC limit ".$config["per_page"]." OFFSET ".$page)->result_array();*/
				    
				  
				  $data['news_total'] = $this->db->query("SELECT s.*, 
				u.first_name,
				u.last_name,
				u.photo,
				u.level,
				u.site_id,
				r.spotlight_id,
				r.web_id,
				f.is_following
				  FROM spotlights s 
				   LEFT JOIN region_spotlights r ON (r.web_id=".$site_id." AND r.spotlight_id=s.postID)
				  INNER JOIN followers f ON s.userid=f.is_following 
				  INNER JOIN users u ON s.userid=u.userID AND ((u.level = 3 AND r.web_id=".$site_id.") OR (u.level != 3 AND u.site_id  =$site_id)) 
				 	
				   WHERE ( s.category REGEXP '^(".$preferences_str.")' OR s.userid=f.is_following) AND s.spotlight_type='News / Blog'   AND s.status=1  ".$search_filter.$group_by)->num_rows();
				   $data['media_total'] = $this->db->query("SELECT s.*, 
				u.first_name,
				u.last_name,
				u.photo,
				u.level,
				u.site_id,
				r.spotlight_id,
				r.web_id,
				f.is_following
				  FROM spotlights s 
				   LEFT JOIN region_spotlights r ON (r.web_id=".$site_id." AND r.spotlight_id=s.postID)
				  INNER JOIN followers f ON s.userid=f.is_following 
				  INNER JOIN users u ON s.userid=u.userID AND ((u.level = 3 AND r.web_id=".$site_id.") OR (u.level != 3 AND u.site_id  =$site_id)) 
				 	
				   WHERE ( s.category REGEXP '^(".$preferences_str.")' OR s.userid=f.is_following) AND s.spotlight_type='Media/Podcast'   AND s.status=1  ".$search_filter.$group_by)->num_rows();
				  
		
		 $data['job_total'] = $this->db->query("SELECT s.*, 
				u.first_name,
				u.last_name,
				u.photo,
				u.level,
				u.site_id,
				r.spotlight_id,
				r.web_id,
				f.is_following
				  FROM spotlights s 
				   LEFT JOIN region_spotlights r ON (r.web_id=".$site_id." AND r.spotlight_id=s.postID)
				  INNER JOIN followers f ON s.userid=f.is_following 
				  INNER JOIN users u ON s.userid=u.userID AND ((u.level = 3 AND r.web_id=".$site_id.") OR (u.level != 3 AND u.site_id  =$site_id)) 
				 	
				   WHERE ( s.category REGEXP '^(".$preferences_str.")' OR s.userid=f.is_following) AND s.spotlight_type='Job Posting'   AND s.status=1  ".$search_filter.$group_by)->num_rows();
				  
				  
				  $data['event_total'] = $this->db->query("SELECT s.*, 
				u.first_name,
				u.last_name,
				u.photo,
				u.level,
				u.site_id,
				r.spotlight_id,
				r.web_id,
				f.is_following
				  FROM spotlights s 
				   LEFT JOIN region_spotlights r ON (r.web_id=".$site_id." AND r.spotlight_id=s.postID)
				  INNER JOIN followers f ON s.userid=f.is_following 
				  INNER JOIN users u ON s.userid=u.userID AND ((u.level = 3 AND r.web_id=".$site_id.") OR (u.level != 3 AND u.site_id  =$site_id)) 
				 	
				   WHERE ( s.category REGEXP '^(".$preferences_str.")' OR s.userid=f.is_following) AND s.spotlight_type='Events'   AND s.status=1 ".$search_filter.$group_by)->num_rows();
				  
	  $data['spotit_total'] = $this->db->query("SELECT s.*, 
				u.first_name,
				u.last_name,
				u.photo,
				u.level,
				u.site_id,
				r.spotlight_id,
				r.web_id,
				f.is_following
				  FROM spotlights s 
				   LEFT JOIN region_spotlights r ON (r.web_id=".$site_id." AND r.spotlight_id=s.postID)
				  INNER JOIN followers f ON s.userid=f.is_following 
				  INNER JOIN users u ON s.userid=u.userID AND ((u.level = 3 AND r.web_id=".$site_id.") OR (u.level != 3 AND u.site_id  =$site_id)) 
				 	
				   WHERE ( s.category REGEXP '^(".$preferences_str.")' OR s.userid=f.is_following) AND s.spotlight_type='Spotit Spotlight'   AND s.status=1 ".$search_filter.$group_by)->num_rows();
		

			/*-------------------*/

			/*$data['spotlight_news'] = $this->db->query("SELECT s.*, 
				u.first_name,
				u.last_name,
				u.photo,
				(SELECT count(likeID) FROM likes l WHERE l.userID=".$user_id." AND s.postID=l.itemID) AS likecount
				  FROM spotlights s INNER JOIN users u ON s.userid=u.userID WHERE s.spotlight_type='News / Blog' AND s.category REGEXP '^(".$preferences_str.")' AND s.status=1")->result_array();
			$data['spotlight_spotit'] = $this->db->query("SELECT s.*, 
				u.first_name,
				u.last_name,
				u.photo,
				(SELECT count(likeID) FROM likes l WHERE l.userID=".$user_id." AND s.postID=l.itemID) AS likecount  
				FROM spotlights s INNER JOIN users u ON s.userid=u.userID WHERE s.spotlight_type='Spotit Spotlight' AND s.category REGEXP '^(".$preferences_str.")' AND s.status=1")->result_array();
			$data['spotlight_job'] = $this->db->query("SELECT s.*, 
				u.first_name,
				u.last_name,
				u.photo,
				(SELECT count(likeID) FROM likes l WHERE l.userID=".$user_id." AND s.postID=l.itemID) AS likecount
				  FROM spotlights s INNER JOIN users u ON s.userid=u.userID WHERE s.spotlight_type='Job Posting' AND s.category REGEXP '^(".$preferences_str.")' AND s.status=1")->result_array();
			$data['spotlight_event'] = $this->db->query("SELECT s.*, 
				u.first_name,
				u.last_name,
				u.photo,
				(SELECT count(likeID) FROM likes l WHERE l.userID=".$user_id." AND s.postID=l.itemID) AS likecount
				 FROM spotlights s INNER JOIN users u ON s.userid=u.userID WHERE s.spotlight_type='Events' AND s.category REGEXP '^(".$preferences_str.")' AND s.status=1")->result_array();*/
			
			if(!empty($this->input->get('search')))
			{
				/*$data['search_text'] = $this->input->get('search');

				$data['spotlight_all'] = $this->db->query("SELECT s.*, 
				u.first_name,
				u.last_name,
				u.photo,
				(SELECT count(likeID) FROM likes l WHERE l.userID=".$user_id." AND s.postID=l.itemID) AS likecount
				 FROM spotlights s INNER JOIN users u ON s.userid=u.userID   WHERE s.category REGEXP '^(".$preferences_str.")'  AND s.status=1 AND (s.postTitle LIKE '%".$data['search_text']."%' OR s.postContent LIKE '%".$data['search_text']."%')  ORDER BY s.created_at DESC")->result_array();
				$data['spotlight_news'] = $this->db->query("SELECT s.*, 
				u.first_name,
				u.last_name,
				u.photo,
				(SELECT count(likeID) FROM likes l WHERE l.userID=".$user_id." AND s.postID=l.itemID) AS likecount
				 FROM spotlights s INNER JOIN users u ON s.userid=u.userID WHERE s.spotlight_type='News / Blog' AND s.category REGEXP '^(".$preferences_str.")' AND s.status=1 AND (s.postTitle LIKE '%".$data['search_text']."%' OR s.postContent LIKE '%".$data['search_text']."%')  ORDER BY s.created_at DESC")->result_array();
				$data['spotlight_spotit'] = $this->db->query("SELECT s.*, 
				u.first_name,
				u.last_name,
				u.photo,
				(SELECT count(likeID) FROM likes l WHERE l.userID=".$user_id." AND s.postID=l.itemID) AS likecount
				FROM spotlights s INNER JOIN users u ON s.userid=u.userID WHERE spotlight_type='Spotit Spotlight' AND s.category REGEXP '^(".$preferences_str.")' AND s.status=1 AND (s.postTitle LIKE '%".$data['search_text']."%' OR s.postContent LIKE '%".$data['search_text']."%')  ORDER BY s.created_at DESC")->result_array();
				$data['spotlight_job'] = $this->db->query("SELECT s.*, 
				u.first_name,
				u.last_name,
				u.photo,
				(SELECT count(likeID) FROM likes l WHERE l.userID=".$user_id." AND s.postID=l.itemID) AS likecount
				FROM spotlights s INNER JOIN users u ON s.userid=u.userID WHERE s.spotlight_type='Job Posting' AND s.category REGEXP '^(".$preferences_str.")' AND s.status=1 AND (s.postTitle LIKE '%".$data['search_text']."%' OR s.postContent LIKE '%".$data['search_text']."%')  ORDER BY s.created_at DESC")->result_array();
				$data['spotlight_event'] = $this->db->query("SELECT s.*, 
				u.first_name,
				u.last_name,
				u.photo,
				(SELECT count(likeID) FROM likes l WHERE l.userID=".$user_id." AND s.postID=l.itemID) AS likecount
				FROM spotlights s INNER JOIN users u ON s.userid=u.userID WHERE s.spotlight_type='Events' AND s.category REGEXP '^(".$preferences_str.")' AND s.status=1 AND (s.postTitle LIKE '%".$data['search_text']."%' OR s.postContent LIKE '%".$data['search_text']."%')  ORDER BY s.created_at DESC")->result_array();*/

			}else{
				$data['search_text'] = '';
			}

			$data['page_type']='myfeed';
			$data['View'] = "enduser/myfeed";
			$data['page_content'] = $this->load->view($data['View'], $data, true);
			$this->load->view('enduser/layouts/dashboard', $data);
		}else{
			redirect('login');
		}	
	}
	
function My_Network(){
	$user_id = $this->session->userdata('user_id');
		if($user_id>0){
			$this->db->where('userID', $user_id );
			
		    $this->db->from('users');
			$data['userinfo'] = $this->db->get()->row();

			$this->db->where('user_id', $user_id );
			$this->db->from('user_profile');
			$data['userprofileinfo'] = $this->db->get()->row();
			
			$query = $this->db->where('userID',$user_id)->get('followers');
			$totalcount = $query->num_rows();
			$config = array();
			$config["base_url"] = base_url() . "/dashboard/my_network/";
			$config["total_rows"] = $totalcount;
			$config["per_page"] = 12;
			$config["uri_segment"] = 3;

			$config['full_tag_open'] = '<nav aria-label="Page navigation example"><ul class="pagination justify-content-center pagination-separated">';
			$config['full_tag_close'] = '</ul></nav>';            
			$config['prev_link'] = '<i data-feather="chevron-left"></i>';
			$config['first_tag_open'] = '<li class="page-item">';
			$config['first_tag_close'] = '</li>';
			$config['prev_tag_open'] = '<li class="page-item">';
			$config['prev_tag_close'] = '</li>';
			$config['next_link'] = '<i data-feather="chevron-right"></i>';
			$config['next_tag_open'] = '<li class="page-item">';
			$config['next_tag_close'] = '</li>';
			$config['last_tag_open'] = '<li class="page-item">';
			$config['last_tag_close'] = '</li>';
			$config['cur_tag_open'] = '<li class="page-item active"><a>';
			$config['cur_tag_close'] = '</a></li>';
			$config['num_tag_open'] = '<li class="page-item">';
			$config['num_tag_close'] = '</li>';

			$this->pagination->initialize($config);

			$page = ($this->uri->segment(3))? $this->uri->segment(3) : 0;

			$data["links"] = $this->pagination->create_links();
			$data['persons'] = $this->db->query("SELECT f.*, 
				u.first_name,
				u.last_name, 
				u.photo,
				u.last_name,
				u.photo
			  FROM followers f  
			  INNER JOIN users u ON f.is_following=u.userID 
			 WHERE  f.userID =".$user_id." 
			  
			limit ".$config["per_page"]." OFFSET ".$page)->result_array();
			$fallowers = $this->db->query("SELECT f.*, 
				u.first_name,
				u.last_name, 
				u.photo,
				u.last_name,
				u.photo
			  FROM followers f  
			  INNER JOIN users u ON f.is_following=u.userID 
			 WHERE  f.userID =".$user_id)->result_array();
			$user_ids = array();
			if($fallowers){
			foreach($fallowers as $fallow){
				$user_ids[] =$fallow['is_following'];
			}
		    }
			
			$site_id = site_id();
			if($user_ids){
			$data['other_person'] = $this->db->query("SELECT u.* FROM users u 
			 WHERE u.site_id=$site_id AND (TRIM(u.photo) <> '') AND u.user_type IS NULL AND userID NOT IN(".implode(',',$user_ids).")")->result_array();
			}else{
				$data['other_person'] = $this->db->query("SELECT u.* FROM users u 
			 WHERE u.site_id=$site_id AND (TRIM(u.photo) <> '') AND u.is_email_verified=1 AND u.user_type IS NULL")->result_array();
			}
			
			//echo $this->db->last_query();die;
			$data['page_type']='my_network';
			$data['View'] = "enduser/my_network";
			$data['page_content'] = $this->load->view($data['View'], $data, true);
			$this->load->view('enduser/layouts/dashboard', $data);
		}else{
			redirect('login');
		}	
}
function contact(){
	$user_id = $this->session->userdata('user_id');
		if($user_id>0){
			$contact_user = $this->uri->segment(3);
			$this->db->where(array('user_id'=>$user_id,'contact_id'=>$contact_user));
		   $check_contact = $this->db->from('user_contacts')->get()->row();
		   if($check_contact){
		   $this->db->delete('user_contacts',array('user_id'=>$user_id,'contact_id'=>$contact_user));
		  redirect('dashboard/messages/');
		   }else{
			    $this->db->insert('user_contacts',array('user_id'=>$user_id,'contact_id'=>$contact_user,'date_time'=>date('Y-m-d H:i:s')));
			   redirect('dashboard/messages/'.$contact_user);
		   }
	}else{
		
			redirect('login');
		}	
}
function Messages(){
	$user_id = $this->session->userdata('user_id');
		if($user_id>0){
			$this->db->where('userID', $user_id );
		    $this->db->from('users');
			$data['userinfo'] = $this->db->get()->row();
			$this->db->where('user_id', $user_id );
			$this->db->from('user_profile');
			$data['userprofileinfo'] = $this->db->get()->row();
			
			$to = $this->uri->segment(3);
			if($to){
			$this->db->where('userID', $to);
		    $this->db->from('users');
			$data['to_user'] = $this->db->get()->row();
			if($this->input->post('submit')==1){
				$msg = $this->input->post('message');
				$insert_data = array('msg_by'=>$user_id , 'sender_id'=>$user_id ,'receiver_id'=>$to,'messsage'=>$msg,'date_time' => date('Y-m-d H:i:s'));
				$this->db->insert('messages',$insert_data);
				//$msg_id = $this->db->insert_id();
				$text ='messages you';
				$full_name =$data['userinfo']->first_name.' '.$data['userinfo']->last_name;
				$this->db->insert('msg_notifiction',array('full_name'=>$full_name,'message'=>$text,'notify_to'=>$to,'photo'=>$data['userinfo']->photo,'date_time'=>date('Y-m-d H:i:s'),'target_url'=>base_url('dashboard/messages/'.$user_id),'by_user'=>$user_id));
				$id = $this->db->insert_id();
				redirect('dashboard/messages/'.$to.'#chat_'.$id);
				
			}
			$data['chat_history'] =$this->db->query("SELECT m.*, 
				u.first_name,
				u.last_name, 
				u.photo
			  FROM messages m  
			  INNER JOIN users u ON  m.msg_by=u.userID
			 WHERE  (m.receiver_id =".$to." AND  m.sender_id =".$user_id.") OR (m.sender_id =".$to." AND  m.receiver_id =".$user_id.") ORDER BY m.date_time ASC")->result_array();
			
			 //print_r($this->db->last_query()); die;
			 
			 
			 $this->db->update('messages',array('mark_read'=>'1'),array('sender_id'=>$user_id, 'receiver_id'=>$to));
			}
			
			$data['chat_history_alt'] = $this->db->where('sender_id',$user_id)->from('messages')->get()->row();
			$data['contacts'] =$this->db->query("SELECT c.*, 
				u.first_name,
				u.last_name, 
				u.photo
				  FROM user_contacts c  
				  INNER JOIN users u ON  c.contact_id=u.userID 
				 WHERE  c.user_id =".$user_id." ORDER BY c.date_time DESC")->result_array();
			 //print_r($this->db->last_query()); die;
			$data['page_type']='messages';
			$data['View'] = "enduser/messages";
			$data['page_content'] = $this->load->view($data['View'], $data, true);
			$this->load->view('enduser/layouts/dashboard', $data);
		}else{
			redirect('login');
		}	
}


function unfollow(){
	$user_id = $this->session->userdata('user_id');
		if($user_id>0){
			$fallow_id = $this->uri->segment(3);
			$this->db->delete('followers',array('is_following'=>$fallow_id,'userID'=>$user_id));
			$user_info = $this->db->get_where('users',array('userID'=>$user_id))->row();
				/*$text = $user_info->first_name.' '.$user_info->last_name.' started unfollow you';
				$this->db->insert('notifications', array('type'=>'unfollow','description'=>$text,
				'targetURL'=>base_url('publicprofile/'.$fallow_id),'notify_to'=>$fallow_id,'timestamp'=>date('Y-m-d H:i:s')));*/
			redirect('dashboard/my_network');
		}else{
			redirect('login');
		}	
}

function follow(){
	$user_id = $this->session->userdata('user_id');
		if($user_id>0){
			$fallow_id = $this->uri->segment(3);
			$this->db->insert('followers',array('is_following'=>$fallow_id,'userID'=>$user_id));
			$user_info = $this->db->get_where('users',array('userID'=>$user_id))->row();
				/*$text = $user_info->first_name.' '.$user_info->last_name.' started unfollow you';
				$this->db->insert('notifications', array('type'=>'unfollow','description'=>$text,
				'targetURL'=>base_url('publicprofile/'.$fallow_id),'notify_to'=>$fallow_id,'timestamp'=>date('Y-m-d H:i:s')));*/
			redirect('dashboard/my_network');
		}else{
			redirect('login');
		}	
}
function notifications(){
	$user_id = $this->session->userdata('user_id');
	
		if($user_id>0){
			$notifyID = $this->uri->segment(3);
			if($notifyID){
				$this->db->where('notifyID',$notifyID);
				$this->db->delete('notifications');
				redirect('dashboard/notifications');
			}
			$this->db->where('userID', $user_id );
		    $this->db->from('users');
			$data['userinfo'] = $this->db->get()->row();
			$this->db->where('user_id', $user_id );
			$this->db->from('user_profile');
			$data['userprofileinfo'] = $this->db->get()->row();
			$data['page_type']='notifications';
			$data['View'] = "enduser/notifications";
			$data['page_content'] = $this->load->view($data['View'], $data, true);
			$this->load->view('enduser/layouts/dashboard', $data);
		}else{
			redirect('login');
		}	
}
function resources(){
		$user_level =0;
		$user_id = $this->session->userdata('user_id');
		$user_level = $this->session->userdata('user_level');
		
		if($user_id>0){
		$this->db->where('userID', $user_id );
		    $this->db->from('users');
			$data['userinfo'] = $this->db->get()->row();
			$this->db->where('user_id', $user_id );
			$this->db->from('user_profile');	
			$data['resources'] = $this->db->order_by('created_at','desc')->get_where('resources',array('site_id'=>site_id()))->result();
			$data['page_type']='resources';
			$data['View'] = "enduser/resources";
			$data['page_content'] = $this->load->view($data['View'], $data, true);
			$this->load->view('enduser/layouts/dashboard', $data);
		}else{
			redirect('login');
		}
	}


function edit_profile(){
		$user_id = $this->session->userdata('user_id');
		if($user_id>0){
		$this->db->where('userID', $user_id );
		$this->db->from('users');
		$data['userinfo'] = $this->db->get()->row();
		$this->db->where('user_id', $user_id );
		$this->db->from('user_profile');
		$data['userprofileinfo'] = $this->db->get()->row();
		$data['page_type']='user_profile';
		$data['View'] = "enduser/edit_profile";
		$data['page_content'] = $this->load->view($data['View'], $data, true);
		$this->load->view('enduser/layouts/dashboard', $data);
		if($this->input->post('submit') == 1){
			$user_array = array(
			
			'first_name'=>$this->input->post('first_name'),
			'last_name'=>$this->input->post('last_name'),
			'title'=>$this->input->post('title')
			);
			$profile_array = array(
			
			'about'=>$this->input->post('about'),
			'business_email'=>$this->input->post('business_email'),
			'business_name'=>$this->input->post('business_name'),
			'about_bussiness'=>$this->input->post('about_bussiness'),
			'b_mission'=>$this->input->post('b_mission'),
			
			'b_address'=>$this->input->post('b_address'),
			'phone'=>$this->input->post('phone'),
			'website'=>$this->input->post('website'),
			'facebook'=>$this->input->post('facebook'),
			'twitter'=>$this->input->post('twitter'),
			'instagram'=>$this->input->post('instagram'),
			'linkedin'=>$this->input->post('linkedin')
			);
			$this->db->update('users',$user_array,array('userID'=>$user_id));
			$this->db->update('user_profile',$profile_array,array('user_id'=>$user_id));
			$this->session->set_flashdata('sucesess', 'Profile Updated Sucessfully');
			redirect('dashboard/edit_profile');
		}
			
	}else{
			redirect('login');
		}	
	
	
}

public function editor_upload(){
	$user_id = $this->session->userdata('user_id');
	if($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest' && isset($_POST['easyeditor-upload']) && isset($_FILES['file']) && $_FILES['file']['name'] != NULL ) {
		$originalName = $_FILES['file']['name'];
		$rootPath = 'uploads/editor_images/';
		$fileName = secure_file_upload($_FILES['file'], $rootPath, array('jpg', 'jpeg', 'png'), 4, true);
		if( $fileName != NULL ) {
			$this->db->insert('editor_img',array('url'=>$fileName,'user_id'=>$user_id));
			$images  = $this->db->get_where('editor_img',array('user_id'=>$user_id))->result();
			$html='';
			if($images){
				foreach($images as $img){
					$html .=  '<div class="col-md-2"><div class="img_boxx"><img src="'.base_url('uploads/editor_images/'.$img->url).'" class="img-responsive editor_img"></div><small><span class="delete" data-delete="'.$img->image_id.'"> delete</span></small>
				</div>';
				}
			}
			echo $html;
			
		}
		else echo 'null';
	}
	else {
		echo 'null';
	}
}
public function delete_editor_image(){
	$imageid = $_REQUEST['id'];
	$file_name = $this->db->get_where('editor_img',array('image_id'=>$imageid))->row()->url;
	@unlink('uploads/editor_images/'.$file_name);

	$this->db->where('image_id', $imageid);
    $this->db->delete('editor_img'); 
	die();
}
function delete_image2(){
	$imageid = $this->uri->segment(3);

	@unlink($this->input->post('file_name'));

	$this->db->where('id', $imageid);
    $this->db->delete('spotlights_images'); 
    echo json_encode(array("status"=>"success"));
	die();
}
function ajax_short_image(){
	$inputJSON = file_get_contents('php://input');
	$input = json_decode($inputJSON, TRUE);
	if($input){
		$counter=0;
	foreach($input as $key=>$id){
	 $this->db->update('spotlights_images',array('sort_order'=>$counter),array('id'=>$id));
	$counter++;
	}
}
echo true;
die();
}

}





<?php 
class Home extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->library('encryption');
		$this->load->library('email');
		 $this->load->library("pagination");
        $this->load->model('enduser/login_model');
       
    }
	function delete_cache($uri_string=null)
{
    $CI =$this;
    $path = $CI->config->item('cache_path');
    $path = rtrim($path, DIRECTORY_SEPARATOR);

    $cache_path = ($path == '') ? APPPATH.'cache/' : $path;

    $uri =  $CI->config->item('base_url').
            $CI->config->item('index_page').
            $uri_string;

    $cache_path .= md5($uri);

     unlink($cache_path);
	redirect('home');
}
    public function default_data(){
		$user_id = $this->session->userdata('user_id');
		/*if($user_id){
			$user_level = $this->session->userdata('user_level');
			if($user_level ==1){
				redirect('admin');
			}elseif($user_level ==3){
				redirect('superadmin');
			}else{
				 redirect('dashboard');
			}
		}*/
		$site_id = site_id();
		$data['categories'] = $this->db->query("SELECT s.*, 
			u.site_id,
			u.level,
			r.spotlight_id,
			r.web_id,
			cat.categoryTitle
			FROM spotlights s 
			LEFT JOIN region_spotlights r ON (r.spotlight_id=s.postID AND r.web_id=$site_id)
			LEFT JOIN spotlights_category cat ON (s.category=cat.categoryTitle)
			INNER JOIN users u ON s.userid=u.userID AND ((u.level = 3  AND r.web_id=".$site_id.") OR (u.level != 3 AND u.site_id  =$site_id)) 
			WHERE s.status=1 ORDER BY s.created_at DESC")->result_array();
			return $data;
	}
	public function index()
	{   
	$user_id = $this->session->userdata('user_id');
	/*if($user_id){
		$user_level = $this->session->userdata('user_level');
		if($user_level ==1){
			redirect('admin');
		}elseif($user_level ==3){
			redirect('superadmin');
		}else{
			 redirect('dashboard');
		}
	}*/
	$site_id = site_id();
		
	$data = $this->default_data();
	$data['banner_settings']=site_settings('banner_settings');
   
	$data['tranding'] = $this->db->query("SELECT s.*, 
			u.first_name,
			u.last_name,
			u.photo,
			u.site_id,
			u.level,
			r.spotlight_id,
			r.web_id,
			(SELECT count(likeID) FROM likes l WHERE s.postID=l.itemID) AS likecount,
			(SELECT count(commentID) FROM comments l WHERE s.postID=l.itemID) AS comment_count
			FROM spotlights s 
			LEFT JOIN region_spotlights r ON (r.spotlight_id=s.postID AND r.web_id=$site_id)
			INNER JOIN users u ON s.userid=u.userID AND ((u.level = 3  AND r.web_id=".$site_id.") OR (u.level != 3 AND u.site_id  =$site_id)) 
			WHERE s.status=1 AND u.level = 1 AND s.spotlight_type='Media/Podcast' ORDER BY created_at DESC limit 4")->result_array();
			
	$data['all_events'] = $this->db->query("SELECT s.*, 
			u.first_name,
			u.last_name,
			u.photo,
			u.site_id,
			u.level,
			r.spotlight_id,
			r.web_id,
			STR_TO_DATE(s.event_end_date, '%d-%m-%Y')  AS start_date,
			(SELECT count(likeID) FROM likes l WHERE s.postID=l.itemID) AS likecount
			FROM spotlights s 
			LEFT JOIN region_spotlights r ON (r.spotlight_id=s.postID AND r.web_id=$site_id)
			INNER JOIN users u ON s.userid=u.userID AND ((u.level = 3  AND r.web_id=".$site_id.") OR (u.level != 3 AND u.site_id  =$site_id)) 
			WHERE s.status=1 AND u.level = 1 AND STR_TO_DATE(s.event_end_date, '%d-%m-%Y')  >= curdate() AND s.spotlight_type='Events' ORDER BY start_date ASC  limit 6")->result_array();
	
	$data['spotlight_all'] = $this->db->query("SELECT s.*, 
		u.first_name,
		u.last_name,
		u.photo,
		u.site_id,
		u.level,
		r.spotlight_id,
		r.web_id,
		(SELECT count(likeID) FROM likes l WHERE s.postID=l.itemID) AS likecount
		FROM spotlights s 
		LEFT JOIN region_spotlights r ON (r.spotlight_id=s.postID AND r.web_id=$site_id)
		INNER JOIN users u ON s.userid=u.userID AND ((u.level = 3  AND r.web_id=".$site_id.") OR (u.level != 3 AND u.site_id  =$site_id)) 
		WHERE s.status=1  AND u.level !=3 ORDER BY s.created_at DESC  limit 12")->result_array();

		$data['admin_spotlight'] = $this->db->query("SELECT s.*, 
		u.first_name,
		u.last_name,
		u.photo,
		u.site_id,
		u.level,
		r.spotlight_id,
		r.web_id,
		(SELECT count(likeID) FROM likes l WHERE s.postID=l.itemID) AS likecount
		FROM spotlights s 
		LEFT JOIN region_spotlights r ON (r.spotlight_id=s.postID AND r.web_id=$site_id)
		INNER JOIN users u ON s.userid=u.userID AND ((u.level = 3  AND r.web_id=".$site_id.") OR (u.level != 3 AND u.site_id  =$site_id)) 
		WHERE s.status=1 AND u.level =1 ORDER BY s.created_at DESC  limit 4")->result_array();
		
		$data['slug'] ='home';
		$choose_theme_data =site_settings('choose_theme_data');
		if($choose_theme_data && $choose_theme_data =='style2'){
		$data['View'] = "enduser/style2/landing";
		$data['page_content'] = $this->load->view($data['View'], $data, true);
	    $this->load->view('enduser/style2/layouts/landing_header', $data);
		}else{
		$data['View'] = "enduser/landing";
		$data['page_content'] = $this->load->view($data['View'], $data, true);
	    $this->load->view('enduser/layouts/landing_header', $data);
		}
	}
	
	public function hbcu(){
		$choose_theme_data =site_settings('choose_theme_data');
		if($id = $this->uri->segment(3)){
		$site_id = site_id();
		$data = $this->default_data();
		$category_data =  $this->db->get_where('hbcu',array('categoryID'=>$id))->row();
		$data['spotlight_all'] = $this->db->query("SELECT s.*, 
			u.first_name,
			u.last_name,
			u.photo,
			u.site_id,
			u.level,
			r.spotlight_id,
			r.web_id,
			(SELECT count(likeID) FROM likes l WHERE s.postID=l.itemID) AS likecount
			FROM spotlights s 
			LEFT JOIN region_spotlights r ON (r.spotlight_id=s.postID AND r.web_id=$site_id)
			INNER JOIN users u ON s.userid=u.userID AND ((u.level = 3  AND r.web_id=".$site_id.") OR (u.level != 3 AND u.site_id  =$site_id)) 
			WHERE s.status=1 AND s.hbcu_cat='".$category_data->categoryID."' ORDER BY s.visits_count DESC  limit 12")->result_array();
		$data['slug'] ='hbcu/'.$id;
		$data['page_title'] =$category_data->categoryTitle;
		$data['page_type']='mainsearch';
			if($choose_theme_data && $choose_theme_data =='style2'){
				$data['View'] = "enduser/style2/landing/hbcu_category";
				$data['page_content'] = $this->load->view($data['View'], $data, true);
				$this->load->view('enduser/style2/layouts/landing_header', $data);
			}else{
				$data['View'] = "enduser/landing/hbcu_category";
				$data['page_content'] = $this->load->view($data['View'], $data, true);
				$this->load->view('enduser/layouts/landing_header', $data);
			}
		}
	}
	
	public function category(){
			$choose_theme_data =site_settings('choose_theme_data');
		if($id = $this->uri->segment(3)){
		$site_id = site_id();
	   
		$data = $this->default_data();
		$category_data =  $this->db->get_where('spotlights_category',array('categoryID'=>$id))->row();
		if(special_cms()){
			$data['spotlight_all'] = $this->db->query("SELECT s.*, 
			u.first_name,
			u.last_name,
			u.photo,
			u.site_id,
			u.level,
			r.spotlight_id,
			r.web_id,
			(SELECT count(likeID) FROM likes l WHERE s.postID=l.itemID) AS likecount
			FROM spotlights s 
			LEFT JOIN region_spotlights r ON (r.spotlight_id=s.postID AND r.web_id=$site_id)
			INNER JOIN users u ON s.userid=u.userID AND ((u.level = 3  AND r.web_id=".$site_id.") OR (u.level != 3 AND u.site_id  =$site_id)) 
			WHERE s.status=1 AND u.level = 1 AND s.category='".$category_data->categoryTitle."' ORDER BY s.visits_count DESC  limit 12")->result_array();
		}else{
		$data['spotlight_all'] = $this->db->query("SELECT s.*, 
			u.first_name,
			u.last_name,
			u.photo,
			u.site_id,
			u.level,
			r.spotlight_id,
			r.web_id,
			(SELECT count(likeID) FROM likes l WHERE s.postID=l.itemID) AS likecount
			FROM spotlights s 
			LEFT JOIN region_spotlights r ON (r.spotlight_id=s.postID AND r.web_id=$site_id)
			INNER JOIN users u ON s.userid=u.userID AND ((u.level = 3  AND r.web_id=".$site_id.") OR (u.level != 3 AND u.site_id  =$site_id)) 
			WHERE s.status=1 AND s.category='".$category_data->categoryTitle."' ORDER BY s.visits_count DESC  limit 12")->result_array();
		}
			$data['slug'] ='category/'.$id;
		$data['page_title'] =$category_data->categoryTitle;
		$data['page_type']='mainsearch';
			if($choose_theme_data && $choose_theme_data =='style2'){
				$data['View'] = "enduser/style2/landing/category";
				$data['page_content'] = $this->load->view($data['View'], $data, true);
				$this->load->view('enduser/style2/layouts/landing_header', $data);
			}else{
				$data['View'] = "enduser/landing/category";
				$data['page_content'] = $this->load->view($data['View'], $data, true);
				$this->load->view('enduser/layouts/landing_header', $data);
			}
		}
	}
	function main_search(){
	    $site_id = site_id();
	$choose_theme_data =site_settings('choose_theme_data');

			/*$preferences_arr = json_decode($data['userprofileinfo']->preferences);
			$preferences_str = implode('|', $preferences_arr);*/
			$data = $this->default_data();
			$url_sigment = $_GET['spotlight_type'];
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
				u.site_id
				  FROM spotlights s INNER JOIN users u ON s.userid=u.userID  WHERE 1=1 ".$where_filter."  AND s.status=1 AND u.site_id= $site_id ".$search_filter)->num_rows();
		    
			$config = array();
			$config["base_url"] = base_url() . "/home/main_search/". $url_sigment;
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
					u.site_id
				  FROM spotlights s INNER JOIN users u ON s.userid=u.userID  WHERE 1=1 ".$where_filter." AND s.status=1 AND u.site_id =$site_id ".$search_filter." ORDER BY s.created_at DESC limit ".$config["per_page"]." OFFSET ".$page)->result_array();
			}	  
				  
				  
      $data['news_total'] = $this->db->query("SELECT s.*, 
				u.first_name,
				u.last_name,
				u.photo,
				u.site_id
				  FROM spotlights s INNER JOIN users u ON s.userid=u.userID  WHERE 1=1 AND u.site_id =$site_id AND s.spotlight_type='News / Blog'  AND s.status=1".$search_filter)->num_rows();
				  
				  
				  
	   $data['job_total'] = $this->db->query("SELECT s.*, 
				u.first_name,
				u.last_name,
				u.photo,
				u.site_id
				  FROM spotlights s INNER JOIN users u ON s.userid=u.userID  WHERE 1=1 AND u.site_id =$site_id AND s.spotlight_type='Job Posting'  AND s.status=1".$search_filter)->num_rows();
				  
				  
				  
     $data['event_total'] = $this->db->query("SELECT s.*, 
				u.first_name,
				u.last_name,
				u.photo,
				u.site_id
				  FROM spotlights s INNER JOIN users u ON s.userid=u.userID  WHERE 1=1 AND u.site_id =$site_id AND s.spotlight_type='Events' AND s.status=1".$search_filter)->num_rows();
				  
				  
				  
				  
		  $data['spotit_total'] = $this->db->query("SELECT s.*, 
						u.first_name,
						u.last_name,
						u.photo,
						u.site_id
						  FROM spotlights s INNER JOIN users u ON s.userid=u.userID  WHERE 1=1 AND u.site_id =$site_id AND s.spotlight_type='Spotit Spotlight' AND s.status=1".$search_filter)->num_rows();

		  

			
			if(!empty($this->input->get('search')))
			{
				

			}else{
				$data['search_text'] = '';
			}

			$data['page_type']='mainsearch';
			if($choose_theme_data && $choose_theme_data =='style2'){
				$data['View'] = "enduser/style2/landing/main_search";
			$data['page_content'] = $this->load->view($data['View'], $data, true);
			$this->load->view('enduser/style2/layouts/landing_header', $data);
				
			}else{
				
			$data['View'] = "enduser/landing/main_search";
			$data['page_content'] = $this->load->view($data['View'], $data, true);
			$this->load->view('enduser/layouts/landing_header', $data);
			}
			
			
			
	
	}
	public function jobs()
	{   
	$site_id = site_id();
		$data = $this->default_data();
		$data['page_title']='Jobs';
		
		$data['spotlight_all'] = $this->db->query("SELECT s.*, 
			u.first_name,
			u.last_name,
			u.photo,
			u.site_id,
			u.level,
			r.spotlight_id,
			r.web_id,
			(SELECT count(likeID) FROM likes l WHERE s.postID=l.itemID) AS likecount
			FROM spotlights s 
			LEFT JOIN region_spotlights r ON (r.spotlight_id=s.postID AND r.web_id=$site_id)
			INNER JOIN users u ON s.userid=u.userID AND ((u.level = 3  AND r.web_id=".$site_id.") OR (u.level != 3 AND u.site_id  =$site_id)) 
			WHERE s.status=1 AND s.spotlight_type='Job Posting' ORDER BY s.visits_count DESC  limit 12")->result_array();
		
	
			$data['View'] = "enduser/landing/category";
			$data['page_content'] = $this->load->view($data['View'], $data, true);
		$this->load->view('enduser/layouts/landing_header', $data);
		}
		public function usergroup($id)
		{   
		//echo $id;
		$site_id = site_id();
			//$data = $this->default_data(); 
			$title  = $this->db->get_where('home_blocks',array('b_id'=>$id,'post_type'=>'resource'))->row();
			$soda = $title->title;
			
			$p_category = $title->custom_fields; 
			  $p_category = json_decode($p_category);
			  $data['page_title']=$p_category->page_title;
			 $data['page_content'] = $p_category->short_info;
			//echo $id; die;
			
			$data['res']= $this->db->query("SELECT p.*, 
				u.first_name,
				u.last_name,
				u.photo,
				u.site_id,
				u.status,
				u.level 
				FROM user_profile p 
				INNER JOIN users u ON p.user_id=u.userID
				WHERE u.status !=2 AND (p.resources LIKE '%".$soda."%') AND u.site_id=".$site_id)->result_array();
				  if($res_data = $data['res']){
					  foreach($res_data as $u_data){
						  $user_idss[] =$u_data['user_id'];
					  }
				  }
				
				//print_r($user_idss);
				 $ids_string =implode(',',$user_idss);
				 $where_filter ="";
		     if($filter_cat = urldecode($_GET['category'])){
				$where_filter = " AND s.category='$filter_cat'";
			 }
			if($ids_string){
			$data['related_spotlights'] = $this->db->query("SELECT s.*, 
			u.first_name,
			u.last_name,
			u.photo,
			u.site_id,
			u.level,
			r.spotlight_id,
			r.web_id,
			(SELECT count(likeID) FROM likes l WHERE s.postID=l.itemID) AS likecount,
			(SELECT count(commentID) FROM comments l WHERE s.postID=l.itemID) AS comment_count
			FROM spotlights s 
			LEFT JOIN region_spotlights r ON (r.spotlight_id=s.postID AND r.web_id=$site_id)
			INNER JOIN users u ON s.userid=u.userID AND ((u.level = 3  AND r.web_id=".$site_id.") OR (u.level != 3 AND u.site_id  =$site_id)) 
			WHERE s.status=1 AND u.userID IN ($ids_string) $where_filter ORDER BY s.visits_count DESC limit 9")->result_array();
				
			$data['related_categories'] = $this->db->query("SELECT s.*, 
			u.first_name,
			u.last_name,
			u.photo,
			u.site_id,
			u.level,
			r.spotlight_id,
			r.web_id,
			(SELECT count(likeID) FROM likes l WHERE s.postID=l.itemID) AS likecount,
			(SELECT count(commentID) FROM comments l WHERE s.postID=l.itemID) AS comment_count
			FROM spotlights s 
			LEFT JOIN region_spotlights r ON (r.spotlight_id=s.postID AND r.web_id=$site_id)
			INNER JOIN users u ON s.userid=u.userID AND ((u.level = 3  AND r.web_id=".$site_id.") OR (u.level != 3 AND u.site_id  =$site_id)) 
			WHERE s.status=1 AND u.userID IN ($ids_string) GROUP BY s.category")->result_array();
			}
			//print_r($data['res']); die;
		
				$data['View'] = "enduser/landing/resource";
				$data['page_content'] = $this->load->view($data['View'], $data, true);
			$this->load->view('enduser/layouts/landing_header', $data);
			}
		public function local_businesses()
		{   
		//echo $id;
		$site_id = site_id();
			//$data = $this->default_data(); 
			$data['user_groups']  = $this->db->get_where('home_blocks',array('post_type'=>'resource'))->result();
			$soda = $title->title;
			
			$p_category = $title->custom_fields; 
			  $p_category = json_decode($p_category);
			  $data['page_title']='Local Businesses';
			 $data['page_content'] = $p_category->short_info;
			//echo $id; die;
			if($soda = $_GET['businnes']){
				$soda = urldecode($soda);
				$data['res'] = $this->db->query("SELECT p.*, 
				u.first_name,
				u.last_name,
				u.photo,
				u.site_id,
				u.status,
				u.level 
				FROM user_profile p 
				INNER JOIN users u ON p.user_id=u.userID
				WHERE u.status !=2 AND (p.industry ='$soda' OR (p.resources LIKE '%".$soda."%')) AND u.site_id=".$site_id)->result_array();
			}else{
			$data['res'] = $this->db->query("SELECT p.*, 
				u.first_name,
				u.last_name,
				u.photo,
				u.site_id,
				u.status,
				u.level 
				FROM user_profile p 
				INNER JOIN users u ON p.user_id=u.userID
				WHERE u.status !=2 AND p.resources !='' AND u.site_id=".$site_id)->result_array();
			}
			if($res_data = $data['res']){
					  foreach($res_data as $u_data){
						  $user_idss[] =$u_data['user_id'];
					  }
				  }
	         if(is_array($user_idss))$ids_string =implode(',',$user_idss);
				 $where_filter ="";
		     if($filter_cat = urldecode($_GET['category'])){
				$where_filter = " AND s.category='$filter_cat'";
			 }
			if($ids_string){
			$data['related_spotlights'] = $this->db->query("SELECT s.*, 
			u.first_name,
			u.last_name,
			u.photo,
			u.site_id,
			u.level,
			r.spotlight_id,
			r.web_id,
			(SELECT count(likeID) FROM likes l WHERE s.postID=l.itemID) AS likecount,
			(SELECT count(commentID) FROM comments l WHERE s.postID=l.itemID) AS comment_count
			FROM spotlights s 
			LEFT JOIN region_spotlights r ON (r.spotlight_id=s.postID AND r.web_id=$site_id)
			INNER JOIN users u ON s.userid=u.userID AND ((u.level = 3  AND r.web_id=".$site_id.") OR (u.level != 3 AND u.site_id  =$site_id)) 
			WHERE s.status=1 AND u.userID IN ($ids_string) $where_filter ORDER BY s.visits_count DESC limit 9")->result_array();
				
			$data['related_categories'] = $this->db->query("SELECT s.*, 
			u.first_name,
			u.last_name,
			u.photo,
			u.site_id,
			u.level,
			r.spotlight_id,
			r.web_id,
			(SELECT count(likeID) FROM likes l WHERE s.postID=l.itemID) AS likecount,
			(SELECT count(commentID) FROM comments l WHERE s.postID=l.itemID) AS comment_count
			FROM spotlights s 
			LEFT JOIN region_spotlights r ON (r.spotlight_id=s.postID AND r.web_id=$site_id)
			INNER JOIN users u ON s.userid=u.userID AND ((u.level = 3  AND r.web_id=".$site_id.") OR (u.level != 3 AND u.site_id  =$site_id)) 
			WHERE s.status=1 AND u.userID IN ($ids_string) GROUP BY s.category")->result_array();
			}
			//print_r($data['res']); die;
		
				$data['View'] = "enduser/landing/resource_all";
				$data['page_content'] = $this->load->view($data['View'], $data, true);
			$this->load->view('enduser/layouts/landing_header', $data);
			}
		public function media(){
			$choose_theme_data =site_settings('choose_theme_data');
			 $site_id = site_id();
		$data = $this->default_data();
		$data['page_title']='Media/Podcast';
		$data['slug']='media';
		$filter="";
		
		$data['spotlight_all'] = $this->db->query("SELECT s.*, 
			u.first_name,
			u.last_name,
			u.photo,
			u.site_id,
			u.level,
			r.spotlight_id,
			r.web_id,
			(SELECT count(likeID) FROM likes l WHERE s.postID=l.itemID) AS likecount
			FROM spotlights s 
			LEFT JOIN region_spotlights r ON (r.spotlight_id=s.postID AND r.web_id=$site_id)
			INNER JOIN users u ON s.userid=u.userID AND ((u.level = 3  AND r.web_id=".$site_id.") OR (u.level != 3 AND u.site_id  =$site_id)) 
			WHERE s.status=1 ".$filter." AND s.spotlight_type='Media/Podcast' AND u.level = 1 ORDER BY s.created_at DESC limit 12")->result_array();
		if($choose_theme_data && $choose_theme_data =='style2'){
				$data['View'] = "enduser/style2/landing/media_posts";
			$data['page_content'] = $this->load->view($data['View'], $data, true);
		$this->load->view('enduser/style2/layouts/landing_header', $data);
				
			}else{
	
	
	
			$data['View'] = "enduser/landing/media_posts";
			$data['page_content'] = $this->load->view($data['View'], $data, true);
		$this->load->view('enduser/layouts/landing_header', $data);
			}
		}
		public function news(){
			$choose_theme_data =site_settings('choose_theme_data');
			 $site_id = site_id();
		$data = $this->default_data();
		$data['page_title']='Business News & Media';
		$data['slug']='media';
		$filter="";
		$data['spotlight_all'] = $this->db->query("SELECT s.*, 
			u.first_name,
			u.last_name,
			u.photo,
			u.site_id,
			u.level,
			r.spotlight_id,
			r.web_id,
			(SELECT count(likeID) FROM likes l WHERE s.postID=l.itemID) AS likecount
			FROM spotlights s 
			LEFT JOIN region_spotlights r ON (r.spotlight_id=s.postID AND r.web_id=$site_id)
			INNER JOIN users u ON s.userid=u.userID AND ((u.level = 3  AND r.web_id=".$site_id.") OR (u.level != 3 AND u.site_id  =$site_id)) 
			WHERE s.status=1 ".$filter." AND (s.spotlight_type='Media/Podcast' OR s.spotlight_type='News / Blog' OR s.spotlight_type='Spotit Spotlight') AND u.level = 1 ORDER BY s.created_at DESC limit 12")->result_array();
	
			$data['View'] = "enduser/landing/news";
			$data['page_content'] = $this->load->view($data['View'], $data, true);
			$this->load->view('enduser/layouts/landing_header', $data);
		}
		
		public function events()
		{   
		$choose_theme_data =site_settings('choose_theme_data');
	     $site_id = site_id();
		$data = $this->default_data();
		$data['page_title']='Events';
		$data['slug']='events';
		$filter="";
		if($start = $_GET['start_date']){
			$filter ="AND s.event_start_date = '$start'";
		}
		if($end_date = $_GET['end_date']){
			$filter ="AND s.event_time = '$end_date'";
		}
		$data['spotlight_all2'] = $this->db->query("SELECT s.*, 
			u.first_name,
			u.last_name,
			u.photo,
			u.site_id,
			u.level,
			r.spotlight_id,
			r.web_id,
			STR_TO_DATE(s.event_end_date, '%d-%m-%Y')  AS start_date,
			(SELECT count(likeID) FROM likes l WHERE s.postID=l.itemID) AS likecount
			FROM spotlights s 
			LEFT JOIN region_spotlights r ON (r.spotlight_id=s.postID AND r.web_id=$site_id)
			INNER JOIN users u ON s.userid=u.userID AND ((u.level = 3  AND r.web_id=".$site_id.") OR (u.level != 3 AND u.site_id  =$site_id)) 
			WHERE s.status=1 AND STR_TO_DATE(s.event_end_date, '%d-%m-%Y')  >= curdate() AND s.spotlight_type='Events' ORDER BY start_date ASC limit 12")->result_array();
			
		if(special_cms()){
			$data['spotlight_all'] = $this->db->query("SELECT s.*, 
			u.first_name,
			u.last_name,
			u.photo,
			u.site_id,
			u.level,
			r.spotlight_id,
			r.web_id,
			STR_TO_DATE(s.event_end_date, '%d-%m-%Y')  AS start_date,
			(SELECT count(likeID) FROM likes l WHERE s.postID=l.itemID) AS likecount
			FROM spotlights s 
			LEFT JOIN region_spotlights r ON (r.spotlight_id=s.postID AND r.web_id=$site_id)
			INNER JOIN users u ON s.userid=u.userID AND ((u.level = 3  AND r.web_id=".$site_id.") OR (u.level != 3 AND u.site_id  =$site_id)) 
			WHERE s.status=1 ".$filter." AND STR_TO_DATE(s.event_end_date, '%d-%m-%Y')  >= curdate() AND s.spotlight_type='Events' AND u.level = 1 ORDER BY start_date ASC limit 12")->result_array();
		}else{
		$data['spotlight_all'] = $this->db->query("SELECT s.*, 
			u.first_name,
			u.last_name,
			u.photo,
			u.site_id,
			u.level,
			r.spotlight_id,
			r.web_id,
			STR_TO_DATE(s.event_end_date, '%d-%m-%Y')  AS start_date,
			(SELECT count(likeID) FROM likes l WHERE s.postID=l.itemID) AS likecount
			FROM spotlights s 
			LEFT JOIN region_spotlights r ON (r.spotlight_id=s.postID AND r.web_id=$site_id)
			INNER JOIN users u ON s.userid=u.userID AND ((u.level = 3  AND r.web_id=".$site_id.") OR (u.level != 3 AND u.site_id  =$site_id)) 
			WHERE s.status=1 ".$filter." AND STR_TO_DATE(s.event_end_date, '%d-%m-%Y')  >= curdate() AND s.spotlight_type='Events' ORDER BY start_date ASC  limit 12")->result_array();
		}
	if($choose_theme_data && $choose_theme_data =='style2'){
				$data['View'] = "enduser/style2/landing/category";
			$data['page_content'] = $this->load->view($data['View'], $data, true);
		$this->load->view('enduser/style2/layouts/landing_header', $data);
				
			}else{
	
	
	
			$data['View'] = "enduser/landing/category";
			$data['page_content'] = $this->load->view($data['View'], $data, true);
		$this->load->view('enduser/layouts/landing_header', $data);
			}
		}
		public function privacy_policy()
		{   
	     $site_id = site_id();
		//$data = $this->default_data();
		
		$choose_theme_data =site_settings('choose_theme_data');
		if($choose_theme_data && $choose_theme_data =='style2'){
			$data['page_title']='Privacy Policy';
		$data['View'] = "enduser/style2/landing/privacy_policy";
			$data['page_content'] = $this->load->view($data['View'], $data, true);
		$this->load->view('enduser/style2/layouts/landing_header', $data);
		}else{
			$data['page_title']='Privacy Policy';
		$data['View'] = "enduser/landing/privacy_policy";
		$data['page_content'] = $this->load->view($data['View'], $data, true);
		$this->load->view('enduser/layouts/landing_header', $data);
		}
		}
		public function terms_conditions()
		{   
	     $site_id = site_id();
		//$data = $this->default_data();
		
		$data['page_title']='Terms and Conditions';
		$choose_theme_data =site_settings('choose_theme_data');
		if($choose_theme_data && $choose_theme_data =='style2'){
			$data['View'] = "enduser/style2/landing/terms";
		$data['page_content'] = $this->load->view($data['View'], $data, true);
		$this->load->view('enduser/style2/layouts/landing_header', $data);
		}else{
			
		$data['View'] = "enduser/landing/terms";
		$data['page_content'] = $this->load->view($data['View'], $data, true);
		$this->load->view('enduser/layouts/landing_header', $data);
		}
		}
		public function mission()
		{   
	     $site_id = site_id();
		//$data = $this->default_data();
		$data['page_title']='Our Mission';
		$data['View'] = "enduser/landing/mission";
		$data['page_content'] = $this->load->view($data['View'], $data, true);
		$this->load->view('enduser/layouts/landing_header', $data);
		}
		public function comming_soon()
		{   
	     $site_id = site_id();
		//$data = $this->default_data();
		$data['page_title']='Comming Soon';
		$data['View'] = "enduser/landing/commingsoon";
		$data['page_content'] = $this->load->view($data['View'], $data, true);
		$this->load->view('enduser/layouts/landing_header', $data);
		}
		
	}
	
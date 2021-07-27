<?php 
class Page extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->library('encryption');
		$this->load->library('email');
		 $this->load->library("pagination");
        $this->load->model('enduser/login_model');
       
    }

	public function index()
	{   
	$site_id = site_id();
	$slug = $this->uri->segment(2);
	$data['slug'] = 'page/'.$this->uri->segment(2);
	$cat_id = $this->uri->segment(3);
	if($slug){
		$data['page_data']  = $page_data= $this->db->get_where('pages',array('pageSlug'=>$slug))->row();
		//$data['slug']='events';
		    if($page_data->template){
				if($cat_id !='all'){
					$cat_slug = $cat_id ;
				}else{
					$cat_slug = 'all';
				}
				$url_sigment = $slug.'/'.$cat_slug;
				if($cat_id && ($cat_id !='all')){
					$data['cat_titlee'] = $cat_title = $this->db->get_where('spotlights_category',array('categoryID'=>$cat_id ))->row()->categoryTitle;
					if($cat_id){
					$where_filter = " AND s.category='$cat_title' ";
					}
				}else{
					$preferences_arr = json_decode($page_data->spot_category);
					
					$preferences_str = implode('|', $preferences_arr);
		
					$where_filter ="AND s.category REGEXP '^(".$preferences_str.")'";
					
				}
				
				
				
				$totalcount = $this->db->query("SELECT s.*, 
				u.first_name,
				u.last_name,
				u.photo,
				u.level,
				u.site_id
				  FROM spotlights s INNER JOIN users u ON s.userid=u.userID  WHERE 1=1 ".$where_filter." AND s.status=1 AND u.site_id =$site_id ".$search_filter)->num_rows();
		    
			$config = array();
			$config["base_url"] = base_url() . "/page/". $url_sigment;
			$config["total_rows"] = $totalcount;
			$config["per_page"] = 12;
			$config["uri_segment"] = 4;
			
			$config['full_tag_open'] = '<nav aria-label="Page navigation example"><ul class="pagination justify-content-center pagination-separated">';
			$config['full_tag_close'] = '</ul></nav>';            
			$config['prev_link'] = '<i class="fal fa-angle-left"></i>';
			$config['first_tag_open'] = '<li class="page-item">';
			$config['first_tag_close'] = '</li>';
			$config['prev_tag_open'] = '<li class="page-item">';
			$config['prev_tag_close'] = '</li>';
			$config['next_link'] = '<i class="fal fa-angle-right"></i>';
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
				u.level,
				u.site_id
				  FROM spotlights s INNER JOIN users u ON s.userid=u.userID  WHERE 1=1 ".$where_filter." AND s.status=1 AND u.site_id =$site_id ".$search_filter." ORDER BY s.created_at DESC limit ".$config["per_page"]." OFFSET ".$page)->result_array();
				
				
				
				
		    $data['View'] = "enduser/style2/landing/pages/".$page_data->template;
			}
			elseif($slug =='partners'){
			$data['View'] = "enduser/style2/landing/pages/partners";
			}else{
			$data['View'] = "enduser/style2/landing/pages/default";
			}
			$data['page_content'] = $this->load->view($data['View'], $data, true);
			$this->load->view('enduser/style2/layouts/landing_header', $data);
	}
	}
	public function category(){
			$choose_theme_data =site_settings('choose_theme_data');
		if($id = $this->uri->segment(3)){
		$site_id = site_id();
		$data = $this->default_data();
		$category_data =  $this->db->get_where('spotlights_category',array('categoryID'=>$id))->row();
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
		public function events()
		{   
		$choose_theme_data =site_settings('choose_theme_data');
	     $site_id = site_id();
		$data = $this->default_data();
		$data['page_title']='Events';
		
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
			WHERE s.status=1 AND s.spotlight_type='Events' ORDER BY s.visits_count DESC  limit 12")->result_array();
		
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
		
	}
<?php
// defined('BASEPATH') OR exit('No direct script access allowed');

class Tag extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
		$this->load->helper("url");
        $this->load->library("pagination");
    }


function index(){
	    $site_id = site_id();
		$tag = $_REQUEST['tag'];
	     if($tag){
		
			
			
			
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
				r.web_id
				  FROM spotlights s 
				   LEFT JOIN region_spotlights r ON (r.web_id=".$site_id." AND r.spotlight_id=s.postID)
				  INNER JOIN users u ON s.userid=u.userID AND ((u.level = 3 AND r.web_id=".$site_id.") OR (u.level != 3 AND u.site_id  =$site_id)) 
				 	
				   WHERE s.tags= '%".$tag."%'  AND s.status=1".$where_filter." ".$search_filter ." ".$group_by)->num_rows();
			
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
				u.level,
				r.spotlight_id,
				r.web_id,
				(SELECT count(likeID) FROM likes l WHERE l.userID=s.userid  AND l.itemID=s.postID) AS likecount 
				  FROM spotlights s 
				   LEFT JOIN region_spotlights r ON (r.web_id=".$site_id." AND r.spotlight_id=s.postID)
				  INNER JOIN users u ON s.userid=u.userID AND ((u.level = 3 AND r.web_id=".$site_id.") OR (u.level != 3 AND u.site_id  =$site_id)) 
				 
				  
				  WHERE  s.tags LIKE '%".$tag."%' AND s.status=1 ORDER BY s.created_at DESC  limit ".$config["per_page"]." OFFSET ".$page)->result_array();
				  
				  
		
				  
	
		
		
				  
			
				  
	 
			
			if(!empty($this->input->get('search')))
			{

			}else{
				$data['search_text'] = '';
			}

			$data['page_type']='myfeed';
			$data['View'] = "enduser/tags";
			$data['page_content'] = $this->load->view($data['View'], $data, true);
			$this->load->view('enduser/layouts/dashboard', $data);
		}else{
			redirect('login');
		}	
	}


function index22(){
	$tag = $_REQUEST['tag'];
	if($tag){
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
				(SELECT count(likeID) FROM likes l WHERE  s.postID=l.itemID) AS likecount  FROM spotlights s INNER JOIN users u ON s.userid=u.userID WHERE s.tags= '%".$tag."%'  ORDER BY s.created_at DESC")->result_array();

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


			$data['View'] = "enduser/tags";
			$data['page_content'] = $this->load->view($data['View'], $data, true);
			$this->load->view('enduser/layouts/dashboard', $data);
		
		}else{
				redirect('home');
			}
}
}
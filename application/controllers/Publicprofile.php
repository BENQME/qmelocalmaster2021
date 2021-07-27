<?php
// defined('BASEPATH') OR exit('No direct script access allowed');

class Publicprofile extends CI_Controller {

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
    public function profile_data($public_id){
        $site_id = site_id();
		$user_id = $this->session->userdata('user_id');
			$this->db->where('user_id', $public_id );
			$this->db->from('user_profile');
			$profile_info = $this->db->get()->row();
			if($profile_info->preferences){
			$preferences_arr = json_decode($profile_info->preferences);
			$preferences_str = implode('|', $preferences_arr);
			}else{
				$preferences_str="";
			}
			$data['user_review'] = $this->db->get_where('reviews',array('review_by'=>$user_id,'user_id'=>$public_id,'type'=>'review'))->row();
			$data['review_list'] = $this->db->query("SELECT r.*, 
				u.first_name,
				u.last_name,
				u.photo
				  FROM reviews r
				   INNER JOIN users u ON r.review_by=u.userID 
				    WHERE r.user_id =".$public_id." AND type='review' ORDER BY r.date_time DESC")->result_array();
			
			$data['recommend_list'] = $this->db->query("SELECT r.*, 
				u.first_name,
				u.last_name,
				u.photo
				  FROM reviews r
				   INNER JOIN users u ON r.review_by=u.userID 
				    WHERE r.user_id =".$public_id." AND type='recommend' ORDER BY r.date_time DESC")->result_array();
			//$this->db->order_by('date_time','desc')->get_where('reviews',array('user_id'=>$public_id,'type'=>'review'))->result();
			$data['recomended'] = $this->db->get_where('reviews',array('review_by'=>$public_id,'user_id'=>$user_id,'type'=>'recommend'))->row();
			$data['suggest_users'] = $this->db->query("SELECT u.*, 
				s.userid,
				s.category,
				s.status
				  FROM users u 
				   INNER JOIN spotlights s ON s.userid=u.userID 
				  
				    WHERE s.category REGEXP '^(".$preferences_str.")'  AND s.status=1 AND u.level=0 AND u.site_id = $site_id AND u.userID !=".$public_id." GROUP BY u.userID")->result_array();
/*		$this->db->query("SELECT u.*, 
				u.first_name,
				u.last_name,
				u.photo,
				
				  FROM spotlights s INNER JOIN users u ON s.userid=u.userID  WHERE s.userid =".$public_id." AND s.spotlight_type='Job Posting' AND s.status=1 ")->num_rows();*/
		
		
		$data['spotlights_photo'] = $this->db->select('*')->from('spotlights')
		->where('userid', $public_id)
		->order_by('postID','desc')
		->limit(12)
		->get()
		->result();
		$data["total_posts_news"] = $this->db->query("SELECT s.* 
				  FROM spotlights s WHERE s.userid =".$public_id." AND s.spotlight_type='News / Blog' AND s.status=1 ")->num_rows();
	   $data["total_posts_media"] = $this->db->query("SELECT s.* 
				  FROM spotlights s WHERE s.userid =".$public_id." AND s.spotlight_type='Media/Podcast' AND s.status=1 ")->num_rows();
		
		
		$data["total_posts_jobs"] = $this->db->query("SELECT s.* 
				  FROM spotlights s  WHERE s.userid =".$public_id." AND s.spotlight_type='Job Posting' AND s.status=1 ")->num_rows();
  $data["total_posts_events"] = $this->db->query("SELECT s.* 
				  FROM spotlights s WHERE s.userid =".$public_id." AND s.spotlight_type='Events' AND s.status=1 ")->num_rows();
				
  $data["total_posts_promotion"] = $this->db->query("SELECT s.* 
				  FROM spotlights s  WHERE s.userid =".$public_id." AND s.spotlight_type='Spotit Spotlight' AND s.status=1 ")->num_rows();  
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
			return $data;
		
	}
	public function review(){
		$user_id = $this->session->userdata('user_id');
		$public_id = $this->uri->segment(3);
		if($public_id && $user_id){
		$check_review = $this->db->get_where('reviews',array('review_by'=>$user_id,'user_id'=>$public_id,'type'=>'review'))->row();
		$review_content = $this->input->post('comment');
		$ratings = $this->input->post('rating');
		$insert_data = array('user_id'=>$public_id,
		                     'review_by'=>$user_id,
		                     'review_content'=>$review_content,
							 'ratings'=>$ratings,
							 'type'=>'review',
							 'date_time' => date('Y-m-d H:i:s'));
		if($check_review){
			$this->db->update('reviews',$insert_data,array('review_by'=>$user_id,'user_id'=>$public_id));
			$get_review = $this->db->get_where('reviews',array('review_by'=>$user_id,'user_id'=>$public_id,'type'=>'review'))->row();
			
			$user_info = $this->db->get_where('users',array('userID'=>$user_id))->row();
			if($r= $get_review->ratings){
					$rate =' with '.$r.' stars ratings';
				}else{
					$rate =' ';
				}
				$text = $user_info->first_name.' '.$user_info->last_name.' Update Review '.$rate;
				$this->db->insert('notifications', array('type'=>'review','description'=>$text,
				'targetURL'=>base_url('publicprofile/'.$public_id),'notify_to'=>$public_id,'timestamp'=>date('Y-m-d H:i:s')));
			
			 $this->session->set_flashdata('sucesess', 'Review Updated Sucessfully');
			}else{
				
				
				$this->db->insert('reviews',$insert_data);
				
				
				$user_info = $this->db->get_where('users',array('userID'=>$user_id))->row();
				
				$get_review = $this->db->get_where('reviews',array('review_by'=>$user_id,'user_id'=>$public_id,'type'=>'review'))->row();
				if($r= $get_review->ratings){
					$rate =' with '.$r.' stars ratings';
				}else{
					$rate =' ';
				}
				$text = $user_info->first_name.' '.$user_info->last_name.' Wrote a Review '.$rate;
				$this->db->insert('notifications', array('type'=>'review','description'=>$text,
				'targetURL'=>base_url('publicprofile/'.$user_id),'notify_to'=>$public_id,'timestamp'=>date('Y-m-d H:i:s')));
			    $this->session->set_flashdata('sucesess', 'Review added Sucessfully');
			}
	   
		redirect('publicprofile/'.$public_id);
		}else{
			redirect('login');
		}
	}
	public function index()
	{  
	$public_id = $this->uri->segment(2);
    	
		if($public_id>0){
			$data = $this->profile_data($public_id);
			//print_r($data); die;
			
			$data['page_type']='user_profile';
			$current_user = $this->db->get_where('users',array('userID'=> $this->session->userdata('user_id')))->row();
			$data['View'] = "enduser/publicprofile";
			$data['page_content'] = $this->load->view($data['View'], $data, true);
		/*	if(isset($current_user) && $current_user->level==1){

				$this->load->view('admin/layouts/profile', $data);
			}elseif(isset($current_user) && $current_user->level==3){
				$this->load->view('superadmin/layouts/profile', $data);
			}else{*/
			$this->load->view('enduser/layouts/profile', $data);
			//}
		}else{
			redirect('login');
		}
    }
	
	 public function news(){
	   $public_id = $this->uri->segment(3);
    	
		if($public_id>0){
			$data =$this->profile_data($public_id);
			$totalcount = $data['total_posts_news'];
			$config = array();
			$config["base_url"] = base_url() . "/publicprofile/news/".$public_id ;
			$config["total_rows"] = $totalcount;
			$config["per_page"] = 6;
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

			$this->pagination->initialize($config);

			$page = ($this->uri->segment(4))? $this->uri->segment(4) : 0;

			$data["links"] = $this->pagination->create_links();
            
			$data['spotlight_all'] = $this->db->query("SELECT s.*, 
				u.first_name,
				u.last_name,
				u.photo,
				(SELECT count(likeID) FROM likes l WHERE l.userID=".$public_id." AND s.postID=l.itemID) AS likecount
				  FROM spotlights s INNER JOIN users u ON s.userid=u.userID  WHERE s.userid =".$public_id." AND s.spotlight_type='News / Blog' AND s.status=1  ORDER BY s.created_at DESC limit ".$config["per_page"]." OFFSET ".$page)->result_array();
				  
				  
				  
				 
			//end of job data
			
			
			
			
			
			$data['page_type']='user_profile';
			$data['View'] = "enduser/profile_news";
			
			
			
			
			
			$data['page_content'] = $this->load->view($data['View'], $data, true);
			$this->load->view('enduser/layouts/profile', $data);
		}else{
			redirect('login');
		}
   }
	
	public function media(){
	   $public_id = $this->uri->segment(3);
    	
		if($public_id>0){
			$data =$this->profile_data($public_id);
			$totalcount = $data['total_posts_media'];
			$config = array();
			$config["base_url"] = base_url() . "/publicprofile/media/".$public_id ;
			$config["total_rows"] = $totalcount;
			$config["per_page"] = 6;
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

			$this->pagination->initialize($config);

			$page = ($this->uri->segment(4))? $this->uri->segment(4) : 0;

			$data["links"] = $this->pagination->create_links();
            
			$data['spotlight_all'] = $this->db->query("SELECT s.*, 
				u.first_name,
				u.last_name,
				u.photo,
				(SELECT count(likeID) FROM likes l WHERE l.userID=".$public_id." AND s.postID=l.itemID) AS likecount
				  FROM spotlights s INNER JOIN users u ON s.userid=u.userID  WHERE s.userid =".$public_id." AND s.spotlight_type='Media/Podcast' AND s.status=1  ORDER BY s.created_at DESC limit ".$config["per_page"]." OFFSET ".$page)->result_array();
				  
				  
				  
				 
			//end of job data
			
			
			
			
			
			$data['page_type']='user_profile';
			$data['View'] = "enduser/profile_news";
			
			
			
			
			
			$data['page_content'] = $this->load->view($data['View'], $data, true);
			$this->load->view('enduser/layouts/profile', $data);
		}else{
			redirect('login');
		}
   }
	
	   public function jobs(){
	   $public_id = $this->uri->segment(3);
    	
		if($public_id>0){
			$data =$this->profile_data($public_id);
			$totalcount = $data['total_posts_jobs'];
			$config = array();
			$config["base_url"] = base_url() . "/publicprofile/jobs/".$public_id ;
			$config["total_rows"] = $totalcount;
			$config["per_page"] = 6;
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

			$this->pagination->initialize($config);

			$page = ($this->uri->segment(4))? $this->uri->segment(4) : 0;

			$data["links"] = $this->pagination->create_links();
            
			$data['spotlight_all'] = $this->db->query("SELECT s.*, 
				u.first_name,
				u.last_name,
				u.photo,
				(SELECT count(likeID) FROM likes l WHERE l.userID=".$public_id." AND s.postID=l.itemID) AS likecount
				  FROM spotlights s INNER JOIN users u ON s.userid=u.userID  WHERE s.userid =".$public_id." AND s.spotlight_type='Job Posting' AND s.status=1  ORDER BY s.created_at DESC limit ".$config["per_page"]." OFFSET ".$page)->result_array();
				  
				  
				  
				 
			//end of job data
			
			
			
			
			
			$data['page_type']='user_profile';
			$data['View'] = "enduser/profile_jobs";
			
			
			
			
			
			$data['page_content'] = $this->load->view($data['View'], $data, true);
			$this->load->view('enduser/layouts/profile', $data);
		}else{
			redirect('login');
		}
   }
   
   
   
      public function events(){
	   $public_id = $this->uri->segment(3);
    	
		if($public_id>0){
			$data =$this->profile_data($public_id);
			$totalcount = $data['total_posts_events'];  
           //if(!$url_sigment) $url_sigment='all'.$s_qstring;
			$config = array();
			$config["base_url"] = base_url() . "/publicprofile/events/".$public_id ;
			$config["total_rows"] = $totalcount;
			$config["per_page"] = 6;
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

			$this->pagination->initialize($config);

			$page = ($this->uri->segment(4))? $this->uri->segment(4) : 0;

			$data["links"] = $this->pagination->create_links();
            
			$data['spotlight_all'] = $this->db->query("SELECT s.*, 
				u.first_name,
				u.last_name,
				u.photo,
				(SELECT count(likeID) FROM likes l WHERE l.userID=".$public_id." AND s.postID=l.itemID) AS likecount
				  FROM spotlights s INNER JOIN users u ON s.userid=u.userID  WHERE s.userid =".$public_id." AND s.spotlight_type='Events' AND s.status=1 ORDER BY s.created_at DESC limit ".$config["per_page"]." OFFSET ".$page)->result_array();
				  
				  
				  
				 
			//end of job data
			
			
			
			
			
			$data['page_type']='user_profile';
			$data['View'] = "enduser/profile_events";
			
			
			
			
			
			$data['page_content'] = $this->load->view($data['View'], $data, true);
			$this->load->view('enduser/layouts/profile', $data);
		}else{
			redirect('login');
		}
   }
   
      public function promotion(){
	   $public_id = $this->uri->segment(3);
    	
		if($public_id>0){
			$data =$this->profile_data($public_id);
			$totalcount = $data['total_posts_promotion'];  
           //if(!$url_sigment) $url_sigment='all'.$s_qstring;
			$config = array();
			$config["base_url"] = base_url() . "/publicprofile/promotion/".$public_id ;
			$config["total_rows"] = $totalcount;
			$config["per_page"] = 6;
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

			$this->pagination->initialize($config);

			$page = ($this->uri->segment(4))? $this->uri->segment(4) : 0;

			$data["links"] = $this->pagination->create_links();
            
			$data['spotlight_all'] = $this->db->query("SELECT s.*, 
				u.first_name,
				u.last_name,
				u.photo,
				(SELECT count(likeID) FROM likes l WHERE l.userID=".$public_id." AND s.postID=l.itemID) AS likecount
				  FROM spotlights s INNER JOIN users u ON s.userid=u.userID  WHERE s.userid =".$public_id." AND s.spotlight_type='Spotit Spotlight' AND s.status=1   ORDER BY s.created_at DESC limit ".$config["per_page"]." OFFSET ".$page)->result_array();
				  
				  
				  
				 
			//end of job data
			
			
			
			
			
			$data['page_type']='user_profile';
			$data['View'] = "enduser/profile_events";
			
			
			
			
			
			$data['page_content'] = $this->load->view($data['View'], $data, true);
			
			$this->load->view('enduser/layouts/profile', $data);
		}else{
			redirect('login');
		}
   }
   

}



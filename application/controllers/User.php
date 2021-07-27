<?php defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller
{
	public $settings = array();
	
	function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model(array('User_model', 'Actions_model'));
		
		/* CACHE CONTROL*/
		$this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
		$this->output->set_header('Pragma: no-cache');
		$this->output->set_header("Expires: Mon, 26 Jul 2010 05:00:00 GMT");
		
		//$this->settings = globalSettings();
		
		if(!$this->session->userdata('online'))
		{
			$ip		= getenv('remote_addr');
			$this->session->set_userdata('online', TRUE);
			//finsertVisitor();
		}
	}
	function notification_html(){
	$user_notification = user_notification();
	  if(isset($user_notification) && count($user_notification)> 0):
        echo '<div class="indicator"><div class="circle"></div></div>';
      endif;
}
	function notification_html_msg(){
	$user_msg = user_msg();
	  if(isset($user_msg) && count($user_msg)> 0):
        echo '<div class="indicator"><div class="circle"></div></div>';
      endif;
}
function notification_body(){
 
	  if($user_notification = user_notification()){
		 echo '<div class="dropdown-header d-flex align-items-center justify-content-between">
			<p class="mb-0 font-weight-medium">'.user_notification(1).' New Notifications</p>
			<a href="'.base_url('user/clear_notification').'" id="clear_notification" class="text-muted">Clear all</a>
		</div>';
		}
      echo '<div class="dropdown-body">';
	   if($user_notification = user_notification()){
	   foreach($user_notification as $data){
		echo '<a href="'.$data->targetURL.'" class="dropdown-item">
				<div class="icon">
					<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-bell"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path><path d="M13.73 21a2 2 0 0 1-3.46 0"></path></svg>
				</div>
			<div class="content">
				<p>'.$data->description.'</p>
				<p class="sub-text text-muted">'.timeAgo($data->timestamp).'</p>
			</div>
		</a>
		';
	  }
	  }
	  echo '<div class="dropdown-footer d-flex align-items-center justify-content-center">
                                    <a href="'.base_url().'dashboard/notifications">View all</a>
                                </div></div>';
    
  }
  
  
function notification_body_msg(){
   if($user_msg = user_msg()){
	 
		 echo '<div class="dropdown-header d-flex align-items-center justify-content-between">
			<p class="mb-0 font-weight-medium">'.user_msg(1).' New Notifications</p>
			<a href="'.base_url('user/clear_notification_mgs').'" id="clear_notification_msg" class="text-muted">Clear all</a>
		</div>';
   }
      echo '<div class="dropdown-body">';
	  if($user_msg = user_msg()){
	   foreach($user_msg as $data){
		$user_data = $this->db->get_where('users',array('userID'=>$data->by_user))->row();
		echo '<a href="'.$data->target_url.'" class="dropdown-item">
                                    <div class="figure">
                                        <img src="'.base_url('uploads/profile_img/'.$user_data->photo).'" alt="userr">
                                    </div>
                                    <div class="content">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <p>'.$user_data->first_name.' '.$user_data->last_name.'</p>
                                            <p class="sub-text text-muted">'.timeAgo($data->date_time).'</p>
                                        </div>	
                                        <p class="sub-text text-muted">New message</p>
                                    </div>
                                </a>
		';
	  }
	   }
	  echo '<div class="dropdown-footer d-flex align-items-center justify-content-center">
                                    <a href="'.base_url('dashboard/messages').'">View all</a>
                                </div></div>';
   
  }
  
  
  
  
	public function _remap($method = null)
	{
		if(method_exists($this, $method))
		{
			call_user_func(array($this, $method));
			return false;
		}
		else
		{
			$this->index($method);
		}
	}
	
	function index()
	{
		$slug		= $this->uri->segment(1);
		$type		= $this->uri->segment(2);
		$limit		= $this->uri->segment(3);
		$offset		= $this->uri->segment(4);
		
		if($this->User_model->getUser($slug))
		{
			if($type == 'followers')
			{
				$data['profile']	= $this->User_model->getUser($slug);
				$data['followers']	= $this->User_model->getUserFollowers($slug, $limit, $offset);
				$data['meta']		= array(
					'title' 		=> $this->User_model->getUserTitle($slug),
					'descriptions'	=> $this->User_model->getUserExcerpt($slug),
					'keywords'		=> $this->User_model->getUserTags($slug),
					'image'			=> guessImage('users', $slug),
					'author'		=> $this->settings['siteTitle']
				);
				if($this->input->is_ajax_request())
				{
					$this->output->set_content_type('application/json');
					$this->output->set_output(
						json_encode(
							array(
								'meta'		=> $data['meta'],
								'html'		=> $this->load->view('followers', $data, true)
							)
						)
					);
				}
				else
				{
					$this->template->build('followers', $data);
				}
			}
			elseif($type == 'following')
			{
				$data['profile']	= $this->User_model->getUser($slug);
				$data['following']	= $this->User_model->getUserFollowing($slug, $limit, $offset);
				$data['meta']		= array(
					'title' 		=> $this->User_model->getUserTitle($slug),
					'descriptions'	=> $this->User_model->getUserExcerpt($slug),
					'keywords'		=> $this->User_model->getUserTags($slug),
					'image'			=> guessImage('users', $slug),
					'author'		=> $this->settings['siteTitle']
				);
				if($this->input->is_ajax_request())
				{
					$this->output->set_content_type('application/json');
					$this->output->set_output(
						json_encode(
							array(
								'meta'		=> $data['meta'],
								'html'		=> $this->load->view('following', $data, true)
							)
						)
					);
				}
				else
				{
					$this->template->build('following', $data);
				}
			}
			elseif($type == 'friends')
			{
				$data['profile']	= $this->User_model->getUser($slug);
				$data['friends']	= $this->User_model->getUserFriends($slug, $limit, $offset);
				$data['meta']		= array(
					'title' 		=> $this->User_model->getUserTitle($slug),
					'descriptions'	=> $this->User_model->getUserExcerpt($slug),
					'keywords'		=> $this->User_model->getUserTags($slug),
					'image'			=> guessImage('users', $slug),
					'author'		=> $this->settings['siteTitle']
				);
				if($this->input->is_ajax_request())
				{
					$this->output->set_content_type('application/json');
					$this->output->set_output(
						json_encode(
							array(
								'meta'		=> $data['meta'],
								'html'		=> $this->load->view('friends', $data, true)
							)
						)
					);
				}
				else
				{
					$this->template->build('friends', $data);
				}
			}
			else
			{
				$this->load->helper('timeline');
				$data['profile']	= $this->User_model->getUser($slug);
				$data['meta']		= array(
					'title' 		=> $this->User_model->getUserTitle($slug),
					'descriptions'	=> $this->User_model->getUserExcerpt($slug),
					'keywords'		=> $this->User_model->getUserTags($slug),
					'image'			=> guessImage('users', $slug),
					'author'		=> $this->settings['siteTitle']
				);
				if($this->input->is_ajax_request())
				{
					$this->output->set_content_type('application/json');
					$this->output->set_output(
						json_encode(
							array(
								'meta'		=> $data['meta'],
								'html'		=> $this->load->view('timeline', $data, true)
							)
						)
					);
				}
				else
				{
					$this->template->build('timeline', $data);
				}
			}
		}
		else
		{
			$data['meta']		= array(
				'title' 		=> 'welcome_back',
				'descriptions'	=> 'whatever_you_writing_for_is_a_reportations',
				'keywords'		=> 'post, dwitri, blogs, article, social, blogging',
				'image'			=> base_url('uploads/logo.png'),
				'author'		=> $this->settings['siteTitle']
			);
			if($this->input->is_ajax_request())
			{
				$this->output->set_content_type('application/json');
				$this->output->set_output(
					json_encode(
						array(
							'meta'		=> $data['meta'],
							'html'		=> $this->load->view('home', $data, true)
						)
					)
				);
			}
			else
			{
				$this->template->build('home', $data);
			}
		}
	}
	
	function dashboard()
	{
		if(!$this->session->userdata('loggedIn')) return error(403);
		$data['meta']			= array(
			'title' 			=> 'dashboard',
			'descriptions'		=> 'whatever_you_writing_for_is_a_reportations',
			'keywords'			=> 'post, dwitri, blogs, article, social, blogging',
			'image'				=> guessImage('users'),
			'author'			=> $this->settings['siteTitle']
		);
        $data['visitors']		= $this->stats('visitors');
        $data['posts']			= $this->stats('posts');
        $data['snapshots']		= $this->stats('snapshots');
        $data['openletters']	= $this->stats('openletters');
		if($this->input->is_ajax_request())
		{
			$this->output->set_content_type('application/json');
			$this->output->set_output(
				json_encode(
					array(
						'meta'		=> $data['meta'],
						'html'		=> $this->load->view('dashboard', $data, true)
					)
				)
			);
		}
		else
		{
			$this->template->set_partial('navigation', 'dashboard_navigation');
			$this->template->build('dashboard', $data);
		}
	}
	
	function updates()
	{
		if(!$this->input->is_ajax_request()) return error(404);
		
		if(!$this->session->userdata('loggedIn'))
		{
			echo json_encode(array('status' => 403));
		}
		else
		{
			$this->form_validation->set_rules('content', 'update_content', 'trim|required|xss_clean');
			$this->form_validation->set_rules('visibility', 'visibility', 'trim|required|numeric|xss_clean');
			
			if($this->form_validation->run() == FALSE)
			{
				echo json_encode(array('status' => 204, 'messages' => array(validation_errors('<span><i class="fa fa-ban"></i> &nbsp; ', '</span><br />'))));
			}
			else 
			{
				$content 	= $this->input->post('content');
				$visibility	= $this->input->post('visibility');
				$exec		= $this->Actions_model->statusUpdate();
				if($exec)
				{
					$updateID = $exec;
					echo json_encode(array('status' => 200, 'html' => $this->updates_markup($updateID, $content, $visibility)));
				}
				else
				{
					echo json_encode(array('status' => 500, 'messages' => 'unable_to_update_your_status'));
				}
			}
		}
	}
	function clear_notification(){
		if($user_id = $this->session->userdata('user_id')){
			$this->db->update('notifications', array('status'=>1), array('notify_to'=>$user_id));
			 $path = $this->session->userdata('path');
			redirect($path);
			
		}
	}
	function clear_notification_mgs(){
		if($user_id = $this->session->userdata('user_id')){
			$this->db->delete('msg_notifiction', array('notify_to'=>$user_id));
           $path = $this->session->userdata('path');
			redirect($path);
		}
	}
	function comment()
	{
		$this->load->library('form_validation');
		
		if(!$this->session->userdata('user_id'))
		{
			echo json_encode(array('status' => 403));
		}
		else
		{
				$this->form_validation->set_rules('comments', $this->input->post('comments'), 'trim|required',
				array(
				 'required'     => 'Comemnt is required'
				)
			);
			if($this->form_validation->run()) {
				$current_url  	= $this->input->post('current_url');
				$comments  	= $this->input->post('comments');
				$user_id = $this->session->userdata('user_id');
				$data = array(
					'userID' => $user_id ,
					'comments' => $comments,
					'timestamp' => date('Y-m-d H:i:s'),
					'itemID' =>$this->uri->segment(4)
				);
				$this->db->insert('comments',$data);
				$comment_id = $this->db->insert_id();
				$user_info = $this->db->get_where('users',array('userID'=>$user_id))->row();
				$spotlights_info = $this->db->get_where('spotlights', array('postID'=>$this->uri->segment(4)))->row();
				if($spotlights_info->userid != $user_id):
					$text = $user_info->first_name.' '.$user_info->last_name.' comment on your  Spotlight';
					$this->db->insert('notifications', array('type'=>'comment','type_id'=>$comment_id,'description'=>$text,
					'targetURL'=>base_url('detail/'.$spotlights_info->postSlug.'#comment_'.$comment_id),'notify_to'=>$spotlights_info->userid,'timestamp'=>date('Y-m-d H:i:s')));
				endif;
				//echo 'dddddddd';
				redirect($current_url );
				
			}
		}
			
	}
	
	
	function block_user(){
		//print_r($_POST['id']);
	    	$user_id = $this->session->userdata('user_id');
	    	$status= $this->db->get_where('users', array('userID'=>$_POST['id']))->row()->status;
		if(!$user_id){
			echo json_encode(array('status' => 'login'));
		}else{
		    if($status ==1){
		        $this->db->where('userID',  $_POST['id']);
	        $this->db->update('users',array('status'=>2));
	        echo json_encode(array('status' => '2'));
		       
		    }else{
		          $this->db->where('userID',  $_POST['id']);
	        $this->db->update('users',array('status'=>1));
	        echo json_encode(array('status' => '1'));
		    
		    }
		    
		}
	
	}
	function like_count(){
		$user_id = $this->session->userdata('user_id');
		if(!$user_id){
			echo json_encode(array('status' => 'login'));
		}else{
		$likes_data= $this->db->where(array('itemID'=> $_POST['id'],'userID'=>$user_id))->from('likes')->get()->row();
		//print_r($likes_data);die;
		$post_data = $this->db->where('postID', $_POST['id'])->from('spotlights')->get()->row();
		
		if($post_data->likes)$like = $post_data->likes;else $like=0;
		/*
		if($post_data->userid == $user_id){
			echo json_encode(array('status' => 'error', 'count' =>'can not like own post'));
		}else*/
		if(isset($likes_data->userID) && count($likes_data->userID)>0){
			$this->db->delete('likes',array('itemID'=>$_POST['id'],'userID'=>$user_id));
			$spotlights_info = $this->db->get_where('spotlights', array('postID'=>$_POST['id']))->row();
			$this->db->update('spotlights',array('likes'=>$like-1), array('postID'=>$_POST['id']));
			$this->db->delete('notifications',array('type_id'=>$_POST['id'],'notify_to'=>$spotlights_info->userid));
			
			
			echo json_encode(array('status' => 'unlike', 'count' =>$like-1));
			die;
		}else{
			
			$this->db->insert('likes',array('userID'=>$user_id,'itemID'=>$_POST['id'],'like'=>1));
			$this->db->update('spotlights',array('likes'=>$like+1), array('postID'=>$_POST['id']));
			
			$user_info = $this->db->get_where('users',array('userID'=>$user_id))->row();
			$spotlights_info = $this->db->get_where('spotlights', array('postID'=>$_POST['id']))->row();
				if($spotlights_info->userid != $user_id):
					$text = $user_info->first_name.' '.$user_info->last_name.' like on your  Spotlight';
					$this->db->insert('notifications', array('type'=>'like','type_id'=>$_POST['id'],'description'=>$text,
					'targetURL'=>base_url('detail/'.$spotlights_info->postSlug),'notify_to'=>$spotlights_info->userid,'timestamp'=>date('Y-m-d H:i:s')));
				endif;
		
			
			echo json_encode(array('status' => 'like', 'count' => $like+1));
			die;
		}
			
		}
		//print_r($likes);
		


	}
	
	function repost()
	{
		if(!$this->input->is_ajax_request()) return error(404);
		
		if(!$this->session->userdata('loggedIn'))
		{
			echo json_encode(array('status' => 403));
		}
		else
		{
			$type 	= $this->uri->segment(3);
			$postID = $this->uri->segment(4);
			
			$this->form_validation->set_rules('messages', 'messages', 'trim|xss_clean');
			
			if($this->form_validation->run() == FALSE)
			{
				if($type == 'updates')
				{
					$data['type']	= 'update_repost';
				}
				elseif($type == 'posts')
				{
					$data['type']	= 'post_repost';
				}
				elseif($type == 'snapshots')
				{
					$data['type']	= 'snapshot_repost';
				}
				elseif($type == 'openletters')
				{
					$data['type']	= 'openletter_repost';
				}
				elseif($type == 'tv')
				{
					$data['type']	= 'channel_repost';
				}
				else
				{
					$data['type']	= null;
				}
				$data['modal']		= arrayPostByID($type, $postID);
				$this->load->view('modal', $data);
			}
			else
			{
				if($this->Actions_model->rePost($type, $postID, $this->input->post('messages')))
				{
					echo json_encode(array('status' => 200, 'repost' => 1, 'count' => countReposts($type, $postID), 'messages' => 'repost_success'));
				}
				else
				{
					echo json_encode(array('status' => 500, 'messages' => 'error_to_repost'));
				}
			}
		}
	}
	function remove_comment()
	{
		$url = $this->uri->segment_array();
		//print_r($url);
		$id		= $this->uri->segment(3);
		$this->db->delete('comments',array('commentID'=>$id));
		$this->db->delete('notifications',array('type_id'=>$id));
		echo json_encode(array('status' => 200, 'messages' =>'_was_successfully_removed'));
		die();
	}
	function remove()
	{
		if(!$this->input->is_ajax_request()) return error(404);
		
		if(!$this->session->userdata('user_id'))
		{
			echo json_encode(array('status' => 403));
		}
		else
		{
			$type		= $this->uri->segment(3);
			$itemID		= $this->uri->segment(4);
			$suffix		= $this->uri->segment(5);
			$postType	= substr($suffix, 0, strrpos($suffix, '-'));
			$postID		= substr($suffix, strrpos($suffix, '-') + 1);
			
			if($this->Actions_model->removeAny($type, $itemID, $suffix))
			{
				if($suffix)
				{
					echo json_encode(array('status' => 200, 'messages' => $type . '_was_successfully_removed'));
				}
				else
				{
					echo json_encode(array('status' => 200, 'messages' => $type . '_was_successfully_removed'));
				}
			}
			else
			{
				if($suffix)
				{
					echo json_encode(array('status' => 500, 'messages' => 'unable_to_delete_this_' . $type));
				}
				else
				{
					echo json_encode(array('status' => 500, 'messages' => 'unable_to_delete_this_' . $type));
				}
			}
		}
	}
	
	function report()
	{
		if(!$this->input->is_ajax_request()) return error(404);
		
		if(!$this->session->userdata('loggedIn'))
		{
			echo json_encode(array('status' => 403));
		}
		else
		{
			$type		= $this->uri->segment(3);
			$itemID		= $this->uri->segment(4);
			
			if($this->Actions_model->reportAny($type, $itemID))
			{
				echo json_encode(array('status' => 200, 'messages' => $type . '_was_successfully_reported', 'count' => countComments($type, $itemID)));
			}
			else
			{
				echo json_encode(array('status' => 500, 'messages' => 'unable_to_report_this_' . $type, 'count' => countComments($type, $itemID)));
			}
		}
	}
	
	function follow()
	{
		
		if(!$this->session->userdata('user_id'))
		{
			echo json_encode(array('status' => 'login'));
		}
		else
		{
			$follow_user_id = $_POST['id'];
			$user_id = $this->session->userdata('user_id');
			$follow_data = $this->db->where(array('is_following'=>$follow_user_id,'userID'=>$user_id))->from('followers')->get()->row();
			$time =  date('Y-m-d H:i:s');
			if(count($follow_data)>0)
			{
				
				$this->db->delete('followers',array('is_following'=>$follow_user_id,'userID'=>$user_id));
				echo json_encode(array('status' => 'unfollowed'));
			}
			else
			{
				
				$this->db->insert('followers',array('timestamp'=>$time,'is_following'=>$follow_user_id,'userID'=>$user_id));
				
				
				$user_info = $this->db->get_where('users',array('userID'=>$user_id))->row();
				$text = $user_info->first_name.' '.$user_info->last_name.' started following you';
				$this->db->insert('notifications', array('type'=>'fallow','description'=>$text,
				'targetURL'=>base_url('publicprofile/'.$user_id),'notify_to'=>$follow_user_id,'timestamp'=>date('Y-m-d H:i:s')));
				
				
				
				echo json_encode(array('status' => 'followed'));
				
			}
			
		}
	}
	
	
	function recommend()
	{
		
		if(!$this->session->userdata('user_id'))
		{
			echo json_encode(array('status' => 'login'));
		}
		else
		{
			$recommend_user_id = $_POST['id'];
			$user_id = $this->session->userdata('user_id');
			$follow_data = $this->db->where(array('review_by'=>$recommend_user_id,'user_id'=>$user_id,'type'=>'recommend'))->from('reviews')->get()->row();
			$time =  date('Y-m-d H:i:s');
			if(count($follow_data)>0)
			{
				
				$this->db->delete('reviews',array('review_by'=>$recommend_user_id,'user_id'=>$user_id,'type'=>'recommend'));
				echo json_encode(array('status' => 'not_recommend'));
			}
			else
			{
				
				$this->db->insert('reviews',array('date_time'=>$time,'review_by'=>$recommend_user_id,'user_id'=>$user_id,'type'=>'recommend'));
				
				
				$user_info = $this->db->get_where('users',array('userID'=>$user_id))->row();
				$text = $user_info->first_name.' '.$user_info->last_name.' Recommended your business';
				$this->db->insert('notifications', array('type'=>'recommend','description'=>$text,
				'targetURL'=>base_url('publicprofile/'.$user_id),'notify_to'=>$recommend_user_id,'timestamp'=>date('Y-m-d H:i:s')));
				echo json_encode(array('status' => 'recommended'));
				
			}
			
		}
	}
	

	
	function edit_profile()
	{
		if(!$this->session->userdata('loggedIn')) return error(403, ($this->input->is_ajax_request() ? 'ajax' : null));
		
		if($this->input->post('hash') && sha1($this->session->userdata('userName')) == $this->input->post('hash'))
		{
			$this->form_validation->set_rules('full_name', 'full_name', 'trim|required|xss_clean');
			$this->form_validation->set_rules('gender', 'gender', 'trim|required|xss_clean');
			$this->form_validation->set_rules('age', 'age', 'trim|required|xss_clean|numeric');
			$this->form_validation->set_rules('mobile', 'mobile', 'trim|required|xss_clean|numeric');
			$this->form_validation->set_rules('address', 'address', 'trim|required|xss_clean');
			$this->form_validation->set_rules('language', 'language', 'trim|xss_clean');
			$this->form_validation->set_rules('bio', 'address', 'trim|xss_clean');
			$this->form_validation->set_rules('email', 'email_address', 'trim|required|valid_email|is_unique[users.email.userID.'.$this->session->userdata('userID').']');
			
			if($this->session->userdata('newRegister'))
			{
				$this->form_validation->set_rules('username', 'username', 'trim|required|alpha_dash|is_unique[users.userName.userID.'.$this->session->userdata('userID').']');
			}
			
			if(null != $this->input->post('password'))
			{
				$this->form_validation->set_rules('password', 'password', 'trim|required|min_length[4]|max_length[32]');
				$this->form_validation->set_rules('con_password', 'confirmation_password','trim|required|matches[password]');
			}
			
			if($this->form_validation->run() == FALSE)
			{
				echo json_encode(array('status' => 204, 'messages' => array(validation_errors('<span><i class="fa fa-ban"></i> &nbsp; ', '</span><br />'))));
			}
			else
			{
				$fields = array(
					'full_name'			=> $this->input->post('full_name'),
					'gender'			=> $this->input->post('gender'),
					'age'				=> $this->input->post('age'),
					'mobile'			=> $this->input->post('mobile'),
					'address'			=> $this->input->post('address'),
					'email'				=> $this->input->post('email'),
					'language'			=> $this->input->post('language'),
					'bio'				=> $this->input->post('bio')
				);
				if($this->session->userdata('newRegister'))
				{
					$fields['userName']	= strtolower(str_replace(' ', '_', $this->input->post('username')));
				}
				if(null != $this->input->post('con_password'))
				{
					$fields['password']	= sha1($this->input->post('con_password') . SALT);
				}
		
				if($this->Actions_model->updateProfile($fields))
				{
					$this->session->set_flashdata('success', 'profile_was_updated_successfully');
					echo json_encode(array("status" => 200, "redirect" => current_url()));
				}
				else
				{
					echo json_encode(array('status' => 500, 'messages' => 'unable_to_update_your_profile'));
				}
			}
		}
		else
		{
			$data['profile']	= $this->User_model->getOwnProfile();
			$data['meta']		= array(
				'title' 		=> 'edit_profile',
				'descriptions'	=> 'whatever_you_writing_for_is_a_reportations',
				'keywords'		=> 'post, dwitri, blogs, article, social, blogging',
				'image'			=> guessImage('users'),
				'author'		=> $this->settings['siteTitle']
			);
			if($this->input->is_ajax_request())
			{
				$this->output->set_content_type('application/json');
				$this->output->set_output(
					json_encode(
						array(
							'meta'		=> $data['meta'],
							'html'		=> $this->load->view('edit_profile', $data, true)
						)
					)
				);
			}
			else
			{
				$this->template->set_partial('navigation', 'dashboard_navigation');
				$this->template->build('edit_profile', $data);
			}
		}
	}
	
	function connect()
 	{
		if(!$this->session->userdata('loggedIn')) redirect();
		
		$user = $this->facebook->getUser();
		if($user)
		{
			$this->Actions_model->facebookConnect($user);
			$this->session->set_flashdata('success', 'account_connected_to_facebook');
			redirect('user/edit_profile');
		}
		else
		{
			$redir = $this->facebook->getLoginUrl(array(
                'redirect_uri' => base_url('user/connect'),
				'scope' => array('email', 'user_birthday', 'user_location', 'user_work_history', 'user_about_me', 'user_hometown')
            ));
			redirect($redir);
		}
	}
	
	function login()
 	{
		if($this->session->userdata('loggedIn')) redirect($this->session->userdata('userName'));
		if($this->input->post('hash'))
		{
			$this->form_validation->set_rules('username', 'username_or_email','trim|required|xss_clean');
			$this->form_validation->set_rules('password', 'password','trim|required|xss_clean');
			$this->form_validation->set_rules('hash', 'hash','trim|required|xss_clean');
			
			if($this->form_validation->run() == FALSE)
			{
				echo json_encode(array('status' => 204, 'messages' => array(validation_errors('<span><i class="fa fa-ban"></i> &nbsp; ', '</span><br />'))));
			}
			else
			{
				$username		= $this->input->post('username');
				$password		= sha1($this->input->post('password') . SALT);
				if($this->Actions_model->loginCheck($username, $password))
				{
					$this->session->set_flashdata('success', 'welcome_back' . ', ' . $this->session->userdata('full_name'));
					echo json_encode(array("status" => 200, "redirect" => (isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : $_SERVER['SERVER_NAME'])));
				}
				else
				{
					echo json_encode(array('status' => 406, 'messages' => 'username_or_password_did_not_match'));
				}
			}
		}
		else
		{
			$user = $this->facebook->getUser();
			if($user)
			{
				if($this->Actions_model->facebookLogin($user))
				{
					redirect($this->session->userdata('userName'));
				}
			}
			$data['meta']		= array(
				'title' 		=> 'login',
				'descriptions'	=> 'whatever_you_writing_for_is_a_reportations',
				'keywords'		=> 'post, dwitri, blogs, article, social, blogging',
				'image'			=> guessImage('users'),
				'author'		=> $this->settings['siteTitle']
			);
			if($this->input->is_ajax_request())
			{
				$this->output->set_content_type('application/json');
				$this->output->set_output(
					json_encode(
						array(
							'meta'		=> $data['meta'],
							'html'		=> $this->load->view('login', $data, true)
						)
					)
				);
			}
			else
			{
				$this->template->build('login', $data);
			}
		}
	}
	
	function register()
 	{
		if($this->session->userdata('loggedIn')) redirect();
		
		if(null != $this->input->post('hash'))
		{
			$this->form_validation->set_rules('full_name', 'full_name', 'trim|required|xss_clean');
			$this->form_validation->set_rules('gender', 'gender', 'trim|required|xss_clean');
			$this->form_validation->set_rules('age', 'age', 'trim|required|xss_clean|numeric');
			$this->form_validation->set_rules('mobile', 'mobile', 'trim|required|xss_clean|numeric');
			$this->form_validation->set_rules('address', 'address', 'trim|required|xss_clean');
			$this->form_validation->set_rules('username', 'username', 'trim|alpha_dash|required|is_unique[users.userName]');
			$this->form_validation->set_rules('email', 'email_address', 'trim|required|valid_email|is_unique[users.email]');
			$this->form_validation->set_rules('password', 'password', 'trim|required|min_length[4]|max_length[32]');
			$this->form_validation->set_rules('con_password', 'confirmation_password','trim|required|matches[password]');
			$this->form_validation->set_rules('language', 'language', 'trim|xss_clean');
			
			if($this->form_validation->run() == FALSE)
			{
				echo json_encode(array('status' => 204, 'messages' => array(validation_errors('<span><i class="fa fa-ban"></i> &nbsp; ', '</span><br />'))));
			}
			else
			{
				$fields = array(
					'full_name'			=> $this->input->post('full_name'),
					'gender'			=> $this->input->post('gender'),
					'age'				=> $this->input->post('age'),
					'mobile'			=> $this->input->post('mobile'),
					'address'			=> $this->input->post('address'),
					'userName'			=> strtolower(str_replace(' ', '_', $this->input->post('username'))),
					'email'				=> $this->input->post('email'),
					'password'			=> sha1($this->input->post('con_password'). SALT),
					'language'			=> $this->input->post('language'),
					'register_since'	=> date('Y-m-d H:i')
				);
				$username				= $this->input->post('email');
				$password				= sha1($this->input->post('con_password'). SALT);
				if($this->Actions_model->createProfile($fields, $username, $password))
				{
					$this->session->set_flashdata('success', 'your_account_was_created');
					echo json_encode(array("status" => 200, "redirect" => base_url($fields['userName'])));
				}
				else
				{
					echo json_encode(array('status' => 500, 'messages' => 'unable_to_registering_your_account'));
				}
			}
		}
		else
		{
			$user = $this->facebook->getUser();
			if($user)
			{
				if($this->Actions_model->facebookLogin($user))
				{
					redirect($this->session->userdata('userName'));
				}
			}
			
			$data['meta']		= array(
				'title' 		=> 'register',
				'descriptions'	=> 'whatever_you_writing_for_is_a_reportations',
				'keywords'		=> 'post, dwitri, blogs, article, social, blogging',
				'image'			=> guessImage('users'),
				'author'		=> $this->settings['siteTitle']
			);
			if($this->input->is_ajax_request())
			{
				$this->output->set_content_type('application/json');
				$this->output->set_output(
					json_encode(
						array(
							'meta'		=> $data['meta'],
							'html'		=> $this->load->view('register', $data, true)
						)
					)
				);
			}
			else
			{
				$this->template->build('register', $data);
			}
		}
	}
	
	function uploads()
	{
		if(!$this->input->is_ajax_request()) return error(404);
		
		if(!$this->session->userdata('loggedIn'))
		{
			echo json_encode(array('status' => 403, 'messages' => 'please_login_to_change_photo_or_cover'));
		}
		else
		{
			$type = $_GET['type'];
			
			if($type == 'photo')
			{
				$config['upload_path'] 	= 'uploads/users';
			}
			elseif($type == 'cover')
			{
				$config['upload_path'] 	= 'uploads/users/covers';
			}
			else
			{
				return false;
			}
			$config['allowed_types'] 	= 'jpg|jpeg|png';
			$config['max_size']      	= 1024*2; // 2MB
			$config['encrypt_name']	 	= TRUE;
			
			$this->upload->initialize($config); 
			
			if(!$this->upload->do_upload())
			{
				echo json_encode(array('status' => 1024, 'messages' => array(str_replace(array('<p>', '</p>'),'', $this->upload->display_errors()))));
			} 
			else
			{
				if($type == 'photo')
				{
					$this->upload_data['userfile'] = $this->upload->data();

					//upload successful generate a thumbnail
					$config['image_library'] 	= 'gd2';
					$config['source_image'] 	= 'uploads/users/' . $this->upload_data['userfile']['file_name'];
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
						if($type == 'photo' && file_exists('uploads/users/' . $row['photo']))
						{
							unlink('uploads/users/' . $row['photo']);
							if(file_exists('uploads/users/thumbs/' . $row['photo']))
							{
								unlink('uploads/users/thumbs/' . $row['photo']);
							}
						}
						elseif($type == 'cover' && file_exists('uploads/users/covers/' . $row['cover']))
						{
							unlink('uploads/users/covers/' . $row['cover']);
						}
					}
				}
				
				if($this->Actions_model->updatePhoto($type, $this->upload_data['userfile']['file_name']))
				{
					echo json_encode(array('status' => 200, 'messages' => $type . '_changed_successfully'));
				}
				else
				{
					echo json_encode(array('status' => 500, 'messages' => 'unable_to_change_' . $type));
				}
			}
		}
	}
	
	function logout()
	{
        $this->facebook->destroySession();
		
		foreach($this->session->all_userdata() as $key => $val)
		{
		   if($key != 'language') $this->session->unset_userdata($key);
		}
		//$this->session->sess_destroy();
		if($this->input->is_ajax_request())
		{
			$this->output->set_content_type('application/json');
			$this->output->set_output(
				json_encode(
					array(
						'redirect'	=> TRUE,
						'url'		=> base_url()
					)
				)
			);
		}
		else
		{
			redirect();
		}
	}

	function updates_markup($updateID = 0, $content = '', $visibility = 0)
	{
		return '
			<div id="update' . $updateID . '">
				<div class="image-placeholder">
					<div class="col-sm-12">
						<div class="row">
							<div class="col-xs-2 hidden-xs">
								<img src="' . base_url('uploads/users/thumbs/' . imageCheck('users', getUserPhoto($this->session->userdata('userID')), 1)) . '" style="height:40px;width:40px" class="img-rounded img-bordered" alt="" />
							</div>
							<div class="col-xs-10">
								<b>
									<a href="' . base_url(getUsernameByID($this->session->userdata('userID'))) . '">
										<b>' . getFullnameByID($this->session->userdata('userID')) . '</b>
									</a>
								</b>
								<a href="javascript:void(0)" onclick="confirm_modal(\'' . base_url('user/remove/updates/' . $updateID) . '\', \'update' . $updateID . '\', \'update' . $updateID . '\')" class="pull-right text-danger"><i class="fa fa-times"></i></a>
								<br />
								<small class="text-muted">@' . getUsernameByID($this->session->userdata('userID')) . ' - ' . time_since(time()) . '</small>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-12 nomargin">
								<p>
									' . special_parse($content) . '
								</p>
								<div class="btn-group btn-group-justified">
									<a href="#" class="btn btn-default ajax"><i class="fa fa-comments"></i> <span class="comments-count-updates' . $updateID . '">' . countComments('updates', $updateID) . '</span> ' . 'comments' . '</a>
									<a class="like like-updates' . $updateID . ' btn btn-default' . (is_userLike('updates', $updateID) ? ' active' : '') . '" href="' . base_url('user/like/updates/' . $updateID) . '" data-id="updates' . $updateID . '"><i class="like-icon fa fa-thumbs-up"></i> <span class="likes-count">' . countLikes('updates', $updateID) . '</span> ' . 'likes' . '</a>
									<a href="' . base_url('user/repost/updates/' . $updateID) . '" class="btn btn-default repost" data-id="' . $updateID . '"><i class="fa fa-retweet"></i> <span class="reposts-count' . $updateID . '">' . countReposts('updates', $updateID) . '</span> ' . 'reposts' . '</a>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-12 nomargin">
							
								' . getComments('updates', $updateID) . '
									
							</div>
						</div>
					</div>
				</div>
			</div>
		';
	}

	function comment_markup($type = null, $postID = 0, $commentID = 0, $content = '')
	{
		return '
			<div class="row comment-tree comment' . $commentID . '" style="border-bottom:1px solid #eee">
				<div class="col-xs-2 col-sm-1" style="padding-right:0">
					<img src="' . base_url('uploads/users/thumbs/' . imageCheck('users', getUserPhoto($this->session->userdata('userID')), 1)) . '" class="rounded" width="30" height="30" alt="..." />
				</div>
				<div class="col-xs-10 col-sm-11">
					<p class="comment-text relative">
						<a href="' . base_url(getUsernameByID($this->session->userdata('userID'))) . '" class="ajaxLoad hoverCard">
							<b>' . getFullnameByID($this->session->userdata('userID')) . '</b> &nbsp; 
						</a>
						<span id="rcomment' . $commentID . '">' . nl2br(special_parse($content)) . '</span>
						<br />
						<small class="comment-tools text-muted">
							<i class="fa fa-clock-o"></i>' . time_since(time()) . '
						</small>
						' . ($this->session->userdata('loggedIn') ? '
						<div class="btn-group absolute" style="right:10px;top:10px">
							' . ($this->session->userdata('userID') == $this->session->userdata('userID') ? '<a class="delete-comment btn btn-xs btn-default btn-icon-only" href="javascript:void(0)" onclick="confirm_modal(\'' . base_url('user/remove/comments/' . $commentID . '/' . $type . '-' . $postID) . '\', \'comment' . $commentID . '\', \'' . $type . $postID . '\')" data-push="tooltip" data-plcement="top" data-title="' . 'remove' . '"><i class="fa fa-times"></i></a>' : '<a class="reply-comment btn btn-xs btn-default btn-icon-only" href="javascript:void(0)" data-reply="' . $commentID . '" data-summon="' . getUsernameByID($this->session->userdata('userID')) . '" data-push="tooltip" data-plcement="top" data-title="' . 'reply' . '"><i class="fa fa-reply"></i></a><a class="delete-comment btn btn-xs btn-default btn-icon-only" href="javascript:void(0)" onclick="confirm_modal(\'' . base_url('user/report/comments/' . $postID . '_' . time_since(time())) . '\')" data-push="tooltip" data-plcement="top" data-title="' . 'report' . '"><i class="fa fa-ban"></i></a>') . '
							' : '') . '
						</div>
					</p>
				</div>
			</div>
		';
	}
	
	function stats($type = null)
	{
		for ($i = (date('d') >= 6 ? date('d') - 6 : 1); $i <= date('d'); $i++) {
			$start_date = strtotime(date('Y-m-' . sprintf('%02d', $i) . ' 00:00:00'));
			$end_date = strtotime(date('Y-m-' . sprintf('%02d', $i) . ' H:i:s'));
			$get_all_report[$i] = $this->User_model->stats($type, $start_date, $end_date);
		}
		return $get_all_report;
	}
}

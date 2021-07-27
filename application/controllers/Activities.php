<?php
// defined('BASEPATH') OR exit('No direct script access allowed');

class Activities extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->library('encryption');
		$this->load->library('email');
        $this->load->model('enduser/login_model');
		$this->load->helper("url");
    }

	public function index()
	{  
		$user_id = $this->session->userdata('user_id');
		if($user_id>0){
			$this->db->where('userID', $user_id );
		    $this->db->from('users');
			$data['userinfo'] = $this->db->get()->row();
			$data['View'] = "enduser/dashboard";
			$data['page_content'] = $this->load->view($data['View'], $data, true);
			$this->load->view('enduser/layouts/dashboard', $data);
		}else{
			redirect('login');
		}
    }
	public function preference()
	{  
		$user_id = $this->session->userdata('user_id');
		if($user_id>0){
			$this->db->where('userID', $user_id );
		    $this->db->from('users');
			$data['userinfo'] = $this->db->get()->row();
			
			$this->db->where('user_id', $user_id );
			$this->db->from('user_profile');
			$check_data = $this->db->get()->row();
		
			$data['preferences'] = $check_data->preferences;
			
			if(count($check_data)>0 && $this->input->post('submit')==1)
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
			$this->load->view('enduser/layouts/dashboard', $data);
		}else{
			redirect('login');
		}
    }

    function logout()
	{
	    $user_data = $this->session->all_userdata();
	        foreach ($user_data as $key => $value) {
	            if ($key != 'session_id' && $key != 'ip_address' && $key != 'user_agent' && $key != 'last_activity') {
	                $this->session->unset_userdata($key);
	            }
	        }
	    $this->session->sess_destroy();
	    redirect('login');
	}

	function myspotlight(){
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

	function activities(){
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
	}

	function public_spotlight(){
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
				(SELECT count(likeID) FROM likes l WHERE l.userID=".$user_id." AND s.postID=l.itemID) AS likecount
				 FROM spotlights s INNER JOIN users u ON s.userid=u.userID WHERE s.userid=u.userID AND (s.postTitle LIKE '%".$data['search_text']."%' OR s.postContent LIKE '%".$data['search_text']."%')  ORDER BY s.created_at DESC")->result_array();


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

			$spotid = $this->uri->segment(3);
			if(!empty($spotid) && $spotid>0){
				$this->db->where('postID', $spotid );
			    $this->db->from('spotlights');
				$data['spotlight'] = $this->db->get()->row();
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
					'event_date' => '',
					'event_time' => '',
					'event_location' => '',
					'postContent' => '',
					);
			}
			$this->form_validation->set_rules('wysiwyg', 'Content', 'required|trim');
			if($this->form_validation->run()) {
				if($this->input->post('submit')==1  )
				{
				    $slug = url_title($this->input->post('postTitle'), "dash", TRUE);
					$this->db->where('postSlug', $slug);
			        $this->db->from('spotlights');
					$query = $this->db->get();
					 if($query->num_rows()>0){
						 $slug=$slug.'-'.$query->num_rows();
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
						'event_date' => $this->input->post('event_date'),
						'event_time' => $this->input->post('event_time'),
						'event_location' => $this->input->post('event_location'),
						'postContent' => $this->input->post('wysiwyg')
						);	
					if(!empty($spotid)){
						
						$this->db->update('spotlights',$data, array('postID' => $spotid));
						redirect('dashboard/create_new_spotlight_step2/'.$spotid);
					}else{
						$status = array('status'=>2,'created_at' => date('Y-m-d H:i:s'));
						$this->db->insert('spotlights',array_merge($status,$data));
					$insert_id = $this->db->insert_id();
					redirect('dashboard/create_new_spotlight_step2/'.$insert_id);
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
			$data['spotlight_images'] = $this->db->query("SELECT * FROM spotlights_images WHERE spotlight_id=".$spotlightid)->result_array();
				
			$data['View'] = "enduser/create_new_spotlight_step2";
			$data['page_type']='spotlight2';
			$data['page_content'] = $this->load->view($data['View'], $data, true);
			$this->load->view('enduser/layouts/dashboard', $data);	
				
		}else{
			redirect('login');
		}	
	}
	function create_new_spotlight_step3(){
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
			if($this->input->post('submit')==1  )
			{
				$updateData = array('status' => '1');
        		$this->db->update('spotlights', $updateData, array('postID' => $spotlightid, 'userid'=>$user_id));
        		redirect('dashboard/myspotlight');
			}
			if($this->input->post('submit')==2  )
			{
				$updateData = array('status' => '2');
        		$this->db->update('spotlights', $updateData, array('postID' => $spotlightid, 'userid'=>$user_id));
        		redirect('dashboard/myspotlight');
			}	

			$data['View'] = "enduser/create_new_spotlight_step3";
			$data['page_type']='spotlight3';
			$data['page_content'] = $this->load->view($data['View'], $data, true);
			$this->load->view('enduser/layouts/dashboard', $data);	
				
		}else{
			redirect('login');
		}	
	}
	function display_image(){
		$spotlightid = $this->uri->segment(3);
		$spotlight_images = $this->db->query("SELECT * FROM spotlights_images WHERE spotlight_id=".$spotlightid)->result_array();

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
        $data = $_POST['image'];
     	$spotlightid = $this->uri->segment(3);
        list($type, $data) = explode(';', $data);
        list(, $data)      = explode(',', $data);
     	$this->db->from('spotlights');
		$this->db->where('postID', $spotlightid);
		$check_img = $this->db->get()->row();
		if($photo = $check_img->cover_photo){
			@unlink(FCPATH ."uploads/cover_photo/".$photo);
		}
        $data = base64_decode($data);
		
		if(!$check_img->cover_photo && !$data){
			echo 'Please Upload Picture'; die;
		}else{
        $imageName = time().'.png';
        file_put_contents(FCPATH .'uploads/cover_photo/'.$imageName, $data);
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
			$config['upload_path'] 	= 'uploads/covers';
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
			echo json_encode(array('status' => 1024, 'messages' => array(str_replace(array('<p>', '</p>'),'', $this->upload->display_errors()))));
		} 
		else
		{
			if($type == 'photo')
			{
				$this->upload_data['userfile'] = $this->upload->data();
	
				//upload successful generate a thumbnail
				$config['image_library'] 	= 'gd2';
				$config['source_image'] 	= 'uploads/profile_img/' . $this->upload_data['userfile']['file_name'];
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
		redirect('dashboard/myspotlight');
	}

	function myfeed(){
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
			$data['spotlight_all'] = $this->db->query("SELECT s.*, 
				u.first_name,
				u.last_name,
				u.photo,
				(SELECT count(likeID) FROM likes l WHERE l.userID=".$user_id." AND s.postID=l.itemID) AS likecount
				  FROM spotlights s INNER JOIN users u ON s.userid=u.userID  WHERE s.category REGEXP '^(".$preferences_str.")'  AND s.status=1")->result_array();
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
}
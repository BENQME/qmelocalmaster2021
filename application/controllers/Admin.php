<?php
// defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->library('encryption');
		$this->load->library('email');
		$this->load->library("pagination");
		$user_type = $this->session->userdata('user_type');
		if($user_type){
			$user_id = $this->db->get_where('users',array('level'=>1,'user_type'=>NULL,'site_id'=>site_id()))->row()->userID;
			//print_r($admin_user);
			//$user_id = $this->session->userdata('user_id');
			$this->session->set_userdata("user_id", $user_id);
		}else{
			$user_id = $this->session->userdata('user_id');
		}
		
	}
	public function index()
	
	{
		
		//echo $this->site_url();
		   //$data['site_info'] =$site_data =  $this->site_data();
		$this->form_validation->set_rules('email', 'Email Address', 'required|trim|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required|trim');
        if($this->form_validation->run()) {
            //$result = $this->login_model->can_login($this->input->post('email'), $this->input->post('password'));
			$email = $this->input->post('email');
			$password = $this->input->post('password');
			$this->db->where('email', $email);
			$this->db->where('level', 1);
			$this->db->from('users');
			$query = $this->db->get()->row();
			
			if($query) {
				//echo $this->db->last_query(); die();
				if($query->status ==2){
					$login_error ="Account has been Blocked now";
				}
				elseif($query->is_email_verified == 'no') {
					//print_r($query);
					//echo $email;
					$login_error ="please verify your Email Address<br>
					<a href='".base_url('register/resend_email?email='.$email)."'>resend email</a>";
					//redirect('login');
				}else{
				   if(md5($password) == $query->password) {
						// store session details
						$this->session->set_userdata("user_id", $query->userID);
						$this->session->set_userdata("user_level",1);
						$this->session->set_userdata("user_type", $query->user_type);
						if($query->user_type){
							$this->session->set_userdata("staff_id", $query->userID);
						}
						if(!$this->session->userdata('online'))
						{
							$ip		= getenv('remote_addr');
							$this->session->set_userdata('online', TRUE);
							insertVisitor();
						}
					  redirect('admin/dashboard');
					} else {
						$login_error ="Invalid Email or passoword";
					}
                 	
				}
            	} else {
				
				$login_error ="Invalid Email or passoword";
                //redirect('admin');
                
            }
			$this->session->set_flashdata('login_error', $login_error);
		} 
		$data['View'] = "admin/login";
		$data['page_content'] = $this->load->view($data['View'], $data, true);
		$this->load->view('admin/layouts/default', $data);
		//$this->load->view('enduser/login');
    }
	function resources(){
		$user_level =0;
		$user_id = $this->session->userdata('user_id');
		$user_level = $this->session->userdata('user_level');
		$site_id = site_id();
		if($user_id>0 && $user_level==1){
			
			$data['resources'] = $this->db->order_by('created_at','desc')->get_where('resources', array('site_id'=>$site_id))->result();
			$data['page_type']='resources';
			$data['View'] = "admin/resources";
			$data['page_content'] = $this->load->view($data['View'], $data, true);
			$this->load->view('admin/layouts/dashboard', $data);
		}else{
			redirect('admin');
		}
	}
	
	public function mbn_cms(){
		$site_id = site_id();
		$user_level =0;
		$user_id = $this->session->userdata('user_id');
		$user_level = $this->session->userdata('user_level');
		if($user_id>0 && $user_level==1 && ($site_id =14)){
			echo $site_id;
		}
	}
	
	
	public function reset_password(){
		//echo $data['site_url'];
		$data['View'] = "admin/reset_pw";
		
		$sigment = $this->uri->segment(1);
		if($this->input->post('submit')==1)
		{
			$email = $this->input->post('email');
			$this->db->where('email', $email);
		    $this->db->from('users');
			$check_data = $this->db->get()->row();
			//echo $this->db->last_query();exit;
			if(count($check_data)>0)
			{
				$config = array(
					'protocol' => 'smtp',
					'smtp_host' => email_setting('host'),
					'smtp_port' => email_setting('port'),
					'smtp_user' => email_setting('username'),
					'smtp_pass' => email_setting('password'),
					'mailtype'  => 'html'
				);
				 $this->email->initialize($config);
				   $this->email->set_newline("\r\n");
				
				$e_template = email_template('reset_password');
	            $this->email->from(email_setting('from_mail'), $e_template->subject);
	            $this->email->to($check_data->email);
	            $this->email->subject($e_template->subject);
				$body = $e_template->template;
				$body_temp = $this->db->get_where('settings',array('siteID'=>1))->row()->general_template;
				$body = str_replace('[name]',$check_data->first_name.' '.$check_data->last_name, $body);
				$body =str_replace('[site_title]',strtoupper(site_info()),$body);
				$body = str_replace('[url]',base_url()."admin/resetpass/".$check_data->verification_key, $body);
				$complete_html = str_replace('{{body}}',$body,$body_temp);
				
				$this->email->message($complete_html);
				/*
				
	            $this->email->to($check_data->email);
	           
	            $this->email->set_mailtype("html");
	            $this->email->subject('Reset Password!');
	            $email_body = "<h2><a href='".base_url()."/admin/resetpass/".$check_data->verification_key."' >Click here to reset password</a></h2>";
	            $this->email->message($email_body);*/
	            $this->email->send();
	            $login_error ="Email Sent successfully.";
	            
			}else{
				$login_error ="Invalid Email.";
			}
			$this->session->set_flashdata('login_error', $login_error);
		}
		$data['page_content'] = $this->load->view($data['View'], $data, true);
		$this->load->view('admin/layouts/default', $data);
	}
	public function resetpass(){
		
		$verifykey = $this->uri->segment(3);
		$this->db->where('verification_key', $verifykey );
	    $this->db->from('users');
		$check_data = $this->db->get()->row();
		//echo $this->db->last_query();exit;
		if(count($check_data)>0)
		{
			$this->session->set_userdata("user_id", $check_data->userID);
			$data['View'] = "admin/password_reset";
			$data['page_content'] = $this->load->view($data['View'], $data, true);
			$this->load->view('admin/layouts/default', $data);
		}
		if($this->input->post('submit')==1)
		{
			$data = array(
				'password' => md5($this->input->post('password')),
			);
			$this->db->update('users',$data, array('userID'=>$this->session->userdata('user_id')));
			redirect('admin');
		}

	}
	
	public function dashboard()
	{  

		$site_id = site_id();
		$user_id = $this->session->userdata('user_id');
		$user_level = $this->session->userdata('user_level');
		$userprofileinfo = $this->db->get_where('user_profile',array('user_id'=>$user_id))->row();
			$preferences_arr = json_decode($userprofileinfo->preferences);
			$preferences_str = implode('|', $preferences_arr);
		if($user_id>0 && $user_level ==1){
			$this->db->where('userID', $user_id );
		    $this->db->from('users');
			$data['userinfo'] = $this->db->get()->row();
			$data['topic_cover'] =  $this->db->get('spotlights_category')->num_rows();
			$data['events'] = $this->db->query("
			SELECT s.*,  
			u.level,
			r.spotlight_id,
			r.web_id 
			FROM spotlights s 
			LEFT JOIN region_spotlights r ON (r.spotlight_id=s.postID AND r.web_id=$site_id)	
			INNER JOIN users u ON s.userid=u.userID AND ((r.web_id=".$site_id." AND u.level = 3) OR (u.level != 3 AND u.site_id  =$site_id))
			WHERE  s.spotlight_type='Events'  AND s.status=1")->result();
			$data['promotions'] = $this->db->query("
			SELECT s.*,  
			u.site_id,
			u.userID,
			u.level,
			r.spotlight_id,
			r.web_id 
			FROM spotlights s 
			LEFT JOIN region_spotlights r ON (r.spotlight_id=s.postID AND r.web_id=$site_id)	
			INNER JOIN users u ON s.userid=u.userID AND ((r.web_id=".$site_id." AND u.level = 3) OR (u.level != 3 AND u.site_id  =$site_id)) 
			WHERE  s.spotlight_type='Spotit Spotlight'  AND s.status=1")->result();
			$data['jobs'] = $this->db->query("
			SELECT s.*,  
			u.level,
			r.spotlight_id,
			r.web_id 
			FROM spotlights s 
			LEFT JOIN region_spotlights r ON (r.spotlight_id=s.postID AND r.web_id=$site_id)	
			INNER JOIN users u ON s.userid=u.userID AND ((r.web_id=".$site_id." AND u.level = 3) OR (u.level != 3 AND u.site_id  =$site_id))
            WHERE  s.spotlight_type='Job Posting'  AND s.status=1 AND u.site_id= $site_id")->result();
			
			
			
	  $data['news'] = $this->db->query("
			SELECT s.*,  
			u.site_id,
			u.userID,
			u.level,
			r.spotlight_id,
			r.web_id 
			FROM spotlights s 
			LEFT JOIN region_spotlights r ON (r.spotlight_id=s.postID AND r.web_id=$site_id)	
			INNER JOIN users u ON s.userid=u.userID AND ((r.web_id=".$site_id." AND u.level = 3) OR (u.level != 3 AND u.site_id  =$site_id)) 
			WHERE  s.spotlight_type='News / Blog'  AND s.status=1 AND u.site_id= $site_id")->result();
	  
	  
	 $data['monthly_data']  = $this->db->query("SELECT s.userid, COUNT(s.postID) as total,YEAR(date(s.created_at)) as year, u.site_id, 
		u.userID
					FROM spotlights s 
					INNER JOIN users u ON s.userid=u.userID  
					WHERE u.site_id = ".$site_id." AND s.status=1 
					GROUP BY YEAR(date(s.created_at))")->result();
			$data['relevant'] = $this->db->query("SELECT s.*,  
			u.site_id,
			u.userID,
			u.level,
			r.spotlight_id,
			r.web_id 
			FROM spotlights s 
			LEFT JOIN region_spotlights r ON (r.spotlight_id=s.postID AND r.web_id=$site_id)	
			INNER JOIN users u ON s.userid=u.userID AND ((r.web_id=".$site_id." AND u.level = 3) OR (u.level != 3 AND u.site_id  =$site_id)) 
			 WHERE s.status=1")->result();				  
			$data['View'] = "admin/dashboard";
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
		INNER JOIN users u ON s.userid=u.userID AND ((u.level = 3 AND r.web_id=".$site_id.") OR (u.level != 3 AND u.site_id  =$site_id)) 
		WHERE s.category REGEXP '^(".$preferences_str.")' AND s.status=1 AND u.level !=0   ORDER BY s.created_at DESC")->result();	
				//$this->db->last_query(); die;
				$data['page_type']='user_deshboard';
			$data['View'] = "admin/dashboard";
			
			$data['page_content'] = $this->load->view($data['View'], $data, true);
			$this->load->view('admin/layouts/dashboard', $data);
		}else{
			redirect('admin');
		}
    }
	function user_list(){
$user_level =0;

		$user_id = $this->session->userdata('user_id');
		$user_level = $this->session->userdata('user_level');
	if($user_id>0 && $user_level==1){
		$site_id = site_id();
			$data['page_type']='user_list';
			 $data['users'] = $this->db->query("SELECT  u.userID,
				u.first_name,
				u.last_name,
				u.created_at,
				u.user_type,
				u.email,
				u.photo,
				u.status,
				up.*,
				u.site_id 
				FROM users u 
				INNER JOIN user_profile up ON up.user_id=u.userID  
				
				 WHERE 1=1 AND u.site_id =$site_id  AND u.userID!=".$user_id." AND u.user_type IS NULL ORDER BY u.userID ASC")->result();
			$data['View'] = "admin/users";
			$data['page_content'] = $this->load->view($data['View'], $data, true);
			$this->load->view('admin/layouts/dashboard', $data);
		
		}else{
			redirect('admin');
		}
	}
	
	
	function add_staff(){
		$user_level =0;

	$user_id = $this->session->userdata('user_id');
	$user_level = $this->session->userdata('user_level');
	if($user_id>0 && $user_level==1){
		$this->load->library('form_validation');
		//$this->form_validation->set_rules('first_name', '', 'trim|required|xss_clean');
		 $this->form_validation->set_rules('email', $this->input->post('email'), 'required|trim|valid_email|is_unique[users.email]',
		array(
			 'is_unique'     => 'This email already exists.'
			)
		);
		$site_id = site_id();
		if($this->form_validation->run()) {
		$first_name = $this->input->post('first_name');
		$last_name = $this->input->post('last_name');
		$email = $this->input->post('email');
		$c_password = $this->input->post('c_password');
		$data = array(
				'first_name' => $this->input->post('first_name'),
				'last_name' => $this->input->post('last_name'),
				'email' => $this->input->post('email'),
				'password' => md5($c_password),
				'level' => '1',
				'photo'=>'def.jpg',
				'user_type' => '1',
				'is_email_verified' => '1',
				'created_at'=>date('Y-m-d H:i:s'),
				'site_id' =>site_id()
			);
	   $this->db->insert('users',$data);
	   $this->db->insert('user_profile',array('user_id'=>$this->db->insert_id()));
		$config = array(
					'protocol' => 'smtp',
					'smtp_host' => email_setting('host'),
					'smtp_port' => email_setting('port'),
					'smtp_user' => email_setting('username'),
					'smtp_pass' => email_setting('password'),
					'mailtype'  => 'html'
				);
				 $this->email->initialize($config);
				   $this->email->set_newline("\r\n");
				$this->email->from(email_setting('from_mail'), 'Staff Login Detail');
	            $this->email->to($check_data->email);
				$email_template =email_template('admin_staff_create');
	            $this->email->subject($email_template->subject);
				$email_body =str_replace('[email]',$email,$email_body);
				$email_body =str_replace('[password]',$c_password,$email_body);
				$email_body =str_replace('[name]',$first_name.' '.$last_nam,$email_body);
	            $this->email->message($email_body);
	            $this->email->send();
				
				
				
				
			/*	$this->load->library('email', $config);
	            $this->email->from(email_setting('from_mail'), 'Staff Login Detail');
	            $this->email->to($check_data->email);
	           
	            $this->email->set_mailtype("html");
	            $this->email->subject('Staff Login Detail');
	            $email_body = "<strong>Email</strong>:" .$email;
				$email_body .= "<strong>Password</strong>:" .$c_password;
	            $this->email->message($email_body);
	            $this->email->send();*/
				$this->session->set_flashdata('success', 'User created Successfull');
				redirect('admin/staff_users');
		}
			/*$data['page_type']='user_list';
			 $data['users'] = $this->db->query("SELECT  u.userID,
				u.first_name,
				u.last_name,
				u.photo,
				u.status,
				u.user_type,
				up.*,
				u.site_id 
				FROM users u 
				INNER JOIN user_profile up ON up.user_id=u.userID  
				
				 WHERE 1=1 AND u.site_id =$site_id AND up.complete_profile=1 AND user_type=1 ORDER BY u.userID ASC")->result();*/
			$data['View'] = "admin/add_staff_users";
			$data['page_content'] = $this->load->view($data['View'], $data, true);
			$this->load->view('admin/layouts/dashboard', $data);
		
		}else{
			redirect('admin');
		}
	}
	function staff_users(){
	$user_level =0;

	$user_id = $this->session->userdata('user_id');
	$user_level = $this->session->userdata('user_level');
	if($user_id>0 && $user_level==1){
		$site_id = site_id();
			$data['page_type']='user_list';
			 $data['users'] = $this->db->query("SELECT  u.* 
				FROM users u 				
				 WHERE  u.site_id =$site_id AND u.user_type=1 ORDER BY u.userID ASC")->result();
			$data['View'] = "admin/staff_users";
			$data['page_content'] = $this->load->view($data['View'], $data, true);
			$this->load->view('admin/layouts/dashboard', $data);
		
		}else{
			redirect('admin');
		}
	}
	function max_attribute_in_array($array, $prop) {
    return max(array_map(function($o) use($prop) {
                            return $o->$prop;
                         },
                         $array));
}
function choose_theme(){
		$user_level =0;
		$site_id = site_id();
		$user_id = $this->session->userdata('user_id');
		$user_level = $this->session->userdata('user_level');
		if($user_id>0 && $user_level==1){
			$data['View'] = "admin/landing_menu";
				$data['page_type']='landing_menu';
				$choose_theme_data =site_settings('choose_theme_data');
				if($this->input->post('choose_theme') == 1){
					$choose_theme_data = json_decode($choose_theme_data);
					$choose_theme = $this->input->post('choose_theme');
					$input_value =$this->input->post('theme');
					if(isset($choose_theme_data) && $choose_theme_data){
					
					$this->db->update('site_settings',array('value'=>$input_value),array('option_type'=>'choose_theme_data','site_id'=>$site_id ));
					}else{
						$this->db->insert('site_settings',array('value'=>$input_value,'option_type'=>'choose_theme_data','site_id'=>$site_id ));
					}
					$this->session->set_flashdata('success', 'Updated Sucessfully');
					redirect('admin/landing_menu');
				}
				
				
		}else{
			redirect('admin');
	 }
}

	function landing_menu(){
		$user_level =0;
		$site_id = site_id();
		$user_id = $this->session->userdata('user_id');
		$user_level = $this->session->userdata('user_level');
		if($user_id && $user_level==1){
			
				$data['page_type']='user_list';
				$data['landing_menu'] =site_settings('landing_menu');
				$data['banner_settings'] =$banner_settings= site_settings('banner_settings');
				$data['logo_settings'] =$logo_settings= site_settings('logo_settings');
				$data['f_spotlights'] =$f_spotlights= site_settings('f_spotlights');
				$data['f_spotlights_slider_data'] =$f_spotlights_slider_data= site_settings('f_spotlights_slider');
				$data['h_spotlights'] =$h_spotlights= site_settings('h_spotlights');
				$data['admin_spotlights'] = site_settings('admin_spotlights');
				$data['View'] = "admin/landing_menu";
				$data['page_type']='landing_menu';
				if($this->input->post('submit_setting') == 1){
					if($data['landing_menu']){
					$this->db->update('site_settings',array('value'=>$this->input->post('menu_order')),array('option_type'=>'landing_menu','site_id'=>$site_id ));
					}else{
						$this->db->insert('site_settings',array('value'=>$this->input->post('menu_order'),'site_id'=>$site_id,'option_type'=>'landing_menu' ));
					}
					$this->session->set_flashdata('success', 'Updated Sucessfully');
					redirect('admin/landing_menu');
				}
				
				
				if($this->input->post('add_menu') == 1){
					$category = $this->input->post('category');
					if($category){
						$category_name = $this->db->get_where('spotlights_category',array('categoryID'=>$category))->row()->categoryTitle;
						$label = $category_name;
						$url = base_url().'home/category/'.$category ;
					}else{
						$label = $this->input->post('label');
						$url = $this->input->post('url');
						$external = $this->input->post('external');
					}
					//print_r($external); die;
					if($data['landing_menu']){
						$landing_menu = json_decode($data['landing_menu']);
						$max_value = $this->max_attribute_in_array($landing_menu,'id');
						$new_item = array((object) array('id'=>$max_value+1,'label'=>$label,'url'=>$url,'ext'=>$external));
						$json_data = json_encode(array_merge($landing_menu,$new_item));
							
						$this->db->update('site_settings',array('value'=>$json_data),array('option_type'=>'landing_menu','site_id'=>$site_id ));
					}else{
						$new_item = array((object) array('id'=>1,'label'=>$label,'url'=>$url));
						$this->db->insert('site_settings',array('value'=>json_encode($new_item) ,'option_type'=>'landing_menu','site_id'=>$site_id));
					}
					$this->session->set_flashdata('success2', 'Added Sucessfully');
					redirect('admin/landing_menu#success2');
				}
				
				
				if($this->input->post('submit_admin_spot') == 1){
					if($data['admin_spotlights']){
					$this->db->update('site_settings',array('value'=>$this->input->post('menu_order_spotlights')),array('option_type'=>'admin_spotlights','site_id'=>$site_id ));
					}else{
						$this->db->insert('site_settings',array('value'=>$this->input->post('menu_order_spotlights'),'site_id'=>$site_id,'option_type'=>'admin_spotlights' ));
					}
					$this->session->set_flashdata('success7', 'Updated Sucessfully');
					redirect('admin/landing_menu#success7');
				}
				if($this->input->post('add_spot_admin') == 1){
					$activity = $this->input->post('activity');
					  $menu_order_spotlights =site_settings('admin_spotlights');
					if($menu_order_spotlights){
						$admin_spotlights = json_decode($data['admin_spotlights']);
						$max_value = $this->max_attribute_in_array($admin_spotlights,'id');
						$new_item = array((object) array('id'=>$max_value+1,'label'=>$activity));
						$json_data = json_encode(array_merge($admin_spotlights,$new_item));
							
						$this->db->update('site_settings',array('value'=>$json_data),array('option_type'=>'admin_spotlights','site_id'=>$site_id ));
					}else{
						//print_r($activity); die;
						$new_item = array((object) array('id'=>1,'label'=>$activity));
						$this->db->insert('site_settings',array('value'=>json_encode($new_item) ,'option_type'=>'admin_spotlights','site_id'=>$site_id));
					}
					$this->session->set_flashdata('success6', 'Added Sucessfully');
					redirect('admin/landing_menu#success6');
				}
				
				if($this->input->post('f_submit') == 1){
					$f_spotlights_post = $this->input->post('f_spotlights');
					$f_title = $this->input->post('f_title');
					$f_description = $this->input->post('f_description');
					$json_data = json_encode(array('f_title'=>$f_title,'f_description'=>$f_description,'f_spotlights'=>$f_spotlights_post));
					//print_r($f_spotlights_post); die;
					if($data['f_spotlights']){
						$this->db->update('site_settings',array('value'=>$json_data),array('option_type'=>'f_spotlights','site_id'=>$site_id ));
					}else{
						$this->db->insert('site_settings',array('value'=>$json_data ,'option_type'=>'f_spotlights','site_id'=>$site_id));
					}
					$this->session->set_flashdata('success4', 'Added Sucessfully');
					redirect('admin/landing_menu#success4');
					
				}
				
				if($this->input->post('f_submit_slider') == 1){
		
					$f_spotlights_post = $this->input->post('f_spotlights_slider');
				 //	print_r($f_spotlights_post); die;
					$json_data = json_encode(array('f_spotlights_slider'=>$f_spotlights_post));
					//print_r($f_spotlights_post); die;
					if($data['f_spotlights_slider_data']){
						$this->db->update('site_settings',array('value'=>$json_data),array('option_type'=>'f_spotlights_slider','site_id'=>$site_id ));
					}else{
						$this->db->insert('site_settings',array('value'=>$json_data ,'option_type'=>'f_spotlights_slider','site_id'=>$site_id));
					}
					$this->session->set_flashdata('s123', 'Added Sucessfully');
					redirect('admin/landing_menu#s123');
					
				}
				
				
				
				if($this->input->post('h_submit') == 1){
					$h_spotlights_post = $this->input->post('h_spotlights');
					$h_title = $this->input->post('h_title');
					$h_description = $this->input->post('h_description');
					$json_data = json_encode(array('h_title'=>$h_title,'h_description'=>$h_description,'h_spotlights'=>$h_spotlights_post));
					//print_r($f_spotlights_post); die;
					if($data['h_spotlights']){
						$this->db->update('site_settings',array('value'=>$json_data),array('option_type'=>'h_spotlights','site_id'=>$site_id ));
					}else{
						$this->db->insert('site_settings',array('value'=>$json_data ,'option_type'=>'h_spotlights','site_id'=>$site_id));
					}
					$this->session->set_flashdata('success5', 'Added Sucessfully');
					redirect('admin/landing_menu#success5');
					
				}
				if($this->input->post('logo_submit') == 1){
					$logo_settings = json_decode($logo_settings);
					$header_color = $this->input->post('header_color');
					$header_f_color = $this->input->post('header_f_color');
					$footer_color = $this->input->post('footer_color');
					$footer_f_color = $this->input->post('footer_f_color');
					$footer_f_color2 = $this->input->post('footer_f_color2');
					//print_r($logo_settings); die;
					if(isset($logo_settings)){
						$json_data = json_encode(array(
											  'header_color'=>$header_color,
											  'footer_color'=>$footer_color,
											  'header_f_color'=>$header_f_color,
											  'footer_f_color'=>$footer_f_color,
											  'footer_f_color2'=>$footer_f_color2,
											'logo'=>$logo_settings->logo,'favicon'=>$logo_settings->favicon));
					
					}else{
						$json_data = json_encode(array('header_color'=>$header_color,
													  'footer_color'=>$footer_color,
													  'header_f_color'=>$header_f_color,
													    'footer_f_color2'=>$footer_f_color2,
													  'footer_f_color'=>$footer_f_color,'logo'=>'','favicon'=>''));
					}
					if($data['logo_settings']){
						$this->db->update('site_settings',array('value'=>$json_data),array('option_type'=>'logo_settings','site_id'=>$site_id ));
					}else{
						$this->db->insert('site_settings',array('value'=>$json_data,'option_type'=>'logo_settings','site_id'=>$site_id));
					}
					$this->logo_upload();
					//$this->logo_upload2();
					//$this->favicon_upload();
					$this->session->set_flashdata('success99', 'updated Sucessfully');
					redirect('admin/landing_menu#success99');
				}
				
				
				
				if($this->input->post('b_submit') == 1){
					$b_title = $this->input->post('b_title');
					$b_sub_title = $this->input->post('b_sub_title');
					$landing_menu = json_decode($banner_settings);
					
					//print_r($landing_menu); die;
					if(isset($landing_menu->b_image)){
						$json_data = json_encode(array('b_title'=>$b_title,'sub_title'=>$b_sub_title,'b_image'=>$landing_menu->b_image));
					
					}else{
						$json_data = json_encode(array('b_title'=>$b_title,'sub_title'=>$b_sub_title,'b_image'=>''));
					}
					if($data['banner_settings']){
						$this->db->update('site_settings',array('value'=>$json_data),array('option_type'=>'banner_settings','site_id'=>$site_id ));
					}else{
						$this->db->insert('site_settings',array('value'=>$json_data,'option_type'=>'banner_settings','site_id'=>$site_id));
					}
					$this->banner_upload();
					$this->session->set_flashdata('success3', 'updated Sucessfully');
					redirect('admin/landing_menu#success3');
				}
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
			$data['s_admin_spotlights'] = $this->db->query("SELECT s.*, 
			u.site_id,
			u.level,
			r.spotlight_id,
			r.web_id,
			cat.categoryTitle
			FROM spotlights s 
			LEFT JOIN region_spotlights r ON (r.spotlight_id=s.postID AND r.web_id=$site_id)
			LEFT JOIN spotlights_category cat ON (s.category=cat.categoryTitle)
			INNER JOIN users u ON s.userid=u.userID AND u.level = 1  AND r.web_id=".$site_id."
			WHERE s.status=1 ORDER BY s.created_at DESC")->result_array();
			
			
			
				$data['page_content'] = $this->load->view($data['View'], $data, true);
				$this->load->view('admin/layouts/dashboard', $data);
			
			}else{
				redirect('admin');
			}
	}
	public function logo_upload() {
		//print_r($_FILES['b_image']['name']); die;
		$site_id = site_id();
        $target_path = base_url() . "uploads/banners/";        
        if ($_FILES['logo']['name']) {
            $target_path = $target_path . basename($_FILES['logo']['name']);
            $config['upload_path'] = './uploads/banners/';
            $config['allowed_types'] = 'svg|gif|jpg|jpeg|png';
            $config['max_size'] = '150000';
            $this->load->library('upload', $config);
            if ($this->upload->do_upload('logo')) {
				$banner_settings =site_settings('logo_settings');
				$banner_image=array();
				if($banner_settings){
					$banner_data =json_decode($banner_settings);
					if(isset($banner_data->logo))$banner_image =$banner_data->logo;
				}else{
					$banner_image =array();
				}
				
				if($banner_image){
					@unlink(FCPATH ."uploads/banners/".$banner_image);
				}
				 $upload_data = $this->upload->data();
				
                $banner_data->logo = $upload_data['file_name'];
                $this->db->update('site_settings',array('value'=>json_encode($banner_data)), array('option_type'=>'logo_settings','site_id'=>$site_id ));
            }else{
				$error = array('error' => $this->upload->display_errors());
				print_r($error); die;
			}
        }
        //print_r($formArray[));
         //redirect('login/complete_profile');
    }
	public function logo_upload2() {
		//print_r($_FILES['b_image']['name']); die;
		$site_id = site_id();
        $target_path = base_url() . "uploads/banners/";        
        if ($_FILES['logo2']['name']) {
            $target_path = $target_path . basename($_FILES['logo2']['name']);
            $config['upload_path'] = './uploads/banners/';
            $config['allowed_types'] = 'gif|jpg|jpeg|png';
            $config['max_size'] = '150000';
            $this->load->library('upload', $config);
            if ($this->upload->do_upload('logo2')) {
				$banner_settings =site_settings('logo_settings');
				$banner_image=array();
				if($banner_settings){
					$banner_data =json_decode($banner_settings);
					if(isset($banner_data->logo2))$banner_image =$banner_data->logo2;
				}else{
					$banner_image =array();
				}
				
				if($banner_image){
					@unlink(FCPATH ."uploads/banners/".$banner_image);
				}
				 $upload_data = $this->upload->data();
				
                $banner_data->logo2 = $upload_data['file_name'];
                $this->db->update('site_settings',array('value'=>json_encode($banner_data)), array('option_type'=>'logo_settings','site_id'=>$site_id ));
            }else{
				$error = array('error' => $this->upload->display_errors());
				print_r($error); die;
			}
        }
        //print_r($formArray[));
         //redirect('login/complete_profile');
    }
	public function favicon_upload() {
		//print_r($_FILES['b_image']['name']); die;
		$site_id = site_id();
        $target_path = base_url() . "uploads/banners/";        
        if ($_FILES['favicon']['name']) {
            $target_path = $target_path . basename($_FILES['favicon']['name']);
            $config['upload_path'] = './uploads/banners/';
            $config['allowed_types'] = 'gif|jpg|jpeg|png';
            $config['max_size'] = '150000';
            $this->load->library('upload', $config);
            if ($this->upload->do_upload('favicon')) {
				$banner_settings =site_settings('logo_settings');
				$banner_image=array();
				if($banner_settings){
					$banner_data =json_decode($banner_settings);
					if(isset($banner_data->b_image))$banner_image =$banner_data->favicon;
				}else{
					$banner_image =array();
				}
				
				if($banner_image){
					@unlink(FCPATH ."uploads/banners/".$banner_image);
				}
				 $upload_data = $this->upload->data();
				
                $banner_data->favicon = $upload_data['file_name'];
                $this->db->update('site_settings',array('value'=>json_encode($banner_data)), array('option_type'=>'logo_settings','site_id'=>$site_id ));
            }else{
				$error = array('error' => $this->upload->display_errors());
				print_r($error); die;
			}
        }
        //print_r($formArray[));
         //redirect('login/complete_profile');
    }
	
		public function banner_upload() {
		//print_r($_FILES['b_image']['name']); die;
		$site_id = site_id();
        $target_path = base_url() . "uploads/banners/";        
        if ($_FILES['b_image']['name']) {
            $target_path = $target_path . basename($_FILES['b_image']['name']);
            $config['upload_path'] = './uploads/banners/';
            $config['allowed_types'] = 'gif|jpg|jpeg|png';
            $config['max_size'] = '150000';
            $this->load->library('upload', $config);
            if ($this->upload->do_upload('b_image')) {
				$banner_settings =site_settings('banner_settings');
				$banner_image=array();
				if($banner_settings){
					$banner_data =json_decode($banner_settings);
					if(isset($banner_data->b_image))$banner_image =$banner_data->b_image;
				}else{
					$banner_image =array();
				}
				
				if($banner_image){
					@unlink(FCPATH ."uploads/banners/".$banner_image);
				}
				 $upload_data = $this->upload->data();
				
                $banner_data->b_image = $upload_data['file_name'];
                $this->db->update('site_settings',array('value'=>json_encode($banner_data)), array('option_type'=>'banner_settings','site_id'=>$site_id ));
            }else{
				$error = array('error' => $this->upload->display_errors());
				print_r($error); die;
			}
        }
        //print_r($formArray[));
         //redirect('login/complete_profile');
    }
	
	function mychart(){
		$site_id = site_id();
    	header('Content-Type: application/json');
    	$user_id = $this->session->userdata('user_id');
		if($user_id>0){
    	$user_montly = $this->db->query("SELECT s.userid, COUNT(s.`postID`) as total,MONTH(date(s.created_at)) as month,	u.site_id, 
		u.userID
					FROM spotlights s 
					INNER JOIN users u ON s.userid=u.userID  
					WHERE u.site_id = ".$site_id." AND s.status=1 
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
	function public_spotlight(){
         $site_id = site_id();
		 $user_level = $this->session->userdata('user_level');
		$user_id = $this->session->userdata('user_id');
		if($user_id>0 && $user_level==1){
			$this->db->where('userID', $user_id );
			
		    $this->db->from('users');
			$data['userinfo'] = $this->db->get()->row();

			$this->db->where('user_id', $user_id );
			$this->db->from('user_profile');
			$data['userprofileinfo'] = $this->db->get()->row();

		

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
			redirect('admin');
		}	
	}
	function category(){
		$site_id = site_id();
		$user_level =0;
		$user_id = $this->session->userdata('user_id');
		$user_level = $this->session->userdata('user_level');
	if($user_id>0 && $user_level==1){
			//print_r($site_data);
			$this->db->where('userID', $user_id );
			
		    $this->db->from('users');
			$data['userinfo'] = $this->db->get()->row();

			$this->db->where('user_id', $user_id );
			$this->db->from('user_profile');
			$data['userprofileinfo'] = $this->db->get()->row();
			
			
			
			 $url_sigment = $this->uri->segment(3);
			  $where_Value = urldecode($this->uri->segment(3));
/*			if($url_sigment =='news'){
				$where_filter = " AND s.spotlight_type='News / Blog'";
			}elseif($url_sigment =='jobs'){
				 $where_filter = " AND s.spotlight_type='Job Posting'";
			}elseif($url_sigment =='events'){
				 	 $where_filter = " AND s.spotlight_type='Events'";
			}elseif($url_sigment =='spotit'){	 
			$where_filter = " AND s.spotlight_type='Spotit Spotlight'";
			}elseif($url_sigment =='media'){	 
			$where_filter = " AND s.spotlight_type='Media/Podcast'";
			}else{*/
				$where_filter =" AND s.category='$where_Value'";
			//}

			if(!empty($this->input->get('search'))){
				$data['search_text'] = $this->input->get('search');
				$search_filter = " AND (s.postTitle LIKE '%".$data['search_text']."%' OR s.postContent LIKE '%".$data['search_text']."%')";
				$s_qstring= "?search=".$data['search_text'];

			}else{
				$data['search_text'] = '';
				$search_filter ="";
				$s_qstring= "";
			}
			/*echo "SELECT s.*, 
				u.first_name,
				u.last_name,
				u.photo,
				(SELECT count(likeID) FROM likes l WHERE l.userID=".$user_id." AND s.postID=l.itemID) AS likecount
				  FROM spotlights s INNER JOIN users u ON s.userid=u.userID  WHERE s.category REGEXP '^(".$preferences_str.")'  AND s.status=1";exit;*/
			
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
			LEFT JOIN region_spotlights r ON (r.spotlight_id=s.postID AND r.web_id=$site_id)		
			INNER JOIN users u ON s.userid=u.userID AND ((u.level = 3  AND r.web_id=".$site_id.") OR (u.level != 3 AND u.site_id  =$site_id)) 
				  
			WHERE s.status=1 AND u.site_id= $site_id ".$where_filter." ".$search_filter)->num_rows();
		    
           /*if(!empty($this->input->get('search'))){ 
           		$url_sigment='all';
		   }else{
				$url_sigment= $url_sigment;
		   }*/
			$config = array();
			$config["base_url"] = base_url()."admin/category/". $url_sigment;
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
			LEFT JOIN region_spotlights r ON (r.spotlight_id=s.postID AND r.web_id=$site_id)
			INNER JOIN users u ON s.userid=u.userID AND ((u.level = 3  AND r.web_id=".$site_id.") OR (u.level != 3 AND u.site_id  =$site_id)) 
			WHERE s.status=1   ".$where_filter." ".$search_filter." ORDER BY s.created_at DESC limit ".$config["per_page"]." OFFSET ".$page)->result_array();
				  
				  
				  
				  
		$data['news_total'] = $this->db->query("SELECT s.*, 
		u.site_id,
		u.level,
		r.spotlight_id,
		r.web_id 
		FROM spotlights s 
		LEFT JOIN region_spotlights r ON (r.spotlight_id=s.postID AND r.web_id=$site_id)
		INNER JOIN users u ON s.userid=u.userID AND ((u.level = 3 AND r.web_id=".$site_id.") OR (u.level != 3 AND u.site_id  =$site_id)) 
		
		WHERE  s.spotlight_type='News / Blog'  AND s.status=1 ".$search_filter)->num_rows();
		
		
		$data['job_total'] = $this->db->query("SELECT s.*, 
		u.site_id,
		u.level,
		r.spotlight_id,
		r.web_id 
		FROM spotlights s 
		LEFT JOIN region_spotlights r ON (r.spotlight_id=s.postID AND r.web_id=$site_id)
		INNER JOIN users u ON s.userid=u.userID AND ((u.level = 3 AND r.web_id=".$site_id.") OR (u.level != 3 AND u.site_id  =$site_id)) 
		
		WHERE  s.spotlight_type='Job Posting'  AND s.status=1 ".$search_filter)->num_rows();
		
		
		$data['event_total'] = $this->db->query("SELECT s.*, 
		u.site_id,
		u.level,
		r.spotlight_id,
		r.web_id 
		FROM spotlights s 
		LEFT JOIN region_spotlights r ON (r.spotlight_id=s.postID AND r.web_id=$site_id)
		INNER JOIN users u ON s.userid=u.userID AND ((u.level = 3 AND r.web_id=".$site_id.") OR (u.level != 3 AND u.site_id  =$site_id)) 
		
		WHERE  s.spotlight_type='Events'  AND s.status=1 ".$search_filter)->num_rows();
		$data['media_total'] = $this->db->query("SELECT s.*, 
		u.site_id,
		u.level,
		r.spotlight_id,
		r.web_id 
		FROM spotlights s 
		LEFT JOIN region_spotlights r ON (r.spotlight_id=s.postID AND r.web_id=$site_id)
		INNER JOIN users u ON s.userid=u.userID AND ((u.level = 3 AND r.web_id=".$site_id.") OR (u.level != 3 AND u.site_id  =$site_id)) 
		
		WHERE  s.spotlight_type='Media/Podcast'  AND s.status=1 ".$search_filter)->num_rows();
		
		
		$data['spotit_total'] = $this->db->query("SELECT s.*, 
		u.site_id,
		u.level,
		r.spotlight_id,
		r.web_id 
		FROM spotlights s 
		LEFT JOIN region_spotlights r ON (r.spotlight_id=s.postID AND r.web_id=$site_id)
		INNER JOIN users u ON s.userid=u.userID AND ((u.level = 3 AND r.web_id=".$site_id.") OR (u.level != 3 AND u.site_id  =$site_id)) 
		
		WHERE  s.spotlight_type='Spotit Spotlight'  AND s.status=1 ".$search_filter)->num_rows();
			
			if(!empty($this->input->get('search')))
			{


			}else{
				$data['search_text'] = '';
			}

			$data['page_type']='activities';
			$data['View'] = "admin/categories";
			$data['page_content'] = $this->load->view($data['View'], $data, true);
			$this->load->view('admin/layouts/dashboard', $data);
		}else{
			redirect('admin');
		}	
	}
	function activities(){
		$site_id = site_id();
		$user_level =0;
		$user_id = $this->session->userdata('user_id');
		$user_level = $this->session->userdata('user_level');
	if($user_id>0 && $user_level==1){
			//print_r($site_data);
			$this->db->where('userID', $user_id );
			
		    $this->db->from('users');
			$data['userinfo'] = $this->db->get()->row();

			$this->db->where('user_id', $user_id );
			$this->db->from('user_profile');
			$data['userprofileinfo'] = $this->db->get()->row();
			
			
			
			$url_sigment = $this->uri->segment(3);
			//if($url_sigment =='top_categories'){
				
			$data['categories'] = $this->db->query("SELECT s.*, 
			u.first_name,
			u.last_name,
			u.photo,
			u.site_id,
			u.level,
			r.spotlight_id,
			r.web_id,
			COUNT(s.category) AS category_count
			FROM spotlights s 
			LEFT JOIN region_spotlights r ON (r.spotlight_id=s.postID AND r.web_id=$site_id)
			INNER JOIN users u ON s.userid=u.userID AND ((u.level = 3  AND r.web_id=".$site_id.") OR (u.level != 3 AND u.site_id  =$site_id)) 
			WHERE s.status=1 GROUP BY s.category ORDER BY category_count DESC")->result_array();
			//}else{
			
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
			/*echo "SELECT s.*, 
				u.first_name,
				u.last_name,
				u.photo,
				(SELECT count(likeID) FROM likes l WHERE l.userID=".$user_id." AND s.postID=l.itemID) AS likecount
				  FROM spotlights s INNER JOIN users u ON s.userid=u.userID  WHERE s.category REGEXP '^(".$preferences_str.")'  AND s.status=1";exit;*/
			
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
			LEFT JOIN region_spotlights r ON (r.spotlight_id=s.postID AND r.web_id=$site_id)		
			INNER JOIN users u ON s.userid=u.userID AND ((u.level = 3  AND r.web_id=".$site_id.") OR (u.level != 3 AND u.site_id  =$site_id)) 
				  
			WHERE s.status=1 AND u.site_id= $site_id ".$where_filter." ".$search_filter)->num_rows();
		    
           /*if(!empty($this->input->get('search'))){ 
           		$url_sigment='all';
		   }else{
				$url_sigment= $url_sigment;
		   }*/
			$config = array();
			$config["base_url"] = base_url()."admin/activities/". $url_sigment;
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
			LEFT JOIN region_spotlights r ON (r.spotlight_id=s.postID AND r.web_id=$site_id)
			INNER JOIN users u ON s.userid=u.userID AND ((u.level = 3  AND r.web_id=".$site_id.") OR (u.level != 3 AND u.site_id  =$site_id)) 
			WHERE s.status=1   ".$where_filter." ".$search_filter." ORDER BY s.created_at DESC limit ".$config["per_page"]." OFFSET ".$page)->result_array();
				  
				  
				  
				  
		$data['news_total'] = $this->db->query("SELECT s.*, 
		u.site_id,
		u.level,
		r.spotlight_id,
		r.web_id 
		FROM spotlights s 
		LEFT JOIN region_spotlights r ON (r.spotlight_id=s.postID AND r.web_id=$site_id)
		INNER JOIN users u ON s.userid=u.userID AND ((u.level = 3 AND r.web_id=".$site_id.") OR (u.level != 3 AND u.site_id  =$site_id)) 
		
		WHERE  s.spotlight_type='News / Blog'  AND s.status=1 ".$search_filter)->num_rows();
		
		
		$data['job_total'] = $this->db->query("SELECT s.*, 
		u.site_id,
		u.level,
		r.spotlight_id,
		r.web_id 
		FROM spotlights s 
		LEFT JOIN region_spotlights r ON (r.spotlight_id=s.postID AND r.web_id=$site_id)
		INNER JOIN users u ON s.userid=u.userID AND ((u.level = 3 AND r.web_id=".$site_id.") OR (u.level != 3 AND u.site_id  =$site_id)) 
		
		WHERE  s.spotlight_type='Job Posting'  AND s.status=1 ".$search_filter)->num_rows();
		
		
		$data['event_total'] = $this->db->query("SELECT s.*, 
		u.site_id,
		u.level,
		r.spotlight_id,
		r.web_id 
		FROM spotlights s 
		LEFT JOIN region_spotlights r ON (r.spotlight_id=s.postID AND r.web_id=$site_id)
		INNER JOIN users u ON s.userid=u.userID AND ((u.level = 3 AND r.web_id=".$site_id.") OR (u.level != 3 AND u.site_id  =$site_id)) 
		
		WHERE  s.spotlight_type='Events'  AND s.status=1 ".$search_filter)->num_rows();
		$data['media_total'] = $this->db->query("SELECT s.*, 
		u.site_id,
		u.level,
		r.spotlight_id,
		r.web_id 
		FROM spotlights s 
		LEFT JOIN region_spotlights r ON (r.spotlight_id=s.postID AND r.web_id=$site_id)
		INNER JOIN users u ON s.userid=u.userID AND ((u.level = 3 AND r.web_id=".$site_id.") OR (u.level != 3 AND u.site_id  =$site_id)) 
		
		WHERE  s.spotlight_type='Media/Podcast'  AND s.status=1 ".$search_filter)->num_rows();
		
		
		$data['spotit_total'] = $this->db->query("SELECT s.*, 
		u.site_id,
		u.level,
		r.spotlight_id,
		r.web_id 
		FROM spotlights s 
		LEFT JOIN region_spotlights r ON (r.spotlight_id=s.postID AND r.web_id=$site_id)
		INNER JOIN users u ON s.userid=u.userID AND ((u.level = 3 AND r.web_id=".$site_id.") OR (u.level != 3 AND u.site_id  =$site_id)) 
		
		WHERE  s.spotlight_type='Spotit Spotlight'  AND s.status=1 ".$search_filter)->num_rows();
			
			if(!empty($this->input->get('search')))
			{


			}else{
				$data['search_text'] = '';
			}
		//}

			$data['page_type']='activities';
			$data['View'] = "admin/activities";
			$data['page_content'] = $this->load->view($data['View'], $data, true);
			$this->load->view('admin/layouts/dashboard', $data);
		}else{
			redirect('admin');
		}	
	}
	
	function top_activities(){
		$site_id = site_id();
		$user_id = $this->session->userdata('user_id');
		$user_level = $this->session->userdata('user_level');
			if($user_id>0 && $user_level==1){
			//print_r($site_data);
			$this->db->where('userID', $user_id );
			
		    $this->db->from('users');
			$data['userinfo'] = $this->db->get()->row();

			$this->db->where('user_id', $user_id );
			$this->db->from('user_profile');
			$data['userprofileinfo'] = $this->db->get()->row();

			
			
			
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
			/*echo "SELECT s.*, 
				u.first_name,
				u.last_name,
				u.photo,
				(SELECT count(likeID) FROM likes l WHERE l.userID=".$user_id." AND s.postID=l.itemID) AS likecount
				  FROM spotlights s INNER JOIN users u ON s.userid=u.userID  WHERE s.category REGEXP '^(".$preferences_str.")'  AND s.status=1";exit;*/
			
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
			LEFT JOIN region_spotlights r ON (r.spotlight_id=s.postID AND r.web_id=$site_id)		
			INNER JOIN users u ON s.userid=u.userID AND ((u.level = 3  AND r.web_id=".$site_id.") OR (u.level != 3 AND u.site_id  =$site_id)) 
				  
			WHERE s.status=1 AND u.site_id= $site_id ".$where_filter." ".$search_filter)->num_rows();
		    
           /*if(!empty($this->input->get('search'))){ 
           		$url_sigment='all';
		   }else{
				$url_sigment= $url_sigment;
		   }*/
			$config = array();
			$config["base_url"] = base_url()."admin/activities/". $url_sigment;
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
			LEFT JOIN region_spotlights r ON (r.spotlight_id=s.postID AND r.web_id=$site_id)
			INNER JOIN users u ON s.userid=u.userID AND ((u.level = 3  AND r.web_id=".$site_id.") OR (u.level != 3 AND u.site_id  =$site_id)) 
			WHERE s.status=1   ".$where_filter." ".$search_filter." ORDER BY s.visits_count DESC limit ".$config["per_page"]." OFFSET ".$page)->result_array();
				  
				  
		$data['news_total'] = $this->db->query("SELECT s.*, 
			u.site_id,
			u.level,
			r.spotlight_id,
			r.web_id 
			FROM spotlights s 
			LEFT JOIN region_spotlights r ON (r.spotlight_id=s.postID AND r.web_id=$site_id)
			INNER JOIN users u ON s.userid=u.userID AND ((u.level = 3 AND r.web_id=".$site_id.") OR (u.level != 3 AND u.site_id  =$site_id)) 
		    WHERE  s.spotlight_type='News / Blog'  AND s.status=1 ".$search_filter)->num_rows();
			$data['media_total'] = $this->db->query("SELECT s.*, 
			u.site_id,
			u.level,
			r.spotlight_id,
			r.web_id 
			FROM spotlights s 
			LEFT JOIN region_spotlights r ON (r.spotlight_id=s.postID AND r.web_id=$site_id)
			INNER JOIN users u ON s.userid=u.userID AND ((u.level = 3 AND r.web_id=".$site_id.") OR (u.level != 3 AND u.site_id  =$site_id)) 
		    WHERE  s.spotlight_type='Media/Podcast'  AND s.status=1 ".$search_filter)->num_rows();
			
			$data['job_total'] = $this->db->query("SELECT s.*, 
			u.site_id,
			u.level,
			r.spotlight_id,
			r.web_id 
			FROM spotlights s 
			LEFT JOIN region_spotlights r ON (r.spotlight_id=s.postID AND r.web_id=$site_id)
			INNER JOIN users u ON s.userid=u.userID AND ((u.level = 3 AND r.web_id=".$site_id.") OR (u.level != 3 AND u.site_id  =$site_id)) 
		    WHERE  s.spotlight_type='Job Posting'  AND s.status=1 ".$search_filter)->num_rows();
			
			
			$data['event_total'] = $this->db->query("SELECT s.*, 
			u.site_id,
			u.level,
			r.spotlight_id,
			r.web_id 
			FROM spotlights s 
			LEFT JOIN region_spotlights r ON (r.spotlight_id=s.postID AND r.web_id=$site_id)
			INNER JOIN users u ON s.userid=u.userID AND ((u.level = 3 AND r.web_id=".$site_id.") OR (u.level != 3 AND u.site_id  =$site_id)) 
		    WHERE  s.spotlight_type='Events'  AND s.status=1 ".$search_filter)->num_rows();	
			
			
			$data['spotit_total'] = $this->db->query("SELECT s.*, 
			u.site_id,
			u.level,
			r.spotlight_id,
			r.web_id 
			FROM spotlights s 
			LEFT JOIN region_spotlights r ON (r.spotlight_id=s.postID AND r.web_id=$site_id)
			INNER JOIN users u ON s.userid=u.userID AND ((u.level = 3 AND r.web_id=".$site_id.") OR (u.level != 3 AND u.site_id  =$site_id)) 
		    WHERE  s.spotlight_type='Spotit Spotlight'  AND s.status=1 ".$search_filter)->num_rows();	  
			
			if(!empty($this->input->get('search')))
			{

			}else{
				$data['search_text'] = '';
			}

			$data['page_type']='activities';
			$data['View'] = "admin/top_activities";
			$data['page_content'] = $this->load->view($data['View'], $data, true);
			$this->load->view('admin/layouts/dashboard', $data);
		}else{
			redirect('admin');
		}	
	}
	
	function myspotlight(){
		$user_level =0;
		$user_id = $this->session->userdata('user_id');
		$user_level = $this->session->userdata('user_level');
	if($user_id>0 && $user_level==1){
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
			$config["base_url"] = base_url()."admin/myspotlight/". $url_sigment;
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

			/*if(!empty($this->input->get('search')))

			{
				$data['search_text'] = $this->input->post('search');
				$data['spotlight_posts'] = $this->db->query("SELECT s.*, 
				u.first_name,
				u.last_name,
				u.photo,
				(SELECT count(likeID) FROM likes l WHERE l.userID=".$user_id." AND s.postID=l.itemID) AS likecount
				 FROM spotlights s INNER JOIN users u ON s.userid=u.userID WHERE s.userid=".$user_id." ".$where_filter." AND (s.postTitle LIKE '%".$data['search_text']."%' OR s.postContent LIKE '%".$data['search_text']."%')  ORDER BY s.created_at DESC limit ".$config["per_page"]." OFFSET ".$page)->result_array();


			}else{
				$data['search_text'] = '';
			}*/
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
			$data['View'] = "admin/myspotlight";
			$data['page_content'] = $this->load->view($data['View'], $data, true);
			$this->load->view('admin/layouts/dashboard', $data);
		}else{
			redirect('admin');
		}	
	}
	function create_new_spotlight(){
			$user_level =0;
		$user_id = $this->session->userdata('user_id');
		$user_level = $this->session->userdata('user_level');
	if($user_id>0 && $user_level==1){
				$this->db->where('userID', $user_id );
				$this->db->from('users');
				$data['userinfo'] = $this->db->get()->row();
	
				$this->db->where('user_id', $user_id );
				$this->db->from('user_profile');
				$data['userprofileinfo'] = $this->db->get()->row();
	             $data['categories'] = $this->db->order_by('categoryTitle','asc')->get('spotlights_category')->result();
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
							redirect('admin/create_new_spotlight_step2/'.$spotid);
						}else{
							$status = array('status'=>2,'created_at' => date('Y-m-d H:i:s'));
							$this->db->insert('spotlights',array_merge($status,$data));
						$insert_id = $this->db->insert_id();
						redirect('admin/create_new_spotlight_step2/'.$insert_id);
						}
					}
				}
	
	
				$data['View'] = "admin/create_new_spotlight";
				$data['page_type']='spotlight';
				$data['page_content'] = $this->load->view($data['View'], $data, true);
				$this->load->view('admin/layouts/dashboard', $data);
			}else{
				redirect('admin');
			}	
		}
	
	function create_new_spotlight_step2(){
	$user_level =0;
		$user_id = $this->session->userdata('user_id');
		$user_level = $this->session->userdata('user_level');
	if($user_id>0 && $user_level==1){
		$this->db->where('userID', $user_id );
		$this->db->from('users');
		$data['userinfo'] = $this->db->get()->row();

		$this->db->where('user_id', $user_id );
		$this->db->from('user_profile');
		$data['userprofileinfo'] = $this->db->get()->row();
		$spotlightid = $this->uri->segment(3);
		$data['spotlight_images'] = $this->db->query("SELECT * FROM spotlights_images WHERE spotlight_id=".$spotlightid)->result_array();
			
		$data['View'] = "admin/create_new_spotlight_step2";
		$data['page_type']='spotlight2';
		$data['page_content'] = $this->load->view($data['View'], $data, true);
		$this->load->view('admin/layouts/dashboard', $data);	
			
	}else{
		redirect('admin');
	}	
}
function create_new_spotlight_step3(){
	$user_level =0;
		$user_id = $this->session->userdata('user_id');
		$user_level = $this->session->userdata('user_level');
	if($user_id>0 && $user_level==1){
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
			redirect('admin/myspotlight');
		}
		if($this->input->post('submit')==2  )
		{
			$updateData = array('status' => '2');
			$this->db->update('spotlights', $updateData, array('postID' => $spotlightid, 'userid'=>$user_id));
			redirect('admin/myspotlight');
		}	

		$data['View'] = "admin/create_new_spotlight_step3";
		$data['page_type']='spotlight3';
		$data['page_content'] = $this->load->view($data['View'], $data, true);
		$this->load->view('admin/layouts/dashboard', $data);	
			
	}else{
		redirect('admin');
	}	
}
function delete_spotlight(){
	$user_id = $this->session->userdata('user_id');
		$user_level = $this->session->userdata('user_level');
	if($user_id>0 && $user_level==1){
			
	$spotlightid =  $this->uri->segment(3);
	$user_id = $this->session->userdata('user_id');
	$this->db->where('userid', $user_id);
	$this->db->where('postID', $spotlightid);
	$this->db->delete('spotlights');
	redirect('admin/myspotlight');
	}
	else{
		redirect('admin/myspotlight');		
	}
}
public function picture_res($sigment) {
	$filename = "";
	$target_path = base_url() . "uploads/res/";
	//print_r($_FILES['profile_pic']['name']); die;
	if ($_FILES['thumbnail']['name']!="") {
		$target_path = $target_path . basename($_FILES['thumbnail']['name']);
		$config['upload_path'] = './uploads/res/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size'] = '50000';	
		$this->load->library('upload', $config);
		$id = $sigment;
		$this->db->where('id',$id );
		$this->db->from('resources');
		$check_img = $this->db->get()->row();
		if (!$this->upload->do_upload('thumbnail')) {
				redirect('superadmin/resources');
		} else {
			//echo "picture uploaded successfully"; die();
			if($photo = $check_img->img){
				@unlink(FCPATH ."uploads/res/".$photo);
			}
			 $upload_data = $this->upload->data();
			$insData = array('img' => $upload_data['file_name']);
			$this->db->update('resources', $insData, array('id' => $id ));
			$this->session->set_flashdata('Insert Sucessfully', $sucess);
		   redirect('admin/resources');
		}
	}
	//print_r($formArray[));
	 redirect('admin/resources');
}
function add_resources(){
		$user_level =0;
		$user_id = $this->session->userdata('user_id');
		$user_level = $this->session->userdata('user_level');
		 $res_id = $this->uri->segment(3);
		 $site_id = site_id();
		if($user_id>0 && $user_level==1){
			 if($this->input->post('submit') == 1){
				$title = $this->input->post('title');
				$description = $this->input->post('description');
				
				$url = $this->input->post('url');
				if(isset($res_id)){
					$this->db->update('resources',array('title'=>$title,'site_id'=>$site_id,'description'=>$description,'link'=>$url),array('id'=>$res_id));
					 $this->picture_res($res_id);
					redirect('admin/resources');
				}else{
					$this->db->insert('resources',array('title'=>$title,'description'=>$description,'site_id'=>$site_id, 'link'=>$url,'created_at' => date('Y-m-d H:i:s')));
				   $sigment = $this->db->insert_id();
				    $this->picture_res($sigment);
					redirect('admin/resources');
				}
				
			 }
			$data['res'] = $this->db->get_where('resources',array('id'=>$res_id))->row();
			$data['page_type']='resources';
			$data['View'] = "admin/add_resources";
			$data['page_content'] = $this->load->view($data['View'], $data, true);
			$this->load->view('admin/layouts/dashboard', $data);
		}else{
			redirect('admin');
		}	
}
function delete_resources(){
		$user_id = $this->session->userdata('user_id');
		$user_level = $this->session->userdata('user_level');
	if($user_id>0 && $user_level==1){
		
	$rs_id =  $this->uri->segment(3);
		$this->db->where('id', $rs_id);
		$this->db->delete('resources');
		redirect('admin/resources');
	}else{
		redirect('admin');		
	}
}

function delete_user(){
		$user_id = $this->session->userdata('user_id');
		$user_level = $this->session->userdata('user_level');
	if($user_id>0 && $user_level==1){
		
	$user_id =  $this->uri->segment(3);
		$this->db->where('userID', $user_id);
		$this->db->delete('users');
		
		$this->db->where('user_id', $user_id);
		$this->db->delete('user_profile');
	redirect('admin/staff_users');
	}else{
		redirect('admin');		
	}
}
function display_image(){
	
	$spotlightid =  $this->uri->segment(3);
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
$imageid =  $this->uri->segment(3);

@unlink($this->input->post('file_name'));

$this->db->where('id', $imageid);
$this->db->delete('spotlights_images'); 
echo json_encode(array("status"=>"success"));
die();
}
	
	
	public function ajax_img_upload()
    {
        $data = $_POST['image'];
     
        list($type, $data) = explode(';', $data);
        list(, $data)      = explode(',', $data);
     	$this->db->from('users');
		$this->db->where('userID', $this->session->userdata('user_id'));
		$check_img = $this->db->get()->row();
		if($photo = $check_img->photo){
			@unlink(FCPATH ."uploads/profile_img/".$photo);
		}
        $data = base64_decode($data);
		
		if(!$check_img->photo && !$data){
			echo 'Please Upload Picture'; die;
		}else{
        $imageName = time().'.png';
        file_put_contents(FCPATH .'uploads/profile_img/'.$imageName, $data);
		$insData = array('photo' => $imageName);
        $this->db->update('users', $insData, array('userID' => $this->session->userdata('user_id')));
			echo 'Image Upload Suceessfully'; die;
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
	
	
	
	public function pictureUpload() {
        //checkpagelevel();
/*        $data['template'] = $this->template();
        $data['Title'] = "List | Officer Management | Administrator";
        $data['Meta'] = array(array('charset' => 'utf-8'), array('name' => 'viewport', 'content' => 'width=device-width, initial-scale=1'));
        $data['View'] = "officer/profileOfficer/" . $this->uri->segment(3);
        //$data['Retirementslist']  =    $this->officer_model->Retirementslist();
        $data['userrights'] = $this->usermanagement_model->userrights($this->session->userdata("loginid"), 4);
        $data['officerId'] = $this->uri->segment(3);*/
        $filename = "";
        $target_path = base_url() . "uploads/profile_img/";
//print_r($_FILES['profile_pic']['name']); die;
        
        if ($_FILES['profile_pic']['name']!="" || $this->input->post('profile_pic_edit')!="") {

            $target_path = $target_path . basename($_FILES['profile_pic']['name']);

            $config['upload_path'] = './uploads/profile_img/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = '1024';
            //$config['max_width']  = '1024';
            //$config['max_height']  = '768';

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('profile_pic')) {

                // print_r($this->upload->display_errors()); die();
            	if($this->input->post('profile_pic_edit')!=""){
            		redirect('login/complete_profile2/');
            	}else{
	                redirect('login/complete_profile');
	            }
            } else {
                //echo "picture uploaded successfully"; die();
				$this->db->where('userID', $this->session->userdata('user_id'));

				$this->db->from('users');
				$check_img = $this->db->get()->row();
				if($photo = $check_img->photo){
					@unlink(FCPATH ."uploads/profile_img/".$photo);
				}
				  $upload_data = $this->upload->data();
                $insData = array('photo' => $upload_data['file_name']);
                $this->db->update('users', $insData, array('userID' => $this->session->userdata('user_id')));
                redirect('login/complete_profile2/');
            }
        } else {
			$image_error = "picture not selected";
			$this->session->set_flashdata('image_error', $image_error);
          
        }
        //print_r($formArray[));
         redirect('login/complete_profile');
    }
}

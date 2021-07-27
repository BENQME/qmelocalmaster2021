<?php
// defined('BASEPATH') OR exit('No direct script access allowed');

class Superadmin extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->library('encryption');
		$this->load->library('email');
		$this->load->library("pagination");
		
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
			$this->db->where('level', 3);
			$this->db->from('users');
			$query = $this->db->get()->row();
			
			if($query) {
				//echo $this->db->last_query(); die();
				if($query->status ==2){
					$login_error ="Account has been Blocked now";
				}else{
				   if(md5($password) == $query->password) {
						// store session details
						$this->session->set_userdata("user_id", $query->userID);
						$this->session->set_userdata("user_level",3);
						$this->session->set_userdata("user_type", $query->user_type);
						if(!$this->session->userdata('online'))
						{
							$ip		= getenv('remote_addr');
							$this->session->set_userdata('online', TRUE);
							insertVisitor();
						}
					  redirect('superadmin/dashboard');
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
		$data['View'] = "superadmin/login";
		$data['page_content'] = $this->load->view($data['View'], $data, true);
		$this->load->view('superadmin/layouts/default', $data);
		//$this->load->view('enduser/login');
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
					'mailtype'  => 'html', 
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
				$body = str_replace('[url]',base_url()."superadmin/resetpass/".$check_data->verification_key, $body);
				$complete_html = str_replace('{{body}}',$body,$body_temp);
				$this->email->message($complete_html);
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
			$data['View'] = "superadmin/password_reset";
			$data['page_content'] = $this->load->view($data['View'], $data, true);
			$this->load->view('superadmin/layouts/default', $data);
		}
		if($this->input->post('submit')==1)
		{
			$data = array(
				'password' => md5($this->input->post('password')),
			);
			$this->db->update('users',$data, array('userID'=>$this->session->userdata('user_id')));
			redirect('superadmin');
		}

	}
	
	public function dashboard()
	{  
		$user_id = $this->session->userdata('user_id');
		$user_level = $this->session->userdata('user_level');
		
		if($user_id>0 && $user_level ==3){
			$this->db->where('userID', $user_id );
		    $this->db->from('users');
			$data['userinfo'] = $this->db->get()->row();
			$data['topic_cover'] =  $this->db->get('spotlights_category')->num_rows();
			
			$data['signup'] = $this->db->query("
			SELECT u.*
			
			FROM users u  WHERE  u.status=0 ")->result();
			
			$data['all'] = $this->db->query("
			SELECT s.*
			FROM spotlights s INNER JOIN users u ON s.userid=u.userID   WHERE s.status=1")->result();
			$data['promotions'] = $this->db->query("
			SELECT s.*,  
			u.site_id,
			u.userID 
			FROM spotlights s INNER JOIN users u ON s.userid=u.userID   WHERE  s.spotlight_type='Spotit Spotlight'  AND s.status=1 ")->result();
				 
				 $data['jobs'] = $this->db->query("
				  SELECT s.*, 
		u.userID
      
      FROM spotlights s INNER JOIN users u ON s.userid=u.userID   WHERE  s.spotlight_type='Job Posting'  AND s.status=1 ")->result();
	  $data['news'] = $this->db->query("
				  SELECT s.*,  
		u.userID
      
      FROM spotlights s INNER JOIN users u ON s.userid=u.userID   WHERE  s.spotlight_type='News / Blog'  AND s.status=1")->result();
	  
	  
	 $data['monthly_data']  = $this->db->query("SELECT s.userid, COUNT(s.`postID`) as total,YEAR(date(s.created_at)) as year,	u.site_id, 
		u.userID
					FROM spotlights s 
					INNER JOIN users u ON s.userid=u.userID  
					WHERE s.status=1 
					GROUP BY YEAR(date(s.created_at))")->result();
	  
	 
				$data['relevant'] = $this->db->query("SELECT s.*, u.userID
				  FROM spotlights s 
				  	INNER JOIN users u ON s.userid=u.userID
					 WHERE s.status=1")->result();				  
			$data['View'] = "admin/dashboard";
				 $data['users'] = $this->db->query("SELECT u.*, ad.id,ad.url,ad.domain,ad.site_name FROM users u 
			INNER JOIN admin_urls ad ON u.site_id=ad.id WHERE (u.user_type IS NULL) AND (u.level=1) ORDER BY ad.id DESC")->result();
				//$this->db->last_query(); die;
				$data['page_type']='user_deshboard';
			$data['View'] = "superadmin/dashboard";
			
			$data['page_content'] = $this->load->view($data['View'], $data, true);
			$this->load->view('superadmin/layouts/dashboard', $data);
		}else{
			redirect('superadmin');
		}
    }
	function user_list(){
$user_level =0;

		$user_id = $this->session->userdata('user_id');
		$user_level = $this->session->userdata('user_level');
	if($user_id>0 && $user_level==3){
		$site_id = site_id();
			$data['page_type']='user_list';
			 $data['users'] = $this->db->query("SELECT  u.userID,
				u.first_name,
				u.last_name,
				u.photo,
				u.status,
				up.*,
				FROM users u 
				INNER JOIN user_profile up ON up.user_id=u.userID  
				
				 WHERE 1=1 AND up.complete_profile=1 AND u.userID!=".$user_id." ORDER BY u.userID ASC")->result();
			$data['View'] = "admin/users";
			$data['page_content'] = $this->load->view($data['View'], $data, true);
			$this->load->view('admin/layouts/dashboard', $data);
		
		}else{
			redirect('admin');
		}
	}
		function add_password(){
		//echo 'ddddddddddd'; die;
		    $user_id=0;
			$sigment = $this->uri->segment(3);
			if(isset($_GET['user_id']))$user_id = $_GET['user_id'];
			$data['View'] = "superadmin/add_pw";
			//$this->db->
			//if($sigment  )
			$check_value = $this->db->get_where('users',array('verification_key'=>$sigment,'userID'=>$user_id))->row();
			if($user_id && $sigment){
				
				$data['error']=0;
				
			}elseif($check_value){
				$data['error'] ='Invalid Verification Code';
			}else{
				$data['error'] ='Invalid Verification Code';
			}
			
			
			if($this->input->post('submit') ==1){
				$password = $this->input->post('password');
				$uid = $this->input->post('user_id');
				//echo $uid ; die;
				$this->db->update('users',array('password'=>md5($password)), array('userID' =>$uid));
				$check_value2 = $this->db->get_where('users',array('userID'=>$uid))->row();
				$site_data = $this->db->get_where( 'admin_urls',array('id'=>$check_value2->site_id))->row();
				//print_r($site_data); die;
				if(isset($site_data->domain) && $site_data->domain){
					redirect($site_data->domain.'/admin');
				}else{
					redirect($site_data->url.'/admin');
				}
				$this->session->set_flashdata('success', 'Password Set Successfully');
			}
			$data['page_content'] = $this->load->view($data['View'], $data, true);
			$this->load->view('superadmin/layouts/default', $data);
	}
	function add_content(){
		$portal_id = $this->uri->segment(3);
		$user_id = $this->session->userdata('user_id');
		$id_array = array();
		if($spotlights = $this->db->get_where('spotlights',array('userid'=>$user_id))->result())
		{
			foreach($spotlights as $spotlight){
				$this->db->insert('region_spotlights', array('web_id'=>$portal_id,'spotlight_id'=>$spotlight->postID));
			}
		}
	$this->session->set_flashdata('success', 'User created Successfull');
		redirect('superadmin/portal_list');
	}
	function portal_list(){
		$user_id = $this->session->userdata('user_id');
		$user_level = $this->session->userdata('user_level');
		$site_id = $this->uri->segment(3);
		if($user_id>0 && $user_level==3){
			$data['users'] = $this->db->query("SELECT u.*, ad.id,ad.url,ad.domain,ad.site_name FROM users u 
			INNER JOIN admin_urls ad ON u.site_id=ad.id WHERE (u.user_type IS NULL) AND (u.level=1) ORDER BY ad.id DESC")->result();
		$data['page_type']='user_list';
		$data['View'] = "superadmin/portal_list";
		$data['page_content'] = $this->load->view($data['View'], $data, true);
		$this->load->view('superadmin/layouts/dashboard', $data);

		}else{
			redirect('superadmin');
		}
	}
	function add_portal_step2(){
		$user_id = $this->session->userdata('user_id');
		$user_level = $this->session->userdata('user_level');
		$site_id = $this->uri->segment(3);
		if($user_id>0 && $user_level==3){
			$data['View'] = "superadmin/portal2";
			$data['page_content'] = $this->load->view($data['View'], $data, true);
			$this->load->view('superadmin/layouts/dashboard', $data);
		}else{
			redirect('superadmin');
		}
	}
	function add_zip(){
		$data['portal_info']="";
		$user_id = $this->session->userdata('user_id');
		$user_level = $this->session->userdata('user_level');
		$site_id = $this->uri->segment(3);
		if($user_id>0 && $user_level==3){
			$web_id =  $this->input->post('web_id');
			$zip_code = $this->input->post('zip_code');
			$dataa = array('site_id' =>$web_id,'zip_code'=>$zip_code);
             $this->db->insert('zip_codes',$dataa);
			 	$this->session->set_flashdata('success2', 'Zipcode Added Successfully');
			redirect('superadmin/add_portal/'.$web_id.'#success2');
		}else{
			redirect('superadmin');
		}
	}
	function delete_zip(){
	$user_id = $this->session->userdata('user_id');
	$user_level = $this->session->userdata('user_level');
	if($user_id>0 && $user_level==3){
	$zip_id =  $this->uri->segment(3);
		$this->db->where('id', $zip_id);
		$this->db->delete('zip_codes');
		$this->session->set_flashdata('success3', 'Zipcode Deleted Successfully');
	redirect('superadmin/add_portal/'.$_GET['site_id'].'#success3');
	}else{
		redirect('superadmin');		
	}
}
	function add_adminuser(){
		$verification_key = md5(rand());
		$first_name = $this->input->post('first_name');
		$last_name = $this->input->post('last_name');
		$email = $this->input->post('user_email');
		$site_id = $this->input->post('web_id');
		$user_password = $this->input->post('user_password');
		$this->db->insert('users',array('first_name'=>$first_name,'last_name'=>$last_name,'verification_key'=>$verification_key, 'email'=>$email,'is_email_verified'=>1,'photo'=>'def.jpg','password'=>md5($user_password),'level'=>'1', 'user_type'=>2,'site_id'=>$site_id));
		 $user_id = $this->db->insert_id();
		$this->db->insert('user_profile',array('user_id'=>$user_id,'complete_profile'=>1));
		redirect('superadmin/add_portal/'.$site_id.'#success44');
	}
	function delete_adminuser(){
		$user_id = $this->uri->segment(3);
		$this->db->delete('users',array('userID'=>$user_id));
		$this->db->delete('user_profile',array('user_id'=>$user_id));
		redirect('superadmin/add_portal/'.$_GET['site_id'].'#success55');
	}
	function add_portal(){
		$data['portal_info']="";
		$user_id = $this->session->userdata('user_id');
		$user_level = $this->session->userdata('user_level');
		$site_id = $this->uri->segment(3);
		if($user_id>0 && $user_level==3){
			
			
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
				$data = array(
					'site_name' => $this->input->post('portal_name'),
					'slug' => $this->input->post('region'),
					'zip_code' => $this->input->post('zip_code'),
					'url' => $this->input->post('url'),
					'domain' => $this->input->post('domain'),
				);
				$first_name = $this->input->post('f_name');
				$last_name = $this->input->post('l_name');
				$email = $this->input->post('email');
				$web_id = $this->input->post('web_id');
				if($this->input->post('submit') ==1){
					if(isset($web_id)){
						$this->db->update('admin_urls',$data, array('id' => $web_id));
						$user_idd = $this->input->post('user_idd');
						$this->db->update('users',array('first_name'=>$first_name,'last_name'=>$last_name),array('userID'=>$user_idd));
						redirect('superadmin/portal_list');
					}else{
					
					
					
					$this->load->library('form_validation');
						//$this->form_validation->set_rules('first_name', '', 'trim|required|xss_clean');
						 $this->form_validation->set_rules('email', $this->input->post('email'), 'required|trim|valid_email|is_unique[users.email]',
						array(
							 'is_unique'     => 'This email already exists.'
							)
						);
					
					if($this->form_validation->run()) {
							$status = array('created_at' => date('Y-m-d H:i:s'));
							$this->db->insert('admin_urls',array_merge($status,$data));
							$site_id = $this->db->insert_id();
							$verification_key = md5(rand());
							 $this->db->insert('users',array('first_name'=>$first_name,'last_name'=>$last_name,'verification_key'=>$verification_key, 'email'=>$email,'is_email_verified'=>1,'photo'=>'def.jpg','level'=>'1','site_id'=>$site_id));
							 $user_id = $this->db->insert_id();
							$this->db->insert('user_profile',array('user_id'=>$user_id,'complete_profile'=>1));
							
							$email_template =email_template('create_portal');
							$this->email->from(email_setting('from_mail'), $email_template->subject);
							$this->email->to($email);
							$this->email->subject($email_template->subject);
							$body =$email_template->template;
							$body = str_replace('[name]',$first_name.' '.$last_name,$body);
							$body = str_replace('[url]',"<a href='".base_url()."superadmin/add_password/".$verification_key."?user_id=".$user_id."'>Click here to add password</a>",$body);
							$this->email->message($body);
							$this->email->send();
							$login_error ="Email Sent successfully.";
						redirect('superadmin/add_portal_step2/'.$site_id);
					}else{
						
					}
					}
				}
				if($site_id){
				$data['portal_info'] = $this->db->query("SELECT u.*, ad.id,ad.url,ad.domain,ad.site_name, ad.zip_code FROM users u INNER JOIN admin_urls ad ON u.site_id=ad.id WHERE u.level=1 AND  ad.id=".$site_id)->row();
				}
		$data['page_type']='user_list';
				$data['View'] = "superadmin/portal";
				$data['page_content'] = $this->load->view($data['View'], $data, true);
				$this->load->view('superadmin/layouts/dashboard', $data);
		}else{
				redirect('superadmin');
			}
	}
	
	
	function add_staff(){
		$user_level =0;

	$user_id = $this->session->userdata('user_id');
	$user_level = $this->session->userdata('user_level');
	if($user_id>0 && $user_level==3){
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
				'level' => '3',
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
				$this->session->set_flashdata('success', 'User created Successfull');
				redirect('superadmin/staff_users');
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
			$data['View'] = "superadmin/add_staff_users";
			$data['page_content'] = $this->load->view($data['View'], $data, true);
			$this->load->view('superadmin/layouts/dashboard', $data);
		
		}else{
			redirect('superadmin');
		}
	}
	function staff_users(){
	$user_level =0;

	$user_id = $this->session->userdata('user_id');
	$user_level = $this->session->userdata('user_level');
	if($user_id>0 && $user_level==3){
		$site_id = site_id();
			$data['page_type']='user_list';
			 $data['users'] = $this->db->query("SELECT  u.* 
				FROM users u 				
				 WHERE  u.user_type=1 AND u.level=3 ORDER BY u.userID ASC")->result();
			$data['View'] = "superadmin/staff_users";
			$data['page_content'] = $this->load->view($data['View'], $data, true);
			$this->load->view('superadmin/layouts/dashboard', $data);
		
		}else{
			redirect('superadmin');
		}
	}

	function mychart(){
    	header('Content-Type: application/json');
    	$user_id = $this->session->userdata('user_id');
		if($user_id>0){
    	$user_montly = $this->db->query("SELECT s.userid, COUNT(s.`postID`) as total,MONTH(date(s.created_at)) as month
					FROM spotlights s 
					WHERE s.status=1 
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
	function activities(){
		$user_level =0;
		$user_id = $this->session->userdata('user_id');
		$user_level = $this->session->userdata('user_level');
	if($user_id>0 && $user_level==3){
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
				(SELECT count(likeID) FROM likes l WHERE l.userID=".$user_id." AND s.postID=l.itemID) AS likecount
				  FROM spotlights s INNER JOIN users u ON s.userid=u.userID  WHERE s.status=1 ".$where_filter." ".$search_filter)->num_rows();
		    
           /*if(!empty($this->input->get('search'))){ 
           		$url_sigment='all';
		   }else{
				$url_sigment= $url_sigment;
		   }*/
			$config = array();
			$config["base_url"] = base_url()."superadmin/activities/". $url_sigment;
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
				(SELECT count(likeID) FROM likes l WHERE l.userID=".$user_id." AND s.postID=l.itemID) AS likecount
				  FROM spotlights s INNER JOIN users u ON s.userid=u.userID  WHERE s.status=1 ".$where_filter." ".$search_filter." ORDER BY s.created_at DESC limit ".$config["per_page"]." OFFSET ".$page)->result_array();
				  
				  
				  
				  
      $data['news_total'] = $this->db->query("SELECT s.*, 
      	u.site_id
      
      FROM spotlights s INNER JOIN users u ON s.userid=u.userID 
      WHERE  s.spotlight_type='News / Blog'  AND s.status=1 ".$search_filter)->num_rows();
				  
				  
				  
	   $data['job_total'] = $this->db->query("SELECT s.*,  
	   	u.site_id 
      
      FROM spotlights s INNER JOIN users u ON s.userid=u.userID   WHERE  s.spotlight_type='Job Posting'  AND s.status=1 ".$search_filter)->num_rows();
				  
				  
				  
     $data['event_total'] = $this->db->query("SELECT s.*, u.site_id FROM spotlights s INNER JOIN users u ON s.userid=u.userID WHERE s.spotlight_type='Events' AND s.status=1 ".$search_filter)->num_rows();
				  
				  
				  
				  
			  $data['spotit_total'] = $this->db->query("SELECT s.*, u.site_id FROM spotlights s INNER JOIN users u ON s.userid=u.userID  WHERE s.spotlight_type='Spotit Spotlight' AND s.status=1 ".$search_filter)->num_rows();

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
			$data['View'] = "superadmin/activities";
			$data['page_content'] = $this->load->view($data['View'], $data, true);
			$this->load->view('superadmin/layouts/dashboard', $data);
		}else{
			redirect('admin');
		}	
	}
function resources(){
		$user_level =0;
		$user_id = $this->session->userdata('user_id');
		$user_level = $this->session->userdata('user_level');
		if($user_id>0 && $user_level==3){
			
			$data['resources'] = $this->db->order_by('created_at','desc')->get('resources')->result();
			$data['page_type']='resources';
			$data['View'] = "superadmin/resources";
			$data['page_content'] = $this->load->view($data['View'], $data, true);
			$this->load->view('superadmin/layouts/dashboard', $data);
		}else{
			redirect('superadmin');
		}	
}
function add_resources(){
		$user_level =0;
		$user_id = $this->session->userdata('user_id');
		$user_level = $this->session->userdata('user_level');
		 $res_id = $this->uri->segment(3);
		if($user_id>0 && $user_level==3){
			 if($this->input->post('submit') == 1){
				$title = $this->input->post('title');
				$description = $this->input->post('description');
				$url = $this->input->post('url');
				if(isset($res_id)){
					$this->db->update('resources',array('title'=>$title,'description'=>$description,'link'=>$url),array('id'=>$res_id));
					 $this->picture_res($res_id);
					redirect('superadmin/resources');
				}else{
					$this->db->insert('resources',array('title'=>$title,'description'=>$description,'link'=>$url,'created_at' => date('Y-m-d H:i:s')));
				   $sigment = $this->db->insert_id();
				    $this->picture_res($sigment);
					redirect('superadmin/resources');
				}
				
			 }
			$data['res'] = $this->db->get_where('resources',array('id'=>$res_id))->row();
			$data['page_type']='resources';
			$data['View'] = "superadmin/add_resources";
			$data['page_content'] = $this->load->view($data['View'], $data, true);
			$this->load->view('superadmin/layouts/dashboard', $data);
		}else{
			redirect('superadmin');
		}	
}
function delete_resources(){
		$user_id = $this->session->userdata('user_id');
		$user_level = $this->session->userdata('user_level');
	if($user_id>0 && $user_level==3){
		
	$rs_id =  $this->uri->segment(3);
		$this->db->where('id', $rs_id);
		$this->db->delete('resources');
		redirect('superadmin/resources');
	}else{
		redirect('superadmin');		
	}
}

function delete_user(){
		$user_id = $this->session->userdata('user_id');
		$user_level = $this->session->userdata('user_level');
	if($user_id>0 && $user_level==3){
		
	$user_id =  $this->uri->segment(3);
		$this->db->where('userID', $user_id);
		$this->db->delete('users');
		
		$this->db->where('user_id', $user_id);
		$this->db->delete('user_profile');
	redirect('superadmin/staff_users');
	}else{
		redirect('superadmin');		
	}
}
function delete_portal(){
	$user_id = $this->session->userdata('user_id');
	$user_level = $this->session->userdata('user_level');
	if($user_id>0 && $user_level==3){
		 $user_id =  $this->uri->segment(3);
		$site_id = $this->db->get_where('users',array('userID'=>$user_id))->row()->site_id;
		$this->db->where('id', $site_id);
		$this->db->delete('admin_urls');
		
		$this->db->where('web_id', $site_id);
		$this->db->delete('region_spotlights');
		
	
		$this->db->where('userID', $user_id);
		$this->db->delete('users');
		
		$this->db->where('user_id', $user_id);
		$this->db->delete('user_profile');
		$this->session->set_flashdata('sucesess', 'Portal Deleted Sucessfully');
		
	redirect('superadmin/portal_list');
	}else{
		redirect('superadmin');		
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
	    redirect('superadmin');
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
		   redirect('superadmin/resources');
		}
	}
	//print_r($formArray[));
	 redirect('superadmin/resources');
}
	
	
	public function pictureUpload() {
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

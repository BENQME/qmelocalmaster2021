<?php
// defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->library('encryption');
		$this->load->library('email');
        $this->load->model('enduser/login_model');
       
    }

	public function index()
	{   
	//if($_POST){print_r($_POST); die;}
	   if(isset($_GET['redirect']) && $_GET['redirect']){
		   $this->session->set_userdata('redirect', $_GET['redirect']);
	   }
		$this->form_validation->set_rules('email', 'Email Address', 'required|trim|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required|trim');
        if($this->form_validation->run()) {
            //$result = $this->login_model->can_login($this->input->post('email'), $this->input->post('password'));
			$email = $this->input->post('email');
			$password = $this->input->post('password');
			$this->db->where('email', $email);
			/*$this->db->where('level', 0);
			$this->db->where('site_id', site_id());
			$this->db->from('users');
			$query = $this->db->get()->row();*/
			$query = $this->db->get_where('users',array('email'=>$email,'level'=>0,'site_id'=>site_id()))->row();
			if($query) {
				//echo $this->db->last_query(); die();
				if($query->is_email_verified == 'no') {
					$login_error ="please verify your Email Address<br>
					<a href='".base_url('register/resend_email?email='.$email)."'>resend email</a>";
				}elseif($query->status == '2'){
					$login_error ="Your Account Has Been Suspended";
				}else{
					//echo "md5($password) == $query->password"; die;
				   if(md5($password) == $query->password) {
                        // store session details
				   		$this->session->set_userdata("user_id", $query->userID);
						
						if(!$this->session->userdata('online'))
						{
							$ip		= getenv('remote_addr');
							$this->session->set_userdata('online', TRUE);
							insertVisitor();
						}
						
						
						$complete_check = $this->db->get_where('user_profile', array('user_id' => $this->session->userdata('user_id')))->row()->complete_profile;
						
						
			   		if($complete_check == 1){
						$redirect = $this->session->userdata('redirect');
						if($redirect){
							$this->session->unset_userdata('redirect');
							redirect($redirect);
						}else{
							redirect('dashboard/activities/all');
						}
						}else{
						redirect('login/complete_profile');
						}
                    } else {
                        $login_error ="Invalid Email or passoword";
                    }
                 	
				}
            } else {
				
				$login_error ="Invalid Email or passoword";
                
                
            }
			$this->session->set_flashdata('login_error', $login_error);
		} 
		$data['View'] = "enduser/login";
		$data['page_content'] = $this->load->view($data['View'], $data, true);
		$this->load->view('enduser/layouts/default', $data);
		//$this->load->view('enduser/login');
    }
	public function check_zip(){
		//print_r($_GET['zip_code']);
		//echo 'Your Business must have '.site_info().' Address to Register on '.site_info().' Local Business Portal .';
		$check_zip = $this->db->get_where('zip_codes',array('zip_code'=>$_GET['zip_code'] ,'site_id'=>site_id()))->num_rows();
		if($check_zip>0){
		echo(json_encode(true));
		}else{
			echo(json_encode(false));
		}
		  exit;
	}
	public function reset_password(){
		$data['View'] = "enduser/reset_pw";
		
		
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
				  $site_detail = site_detail();
			if($site_detail->domain){
				$home_url =$site_detail->domain.'/home';
			}else{
				$home_url =$site_detail->url.'/home';
			}
				$logo_settings = site_settings('logo_settings');
	 $settings_array = json_decode($logo_settings);
	 if($settings_array->logo2){
		$logoo = $settings_array->logo2;
	 }else{
		 $logoo = $settings_array->logo;
	 }
	 $logo_html = '<div class="style="text-align-center; margin-bottom:20px"><img style="text-align: center;
    display: block;
    margin: 0 auto;" src="'.base_url().'uploads/banners/'.$logoo.'" style="max-width:250px; margin-bottom:20px" /></div><br><br>';
				$e_template = email_template('reset_password');
				$body = $e_template->template;
				$body_temp = $this->db->get_where('settings',array('siteID'=>1))->row()->general_template;
				$body_temp =str_replace('[email]',$site_detail->email,$body_temp);
				$body_temp =str_replace('[home_url]',$home_url,$body_temp);
				$body =str_replace('[logo]',$logo_html,$body);
				$body = str_replace('[name]',$check_data->first_name.' '.$check_data->last_name, $body);
				$body =str_replace('[site_title]',strtoupper(site_info()),$body);
				$body = str_replace('[url]',base_url()."login/resetpass/".$check_data->verification_key, $body);
				$complete_html = str_replace('{{body}}',$body,$body_temp);
				
				 $this->email->initialize($config);
				   $this->email->set_newline("\r\n");
				$e_template = email_template('reset_password');
	            $this->email->from(email_setting('from_mail'), $e_template->subject);
	            $this->email->to($check_data->email);
	            $this->email->subject($e_template->subject);
				$this->email->message($complete_html);
				
				
/*				
				$linkk ="<a href='".base_url()."login/resetpass/".$check_data->verification_key."' >Click here to reset password</a>";
				$body = str_replace('[name]',$check_data->first_name.' '.$check_data->last_name, $body);
				$body = str_replace('[link]',$linkk, $body);
				$body = str_replace('[url]',base_url()."login/resetpass/".$check_data->verification_key, $body);
	            $email_body = $body;
	            $this->email->message($email_body);*/
	            $this->email->send();
				//var_dump($this->email->print_debugger());
	            $login_error ="Email Sent successfully.";
	            
			}else{
				$login_error ="Invalid Email.";
			}
			$this->session->set_flashdata('login_error', $login_error);
		}
		$data['page_content'] = $this->load->view($data['View'], $data, true);
		$this->load->view('enduser/layouts/default', $data);
	}
	public function resetpass(){
		$verifykey = $this->uri->segment(3);

		$this->db->where('verification_key', $verifykey );
	    $this->db->from('users');
		$check_data = $this->db->get()->row();
		//print_r($check_data);
		//echo $this->db->last_query();exit;
		if(count($check_data)>0)
		{
			$this->session->set_userdata("user_id", $check_data->userID);
			$data['View'] = "enduser/password_reset";
			$data['page_content'] = $this->load->view($data['View'], $data, true);
			$this->load->view('enduser/layouts/default', $data);
		}
		if($this->input->post('submit')==1)
		{
			//print_r($this->input->post('password')); die;
		
			$sodaa = array('password' => md5($this->input->post('password')));
			$this->db->where('userID', $this->session->userdata('user_id'));
			$status = $this->db->update('users',$sodaa);
			$this->session->set_flashdata('success', 'Password Reset Sucessfully');
			redirect('login');
		}

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
	public function complete_profile()
	{
		if($_FILES){
		$this->pictureUpload();
		}
		$this->db->where('userID', $this->session->userdata('user_id'));
	    $this->db->from('users');
		$check_img = $this->db->get()->row();
		$data['facebook_photo'] = $check_img->facebookUID;
		$data['profile_img'] = $check_img->photo;
		/*if(!isset($_GET['page']) && $check_img->photo){
			 redirect('login/complete_profile2');
		}else{*/
			$data['View'] = "enduser/complete_profile";
			$data['page_type']='complete_profile';
			$data['page_content'] = $this->load->view($data['View'], $data, true);
			$this->load->view('enduser/layouts/default', $data);
		/*}*/
		// print_r($this->session->all_userdata()); die;
		 
		// print_r($_FILES);
		 
		 //profile_pic
		
    }
	
	public function complete_profile2(){
		$user_id = $this->session->userdata('user_id');
		 $this->db->where('user_id', $user_id );
	    $this->db->from('user_profile');
		$check_data = $this->db->get()->row();
		$about="";
		if(count($check_data)>0)
		{
			 $data['about'] = $check_data->about;
			 $about = $check_data->about;
		}
		if($this->input->post('about')){
			$data = array(
				'about' => $this->input->post('about'),
				'user_id' => $user_id,
			);
			
           if($about){
			   $this->db->update('user_profile',$data, array('user_id'=>$user_id));
			   redirect('login/complete_profile3');
		   }else{
			$this->db->insert('user_profile',$data);
			redirect('login/complete_profile3');
		   }
			
		}
		/*if(!isset($_GET['page']) && $about){
			 redirect('login/complete_profile3');
		}else{*/
			$data['View'] = "enduser/complete_profile2";
			$data['page_type']='complete_profile2';
			 $data['page_content'] = $this->load->view($data['View'], $data, true);
			 $this->load->view('enduser/layouts/default', $data);
		/*}*/
	}
	

	public function complete_profile3(){
		$user_id = $this->session->userdata('user_id');
		 $this->db->where('user_id', $user_id );
	    $this->db->from('user_profile');
		$check_data = $this->db->get()->row();

		$preferences="";
		
			$data['preferences'] = $check_data->preferences;
		
		if(count($check_data)>0 && $this->input->post('submit')==1)
		{
			$this->form_validation->set_rules('preferences[]', 'Preferences', 'required|trim');
			$this->form_validation->set_message('required', '<span class="error text-center" style="display: block;
    color: red;
">You must select at least one preference</span>');
			if($this->form_validation->run()) {
				 $data['preferences'] = $check_data->preferences;
				 $preferences = $check_data->preferences;
				$data = array(
					'preferences' => json_encode($this->input->post('preferences')),
					
				);	
			   
			   $this->db->update('user_profile',$data, array('user_id'=>$user_id));
			   if(special_cms()){
				    $this->db->update('user_profile',array('complete_profile'=>1), array('user_id'=>$user_id));
					
				   redirect('dashboard/activities/all');
			   }else{
				redirect('login/complete_profile4');
			   }
			}
	   }
			
		
		/*if(!isset($_GET['page']) && $preferences){
			 redirect('login/complete_profile4');
		}else{*/
		$data['View'] = "enduser/complete_profile3";
		$data['page_type']='complete_profile';
		$data['page_content'] = $this->load->view($data['View'], $data, true);
		$this->load->view('enduser/layouts/default', $data);
		/*}*/
	}

	public function complete_profile4(){
		$user_id = $this->session->userdata('user_id');
		 $this->db->where('user_id', $user_id );
	    $this->db->from('user_profile');
		$check_data = $this->db->get()->row();

		$has_business="";
		
		$data['has_business'] = $check_data->has_business;
		
		if(count($check_data)>0 && $this->input->post('has_business')==1)
		{
			$data['has_business'] = $check_data->has_business;
			$has_business = $check_data->has_business;
			$data = array(
				'has_business' => $this->input->post('has_business'),
				
			);	
           
		   $this->db->update('user_profile',$data, array('user_id'=>$user_id));
		    redirect('login/onboard');
	   }
		/*if(!isset($_GET['page']) && $preferences){
			 redirect('login/complete_profile4');
		}else{*/
		$data['View'] = "enduser/complete_profile4";
		$data['page_type']='complete_profile';
		$data['page_content'] = $this->load->view($data['View'], $data, true);
		$this->load->view('enduser/layouts/default', $data);
		/*}*/
	}

	public function onboard(){
		$user_id = $this->session->userdata('user_id');
		$this->db->where('user_id', $user_id );
	    $this->db->from('user_profile');
		$check_data = $this->db->get()->row();
		$data['b_form'] = $check_data;
		$has_business="";
		
		$data['has_business'] = $check_data->has_business;
		
		if($check_data && $this->input->post('submit')==1)
		{

			$data['has_business'] = $check_data->has_business;
			$has_business = $check_data->has_business;
			$data = array(
				'business_email' => $this->input->post('business_email'),
				'business_name' => $this->input->post('business_name'),
				'about_bussiness' => $this->input->post('about_bussiness'),
				'b_mission' => $this->input->post('b_mission'),
				'b_address' => $this->input->post('b_address'),
				'phone' => $this->input->post('phone'),
				'website' => $this->input->post('website'),
				'facebook' => $this->input->post('facebook'),
				'twitter' => $this->input->post('twitter'),
				'instagram' => $this->input->post('instagram'),
				'zip_code' => $this->input->post('zip_code'),
				'linkedin' => $this->input->post('linkedin'),
				'resources' =>  implode("|",$this->input->post('resources')),
				
				'designation' => $this->input->post('designation')	
			);	
           
		   $this->db->update('user_profile',$data, array('user_id'=>$user_id));
		    redirect('login/onboard2');
	   }
		/*if(!isset($_GET['page']) && $preferences){
			 redirect('login/complete_profile4');
		}else{*/
		$data['View'] = "enduser/onboard";
		$data['page_type']='complete_profile';
		$data['page_content'] = $this->load->view($data['View'], $data, true);
		$this->load->view('enduser/layouts/dashboard', $data);
		//$this->load->view('enduser/layouts/default', $data);
		/*}*/
	}

	public function onboard2(){
		//print_r($_POST);exit;
		$user_id = $this->session->userdata('user_id');
		$this->db->where('user_id', $user_id );
	    $this->db->from('user_profile');
		$check_data = $this->db->get()->row();
		$data['b_form'] = $check_data;
		$has_business="";
		
		$data['has_business'] = $check_data->has_business;
		
		if(count($check_data)>0 && $this->input->post('submit')==1)
		{

			$data['has_business'] = $check_data->has_business;
			$has_business = $check_data->has_business;
			$data = array(
				'industry' => $this->input->post('industry'),
				'b_services' => $this->input->post('b_services'),
				'services' => json_encode($this->input->post('services')),
				'expand_area' => json_encode($this->input->post('expand_area')),
				'years' => $this->input->post('years'),
				'employees_num' => $this->input->post('employees_num'),
				'revenue' => $this->input->post('revenue'),
				'certified' => json_encode($this->input->post('certified')),
				'is_member' => $this->input->post('is_member'),
				'certifications' => $this->input->post('certifications'),
				'awards' => $this->input->post('awards'),
					
			);	
           
		   $this->db->update('user_profile',$data, array('user_id'=>$user_id));
		    redirect('login/onboard3');
	   }
		/*if(!isset($_GET['page']) && $preferences){
			 redirect('login/complete_profile4');
		}else{*/
		$data['View'] = "enduser/onboard2";
		$data['page_type']='onboard2';
		$data['page_content'] = $this->load->view($data['View'], $data, true);
		$this->load->view('enduser/layouts/dashboard', $data);
		//$this->load->view('enduser/layouts/default', $data);
		/*}*/
	}

	public function onboard3(){
		//print_r($_POST);exit;
		$user_id = $this->session->userdata('user_id');
		$this->db->where('user_id', $user_id );
	    $this->db->from('user_profile');
		$check_data = $this->db->get()->row();
		$data['b_form'] = $check_data;
		$has_business="";
		
		$data['has_business'] = $check_data->has_business;
		
		if(count($check_data)>0 && $this->input->post('submit')==1)
		{

			$data['has_business'] = $check_data->has_business;
			$has_business = $check_data->has_business;
			$data = array(
				'NAICS' => $this->input->post('NAICS'),
				'EIN' => $this->input->post('EIN'),
				'DUNS' => $this->input->post('DUNS'),
				'SAM' => $this->input->post('SAM'),
				'cage' => $this->input->post('cage'),
				'complete_profile'=>1
					
			);	
           
		   $this->db->update('user_profile',$data, array('user_id'=>$user_id));
		  redirect('dashboard');
	   }
		/*if(!isset($_GET['page']) && $preferences){
			 redirect('login/complete_profile4');
		}else{*/
		$data['View'] = "enduser/onboard3";
		$data['page_type']='onboard3';
		$data['page_content'] = $this->load->view($data['View'], $data, true);
		$this->load->view('enduser/layouts/dashboard', $data);
		//$this->load->view('enduser/layouts/default', $data);
		/*}*/
	}

	public function onboard4(){
		//print_r($_POST);exit;
		$user_id = $this->session->userdata('user_id');
		$this->db->where('user_id', $user_id );
	    $this->db->from('user_profile');
		$check_data = $this->db->get()->row();
		$data['b_form'] = $check_data;
		$has_business="";
		
		$data['has_business'] = $check_data->has_business;
		
		if(count($check_data)>0 && $this->input->post('submit')==1)
		{

			$data['has_business'] = $check_data->has_business;
			$has_business = $check_data->has_business;
			$data = array(
				'NAICS' => $this->input->post('NAICS'),
				'EIN' => $this->input->post('EIN'),
				'DUNS' => json_encode($this->input->post('DUNS')),
				'SAM' => json_encode($this->input->post('SAM')),
				'cage' => $this->input->post('cage'),
				
					
			);	
           
		   $this->db->update('user_profile',$data, array('user_id'=>$user_id));
		    redirect('login/onboard5');
	   }
		/*if(!isset($_GET['page']) && $preferences){
			 redirect('login/complete_profile4');
		}else{*/
		$data['View'] = "enduser/onboard4";
		$data['page_type']='onboard4';
		$data['page_content'] = $this->load->view($data['View'], $data, true);
		$this->load->view('enduser/layouts/default', $data);
		if(isset($_GET['skip']) && ($_GET['skip'] == 1)){
			$this->db->update('user_profile',array('complete_profile'=>1), array('user_id'=>$user_id));
			redirect('dashboard');
		}
		/*}*/
	}

    /*public function validate() {
		$this->form_validation->set_rules('user_email', 'Email Address', 'required|trim|valid_email');
        $this->form_validation->set_rules('user_password', 'Password', 'required|trim');

        if($this->form_validation->run()) {
            $result = $this->login_model->can_login($this->input->post('user_email'), $this->input->post('user_password'));
            if($result == '') {
                redirect('enduser/dashboard');
            } else {
                $this->session->set_flashdata('message', $result);
                redirect('enduser/login');
            }
		} else {
			$this->index();
		}

    }*/


   

}

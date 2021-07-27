<?php
// defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->library('encryption');
		$this->load->library('email');
		$this->load->model('enduser/register_model');
	}

	public function index()
	{
		//echo "ddddddddddddddddd"; die;
		 //$data['template'] = $this->template();
         
		 //print_r($_POST);
		$this->load->library('form_validation');
		//$this->form_validation->set_rules('first_name', '', 'trim|required|xss_clean');
		 $this->form_validation->set_rules('email', $this->input->post('email'), 'required|trim|valid_email|is_unique[users.email]',
		array(
			 'is_unique'     => 'This email already exists.'
			)
		);
		
		 
		if($this->form_validation->run()) {
			$verification_key = md5(rand());
			$data = array(
				'first_name' => $this->input->post('first_name'),
				'last_name' => $this->input->post('last_name'),
				'email' => $this->input->post('email'),
				'password' => md5($this->input->post('password')),
				'verification_key' => $verification_key,
				'is_email_verified' => 'no',
				'created_at'=>date('Y-m-d H:i:s'),
				'site_id' =>site_id()
			);

			$this->db->insert('users',$data);

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
			$site_detail = site_detail();
			if($site_detail->domain){
				$home_url =$site_detail->domain.'/home';
			}else{
				$home_url =$site_detail->url.'/home';
			}
			$activate_account = email_template('activate_account');
            $this->email->from(email_setting('from_mail'), $activate_account->subject);
            $this->email->to($this->input->post('email'));
            $this->email->subject($activate_account->subject);
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
			$body = $activate_account->template;
			$body_temp = $this->db->get_where('settings',array('siteID'=>1))->row()->general_template;
			$body_temp =str_replace('[email]',$site_detail->email,$body_temp);
			$body_temp =str_replace('[home_url]',$home_url,$body_temp);
			$body =str_replace('[logo]',$logo_html,$body);
			$body =str_replace('[name]',$this->input->post('first_name').' '.$this->input->post('last_name'),$body);
			$body =str_replace('[email]',$this->input->post('email'),$body);
			$body =str_replace('[site_title]',strtoupper(site_info()),$body);
			$body =str_replace('[url]',base_url()."register/verify_email/".$verification_key,$body);
			$complete_html = str_replace('{{body}}',$body,$body_temp);
			
            $this->email->message($complete_html);
            $this->email->send();

			redirect('register/verify');
		}else{
			if(validation_errors()){
				$this->session->set_flashdata('Error', 'User already have an account');
			}
			$data['View'] = "enduser/register";
		 	$data['page_content'] = $this->load->view($data['View'], $data, true);
			$this->load->view('enduser/layouts/default', $data);
		}
		
		
		//$this->load->view('enduser/login');
		
		//$this->load->view('enduser/register');
	}
	public function verify(){
		 $data['View'] = "enduser/verify";
		 $data['page_content'] = $this->load->view($data['View'], $data, true);
		 $this->load->view('enduser/layouts/default', $data);
	}
	public function validate() {
		$this->form_validation->set_rules('user_name', 'Name', 'required|trim');
		$this->form_validation->set_rules('user_email', 'Email Address', 'required|trim|valid_email|is_unique[users.email]',
		array(
			 'is_unique'     => 'This email already exists.'
			)
		);
		$this->form_validation->set_rules('user_password', 'Password', 'required|trim');

		if($this->form_validation->run()) {

			$verification_key = md5(rand());
			// $encrypted_password = $this->encryption->encrypt($this->input->post('user_password'));

			// echo $encrypted_password;
			$data = array(
				'userName' => $this->input->post('user_name'),
				'email' => $this->input->post('user_email'),
				'password' => $this->input->post('user_password'),
				'verification_key' => $verification_key,
				'is_email_verified' => 'no'
			);

			$id = $this->register_model->insert($data);
			if($id > 0) {
				$subject = "please verify email for login";
				$message = "<p>HI".$this->input->post('user_name')."</p>
				<p>this is an email verification from ,,,,
				click this <a href='".base_url()."enduser/register/verify_email/".$verification_key."'>Link</a></p>";

				$config = array(
					'protocol' => 'smtp',
					'smtp_host' => 'smtp.googlemail.com',
					'smtp_port' => 465,
					'smtp_user' => 'addraft321@gmail.com',
					'smtp_pass' => '786302420',
					'mailtype'  => 'html', 
					'charset'   => 'iso-8859-1'
				);
				$this->load->library('email', $config);
				$this->email->set_newline("\r\n");
				$this->email->from('balti345@gmail.com', 'Zaheer_123');
				$this->email->to($this->input->post('user_email'));
				$this->email->subject($subject);
				$this->email->message($message);
				if($this->email->send()) {
					$this->session->set_flashdata('message','please check your email for verification');
					redirect('superadmin/register');
				}

			}

		} else {
			$this->load->view('index', $data);
		}
	}
	function resend_email(){
		$email = $_GET['email'];

		$check_data = $this->db->get_where('users',array('email'=>$email))->row();
	    //$this->db->from('users');
		//$this->db->get()->row();
		//echo $this->db->last_query();exit;
		//print_r($check_data); die;
		if($check_data->email)
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
				   
				   $site_detail = site_detail();
			if($site_detail->domain){
				$home_url =$site_detail->domain.'/home';
			}else{
				$home_url =$site_detail->url.'/home';
			}
			$activate_account = email_template('activate_account');
            $this->email->from(email_setting('from_mail'), $activate_account->subject);
            $this->email->to($email);
            $this->email->subject($activate_account->subject);
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
			$body = $activate_account->template;
			$body_temp = $this->db->get_where('settings',array('siteID'=>1))->row()->general_template;
			$body_temp =str_replace('[email]',$site_detail->email,$body_temp);
			$body_temp =str_replace('[home_url]',$home_url,$body_temp);
			$body =str_replace('[logo]',$logo_html,$body);
			$body =str_replace('[name]',$check_data->first_name.' '.$check_data->last_name,$body);
			$body =str_replace('[email]',$check_data->email,$body);
			$body =str_replace('[site_title]',strtoupper(site_info()),$body);
			$body =str_replace('[url]',base_url()."register/verify_email/".$verification_key,$body);
			$complete_html = str_replace('{{body}}',$body,$body_temp);
			
            $this->email->message($complete_html);
            $this->email->send();

				   
			/*$activate_account = email_template('activate_account');
            $this->email->from(email_setting('from_mail'), $activate_account->subject);
            $this->email->to($this->input->post('email'));
           
            $this->email->set_mailtype("html");
            $this->email->subject($activate_account->subject);
			
			$body = $activate_account->template;
			$body =str_replace('[name]',$check_data->first_name.' '.$check_data->last_name,$body);
			$link ="<a href='".base_url()."register/verify_email/".$verification_key."' >Click here to account Activate</a>";
			$body =str_replace('[url]',$link,$body);
            $this->email->message($body);
            $this->email->send();
*/
			
		}
		redirect('enduser/login');
	}
	function verify_email() {
		//echo $this->uri->segment(3);exit;
		if($this->uri->segment(3)) {
			$verification_key = $this->uri->segment(3);
			$is_login = $this->register_model->verify_email($verification_key);
			if($is_login) {
				$data['message'] = '<p>successfully verified. login from <a href="'.base_url().'enduser/login"> here</a> </p>';
				$data['isverify']='yes';
				//$this->load->view('enduser/email_verify', $data);

				$data['View'] = "enduser/email_verify";
				$data['page_content'] = $this->load->view($data['View'], $data, true);
				$this->load->view('enduser/layouts/default', $data);
			} else {
				// already verified / invalid link
				$data['message'] = '<p>Invalid Link'.$verification_key.'</p>';
				$data['isverify']='no';
				//$this->load->view('enduser/email_verify', $data);

				$data['View'] = "enduser/email_verify";
				$data['page_content'] = $this->load->view($data['View'], $data, true);
				$this->load->view('enduser/layouts/default', $data);
			}
			//$this->load->view('email_verification', $data);
		}
	}
}

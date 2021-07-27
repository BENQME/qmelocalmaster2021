<?php
defined('BASEPATH') OR exit('No direct script access allowed');
    
class Payment extends CI_Controller {
     
    /**
     * Get All Data from this method.
     *
     * @return Response
    */
    public function __construct() {
       parent::__construct();
       $this->load->library("session");
       $this->load->helper('url');
    }
     
    /**
     * Get All Data from this method.
     *
     * @return Response
    */
    public function index()
    {
		if($this->input->post('submit') == 1){
			
			$this->session->set_userdata('form_dataa', $_POST);
			redirect('payment');
			
		}
		$slug = $this->uri->segment(2);
		
		$data['form_data'] = $this->session->userdata('form_dataa');
		$data['View'] = "stripePayment/index";
			$data['page_content'] = $this->load->view($data['View'], $data, true);
			$this->load->view('enduser/style2/layouts/landing_header', $data);
    }
        
    /**
     * Get All Data from this method.
     *
     * @return Response
    */
	public function payment_success2(){
		/*$Contacts_Name =  $this->input->post('Contacts_Name');
		$Contacts_Phone_Number =  $this->input->post('Contacts_Phone_Number');
		$Contacts_Email_Address =  $this->input->post('Contacts_Email_Address');
		$Company_Name_For_Listing =  $this->input->post('Company_Name_For_Listing');
		$Company_URL_For_Listing =  $this->input->post('Company_URL_For_Listing');
		$Contact_Phone_Number =  $this->input->post('Contact_Phone_Number');
		
		
		$Street_Address =  $this->input->post('Street_Address');
		$City_Name =  $this->input->post('City_Name');
		$state =  $this->input->post('state');
		$Zip_Code =  $this->input->post('Zip_Code');
		
		$Industry =  $this->input->post('Industry');*/
		//$payment_info = $_GET['req'];
		//$payment_info =json_decode($payment_info);
		$Contact_Email =  $this->input->post('Contact_Email');
		$user_info = $_POST;
		unset($user_info['submit']);
		$emails = $user_info['user_emailss'];
		$user_info['certifications'] = implode(',',$user_info['certifications']);
		unset($user_info['user_emailss']);
		$this->load->library('email');
		$config = array(
			'protocol' => 'smtp',
			'smtp_host' => email_setting('host'),
			'smtp_user' => email_setting('username'),
			'smtp_pass' => email_setting('password'),
			'smtp_port' => email_setting('port'),
			'mailtype'  => 'html', 
			
		);
		$site_name =site_info();
		$this->email->initialize($config);
				//print_r($config); die;
				$this->email->set_newline("\r\n");
				$this->email->from(email_setting('from_mail'), $site_name);
				$this->email->to($emails.','.$Contact_Email, $site_name);
				$this->email->subject('2021 Diverse Supplier Directory');
				$mail_html ="<h4>Contact Information</h4>";
				if($user_info){
					foreach($user_info as $key=>$u_data){
						$mail_html .='<b style="text-transform: capitalize;">'.str_replace('_',' ',$key).': </b>'.$u_data.'<br>';
					}
				}
				$this->email->message($mail_html);
                $this->email->send();
				//unset($this->session->userdata('form_dataa'));
				redirect('page/submission-confirmation');
			//echo $this->email->print_debugger(); die;
			//$this->session->set_flashdata('sucesess', 'Message Sent Successfully');
				/*if($url = $this->input->post('url')){
				$data['page_type']='settings';
				  redirect("page/".$url);
				}else{
					redirect('admin');
				}
			}*/
	}
	public function payment_success(){
		$payment_info = $_GET['req'];
		$payment_info =json_decode($payment_info);
		$user_info = $this->session->userdata('form_dataa');
		unset($user_info['submit']);
		$this->load->library('email');
		$config = array(
			'protocol' => 'smtp',
			'smtp_host' => email_setting('host'),
			'smtp_user' => email_setting('username'),
			'smtp_pass' => email_setting('password'),
			'smtp_port' => email_setting('port'),
			'mailtype'  => 'html', 
			
		);
		$site_name =site_info();
		$this->email->initialize($config);
				//print_r($config); die;
				$this->email->set_newline("\r\n");
				$this->email->from(email_setting('from_mail'), $site_name);
				$this->email->to(special_to_email(), $site_name);
				$this->email->subject('MBE Supplier Connect Signup');
				$mail_html ="<h4>User Information</h4>";
				if($user_info){
					foreach($user_info as $key=>$u_data){
						$mail_html .='<b style="text-transform: capitalize;">'.str_replace('_',' ',$key).': </b>'.$u_data.'<br>';
					}
				}
				$mail_html .="<h4>User Information</h4>";
					$mail_html .='<b>Transaction ID : </b>'.$payment_info->id.'<br>';
					$mail_html .='<b>Amount : </b>'.($payment_info->amount/100).' USD<br>';
					$mail_html .='<b>Recept URL : </b>'.($payment_info->receipt_url).' USD<br>';
				$this->email->message($mail_html);
                $this->email->send();
				//unset($this->session->userdata('form_dataa'));
				redirect('page/thank-you');
			//echo $this->email->print_debugger(); die;
			//$this->session->set_flashdata('sucesess', 'Message Sent Successfully');
				/*if($url = $this->input->post('url')){
				$data['page_type']='settings';
				  redirect("page/".$url);
				}else{
					redirect('admin');
				}
			}*/
	}
    public function payment_post()
    {
      require_once('application/libraries/stripe-php/init.php');
     
      $stripeSecret = $this->config->item('stripe_secret');
 
      \Stripe\Stripe::setApiKey($stripeSecret);
      
        $stripe = \Stripe\Charge::create ([
                "amount" => $this->input->post('amount'),
                "currency" => "usd",
                "source" => $this->input->post('tokenId'),
                "description" => "This is from ".site_info()
        ]);
             
       // after successfull payment, you can store payment related information into your database
              
        $data = array('success' => true, 'data'=> $stripe);
 
        echo json_encode($data);
    }
}
<?php
// defined('BASEPATH') OR exit('No direct script access allowed');

class Testmail extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->library('encryption');
		$this->load->library('email');
        $this->load->model('enduser/login_model');
       
    }

	public function index()
{
    $this->load->library('email');
    $config = array(
        'protocol' => 'smtp',
        'smtp_host' =>  email_setting('host'),
        'smtp_user' =>  email_setting('username'),
        'smtp_pass' =>  email_setting('password'),
        'smtp_port' => 587,
        'mailtype' => 'html',
    );
	//print_r( $config ); die;

    $this->email->initialize($config);

    $this->email->set_newline("\r\n");
    $this->email->from('info@mbnusa.com', 'Test From');
    $this->email->to('dk1035641@gmail.com', 'Test To');
    $this->email->subject('Test');
    $this->email->message('test');

    $this->email->send();

    var_dump($this->email->print_debugger());
}
}
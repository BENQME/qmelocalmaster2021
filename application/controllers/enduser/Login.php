<?php
// defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->library('encryption');
        $this->load->model('enduser/login_model');
    }

	public function index()
	{
		//echo "ddddddddddddddddd"; die;
		 //$data['template'] = $this->template();
         $data['View'] = "enduser/login";
		 $data['page_content'] = $this->load->view($data['View'], $data, true);
		 $this->load->view('enduser/layouts/default', $data);
		
		//$this->load->view('enduser/login');
    }

    public function validate() {
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

    }
}

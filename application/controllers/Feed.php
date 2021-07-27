<?php
// defined('BASEPATH') OR exit('No direct script access allowed');

class Feed extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->library('encryption');
		$this->load->library('email');
        $this->load->model('enduser/login_model');
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
    

	function myfeed(){
		$user_id = $this->session->userdata('user_id');
		if($user_id>0){
			$this->db->where('userID', $user_id );
		    $this->db->from('users');
			$data['userinfo'] = $this->db->get()->row();

			$this->db->where('user_id', $user_id );
			$this->db->from('user_profile');
			$data['userprofileinfo'] = $this->db->get()->row();

			$data['spotlight_news'] = $this->db->query("SELECT * FROM spotlights WHERE spotlight_type='News / Blog' AND status=1")->result_array();
			$data['spotlight_spotit'] = $this->db->query("SELECT * FROM spotlights WHERE spotlight_type='Spotit Spotlight' AND status=1")->result_array();
			$data['spotlight_job'] = $this->db->query("SELECT * FROM spotlights WHERE spotlight_type='Job Posting' AND status=1")->result_array();
			$data['spotlight_event'] = $this->db->query("SELECT * FROM spotlights WHERE spotlight_type='Events' AND status=1")->result_array();
			$data['page_type']='feed';
			$data['View'] = "enduser/feed";
			$data['page_content'] = $this->load->view($data['View'], $data, true);
			$this->load->view('enduser/layouts/dashboard', $data);
		}else{
			redirect('login');
		}	
	}
}
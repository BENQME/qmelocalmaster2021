<?php
// defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if(!$this->session->userdata('id')) {
          redirect('enduser/login');
        }
    }

	public function index(){
		$this->load->view('enduser/dashboard');
  }

  public function logout() {
    $data = $this->session->all_userdata();
    foreach($data as $row=> $rows_value) {
      //remove all session
      $this->session->unset_userdata($row);
    }

    redirect('enduser/login');
  }

}

<?php
// defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->library('encryption');
		$this->load->library('email');
		$this->load->library("pagination");
		
	}
	public function index()
	
	{
		
	$user_id = $this->session->userdata('user_id');
		$user_level = $this->session->userdata('user_level');
		if($user_id>0 && $user_level ==3){
			if($this->input->post('submit') == 1){
			$id =$this->input->post('template_id');
			$data = array('subject' =>$this->input->post('subject'),'template' =>$this->input->post('body'));
			$this->db->update('email_template',$data,array('id'=>$id));
			$this->session->set_flashdata('sucesess', 'Updated Successfully');
			redirect('settings');
			}
			
			
			$data['page_type']='settings';
			$data['View'] = "superadmin/settings/mail_template";
			
			$data['page_content'] = $this->load->view($data['View'], $data, true);
			$this->load->view('superadmin/layouts/dashboard', $data);
		}else{
			redirect('superadmin');
		}
    }
	public function smtp()
	
	{
		
	$user_id = $this->session->userdata('user_id');
		$user_level = $this->session->userdata('user_level');
		if($user_id>0 && $user_level ==3){
			if($this->input->post('submit') == 1){
				$id =1;
				$data = array('host' =>$this->input->post('host'),
				'port' =>$this->input->post('port'),
				'username' =>$this->input->post('username'),
				'password' =>$this->input->post('password'),
				'from_mail' =>$this->input->post('from_mail'),
				
				);
				$this->db->update('email_settings',$data,array('id'=>$id));
				$this->session->set_flashdata('sucesess', 'Updated Successfully');
				redirect('settings/smtp');
			}
			
			
			$data['page_type']='settings';
			$data['View'] = "superadmin/settings/smtp";
			
			$data['page_content'] = $this->load->view($data['View'], $data, true);
			$this->load->view('superadmin/layouts/dashboard', $data);
		}else{
			redirect('superadmin');
		}
    }
	public function delete_category(){
		$user_id = $this->session->userdata('user_id');
		$user_level = $this->session->userdata('user_level');
		if($user_id>0 && $user_level ==3){
			$cat_id =  $this->uri->segment(3);
		$this->db->where('categoryID', $cat_id);
		$this->db->delete('spotlights_category');
		$this->session->set_flashdata('sucesess', 'Deleted Successfully');
			redirect('settings/categories');
		}else{
			redirect('superadmin');
		}
	}
	public function categories()
	
	{
		
	$user_id = $this->session->userdata('user_id');
		$user_level = $this->session->userdata('user_level');
		if($user_id>0 && $user_level ==3){
			if($this->input->post('submit') == 2){
				$this->db->insert('spotlights_category',array('categoryTitle'=>$this->input->post('category_name')));
				$this->session->set_flashdata('sucesess', 'Category Added Successfully');
				redirect('settings/categories');
			}
			if($this->input->post('submit') == 1){
				$id =$this->input->post('cat_id');
				$this->db->update('spotlights_category',array('categoryTitle'=>$this->input->post('category_name')),array('categoryID'=>$id));
				$this->session->set_flashdata('sucesess', 'Updated Successfully');
				redirect('settings/categories');
			}
			$data['page_type']='user_list';
			$data['View'] = "superadmin/settings/categories";
			
			$data['page_content'] = $this->load->view($data['View'], $data, true);
			$this->load->view('superadmin/layouts/dashboard', $data);
		}else{
			redirect('superadmin');
		}
    }
	
	
	public function site_resource()
	
	{
		
	$site_id = site_id();
		$user_level =0;
		$user_id = $this->session->userdata('user_id');
		$user_level = $this->session->userdata('user_level');
		if($user_id>0 && $user_level ==3){
			
			$data['page_type']='settings';
			$data['View'] = "superadmin/settings/site_resource";
			
			$data['page_content'] = $this->load->view($data['View'], $data, true);
			$this->load->view('superadmin/layouts/dashboard', $data);
		}else{
			redirect('superadmin');
		}
	}
public function add_edit_resource(){
		
	$site_id = site_id();
		$user_level =0;
		$user_id = $this->session->userdata('user_id');
		$user_level = $this->session->userdata('user_level');
		if($user_id>0 && $user_level ==3){
		   $page_id =  $this->uri->segment(3);
			if($page_id){
			$data['page_data'] = $page_data= $this->db->get_where('home_blocks',array('b_id'=>$page_id))->row();
			}
			if($this->input->post('submit')==1){
/*               $filename = "";
				$target_path = base_url() . "uploads/home_sponsors/";
				if ($_FILES['thumbnail']['name']!="" ) {
					
					$target_path = $target_path . basename($_FILES['thumbnail']['name']);
					$config['upload_path'] = './uploads/home_sponsors/';
					$config['allowed_types'] = 'jpg|jpeg|png|gif';
					$config['max_size'] = '1024'; // max_size in kb
					$config['file_name'] = $_FILES['thumbnail']['name'];
					//$config['max_width']  = '1024';
					//$config['max_height']  = '768';
					$this->load->library('upload', $config);
					if ($this->upload->do_upload('thumbnail')){
						if($page_data->thumbnail){
							@unlink(FCPATH .'uploads/home_sponsors/'.$page_data->thumbnail);
						}
						$upload_data = $this->upload->data();
						$file_name = $upload_data['file_name'];
					
					}
				}else{
						$file_name  = $page_data->thumbnail;
					}*/
			       $field_val = $this->input->post('field_val');
				    $custom_fields =json_encode($field_val);
					$title = $this->input->post('title');
					$insert_data = array(
					'title'=>$title,
				    'custom_fields' => $custom_fields,
					'post_type'=>'resource',
					'created_at' => strtotime(date('Y-m-d H:i:s'))
					);
				 if($page_id){
					 $this->db->update('home_blocks',$insert_data, array('b_id' => $page_id));
					 $this->session->set_flashdata('sucesess', 'Updated Sucessfully');
					  redirect('settings/add_edit_resource/'.$page_id);
				 }else{
				        $this->db->insert('home_blocks',$insert_data);
					    $page_id = $this->db->insert_id();
					   $this->session->set_flashdata('sucesess', 'Added Sucessfully');
					  redirect('settings/add_edit_resource/'.$page_id);
					  
				 }
				
			}
			$data['page_type']='mbn_cms';
			$data['View'] = "superadmin/settings/add_edit_resource";
			$data['page_content'] = $this->load->view($data['View'], $data, true);
			$this->load->view('superadmin/layouts/dashboard', $data);
		}else{
			redirect('superadmin');
		}
		
	}
}

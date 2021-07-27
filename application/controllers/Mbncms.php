<?php
// defined('BASEPATH') OR exit('No direct script access allowed');

class Mbncms extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->library('encryption');
		$this->load->library('email');
		$this->load->library("pagination");
		
		
	}
	public function index()
	
	{
		
	$site_id = site_id();
		$user_level =0;
		$user_id = $this->session->userdata('user_id');
		$user_level = $this->session->userdata('user_level');
		if($user_id>0 && $user_level==1 && special_cms()){
			if($this->input->post('submit') == 1){
				
			$id =$this->input->post('template_id');
			$data = array('subject' =>$this->input->post('subject'),'template' =>$this->input->post('body'));
			$this->db->update('email_template',$data,array('id'=>$id));
			$this->session->set_flashdata('sucesess', 'Updated Successfully');
			redirect('settings');
			}
			
			
			$data['page_type']='settings';
			$data['View'] = "admin/mbn_settings/cms_pages";
			
			$data['page_content'] = $this->load->view($data['View'], $data, true);
			$this->load->view('admin/layouts/dashboard', $data);
		}else{
			redirect('admin');
		}
	}
	public function contact_submit()
	
	{
		
	$site_id = site_id();
		$user_level =0;
		$user_id = $this->session->userdata('user_id');
		$user_level = $this->session->userdata('user_level');
		if($user_id>0 && $user_level==1 && special_cms()){
			if($this->input->post('submit') == 1){
			
			    $name = $this->input->post('name');
				$email = $this->input->post('email');
				$phone = $this->input->post('phone');
				$subject = $this->input->post('subject');
				$message = $this->input->post('message');
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
            $this->email->subject($subject);
			$mail_html ='<b>Name: </b>'.$name.'<br>';
			$mail_html .='<b>Email: </b>'.$email.'<br>';
			$mail_html .='<b>Phone: </b>'.$phone.'<br>';
			$mail_html .='<b>Message: </b>'.$message.'<br>';
            $this->email->message($mail_html);
            $this->email->send();
			//echo $this->email->print_debugger(); die;
			$this->session->set_flashdata('sucesess', 'Message Sent Successfully');
				if($url = $this->input->post('url')){
				$data['page_type']='settings';
				  redirect("page/".$url);
				}else{
					redirect('admin');
				}
			}
		}else{
			redirect('admin');
			
		}
	}
	public function home_category()
	
	{
	
	$site_id = site_id();
		$user_level =0;
		$user_id = $this->session->userdata('user_id');
		$user_level = $this->session->userdata('user_level');
		if($user_id>0 && $user_level==1 && special_cms()){
			
				$data['spotlight_all'] = $this->db->query("SELECT s.*, 
		u.first_name,
		u.last_name,
		u.photo,
		u.site_id,
		u.level,
		r.spotlight_id,
		r.web_id,
		(SELECT count(likeID) FROM likes l WHERE s.postID=l.itemID) AS likecount
		FROM spotlights s 
		LEFT JOIN region_spotlights r ON (r.spotlight_id=s.postID AND r.web_id=$site_id)
		INNER JOIN users u ON s.userid=u.userID AND ((u.level = 3  AND r.web_id=".$site_id.") OR (u.level != 3 AND u.site_id  =$site_id)) 
		WHERE s.status=1 AND u.level !=3 ORDER BY s.visits_count DESC ")->result_array();
			
			
			$data['home_categories'] =$f_spotlights_cats= site_settings('home_categories');
			$data['top_spotlights'] = site_settings('top_spotlights');
			if($this->input->post('submit') == 1){
					$f_spotlights_cats = $this->input->post('spot_category');
					$top_posts = $this->input->post('top_posts');
					$admin_email = $this->input->post('admin_email');
					$f_title = '';
					$f_description = '';
					$json_data = json_encode(array('admin_email'=>$admin_email, 'f_title'=>$f_title,'f_description'=>$f_description,'f_spotlights_cats'=>$f_spotlights_cats));
					$json_data_top_posts = json_encode($top_posts);
					//print_r($f_spotlights_post); die;
					if($data['home_categories']){
						$this->db->update('site_settings',array('value'=>$json_data),array('option_type'=>'home_categories','site_id'=>$site_id ));
					}else{
						$this->db->insert('site_settings',array('value'=>$json_data ,'option_type'=>'home_categories','site_id'=>$site_id));
					}
					
					
					if($data['top_spotlights']){
						$this->db->update('site_settings',array('value'=>$json_data_top_posts),array('option_type'=>'top_spotlights','site_id'=>$site_id ));
					}else{
						$this->db->insert('site_settings',array('value'=>$json_data_top_posts ,'option_type'=>'top_spotlights','site_id'=>$site_id));
					}
					
					$this->session->set_flashdata('sucesess', 'Added Sucessfully');
					redirect('mbncms/home_category');
					
				}
			
			
			$data['page_type']='mbn_cms';
			$data['View'] = "admin/mbn_settings/home_category";
			
			$data['page_content'] = $this->load->view($data['View'], $data, true);
			$this->load->view('admin/layouts/dashboard', $data);
		}else{
			redirect('admin');
		}
	}
	public function widgets()
	
	{
		
	$site_id = site_id();
		$user_level =0;
		$user_id = $this->session->userdata('user_id');
		$user_level = $this->session->userdata('user_level');
		if($user_id>0 && $user_level==1 && special_cms()){
			
			$data['page_type']='settings';
			$data['View'] = "admin/mbn_settings/widgets";
			
			$data['page_content'] = $this->load->view($data['View'], $data, true);
			$this->load->view('admin/layouts/dashboard', $data);
		}else{
			redirect('admin');
		}
	}
	public function sponsers()
	
	{
		
	$site_id = site_id();
		$user_level =0;
		$user_id = $this->session->userdata('user_id');
		$user_level = $this->session->userdata('user_level');
		if($user_id>0 && $user_level==1 && special_cms()){
			
			$data['page_type']='settings';
			$data['View'] = "admin/mbn_settings/sponsors";
			
			$data['page_content'] = $this->load->view($data['View'], $data, true);
			$this->load->view('admin/layouts/dashboard', $data);
		}else{
			redirect('admin');
		}
	}
	public function site_sponsors()
	
	{
		
	$site_id = site_id();
		$user_level =0;
		$user_id = $this->session->userdata('user_id');
		$user_level = $this->session->userdata('user_level');
		if($user_id>0 && $user_level==1 && special_cms()){
			
			$data['page_type']='settings';
			$data['View'] = "admin/mbn_settings/site_sponsors";
			
			$data['page_content'] = $this->load->view($data['View'], $data, true);
			$this->load->view('admin/layouts/dashboard', $data);
		}else{
			redirect('admin');
		}
	}
	public function team()
	
	{
		
	$site_id = site_id();
		$user_level =0;
		$user_id = $this->session->userdata('user_id');
		$user_level = $this->session->userdata('user_level');
		if($user_id>0 && $user_level==1 && special_cms()){
			
			$data['page_type']='settings';
			$data['View'] = "admin/mbn_settings/team";
			
			$data['page_content'] = $this->load->view($data['View'], $data, true);
			$this->load->view('admin/layouts/dashboard', $data);
		}else{
			redirect('admin');
		}
	}
   public function partners()
	
	{
		
	$site_id = site_id();
		$user_level =0;
		$user_id = $this->session->userdata('user_id');
		$user_level = $this->session->userdata('user_level');
		if($user_id>0 && $user_level==1 && special_cms()){
			
			$data['page_type']='settings';
			$data['View'] = "admin/mbn_settings/partners";
			
			$data['page_content'] = $this->load->view($data['View'], $data, true);
			$this->load->view('admin/layouts/dashboard', $data);
		}else{
			redirect('admin');
		}
	}
	
	public function magazine()
	
	{
		
	$site_id = site_id();
		$user_level =0;
		$user_id = $this->session->userdata('user_id');
		$user_level = $this->session->userdata('user_level');
		if($user_id>0 && $user_level==1 && special_cms()){
			
			$data['page_type']='settings';
			$data['View'] = "admin/mbn_settings/magazine";
			
			$data['page_content'] = $this->load->view($data['View'], $data, true);
			$this->load->view('admin/layouts/dashboard', $data);
		}else{
			redirect('admin');
		}
	}
	public function sponsors_category(){
		
		
	$site_id = site_id();
		$user_level =0;
		$user_id = $this->session->userdata('user_id');
		$user_level = $this->session->userdata('user_level');
		if($user_id>0 && $user_level==1 && special_cms()){
			
			$data['page_type']='settings';
			$data['View'] = "admin/mbn_settings/sponsors_category";
			
			$data['page_content'] = $this->load->view($data['View'], $data, true);
			$this->load->view('admin/layouts/dashboard', $data);
		}else{
			redirect('admin');
		}
	}
/*	public function magazine_cat(){
		
		
	$site_id = site_id();
		$user_level =0;
		$user_id = $this->session->userdata('user_id');
		$user_level = $this->session->userdata('user_level');
		if($user_id>0 && $user_level==1 && special_cms()){
			
			
		}else{
			redirect('admin');
		}
	}*/
	public function hbcu(){
	$site_id = site_id();
		$user_level =0;
		$user_id = $this->session->userdata('user_id');
		$user_level = $this->session->userdata('user_level');
		if($user_id>0 && $user_level==1 && special_cms()){
		   $page_id =  $this->uri->segment(3);
			if($this->input->post('submit')==2 || $this->input->post('submit')==1){
			 
				 $categoryTitle = $this->input->post('category_name');
				 $cat_id = $this->input->post('cat_id');
				 $insert_data = array(
				 'categoryTitle'=>$categoryTitle,
				 'site_id'=>$site_id
				 );
				 if($cat_id){
					 $this->db->update('hbcu',$insert_data, array('categoryID' => $cat_id));
					 $this->session->set_flashdata('sucesess', 'Updated Sucessfully');
					  redirect('mbncms/hbcu/');
				 }else{
				        $this->db->insert('hbcu',$insert_data);
					    $page_id = $this->db->insert_id();
					   $this->session->set_flashdata('sucesess', 'Added Sucessfully');
					  redirect('mbncms/hbcu/');
					  
				 }
				
			}
			
	$data['page_type']='settings';
		$data['View'] = "admin/mbn_settings/hbcu";
		
		$data['page_content'] = $this->load->view($data['View'], $data, true);
		$this->load->view('admin/layouts/dashboard', $data);
	}else{
		redirect('admin');
	}
		
	}
	public function magazine_cat(){
	$site_id = site_id();
		$user_level =0;
		$user_id = $this->session->userdata('user_id');
		$user_level = $this->session->userdata('user_level');
		if($user_id>0 && $user_level==1 && special_cms()){
		   $page_id =  $this->uri->segment(3);
			if($this->input->post('submit')==2 || $this->input->post('submit')==1){
			 
				 $categoryTitle = $this->input->post('category_name');
				 $cat_id = $this->input->post('cat_id');
				 $insert_data = array(
				 'categoryTitle'=>$categoryTitle,
				 'site_id'=>$site_id
				 );
				 if($cat_id){
					 $this->db->update('magazine_cat',$insert_data, array('categoryID' => $cat_id));
					 $this->session->set_flashdata('sucesess', 'Updated Sucessfully');
					  redirect('mbncms/magazine_cat/');
				 }else{
				        $this->db->insert('magazine_cat',$insert_data);
					    $page_id = $this->db->insert_id();
					   $this->session->set_flashdata('sucesess', 'Added Sucessfully');
					  redirect('mbncms/magazine_cat/');
					  
				 }
				
			}
			
	$data['page_type']='settings';
			$data['View'] = "admin/mbn_settings/magazine_cat";
			
			$data['page_content'] = $this->load->view($data['View'], $data, true);
			$this->load->view('admin/layouts/dashboard', $data);
		}else{
			redirect('admin');
		}
		
	}
	
	
	public function delete_magazine()
	
	{
		
	$site_id = site_id();
		$user_level =0;
		$user_id = $this->session->userdata('user_id');
		$user_level = $this->session->userdata('user_level');
		if($user_id>0 && $user_level==1 && special_cms()){
		$page_id = $this->uri->segment(3);
		$media_info = $this->db->get_where('magazine',array('m_id'=>$page_id))->row();
		@unlink(FCPATH .'uploads/magazine/'.$media_info->thumbnail);
		@unlink(FCPATH .'uploads/magazine/'.$media_info->pdf);
		$this->db->where('m_id', $page_id );
       $this->db->delete('magazine'); 
	   redirect('mbncms/magazine');
		}else{
			redirect('admin');
		}
		
	}
	
	
	public function delete_page()
	
	{
		
	$site_id = site_id();
		$user_level =0;
		$user_id = $this->session->userdata('user_id');
		$user_level = $this->session->userdata('user_level');
		if($user_id>0 && $user_level==1 && special_cms()){
		$page_id = $this->uri->segment(3);
		$this->db->where('pageID', $page_id );
       $this->db->delete('pages'); 
	   redirect('mbncms');
		}else{
			redirect('admin');
		}
		
	}
	public function delete_widget()
	
	{
		
	$site_id = site_id();
		$user_level =0;
		$user_id = $this->session->userdata('user_id');
		$user_level = $this->session->userdata('user_level');
		if($user_id>0 && $user_level==1 && special_cms()){
		$page_id = $this->uri->segment(3);
		$this->db->where('w_id', $page_id );
       $this->db->delete('widgets'); 
	   redirect('mbncms/widgets');
		}else{
			redirect('admin');
		}
		
	}
	public function delete_category()
	
	{
		
	$site_id = site_id();
		$user_level =0;
		$user_id = $this->session->userdata('user_id');
		$user_level = $this->session->userdata('user_level');
		if($user_id>0 && $user_level==1 && special_cms()){
		$page_id = $this->uri->segment(3);
		$this->db->where('CategoryID', $page_id );
       $this->db->delete('sponsors_category'); 
	   redirect('mbncms/sponsors_category');
		}else{
			redirect('admin');
		}
		
	}
	public function delete_hbcu()
	
	{
		
	$site_id = site_id();
		$user_level =0;
		$user_id = $this->session->userdata('user_id');
		$user_level = $this->session->userdata('user_level');
		if($user_id>0 && $user_level==1 && special_cms()){
		$page_id = $this->uri->segment(3);
		$this->db->where('CategoryID', $page_id );
       $this->db->delete('hbcu'); 
	   redirect('mbncms/hbcu');
		}else{
			redirect('admin');
		}
		
	}
	
	public function delete_magazine_cat()
	
	{
		
	$site_id = site_id();
		$user_level =0;
		$user_id = $this->session->userdata('user_id');
		$user_level = $this->session->userdata('user_level');
		if($user_id>0 && $user_level==1 && special_cms()){
		$page_id = $this->uri->segment(3);
		$this->db->where('CategoryID', $page_id );
       $this->db->delete('magazine_cat'); 
	   redirect('mbncms/magazine_cat');
		}else{
			redirect('admin');
		}
		
	}
	function delete_media(){
		$user_level =0;
		$user_id = $this->session->userdata('user_id');
		$user_level = $this->session->userdata('user_level');
		if($user_id>0 && $user_level==1 && special_cms()){
		$media_id = $this->uri->segment(3);
		$media_info = $this->db->get_where('media',array('media_id'=>$media_id))->row();
			@unlink(FCPATH .'uploads/media/'.$media_info->file_name);
			$this->db->where('media_id', $media_id);
			$this->db->delete('media'); 
			 $this->session->set_flashdata('sucesess', 'Deleted Successfully');
			 redirect('mbncms/media');
		}else{
			redirect('admin');
		}

	}
	

	
	
	
	public function media()
	
	{
		//echo $upload_max =ini_get('upload_max_filesize');
	$site_id = site_id();
		$user_level =0;
		$user_id = $this->session->userdata('user_id');
		$user_level = $this->session->userdata('user_level');
		if($user_id>0 && $user_level==1 && special_cms()){
			
			$filename = "";
    $target_path = base_url() . "uploads/media/";
    if ($_FILES['file']['name']!="" ) {
		
       	$target_path = $target_path . basename($_FILES['file']['name']);

        $config['upload_path'] = './uploads/media/';
        $config['allowed_types'] = 'jpg|jpeg|png|gif|pdf';
     	$config['max_size'] = '99999999999999999999999'; // max_size in kb
     	$config['file_name'] = $_FILES['file']['name'];
        //$config['max_width']  = '1024';
        //$config['max_height']  = '768';
        $this->load->library('upload', $config);

        if ($this->upload->do_upload('file')){
			$upload_data = $this->upload->data();
            $insData = array(
            			'file_name' => $upload_data['file_name'],
        				'created' => date('Y-m-d H:i:s'));
            $this->db->insert('media',$insData);
            $insert_id = $this->db->insert_id();
            $filelink=FCPATH."uploads/media/".$config['file_name'];
			
            $this->session->set_flashdata('sucesess', 'uploaded Successfully');
			redirect('mbncms/media');
        }
    }
			
			$data['media'] = $this->db->query("SELECT * FROM media ORDER BY media_id DESC")->result_array();
			
			$data['page_type']='admin_media';
			$data['View'] = "admin/mbn_settings/media";
			$data['page_content'] = $this->load->view($data['View'], $data, true);
			$this->load->view('admin/layouts/dashboard', $data);
		}else{
			redirect('admin');
		}
		
	}
	
	public function categories(){
	$site_id = site_id();
		$user_level =0;
		$user_id = $this->session->userdata('user_id');
		$user_level = $this->session->userdata('user_level');
		if($user_id>0 && $user_level==1 && special_cms()){
		   $page_id =  $this->uri->segment(3);
			if($this->input->post('submit')==2 || $this->input->post('submit')==1){
			 
				 $categoryTitle = $this->input->post('category_name');
				 $is_parent = $this->input->post('is_parent');
				  $parent = $this->input->post('parent');
				 $cat_id = $this->input->post('cat_id');
				 $insert_data = array(
				 'categoryTitle'=>$categoryTitle,
				 'is_parent'=>$is_parent,
				  'parent'=>$parent,
				 'site_id'=>$site_id
				 );
				 if($cat_id){
					 $this->db->update('sponsors_category',$insert_data, array('categoryID' => $cat_id));
					 $this->session->set_flashdata('sucesess', 'Updated Sucessfully');
					  redirect('mbncms/sponsors_category/');
				 }else{
				        $this->db->insert('sponsors_category',$insert_data);
					    $page_id = $this->db->insert_id();
					   $this->session->set_flashdata('sucesess', 'Added Sucessfully');
					  redirect('mbncms/sponsors_category/');
					  
				 }
				
			}
		}else{
			redirect('admin');
		}
		
	}
	public function add_edit_page(){
	
		
	$site_id = site_id();
		$user_level =0;
		$user_id = $this->session->userdata('user_id');
		$user_level = $this->session->userdata('user_level');
		if($user_id>0 && $user_level==1 && special_cms()){
		   $page_id =  $this->uri->segment(3);
			if($page_id){
			$data['page_data'] = $this->db->get_where('pages',array('pageID'=>$page_id))->row();
			}
			if($this->input->post('submit')==1){
			    $slug = url_title($this->input->post('pageTitle'), "dash", TRUE);
				$this->db->where('pageSlug', $slug);
				$this->db->from('pages');
				$query = $this->db->get();
				 if($query->num_rows()>0){
					 $slug=$slug;
				 }
				 $pageTitle = $this->input->post('pageTitle');
				 $pageContent = $this->input->post('pageContent');
				 $spot_category = $this->input->post('spot_category');
				 $sponser_category = $this->input->post('sponser_category');
				 $magazine_cat = $this->input->post('magazine_cat');
				 $page_template = $this->input->post('page_template');
				 $field_val = $this->input->post('field_val');
				 $custom_fields =json_encode($field_val);
				 $insert_data = array('pageTitle'=>$pageTitle,
				 'pageTitle'=>$pageTitle,
				 'pageContent'=>$pageContent,
				 'pageSlug'=>$slug,
				 'spot_category' => json_encode($spot_category),
				 'sponser_category' => $sponser_category,
				 'custom_fields' => $custom_fields,
				 'timestamp' => strtotime(date('Y-m-d H:i:s')),
				  'magazine_cat' =>$magazine_cat,
				 'template'=>$page_template);
				 if($page_id){
					 $this->db->update('pages',$insert_data, array('pageID' => $page_id));
					 $this->session->set_flashdata('sucesess', 'Page Updated Sucessfully');
					  redirect('mbncms/add_edit_page/'.$page_id);
				 }else{
				        $this->db->insert('pages',$insert_data);
					    $page_id = $this->db->insert_id();
					   $this->session->set_flashdata('sucesess', 'Page Added Sucessfully');
					  redirect('mbncms/add_edit_page/'.$page_id);
					  
				 }
				
			}
			$data['page_type']='mbn_cms';
			$data['View'] = "admin/mbn_settings/add_edit_page";
			$data['page_content'] = $this->load->view($data['View'], $data, true);
			$this->load->view('admin/layouts/dashboard', $data);
		}else{
			redirect('admin');
		}
		
	}
	public function add_edit_site_sponsers(){
		
	$site_id = site_id();
		$user_level =0;
		$user_id = $this->session->userdata('user_id');
		$user_level = $this->session->userdata('user_level');
		if($user_id>0 && $user_level==1 && special_cms()){
		   $page_id =  $this->uri->segment(3);
			if($page_id){
			$data['page_data'] = $page_data= $this->db->get_where('home_blocks',array('b_id'=>$page_id))->row();
			}
			if($this->input->post('submit')==1){
               $filename = "";
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
					}
			
				 $title = $this->input->post('title');
				  $video = $this->input->post('video');
				    $url = $this->input->post('url');
				 $insert_data = array(
				'title'=>$title,
				'video'=>$video,
				'url'=>$url,
				'thumbnail'=>$file_name,
				 'site_id'=>$site_id,
				 'post_type'=>'sponsors',
				 'created_at' => strtotime(date('Y-m-d H:i:s'))
				 );
				 if($page_id){
					 $this->db->update('home_blocks',$insert_data, array('b_id' => $page_id));
					 $this->session->set_flashdata('sucesess', 'Updated Sucessfully');
					  redirect('mbncms/add_edit_site_sponsers/'.$page_id);
				 }else{
				        $this->db->insert('home_blocks',$insert_data);
					    $page_id = $this->db->insert_id();
					   $this->session->set_flashdata('sucesess', 'Added Sucessfully');
					  redirect('mbncms/add_edit_site_sponsers/'.$page_id);
					  
				 }
				
			}
			$data['page_type']='mbn_cms';
			$data['View'] = "admin/mbn_settings/add_edit_site_sponsers";
			$data['page_content'] = $this->load->view($data['View'], $data, true);
			$this->load->view('admin/layouts/dashboard', $data);
		}else{
			redirect('admin');
		}
		
	}
	public function add_edit_team(){
		
	$site_id = site_id();
		$user_level =0;
		$user_id = $this->session->userdata('user_id');
		$user_level = $this->session->userdata('user_level');
		if($user_id>0 && $user_level==1 && special_cms()){
		   $page_id =  $this->uri->segment(3);
			if($page_id){
			$data['page_data'] = $page_data= $this->db->get_where('home_blocks',array('b_id'=>$page_id))->row();
			}
			if($this->input->post('submit')==1){
               $filename = "";
				$target_path = base_url() . "uploads/team/";
				if ($_FILES['thumbnail']['name']!="" ) {
					
					$target_path = $target_path . basename($_FILES['thumbnail']['name']);
					$config['upload_path'] = './uploads/team/';
					$config['allowed_types'] = 'jpg|jpeg|png|gif';
					$config['max_size'] = '1024'; // max_size in kb
					$config['file_name'] = $_FILES['thumbnail']['name'];
					//$config['max_width']  = '1024';
					//$config['max_height']  = '768';
					$this->load->library('upload', $config);
					if ($this->upload->do_upload('thumbnail')){
						if($page_data->thumbnail){
							@unlink(FCPATH .'uploads/team/'.$page_data->thumbnail);
						}
						$upload_data = $this->upload->data();
						$file_name = $upload_data['file_name'];
					
					}
				}else{
						$file_name  = $page_data->thumbnail;
					}
			
				$title = $this->input->post('title');
				$video = $this->input->post('video');
				$field_val = $this->input->post('field');
				$custom_fields =json_encode($field_val);
				 $insert_data = array(
				'title'=>$title,
				'video'=>$video,
				'thumbnail'=>$file_name,
				 'site_id'=>$site_id,
				 'custom_fields'=>$custom_fields,
				 'post_type'=>'team',
				 'created_at' => strtotime(date('Y-m-d H:i:s'))
				 );
				 if($page_id){
					 $this->db->update('home_blocks',$insert_data, array('b_id' => $page_id));
					 $this->session->set_flashdata('sucesess', 'Updated Sucessfully');
					  redirect('mbncms/add_edit_team/'.$page_id);
				 }else{
				        $this->db->insert('home_blocks',$insert_data);
					    $page_id = $this->db->insert_id();
					   $this->session->set_flashdata('sucesess', 'Added Sucessfully');
					  redirect('mbncms/add_edit_team/'.$page_id);
					  
				 }
				
			}
			$data['page_type']='mbn_cms';
			$data['View'] = "admin/mbn_settings/add_edit_team";
			$data['page_content'] = $this->load->view($data['View'], $data, true);
			$this->load->view('admin/layouts/dashboard', $data);
		}else{
			redirect('admin');
		}
		
	}
	
	public function add_edit_partners(){
		
	$site_id = site_id();
		$user_level =0;
		$user_id = $this->session->userdata('user_id');
		$user_level = $this->session->userdata('user_level');
		if($user_id>0 && $user_level==1 && special_cms()){
		   $page_id =  $this->uri->segment(3);
			if($page_id){
			$data['page_data'] = $page_data= $this->db->get_where('home_blocks',array('b_id'=>$page_id))->row();
			}
			if($this->input->post('submit')==1){
               $filename = "";
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
					}
			
				 $title = $this->input->post('title');
				 $insert_data = array(
				'title'=>$title,
				'thumbnail'=>$file_name,
				 'site_id'=>$site_id,
				 'post_type'=>'partners',
				 'created_at' => strtotime(date('Y-m-d H:i:s'))
				 );
				 if($page_id){
					 $this->db->update('home_blocks',$insert_data, array('b_id' => $page_id));
					 $this->session->set_flashdata('sucesess', 'Updated Sucessfully');
					  redirect('mbncms/add_edit_partners/'.$page_id);
				 }else{
				        $this->db->insert('home_blocks',$insert_data);
					    $page_id = $this->db->insert_id();
					   $this->session->set_flashdata('sucesess', 'Added Sucessfully');
					  redirect('mbncms/add_edit_partners/'.$page_id);
					  
				 }
				
			}
			$data['page_type']='mbn_cms';
			$data['View'] = "admin/mbn_settings/add_edit_partners";
			$data['page_content'] = $this->load->view($data['View'], $data, true);
			$this->load->view('admin/layouts/dashboard', $data);
		}else{
			redirect('admin');
		}
		
	}
	
	public function add_edit_sponsers(){
		
	$site_id = site_id();
		$user_level =0;
		$user_id = $this->session->userdata('user_id');
		$user_level = $this->session->userdata('user_level');
		if($user_id>0 && $user_level==1 && special_cms()){
		   $page_id =  $this->uri->segment(3);
			if($page_id){
			$data['page_data'] = $page_data= $this->db->get_where('sponsers',array('s_id'=>$page_id))->row();
			}
			if($this->input->post('submit')==1){
               $filename = "";
				$target_path = base_url() . "uploads/sponsors/";
				if ($_FILES['thumbnail']['name']!="" ) {
					
					$target_path = $target_path . basename($_FILES['thumbnail']['name']);
					$config['upload_path'] = './uploads/sponsors/';
					$config['allowed_types'] = 'jpg|jpeg|png|gif';
					$config['max_size'] = '1024'; // max_size in kb
					$config['file_name'] = $_FILES['thumbnail']['name'];
					//$config['max_width']  = '1024';
					//$config['max_height']  = '768';
					$this->load->library('upload', $config);
					if ($this->upload->do_upload('thumbnail')){
						if($page_data->thumbnail){
							@unlink(FCPATH .'uploads/sponsors/'.$page_data->thumbnail);
						}
						$upload_data = $this->upload->data();
						$file_name = $upload_data['file_name'];
					
					}
				}else{
						$file_name  = $page_data->thumbnail;
					}
			
				
				
				 $thumbnail = $this->input->post('thumbnail');
				 $title = $this->input->post('title');
				 $content = $this->input->post('content');
				 $category = $this->input->post('category');
				 $sponser_category = $this->input->post('sponser_category');
				 $url['website'] = $this->input->post('website');
				 $url['spot_url'] = $this->input->post('spot_url');
				 $url['profile'] = $this->input->post('profile');
				 $insert_data = array(
				'title'=>$title,
				'content'=>$content,
				'category'=>$category,
				'thumbnail'=>$file_name,
				'url'=>json_encode($url),
				 'sponser_category'=>$sponser_category,
				 'site_id'=>$site_id,
				 'created_at' => strtotime(date('Y-m-d H:i:s'))
				 );
				 if($page_id){
					 $this->db->update('sponsers',$insert_data, array('s_id' => $page_id));
					 $this->session->set_flashdata('sucesess', 'Updated Sucessfully');
					  redirect('mbncms/add_edit_sponsers/'.$page_id);
				 }else{
				        $this->db->insert('sponsers',$insert_data);
					    $page_id = $this->db->insert_id();
					   $this->session->set_flashdata('sucesess', 'Added Sucessfully');
					  redirect('mbncms/add_edit_sponsers/'.$page_id);
					  
				 }
				
			}
			$data['page_type']='mbn_cms';
			$data['View'] = "admin/mbn_settings/add_edit_sponsers";
			$data['page_content'] = $this->load->view($data['View'], $data, true);
			$this->load->view('admin/layouts/dashboard', $data);
		}else{
			redirect('admin');
		}
		
	}
	public function add_edit_magazine(){
		
	$site_id = site_id();
		$user_level =0;
		$user_id = $this->session->userdata('user_id');
		$user_level = $this->session->userdata('user_level');
		if($user_id>0 && $user_level==1 && special_cms()){
		   $page_id =  $this->uri->segment(3);
			if($page_id){
			$data['page_data'] = $page_data= $this->db->get_where('magazine',array('m_id'=>$page_id))->row();
			}
			if($this->input->post('submit')==1){
				
               $filename = "";
			   $filename2 = "";
				$target_path = base_url() . "uploads/magazine/";
				
				
				//
				if ($_FILES['thumbnail']['name']!="" ) {
					
					$target_path = $target_path . basename($_FILES['thumbnail']['name']);
					$config['upload_path'] = './uploads/magazine/';
					$config['allowed_types'] = 'jpg|jpeg|png|gif';
					$config['max_size'] = '99999999999999'; // max_size in kb
					$config['file_name'] = $_FILES['thumbnail']['name'];
					//$config['max_width']  = '1024';
					//$config['max_height']  = '768';
					$this->load->library('upload', $config);
					if ($this->upload->do_upload('thumbnail')){
						if($page_data->thumbnail){
							@unlink(FCPATH .'uploads/magazine/'.$page_data->thumbnail);
						}
						$upload_data2 = $this->upload->data();
						$file_name2 = $upload_data2['file_name'];
					
					}
				}
				else{
						$file_name2  = $page_data->thumbnail;
					}
				///
				
				
				
				/*if ($_FILES['pdf_file']['name']!="" ) {
					
					
					
					$target_path = $target_path . basename($_FILES['pdf_file']['name']);
					$config['upload_path'] = './uploads/magazine/';
					$config['allowed_types'] = 'pdf';
					$config['max_size'] = '999999999999999999999';
					$config['file_name'] = $_FILES['pdf_file']['name'];
					$this->load->library('upload', $config);
					if ($this->upload->do_upload('pdf_file')){
						if($page_data->pdf){
							@unlink(FCPATH .'uploads/magazine/'.$page_data->pdf);
						}
						$upload_data = $this->upload->data();
						$file_name = $upload_data['file_name'];
					
					}
				}else{
						$file_name  = $page_data->pdf;
					}*/
				 $title = $this->input->post('title');
				 $pdf_url = $this->input->post('pdf_url');
				 $category = $this->input->post('category');
				 $insert_data = array(
				'title'=>$title,
				'pdf'=>$pdf_url ,
				'thumbnail'=>$file_name2,
				 'category'=>$category,
				 'site_id'=>$site_id,
				 'created_at' => strtotime(date('Y-m-d H:i:s'))
				 );
				 if($page_id){
					 $this->db->update('magazine',$insert_data, array('m_id' => $page_id));
					 $this->session->set_flashdata('sucesess', 'Updated Sucessfully');
					  redirect('mbncms/add_edit_magazine/'.$page_id);
				 }else{
				        $this->db->insert('magazine',$insert_data);
					    $page_id = $this->db->insert_id();
					   $this->session->set_flashdata('sucesess', 'Added Sucessfully');
					  redirect('mbncms/add_edit_magazine/'.$page_id);
					  
				 }
				
			}
			$data['page_type']='mbn_cms';
			$data['page_type2']='magazine';
			$data['View'] = "admin/mbn_settings/add_edit_magazine";
			$data['page_content'] = $this->load->view($data['View'], $data, true);
			$this->load->view('admin/layouts/dashboard', $data);
		}else{
			redirect('admin');
		}
		
	}
	
	function delete_sponsers(){
		$user_level =0;
		$user_id = $this->session->userdata('user_id');
		$user_level = $this->session->userdata('user_level');
		if($user_id>0 && $user_level==1 && special_cms()){
		$s_id = $this->uri->segment(3);
		$media_info = $this->db->get_where('sponsers',array('s_id'=>$s_id))->row();
			@unlink(FCPATH .'uploads/sponsors/'.$media_info->thumbnail);
			$this->db->where('s_id', $s_id);
			$this->db->delete('sponsers'); 
			 $this->session->set_flashdata('sucesess', 'Deleted Successfully');
			 redirect('mbncms/sponsers');
		}else{
			redirect('admin');
		}

	}
	function delete_site_sponsers(){
		$user_level =0;
		$user_id = $this->session->userdata('user_id');
		$user_level = $this->session->userdata('user_level');
		if($user_id>0 && $user_level==1 && special_cms()){
		$s_id = $this->uri->segment(3);
		$media_info = $this->db->get_where('home_blocks',array('b_id'=>$b_id))->row();
			@unlink(FCPATH .'uploads/home_sponsors/'.$media_info->thumbnail);
			$this->db->where('b_id', $s_id);
			$this->db->delete('home_blocks'); 
			 $this->session->set_flashdata('sucesess', 'Deleted Successfully');
			 redirect('mbncms/site_sponsors');
		}else{
			redirect('admin');
		}

	}
	function delete_team(){
		$user_level =0;
		$user_id = $this->session->userdata('user_id');
		$user_level = $this->session->userdata('user_level');
		if($user_id>0 && $user_level==1 && special_cms()){
		$s_id = $this->uri->segment(3);
		$media_info = $this->db->get_where('home_blocks',array('b_id'=>$b_id))->row();
			@unlink(FCPATH .'uploads/home_sponsors/'.$media_info->thumbnail);
			$this->db->where('b_id', $s_id);
			$this->db->delete('home_blocks'); 
			 $this->session->set_flashdata('sucesess', 'Deleted Successfully');
			 redirect('mbncms/team');
		}else{
			redirect('admin');
		}

	}
	function delete_partners(){
		$user_level =0;
		$user_id = $this->session->userdata('user_id');
		$user_level = $this->session->userdata('user_level');
		if($user_id>0 && $user_level==1 && special_cms()){
		$s_id = $this->uri->segment(3);
		$media_info = $this->db->get_where('home_blocks',array('b_id'=>$b_id))->row();
			@unlink(FCPATH .'uploads/home_sponsors/'.$media_info->thumbnail);
			$this->db->where('b_id', $s_id);
			$this->db->delete('home_blocks'); 
			 $this->session->set_flashdata('sucesess', 'Deleted Successfully');
			 redirect('mbncms/partners');
		}else{
			redirect('admin');
		}

	}
	
	public function add_edit_widget(){
	
		
	$site_id = site_id();
		$user_level =0;
		$user_id = $this->session->userdata('user_id');
		$user_level = $this->session->userdata('user_level');
		if($user_id>0 && $user_level==1 && special_cms()){
		   $page_id =  $this->uri->segment(3);
			if($page_id){
			$data['page_data'] = $this->db->get_where('widgets',array('w_id'=>$page_id))->row();
			}
			if($this->input->post('submit')==1){
			    
				$title = $this->input->post('title');
				$content = $this->input->post('content');
				$url = $this->input->post('url');
				$order_index = $this->input->post('order_index');
				$widget_area = $this->input->post('widget_area');
				$widget_area_url = $this->input->post('widget_area_url');
				
				 $insert_data = array('title'=>$title,
				 
				 'order_index'=>$order_index,
				 'content'=>$content,
				 'widget_area'=>$widget_area,
				 'url'=>$url,
				 'widget_area_url'=>$widget_area_url);
				 if($page_id){
					 $this->db->update('widgets',$insert_data, array('w_id' => $page_id));
					 $this->session->set_flashdata('sucesess', 'Widget Updated Sucessfully');
					  redirect('mbncms/add_edit_widget/'.$page_id);
				 }else{
				        $this->db->insert('widgets',$insert_data);
					    $page_id = $this->db->insert_id();
					   $this->session->set_flashdata('sucesess', 'Widget Added Sucessfully');
					  redirect('mbncms/add_edit_widget/'.$page_id);
					  
				 }
				
			}
			$data['page_type']='mbn_cms';
			$data['View'] = "admin/mbn_settings/add_edit_widget";
			$data['page_content'] = $this->load->view($data['View'], $data, true);
			$this->load->view('admin/layouts/dashboard', $data);
		}else{
			redirect('admin');
		}
		
	}
	
}

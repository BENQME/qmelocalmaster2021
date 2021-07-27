<?php

defined('BASEPATH') OR exit('No direct script access allowed');



/**

 * Hauth Controller Class

 */

class Hauth extends CI_Controller {

  /**

   * {@inheritdoc}

   */

  public function __construct()

  {

    parent::__construct();

    $this->load->helper('url');

    $this->load->library('hybridauth');

    $this->load->library('session');

  }



  /**

   * {@inheritdoc}

   */

  public function index()

  {

        

    // Build a list of enabled providers.

    $providers = array();

    foreach ($this->hybridauth->HA->getProviders() as $provider_id => $params)

    {

      $providers[] = anchor("hauth/window/{$provider_id}", $provider_id);

    }



    $this->load->view('hauth/login_widget', array(

      'providers' => $providers,

    ));

  }



  /**

   * Try to authenticate the user with a given provider

   *

   * @param string $provider_id Define provider to login

   */

  public function window($provider_id)

  { 

  if(isset($_GET['site_id'])){

       $site_data = $this->db->get_where('admin_urls',array('id'=>$_GET['site_id']))->row();

        if($site_data->domain){

            $site_url =$site_data->domain.'/';

        }else{

            $site_url =$site_data->url.'/';

        }

        $this->session->set_userdata('web_url', $site_url);

  }

    //echo  $this->session->userdata('web_url'); die;



    $params = array(

      'hauth_return_to' => site_url("hauth/window/{$provider_id}"),

    );

    if (isset($_REQUEST['openid_identifier']))

    {

      $params['openid_identifier'] = $_REQUEST['openid_identifier'];

    }

    try

    {

      $adapter = $this->hybridauth->HA->authenticate($provider_id, $params);

      $profile = $adapter->getUserProfile();



      // $this->load->view('hauth/done', array(

      //   'profile' => $profile,

      // ));

	  //print_r($profile); die;

		

		

		

	    $this->db->where('email', $profile->email);

		$this->db->from('users');

		$query = $this->db->get()->row();

		//print_r($query); die;

		$data = array(

		

		    'facebookUID' => $profile->photoURL,

			'first_name' => $profile->firstName,

			'last_name' => $profile->lastName,

			'email' => $profile->email,

			'password' => md5($profile->email),

			'verification_key' =>$profile->identifier,

			'is_email_verified' => '1'

			);

	   if(isset($query) && $query->userID) {

		   $this->db->update('users',$data, array('email'=>$profile->email));

		}else{

			$this->db->insert('users',array_merge(array('created_at'=>date('Y-m-d H:i:s')),$data));

		}

		$user_dataa= $this->db->get_where('users', array('email' =>$profile->email))->row();

		$web_url= $this->session->userdata('web_url');

		redirect($web_url.'dashboard/check_user/'.$user_dataa->userID);

	

	  // redirect('login/complete_profile');

     /* $this->load->view('login/complete_profile', array(

        'profile' => $profile,

      ));*/

    }

    catch (Exception $e)

    {

      show_error($e->getMessage());

    }

  }

  /**

   * Handle the OpenID and OAuth endpoint

   */

  public function endpoint()

  {

    $this->hybridauth->process();

  }



}


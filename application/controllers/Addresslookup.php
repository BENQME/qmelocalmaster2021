<?php class Addresslookup extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
		$this->load->helper("url");
    }
	public function index(){ 
	$this->load->library('USPS');
	$this->load->library('USPS');

//CREATE AN ARRAY OF ZIPCODES (MAX 5)
$addresses = array(
	'0' => array(
		'zip5' => '12345',
	),
	'1' => array(
		'zip5' => '54321',
	)
);

//RUN CITY/STATE LOOKUP
$city_state_lookup = $this->usps->city_state_lookup($addresses);

//OUTPUT RESULTS
print_r($city_state_lookup);
	}
}
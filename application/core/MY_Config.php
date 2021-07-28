<?php 
class MY_Config extends CI_Config {
    public function __construct() {
        $this->config =$config_alt = & get_config();
		 $full_url =$this->full_path();
		 
/*$servername = "qmedev.cip2cdpgt8bw.us-east-2.rds.amazonaws.com";
$username = "admin";
$password = "qmedev2021";
$dbname = "spotlightmarketplace";*/
$servername = "aa1chs14w1ci81f.c9glxarpgiuq.us-east-1.rds.amazonaws.com";
$username = "qmeadmin";
$password = "Qmedev2021";
$dbname = "ebdb";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
print_r($conn); die;
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM `admin_urls` WHERE `domain` = '$full_url' OR `url` =  '$full_url'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  $row = $result->fetch_assoc();
	$domain =  $row['domain'];
	$url =  $row['url'];
	$slug =  $row['slug'];
	if($row['domain']){
		$this->set_item('base_url', $domain);
		
	}else{
		 $this->set_item('base_url', $url);
	}
}else{
	//print_r($_SERVER);
	$the_array = explode('/', trim($_SERVER['REQUEST_URI'], '/'));
//print_r($the_array);
	if(isset($_GET['site_id']) || in_array('hauth',$the_array) || in_array('check_user',$the_array)){
	
	}else{
	echo 'Domain not exist in our Database';
	die;
	}
	}
$conn->close();
/*print_r($this->config);
$this->load->database($dsn);
  $result="";
  $CI =& get_instance();
   echo $full_url =$this->full_path();
    $result= $CI->db->query("SELECT * FROM `admin_urls` WHERE `domain` = '$full_url' OR `url` =  '$full_url'")->row();
	echo "SELECT * FROM `admin_urls` WHERE `domain` = '$full_url' OR `url` =  '$full_url'"; die;
        if(isset($result) && $result->domain){
			$this->config->set_item('base_url', $result->domain);

        }elseif(isset($result) && $result->url){
            $this->config->set_item('base_url', $result->url);

        }else{
			show_404();
			$site_url="";
		}
*/
    }
	function full_path()
{
    $s = &$_SERVER;
    $ssl = (!empty($s['HTTPS']) && $s['HTTPS'] == 'on') ? true:false;
    $sp = strtolower($s['SERVER_PROTOCOL']);
    $protocol = substr($sp, 0, strpos($sp, '/')) . (($ssl) ? 's' : '');
    $port = $s['SERVER_PORT'];
    $port = ((!$ssl && $port=='80') || ($ssl && $port=='443')) ? '' : ':'.$port;
    $host = isset($s['HTTP_X_FORWARDED_HOST']) ? $s['HTTP_X_FORWARDED_HOST'] : (isset($s['HTTP_HOST']) ? $s['HTTP_HOST'] : null);
    $host = isset($host) ? $host : $s['SERVER_NAME'] . $port;
    $uri = $protocol . '://' . $host;
    $segments = explode('?', $uri, 2);
    $url = $segments[0];
    return $url;
}
}

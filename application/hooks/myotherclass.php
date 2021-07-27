<?


class MyOtherClass{

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
    $uri = $protocol . '://' . $host . $s['REQUEST_URI'];
    $segments = explode('?', $uri, 2);
    $url = $segments[0];
    return $url;
}


    function MyOtherfunction() {
		$CI 	=& get_instance();
  $result="";
   echo $full_url =$this->full_path();
    $result= $CI->db->query("SELECT * FROM `admin_urls` WHERE `domain` = '$full_url' OR `url` =  '$full_url'")->row();
	echo "SELECT * FROM `admin_urls` WHERE `domain` = '$full_url' OR `url` =  '$full_url'"; die;
        if(isset($result) && $result->domain){
			$CI->config->set_item('base_url', $result->domain);

        }elseif(isset($result) && $result->url){
            $CI->config->set_item('base_url', $result->url);

        }else{
			show_404();
			$site_url="";
		}

        

    }



}
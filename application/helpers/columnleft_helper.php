<?php 
function __reorder(&$a, &$b){
    $c = array();
    foreach($b as $index){
        array_push($c, $a[$index]);
    }
    return $c;
}

function special_to_email(){
	$home_categories= site_settings('home_categories');
	$p_category = json_decode($home_categories); 
	$admin_email22 =$p_category->admin_email;
	return $admin_email22;
}
    function mime_content_type2($filename)
    {

        $mime_types = array(

            'txt' => 'text/plain',
            'htm' => 'text/html',
            'html' => 'text/html',
            'php' => 'text/html',
            'css' => 'text/css',
            'js' => 'application/javascript',
            'json' => 'application/json',
            'xml' => 'application/xml',
            'swf' => 'application/x-shockwave-flash',
            'flv' => 'video/x-flv',

            // images
            'png' => 'image/png',
            'jpe' => 'image/jpeg',
            'jpeg' => 'image/jpeg',
            'jpg' => 'image/jpeg',
            'gif' => 'image/gif',
            'bmp' => 'image/bmp',
            'ico' => 'image/vnd.microsoft.icon',
            'tiff' => 'image/tiff',
            'tif' => 'image/tiff',
            'svg' => 'image/svg+xml',
            'svgz' => 'image/svg+xml',

            // archives
            'zip' => 'application/zip',
            'rar' => 'application/x-rar-compressed',
            'exe' => 'application/x-msdownload',
            'msi' => 'application/x-msdownload',
            'cab' => 'application/vnd.ms-cab-compressed',

            // audio/video
            'mp3' => 'audio/mpeg',
            'qt' => 'video/quicktime',
            'mov' => 'video/quicktime',

            // adobe
            'pdf' => 'application/pdf',
            'psd' => 'image/vnd.adobe.photoshop',
            'ai' => 'application/postscript',
            'eps' => 'application/postscript',
            'ps' => 'application/postscript',

            // ms office
            'doc' => 'application/msword',
            'rtf' => 'application/rtf',
            'xls' => 'application/vnd.ms-excel',
            'ppt' => 'application/vnd.ms-powerpoint',

            // open office
            'odt' => 'application/vnd.oasis.opendocument.text',
            'ods' => 'application/vnd.oasis.opendocument.spreadsheet',
            );
            
        $value = explode(".", $filename);
        $ext = strtolower(array_pop($value));
        if (array_key_exists($ext, $mime_types)) {
            return $mime_types[$ext];
        } elseif (function_exists('finfo_open')) {
            $finfo = finfo_open(FILEINFO_MIME);
            $mimetype = finfo_file($finfo, $filename);
            finfo_close($finfo);
            return $mimetype;
        } else {
            return 'application/octet-stream';
        }
    }
 
function get_category_posts($cat){
	$site_id = site_id();
	$CI 	=& get_instance();
	if($cat =='1-1'){
	$spotlights = $CI->db->query("SELECT s.*, 
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
		INNER JOIN users u ON s.userid=u.userID AND ((u.level = 3  AND r.web_id=".$site_id.") OR (u.level != 3 AND u.site_id  =".$site_id.")) 
		WHERE s.status=1 AND u.level =1 AND s.spotlight_type !='Media/Podcast' AND s.spotlight_type !='Events' ORDER BY s.created_at DESC  limit 6")->result_array();
	}else{
	$spotlights = $CI->db->query("SELECT s.*, 
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
		INNER JOIN users u ON s.userid=u.userID AND ((u.level = 3  AND r.web_id=".$site_id.") OR (u.level != 3 AND u.site_id  =".$site_id.")) 
		WHERE s.status=1 AND s.category ='".$cat."' AND u.level =1 AND s.spotlight_type !='Events' AND u.level !=3 ORDER BY s.created_at DESC  limit 6")->result_array();
	}
	
	return $spotlights;
	
}

function sidebar_by_url($url){
	$CI 	=& get_instance();
	$where = "FIND_IN_SET('".$url."', widget_area_url)"; 
	$CI->db->from('widgets');
	$CI->db->where($where);
	$CI->db->order_by("order_index", "asc");
	$query = $CI->db->get(); 
	$result = $query->result();
	$html="";
	if($result){
		foreach($result as $widet){
			if($widet->url){
				$html .='<div class="widget"><a target="_blank" href="'.$widet->url.'">'.$widet->content.'</a></div>';
			}else{
				$html .='<div class="widget">'.$widet->content.'</div>';
			}
		}
	} 
return $html;
}
function sidebar($area,$html=false){
	$CI 	=& get_instance();
	$CI->db->from('widgets');
	$CI->db->where("widget_area", $area);
	$CI->db->order_by("order_index", "asc");
	$query = $CI->db->get(); 
	$result = $query->result();
	$html="";
	if($result){
		foreach($result as $widet){
			if($widet->url){
				$html .='<div class="widget"><a target="_blank" href="'.$widet->url.'">'.$widet->content.'</a></div>';
			}else{
				$html .='<div class="widget">'.$widet->content.'</div>';
			}
		}
	} 
return $html;
}
function convertYoutube($string,$thumb=false) {
	
	$sodaa = preg_replace(
		"/\s*[a-zA-Z\/\/:\.]*youtu(be.com\/watch\?v=|.be\/)([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i",
		"<iframe width=\"100%\" height=\"250\" src=\"//www.youtube.com/embed/$2?enablejsapi=1\" allowfullscreen></iframe>",
		$string
	);
	if($sodaa){
	$r_vale = $sodaa;
	}else{
		$r_vale =  '<div style="margin:0" class="fluid-width-video-wrapper">'.$string.'</div>';
		
	}
	if($thumb){
		return '<div class="v_box">
                            <a style="display:block; cursor:pointer" class="youtube-link2" href="'.base_url('detail/'.$thumb['postSlug']).'">
                              <img class="v_thumbnail" src="https://mbnusa.biz/uploads/cover_photo/'.$thumb['cover_photo'].'">
            					 
                     
                      <span class="play_icon"><img src="'.base_url().'/landing_file/style2/you/youtube.svg"></span>
              </a></div>
                  
             ';
	}else{
		return $r_vale;
	}
}
function get_youtube_id_from_url($url)  {
     preg_match('/(http(s|):|)\/\/(www\.|)yout(.*?)\/(embed\/|watch.*?v=|)([a-z_A-Z0-9\-]{11})/i', $url, $results);    return $results[6];
}
function folderSize(){
	$path =APPPATH;
    $bytestotal = 0;
    $path = realpath($path);
    if($path!==false && $path!='' && file_exists($path)){
        foreach(new RecursiveIteratorIterator(new RecursiveDirectoryIterator($path, FilesystemIterator::SKIP_DOTS)) as $object){
            $bytestotal += $object->getSize();
        }
    }
	
    return number_format($bytestotal / 1073741824, 2);
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
function special_cms(){
	if(site_id() =='14'){
		return true;
	}else{
		return false;
	}
		
}
function web_url($slug){
	$CI 	=& get_instance();
	$result = $CI->db->get_where('admin_urls',array('slug'=>$slug))->row();
	if($result){
		if($result->domain){
		$site_url = $result->domain;
		}else{
		  $site_url = base_url().$slug;
		}
		
		return $site_url;
	}
}
function email_setting($field_name){
	$CI 	=& get_instance();
	$result = $CI->db->get_where('email_settings',array('id'=>1))->row();
	return $result->$field_name;
}
function email_template($template){
	$CI 	=& get_instance();
	$result = $CI->db->get_where('email_template',array('name'=>$template))->row();
	return $result;
}
function randomPassword() {
    $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    $pass = array(); //remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    for ($i = 0; $i < 8; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass); //turn the array into a string
}
function site_id(){
	$CI 	=& get_instance();
	$full_url = full_path();
	
	 $result= $CI->db->query("SELECT * FROM `admin_urls` WHERE `domain` = '$full_url' OR `url` =  '$full_url'")->row();
        if(isset($result) && $result->id){
			$id = $result->id;

        }
	return $id;
}
function get_option($col_name){
	$CI 	=& get_instance();
	$value =$CI->db->get_where('settings',array('siteID'=>1))->row()->$col_name;
	return $value;
}
function site_settings($col_name){
	$CI 	=& get_instance();
	$value =$CI->db->get_where('site_settings',array('site_id'=>site_id(),'option_type'=>$col_name))->row();
	if(isset($value) && $value){
		return $value->value;
	}else{
	return 0;
	}
}
/*function get_url($user_id){
	$CI 	=& get_instance();
	$result = $CI->db->get_where('admin_urls',array('user_id'=>$user_id))->row();
	if($result->domain){
		return $result->domain;
	}else{
		return $result->url;
	}
}
function sigment_fixer($s,$slug){
	$CI 	=& get_instance();
	$result = $CI->db->get_where('admin_urls',array('slug'=>$slug))->row();
	if($result->domain){
		return $s-1;
	}else{
		return $s;
	}
}*/
function site_detail(){
	$CI 	=& get_instance();
	$site_id = site_id();
	$result = $CI->db->query("SELECT u.*, ad.id,ad.url,ad.domain,ad.site_name FROM users u 
			INNER JOIN admin_urls ad ON u.site_id=ad.id WHERE (u.user_type IS NULL) AND (u.level=1) AND u.site_id =$site_id")->row();
	return $result;
	
	//$result= $CI->db->query("SELECT * FROM `admin_urls` WHERE `domain` = '$full_url' OR `url` =  '$full_url'")->row();
}
function site_info(){
	$CI 	=& get_instance();
	$full_url = full_path();
	
	 $result= $CI->db->query("SELECT * FROM `admin_urls` WHERE `domain` = '$full_url' OR `url` =  '$full_url'")->row();
        if(isset($result) && $result->site_name){
			$site_name = $result->site_name;

        }
	return $site_name;
}
function createSlug($str, $delimiter = '-'){

    $slug = strtolower(trim(preg_replace('/[\s-]+/', $delimiter, preg_replace('/[^A-Za-z0-9-]+/', $delimiter, preg_replace('/[&]/', 'and', preg_replace('/[\']/', '', iconv('UTF-8', 'ASCII//TRANSLIT', $str))))), $delimiter));
    return $slug;

} 
function site_info_by_id($site_id){
	$CI 	=& get_instance();
	$full_url = full_path();
	
	 $result= $CI->db->query("SELECT * FROM `admin_urls` WHERE `id` = '$site_id'")->row();
        if(isset($result) && $result->site_name){
			$site_name = $result->site_name;

        }
	return $site_name;
}
function getPercentageChange($oldNumber, $newNumber,$total){
    $decreaseValue =  $newNumber - $oldNumber;

    return ($decreaseValue / $total) * 100;
}
function sportlights_stats($posts){
	if($posts){
		$this_week_posts = $previous_week =$total = 0;
		foreach($posts as $post){
			$time_ago = strtotime($post->created_at);
			$cur_time   = time();
    		$time_elapsed   = $cur_time - $time_ago;
			$weeks      = round($time_elapsed / 604800);
			  $days       = round($time_elapsed / 86400 );
			if($days <= 7){
			 $this_week_posts++;
			 $total++;
			}
			elseif($weeks <= 4.3 && $weeks==1)
			{
				//print_r(previous_week);
				$previous_week++;
				$total++;
			}
		
		}
	  //echo $this_week_posts;
	if($total > 0){
       if($previous_week >= $this_week_posts){
		   $add = '';
	   }else{
		     $add = '+';
	   }
	  $ratio  =getPercentageChange($previous_week,$this_week_posts,$total);
	  return $add.round($ratio,2);
	}else{
		return '0.0';
	}
	}else{
		return '0.0';
	}
} 

function mothly_graph()
{
	$CI 	=& get_instance();
	$user_id = $CI->session->userdata('user_id');
    //header('Content-Type: application/json');
	$user_montly = $CI->db->query("SELECT COUNT(s.`postID`) as total,MONTH(date(s.created_at)) as month
		FROM spotlights s 
		WHERE s.userid = ".$user_id." AND s.status=1 
		AND YEAR(date(s.created_at)) =  YEAR(date(NOW()))
		GROUP BY MONTH(date(s.created_at))")->result();
	/*echo '<pre>'; 
	print_r($user_montly[0]->month);
	exit;*/
	$month_arr = array(1,2,3,4,5,6,7,8,9,10,11,12);
	$i=0;
	$user_month_data=array();
	$ii=0;
	foreach ($month_arr as $month_value) {
		
		if(!empty($user_montly[$i]->month) && $month_value==$user_montly[$i]->month){
			$user_month_data[$ii]= (int)$user_montly[$i]->total;
			$i++;
		}else{
			$user_month_data[$ii]=10;
		}
		$ii++;
	}
	return json_encode($user_month_data);
}
function content_mothly_graph_admin()
{
	$CI 	=& get_instance();

    //header('Content-Type: application/json');
	$user_montly = $CI->db->query("SELECT COUNT(s.`postID`) as total,MONTH(date(s.created_at)) as month
		FROM spotlights s 
		WHERE s.status=1 
		AND YEAR(date(s.created_at)) =  YEAR(date(NOW()))
		GROUP BY MONTH(date(s.created_at))")->result();
	/*echo '<pre>'; 
	print_r($user_montly[0]->month);
	exit;*/
	$month_arr = array(1,2,3,4,5,6,7,8,9,10,11,12);
	$i=0;
	$user_month_data=array();
	$ii=0;
	foreach ($month_arr as $month_value) {
		
		if(!empty($user_montly[$i]->month) && $month_value==$user_montly[$i]->month){
			$user_month_data[$ii]= (int)$user_montly[$i]->total;
			$i++;
		}else{
			$user_month_data[$ii]=0;
		}
		$ii++;
	}
	return json_encode($user_month_data);
}
function mothly_graph_signup()
{
	$CI 	=& get_instance();
    //header('Content-Type: application/json');
	$user_montly = $CI->db->query("SELECT COUNT(u.`userID`) as total,MONTH(date(u.created_at)) as month
		FROM users u 
		WHERE u.status=0 
		AND YEAR(date(u.created_at)) =  YEAR(date(NOW()))
		GROUP BY MONTH(date(u.created_at))")->result();
	$month_arr = array(1,2,3,4,5,6,7,8,9,10,11,12);
	$i=0;
	$user_month_data=array();
	$ii=0;
	foreach ($month_arr as $month_value) {
		
		if(!empty($user_montly[$i]->month) && $month_value==$user_montly[$i]->month){
			$user_month_data[$ii]= (int)$user_montly[$i]->total;
			$i++;
		}else{
			$user_month_data[$ii]=0;
		}
		$ii++;
	}
	return json_encode($user_month_data);
}

function timeAgo($time_ago)
{
    $time_ago = strtotime($time_ago);
    $cur_time   = time();
    $time_elapsed   = $cur_time - $time_ago;
    $seconds    = $time_elapsed ;
    $minutes    = round($time_elapsed / 60 );
    $hours      = round($time_elapsed / 3600);
    $days       = round($time_elapsed / 86400 );
    $weeks      = round($time_elapsed / 604800);
    $months     = round($time_elapsed / 2600640 );
    $years      = round($time_elapsed / 31207680 );
    // Seconds
    if($seconds <= 60){
        return "just now";
    }
    //Minutes
    else if($minutes <=60){
        if($minutes==1){
            return "one minute ago";
        }
        else{
            return "$minutes minutes ago";
        }
    }
    //Hours
    else if($hours <=24){
        if($hours==1){
            return "an hour ago";
        }else{
            return "$hours hrs ago";
        }
    }
    //Days
    else if($days <= 7){
        if($days==1){
            return "yesterday";
        }else{
            return "$days days ago";
        }
    }
    //Weeks
    else if($weeks <= 4.3){
        if($weeks==1){
            return "a week ago";
        }else{
            return "$weeks weeks ago";
        }
    }
    //Months
    else if($months <=12){
        if($months==1){
            return "a month ago";
        }else{
            return "$months months ago";
        }
    }
    //Years
    else{
        if($years==1){
            return "one year ago";
        }else{
            return "$years years ago";
        }
    }
}
function is_following($user_id){
		$CI 	=& get_instance();
      $check = $CI->db->get_where('followers',array('is_following'=>$user_id))->num_rows();
	  if($check >0){
		 return TRUE;
	  }else{
		  return FALSE;
	  }
}
function followers_count($user_id){
		$CI 	=& get_instance();
		$check = $CI->db->get_where('followers',array('is_following'=>$user_id))->num_rows();
		return $check;
}
function user_notification($total=false){
	$CI 	=& get_instance();
	$user_id = $CI->session->userdata('user_id');
	if($total){
		$result = $CI->db->order_by('timestamp','desc')->get_where('notifications',array('notify_to'=>$user_id,'status='=>NULL))->num_rows();
	}else{
	$result = $CI->db->order_by('timestamp','desc')->get_where('notifications',array('notify_to'=>$user_id,'status='=>NULL),4,0)->result();
	}
	
	return $result;
	
}
function user_msg($total=false,$limit =4){
	$CI 	=& get_instance();
	$user_id = $CI->session->userdata('user_id');
	if($total){
		$result = $CI->db->order_by('date_time','desc')->get_where('msg_notifiction',array('notify_to'=>$user_id))->num_rows();
	}else{
	$result = $CI->db->order_by('date_time','desc')->get_where('msg_notifiction',array('notify_to'=>$user_id),$limit,0)->result();
	}
	insertVisitor();
	return $result;
	
}
function user_msg_by_sender($user_idd){
	$CI 	=& get_instance();
	$user_id = $CI->session->userdata('user_id');
    $result = $CI->db->order_by('date_time','desc')->get_where('msg_notifiction',array('notify_to'=>$user_id,'by_user'=>$user_idd))->num_rows();
	return $result;
	
}

function current_user(){
	$CI 	=& get_instance();
	if($staff_id = $CI->session->userdata('staff_id')){
		$user_id = $staff_id;
	}else{
		$user_id = $CI->session->userdata('user_id');
	}
	$result = $CI->db->get_where('users',array('userID'=>$user_id))->row();
	return $result;
	
}



if(!function_exists('insertVisitor'))
{	
	function insertVisitor()
	{
		$CI 	=& get_instance();
		$ip		= $_SERVER["REMOTE_ADDR"];
		$user_id = $CI->session->userdata('user_id');
		$CI->db->where(array('user_id' =>$user_id));
		$CI->db->limit(1);
		$query = $CI->db->get('visitors');
		if(	$user_id)$online =1; else $online =0;
		$db = array(
			'user_id'=>$user_id,
				'ip' => $ip,
				'user_agent' => $_SERVER['HTTP_USER_AGENT'],
				'amount' => 1,
				'date' =>  date('Y-m-d H:i:s'),
				'timestamp' => time(),
				'is_online'=>$online
			);
		if($query->num_rows() > 0)
		{
			$CI->db->update('visitors',$db, array('user_id'=>$user_id));
		}
		else
		{
			
			$CI->db->insert('visitors', $db);
		}
	}
}
function multi_in_array($value, $array)
{
    foreach ($array AS $item)
    {
        if (!is_array($item))
        {
            if ($item == $value)
            {
                return true;
            }
            continue;
        }

        if (in_array($value, $item))
        {
            return true;
        }
        else if (multi_in_array($value, $item))
        {
            return true;
        }
    }
    return false;
}

function is_online($user_id){
	$CI 	=& get_instance();
		$CI->db->where(array('user_id' =>$user_id));
		$query = $CI->db->get('visitors')->row();
		if(isset($query) && $query->is_online ==1){
			return TRUE;
		}else{
			return FALSE;
		}
}
/*function is_online($user_id)
{
    $CI =& get_instance();
    $sql_string =
'SELECT last_activity FROM ci_sessions WHERE user_data LIKE "%'.get_field('users','username', $user_id).'%"';    
    $query = $CI->db->query($sql_string);
    if ($query->num_rows() > 0) {return TRUE;}else{
    return FALSE;
	}
}
*/
if(!function_exists('getComments'))
{
	function getComments($type = null, $itemID = 0, $limit = 10)
	{
		$CI =& get_instance();
		if($type == 'updates')
		{
			$CI->db->where('commentType', 0);
		}
		if($type == 'posts')
		{
			$CI->db->where('commentType', 1);
		}
		elseif($type == 'snapshots')
		{
			$CI->db->where('commentType', 2);
		}
		elseif($type == 'openletters')
		{
			$CI->db->where('commentType', 3);
		}
		elseif($type == 'tv')
		{
			$CI->db->where('commentType', 4);
		}
		
		$CI->db->where('itemID', $itemID);
		$CI->db->order_by('commentID', 'DESC');
		$CI->db->limit($limit);
		$query = $CI->db->get('comments');
		$user_id = $CI->session->userdata('user_id');
		$CI->db->where('userID',$user_id);
		$CI->db->from('users');
		$user_info = $CI->db->get()->row();
		$comments = 
			($CI->session->userdata('user_id') ? '
			<form id="addCommentForm2" method="post" class="form-horizontal bg-info rounded-top" action="' . base_url('user/comment/' . $type . '/' . $itemID) . '">
				<div class="col-sm-12">
					<div class="form-group commentArea">
						<div class="col-sm-12 nopadding">
							<div class="input-group">
								<span class="input-group-addon">
									<img src="'.base_url().'uploads/profile_img/'.$user_info->photo.'" width="30" height="30" alt="..." class="rounded" />
								</span>
								<textarea required="required" name="comments" class=" form-control" placeholder="Write Comment"></textarea>
								<span class="input-group-addon">
									<input type="hidden" name="current_url" value="'.$CI->uri->uri_string().'#addCommentForm2" />
									<button class="btn btn-primary nopadding commentBtn22" type="submit"><i class="icon-md" data-feather="send"></i></button>
								</span>
							</div>
							<div class="statusHolder"></div>
						</div>
					</div>
				</div>
			</form>
			' : '
			<div class="bordered text-center bg-info rounded-top" style="background:#fff;padding:10px">
				<a href="'.base_url('enduser/login').'" class="btn btn-warning"><i class="fa fa-lock"></i> &nbsp;  Please Login to Comment</a>
			</div>
			')
		;
		$comments .= '
			<div id="comment_list" class="col-sm-12 rounded-bottom bordered nomargin comments_holder-' . $type . $itemID . '" style="display:none; margin-bottom:10px!important">
				<div class="fetch_new_comment"></div>
		';
		if($query->num_rows() > 0)
		{
			$n = 0;
			foreach($query->result_array() as $row)
			{ 
			$CI->db->where('userID',$row['userID'] );
		    $CI->db->from('users');
			$user_info = $CI->db->get()->row();
			//$comment_id = $row['commentID'];
				$comments .=
				'<div id="comment_'.$row['commentID'].'" class="row comment-tree comment' . $row['commentID'] . '"' . ($n++ != 0 ? ' style="border-top:1px solid #eee"' : '') . '>
						<div class="col-xs-2 col-sm-1" style="padding-right:0">
							<img src="'.base_url().'uploads/profile_img/'.$user_info->photo.'" class="rounded" width="30" height="30" alt="..." />
						</div>
						<div class="col-xs-10 col-sm-11">
							<p class="comment-text relative">
								<a href="#" class="ajaxLoad hoverCard">
									<b>'.$user_info->first_name.' '.$user_info->last_name.'</b> &nbsp; 
								</a>
								<span class="rcomment7">'.$row['comments'].'</span>
								
								<br />
								<br />
								<small class="comment-tools text-muted">
									<i class="fa fa-clock-o"></i> ' . timeAgo($row['timestamp']) . '
								
								' . ($CI->session->userdata('user_id') ? '
								<span class="btn-group22 absolute2">
									' . ($CI->session->userdata('user_id') == $row['userID'] ? '<a class="delete-comment btn btn-xs btn-warning btn-icon-only" href="javascript:void(0)" onclick="confirm_modal(\'' . base_url('user/remove_comment/' . $row['commentID'] . '/' . $type . '-' . $itemID) . '\', \'comment' . $row['commentID'] . '\', \'' . $type . $itemID . '\')">Delete</a>' : '<a class="reply-comment btn btn-xs btn-default btn-icon-only" href="javascript:void(0)" data-reply="' . $row['commentID'] . '" data-summon="" data-push="tooltip" data-placement="top" data-title="Reply"><i class="fa fa-reply"></i></a><a class="report-comment btn btn-xs btn-default btn-icon-only" href="javascript:void(0)" onclick="confirm_modal(\'' . base_url('user/report/comments/' . $row['commentID'] . '/' . $type . '-' . $itemID) . '\', \'comment' . $row['commentID'] . '\', \'' . $type . $itemID . '\')" data-push="tooltip" data-plcement="top" data-title="Report"><i class="fa fa-ban"></i></a>') . '
								</span>
								' : '') . '
								</small>
							</p>
						</div>
					</div>
				';
				$n++;
			}
		}
		else
		{
			$comments .= '<div class="col-sm-12 text-center text-muted"><small>be first to comment</small></div>';
		}
		$comments .='</div><div class="clearfix"></div>';
		
		return $comments;
	}
}
if(!function_exists('time_since'))
{
	function time_since($date = null)
	{
		$chunks = array(
			array(60 * 60 * 24 * 365, 'year'),
			array(60 * 60 * 24 * 30,'month'),
			array(60 * 60 * 24 * 7, 'week'),
			array(60 * 60 * 24, 'day'),
			array(60 * 60, 'hour'),
			array(60, 'minute'),
		);
	 
		$today = time();
		$since = $today - $date;
	 
		if ($since > 604800)
		{
			$print = date("M jS", $date);
			if ($since > 31536000)
			{
				$print .= ", " . date("Y", $date);
			}
			return $print;
		}
	 
		for ($i = 0, $j = count($chunks); $i < $j; $i++)
		{
			$seconds = $chunks[$i][0];
			$name = $chunks[$i][1];
	 
			if (($count = floor($since / $seconds)) != 0)
			break;
		}
	 
		$print = ($count == 1) ? '1 ' . $name : $count . ' ' . $name;
		return ($print == 0 ? phrase('just_now') : ($print > 1 ? $print . strtolower(phrase('s')) : $print));
	}
}

if(!function_exists('random_hex'))
{
	function random_hex($length = 6)
	{
		$characters = '0123456789ABCDEF';
		$string = '';
		for ($i = 0; $i < $length; $i++)
		{
			$string .= $characters[mt_rand(0, strlen($characters) - 1)];
		}
		return $string;
	}
}

if(!function_exists('generateBreadcrumb'))
{
	function generateBreadcrumb()
	{
		$CI = &get_instance();
		$i = 1;
		$uri = $CI->uri->segment($i);
		$link = '';
	 
		while($uri != '')
		{
			$prep_link = '';
			for($j=1; $j<=$i;$j++)
			{
				$prep_link .= $CI->uri->segment($j).'/';
			}
			$uriSegments = ($CI->uri->segment($i+1));
			if($uriSegments == '')
			{
				$link .= '<li class="active"><a href="'.site_url($prep_link).'" class="ajaxLoad">' . ucwords(str_replace('_', ' ', $CI->uri->segment($i))) . '</a></li>';
			}
			else
			{
				$link .= '<li><a href="'.site_url($prep_link).'" class="ajaxLoad">' . ucwords(str_replace('_', ' ', $CI->uri->segment($i))) . '</a><span class="divider"></span></li>';
			}
		 
			$i++;
			$uri = $CI->uri->segment($i);
		}
		$link .= '';
		return $link;
	}
}
function secure_file_upload($file_name,$destination,$allowed_file_type=array('jpg', 'jpeg', 'png'),$max_upload_size=2, $uniqueName = false) {
    $max_upload_size_byte = $max_upload_size * 1024 * 1024;

    if(!is_dir($destination))
        {
            $making = mkdir($destination,0777, true);
            chmod($destination, 0777);

            if(!$making) return false;
        }

    $fileName = $file_name['name'];
    $file_type = substr($fileName, strrpos($fileName, '.') + 1);
    $file_type = strtolower($file_type);

    if( !array_search($file_type, $allowed_file_type) && !in_array($file_type, $allowed_file_type) ) return false;
    if( $file_name['size'] > $max_upload_size_byte ) return false;
    if( $file_name['error'] != 0 ) return false;

    $final_name = time()."_".preg_replace("/[^a-zA-Z0-9-_.]+/", "", $file_name['name']);

    if( $uniqueName == true ) {
        $file_detail = pathinfo($final_name);
        $final_name = md5(uniqid($file_detail['filename'], true)).'.'.strtolower($file_detail['extension']);
    }

    $final_des = $destination.$final_name;
    $uploading = move_uploaded_file($file_name['tmp_name'],$final_des);
    if( !$uploading ) return false;
    return $final_name;
}

function display_image2(){
	$CI = &get_instance();
	$spotlightid = $CI->uri->segment(3);
	$spotlight_images = $CI->db->query("SELECT * FROM spotlights_images WHERE spotlight_id=".$spotlightid)->result_array();

	foreach ($spotlight_images as $spotlight_image) {
		$file_link[] = FCPATH ."uploads/profile_img/".$spotlight_image['image_name'];
		
	}
	$result = explode(',',$file_link);
	print_r($result);
	return $result;

}
function display_image2_config(){
	$CI = &get_instance();
	$spotlightid = $CI->uri->segment(3);
	$spotlight_images = $CI->db->query("SELECT * FROM spotlights_images WHERE spotlight_id=".$spotlightid)->result_array();

	foreach ($spotlight_images as $spotlight_image) {
		$file_link[] = FCPATH ."uploads/profile_img/".$spotlight_image['image_name'];
		
		$obj['caption'] = $spotlight_image['image_name'];
		$obj['size'] = '1000';
		$obj['url'] = FCPATH ."uploads/profile_img/".$spotlight_image['image_name'];
		$obj['key'] = $spotlight_image['id'];
		$result[] = $obj;
		
	}
	return json_decode($result);

}
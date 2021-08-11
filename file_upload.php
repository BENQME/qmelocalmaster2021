<html>
<head>
<title>PHP File Upload example</title>
</head>
<body>

<form action="file_upload.php" enctype="multipart/form-data" method="post" accept-charset="utf-8">
Select image :
<input type="file" name="file"><br/>
<input type="submit" value="Upload" name="Submit1"> <br/>


</form>
<?php
  header("Content-Type: text/html; charset=utf-8");

 if(isset($_POST['Submit1']))
{ 
$file_tmp = $_FILES['file']['tmp_name'];
$fnm = $_FILES["file"]["name"];
$filepath = "uploads/" . $_FILES["file"]["name"];

//$filepath="https://github.com/BENQME/qmelocalmaster2021/tree/main/uploads". $_FILES["file"]["name"];
$up=move_uploaded_file($file_tmp, $filepath);
  //copy($file_tmp, $filepath);
//exec("git add .");  
//exec("git commit -m'message'");
 function pushFile($username,$token,$repo,$branch,$path,$b64data,$filename){
    $message = "Automated update";
    $ch = curl_init("https://api.github.com/repos/$repo/branches/$branch");
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('User-Agent:Php/Automated'));
    curl_setopt($ch, CURLOPT_USERPWD, $username . ":" . $token);
    curl_setopt($ch, CURLOPT_TIMEOUT, 30);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    $data = curl_exec($ch);
    curl_close($ch);
    $data=json_decode($data,1);

    $ch2 = curl_init($data['commit']['commit']['tree']['url']);
    curl_setopt($ch2, CURLOPT_HTTPHEADER, array('User-Agent:Php/Ayan Dhara'));
    curl_setopt($ch2, CURLOPT_USERPWD, $username . ":" . $token);
    curl_setopt($ch2, CURLOPT_TIMEOUT, 30);
    curl_setopt($ch2, CURLOPT_RETURNTRANSFER, TRUE);
    $data2 = curl_exec($ch2);
    curl_close($ch2);
    $data2=json_decode($data2,1);

    $sha='';
    foreach($data2["tree"] as $file)
      if($file["path"]==$path)
        $sha=$file["sha"];
    
    $inputdata =[];
    $inputdata["path"]=$path;
    $inputdata["branch"]=$branch;
    $inputdata["message"]=$message;
    $inputdata["content"]=$b64data;
    $inputdata["sha"]=$sha;

    echo json_encode($inputdata);

    //$updateUrl="https://api.github.com/repos/$repo/contents/$path";
	$updateUrl="https://api.github.com/repos/$repo/contents/$path/$filename";
    echo $updateUrl;
    $ch3 = curl_init($updateUrl);
    curl_setopt($ch3, CURLOPT_HTTPHEADER, array('Content-Type: application/xml', 'User-Agent:Php/BENQME'));
    curl_setopt($ch3, CURLOPT_USERPWD, $username . ":" . $token);
    curl_setopt($ch3, CURLOPT_TIMEOUT, 30);
    curl_setopt($ch3, CURLOPT_CUSTOMREQUEST, "PUT");
    curl_setopt($ch3, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch3, CURLOPT_POSTFIELDS, json_encode($inputdata));
    $data3 = curl_exec($ch3);
    curl_close($ch3);

    echo $data3;
  }
  //pushFile("your_username","your_personal_token","username/repository","repository_branch","path_of_targetfile_in_repository","base64_encoded_data");
if($up) 
{
	pushFile("BENQME"," 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","BENQME/qmelocalmaster2021","main","uploads","base64_encoded_data","$fnm");
echo "<img src=".$filepath." height=200 width=300 />";
} 
else 
{
echo "Error !!";
}
} 
?>

</body>
</html

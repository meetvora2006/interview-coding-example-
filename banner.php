<?php
error_reporting(0);
$conn = mysql_connect('localhost', 'root', '');
mysql_select_db('insegmentdb');

$ip = $_SERVER['REMOTE_ADDR']; // localhost ip
$user_agent = $_SERVER['HTTP_USER_AGENT'];
$date = date("Y-m-d H:i:s");
$url = $_SERVER['HTTP_REFERER']; 


$checkdata= mysql_query("SELECT * FROM ImageLog WHERE ip_address ='$ip' and user_agent ='$user_agent' and page_url ='$url' ");

if (mysql_num_rows($checkdata)==0) { 
    
$sql = "INSERT INTO ImageLog (ip_address, user_agent, view_date, page_url, views_count)
VALUES ('$ip', '$user_agent', '$date', '$url', '1')";
}

else{
    
    $getcount = mysql_fetch_object($checkdata);
    
    $count = $getcount ->views_count + 1 ;
     $sql = "UPDATE ImageLog SET view_date = '$date', views_count = '$count' WHERE ip_address ='$ip' and user_agent ='$user_agent' and page_url ='$url' ";
}
    
$result = mysql_query($sql, $conn);

//imagejpeg('meet.jpg');
header ('content-type: image/jpeg');
readfile('myimg.jpg');

?>
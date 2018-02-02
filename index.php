<?php
$filename = 'store/counter.txt';
$ip_filename = 'store/ip.txt';

function get_ip()
{
	if(!empty($_SERVER['HTTP_CLIENT_IP']))
	{
		$ip_address = $_SERVER['HTTP_CLIENT_IP'];
	}else if(!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
	{
		$ip_address = $_SERVER['HTTP_X_FORWARDED_FOR'];
	}else{
		$ip_address = $_SERVER['REMOTE_ADDR'];
	}
	return $ip_address;
}

function RecordUniqueVisitorCount(){
	$ip = get_ip();
	global $filename, $ip_filename, $current_visitor_Count;
	$current_visitor_Count = (file_exists($filename)) ? file_get_contents($filename) : 0;
	if(!in_array($ip, file($ip_filename, FILE_IGNORE_NEW_LINES))){
		file_put_contents($ip_filename, $ip."\n", FILE_APPEND);
		file_put_contents($filename, ++$current_visitor_Count);
	}
}

      RecordUniqueVisitorCount();
      echo $current_visitor_Count . " - ";
?>

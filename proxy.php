<?php

// Get the input param
$url = 0;
if(isset($_GET['url'])) {
	$url = $_GET['url'];
} elseif(isset($_POST['url'])) {
	$url = $_POST['url'];
}  

// return if no valid URL
if(!$url) {
	echo "Please provide a valid URL";
	return;
}

// Defining the default curl options
$defaults = array(
	        CURLOPT_URL => $url, 
	        CURLOPT_RETURNTRANSFER => TRUE	  
		);

// Open the curl session
$session = curl_init();

// Intialize
curl_setopt_array($session, $defaults);

// Make the call
$resp = curl_exec($session);

// Honor the content type header
$headers = curl_getinfo($session);
if(isset($headers['content_type'])) {
	header("Content-Type: ".$headers['content_type']);
}

// Close the connection
curl_close($session);

echo $resp;

?>
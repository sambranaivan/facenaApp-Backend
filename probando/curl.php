<?php
error_reporting(1);

$username='ivan';
$password='sambrana';
$URL='www.google.com';

$ch = curl_init();

print_r($ch);
curl_setopt($ch, CURLOPT_URL,$URL);
curl_setopt($ch, CURLOPT_TIMEOUT, 30); //timeout after 30 seconds
curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
curl_setopt($ch, CURLOPT_USERPWD, $username.":".$password);
$result=curl_exec ($ch);
$status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);   //get status code

print_r($result);
print_r($status_code);
curl_close ($ch);

?>

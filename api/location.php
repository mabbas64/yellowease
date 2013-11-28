<?php 
//API Handler for getting users location
include '../libs/common.php';

//check for coordinates
if( !isset( $_POST["lat"] ) || !isset( $_POST["lng"] ) ){ 
  echo json_encode(array('error' => "missing one or more coordinates")); 
  exit(); 
}

$url = 'http://maps.googleapis.com/maps/api/geocode/json?latlng='.$_POST["lat"].','.$_POST["lng"].'&sensor=true';
$curl_handle = curl_init();
curl_setopt($curl_handle, CURLOPT_URL, $url);
curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($curl_handle);
curl_close($curl_handle);

$results = json_decode($response);
$city = $results->results[0]->address_components[3]->short_name;
$state = $results->results[0]->address_components[5]->short_name;

if( !empty( $results ) ){
  if (!isset($_SESSION)){ session_start(); }
  $_SESSION['location'] = $city . ',' . $state;
  echo json_encode(array('success' => $results)); 
} else {
  echo json_encode(array('error' => "no results found")); 
}
exit();
?>

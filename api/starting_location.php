<?php 
//API Handler for starting session for initial location set by Google Geolocation
include '../libs/common.php';

if (!isset($_SESSION)){ session_start(); }

if( isset( $_POST["location"] ) ){
  $_SESSION['location'] = $_POST["location"];
  $loc = $_SESSION['location'];
} else if( isset( $_SESSION['location'] ) ) {
  $loc = $_SESSION['location'];
} else {
  $loc = false;
}

if( !empty( $results ) ){ 
  echo json_encode(array('success' => $results)); 
  exit();
} else {
  echo json_encode(array('error' => "no results found")); 
  exit();
}
?>

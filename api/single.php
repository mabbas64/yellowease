<?php 
//API Handler for Search Single
include '../libs/common.php';

if( !isset( $_POST["biz_id"] ) ){ exit(); }
$city = new citygrid( "10000004902" );
$results = $city->places_detail( $_POST["biz_id"] );

if( !empty( $results ) ){ 
  echo json_encode(array('success' => $results)); 
  exit();
} else {
  echo json_encode(array('error' => "no results found")); 
  exit();
}
?>
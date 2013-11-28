<?php 
//API Handler for getting modal info
include '../libs/common.php';
var_dump($_POST["type"]);
if( !isset( $_POST["type"] ) ){ exit(); }
$city = new citygrid( "10000004902" );
$results = $city->places_detail( $id, "cg", $_POST["phone"] );

if( !empty( $results ) ){ 
  echo json_encode(array('success' => $results)); 
  exit();
} else {
  echo json_encode(array('error' => "no results found")); 
  exit();
}
?>

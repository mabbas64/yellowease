<?php 
//API Handler for Search
include '../libs/common.php';

if( !isset( $_POST["what"] ) || 
    !isset( $_POST["where"] ) || 
    !isset( $_POST["page_num"] ) || 
    !isset( $_POST["sortby"] ) || 
    !isset( $_POST["count"] ))
    { exit(); }

$city = new citygrid( "10000004902" );
$results = $city->srch_places_where( $_POST["what"], null, $_POST["where"], $_POST["page_num"], $_POST["sortby"], $_POST["count"] );

if( !empty( $results ) ){ 
  echo json_encode(array('success' => $results)); 
  exit();
} else {
  echo json_encode(array('error' => "no results found")); 
  exit();
}
?>

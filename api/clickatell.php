<?php 
//API Handler for getting text session ID
include '../libs/common.php';

//check for text and phone number
if( !isset( $_POST["phone"] ) || !isset( $_POST["texturl"] ) ){ 
  echo json_encode(array("error" => "missing text or phone number")); 
  exit(); 
}

//check for session ID
$session_url = 'https://api.clickatell.com/http/auth?api_id=3425799&user=YellowGarage&password=yell0wGarage';
$curl_handle = curl_init();
curl_setopt($curl_handle, CURLOPT_URL, $session_url);
curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($curl_handle);
curl_close($curl_handle);

//Session ID
$session_OK = substr($response, 0, 2);
$session_id = substr($response, 4);

if( $session_OK == "OK" ){
  $texting_url = 'http://api.clickatell.com/http/sendmsg?session_id=' . $session_id . '&to=1' . $_POST["phone"] . '&text=testsuccess';
  $text_curl_handle = curl_init();
  curl_setopt($text_curl_handle, CURLOPT_URL, $texting_url);
  curl_setopt($text_curl_handle, CURLOPT_RETURNTRANSFER, true);
  $text_response = curl_exec($text_curl_handle);
  curl_close($text_curl_handle);
  if( substr($text_response, 0, 2) == "ID" ){
    echo json_encode(array("success" => "message sent")); 
    exit(); 
  } else {
    echo json_encode(array("error" => "Message send unsuccessful")); 
    exit(); 
  }
} else {
  echo json_encode(array("error" => "session ID missing")); 
  exit(); 
}
?>

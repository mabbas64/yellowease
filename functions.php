<?php 
//Child Theme Functions

if (!isset($_SESSION)){ session_start(); }

//Find users geolocation
function checkLocationSetting() {
  if( isset( $_GET["location"] ) ){
    $_SESSION['location'] = $_GET["location"];
    $loc = $_SESSION['location'];
  } else if( isset( $_GET['where'] ) ) {
    $_SESSION['location'] = $_GET['where'];
    $loc = $_SESSION['location'];
  } else if( isset( $_SESSION['location'] ) ) {
    $loc = $_SESSION['location'];
  } else {
    $loc = false;
  }
  return $loc;
}

//Filtering Search Results
function filterResults( $term ) {
  $possible_terms = array(
    $health = array(
      'health',
      'medical',
      'doctors',
      'hospitals',
      'pharmacies',
      'physicians',
      'surgeons'
    ),
    $food = array(
      'restaurants',
      'dining',
      'eats',
      'food',
      'sushi',
      'pizza',
      'chinese',
      'bars'
    ),
    $shopping = array(
      'clothing',
      'shoes',
      'luxury',
      'bookstores',
      'art',
      'jewelry',
      'watches',
      'florists'
    ),
    $home = array(
      'cleaners',
      'electricians',
      'flooring',
      'contractors',
      'interior designers',
      'landscapes',
      'roofing'
    ),
    $legal = array(
      'accountants',
      'consultants',
      'attorneys',
      'business attorneys',
      'business',
      'injury attorneys',
      'real estate attorneys',
    ),
    $construction = array(
      'contractors',
      'movers',
      'painters',
      'roofers',
      'repair',
      'construction',
      'remodeling',
      'leasing'
    ),
    $entertainment = array(
      'movies',
      'music',
      'sport',
      'arts',
      'attractions',
      'bars',
      'clubs'
    ),
    $auto = array(
      'auto',
      'automotive',
      'cars',
      'tires',
      'repair',
      'leasing',
      'deals',
      'agents'
    )
  );

  $spaces = preg_match('/\s/',$term);
  $space = ($spaces > 0) ? true: false;
  if($space == true){
    list($first_term, $second_term) = explode(' ', $term);
  } 
  foreach ($possible_terms as $subgroup){
    if(!is_null($first_term)){
      if(in_array($first_term, $subgroup)){
        return $subgroup;
      } else if(in_array($second_term, $subgroup)) {
      }
    } else {
      if(in_array($term, $subgroup)){
        return $subgroup;
      }
    }
  }
}

function my_scripts_method() {
  wp_enqueue_script(
    'custom-script',
    get_stylesheet_directory_uri() . '/js/search.js',
    array( 'jquery' )
  );
}

add_action( 'wp_enqueue_scripts', 'my_scripts_method' );
?>

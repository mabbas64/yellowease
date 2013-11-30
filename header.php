<?php 
global $data;
//Location handling
$loc = checkLocationSetting();
$urlloc = ( isset( $_GET['location'] ) || isset( $_GET['where'] ) ) ? true : false;
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width" />
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<link href='http://fonts.googleapis.com/css?family=Quattrocento:400,700|Varela+Round|Oxygen:400,700|Fjalla+One|Varela|Satisfy' rel='stylesheet' type='text/css'>
  <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=true"></script>
  <link type="text/css" rel="stylesheet" href="<?php echo bloginfo('stylesheet_directory'); ?>/style.css">
	<script type="text/javascript" src="<?php echo bloginfo('stylesheet_directory'); ?>/js/jquery-1.8.3.min.js"></script>
  <script type="text/javascript" src="<?php echo bloginfo('stylesheet_directory'); ?>/js/main.js"></script>
	<script type="text/javascript" src="<?php echo bloginfo('stylesheet_directory'); ?>/js/location.js"></script>
	<!--[if IE]><script type="text/javascript" src="js/ie.js"></script><![endif]-->
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
  <?php wp_head(); ?>
  <script type="text/javascript" src="<?php echo bloginfo('stylesheet_directory'); ?>/js/plugins.js"></script>
  <script type="text/javascript" src="<?php echo bloginfo('stylesheet_directory'); ?>/js/jsrender.js"></script>
  <!--[if lte IE 7]>
<meta http-equiv="refresh" content="0;URL=<?php bloginfo('template_directory'); ?>/browser-warning/">
<![endif]-->

<!-- google font-face stuff starts here -->
  <?php if($data['google_body'] && $data['google_body'] != 'Select Font'): ?>
  <?php $gfont[urlencode($data['google_body'])] = '"' . urlencode($data['google_body']) . ':400,400italic,700,700italic:latin,greek-ext,cyrillic,latin-ext,greek,cyrillic-ext,vietnamese"'; ?>
  <?php endif; ?>

  <?php if($data['google_nav'] && $data['google_nav'] != 'Select Font' && $data['google_nav'] != $data['google_body']): ?>
  <?php $gfont[urlencode($data['google_nav'])] = '"' . urlencode($data['google_nav']) . ':400,400italic,700,700italic:latin,greek-ext,cyrillic,latin-ext,greek,cyrillic-ext,vietnamese"'; ?>
  <?php endif; ?>

  <?php if($data['google_headings'] && $data['google_headings'] != 'Select Font' && $data['google_headings'] != $data['google_body'] && $data['google_headings'] != $data['google_nav']): ?>
  <?php $gfont[urlencode($data['google_headings'])] = '"' . urlencode($data['google_headings']) . ':400,400italic,700,700italic:latin,greek-ext,cyrillic,latin-ext,greek,cyrillic-ext,vietnamese"'; ?>
  <?php endif; ?>

  <?php if($data['google_footer_headings'] && $data['google_footer_headings'] != 'Select Font' && $data['google_footer_headings'] != $data['google_body'] && $data['google_footer_headings'] != $data['google_nav'] && $data['google_footer_headings'] != $data['google_headings']): ?>
  <?php $gfont[urlencode($data['google_footer_headings'])] = '"' . urlencode($data['google_footer_headings']) . ':400,400italic,700,700italic:latin,greek-ext,cyrillic,latin-ext,greek,cyrillic-ext,vietnamese"'; ?>
  <?php endif; ?>

  <?php if($gfont): ?>
  <?php
  if(is_array($gfont) && !empty($gfont)) {
    $gfonts = implode($gfont, ', ');
  }
  ?>
  <?php endif; ?>
  <script type="text/javascript">
  WebFontConfig = {
    <?php if(!empty($gfonts)): ?>google: { families: [ <?php echo $gfonts; ?> ] },<?php endif; ?>
    custom: { families: ['FontAwesome'], urls: ['<?php bloginfo('template_directory'); ?>/fonts/fontawesome.css'] }
  };
  (function() {
    var wf = document.createElement('script');
    wf.src = ('https:' == document.location.protocol ? 'https' : 'http') +
      '://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js';
    wf.type = 'text/javascript';
    wf.async = 'true';
    var s = document.getElementsByTagName('script')[0];
    s.parentNode.insertBefore(wf, s);
  })();
  </script>

<!-- google font-face stuff ends here -->
<style type="text/css">

.ddc-ad .title a {
  font-family: 'Fjalla One', Helvetica, Arial, sans-serif;
}

body {
  font:15px/24px 'Quattrocento', Georgia, Times, serif;
}

#locations_header ul a {
  font-family: 'Varela Round', Arial, Helvetica, sans-serif;
}

#city_search input[type="submit"] {
  font:15px/18px 'Varela Round', Arial, Helvetica, sans-serif;
}

.location-box{
  font:bold 13px/15px 'Oxygen', Arial, Helvetica, sans-serif;
}

.location-box .location-link{
  font:bold 13px/15px 'Oxygen', Arial, Helvetica, sans-serif;
}

.logo a{
  font:normal 30px/30px 'Oxygen', Arial, Helvetica, sans-serif;
}

.search-form input[type="text"]{
  font:16px/20px 'Varela Round', Arial, Helvetica, sans-serif;
}

<?php
if(!$custom_font && $data['google_nav'] != 'Select Font') {
  $nav_font = '"'.$data['google_nav'].'", Arial, Helvetica, sans-serif !important';
} elseif(!$custom_font && $data['standard_nav'] != 'Select Font') {
  $nav_font = $data['standard_nav'].' !important';
}
if(isset($nav_font)):
?>

#nav ul{
  font:13px/16px <?php echo $nav_font; ?>;
}

<?php endif; ?>

#info_modal form button {
  font:15px/18px 'Varela Round', Arial, Helvetica, sans-serif;
  }

.content-box{
  font:14px/18px 'Varela Round', Arial, Helvetica, sans-serif;
}

.content-box h2{
  font:21px/26px 'Fjalla One', Arial, Helvetica, sans-serif;
}

.content-box .phone{
  font:22px/25px 'Varela', Arial, Helvetica, sans-serif;
}

.content-box p{
  font-family: 'Quattrocento', serif;
}

.links-item li a{
  font:15px/18px 'Varela Round', Arial, Helvetica, sans-serif;
}

.advertise-link{
  font:13px/16px 'Varela Round', Arial, Helvetica, sans-serif;
}

.columns-item h3{
  font:18px/22px 'Fjalla One', Arial, Helvetica, sans-serif;
}

#content h1{
font:30px/36px 'Fjalla One', Arial, Helvetica, sans-serif;
  }

.restaurant-box .image-box a{
  font:12px/15px 'Varela', Arial, Helvetica, sans-serif;
}

.restaurant-box .info-text{
  font:16px/20px 'Fjalla One', Arial, Helvetica, sans-serif;
}

.restaurant-box .phone{
  font:22px/25px 'Varela', Arial, Helvetica, sans-serif;
  }

.restaurant-box address{
  font:16px/17px 'Varela', Arial, Helvetica, sans-serif;
}

.reviews-box{
  font:14px/18px 'Varela Round', Arial, Helvetica, sans-serif;
}

#content .links-item li a{
  font:13px/16px 'Varela Round', Arial, Helvetica, sans-serif; 
}

.content-nav ul{
  font:13px/18px 'Varela Round', Arial, Helvetica, sans-serif;
}

#content .view-link{
  font:14px/18px 'Varela Round', Arial, Helvetica, sans-serif;
}

.filter-form{
  font:14px/24px 'Varela Round', Arial, Helvetica, sans-serif;
}

.filter-form select{
  font:14px/24px 'Varela Round', Arial, Helvetica, sans-serif;
}

.results-text{
  font:14px/18px 'Varela Round', Arial, Helvetica, sans-serif;
}
.restaurant-item{
  font:16px/24px 'Varela Round', Arial, Helvetica, sans-serif;
}

#content .restaurant-item h2{
  font:18px/24px 'Fjalla One', Arial, Helvetica, sans-serif;
}

#load_more {
  font:15px/18px 'Varela Round', Arial, Helvetica, sans-serif;
}

.filter-nav ul{
  font:16px/20px 'Fjalla One', Arial, Helvetica, sans-serif;
}

#sidebar h3{
  font:20px/24px 'Fjalla One', Arial, Helvetica, sans-serif;
}

#sidebar h4{
  font:15px/18px 'Fjalla One', Arial, Helvetica, sans-serif;
} 

.tagcloud{
  font:12px/23px 'Varela', Arial, Helvetica, sans-serif;
} 

.places-item{
  font:14px/24px 'Varela Round', Arial, Helvetica, sans-serif;
}

.places-item address{
  font-family: 'Quattrocento', sans-serif;
}

.footer-title{
  font:40px/55px 'Satisfy', "Comic Sans MS", cursive;
}

.socials-item{
  font:700 22px/27px 'Oxygen', Arial, Helvetica, sans-serif;
}

.copyright-holder .logo a {
  font:normal 24px/24px 'Oxygen', Arial, Helvetica, sans-serif!important;
}

a.get-directions {
  font:15px/18px 'Varela Round', Arial, Helvetica, sans-serif;
}

</style>

</head>
<body>
  <div id="locations_header" style="display: none;">
    <h2>Popular Cities</h2>
    <ul>
      <li>
        <a href="#" name="atlanta" data-loc="atlanta,GA">Atlanta, GA</a>
      </li>
      <li>
        <a href="#" name="austin" data-loc="austin,TX">Austin, TX</a>
      </li>
      <li>
        <a href="#" name="berkeley" data-loc="berkeley,CA">Berkeley, CA</a>
      </li>
      <li>
        <a href="#" name="boston" data-loc="boston,MA">Boston, MA</a>
      </li>
      <li>
        <a href="#" name="sacramento" data-loc="sacramento,CA">Sacramento, CA</a>
      </li>
    </ul>
    <ul>
      <li>
        <a href="#" name="chicago" data-loc="chicago,IL">Chicago, IL</a>
      </li>
      <li>
        <a href="#" name="dallas" data-loc="dallas,TX">Dallas, TX</a>
      </li>
      <li>
        <a href="#" name="denver" data-loc="denver,CO">Denver, CO</a>
      </li>
      <li>
        <a href="#" name="detroit" data-loc="detroit,MI">Detroit, MI</a>
      </li>
      <li>
        <a href="#" name="saintlouis" data-loc="Saint Louis,MO">Saint Louis, MO</a>
      </li>
    </ul>
    <ul>
      <li>
        <a href="#" name="honolulu" data-loc="honolulu,HI">Honolulu, HI</a>
      </li>
      <li>
        <a href="#" name="houston" data-loc="houston,TX">Houston, TX</a>
      </li>
      <li>
        <a href="#" name="lasvegas" data-loc="Las Vegas,NV">Las Vegas, NV</a>
      </li>
      <li>
        <a href="#" name="losangeles" data-loc="Los Angeles,CA">Los Angeles, CA</a>
      </li>
      <li>
        <a href="#" name="sandiego" data-loc="san diego,CA">San Diego, CA</a>
      </li>
    </ul>
    <ul>
      <li>
        <a href="#" name="miami" data-loc="miami,FL">Miami, FL</a>
      </li>
      <li>
        <a href="#" name="minneapolis" data-loc="minneapolis,MN">Minneapolis, MN</a>
      </li>
      <li>
        <a href="#" name="newyork" data-loc="New York,NY">New York, NY</a>
      </li>
      <li>
        <a href="#" name="oakland" data-loc="oakland,CA">Oakland, CA</a>
      </li>
      <li>
        <a href="#" name="sanjose" data-loc="san jose,CA">San Jose, CA</a>
      </li>
    </ul>
    <ul>
      <li>
        <a href="#" name="orangecounty" data-loc="orange county,CA">Orange County, CA</a>
      </li>
      <li>
        <a href="#" name="philidalphia" data-loc="philidalphia,PA">Philidalphia, PA</a>
      </li>
      <li>
        <a href="#" name="phoenix" data-loc="phoenix,AZ">Phoenix, AZ</a>
      </li>
      <li>
        <a href="#" name="portland" data-loc="portland,OR">Portland, OR</a>
      </li>
      <li>
        <a href="#" name="seattle" data-loc="seattle,WA">Seattle, WA</a>
      </li>
    </ul>
    <ul>
      <li>
        <a href="#" name="washingtondc" data-loc="washington,DC">Washington, DC</a>
      </li>
    </ul>
    <form id="city_search" method="get" action="<?php echo site_url(); ?>">
      <span>Search for a location:</span>
      <input type="text" name="where">
      <input type="submit" id="city_search_submit" value="Search">
    </form>
  </div>
  <div id="wrapper">
    <div class="w1">
      <header id="header">
        <div class="logo-holder">
          <div class="location-box">
            <span id="city_state">Locating...</span>
            <a href="#" class="location-link" id="change_location">Change Location</a>
          </div>
          <ul class="social-networks">
            <!--<li><a href="#" class="facebook">Facebook</a></li>
            <li><a href="#" class="twitter">Twitter</a></li> -->
          </ul>
          <h1 class="logo"><a href="<?php echo site_url(); ?>"><img src="<?php echo $data['logo2']; ?>" alt="<?php bloginfo('name'); ?>" /></a></h1>
        </div>
        <div class="header-holder">
          <span id="url_loc_set" style="display: none;" data-urlloc="<?php echo $urlloc; ?>"></span>
          <span id="location_set" style="display: none;" data-curloc="<?php echo $loc; ?>"></span>
          <span id="url_base" style="display: none;" data-bassurl="<?php echo bloginfo('stylesheet_directory'); ?>"></span>
          <div class="search-box">
            <!-- Main Search Form -->
            <form action="<?php echo get_settings('home'); ?>/serp/" type="post" class="search-form">
              <fieldset>
                <input type="text" name="search" placeholder="Search for what’s around you (e.g. Starbucks, plumbing, Pizza, etc.)">
                <input type="submit" value="search">
              </fieldset>
            </form>
          </div>
        </div>
        <nav id="nav">
          <ul>
            <li><a href="<?php echo site_url(); ?>/serp/?search=personal+services">PERSONAL SERVICES</a></li>
            <li><a href="<?php echo site_url(); ?>/serp/?search=health+and+medical">HEALTH &amp; MEDICAL</a></li>
            <li><a href="<?php echo site_url(); ?>/serp/?search=construction+and+remodeling">CONSTRUCTION &amp; REMODELING</a></li>
            <li><a href="<?php echo site_url(); ?>/serp/?search=food+and+dining">FOOD &amp; DINING</a></li>
            <li><a href="<?php echo site_url(); ?>/serp/?search=arts+and+entertainment">ARTS &amp; ENTERTAINMENT</a></li>
            <li><a href="<?php echo site_url(); ?>/serp/?search=automotive">AUTOMOTIVE</a></li>
          </ul>
        </nav>
      </header>
      <div id="main">

header-css-work-log
<!-- google font-face stuff ends here -->
<style type="text/css">

.ddc-ad .title a {
  font-family: 'Fjalla One', Helvetica, Arial, sans-serif;
}

/*body {
  font:15px/24px 'Quattrocento', Georgia, Times, serif;
}*/

/*#locations_header ul a {
  font-family: 'Varela Round', Arial, Helvetica, sans-serif;
}*/

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

/*.search-form input[type="text"]{
  font:16px/20px 'Varela Round', Arial, Helvetica, sans-serif;
}*/

/* ======= Background Colors from Theme Options ====== */
<?php
////////// BACKGROUND COLORS
if($data['body_background']):
  ?>
  body{
    background-color: <?php echo $data['body_background']; ?>
  }
  <?php
endif;

if($data['footer_background']):
  ?>
  #footer{
    background-color: <?php echo $data['footer_background']; ?>
  }
  <?php
endif;
?>


<?php
/////////// NAV FONTS
if(!$custom_font && $data['google_nav'] != 'Select Font') {
  $nav_font = '"'.$data['google_nav'].'", Arial, Helvetica, sans-serif !important';
} elseif(!$custom_font && $data['standard_nav'] != 'Select Font') {
  $nav_font = $data['standard_nav'].' !important';
}
if(isset($nav_font)):
?>

  #locations_header ul a,
  .search-form input[type="text"],
  #nav ul{
    font-family: <?php echo $nav_font; ?>;
  }

<?php endif; ?>

<?php
////////// HEADING FONTS 
if(!$custom_font && $data['google_headings'] != 'Select Font') {
  $headings_font = '"'.$data['google_headings'].'", Arial, Helvetica, sans-serif !important';
} elseif(!$custom_font && $data['standard_headings'] != 'Select Font') {
  $headings_font = $data['standard_headings'].' !important';
}
if(isset($headings_font)):
?>

  #content h1,
  .columns-item h3,
  #sidebar h3,
  #sidebar h4{ /*fjalla one */
    font-family: <?php echo $headings_font; ?>;
  } 

<?php endif; 
////////// BODY FONTS 

if($data['google_body'] != 'Select Font') {
  $body_font = '"'.$data['google_body'].'", Arial, Helvetica, sans-serif !important';
} elseif($data['standard_body'] != 'Select Font') {
  $body_font = $data['standard_body'].' !important';
}

if(isset($body_font)): ?>

  body{ /*'Quattrocento'*/
    font-family:<?php echo $body_font; ?>;
  }

<?php endif; 
/////////////////////////////////////?>

<?php ////////////////////////////
///////// FONT SIZES /////////////?>
<?php if($data['body_font_size']): ?>
  body,
  .columns-item ul{
    font-size:<?php echo $data['body_font_size']; ?>px !important;
    <?php
    $line_height = round((1.5 * $data['body_font_size']));
    ?>
    /*line-height:<?php echo $line_height; ?>px;*/
    line-height: 24px !important;
  }
<?php endif; ?>
<?php if($data['nav_font_size']): ?>
  #nav ul{
    font-size:<?php echo $data['nav_font_size']; ?>px !important;
    <?php
    $line_height = round((1.5 * $data['body_font_size']));
    ?>
    /*line-height:<?php echo $line_height; ?>px;*/
    line-height: 16px !important;
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

/*.columns-item h3{
  font:18px/22px 'Fjalla One', Arial, Helvetica, sans-serif;
}*/

/*#content h1{
font:30px/36px 'Fjalla One', Arial, Helvetica, sans-serif;
  }*/

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

/*#sidebar h3{
  font:20px/24px 'Fjalla One', Arial, Helvetica, sans-serif;
}

#sidebar h4{
  font:15px/18px 'Fjalla One', Arial, Helvetica, sans-serif;
} */

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
<?php 
//
// Template Name: Serp
//

get_header();
if( isset( $_GET['search'] ) ){ 
  $term = $_GET['search'];
  $url_term = str_replace(' ', '+', $term);
  $filters = filterResults( $term );
}
if( isset( $_GET['searchpage'] ) ){ 
  $page_num = $_GET['searchpage'];
  $next_page = $page_num + 1;
  $prev_page = $page_num - 1;
} else {
  $next_page = 2;
}

$recommended = true;
?>

<?php
$ip_address = urlencode($_SERVER['REMOTE_ADDR']);
$via = urlencode($_SERVER['HTTP_VIA']);
$xfwd = urlencode($_SERVER['HTTP_X_FORWARDED_FOR']);
$user_agent = urlencode($_SERVER['HTTP_USER_AGENT']);
$server_url = urlencode('http://' . $_SERVER['SERVER_NAME'] . $_SERVER['SCRIPT_NAME'] );
$search = urlencode($_GET['search']); //**************CHANGE TO WHATEVER PARAMETER IN URL IS********************************//
$ads = "http://yssads.ddc.com/x1.php?ua=" . $user_agent . "&ip=" . $ip_address . "&surl=" . $server_url . "&kw=" . $search . "&c=19743&n=10";
$ads = simplexml_load_file($ads, null, LIBXML_NOCDATA);
$ads = $ads->ads->ad;
?>

      <span id="url_sterm" style="display: none;" data-sterm="<?php echo $term; ?>"></span>
      <span id="page_num" style="display: none;" data-pagenum="<?php if($page_num){echo $page_num;}else{ echo 1;} ?>"></span>
			<div class="container">
				<div id="content">
					<div class="holder">
						<div style="margin-top:16px;">
						<div class="ddc-caption">Ads</div>
						<?php for ($i = 0; $i < min(5, count($ads)); $i++): ?>
							<?php $ad = $ads[$i]; ?>
							<div class="ddc-ad">
								<div class="title"><a href="<?php echo $ad->url; ?>"><?php echo $ad->title; ?></a></div>
								<div class="description"><a href="<?php echo $ad->url; ?>"><?php echo $ad->description; ?></a></div>
								<div class="display-url"><a href="<?php echo $ad->url; ?>"><?php echo $ad->url['visibleurl']; ?></a></div>
							</div>
						<?php endfor; ?>
						</div>
						
						<form action="#" class="filter-form">
							<fieldset>
								<label for="filter">FILTER BY</label>
								<select id="filter">
									<?php if($filters.length > "2"){ 
                  foreach($filters as $filter){?>
									<option><?php echo $filter; ?></option>
                  <?php }} ?>
								</select>
								<label for="sort">SORT BY</label>
								<select id="sort">
									<option>BEST MATCH</option>
									<option>HIGHEST RATED</option>
									<option>A-Z</option>
								</select>
							</fieldset>
						</form>
						<div class="title-box">
							<h1><?php echo $term; ?> near <span id="searched_city"></span></h1>
							<span class="results-text"></span>
						</div>
						
						<ul class="restaurant-item" id="results_list">
													
							<script id="results_template" type="text/x-jsrender">
              {{if has_video !== false}}
              <li>
								<div class="info-holder">
									{{if image}}
                  <a href="<?php echo site_url(); ?>/profile/?biz={{>public_id}}&phone={{>phone_number}}&has_video=true"><img src="{{>image}}" width="64" height="64" alt="no image"></a>
                  {{else}}
                  <a href="<?php echo site_url(); ?>/profile/?biz={{>public_id}}&phone={{>phone_number}}&has_video=true"><img src="<?php echo bloginfo('stylesheet_directory'); ?>/images/serp-placeholder.png" width="64" height="64" alt="image description"></a>
                  {{/if}}
									<div class="text-box">
										<h2><a href="<?php echo site_url(); ?>/profile/?biz={{>public_id}}&phone={{>phone_number}}&has_video=true">{{>name}}</a></h2>
										<p>{{>sample_categories}}</p>
										<address>{{>address.street}}, {{>address.city}}, {{>address.state}} {{>address.postal_code}}</address>
									</div>
								</div>
								<ul>
									<li><a href="<?php echo site_url(); ?>/profile/?biz={{>public_id}}&phone={{>phone_number}}&has_video=true&linktype=map" class="map-link">Map It</a></li>
									<li><a href="<?php echo site_url(); ?>/profile/?biz={{>public_id}}&phone={{>phone_number}}&has_video=true&linktype=email" class="email-link">Email It</a></li>
									<!--<li><a href="<?php echo site_url(); ?>/profile/?biz={{>public_id}}&phone={{>phone_number}}&has_video=true&linktype=textit" class="text-link">Text It</a></li>-->
									{{if website !== null}}<li><a href="<?php echo site_url(); ?>/profile/?biz={{>public_id}}&phone={{>phone_number}}&has_video=true&linktype=website" class="website-link">Website</a></li>{{/if}}
									{{if user_review_count > 0}}<li><a href="<?php echo site_url(); ?>/profile/?biz={{>public_id}}&phone={{>phone_number}}&has_video=true&linktype=reviews" class="reviews-link">Reviews</a></li>{{/if}}
									{{if has_menu !== false}}<li><a href="<?php echo site_url(); ?>/profile/?biz={{>public_id}}&phone={{>phone_number}}&has_video=true&linktype=menu" class="menu-link">Menu</a></li>{{/if}}
									{{if has_video !== false}}<li><a href="<?php echo site_url(); ?>/profile/?biz={{>public_id}}&phone={{>phone_number}}&has_video=true&linktype=video" class="videos-link">Videos</a></li>{{/if}}
									{{if has_offers !== false}}<li><a href="<?php echo site_url(); ?>/profile/?biz={{>public_id}}&phone={{>phone_number}}&has_video=true&linktype=offers" class="offers-link">Offers</a></li>{{/if}}
								</ul>
							</li>
              {{else}}
              <li>
								<div class="info-holder">
									{{if image}}
                  <a href="<?php echo site_url(); ?>/profile/?biz={{>public_id}}&phone={{>phone_number}}"><img src="{{>image}}" width="64" height="64" alt="no image"></a>
                  {{else}}
                  <a href="<?php echo site_url(); ?>/profile/?biz={{>public_id}}&phone={{>phone_number}}"><img src="<?php echo bloginfo('stylesheet_directory'); ?>/images/yellowease-default.png" width="64" height="64" alt="image description"></a>
                  {{/if}}
									<div class="text-box">
										<h2><a href="<?php echo site_url(); ?>/profile/?biz={{>public_id}}&phone={{>phone_number}}">{{>name}}</a></h2>
										<p>{{>sample_categories}}</p>
										<address>{{>address.street}}, {{>address.city}}, {{>address.state}} {{>address.postal_code}}</address>
									</div>
								</div>
								<ul>
									<li><a href="<?php echo site_url(); ?>/profile/?biz={{>public_id}}&phone={{>phone_number}}&linktype=map" class="map-link">Map It</a></li>
									<li><a href="<?php echo site_url(); ?>/profile/?biz={{>public_id}}&phone={{>phone_number}}&linktype=email" class="email-link">Email It</a></li>
									<!--<li><a href="<?php echo site_url(); ?>/profile/?biz={{>public_id}}&phone={{>phone_number}}&linktype=textit" class="text-link">Text It</a></li>-->
									{{if website !== null}}<li><a href="<?php echo site_url(); ?>/profile/?biz={{>public_id}}&phone={{>phone_number}}&linktype=website" class="website-link">Website</a></li>{{/if}}
									{{if user_review_count > 0}}<li><a href="<?php echo site_url(); ?>/profile/?biz={{>public_id}}&phone={{>phone_number}}&linktype=reviews" class="reviews-link">Reviews</a></li>{{/if}}
									{{if has_menu !== false}}<li><a href="<?php echo site_url(); ?>/profile/?biz={{>public_id}}&phone={{>phone_number}}&linktype=menu" class="menu-link">Menu</a></li>{{/if}}
									{{if has_video !== false}}<li><a href="<?php echo site_url(); ?>/profile/?biz={{>public_id}}&phone={{>phone_number}}&linktype=video" class="videos-link">Videos</a></li>{{/if}}
									{{if has_offers !== false}}<li><a href="<?php echo site_url(); ?>/profile/?biz={{>public_id}}&phone={{>phone_number}}&linktype=offers" class="offers-link">Offers</a></li>{{/if}}
								</ul>
							</li>
              {{/if}}
              </script>
	      						<!--
							<?php if (count($ads) > 5): ?>
							<?php for ($i = 5; $i < min(10, count($ads)); $i++): ?>
								<?php $ad = $ads[$i]; ?>
								<div class="info-holder">
									<p><a href="<?php echo $ad->url; ?>"><?php echo $ad->title; ?></a></p>
									<p><?php echo $ad->description; ?></p>
								</div>
							<?php endfor; ?>
	      						<?php endif; ?>
	      						-->
						</ul>
						<nav class="filter-nav">
              <!--<span class="loading-gif"></span>-->
							<ul>
                <?php if($prev_page){ ?>
								<li class="prev"><a href="<?php echo site_url(); ?>/serp/?search=<?php echo $url_term; ?>&searchpage=<?php echo $prev_page; ?>">PREV</a></li>
								<?php } ?>
                <!--<li class="past"><a href="#">8</a></li>
								<li><a href="#">9</a></li>-->
								<li class="next"><a href="<?php echo site_url(); ?>/serp/?search=<?php echo $url_term; ?>&searchpage=<?php echo $next_page; ?>">NEXT</a></li>
							</ul>
						</nav>
						
						<div>
						<div class="ddc-caption">Ads</div>
						<?php if (count($ads) > 5): ?>
						<?php for ($i = 5; $i < min(10, count($ads)); $i++): ?>
							<?php $ad = $ads[$i]; ?>
							<div class="ddc-ad">
								<div class="title"><a href="<?php echo $ad->url; ?>"><?php echo $ad->title; ?></a></div>
								<div class="description"><a href="<?php echo $ad->url; ?>"><?php echo $ad->description; ?></a></div>
								<div class="display-url"><a href="<?php echo $ad->url; ?>"><?php echo $ad->url['visibleurl']; ?></a></div>
							</div>
						<?php endfor; ?>
						<?php endif; ?>
						</div>
					</div>
				</div>
				<aside id="sidebar">
					<div class="block">
						<!-- BEGIN ExoClick.com Ad Code -->
            <script type="text/javascript" src="http://ap.lijit.com/www/delivery/fpi.js?z=210582&u=YellowGarage&width=300&height=250"></script>
            <noscript>Your browser does not support JavaScript. Update it for a better user experience.</noscript>
            <!-- END ExoClick.com Ad Code -->
						<a href="#" class="advertise-link">ADVERTISE HERE</a>
					</div>
					<div class="block">
						<h3>Top Searches</h3>
						<ul class="tagcloud">
							<li class="vv-popular"><a href="<?php echo site_url(); ?>/serp/?search=Dentists">Dentists</a></li>
							<li class="popular"><a href="<?php echo site_url(); ?>/serp/?search=Cosmetic+Dentists">Cosmetic Dentists</a></li>
							<li class="vvvvv-popular"><a href="<?php echo site_url(); ?>/serp/?search=Attorneys">Attorneys</a></li>
							<li class="popular"><a href="<?php echo site_url(); ?>/serp/?search=Personal+Injury+Attorneys">Personal Injury Attorneys</a></li>
							<li class="vvv-popular"><a href="<?php echo site_url(); ?>/serp/?search=Plumbing+Contractors">Plumbing Contractors</a></li>
							<li class="popular"><a href="<?php echo site_url(); ?>/serp/?search=Criminal+Law+Attorneys">Criminal Law Attorneys</a></li>
							<li class="vv-popular"><a href="<?php echo site_url(); ?>/serp/?search=Air+Conditioning+Contractors">Air Conditioning Contractors</a></li>
							<li class="popular"><a href="<?php echo site_url(); ?>/serp/?search=Dental+Implant+Dentists">Dental Implant Dentists</a></li>
							<li class="vvvv-popular"><a href="<?php echo site_url(); ?>/serp/?search=Auto+Service+and+Repair">Auto Service & Repair</a></li>
							<li class="popular"><a href="<?php echo site_url(); ?>/serp/?search=Heating+and+Air+Conditioning+Contractors">Heating & Air Conditioning Contractors</a></li>
							<li><a href="<?php echo site_url(); ?>/serp/?search=Veterinarians">Veterinarians</a></li>
							<li class="popular"><a href="<?php echo site_url(); ?>/serp/?search=Physicians+and+Surgeons">Physicians & Surgeons</a></li>
							<li class="vvvv-popular"><a href="<?php echo site_url(); ?>/serp/?search=Divorce+Attorneys">Divorce Attorneys</a></li>
							<li class="popular"><a href="<?php echo site_url(); ?>/serp/?search=Animal+Hospitals">Animal Hospitals</a></li>
							<li class="v-popular"><a href="<?php echo site_url(); ?>/serp/?search=Roofing+Contractors">Roofing Contractors</a></li>
							<li class="popular"><a href="<?php echo site_url(); ?>/serp/?search=DUI+Attorneys">DUI/DWI Attorneys</a></li>
							<li class="vv-popular"><a href="<?php echo site_url(); ?>/serp/?search=Accident+Attorneys">Accident Attorneys</a></li>
							<li class="popular"><a href="<?php echo site_url(); ?>/serp/?search=Emergency+Services+Dentists">Emergency Services Dentists</a></li>
							<li class="vvvv-popular"><a href="<?php echo site_url(); ?>/serp/?search=Pediatrics+Dentists">Pediatrics Dentists</a></li>
							<li class="popular"><a href="<?php echo site_url(); ?>/serp/?search=Family+Law+Attorneys">Family Law Attorneys</a></li>
							<li class="vvv-popular"><a href="<?php echo site_url(); ?>/serp/?search=Dental+Clinics">Dental Clinics</a></li>
							<li class="popular"><a href="<?php echo site_url(); ?>/serp/?search=Mini+and+Self+Storage">Mini & Self Storage</a></li>
							<li class="vv-popular"><a href="<?php echo site_url(); ?>/serp/?search=Moving+and+Storage">Moving & Storage</a></li>
							<li class="popular"><a href="<?php echo site_url(); ?>/serp/?search=Orthodontics+Dentists">Orthodontics Dentists</a></li>
							<li class="vvvv-popular"><a href="<?php echo site_url(); ?>/serp/?search=Plumbing+Service+and+Repair">Plumbing Service & Repair</a></li>
							<li class="popular"><a href="<?php echo site_url(); ?>/serp/?search=Heating+and+Air+Conditioning+Service+and+Repair">Heating & Air Conditioning Service & Repair</a></li>
							<li><a href="<?php echo site_url(); ?>/serp/?search=Pest+Control+Services">Pest Control Services</a></li>
							<li class="popular"><a href="<?php echo site_url(); ?>/serp/?search=Landscape+Contractors">Landscape Contractors</a></li>
							<li class="vvvvv-popular"><a href="<?php echo site_url(); ?>/serp/?search=Roofing">Roofing</a></li>
							<li class="popular"><a href="<?php echo site_url(); ?>/serp/?search=Bankruptcy+Attorneys">Bankruptcy Attorneys</a></li>
							<li class="v-popular"><a href="<?php echo site_url(); ?>/serp/?search=Air+Conditioning+Service+and+Repair">Air Conditioning Service & Repair</a></li>
							<li class="popular"><a href="<?php echo site_url(); ?>/serp/?search=Dental+Hygienists">Dental Hygienists</a></li>
							<li class="vv-popular"><a href="<?php echo site_url(); ?>/serp/?search=Siding+Contractors">Siding Contractors</a></li>
												</ul>
					</div>
          <span id="recommended_check" data-reccheck="<?php echo $recommended; ?>"></span>
					<div class="block places-box">
						<h3>PLACES YOU MAY LIKE</h3>
						<ul class="places-item">
							<script id="recommended_template" type="text/x-jsrender">
							<li>
                {{if image}}
                <a href="<?php echo site_url(); ?>/profile/?biz={{>public_id}}&phone={{>phone_number}}"><img src="{{>image}}" width="64" height="64" alt="no image"></a>
                {{else}}
                <a href="<?php echo site_url(); ?>/profile/?biz={{>public_id}}&phone={{>phone_number}}"><img src="<?php echo bloginfo('stylesheet_directory'); ?>/images/yellowease-default.png" width="64" height="64" alt="image description"></a>
                {{/if}}
								<div class="text-box">
                  <h4><a href="<?php echo site_url(); ?>/profile/?biz={{>public_id}}&phone={{>phone_number}}">{{>name}}</a></h4>
									<p>{{>sample_categories}}</p>
                  <address>{{>address.street}}, {{>address.city}}, {{>address.state}} {{>address.postal_code}}</address>
								</div>
							</li>
              </script>
						</ul>
					</div>
					<div class="block">
						<!-- BEGIN ExoClick.com Ad Code -->
            <script type="text/javascript" src="http://ap.lijit.com/www/delivery/fpi.js?z=210582&u=YellowGarage&width=300&height=250"></script>
            <noscript>Your browser does not support JavaScript. Update it for a better user experience.</noscript>
            <!-- END ExoClick.com Ad Code -->
            <a href="#" class="advertise-link">ADVERTISE HERE</a>
					</div>
				</aside>
			</div>
			<div class="promo-box bottom-box">
        <!-- BEGIN ExoClick.com Ad Code -->
        <script type="text/javascript" src="http://ap.lijit.com/www/delivery/fpi.js?z=210581&u=YellowGarage&width=728&height=90"></script>
        <noscript>Your browser does not support JavaScript. Update it for a better user experience.</noscript>
        <!-- END ExoClick.com Ad Code -->
			</div>
		</div>
	</div>
</div>

<?php get_footer(); ?>

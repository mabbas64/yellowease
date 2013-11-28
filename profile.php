<?php 
//
// Template Name: Profile
//

get_header(); 
if( isset( $_GET['biz'] ) ){ 
  $biz = $_GET['biz'];
}
if( isset( $_GET['has_video'] ) ){ 
  $video = $_GET['has_video'];
}
if( isset( $_GET['linktype'] ) ){ 
  $linktype = $_GET['linktype'];
}
if( isset( $_GET['phone'] ) ){ 
  $phone = $_GET['phone'];
}
$recommended = true;
?>
			<div class="container">
				<div id="content">
					<div class="holder" id="item_wrapper">
            <span id="bizid" style="display: none;" data-biz="<?php echo $biz; ?>"></span>
            <span id="linktype" style="display: none;" data-linktype="<?php echo $linktype; ?>"></span>
            <div id="info_modal_wrap" style="display: none;">
              <div id="info_modal">
                <a href="#" id="close_modal"></a>
              </div>
            </div>
            <script id="details_template" type="text/x-jsrender">
            <span id="latitude" style="display: none;" data-lat="{{>address.latitude}}"></span>
            <span id="longitude" style="display: none;" data-lng="{{>address.longitude}}"></span>
						<div class="restaurant-box">
							<div class="image-box">
                {{if images.length > 0}}
								<img src="{{>images[0].image_url}}" width="140" height="140" alt="image description">
                <a class="view-more-images" href="#more_images_box">View More Photos »</a>
								{{else}}
                <img src="<?php echo bloginfo('stylesheet_directory'); ?>/images/yellowease-default.png" width="140" height="140" alt="image description">
								{{/if}}
							</div>
							<div class="text-box">
								<h1>{{>name}}</h1>
								<span class="info-text">{{if categories.length > 0}}{{for categories}}{{>name}}, {{/for}}{{/if}}</span>
								<strong class="phone"><?php echo $phone; ?></strong>
								<address>{{>address.street}}, {{>address.city}}, {{>address.state}} {{>address.postal_code}}</address>
							</div>
						</div>
						<div class="reviews-box">
							<div class="reviews">
                <span>{{>review_info.total_user_reviews}} Reviews</span> 
                {{if review_info.reviews.length > 0}}
                <a id="goto_reviews" href="#reviews_link">Read More »</a>
                {{/if}}
              </div>
						</div>
            <span id="send_to_url" data-sendurl="{{>urls.send_to_friend_url}}" style="display: none;"></span>
            <ul class="links-item">
							<li><a href="#" data-mtype="email" class="email-link open-modal">Email It</a></li>
							<!--<li><a href="#" class="text-link open-modal" data-mtype="text">Text It</a></li>-->
							<li><a href="{{>urls.website_url}}" class="website-link open-modal modal-frame">Website</a></li>
              {{if urls.menu_url}}<li><a href="{{>urls.menu_url}}" class="menus-link open-modal modal-frame" data-mtype="menus">Menus</a></li>{{/if}}
              {{if urls.reservation_url}}<li class='reservation-li'><a href="{{>urls.reservation_url}}" class="reservations-link open-modal modal-frame" data-mtype="reservations">reservations</a></li>{{/if}}
							<?php if($video){ ?><li><a href="{{>urls.profile_url}}" class="videos-link open-modal modal-frame" data-mtype="videos">Videos</a></li><?php }; ?>
						</ul>
						
						<nav class="content-nav">
							<ul>
								<li class="active"><a href="#more_info_box" id="more_link" class="more-link dom-tab">MORE INFO</a></li>
								<li><a href="#reviews_box" id="reviews_link" class="reviews-link dom-tab">REVIEWS</a></li>
								<li><a href="#map_box" id="map_link" class="map-link dom-tab">MAPS &amp; DIRECTIONS</a></li>
								<li><a href="#offers_box" id="offers_link" class="offers-link dom-tab">OFFERS</a></li>
								<li><a href="#images_box" id="images_link" class="images-link dom-tab">IMAGES</a></li>
							</ul>
						</nav>
            <div id="more_info_box" class="tab-content">
              <div class="text-block">
                <h2>{{if teaser !== null}}{{>teaser}}{{/if}}</h2>
                {{if business_hours !== ""}}
                <h4>Hours of operation:</h4>
                <p>{{>business_hours}}</p>
                {{/if}}
              </div>
            </div>
            <div id="reviews_box" class="tab-content" style="display: none;">
              {{if review_info.reviews.length > 0}}
              <div class="text-block">
                {{for review_info.reviews}}
                  <h3>{{>review_author}} wrote:</h3>
                  <p>{{>review_text}}</p>
                {{/for}}
              </div>
              {{else}}
              <div class="text-block">
                <h3>Sorry, {{>name}} doesn't seem to have any reviews.</h3>
              </div>
              {{/if}}
              {{if tips.length > 0}}
              <div class="green-box">
                <h3>Extra Tips</h3>
                {{for tips}}
                <h4>{{>tip_name}}</h4>
                <p>{{>tip_text}}</p>
                {{/for}}
              </div>
              {{/if}}
            </div>
            <div id="map_box" class="tab-content" style="display: none;">
              <div class="text-block">
                <div id="map_canvas"></div>
                <a class="get-directions open-modal modal-frame" href="https://maps.google.com/maps?saddr=current+location&daddr={{>address.street}}, {{>address.city}}, {{>address.state}} {{>address.postal_code}}">Get Directions</a>
              </div>
            </div>
            <div id="offers_box" class="tab-content" style="display: none;">
              <div class="text-block">
                {{if offers.length > 0}}
                  {{for offers}}
                    <h3>{{>offer_text}}:</h3>
                    <p>{{>offer_description}}</p>
                  {{/for}}
                {{else}}
                  <h3>There aren't any offers currently available for {{>name}}</h3>
                {{/if}}
              </div>
            </div>
            <div id="images_box" class="tab-content" style="display: none;">
              <div class="text-block" id="more_images_box">
                {{if images.length > 0}}
                {{for images}}
                <a class="item-image" href="{{>image_url}}">
                  <img src="{{>image_url}}">
                </a>
                {{/for}}
                {{else}}
                <h3>There don't seem to be any images available.</h3>
                {{/if}}
              </div>
            </div>
						<div class="tags-box">
							<h3>Tags</h3>
							<ul>
              {{for categories}}
								<li><a href="<?php site_url(); ?>/yellowease/serp/?search={{>name}}" class="pizza-link">{{>name}}</a></li>
							{{/for}}
              </ul>
						</div>
            </script>
					</div>
				</div>
				<aside id="sidebar">
					<div class="map-box">
						<a href="#" id="sb_map"></a>
					</div>
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
								<img src="{{>image}}" width="64" height="64" alt="image description">
								<div class="text-box">
                  <h4><a href="<?php echo site_url(); ?>/profile/?biz={{>public_id}}">{{>name}}</a></h4>
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

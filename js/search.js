//This is the search handler javascript file for Yellowease
;var yellowease = {};
  
yellowease.search = function ($) {
  var searchterm = $('#url_sterm').data('sterm'),
      searchpage = $('#page_num').data('pagenum'),
      $location = $('#city_state'),
      $searched_loc = $('#searched_city'),
      $homepage_slider = $('#homepage_slider').data('slider'),
      $homepage_slide_num = $('.pagination').find('a'),
      $specified_loc = $('#location_set').data('curloc'),
      urlloc = $('#url_loc_set').data('urlloc'),
      page = 1,
      $results_list = $('#results_list'),
      $results_template = $('#results_template'),
      $item_wrapper = $('#item_wrapper'),
      $biz_id = $('#bizid').data('biz'),
      $biz_phone,
      sortby = 'dist',
      sorted = false,
      baseurl = $('#url_base').data('bassurl'),
      $modal = $('#info_modal_wrap'),
      $linktype = $('#linktype').data('linktype'),
      sb_map = false,
      slider_pos_num = 1,
      search_count = 10,
      user_location,
      $current_lat,
      $current_long,
      $dest_lat,
      $dest_long,
      stop = false,
      info;

  window.setInterval(moveSlider, 3000);

  function registerEvents () {
    // Try HTML5 geolocation
    if( !$specified_loc ){
      /*if(navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(position) {
          getLocation( position.coords.latitude, position.coords.longitude );
        });
      } else {
        alert('Browser doesn\'t support Geolocation. Please choose a location from the menu in the header.');
      }*/
      var data = { get_location : true };
      $.ajax({
        type: "POST",
        url: baseurl + "/api/maxmind_city.php",
        dataType: "JSON",
        data: data,
        success: function(data){
          if( data.latitude && data.longitude ){
            $current_lat = data.latitude;
            $current_long = data.longitude;
            getLocation( data.latitude, data.longitude);
          } else {
            alert('We can\'t find where you\'re located. Please choose a location using the selection tool.');
          }
        }
      });
    } else {
      userLocation();
    }
   
    //show popular locations above header
    $('#header').on('click', 'a#change_location', function(e){
      e.preventDefault();
      $('#locations_header').slideToggle('fast');
    });
    
    //Choose new location
    $('#locations_header').on('click', 'li a', function(e){
      e.preventDefault();
      var condensed_loc = $(this).data('loc'),
          readable_loc = $(this).val();
    
      setNewLocation( condensed_loc, readable_loc );
    });
   
    //home slider next
    $('#main').on('click', '.btn-next', function(e){
      e.preventDefault();
      stop = true;
      sliderNext( $(this) );
    });
    
    //home slider previous
    $('#main').on('click', '.btn-prev', function(e){
      e.preventDefault();
      var dot = $('.pagination').find('a.active').parent().prev().find('a');
      $homepage_slide_num.removeClass('active');
      if(dot.length == 0){
        $('.pagination').find('li:last-child a').addClass('active');
      } else {
        dot.addClass('active');
      }
      stop = true;
      homeSlider( $(this).attr('class') );
    });
    
    //home slider selected number
    $('.pagination').on('click', 'a', function(e){
      e.preventDefault();
      $homepage_slide_num.removeClass('active');
      $(this).addClass('active');
      stop = true;
      homeSlider( $(this).data('toslide') );
    });
    
    //for homepage slider
    if( $homepage_slider == true ){
      searchResults( 'entertainment', baseurl, page, sortby, 5 );
    }
    
    //for sidebar places you may like
    if( $('#recommended_check').data('reccheck') == true ){
      if(searchterm !== null && searchterm !== undefined){
        searchSidebarResults( searchterm, baseurl, page, 'highestrated', 3 );
      } else {
        searchSidebarResults( 'entertainment', baseurl, page, 'highestrated', 3 );
      }
    }
    
    //for searched term
    if( searchterm !== null && searchterm !== undefined && searchpage !== null && searchpage !== undefined ){
      searchResults( searchterm, baseurl, searchpage, sortby, search_count );
      page++;
    }
    
    //for detailed info on item
    if( $biz_id !== null && $biz_id !== undefined ){
      detailResults( $biz_id, baseurl );
    }

    //show more results for search term
    $('.filter-nav').on( 'click', '#load_more', function(e){
      e.preventDefault();
      if( searchterm !== null && searchterm !== undefined ){
        $(this).hide();
        $(this).next().show();
        searchResults( searchterm, baseurl, page, sortby, search_count );
        page++;
      }
    });

    //load more search results when load more element has come into view
    //$(window).scroll(function(e) {
     // var visible = isScrolledIntoView($('#load_more'));
      //if( visible == true ){
       // searchResults( searchterm, baseurl, page, sortby, search_count );
       // page++;
      //}
    //});
    
    //open modal
    $('#item_wrapper').on('click', '.open-modal', function(e){
      e.preventDefault();
      var type = $(this).data('mtype');
      $modal.fadeIn('fast');
      if( $(this).hasClass('modal-frame') ){
        iframeModal( $(this).attr('href') );
      } else {
        queryInfo( type );
      }
    });
    
    //close modal
    $('#item_wrapper').on('click', '#close_modal', function(e){
      e.preventDefault();
      $(this).nextAll().remove();
      $modal.fadeOut('fast');
    });

    //show reviews
    $('#item_wrapper').on('click', 'a#goto_reviews', function(e){
      changeTabs( $('#reviews_link') );
    });

    //show reviews
    $('#item_wrapper').on('click', 'a.view-more-images', function(e){
      e.preventDefault();
      $('.images-link').trigger('click');
      $('html, body').animate({
        scrollTop: $(".content-nav").offset().top
      }, 800);
    });
    
    //dom tabs
    $item_wrapper.on('click', 'a.dom-tab', function(e){
      e.preventDefault();
      changeTabs( $(this) );
    });

    //filter results
    $('select#filter').change(function(){
      searchterm = $(this).val();
      page = 1;
      sorted = true;
      searchResults( searchterm, baseurl, searchpage, sortby, search_count );
      page++;
    });
    
    //sort results
    $('select#sort').change(function(){
      var sort = $(this).val();
      switch( sort ){
        case 'BEST MATCH':
          sortby = 'topmatches';
          break;

        case 'HIGHEST RATED':
          sortby = 'highestrated';
          break;

        case 'DISTANCE':
          sortby = 'dist';
          break;

        case 'A-Z':
          sortby = 'alpha';
          break;
      }
      page = 1;
      sorted = true;
      searchResults( searchterm, baseurl, searchpage, sortby, search_count );
      page++;
    });
  }
 
  function moveSlider () {
    if( stop == true ){
      return;
    } else {
      sliderNext($('#main a.btn-next'));
    }
  }

  function sliderNext( el ) {
      var dot = $('.pagination').find('a.active').parent().next().find('a');
      $homepage_slide_num.removeClass('active');
      if(dot.length == 0){
        $('.pagination').find('li:first-child a').addClass('active');
      } else {
        dot.addClass('active');
      }
      homeSlider( el.attr('class') );
  }

  //Send query to Search API handler
  function searchResults ( term, baseurl, searchpage, sort, search_count ) {
    var new_loc = $specified_loc.split(', ').join(',');
    var data = { what : term, where : new_loc, page_num : searchpage, sortby : sort, count : search_count };
    $.ajax({
      type: "POST",
      url: baseurl + "/api/search.php",
      dataType: "JSON",
      data: data,
      success: function(data){
        if( data.success.results.locations.length > 0 ){
          if(!$.isEmptyObject(data.success.results.locations)){ 
            renderResults(data.success.results.locations);
          }
        } else {
          if(page > 1){
            $('#results_list').append('<p>Sorry, no more results were found matching your criteria.</p>');
          } else {
            $('#results_list').append('<p>Sorry, no results were found matching your criteria.</p>');
          }
          $('#load_more').hide();
        }
      }
    });
  }
  
  //Send query to Search API handler for sidebar results
  function searchSidebarResults ( term, baseurl, page, sort, search_count ) {
    var new_loc = $specified_loc.split(', ').join(',');
    var data = { what : term, where : new_loc, page_num : page, sortby : sort, count : search_count };
    $.ajax({
      type: "POST",
      url: baseurl + "/api/search.php",
      dataType: "JSON",
      data: data,
      success: function(data){
        if( data.success.results.locations.length > 0 ){
          if(!$.isEmptyObject(data.success.results.locations)){ 
            renderSidebarResults(data.success.results.locations); 
          }
        }
      }
    });
  }

  //Home Slider Functionality
  function homeSlider ( action ) {
    var slide_wrapper = $('.slideset'),
        current_position = slide_wrapper.css('left');
    
    switch( action ){
      case 'btn-prev':
        if( slider_pos_num == 1 ){
          slide_wrapper.animate({
            left: '-=2404'
          }, 400, function(){
            slider_pos_num = 5;

          });
        } else {
          slide_wrapper.animate({
            left: '+=601'
          }, 400, function(){
            slider_pos_num--;
          });
        }
        break;

      case 'btn-next':
        if( slider_pos_num == 5 ){
          slide_wrapper.animate({
            left: '+=2404'
          }, 400, function(){
            slider_pos_num = 1;
          });
        } else {
          slide_wrapper.animate({
            left: '-=601'
          }, 400, function(){
            slider_pos_num++;
          });
        }
        break;

      case 'slide1':
        slide_wrapper.animate({
          left: '0'
        }, 400, function(){
          slider_pos_num = 1;
        });
        break;

      case 'slide2':
        slide_wrapper.animate({
          left: '-601px'
        }, 400, function(){
          slider_pos_num = 2;
        });
        break;

      case 'slide3':
        slide_wrapper.animate({
          left: '-1202px'
        }, 400, function(){
          slider_pos_num = 3;
        });
        break;

      case 'slide4':
        slide_wrapper.animate({
          left: '-1803px'
        }, 400, function(){
          slider_pos_num = 4;
        });
        break;

      case 'slide5':
        slide_wrapper.animate({
          left: '-2404px'
        }, 400, function(){
          slider_pos_num = 5;
        });
        break;
    }
  }

  function isScrolledIntoView ( el ) {
    var docViewTop = $(window).scrollTop();
    var docViewBottom = docViewTop + $(window).height();

    var elemTop = el.offset().top;
    var elemBottom = elemTop + el.height();

    return ((elemBottom <= docViewBottom) && (elemTop >= docViewTop));
  }

  //Aggregate results onto page
  function renderResults ( list ) {
    if( $homepage_slider !== null && $homepage_slider !== undefined ){
      $('.slideset').append(
        $('#slides_template').render( list )
      );
    } else {
      var listcount = list.length,
          ofnum = ( listcount === 10 ) ? searchpage + '0': listcount;
      
      if( searchpage === 1 ){
        $('.results-text').append('Displaying results ' + searchpage + ' &nbsp;-&nbsp; ' + ofnum);
      } else {
        $('.results-text').append('Displaying results ' + (searchpage - 1) + '1 &nbsp;-&nbsp; ' + ofnum);
      }
      if( sorted == false ){
        $results_list.append(
          $results_template.render( list )
        );
        $('#load_more').show().next().hide();
      } else {
        $results_list.empty().append(
          $results_template.render( list )
        );
        $('#load_more').show().next().hide();
        sorted = false;
      }
    }
  }
  
  //Aggregate results onto page
  function renderSidebarResults ( list ) {
    $('.places-item').append(
      $('#recommended_template').render( list )
    );
  }
  
  //Send query to API handler
  function detailResults ( biz_id, baseurl ) {
    var data = { biz_id: biz_id };
    $.ajax({
      type: "POST",
      url: baseurl + "/api/single.php",
      dataType: "JSON",
      data: data,
      success: function(data){
        if( data.success.locations.length > 0 ){
          if(!$.isEmptyObject(data.success.locations)){ 
            info = data.success.locations;
            renderDetails(); 
            sb_map = true;
            $dest_lat = info[0].address.latitude;
            $dest_long = info[0].address.longitude;
            renderSidebarMap();
            //if user used secondary link for search item
            if( $linktype !== null && $linktype !== undefined ){
              changeFocus( $linktype );
            }
          }
        }
      }
    });
  }
  
  //Aggregate details onto page
  function renderDetails () {
    $('#item_wrapper').append(
      $('#details_template').render( info )
    );
  }

  //render google map for item's location under map tab
  function renderTabMap () {
    var phone_num = info[0].contact_info.display_phone.substring(0,0) + '(' + info[0].contact_info.display_phone.substring(0,3) + ') ' + info[0].contact_info.display_phone.substring(3,6) + '-' + info[0].contact_info.display_phone.substring(6,10);
    var data = {
      lat : info[0].address.latitude,
      lng: info[0].address.longitude,
      text: '<h3>' + $location.text() + '</h3><h3>' + phone_num + '</h3><p>' + info[0].address.street + '</br>' + info[0].address.city + ', ' + info[0].address.state + ' ' + info[0].address.postal_code + '</p>'
    };
    
    var myLatlng  = new google.maps.LatLng(data.lat, data.lng),
        mapOptions = {
          center: myLatlng,
          zoom: 10,
          mapTypeId: google.maps.MapTypeId.ROADMAP
        };

    var map = new google.maps.Map(document.getElementById('map_canvas'), mapOptions);
    
    // Info window element 
    infowindow = new google.maps.InfoWindow();
    
    // Set pin 
    setPin(data, map);
  }

  // Show position 
  function setPin(data, map) { 
    var pinLatLng = new google.maps.LatLng(data.lat, data.lng); 
    var pinMarker = new google.maps.Marker({ 
      position: pinLatLng, 
      map: map, 
      data: data 
    }); 
    
    // Listen for click event  
    google.maps.event.addListener(pinMarker, 'click', function() { 
      map.setCenter(new google.maps.LatLng(pinMarker.position.lat(), pinMarker.position.lng())); 
      map.setZoom(18); 
      onItemClick(event, pinMarker, map); 
    }); 
  } 
  
  // Info window trigger function 
  function onItemClick(event, pin, map) { 
    // Create content  
    var contentString = pin.data.text; 

    // Replace our Info Window's content and position 
    infowindow.setContent(contentString); 
    infowindow.setPosition(pin.position); 
    infowindow.open(map) 
  } 
  
  //render google map for item's location in sidebar
  function renderSidebarMap () {
    var map,
        myLatlng  = new google.maps.LatLng(info[0].address.latitude, info[0].address.longitude),
        mapOptions = {
          center: myLatlng,
          zoom: 10,
          mapTypeId: google.maps.MapTypeId.ROADMAP
        };

    map = new google.maps.Map(document.getElementById('sb_map'), mapOptions);
    var marker = new google.maps.Marker({
        position: myLatlng,
        map: map,
        title: 'Item Location'
    });
  }

  //Focus on part of the page user linked to
  function changeFocus ( focus ) {
    switch( focus ){
      case 'map':
        $('#map_link').trigger('click');
        $('html, body').animate({
          scrollTop: $(".content-nav").offset().top
        }, 800);
        getDirections();
        break;

      case 'website':
        $('.website-link').trigger('click');
        break;

      case 'email':
        $('.email-link').trigger('click');
        break;

      case 'textit':
        $('.text-link').trigger('click');
        break;

      case 'menu':
        $('.menus-link').trigger('click');
        break;

      case 'video':
        $('.videos-link').trigger('click');
        break;

      case 'reviews':
        $('#reviews_link').trigger('click');
        $('html, body').animate({
          scrollTop: $(".content-nav").offset().top
        }, 800);
        break;

      case 'offers':
        $('#offers_link').trigger('click');
        $('html, body').animate({
          scrollTop: $(".content-nav").offset().top
        }, 800);
        break;
    }
  }

  //Get Directions From Google Maps API
  function getDirections () { 
    data = {  };
  }

  //Modal Iframes
  function iframeModal ( href ) {
    $modal.find('#info_modal h2').remove();
    $modal.find('#info_modal form').remove();
    $modal.find('#modal_iframe').remove();
    
    if( href.indexOf("http://www.citysearch.com/profile/") == 0 ){
      var new_vid_url = href.split("http://www.citysearch.com/profile/"),
          href = "http://www.citysearch.com/profile/video/" + new_vid_url[1];
    }

    var iframe = '<iframe src="' + href + '" id="modal_iframe" scrolling="yes"></iframe>';
    $modal.find('#info_modal').append(iframe);
  }

  //Show Modal Info
  function queryInfo ( type ) {
    var city = $location.text().replace(/\s/g, ''),
        n = city.indexOf(','),
        city = city.substring(0, n != -1 ? n : city.length).toLowerCase(),
        old_url = $('#send_to_url').data('sendurl'),
        cut_url = old_url.substring(10),
        final_url = 'http://' + city + cut_url,
        content_phone = [
          '<h2>Send this to a mobile device:</h2>',
          '<form id="sendToMobile" ><input type="hidden" name="toPhone" value="true">',
            '<input type="hidden" name="texturl" value="' + baseurl + '/?biz=' + $biz_id + '">',
            '<span class="input-holder">',
              '<label for="phone" id="phoneLabel">Phone</label>',
              '<input id="phone" name="phone" type="text" value="" maxlength="16">',
            '</span>',
            '<label for="agreementCheckbox" class="inline" id="agreementAction">',
            '<input name="agreementCheckbox" id="agreementCheckbox" type="checkbox" class="checkbox">I agree to the <span>Terms and Conditions</span>.</label>',
            '<input type="submit" class="button submit" value="Send">',
            '<h4>Terms and Conditions</h4>',
            '<p><strong>By entering your mobile number, you are requesting to receive a one time message from Yellowease. Citysearch does not charge for this service, however standard or other charges may apply from your mobile provider.</strong></p>',
          '</form>'
        ],
        content_email = [
          '<h2>Send this to your own or your friend\'s email:</h2>',
          '<form id="sendToEmail" action="' + final_url + '" method="post">',
            '<input type="hidden" name="toFriend" value="true">',
            '<span class="input-holder">',
              '<label for="toEmail" id="toEmailLabel">Friend’s Email</label>',
              '<input id="toEmail" name="toEmail" type="text" value="">',
            '</span>',
            '<p>(separate multiple addresses with a comma)</p>',
            '<span class="input-holder">',
              '<label for="name">Your Name (optional)</label>',
              '<input id="name" name="name" type="text" value="" maxlength="40">',
            '</span>',
            '<span class="input-holder">',
              '<label for="fromEmail">Your Email</label>',
              '<input id="fromEmail" name="fromEmail" type="text" value="" maxlength="60">',
            '</span>',
            '<label class="inline" for="selfSend1">',
              '<input id="selfSend1" name="selfSend" class="checkbox" type="checkbox" value="true">',
              '<input type="hidden" name="_selfSend" value="on">',
              'Send a copy to yourself',
            '</label>',
            '<button type="submit" class="button submit clearfix" name="send_listing_form.email.1.submit">Send</button>',
          '</form>'
        ];
    
    switch(type){
      case 'email':
        content_email = content_email.join('');
        $modal.find('#info_modal h2').remove();
        $modal.find('#info_modal form').remove();
        $modal.find('#info_modal').append(content_email);
        break;
      
      case 'text':
        content_phone = content_phone.join('');
        $modal.find('#info_modal h2').remove();
        $modal.find('#info_modal form').remove();
        $modal.find('#info_modal').append(content_phone);
        handleTextit( $modal );
        break;
    }
  }

  function handleTextit( modal ) {
    $modal.on('submit', '#sendToMobile', function(e){
      e.preventDefault();
      $.ajax({
        type: "POST",
        url: baseurl + "/api/clickatell.php",
        dataType: "JSON",
        data: $(this).serialize(),
        success: function(data){
          if( data.success ){
            $modal.find('#info_modal h2').empty().text('Message Sent!');
            $modal.find('#info_modal form').remove();
          }
        }
      });
    });
  }

  //handle dom tabs
  function changeTabs ( tab ) {
    var id = tab.attr('id');
    
    $item_wrapper.find('.tab-content').hide();
    $item_wrapper.find('.content-nav ul li').removeClass('active');
    tab.parent('li').addClass('active');

    switch( id ){
      case 'more_link':
        $('#more_info_box').fadeIn('fast');
        break;
      case 'reviews_link':
        $('#reviews_box').fadeIn('fast');
        break;
      case 'map_link':
        $('#map_box').fadeIn('fast', renderTabMap);
        break;
      case 'offers_link':
        $('#offers_box').fadeIn('fast');
        break;
      case 'images_link':
        $('#images_box').fadeIn('fast');
        break;
    }
  }
  
  //get geolocation of user
  function getLocation ( latitude, longitude ) {
    var data = { lat : latitude, lng : longitude };
    
    $.ajax({
      type: "POST",
      url: baseurl + "/api/location.php",
      dataType: "JSON",
      data: data,
      success: function(data){
        if(data.success.results.length > 3){
          var city = data.success.results[0].address_components[3].long_name;
          var state = data.success.results[0].address_components[5].short_name;
          userLocation( city, state );
        }
      }
    });
  }

  //set initial user location
  function userLocation ( city, state ) {
    //set users location to be used in other functions
    if( !$specified_loc ){
      user_location = city.toLowerCase() + ',' + state;
      var str = city + ', ' + state;
      $('#location_set').data('curloc', user_location);
      $location.html(str);
      $specified_loc = user_location;
      if( $homepage_slider == true ){
        searchResults( 'entertainment', baseurl, page, sortby, 5 );
      }
    } else {
      var el = $('#locations_header').find('a[data-loc="' + $specified_loc + '"]').text();
      if(el){
        $location.html(el);
        if( $searched_loc ){
          $searched_loc.html(el);
        }
      } else {
        var loc_name = toTitleCase($specified_loc);
        $location.html(loc_name);
        if( $searched_loc ){
          $searched_loc.html(loc_name);
        }
      }
    }
  }
  
  //set new user location
  function setNewLocation ( loc_compressed, loc_name ) {
    var new_url = updateQueryStringParameter( window.location.href, 'location', loc_compressed );
    window.location.href = new_url;
  }

  function updateQueryStringParameter(uri, key, value) {
    var re = new RegExp("([?|&])" + key + "=.*?(&|$)", "i");
    separator = uri.indexOf('?') !== -1 ? "&" : "?";
    if (uri.match(re)) {
      return uri.replace(re, '$1' + key + "=" + value + '$2');
    } else {
      return uri + separator + key + "=" + value;
    }
  }

  function toTitleCase(str){
    return str.replace(/\w\S*/g, function(txt){return txt.charAt(0).toUpperCase() + txt.substr(1);});
  }

  (function init () {
    registerEvents();
  }());

  return {};
}

jQuery(document).ready( function($){
  var view = {
    search : yellowease.search($),
  };
	
  initSameHeight();
	$('input, textarea').placeholder();
  
  // align blocks height
  function initSameHeight() {
    $('.columns-item').sameHeight({
      elements: '.column',
      multiLine: true
    });
  }


});

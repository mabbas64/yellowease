//This is the detailed search item javascript file for Yellowease
;var yellowease = {};
  
yellowease.searchDetail = function ($) {
  var item_id = $('#item_id').data('itemID'),
      basurl = $('#url_base').data('bassurl');

  function registerEvents () {
    if( item_id !== null && item_id !== undefined ){
      detailResults( item_id, baseurl );
    }
  }
  
  //Send query to API handler
  function detailResults ( item_id, baseurl ) {
    var data = { id : item_id };
    
    $.ajax({
      type: "POST",
      url: baseurl + "/api/single.php",
      dataType: "JSON",
      data: data,
      success: function(data){
        if( data.success.results.locations.length > 0 ){
          if(!$.isEmptyObject(data.success.results) && page < 2){ 
            renderSearchInfo(data.success.results); 
          }
          if(!$.isEmptyObject(data.success.results.locations)){ 
            renderResults(data.success.results.locations); 
          }
        } else {
        }
      }
    });
  }

  //Show initial search info
  function renderSearchInfo ( info ) {
  }

  //Aggregate results onto page
  function renderResults ( list ) {
    $results_list.append(
      $results_template.render( list )
    );
  }

  (function init () {
    registerEvents();
  }());

  return {};
}

jQuery(document).ready( function($){
  var view = {
    search : yellowease.searchDetail($),
  };
});


//This is the main javascript file for Yellowease
;var yellowease = {};

yellowease.main = function ($) {
  
  function registerEvents () {
  }

  (function init () {
    registerEvents();
  }());

  return {};
}

var view = {
  main : yellowease.main($),
};
// remove the second instance of our child-theme's style.css which is added auotmatically by the parent theme
//   need this removed for the ThemeOptions style-sheet selector to have an effect.
jQuery(document).ready( function($){
	$('#twentytwelve-style-css').remove();
});

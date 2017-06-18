jQuery( document ).ready(function($) {
	// Append the search icon list item to the main nav
   wp.customize('search_menu_icon', function(control) {
      control.bind(function( controlValue ) {
			if( controlValue == true ) {
				// If the switch is on, add the search icon
				$('.nav-menu').append('<li class="menu-item menu-item-search"><a href="#" class="nav-search"><i class="fa fa-search"></i></a></li>');
			}
			else {
				// If the switch is off, remove the search icon
				$('li.menu-item-search').remove();
			}
      });
   });

	// Change the font-size of the h1
	wp.customize('sample_slider_control', function(control) {
		control.bind(function( controlValue ) {
			$('h1').css('font-size', controlValue + 'px');
		});
	});
});

;(function( $ ){

  'use strict';

		if ( ( 'ontouchstart' in window )
				|| (navigator.MaxTouchPoints > 0)
				|| (navigator.msMaxTouchPoints > 0)
		) {

		var $dropdownParents = $( '.pwd-dropdown-menu li.menu-item-has-children > a' );

		$dropdownParents.each( function() {

			var $this = $( this ),
				$parent = $this.parent( 'li' );

			$( this ).on( 'click', function( event ) {
				if ( ! $parent.hasClass( 'pwd-active' ) ) {
					$parent.addClass( 'pwd-active' );
					return false;
				} else {
					$parent.removeClass( 'pwd-active' );
				}
			} );

			$( document ).on( 'click touchstart MSPointerDown', function( event ) {

				$parent.removeClass( 'pwd-active' );

			} );

		} );

	  }

} ) ( jQuery );
( function( $ ) {

	'use strict';

	$( document ).ready( function($) {
		$( document ).ajaxSuccess( function( e, xhr, settings ) {
			var widget_id_base = 'pwd_social_profiles';
			if ( settings.data.search( 'action=save-widget' ) != -1 && settings.data.search( 'id_base=' + widget_id_base) != -1 ) {
				stSortServices();
			}
		} );
		function stSortServices() {
			$( '.pwd-services-list' ).each( function() {
				var id = $( this ).attr( 'id' );
				$( '#'+ id ).sortable( {
					placeholder : "placeholder",
					opacity     : 0.6
				} );
			} );
		}
		stSortServices();
	} );

} ) ( jQuery );
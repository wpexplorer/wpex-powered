 /**
 * Theme functions
 * Initialize all scripts and adds custom js
 *
 * @since 1.0.0
 *
 */

( function( $ ) {

	'use strict';

	var wpexFunctions = {

		/**
		 * Define cache var
		 *
		 * @since 1.0.0
		 */
		cache: {},

		/**
		 * Main Function
		 *
		 * @since 1.0.0
		 */
		init: function() {
			this.cacheElements();
			this.bindEvents();
		},

		/**
		 * Cache Elements
		 *
		 * @since 1.0.0
		 */
		cacheElements: function() {
			this.cache = {
				$window   : $( window ),
				$document : $( document ),
				$body     : $( 'body' ),
				$isMobile : false,
				$isRTL    : false,
			};
		},

		/**
		 * Bind Events
		 *
		 * @since 1.0.0
		 */
		bindEvents: function() {

			// Get sef
			var self = this;

			// Check RTL
			if ( self.cache.$body.hasClass( 'rtl' ) ) {
				self.cache.$isRTL = true;
			}

			// Check if touch is supported
			self.cache.$isTouch = ( ( 'ontouchstart' in window ) || ( navigator.msMaxTouchPoints > 0 ) );

			// Run on document ready
			self.cache.$document.on( 'ready', function() {
				self.mobileCheck();
				self.headerSearch();
				self.responsiveEmbeds();
				self.commentScrollTo();
				self.commentLastClass();
				self.scrollTop();
				self.mobileMenu();
			} );

			// Run on Window Load
			self.cache.$window.on( 'load', function() {
				self.cache.$body.addClass( 'pwd-site-loaded' );
				self.masonry();
			} );

		},

		/**
		 * Mobile Check
		 *
		 * @since 1.0.0
		 */
		mobileCheck: function() {
			if ( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test( navigator.userAgent ) ) {
				this.cache.$body.addClass( 'pwd-is-mobile-device' );
				this.cache.$isMobile = true;
				return true;
			}
		},

		/**
		 * Header search
		 *
		 * @since 1.0.0
		 */
		headerSearch: function() {
			var $headerSearch = $( '.pwd-site-header-search' ),
				$headerSearchToggle = $( '.pwd-search-toggle' );
			$headerSearchToggle.click( function() {
				$headerSearch.toggleClass( 'pwd-active' );
				return false;
			} );
			this.cache.$document.on( 'click', function( event ) {
				if ( ! $( event.target ).closest(  $headerSearch ).length ) {
					$headerSearch.removeClass( 'pwd-active' );
				}
			} );
		},

		/**
		 * Masonry Grids
		 *
		 * @since 1.0.0
		 */
		masonry: function() {
			if ( typeof( $.fn.masonry ) !== 'undefined' ) {
				var self       = this,
					$grid      = $( '.pwd-entries' ),
					$settings  = $grid.data( 'settings' );
				if ( $settings ) {
					$grid.imagesLoaded( function() {
						$grid.isotope( $settings );
					} );
				}
			}
		},

		/**
		 * Responsive embeds
		 *
		 * @since 1.0.0
		 */
		responsiveEmbeds: function() {
			$( '.pwd-responsive-embed' ).fitVids( {
				ignore: '.pwd-fitvids-ignore'
			} );
			$( '.pwd-responsive-embed' ).addClass( 'pwd-show' );
		},

		/**
		 * Comment link scroll to
		 *
		 * @since 1.0.0
		 */
		commentScrollTo: function() {
			$( '.single .comments-link' ).click( function() {
				var $target = $( '#comments' );
				var $offset = 30;
				if ( $target.length ) {
					$( 'html,body' ).animate({
						scrollTop: $target.offset().top - $offset
					}, 1000 );
					return false;
				}
			} );
		},

		/**
		 * Comments last class
		 *
		 * @since 1.0.0
		 */
		commentLastClass: function() {
			$( ".commentlist li.pingback" ).last().addClass( 'last' );
		},

		/**
		 * Mobile Menu
		 *
		 * @since 1.0.0
		 */
		mobileMenu: function() {
			var $closedSymbol = this.cache.$isRTL ? '&#9668;' : '&#9658;';
			if ( $.fn.slicknav != undefined ) {
				var $mobileMenuAlt = $( '.pwd-mobile-menu-alt ul' );
				var $menu = $mobileMenuAlt.length ? $mobileMenuAlt : $( '.pwd-site-nav-container .pwd-dropdown-menu' );
				if ( $menu.length ) {
					$menu.slicknav( {
						appendTo        : '.pwd-site-header',
						label            : pwdLocalize.mobileSiteMenuLabel,
						allowParentLinks : true,
						closedSymbol     : $closedSymbol
					} );
				}
			}
		},

		/**
		 * Scroll top function
		 *
		 * @since 1.0.0
		 */
		scrollTop: function() {

			var $scrollTopLink = $( 'a.pwd-site-scroll-top' );

			this.cache.$window.scroll(function () {
				if ( $( this ).scrollTop() > 100 ) {
					$scrollTopLink.addClass( 'pwd-show' );
				} else {
					$scrollTopLink.removeClass( 'pwd-show' );
				}
			} );

			$scrollTopLink.on( 'click', function() {
				$( 'html, body' ).animate( {
					scrollTop : 0
				}, 400 );
				return false;
			} );

		},

	}; // END wpexFunctions

	// Get things going
	wpexFunctions.init();

} ) ( jQuery );
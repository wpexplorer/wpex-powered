( function( $ ) {

	'use strict';

	var wpexFunctions = {

		/**
		 * Define cache var
		 */
		cache: {},

		/**
		 * Main Function
		 */
		init: function() {
			this.cacheElements();
			this.bindEvents();
		},

		/**
		 * Cache Elements
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
		 */
		bindEvents: function() {
			const self = this;

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
				self.commentScrollTo();
				self.scrollTop();
				self.mobileMenu();
				self.menuDropdownsTouch();
			} );
		},

		/**
		 * Mobile Check
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
		 */
		headerSearch: function() {
			var $headerSearch = $( '.pwd-site-header-search' ),
				$headerSearchToggle = $( '.pwd-search-toggle' );
			$headerSearchToggle.click( function() {
				$headerSearch.toggleClass( 'pwd-active' );
				if ( $headerSearch.hasClass( 'pwd-active' ) ) {
					$headerSearch.find( 'input' ).focus();
				}
				return false;
			} );
			this.cache.$document.on( 'click', function( event ) {
				if ( ! $( event.target ).closest(  $headerSearch ).length ) {
					$headerSearch.removeClass( 'pwd-active' );
				}
			} );
		},

		/**
		 * Comment link scroll to
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
		 * Mobile Menu
		 */
		mobileMenu: function() {
			var $closedSymbol = this.cache.$isRTL ? '&#9668;' : '&#9658;';
			if ( $.fn.slicknav != undefined ) {
				var $menu = $( '.pwd-site-nav-container .pwd-dropdown-menu' );
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
				}, 400, function() {
					const siteWrap = document.querySelector( '#pwd-site-top' );
					if ( siteWrap ) {
						siteWrap.focus();
					}
				} );
				return false;
			} );
		},

		/**
		 * Scroll top function
		 */
		menuDropdownsTouch: function() {
			if ( ! this.mobileCheck() ) {
				return;
			}

			const hideAllDrops = () => {
				document.querySelectorAll( '.pwd-active' ).forEach( el => {
					el.classList.remove( 'pwd-active' );
				} );
			};

			const onClick = ( event ) => {
				const target = event.target;
				const activeLink = target.closest( 'pwd-active' );
				const parentLink = target.closest( '.pwd-dropdown-menu .menu-item-has-children > a' );
				if ( ! activeLink && ! parentLink ) {
					return hideAllDrops();
				}

				if ( ! parentLink ) {
					return;
				}

				document.querySelectorAll( '.pwd-active' ).forEach( el => {
					if ( ! el.contains( target ) ) {
						el.classList.remove( 'pwd-active' );
					}
				} );

				const parent = target.closest( '.menu-item-has-children' );
				if ( ! parent.classList.contains( 'pwd-active' ) ) {
					parent.classList.add( 'pwd-active' );
					event.preventDefault();
				} else {
					parent.classList.remove( 'pwd-active' );
				}
			};

			window.addEventListener( 'click', onClick, false);
		}

	};

	wpexFunctions.init();

} ) ( jQuery );
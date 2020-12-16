/**
 * customizer.js
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {
	// Site title and description.
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a' ).text( to );
		} );
	} );
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to );
		} );
	} );

	wp.customize( 'nav_button_label', function( value ) {
		value.bind( function( to ) {
			$( '.nav-btn-li .btn' ).text( to );
		} );
	} );

    wp.customize( 'nav_button_url', function( value ) {
        value.bind( function( to ) {
            $( '.nav-btn-li .btn' ).attr( 'href', to );
        } );
    } );

	wp.customize( 'nav_button_show', function( value ) {
		value.bind( function( to ) {
		    if ( ! to ) {
		        $( '.nav-btn-li' ).hide();
            } else {
                $( '.nav-btn-li' ).show();
            }

		} );
	} );
	// Header text color.
	wp.customize( 'header_textcolor', function( value ) {
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				$( '.site-title' ).css( {
					'clip': 'rect(1px, 1px, 1px, 1px)',
					'position': 'absolute'
				} );
			} else {
				$( '.site-title' ).css( {
					'clip': 'auto',
					'position': 'relative'
				} );
				$( '.site-title a, .site-title .site-description' ).css( {
					'color': to
				} );
			}
		} );
	} );


} )( jQuery );

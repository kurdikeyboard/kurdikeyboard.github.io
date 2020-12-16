function _to_number( string ) {
    if ( typeof string === 'number' ) {
        return string;
    }
    var n  = string.match(/\d+$/);
    if ( n ) {
        return parseFloat( n[0] );
    } else {
        return 0;
    }
}

jQuery(document).ready(function( $ ) {

    var headerNav = $( '#dt-header-nav' );
    var primaryMenu = $('#primary-menu');
    var primaryMenuContainer = $('#primary-menu-container');
    var navMenuHeight = headerNav.height();

    function setupMobileMenu( hh ){
        //var hh = headerNav.height();
        if ( primaryMenu.hasClass('menu-show') ) {
            var o = headerNav.css('top') || 0;
            o = parseFloat( o );
            var wh = $(window).height();
            //var hh = $( '#dt-site-logo' ).height();
            var _h = wh -(  o + hh );
            primaryMenuContainer.css( 'max-height', _h +'px' );
        } else {
            primaryMenuContainer.css( 'max-height', 0 );
            // Reset Nav menu height
            navMenuHeight = headerNav.height();
        }
    }

    function navScroll( ){
        var scroll = jQuery(window).scrollTop();
        var top =  0, topbarH = 0;
        var wpadminbar = $( '#wpadminbar' );
        var topbar = $( '#header-topbar' );
        var isFixedWPbar = false;
        var breakPoint = 0;
        if ( topbar.length > 0 ) {
            if (headerNav.hasClass('dt-home-menu') || !$('body').hasClass('home')) {
                if (topbar.length > 0) {
                    topbarH += topbar.height();
                }
            }
            breakPoint += topbarH;
        }

        if ( wpadminbar.length > 0 ) {
            top += wpadminbar.height();
            if ( wpadminbar.css( 'position' ) != 'fixed' ) {
                breakPoint += top;
                isFixedWPbar = false;
            } else {
                isFixedWPbar = true;
            }
        }

        if ( breakPoint <= 0 ) {
            breakPoint = 1;
        }
        if ( scroll < breakPoint ) {
            if ( isFixedWPbar ){
                breakPoint += top;
            }
            headerNav.css( 'top', ( breakPoint ) - scroll  );
            jQuery( '.dt-home-menu' ).addClass( 'dt-main-menu-scroll' );
            jQuery( 'body' ).addClass( 'dt-body-menu-scroll' );
        } else {
            if ( ! isFixedWPbar ) {
                headerNav.css( 'top', 0 );
            } else {
                headerNav.css( 'top', top );
            }
            jQuery( '.dt-home-menu' ).removeClass( 'dt-main-menu-scroll' );
            jQuery( 'body' ).removeClass( 'dt-body-menu-scroll' );
        }
       setTimeout( function(){
           setupMobileMenu( navMenuHeight );
       }, 600 );
    }
    navScroll();
    jQuery(window).scroll(function() {
        navScroll();
    });

    // Toggle Menu
    jQuery( '.dt-menu-md' ).on( 'click', function(){
        navMenuHeight = headerNav.height();
        primaryMenu.toggleClass( 'menu-show' );
        jQuery(this).find( '.fa' ).toggleClass( 'fa-bars fa-close' );
        setupMobileMenu( navMenuHeight );
    });

    jQuery(window).resize(function() {
        primaryMenuContainer.css( 'max-height', '' );
        navScroll();
    });

    var dt_front_slider = new Swiper ('.dt-featured-post-slider',{
        paginationClickable: true,
        nextButton: '.swiper-button-next',
        prevButton: '.swiper-button-prev',
        slidesPerView: 1,
        spaceBetween: 0,
        loop: true,
        autoplay: 3000,
        speed: 1200,
        effect: 'fade',

        onTransitionStart: function(slider) {
            var active_slide = slider.activeIndex;
            setInterval( function(){
                jQuery('.swiper-slide').eq(active_slide).find('.dt-featured-post-meta').fadeIn().addClass('animated fadeInUp');
            }, 400 );
        },

        onSlideChangeEnd: function(slider) {
            var next_slide = slider.activeIndex+1;
            var previous_slide = slider.previousIndex;
            jQuery('.swiper-slide').eq(next_slide).find('.dt-featured-post-meta').hide();
            jQuery('.swiper-slide').eq(previous_slide).find('.dt-featured-post-meta').hide();
        }
    });


    $( '.swiper-slide figure').each( function(){
        var f = $( this  );
        var $img = $( 'img', f );
        if ( $img.length > 0 ) {
            f.css( 'background-image', 'url("'+( $img.attr( 'src' ) ) +'")' );
        }
    } );


    function testimotial_init(){
        // Initialize Testimonial slider
        var dt_testimonial_slider = new Swiper('.dt-testimonial-slider', {
            paginationClickable: true,
            nextButton: '.swiper-button-next',
            prevButton: '.swiper-button-prev',
            slidesPerView: 1,
            spaceBetween: 0,
            loop: true,
            autoplay: 3000,
            speed: 800
        });
    }

    testimotial_init();

    

    // Back to Top
    if (jQuery('#back-to-top').length) {
        var scrollTrigger = 500, // px
            backToTop = function () {
                var scrollTop = jQuery(window).scrollTop();
                if (scrollTop > scrollTrigger) {
                    jQuery('#back-to-top').addClass('show');
                } else {
                    jQuery('#back-to-top').removeClass('show');
                }
            };
        backToTop();
        jQuery(window).on('scroll', function () {
            backToTop();
        });
        jQuery('#back-to-top').on('click', function (e) {
            e.preventDefault();
            jQuery('html,body').animate({
                scrollTop: 0
            }, 600);
        });
    }


    if ( 'undefined' !== typeof wp && wp.customize && wp.customize.selectiveRefresh ) {

        wp.customize.selectiveRefresh.bind( 'partial-content-rendered', function( placement ) {
            if ( placement.container ) {
                testimotial_init();
            }
        } );

    }

    /**
     * Gallery
     */
    function gallery_init( $context ){

        if ( ! $.fn.imagesLoaded )  {
            return ;
        }

        // justified
        if ( $.fn.justifiedGallery ) {
            $( '.gallery-justified', $context).imagesLoaded( function(){
                $( '.gallery-justified', $context).each( function(){
                    var margin = $( this).attr( 'data-spacing' ) || 20;
                    var row_height = $( this).attr( 'data-row-height' ) || 120;
                    margin = _to_number( margin );
                    row_height = _to_number( row_height );

                    $( this ).justifiedGallery({
                        rowHeight: row_height,
                        margins: margin,
                        selector: 'a, div:not(.spinner), .inner'
                    });

                } );
            } );
        }

        $( '.gallery-slider', $context ).swiper( {
            pagination: '.swiper-pagination',
            paginationClickable: true,
            slidesPerView: 1,
            nextButton: '.swiper-button-next',
            prevButton: '.swiper-button-prev',
            spaceBetween: 0
        } );


        $( '.gallery-carousel', $context ).each( function () {
            var g = $(this);
            g.imagesLoaded( function() {
                setTimeout( function(){
                    var col = g.data('col') || 0;
                    col = _to_number(col);
                    if ( col <= 0 ) {
                        col = 4;
                    }
                    g.swiper({
                        pagination: '.swiper-pagination',
                        paginationClickable: true,
                        slidesPerView: col,
                        nextButton: '.swiper-button-next',
                        prevButton: '.swiper-button-prev',
                        spaceBetween: 0,
                        autoHeight: false,
                        breakpoints: {
                            480: {
                                slidesPerView: 1
                            },
                            640: {
                                slidesPerView: ( col - 1 >= 2 ) ? 2 : col
                            },
                            768: {
                                slidesPerView: ( col - 1 >= 3 ) ? 3 : col
                            }
                        }
                    });
                }, 300 );
            });
        } );

        function isotope_init (){
            if ( $.fn.isotope ) {
                $(".gallery-masonry", $context ).each(function () {
                    var m = $(this);
                    var gutter = m.attr('data-gutter') || 10;
                    var columns = m.attr('data-col') || 5;

                    gutter = _to_number(gutter);
                    columns = _to_number(columns);

                    var w = $(window).width();
                    if ( w <= 940 ) {
                        columns = columns > 2 ? columns - 1 : columns;
                    }

                    if ( w <= 720 ) {
                        columns = columns > 3 ? 3 : columns;
                    }

                    if ( w <= 576 ) {
                        columns = columns > 2 ? 2 : columns;
                    }

                    //gutter = gutter / 2;
                    // m.parent().css({'margin-left': -gutter, 'margin-right': -gutter});
                    m.find('.g-item').css({'width': ( 100 / columns  ) + '%', 'float': 'left', 'padding': 0});
                    // m.find('.g-item .inner').css({'padding': gutter / 2});
                    m.isotope({
                        // options
                        itemSelector: '.g-item',
                        percentPosition: true,
                        masonry: {
                            columnWidth: '.inner'
                        }
                    });

                });
            }
        }
        var gallery = $( ".gallery-masonry", $context );
        gallery.imagesLoaded( function() {
            isotope_init( gallery );
            setTimeout(  function(){
                isotope_init( gallery );
            } , 500 );
        });

        if ( $.fn.lightGallery ) {
            $('.enable-lightbox', $context).lightGallery({
                mode: 'lg-fade',
                selector: 'a',
                //cssEasing : 'cubic-bezier(0.25, 0, 0.25, 1)'
            });

        }

        var setGalleryMod = function( $context ){
            var ww = $( window ).width();
            $context.each( function(){
                var s = $( this );
                if ( s.hasClass( 'full-width' ) ) {
                    s.removeAttr('style');
                    var w = s.width();
                    var l = ( ww - w ) / 2;
                    if ( l > 0 ) {
                        l = -l;
                    }
                    var r = l;
                    s.css({'margin-left': (l) + 'px', 'margin-right': l + 'px'});
                }

            } );
        };

       setGalleryMod( $context );

        $( window ).resize( function(){
            setGalleryMod( $context );
            isotope_init( gallery );
        } );

    }

    gallery_init( $( '.gallery-content' ) );

    if ( 'undefined' !== typeof wp && wp.customize && wp.customize.selectiveRefresh ) {
        wp.customize.selectiveRefresh.bind( 'partial-content-rendered', function( placement ) {
            var idBase = placement.partial && placement.partial.widgetIdParts && placement.partial.widgetIdParts.idBase || '';
            if ( idBase == 'glow_gallery' ) {
                console.log( 'idBase', idBase );
                gallery_init( placement.container.find( '.gallery-content' ) );
                // Trigger resize to make other sections work.
                $( window ).resize();
            }
        } );
    }


});

(function ($, window, document) {
    "use strict";

    $(document).on( 'ready', function(){
        var $body = $('body'),
            content_width   = $('.content').width(),
            container_width = $('.container').width();

        /*************************
         * WAYPOINT
         *************************/

        $.fn.yit_waypoint = function() {
            if (typeof jQuery.fn.waypoint !== 'undefined') {
                $('.yit_animate:not(.animated)').waypoint(function() {
                    var delay = $(this).data('delay');
                    $(this).delay(delay).queue(function(next){
                        $(this).addClass('animated');
                        $(this).css('opacity','1');
                        next();
                    });
                }, {offset: '98%'});
            }
        };

        if ( ! YIT_Browser.isMobile() ) {
            $('.yit_animate:not(.animated)').yit_waypoint();
        }



        /*************************
         * IMAGE STYLED
         *************************/

        $(window).on('load', function () {
            if ($.fn.prettyPhoto) {
                $(".image-styled .img_frame a[rel^='prettyPhoto']").prettyPhoto({
                    social_tools: ''
                });
            }
        });

        /*************************
         * BLOG SECTION
         *************************/

        $('.blog-slider').each(function(){
            var t = $(this),
                slider = t.find('.blogs_posts'),
                enable_slider = slider.data('slider'),
                owl,
                slides = ( container_width == 1140 && content_width < container_width ) ? 2 : 4,
                fixArrows = function() {
                    var active_items  = slider.find('.owl-item.active').length,
                        slides_number = slider.find('.owl-item').length;

                    if( slides_number == active_items ) {
                        t.find('.prev-blog, .next-blog').hide();
                    } else {
                        t.find('.prev-blog, .next-blog').show();
                    }
                };

            if( enable_slider != 'no' && $.fn.owlCarousel ) {

                t.imagesLoaded(function(){
                    owl = slider.owlCarousel({
                        items : slides,
                        itemsDesktop: [1199, slides],
                        itemsDesktopSmall: [991, 1],
                        itemsTablet: [767, 1],
                        itemsMobile: [479, 1],
                        addClassActive: true
                    });
                });

                _onresize( fixArrows );
                fixArrows();

                t.on( 'click', '.prev-blog', function(e){
                    e.preventDefault();
                    owl.trigger('owl.prev');
                });

                t.on( 'click', '.next-blog', function(e){
                    e.preventDefault();
                    owl.trigger('owl.next');
                });
            }else {
                t.find('.prev-blog, .next-blog').hide();
                slider.find('li.blog_post').css( 'margin-bottom', '30px' );
            }
        });


        /*************************
         * FAQ
         *************************/

        $('#faqs-container').yit_faq();

    });

})( jQuery, window, document );
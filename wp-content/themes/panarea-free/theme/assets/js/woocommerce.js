(function ($, window, document) {
    "use strict";

    $(document).on( 'ready', function(){
        var $body = $('body'),
            $topbar = $( document.getElementById('topbar') );

        /*************************
         * SHOP STYLE SWITCHER
         *************************/

        $('#list-or-grid').on( 'click', 'a', function(){

            var trigger = $(this),
                view = trigger.attr( 'class' ).replace('-view', '');

            $( 'ul.products li' ).removeClass( 'list grid' ).addClass( view );
            trigger.parent().find( 'a' ).removeClass( 'active' );
            trigger.addClass( 'active' );

            $.cookie( yit_shop_view_cookie, view );

            return false;

        });


        /*************************
         * ADD TO CART
         *************************/
        var product, product_onsale;

        $('ul.products').on('click', 'li.product .add_to_cart_button', function () {
             product = $(this).parents('li.product');
             product_onsale = product.find('.product-wrapper > .onsale');

            if( typeof yit.load_gif != 'undefined' ) {
                product.find('.thumb-wrapper').block({message: null, overlayCSS: {background: '#fff url(' + yit.load_gif + ') no-repeat center', opacity: 0.3, cursor: 'none'}});
            }
            else{
                product.find('.thumb-wrapper').block({message: null, overlayCSS: {background: '#fff url(' + woocommerce_params.ajax_loader_url.substring(0, woocommerce_params.ajax_loader_url.length - 7) + '.gif) no-repeat center', opacity: 0.3, cursor: 'none'}});
            }

        });

        $body.on('added_to_cart', function () {

            if( typeof product_onsale === 'undefined' && typeof product === 'undefined' ) return;

                if ( product_onsale.length ) {
                    product_onsale.remove();
                }

                product.find('.thumb-wrapper').append('<div class="added_to_cart_box"><div class="added_to_cart_label">' + yit.added_to_cart + '</div></div>');
                product.find('.added_to_cart_label').append(product.find('a.added_to_cart'));
                product.find('.product-wrapper div:first-child').addClass('nohover');

                setTimeout( function(){
                    product.find('.added_to_cart_box').fadeOut(2000, function(){ $(this).remove(); });
                    product.find('.product-wrapper div:first-child').removeClass('nohover');
                }, 3000 );

                if (product.find('.product-wrapper > .added_to_cart_ico').length == 0) {
                    setTimeout(function() {
                        product.find('.product-wrapper').append('<span class="added_to_cart_ico">' + yit.added_to_cart_ico + '</span>');
                    }, 4000);
                }
                product.find('.thumb-wrapper').unblock();
        });


        /*************************
         * VARIATIONS SELECT
         *************************/

        var variations_select = function(){
            // variations select
            if( $.fn.selectbox ) {
                var form = $('form.variations_form');
                var select = form.find('select:not(.yith_wccl_custom)');

                if( form.data('wccl') ) {
                    select = select.filter(function(){
                        return $(this).data('type') == 'select'
                    });
                }

                select.selectbox({
                    effect: 'fade',
                    onOpen: function() {
                        //$('.variations select').trigger('focusin');
                    }
                });

                var update_select = function(event){  // console.log(event);
                    select.selectbox("detach");
                    select.selectbox("attach");
                };

                // fix variations select
                form.on( 'woocommerce_update_variation_values', update_select);
                form.find('.reset_variations').on('click.yit', update_select);
            }
        };
        variations_select();



        /*************************
         * Update Calculate Shipping Select
         *************************/

        if ( $.fn.selectbox ) {
            $('#calc_shipping_state').next('.sbHolder').addClass('stateHolder');
            $body.on('country_to_state_changing', function(){
                $('.stateHolder').remove();
                $('#calc_shipping_state').show().attr('sb', '');

                $('select#calc_shipping_state').selectbox({
                    effect: 'fade',
                    classHolder: 'stateHolder sbHolder'
                });
            });
        }

        /*************************
         * Login Form
         *************************/

        $('#login-form').on('submit', function(){
            var a = $('#reg_password').val();
            var b = $('#reg_password_retype').val();
            if(!(a==b)){
                $('#reg_password_retype').addClass('invalid');
                return false;
            }else{
                $('#reg_password_retype').removeClass('invalid');
                return true;
            }
        });


    });

})( jQuery, window, document );
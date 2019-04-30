jQuery(document).ready(function( $ ) {

    var $elToFix = $('.archive .eve-top');
    if ($elToFix.length > 0) {
        var elementPosition = $elToFix.offset();

        function unfixEl() {
            $('body').css('padding-top', 0);
            $('body').removeClass('eve-top-fixed');
            $elToFix.removeClass('fixed');
            jarallax(document.querySelectorAll('.jarallax'), 'clipContainer');
            jarallax(document.querySelectorAll('.jarallax'), 'coverImage');
            jarallax(document.querySelectorAll('.jarallax'), 'onScroll');
            $elToFix.on('transitionend webkitTransitionEnd oTransitionEnd', function () {
                jarallax(document.querySelectorAll('.jarallax'), 'clipContainer');
                jarallax(document.querySelectorAll('.jarallax'), 'coverImage');
                jarallax(document.querySelectorAll('.jarallax'), 'onScroll');
                // $('.jarallax').jarallax({
                //     speed: 0.2
                // });
            });
        }

        $(window).scroll(function(){
            // console.log($(window).scrollTop());
            // console.log(elementPosition.top);
                if($(window).scrollTop() > 0 && $(window).width() > 991 && $(window).height() > 662){
                    //jarallax(document.querySelectorAll('.jarallax'), 'destroy');
                    $('body').css('padding-top', $elToFix.height() + 50);
                    $('body').addClass('eve-top-fixed');
                    $elToFix.addClass('fixed');
                } else {
                    unfixEl();
                }
        });
    }

    $floatingCart = $('.eve-cart');
    if ($floatingCart.length > 0) {
        var elementPosition = $floatingCart.offset();

        function unfixEl() {
            $floatingCart.removeClass('fixed');
        }

        $(window).scroll(function(){
                if($(window).scrollTop() > elementPosition.top && $(window).width() > 767 && $(window).height() > 767){
                    $floatingCart.addClass('fixed');
                } else {
                    unfixEl();
                }
        });
    }

    jQuery(".eve-owl").owlCarousel({items:1, dots: true, loop: true});

    //trigger mini cart animation on add to cart btn clicked
    $( '.eve-product__prices-wrap .add_to_cart_button' ).on( 'click', function(){
        var cart = document.querySelector('.eve-cart');
        cart.classList.remove("bounceIn");
        void cart.offsetWidth; //magic more at https://css-tricks.com/restart-css-animation/
        cart.classList.add("bounceIn");
    });

});

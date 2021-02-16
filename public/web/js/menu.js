/* Theme Name: Madelyn - Multipurpose Templates
   Author: Shreethemes
   Version: 1.0.0
   Created: July 2019
   File Description:Main JS file of the template
*/

(function ($) {
    'use strict';
    // Navbat Toggle
    var scroll = $(window).scrollTop();

    $('.navbar-toggle').on('click', function (event) {
        $(this).toggleClass('open');
        $('#navigation').slideToggle(400);
    });

    $('.navigation-menu>li').slice(-4).addClass('last-elements');

    $('.menu-arrow,.submenu-arrow').on('click', function (e) {
        if ($(window).width() < 992) {
            e.preventDefault();
            $(this).parent('li').toggleClass('open').find('.submenu:first').toggleClass('open');
        }
    });
    
    $(".navigation-menu a").each(function () {
        if (this.href == window.location.href) {
            $(this).parent().addClass("active"); // add active to li of the current link
            $(this).parent().parent().parent().addClass("active"); // add active class to an anchor
            $(this).parent().parent().parent().parent().parent().addClass("active"); // add active class to an anchor
        }
    });
    // Smooth scroll
    $('.navigation-menu a, .mouse-down').on('click', function(event) {
        var $anchor = $(this);
        $('html, body').stop().animate({
            scrollTop: $($anchor.attr('href')).offset().top - 0
        }, 1500, 'easeInOutExpo');
        event.preventDefault();
    });

    //SCROLLSPY
    $(".navigation-menu").scrollspy({
        offset: 20
    });

    //sticky header on scroll
    $(window).scroll(function() {    
    var scroll = $(window).scrollTop();

        if (scroll >= 50) {
            $(".navbar-sticky").addClass("small");
        } else {
            $(".navbar-sticky").removeClass("small");
        }
    });

    $(window).scroll(function() {
        var scroll = $(window).scrollTop();

        if (scroll >= 50) {
            $(".sticky").addClass("nav-sticky");
        } else {
            $(".sticky").removeClass("nav-sticky");
        }
    });
})(jQuery) 
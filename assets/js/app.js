/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import '../css/app.scss';

// Need jQuery? Install it with "yarn add jquery", then uncomment to import it.
// import $ from 'jquery';

const $ = require('jquery');

// this "modifies" the jquery module: adding behavior to it
// the bootstrap module doesn't export/return anything
require('bootstrap');

$(document).ready(function() {
    $('[data-toggle="popover"]').popover();
});

$(document).ready(function(){

    if($(document).scrollTop()<10){
        $('.navbar').css({
            'background': 'var(--navbar-color-transp)',
        });

        $('.navbar a').css({
            'color':'var(--navbar-link-color-light)',
        });
    }

    // faire apparaitre #text1
    $(window).scroll(function(){
        let posScroll = $(document).scrollTop();

        if(posScroll >=1) {

            $('.navbar').css({
                'background': 'var(--navbar-color)',
            });

            $('.navbar a').css({
                'color':'var(--navbar-link-color-dark)',
            });

        } else {

            $('.navbar').css({
                'background': 'var(--navbar-color-transp)',
            });

            $('.navbar a').css({
                'color':'var(--navbar-link-color-light)',
            });

        }
    });
});

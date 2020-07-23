import '../css/homepage.scss';

window.addEventListener("scroll", function(){

    if( window.innerWidth > 500) {
        let pageX=window.scrollY;
        let nodes=document.getElementsByClassName('parallax-object');
        for (let i=0; i<nodes.length; i++) {
            let parallaxObject1= nodes[i];
            let backgroundShift1=-0.05*(i+1)*pageX;
            parallaxObject1.style.top=backgroundShift1+'px';
        }
    }
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

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

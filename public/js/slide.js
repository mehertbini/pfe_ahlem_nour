$(window).load( function(){
    jQuery('#camera_wrap_1').camera({
        height: '73,00%',
        // thumbnails: true,
        playPause: false,
        time: 8000,
        transPeriod: 900,
        fx: 'simpleFade',
        loader: 'none',
        minHeight:'200px',
        navigation: false
    });

    $().UItoTop({ easingType: 'easeOutQuart' });

    $('#foo').carouFredSel({
        auto: false,
        responsive: true,
        width: '100%',
        prev: '#prev1',
        next: '#next1',
        scroll: 1,
        items: {
            height: 'auto',
            width: 300,
            visible: {
                min: 1,
                max: 1
            }
        },
        mousewheel: false,
        swipe: {
            onMouse: true,
            onTouch: true
        }
    });
});

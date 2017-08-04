/**
 * All pages
 */
jQuery(window).on('load', function(){

});

jQuery(document).ready(function($){
    $('.mobile-sidebar-trigger').click(function (evt) {
        evt.preventDefault();
    
        $(this).parent().toggleClass('sidebar-expanded'); 
    });
    
    $('.mobile-menu-trigger').click(function(evt){
        $(this).closest('#nav-primary').toggleClass('expanded');
    });
});

/**
 * Home page
 */
jQuery(document).ready(function($){
    if($('body.home').length < 1)
        return;
       /* 
    // mobile menu
    $('#nav-primary ul').slick({
        infinite: true,
        slidesToShow: 2,
        slidesToScroll: 1,
        mobileFirst:    true,
        centerMode:     true,
        responsive: [
            {
                breakpoint: CQP_VARS.BREAKPOINTS.BREAKPOINT_SM,
                settings: {
                    centerMode:     false,
                    arrows:         true,
                    slidesToShow:   3,
                    slidesToScroll: 1
                },
            },
            {
                breakpoint: CQP_VARS.BREAKPOINTS.BREAKPOINT_MD,
                settings: "unslick"
            }
        ]
    });*/
    
    $('.home-slider').slick({
        infinite: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 4000,
        nextArrow:  "<div class='slider-control right'>"+
        "<i class='fa fa-chevron-right'></i>"+
        "</div>",
        prevArrow:  "<div class='slider-control left'>"+
        "<i class='fa fa-chevron-left'></i>"+
        "</div>",
    });

    $('.recent-posts .posts').slick({
        infinite:       true,
        slidesToShow:   1,
        mobileFirst:    true,
        centerMode:     true,
        arrows:         false,
        appendArrows: $('.home .recent-posts-section'),
        nextArrow:  "<div class='slider-control right'>"+
        "<i class='fa fa-chevron-right'></i>"+
        "</div>",
        prevArrow:  "<div class='slider-control left'>"+
        "<i class='fa fa-chevron-left'></i>"+
        "</div>",
        responsive: [
            {
                breakpoint: CQP_VARS.BREAKPOINTS.BREAKPOINT_SM,
                settings: {
                    centerMode:     false,
                    arrows:         true,
                    slidesToShow:   2,
                    slidesToScroll: 2
                },
            },
            {
                breakpoint: CQP_VARS.BREAKPOINTS.BREAKPOINT_LLG,
                settings: {
                    centerMode: false,
                     arrows: true,
                    slidesToShow: 3,
                    slidesToScroll: 3
                }
            },
            {
                breakpoint: CQP_VARS.BREAKPOINTS.BREAKPOINT_SSL,
                settings: {
                    centerMode:     false,
                    arrows:         true,
                    slidesToShow:   4,
                    slidesToScroll: 4
                }
            },
        ]
    });
});
//# sourceMappingURL=app.js.map

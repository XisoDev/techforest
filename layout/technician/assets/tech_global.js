jQuery(document).ready(function($){
    //레이아웃
    var trigger = $('.hamburger'),
        overlay = $('.overlay'),
        isClosed = false;

    function buttonSwitch() {

        if (isClosed === true) {
            overlay.hide();
            trigger.removeClass('is-open');
            trigger.addClass('is-closed');
            isClosed = false;
        } else {
            overlay.show();
            trigger.removeClass('is-closed');
            trigger.addClass('is-open');
            isClosed = true;
        }
    }

    $('[data-toggle="offcanvas"]').click(function () {
        $('body').toggleClass('toggled');
        buttonSwitch();
    });

    //홈
    $('.flex-card-slick').slick({
        dots: false,
        speed: 300,
        slidesToShow: 1.6,
        slidesToScroll: 1,
        mobileFirst: true,
        centerMode: false,
        infinite:false,
        arrows: false,
        variableWidth: false,
        centerPadding: '0',
        responsive: [{
            breakpoint: 576,
            settings: {
                slidesToShow: 1.6,
                arrows: true,
            }
        },{
            breakpoint: 768,
            settings: {
                slidesToShow: 2.5,
                arrows: true,
            }
        },{
            breakpoint: 992,
            settings: {
                slidesToShow: 3,
                arrows: true,
            }
        }]
    });
    $('.banners_slick').slick({
        dots: true,
        speed: 300,
        slidesToShow: 1,
        slidesToScroll: 1,
        centerMode: false,
        infinite:true,
        arrows: false,
        variableWidth: false
    });

    function affix(class_name){
        var cur_scroll = $(document).scrollTop();
        var scroll_top = $("."+class_name).parent('.standard').offset().top;
        var element_height = $("."+class_name).outerHeight();
        var window_height = $(window).height();

        var middle_pos = scroll_top - window_height - cur_scroll + element_height;
        if(middle_pos <= 0){
            $("."+class_name).removeClass('affix');
        }else{
            $("."+class_name).addClass('affix');
        }

    }

    if($('.affix_middle').length){
        affix("affix_middle");
    }
    $(window).scroll(function(event) {
        if($('.affix_middle').length){
            affix("affix_middle");
        }

        if($(document).scrollTop() > 50){
            $("#header").addClass('shrink');
        }else{
            $("#header").removeClass('shrink');
        }
    });
});
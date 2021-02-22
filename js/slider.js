$(function () {

    var delay = 7000;
    var curIndex = 0;
    var amt;
    initSlider();
    autoPlay();

    function initSlider() {
        amt = $('.conhecimento-single').length;
        var sizeContainer = 100 * amt;
        var sizeBoxSingle = 100 / amt;
        $('.conhecimento-single').css('width', sizeBoxSingle + '%');
        $('.scroll-wraper').css('width', sizeContainer + '%');

        // gera os span's automaticamente pelo numero de elementos no HTML
        for (var i = 0; i < amt; i++) {
            if (i == 0) {
                $('.slider-bullets').append('<span style="background-color: #616060"></span>')
            } else {
                $('.slider-bullets').append('<span></span>')
            }
        }
    }

    function autoPlay() {
        setInterval(function () {
            curIndex++;
            if (curIndex == amt) {
                curIndex = 0;
            }
            goToSlider(curIndex);
        }, delay)
    }

    function goToSlider(curIndex) {
        var offSetX = $('.conhecimento-single').eq(curIndex).offset().left - $('.scroll-wraper').offset().left;
        $('.slider-bullets span').css('background-color', '#ccc');
        $('.slider-bullets span').eq(curIndex).css('background-color', '#616060');
        $('.scrollConhecimento').stop().animate({
            'scrollLeft': offSetX
        });
    }

    $(window).resize(function () {
        $('.scrollConhecimento').stop().animate({
            'scrollLeft': 0
        });
    })
});
// slider conhecimentos
$(function () {
    // scroll dinâmico 
    $(function () {
        $('nav a').click(function () {
            var href = $(this).attr('href');
            var offSetTop = $(href).offset().top;

            $('html,body').animate({
                'scrollTop': offSetTop
            }, 2000);

            return false;
        })
    });
})
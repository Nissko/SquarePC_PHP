/*Скрипт ссылки-якоря*/
$('a[href^="#"]').click(function(){
    let anchor = $(this).attr('href');
    $('html, body').animate({
        scrollTop: $(anchor).offset().top
    }, 1000);
});

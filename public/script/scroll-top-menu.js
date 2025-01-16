let header = $('.navigation'),
    scrollPrev = 0;
$(window).scroll(function() {
    let scrolled = $(window).scrollTop();
    /*Шапка дефолт значения*/
    if ( scrolled == 0) {
        $('.navigation').css('background-color', 'transparent');
        $('.navigation').css('box-shadow', '0 0 0 0');
        $('.navigation ').hover(function(e) {
            $('.project_btn').css("color",e.type === "mouseenter"?"black":"white")
        })
        $('.navigation ').hover(function(e) {
            $('.configurate_btn').css("color",e.type === "mouseenter"?"black":"white")
        })
        $('.navigation ').hover(function(e) {
            $('.legend-slogan-text').css("color",e.type === "mouseenter"?"black":"white")
        })
        $('.navigation ').hover(function(e) {
            $('.aboutUs_btn').css("color",e.type === "mouseenter"?"black":"white")
        })
        $('.navigation ').hover(function(e) {
            $('.shoppingCart_btn').css("color",e.type === "mouseenter"?"black":"white")
        })
    }
    /*Скрытие шапки при скроллинге*/
    if ( scrolled > 250 && scrolled > scrollPrev ) {
        $('.navigation').css('transform', 'translateY(-400%)');
    } else {
        $('.navigation').css('transform', 'translateY(0%)');
    }
    /*Изменение цвета, если пользователь будет скроллить вниз*/
    if( scrolled > 980){
        $('.navigation').css('box-shadow', '0 4px 8px 0 rgba(0, 0, 0, 0.1), 0 6px 20px 0 rgba(0, 0, 0, 0.1)');
    }
    else {
        $('.navigation').css('box-shadow', '0 0 0 0');
    }
    if ( scrolled > 1 ) {
        $('.project_btn').css('color', 'black');
        $('.configurate_btn').css('color', 'black');
        $('.legend-slogan-text').css('color', 'black');
        $('.aboutUs_btn').css('color', 'black');
        $('.shoppingCart_btn').css('color', 'black');
        $('.navigation').css('background-color', 'white');
        /*задержка*/
        $('.navigation').css('transition', 'all 0.5s');
        $('.navigation ').hover(function(e) {
            $('.project_btn').css("color",e.type === "mouseenter"?"black":"black")
        })
        $('.navigation ').hover(function(e) {
            $('.configurate_btn').css("color",e.type === "mouseenter"?"black":"black")
        })
        $('.navigation ').hover(function(e) {
            $('.legend-slogan-text').css("color",e.type === "mouseenter"?"black":"black")
        })
        $('.navigation ').hover(function(e) {
            $('.aboutUs_btn').css("color",e.type === "mouseenter"?"black":"black")
        })
        $('.navigation ').hover(function(e) {
            $('.shoppingCart_btn').css("color",e.type === "mouseenter"?"black":"black")
        })
    }
    else{
        /*изменение цвета кнопок*/
        $('.project_btn').css('color', 'white');
        $('.configurate_btn').css('color', 'white');
        $('.legend-slogan-text').css('color', 'white');
        $('.aboutUs_btn').css('color', 'white');
        $('.shoppingCart_btn').css('color', 'white');
        /*задержка*/
        $('.project_btn').css('transition', 'color 0.5s');
        $('.configurate_btn').css('transition', 'color 0.5s');
        $('.legend-slogan-text').css('transition', 'color 0.5s');
        $('.aboutUs_btn').css('transition', 'color 0.5s');
        $('.shoppingCart_btn').css('transition', 'color 0.5s');
        $('.project_btn ').hover(function(e) {
            $('.project_btn').css("color",e.type === "mouseenter"?"#498aec":"black")
        })
        $('.configurate_btn ').hover(function(e) {
            $('.configurate_btn').css("color",e.type === "mouseenter"?"#498aec":"black")
        })
        $('.legend-slogan-text ').hover(function(e) {
            $('.legend-slogan-text').css("color",e.type === "mouseenter"?"#498aec":"black")
        })
        $('.aboutUs_btn ').hover(function(e) {
            $('.aboutUs_btn').css("color",e.type === "mouseenter"?"#498aec":"black")
        })
        $('.shoppingCart_btn').hover(function(e) {
            $('.shoppingCart_btn').css("color",e.type === "mouseenter"?"#498aec":"black")
        })
    }
    scrollPrev = scrolled;
});

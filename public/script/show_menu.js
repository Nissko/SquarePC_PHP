$('.shoppingCart_btn').click(function(e) {
    $('.sub_menu').toggleClass('show', 'hide');

});
$('.navigation').mouseleave(function(e) {
    $('.show').removeClass('show').addClass('hide');
});

for(let i = 0; i < 99; i++){
    $length = $('.bar-fill-'+i).data("progress");
    $('.bar-fill-'+i).css('width', $length+'%');
    if($length >= 0 && $length <= 25){
        $('.bar-fill-'+i).css('background', 'linear-gradient(to right, red, yellow)');
    }
    else if($length > 25 && $length <= 50){
        $('.bar-fill-'+i).css('background', 'linear-gradient(to right, red, yellow)');
    }
    else if($length > 50 && $length <= 75){
        $('.bar-fill-'+i).css('background', 'linear-gradient(to right, red, yellow, yellowgreen)');
    }
    else{
        $('.bar-fill-'+i).css('background', 'linear-gradient(to right, red, yellow, green)');
    }
}

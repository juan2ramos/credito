/**
 * Created by juan2ramos on 12/01/15.
 */
$(function () {

});

$('#buttonMenu').on('click',function(){
    var $headerNav = $('.Header-nav');
    if($headerNav.hasClass('show--element')){
        $headerNav.removeClass('show--element');

    }else{
        $headerNav.addClass('show--element');
    }
});
$('.u-button').on('click', expand);

function expand(e){
    circle = $("<div class='u-circle'></div>");
    $(this).append(circle);
    x = e.pageX - $(this).offset().left - circle.width() / 2;
    y = e.pageY - $(this).offset().top - circle.height() / 2;
    size = $(this).width();
    circle.css({
        top: y + 'px',
        left: x + 'px',
        width: size + 'px',
        height: size + 'px'
    }).addClass("is-animate");
    setTimeout(function() {
        circle.remove();
    }, 500);
}
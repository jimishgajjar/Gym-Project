// Set this to the width of one star.
var starWidth = 15;

$.fn.stars = function () {
    return $(this).each(function () {
        $(this).html($('<span />').width(Math.max(0, (Math.min(5, parseFloat($(this).html())))) * starWidth));
    });
}
$(document).ready(function () {
    $('span.stars').stars();
});
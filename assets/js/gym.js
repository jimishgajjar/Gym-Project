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

function loadWishlist() {
    $.ajax({
        url: "loadWishlist.php",
        success: function (response) {
            $("#whislist-data").empty();
            $("#whislist-data").append(response);
        }
    });
}

function loadCartlist() {
    $.ajax({
        url: "loadCartlist.php",
        success: function (response) {
            $("#cartlist-data").empty();
            $("#cartlist-data").append(response);
        }
    });
}

function addToCartFromWishlist(cource_id_) {
    $.ajax({
        url: "include/UserSubmitData.php",
        method: "POST",
        data: { module: "addToCartFromWishlist", moduleMethod: "cart", cource_id: cource_id_ },
        success: function (response) {
            $("#cartlist-data").empty();
            $("#cartlist-data").append(response);
        }
    });
} 
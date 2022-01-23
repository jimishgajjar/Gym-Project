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

// function deleteFromCarlist(cource_id_) {
//     $.ajax({
//         url: "include/UserSubmitData.php",
//         method: "POST",
//         data: { module: "deleteFromCarlist", moduleMethod: "cart", cource_id: cource_id_ },
//         success: function (response) {
//             $("#cartlist-data").empty();
//             $("#cartlist-data").append(response);
//         }
//     });
// }

function addToCartFromWishlist(cource_id_) {
    $.ajax({
        url: "include/UserSubmitData.php",
        method: "POST",
        data: { module: "addToCartFromWishlist", moduleMethod: "wishlist", cource_id: cource_id_ },
        success: function (response) {
            $("#whislist-data").empty();
            $("#whislist-data").append(response);
        }
    });
}

function deleteFromWishlist(cource_id_) {
    $.ajax({
        url: "include/UserSubmitData.php",
        method: "POST",
        data: { module: "deleteFromWishlist", moduleMethod: "wishlist", cource_id: cource_id_ },
        success: function (response) {
            $("#whislist-data").empty();
            $("#whislist-data").append(response);
        }
    });
}

$(document).ready(function () {
    $("#div-message").css("display", "none");
});

$(document).ready(function () {
    $('#password, #confirm_password').on('keyup', function () {
        if ($('#password').val() == "" || $('#confirm_password').val() == "") {
            $("#div-message").css("display", "block");
            $('#message').html('Pasword can not be empty').css('color', 'red');
        } else if ($('#password').val() == $('#confirm_password').val()) {
            $("#div-message").css("display", "block");
            $('#message').html('Password matching').css('color', 'green');
        } else {
            $("#div-message").css("display", "block");
            $('#message').html('Password not matching').css('color', 'red');
        }
    });

    $('#userChangePasswordSub').on('click', function () {
        if ($('#password').val() == "" || $('#confirm_password').val() == "") {
            $("#divpass").css("margin-bottom", "0px");
            $("#div-message").css("display", "block");
            $('#message').html('Pasword can not be empty').css('color', 'red');
            return false;
        } else if ($('#password').val() == $('#confirm_password').val()) {
            $("#divpass").css("margin-bottom", "0px");
            $("#div-message").css("display", "block");
            $('#message').html('Password matching').css('color', 'green');
            $('#changePass').submit();
        } else {
            $("#divpass").css("margin-bottom", "0px");
            $("#div-message").css("display", "block");
            $('#message').html('Password not matching').css('color', 'red');
            return false;
        }
    });
});
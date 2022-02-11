// Set this to the width of one star.
var starWidth = 25;

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

// function deleteFromCarlist(course_id_) {
//     $.ajax({
//         url: "include/UserSubmitData.php",
//         method: "POST",
//         data: { module: "deleteFromCarlist", moduleMethod: "cart", course_id: course_id_ },
//         success: function (response) {
//             $("#cartlist-data").empty();
//             $("#cartlist-data").append(response);
//         }
//     });
// }

function addToCartFromWishlist(course_id_) {
    $.ajax({
        url: "include/UserSubmitData.php",
        method: "POST",
        data: { module: "addToCartFromWishlist", moduleMethod: "wishlist", course_id: course_id_ },
        success: function (response) {
            $("#whislist-data").empty();
            $("#whislist-data").append(response);
        }
    });
}

function deleteFromWishlist(course_id_) {
    $.ajax({
        url: "include/UserSubmitData.php",
        method: "POST",
        data: { module: "deleteFromWishlist", moduleMethod: "wishlist", course_id: course_id_ },
        success: function (response) {
            $("#whislist-data").empty();
            $("#whislist-data").append(response);
        }
    });
}

function courseSearch(searchVal) {
    // alert(searchVal.value);
    $.ajax({
        url: "include/UserSubmitData.php",
        method: "POST",
        data: { module: "courseSearch", moduleMethod: "course", searchVal: searchVal.value },
        success: function (response) {
            $("#search_content").empty();
            $("#search_content").append(response);
        }
    });
}

function editReview(review_id) {
    $.ajax({
        url: "include/UserSubmitData.php",
        method: "POST",
        data: { module: "editReviewAjax", moduleMethod: "course_review", review_id: review_id },
        success: function (response) {
            $("#userReview").empty();
            $("#userReview").append(response);
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
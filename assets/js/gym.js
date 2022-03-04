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

function getvideo() {
    var video = document.getElementById("courseVideo");
    var course_position = document.getElementById("course_position").value;
    var chapter_id = document.getElementById("chapter_id").value;
    var content_id = document.getElementById("content_id").value;
    var course_id = document.getElementById("course_id").value;
    // alert(course_position + "*********" + chapter_id);
    // var videoLength = video.duration;
    // var currentVideotime = video.currentTime;

    // var videoCheck = videoLength - 30;
    // if (currentVideotime >= videoCheck) {
    //     $.ajax({
    //         url: "include/UserSubmitData.php",
    //         method: "POST",
    //         data: { module: "editReviewAjax", moduleMethod: "course_review", review_id: review_id },
    //         success: function (response) {
    //             $("#userReview").empty();
    //             $("#userReview").append(response);
    //         }
    //     });
    // }
    if (video.ended == true) {
        $.ajax({
            url: "include/UserSubmitData.php",
            method: "POST",
            data: {
                module: "videoWatched",
                moduleMethod: "course_progress",
                course_position: course_position,
                content_id: content_id,
                chapter_id: chapter_id,
                course_id: course_id
            },
            success: function (response) {
                window.location = response;
            }
        });
    }
}

function getdocument(content_id) {
    var Doc_course_position = document.getElementById("Doc_course_position-" + content_id).value;
    var Doc_chapter_id = document.getElementById("Doc_chapter_id-" + content_id).value;
    var Doc_content_id = document.getElementById("Doc_content_id-" + content_id).value;
    var Doc_course_id = document.getElementById("Doc_course_id-" + content_id).value;
    $.ajax({
        url: "include/UserSubmitData.php",
        method: "POST",
        data: {
            module: "documentWatched",
            moduleMethod: "course_progress",
            Doc_course_position: Doc_course_position,
            Doc_content_id: Doc_content_id,
            Doc_chapter_id: Doc_chapter_id,
            Doc_course_id: Doc_course_id
        },
        success: function (response) {
            if (response == "course_added_in_progress") {
                return true;
            } else {
                return false;
            }
        }
    });
}

function AddRemoveProgress(content_id_get) {
    var content_id_ = content_id_get.value;

    var content_id_split = content_id_.split("_");
    var chapter_id = content_id_split[1];
    var content_id = content_id_split[0];
    var course_id = content_id_split[2];

    if (content_id != "") {
        if (content_id_get.checked == true) {
            $.ajax({
                url: "include/UserSubmitData.php",
                method: "POST",
                data: {
                    module: "userProgress_checkbox",
                    moduleMethod: "course_progress",
                    content_id: content_id,
                    chapter_id: chapter_id,
                    course_id: course_id,
                    add_delete: content_id_get.checked
                },
                success: function (response) {
                    if (response == "course_added_in_progress") {
                        return true;
                    } else {
                        return false;
                    }
                }
            });
        } else {
            $.ajax({
                url: "include/UserSubmitData.php",
                method: "POST",
                data: {
                    module: "userProgress_checkbox",
                    moduleMethod: "course_progress",
                    content_id: content_id,
                    chapter_id: chapter_id,
                    course_id: course_id,
                    add_delete: content_id_get.checked
                },
                success: function (response) {
                    if (response == "course_deleted_in_progress") {
                        return true;
                    } else {
                        return false;
                    }
                }
            });
        }
    }
}
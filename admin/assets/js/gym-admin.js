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


$(document).ready(function () {
    var content_i = $("#course_content_count").val();
    $("#addContentRow").click(function () {
        $('#course_content').append(
            '<div class="row" id="content-' + content_i + '">' +
            '<div div class= "col-md-6 form-group">' +
            '<label for="doc_title-' + content_i + '">Document Title</label>' +
            '<input type="text" class="form-control" name="doc_title-' + content_i + '" id="doc_title-' + content_i + '" placeholder="Document Title" value="" required>' +
            '</div>' +
            '<div class="col-md-6 form-group">' +
            '<label for="upload_doc-' + content_i + '">Upload Video & Files</label>' +
            '<input type="file" class="form-control" name="upload_doc-' + content_i + '" id="upload_doc-' + content_i + '" placeholder="Upload Video & Files" value="" required>' +
            '</div>' +
            '</div>');
        $('#course_content_count').val(content_i);
        content_i++;
    });

    $("#deleteContentRow").click(function () {
        if (content_i > 1) {
            $("#content-" + (content_i - 1)).remove();
            content_i--;
        }
    });
});

function is_trailer(content_checkbox) {
    var split_val = content_checkbox.split("_");
    var content_id = split_val[0];
    var chapter_id = split_val[1];

    var content_check = document.getElementById(content_checkbox);
    $.ajax({
        url: "include/AdminSubmitData.php",
        method: "POST",
        data: {
            module: "isTrailerAjax",
            moduleMethod: "course_content",
            content_id: content_id,
            chapter_id: chapter_id,
            content_check_val: content_check.checked
        },
        success: function (response) {
            $("#content_list").empty();
            $("#content_list").append(response);
        }
    });
}


function setCookie(cname, cvalue, exdays) {
    const d = new Date();
    d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
    let expires = "expires=" + d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function getCookie(cname) {
    let name = cname + "=";
    let ca = document.cookie.split(';');
    for (let i = 0; i < ca.length; i++) {
        let c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}
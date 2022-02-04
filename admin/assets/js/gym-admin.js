$(document).ready(function () {
    var content_i = 1;
    $("#addContentRow").click(function () {
        $('#course_content').append(
            '<div class="row" id="content~' + content_i + '">' +
            '<div div class= "col-md-6 form-group">' +
            '<label for="doc_title~' + content_i + '">Document Title</label>' +
            '<input type="text" class="form-control" name="doc_title~' + content_i + '" id="doc_title~' + content_i + '" placeholder="Document Title" value="" required>' +
            '</div>' +
            '<div class="col-md-6 form-group">' +
            '<label for="upload_doc~' + content_i + '">Upload Video & Files</label>' +
            '<input type="file" class="form-control" name="upload_doc~' + content_i + '" id="upload_doc~' + content_i + '" placeholder="Upload Video & Files" value="" required>' +
            '</div>' +
            '</div>');
        $('#course_content_count').val(content_i);
        content_i++;
    });

    $("#deleteContentRow").click(function () {
        alert('**');
        $("#content~0").remove();
    });
});
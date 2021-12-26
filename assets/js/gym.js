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

function addToCartFromWishlist() {
    alert('***');
    // $.ajax({
    //     url: "TPDashboard/TPCase/caseBlockOPRecord/" + casePk+ '/'+tablelen+ '/' + opPk ,
    //     success: function (response) {
    //         console.log(response);
    //         document.getElementById('ajaxAreaOfOpModel').innerHTML = response;
    //     }
    // });
}
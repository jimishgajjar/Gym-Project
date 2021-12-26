"use strict";
jQuery, jQuery(document).ready(function (o) {
    0 < o(".offset-side-bar-cart").length && o(".offset-side-bar-cart").on("click", function (e) {
        e.preventDefault(), e.stopPropagation(), o(".cart-group").addClass("isActive")
    }),
        0 < o(".offset-side-bar-wishlist").length && o(".offset-side-bar-wishlist").on("click", function (e) {
            e.preventDefault(), e.stopPropagation(), o(".whislist-group").addClass("isActive")
        }),
        0 < o(".offset-side-bar-profile").length && o(".offset-side-bar-profile").on("click", function (e) {
            e.preventDefault(), e.stopPropagation(), o(".profile-group").addClass("isActive")
        }),
        0 < o(".close-side-widget").length && o(".close-side-widget").on("click", function (e) {
            e.preventDefault(), o(".whislist-group").removeClass("isActive")
        }),
        0 < o(".close-side-widget").length && o(".close-side-widget").on("click", function (e) {
            e.preventDefault(), o(".cart-group").removeClass("isActive")
        }),
        0 < o(".close-side-widget").length && o(".close-side-widget").on("click", function (e) {
            e.preventDefault(), o(".profile-group").removeClass("isActive")
        }),
        o("body").on("click", function (e) {
            o(".profile-group").removeClass("isActive"), o(".cart-group").removeClass("isActive"), o(".whislist-group").removeClass("isActive")
        }),
        o(".xs-sidebar-widget").on("click", function (e) {
            e.stopPropagation()
        }),
        0 < o(".xs-modal-popup").length && o(".xs-modal-popup").magnificPopup({
            type: "inline",
            fixedContentPos: !1,
            fixedBgPos: !0,
            overflowY: "auto",
            closeBtnInside: !1,
            callbacks: {
                beforeOpen: function () {
                    this.st.mainClass = "my-mfp-slide-bottom xs-promo-popup"
                }
            }
        })
});
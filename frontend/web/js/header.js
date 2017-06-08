/*
Template Name: Color Admin - Responsive Admin Dashboard Template build with Twitter Bootstrap 3.3.7
Version: 2.1.0
Author: Sean Ngu
Website: http://www.seantheme.com/color-admin-v2.1/frontend/e-commerce/
*/
var handleHeaderFixedTop = function() {
        0 !== $('#header[data-fixed-top="true"]').length && $(window).on("scroll", function() {
            $("body").scrollTop() >= 40 ? ($("body").css("padding-top", "60px"), $("#header").addClass("header-fixed")) : ($("#header").removeClass("header-fixed"), $("body").css("padding-top", "0"))
        })
    },
    handlePageContainerShow = function() {
        $("#page-container").addClass("in")
    },
    handlePaceLoadingPlugins = function() {
        Pace.on("hide", function() {
            setTimeout(function() {
                $(".pace").addClass("hide")
            }, 500)
        })
    },
    handleTooltipActivation = function() {
        0 !== $("[data-toggle=tooltip]").length && $("[data-toggle=tooltip]").tooltip()
    },
    handleThemePanelExpand = function() {
        $('[data-click="theme-panel-expand"]').live("click", function() {
            var e = ".theme-panel",
                t = "active";
            $(e).hasClass(t) ? $(e).removeClass(t) : $(e).addClass(t)
        })
    },
    handleThemePageControl = function() {
        if ($.cookie && $.cookie("theme")) {
            0 !== $(".theme-list").length && ($(".theme-list [data-theme]").closest("li").removeClass("active"), $('.theme-list [data-theme="' + $.cookie("theme") + '"]').closest("li").addClass("active"));
            var e = "assets/css/theme/" + $.cookie("theme") + ".css";
            $("#theme").attr("href", e)
        }
        $(".theme-list [data-theme]").live("click", function() {
            var e = "assets/css/theme/" + $(this).attr("data-theme") + ".css";
            $("#theme").attr("href", e), $(".theme-list [data-theme]").not(this).closest("li").removeClass("active"), $(this).closest("li").addClass("active"), $.cookie("theme", $(this).attr("data-theme"))
        })
    },
    handlePaymentTypeSelection = function() {
        $('[data-click="set-payment"]').click(function(e) {
            e.preventDefault();
            var t = $(this).closest("li"),
                a = $(this).attr("data-value");
            $('[data-click="set-payment"]').closest("li").not(t).removeClass("active"), $('[data-id="payment-type"]').val(a), $(t).addClass("active")
        })
    },
    handleQtyControl = function() {
        $('[data-click="increase-qty"]').click(function(e) {
            e.preventDefault();
            var t = $(this).attr("data-target"),
                a = parseInt($(t).val()) + 1;
            $(t).val(a)
        }), $('[data-click="decrease-qty"]').click(function(e) {
            e.preventDefault();
            var t = $(this).attr("data-target"),
                a = parseInt($(t).val()) - 1;
            a = 0 > a ? 0 : a, $(t).val(a)
        })
    },
    handleProductImage = function() {
        $('[data-click="show-main-image"]').click(function(e) {
            e.preventDefault();
            var t = '[data-id="main-image"]',
                a = '<img src="' + $(this).attr("data-url") + '" />',
                i = $(this).closest("li");
            $(t).html(a), $(i).addClass("active"), $('[data-click="show-main-image"]').closest("li").not(i).removeClass("active")
        })
    },
    App = function() {
        "use strict";
        return {
            init: function() {
                handleHeaderFixedTop(), handlePageContainerShow(), handlePaceLoadingPlugins(), handleTooltipActivation(), handleThemePanelExpand(), handleThemePageControl(), handlePaymentTypeSelection(), handleQtyControl(), handleProductImage()
            }
        }
    }();
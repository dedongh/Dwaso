/*
 * Template Customizer
 * Copyright 2018 rokaux
 */
jQuery(document).ready(function (t) {
    "use strict";
    t(".customizer-toggle").on("click", function () {
        t(".customizer").toggleClass("open")
    }), t(".customizer-color-switch > a").on("click", function () {
        t(".customizer-color-switch > a").removeClass("active"), t(this).addClass("active"), t(".customizer-backdrop").addClass("active"), setTimeout(function () {
            t(".customizer-backdrop").removeClass("active")
        }, 1e3);
        var s = t(this).data("color"),
            e = t("#mainStyles").attr("href"),
            o = t(".site-logo:not(.light-logo) > img").attr("src"),
            i = e.split("http://themes.rokaux.com/"),
            a = o.split("http://themes.rokaux.com/"),
            n = t(i).get(-1),
            l = t(a).get(-1);
        switch (s) {
            case "a0cd32":
                n = "styles-a0cd32.min.html", l = "logo-a0cd32.html";
                break;
            case "e61923":
                n = "styles-e61923.min.html", l = "logo-e61923.html";
                break;
            case "ff9900":
                n = "styles-ff9900.min.html", l = "logo-ff9900.html";
                break;
            default:
                n = "styles.min.html", l = "logo.png"
        }
        i.pop(), a.pop(), e = t.map(i, function (t, s) {
            return t
        }).join("http://themes.rokaux.com/") + "/" + n, o = t.map(a, function (t, s) {
            return t
        }).join("http://themes.rokaux.com/") + "/" + l, t("#mainStyles").attr("href", e), t(".site-logo > img").attr("src", o)
    }), t("#header-option").on("change", function () {
        var s = t(this).find("option:selected").val(),
            e = t(".site-header"),
            o = t(".topbar").outerHeight(),
            i = e.outerHeight(),
            a = t(".navbar .toolbar, .navbar .categories-btn"),
            n = t("body");
        "static" === s ? (e.removeClass("navbar-stuck"), a.css("display", "none"), t(window).on("scroll", function () {
            t(this).scrollTop() > o && (e.removeClass("navbar-stuck"), a.css("display", "none"), n.css("padding-top", 0))
        })) : (e.addClass("navbar-stuck"), a.css({
            display: "block",
            animation: "none"
        }), t(window).on("scroll", function () {
            t(this).scrollTop() > o ? (e.addClass("navbar-stuck"), a.css({
                display: "block",
                animation: "none"
            }), n.css("padding-top", i)) : (e.removeClass("navbar-stuck"), a.css("display", "none"), n.css("padding-top", 0))
        }))
    }), t("#footer-option").on("change", function () {
        var s = t(this).find("option:selected").val(),
            e = t(".site-footer"),
            o = e.find(".widget"),
            i = o.find(".market-button"),
            a = o.find("p"),
            n = o.find(".list-unstyled"),
            l = o.find("p > a"),
            r = o.find(".social-button"),
            c = e.find(".input-group"),
            d = e.find("hr"),
            g = t(".site-footer").css("background-image").replace("url(", "").replace(")", "").replace(/\"/gi, ""),
            p = g.split("/"),
            u = t(p).get(-1),
            f = t(".site-footer img").attr("src"),
            m = f.split("http://themes.rokaux.com/"),
            h = t(m).get(-1);
        t("body");
        "light" === s ? (o.removeClass("widget-light-skin"), i.removeClass("mb-light-skin"), a.removeClass("text-white"), n.removeClass("text-white"), l.removeClass("navi-link-light"), l.addClass("navi-link"), r.removeClass("sb-light-skin"), c.removeClass("input-light"), d.removeClass("hr-light"), u = "footer-bg-alt.html", h = "credit-cards-footer.html", e.addClass("footer-light")) : (o.addClass("widget-light-skin"), i.addClass("mb-light-skin"), a.addClass("text-white"), n.addClass("text-white"), l.addClass("navi-link-light"), r.addClass("sb-light-skin"), c.addClass("input-light"), d.addClass("hr-light"), u = "footer-bg.html", h = "credit-cards-footer.html", e.removeClass("footer-light")), p.pop(), m.pop(), g = t.map(p, function (t, s) {
            return t
        }).join("http://themes.rokaux.com/") + "/" + u, t(".site-footer").attr("style", "background-image: url(" + g + ");"), f = t.map(m, function (t, s) {
            return t
        }).join("http://themes.rokaux.com/") + "/" + h, t(".site-footer img").attr("src", f)
    })
});

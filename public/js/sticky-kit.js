/*
 Sticky-kit v1.1.3 | MIT | Leaf Corcoran 2015 | http://leafo.net
*/
(function() {
    var c, f;
    c = window.jQuery;
    f = c(window);
    c.fn.stick_in_parent = function(b) {
        var A, w, J, n, B, K, p, q, L, k, E, t;
        null == b && (b = {});
        t = b.sticky_class;
        B = b.inner_scrolling;
        E = b.recalc_every;
        k = b.parent;
        q = b.offset_top;
        p = b.spacer;
        w = b.bottoming;
        null == q && (q = 0);
        null == k && (k = void 0);
        null == B && (B = !0);
        null == t && (t = "is_stuck");
        A = c(document);
        null == w && (w = !0);
        L = function(a) {
            var b;
            return window.getComputedStyle ? (a = window.getComputedStyle(a[0]), b = parseFloat(a.getPropertyValue("width")) + parseFloat(a.getPropertyValue("margin-left")) +
                parseFloat(a.getPropertyValue("margin-right")), "border-box" !== a.getPropertyValue("box-sizing") && (b += parseFloat(a.getPropertyValue("border-left-width")) + parseFloat(a.getPropertyValue("border-right-width")) + parseFloat(a.getPropertyValue("padding-left")) + parseFloat(a.getPropertyValue("padding-right"))), b) : a.outerWidth(!0)
        };
        J = function(a, b, n, C, F, u, r, G) {
            var v, H, m, D, I, d, g, x, y, z, h, l;
            if (!a.data("sticky_kit")) {
                a.data("sticky_kit", !0);
                I = A.height();
                g = a.parent();
                null != k && (g = g.closest(k));
                if (!g.length) throw "failed to find stick parent";
                v = m = !1;
                (h = null != p ? p && a.closest(p) : c("<div />")) && h.css("position", a.css("position"));
                x = function() {
                    var d, f, e;
                    if (!G && (I = A.height(), d = parseInt(g.css("border-top-width"), 10), f = parseInt(g.css("padding-top"), 10), b = parseInt(g.css("padding-bottom"), 10), n = g.offset().top + d + f, C = g.height(), m && (v = m = !1, null == p && (a.insertAfter(h), h.detach()), a.css({ position: "", top: "", width: "", bottom: "" }).removeClass(t), e = !0), F = a.offset().top - (parseInt(a.css("margin-top"), 10) || 0) - q, u = a.outerHeight(!0), r = a.css("float"), h && h.css({
                            width: L(a),
                            height: u,
                            display: a.css("display"),
                            "vertical-align": a.css("vertical-align"),
                            "float": r
                        }), e)) return l()
                };
                x();
                if (u !== C) return D = void 0, d = q, z = E, l = function() {
                        var c, l, e, k;
                        if (!G && (e = !1, null != z && (--z, 0 >= z && (z = E, x(), e = !0)), e || A.height() === I || x(), e = f.scrollTop(), null != D && (l = e - D), D = e, m ? (w && (k = e + u + d > C + n, v && !k && (v = !1, a.css({ position: "fixed", bottom: "", top: d }).trigger("sticky_kit:unbottom"))), e < F && (m = !1, d = q, null == p && ("left" !== r && "right" !== r || a.insertAfter(h), h.detach()), c = { position: "", width: "", top: "" }, a.css(c).removeClass(t).trigger("sticky_kit:unstick")),
                                B && (c = f.height(), u + q > c && !v && (d -= l, d = Math.max(c - u, d), d = Math.min(q, d), m && a.css({ top: d + "px" })))) : e > F && (m = !0, c = { position: "fixed", top: d }, c.width = "border-box" === a.css("box-sizing") ? a.outerWidth() + "px" : a.width() + "px", a.css(c).addClass(t), null == p && (a.after(h), "left" !== r && "right" !== r || h.append(a)), a.trigger("sticky_kit:stick")), m && w && (null == k && (k = e + u + d > C + n), !v && k))) return v = !0, "static" === g.css("position") && g.css({ position: "relative" }), a.css({ position: "absolute", bottom: b, top: "auto" }).trigger("sticky_kit:bottom")
                    },
                    y = function() { x(); return l() }, H = function() {
                        G = !0;
                        f.off("touchmove", l);
                        f.off("scroll", l);
                        f.off("resize", y);
                        c(document.body).off("sticky_kit:recalc", y);
                        a.off("sticky_kit:detach", H);
                        a.removeData("sticky_kit");
                        a.css({ position: "", bottom: "", top: "", width: "" });
                        g.position("position", "");
                        if (m) return null == p && ("left" !== r && "right" !== r || a.insertAfter(h), h.remove()), a.removeClass(t)
                    }, f.on("touchmove", l), f.on("scroll", l), f.on("resize", y), c(document.body).on("sticky_kit:recalc", y), a.on("sticky_kit:detach", H), setTimeout(l,
                        0)
            }
        };
        n = 0;
        for (K = this.length; n < K; n++) b = this[n], J(c(b));
        return this
    }
}).call(this);

//ccher
$(function() {
    "use strict";
    $(function() { $(".preloader").fadeOut() }), jQuery(document).on("click", ".mega-dropdown", function(i) { i.stopPropagation() });
    var i = function() {
        (window.innerWidth > 0 ? window.innerWidth : this.screen.width) < 1170 ? ($("body").addClass("mini-sidebar"), $(".navbar-brand span").hide(), $(".scroll-sidebar, .slimScrollDiv").css("overflow-x", "visible").parent().css("overflow", "visible"), $(".sidebartoggler i").addClass("ti-menu")) : ($("body").removeClass("mini-sidebar"), $(".navbar-brand span").show());
        var i = (window.innerHeight > 0 ? window.innerHeight : this.screen.height) - 1;
        (i -= 70) < 1 && (i = 1), i > 70 && $(".page-wrapper").css("min-height", i + "px")
    };
    $(window).ready(i), $(window).on("resize", i), $(".sidebartoggler").on("click", function() { $("body").hasClass("mini-sidebar") ? ($("body").trigger("resize"), $(".scroll-sidebar, .slimScrollDiv").css("overflow", "hidden").parent().css("overflow", "visible"), $("body").removeClass("mini-sidebar"), $(".navbar-brand span").show()) : ($("body").trigger("resize"), $(".scroll-sidebar, .slimScrollDiv").css("overflow-x", "visible").parent().css("overflow", "visible"), $("body").addClass("mini-sidebar"), $(".navbar-brand span").hide()) }), $(".fix-header .topbar").stick_in_parent({}), $(".nav-toggler").click(function() { $("body").toggleClass("show-sidebar"), $(".nav-toggler i").toggleClass("ti-menu"), $(".nav-toggler i").addClass("ti-close") }), $(".sidebartoggler").on("click", function() {}), $(".search-box a, .search-box .app-search .srh-btn").on("click", function() { $(".app-search").toggle(200) }), $(".right-side-toggle").click(function() { $(".right-sidebar").slideDown(50), $(".right-sidebar").toggleClass("shw-rside") }), $(".floating-labels .form-control").on("focus blur", function(i) { $(this).parents(".form-group").toggleClass("focused", "focus" === i.type || this.value.length > 0) }).trigger("blur"), $(function() { for (var i = window.location, e = $("ul#sidebarnav a").filter(function() { return this.href == i }).addClass("active").parent().addClass("active"); e.is("li");) e = e.parent().addClass("in").parent().addClass("active") }), $(function() { $('[data-toggle="tooltip"]').tooltip() }), $(function() { $('[data-toggle="popover"]').popover() }), $(function() { $("#sidebarnav").metisMenu() }), $(".scroll-sidebar").slimScroll({ position: "left", size: "5px", height: "100%", color: "#dcdcdc" }), $(".message-center").slimScroll({ position: "right", size: "5px", color: "#dcdcdc" }), $(".aboutscroll").slimScroll({ position: "right", size: "5px", height: "80", color: "#dcdcdc" }), $(".message-scroll").slimScroll({ position: "right", size: "5px", height: "570", color: "#dcdcdc" }), $(".chat-box").slimScroll({ position: "right", size: "5px", height: "470", color: "#dcdcdc" }), $(".slimscrollright").slimScroll({ height: "100%", position: "right", size: "5px", color: "#dcdcdc" }), $("body").trigger("resize"), $(".list-task li label").click(function() { $(this).toggleClass("task-done") }), $("#to-recover").on("click", function() { $("#loginform").slideUp(), $("#recoverform").fadeIn() }), $('a[data-action="collapse"]').on("click", function(i) { i.preventDefault(), $(this).closest(".card").find('[data-action="collapse"] i').toggleClass("ti-minus ti-plus"), $(this).closest(".card").children(".card-body").collapse("toggle") }), $('a[data-action="expand"]').on("click", function(i) { i.preventDefault(), $(this).closest(".card").find('[data-action="expand"] i').toggleClass("mdi-arrow-expand mdi-arrow-compress"), $(this).closest(".card").toggleClass("card-fullscreen") }), $('a[data-action="close"]').on("click", function() { $(this).closest(".card").removeClass().slideUp("fast") }), $("#monthchart").sparkline([5, 6, 2, 9, 4, 7, 10, 12], { type: "bar", height: "35", barWidth: "4", resize: !0, barSpacing: "4", barColor: "#1e88e5" }), $("#lastmonthchart").sparkline([5, 6, 2, 9, 4, 7, 10, 12], { type: "bar", height: "35", barWidth: "4", resize: !0, barSpacing: "4", barColor: "#7460ee" }), $(".custom-file-input").on("change", function() {
        var i = $(this).val();
        $(this).next(".custom-file-label").html(i)
    })
});
var lsx = Object.create(null);
!(function (l, e, o) {
    "use strict";
    var s = l(o),
        t = l(e),
        n = (e.innerHeight || o.documentElement.clientHeight || o.body.clientHeight, e.innerWidth || o.documentElement.clientWidth || o.body.clientWidth);
    (lsx.add_class_browser_to_html = function () {
        var e, o;
        "undefined" != typeof platform && ((e = "chrome"), null !== platform.name && (e = platform.name.toLowerCase()), (o = "69"), null !== platform.version && (o = platform.version.toLowerCase()), l("html").addClass(e).addClass(o));
    }),
        (lsx.add_class_sidebar_to_body = function () {
            0 < l("#secondary").length && l("body").addClass("has-sidebar");
        }),
        (lsx.add_class_bootstrap_to_table = function () {
            var e = l("table#wp-calendar");
            0 < e.length && e.addClass("table");
        }),
        (lsx.navbar_toggle_handler = function () {
            l(".navbar-toggle")
                .parent()
                .on("click", function () {
                    l(this).toggleClass("open"), l("#masthead").toggleClass("masthead-open");
                });
        }),
        (lsx.fix_bootstrap_menus_dropdown = function () {
            l(".navbar-nav .dropdown, #top-menu .dropdown").on("show.bs.dropdown", function () {
                n < 1200 && (l(this).siblings(".open").removeClass("open").find("a.dropdown-toggle").attr("data-toggle", "dropdown"), l(this).find("a.dropdown-toggle").removeAttr("data-toggle"));
            }),
                1199 < n &&
                    l(".navbar-nav li.dropdown a, #top-menu li.dropdown a").each(function () {
                        l(this).removeClass("dropdown-toggle"), l(this).removeAttr("data-toggle");
                    }),
                t.resize(function () {
                    1199 < n
                        ? l(".navbar-nav li.dropdown a, #top-menu li.dropdown a").each(function () {
                              l(this).removeClass("dropdown-toggle"), l(this).removeAttr("data-toggle");
                          })
                        : l(".navbar-nav li.dropdown a, #top-menu li.dropdown a").each(function () {
                              l(this).addClass("dropdown-toggle"), l(this).attr("data-toggle", "dropdown");
                          });
                });
        }),
        (lsx.replace_wc_classnames = function () {
            l(".wc-tabs").removeClass("wc-tabs").addClass("nav-tabs"), l(".tabs").removeClass("tabs").addClass("nav wc-tabs");
        }),
        (lsx.fix_bootstrap_menus_dropdown_click = function () {
            n < 1200 &&
                (l(".navbar-nav .dropdown .dropdown > a, #top-menu .dropdown .dropdown > a").on("click", function (e) {
                    l(this).parent().hasClass("open") || (l(this).parent().addClass("open"), l(this).next(".dropdown-menu").dropdown("toggle"), e.stopPropagation(), e.preventDefault());
                }),
                l(".navbar-nav .dropdown .dropdown .dropdown-menu a, #top-menu .dropdown .dropdown > a").on("click", function (e) {
                    o.location.href = this.href;
                }));
        }),
        (lsx.fix_lazyload_envira_gallery = function () {
            0 < l(".lazyload, .lazyloaded").length &&
                "object" == typeof envira_isotopes &&
                t.scroll(function () {
                    l(".envira-gallery-wrap").each(function () {
                        var e = (e = l(this).attr("id")).replace("envira-gallery-wrap-", "");
                        "object" == typeof envira_isotopes[e] && envira_isotopes[e].enviratope("layout");
                    });
                });
        }),
        (lsx.set_main_menu_as_fixed = function () {
            var o = !1;
            1199 < n &&
                l("body").hasClass("top-menu-fixed") &&
                s.on("scroll", function (e) {
                    !1 === o &&
                        (l(lsx_params.stickyMenuSelector).scrollToFixed({
                            marginTop: function () {
                                var e = l("#wpadminbar");
                                return 0 < e.length ? e.outerHeight() : 0;
                            },
                            minWidth: 768,
                            preFixed: function () {
                                l(this).addClass("scrolled");
                            },
                            preUnfixed: function () {
                                l(this).removeClass("scrolled");
                            },
                        }),
                        (o = !0));
                });
        }),
        (lsx.set_cover_template_header_height = function () {
            var e;
            (l("body").hasClass("page-template-template-cover") || l("body").hasClass("post-template-template-cover")) && ((e = l("#masthead").outerHeight()), l("#masthead").css("margin-bottom", -Math.abs(e)));
        }),
        (lsx.set_search_form_effect_mobile = function () {
            s.on("click", "header.navbar #searchform button.search-submit", function (e) {
                n < 1200 && (e.preventDefault(), (e = l(this).closest("form")).hasClass("hover") ? e.submit() : (e.addClass("hover"), e.find(".search-field").focus()));
            }),
                s.on("blur", "header.navbar #searchform .search-field", function (e) {
                    n < 1200 && l(this).closest("form").removeClass("hover");
                });
        }),
        (lsx.search_form_prevent_empty_submissions = function () {
            s.on("submit", "#searchform", function (e) {
                "" === l(this).find('input[name="s"]').val() && e.preventDefault();
            }),
                s.on("blur", "header.navbar #searchform .search-field", function (e) {
                    n < 1200 && l(this).closest("form").removeClass("hover");
                });
        }),
        (lsx.build_slider_lightbox = function () {
            l("body:not(.single-tour-operator) .gallery").slickLightbox({
                caption: function (e, o) {
                    return l(e).find("img").attr("alt");
                },
            });
        }),
        (lsx.init_wc_slider = function () {
            l(".lsx-woocommerce-slider").each(function (e, o) {
                var s = l(this),
                    t = 4,
                    n = 4,
                    a = 3,
                    i = 3;
                0 < s.find(".lsx-woocommerce-review-slot").length && (i = a = n = t = 2),
                    0 < s.closest("#secondary").length && (i = a = n = t = 1),
                    s.on("init", function (e, o) {
                        o.options.arrows && o.slideCount > o.options.slidesToShow && s.addClass("slick-has-arrows");
                    }),
                    s.on("setPosition", function (e, o) {
                        o.options.arrows ? o.slideCount > o.options.slidesToShow && s.addClass("slick-has-arrows") : s.removeClass("slick-has-arrows");
                    }),
                    s.slick({
                        draggable: !1,
                        infinite: !0,
                        swipe: !1,
                        cssEase: "ease-out",
                        dots: !0,
                        slidesToShow: t,
                        slidesToScroll: n,
                        responsive: [
                            { breakpoint: 992, settings: { slidesToShow: a, slidesToScroll: i, draggable: !0, arrows: !1, swipe: !0 } },
                            { breakpoint: 768, settings: { slidesToShow: 1, slidesToScroll: 1, draggable: !0, arrows: !1, swipe: !0 } },
                        ],
                    });
            }),
                0 < l('a[href="#tab-bundled_products"]').length &&
                    s.on("click", 'a[href="#tab-bundled_products"]', function (e) {
                        l("#tab-bundled_products .lsx-woocommerce-slider").slick("setPosition");
                    });
        }),
        (lsx.remove_gallery_img_width_height = function () {
            l(".gallery-size-full img").each(function () {
                var e = l(this);
                e.removeAttr("height"), e.removeAttr("width");
            });
        }),
        (lsx.do_scroll = function (e) {
            (e = e.href.replace(/^[^#]*(#.+$)/gi, "$1")), (e = l(e)), (e = parseInt(e.offset().top));
            l("html, body").animate({ scrollTop: e + -100 }, 800);
        }),
        (lsx.fix_wc_elements = function (e) {
            l(".woocommerce-MyAccount-content .api-manager-changelog, .woocommerce-MyAccount-content .api-manager-download").each(function () {
                var e = l(this);
                e.children("br:first-child").remove(), e.children("hr:first-child").remove(), e.children("hr:last-child").remove(), e.children("br:last-child").remove();
            }),
                l(".woocommerce-form__label-for-checkbox.checkbox").removeClass("checkbox"),
                l(o.body).on("updated_checkout", function () {
                    l(".woocommerce-form__label-for-checkbox.checkbox").removeClass("checkbox");
                });
        }),
        (lsx.fix_caldera_form_modal_title = function () {
            l("[data-remodal-id]").each(function () {
                var e = l(this),
                    o = l('[data-remodal-target="' + e.attr("id") + '"]').text();
                e.find('[role="field"]')
                    .first()
                    .before("<div><h4>" + o + "</h4></div>");
            });
        }),
        (lsx.wc_footer_bar_toggle_handler = function () {
            l(".lsx-wc-footer-bar-link-toogle").on("click", function (e) {
                e.preventDefault(), l(".lsx-wc-footer-bar-form").slideToggle(), l(".lsx-wc-footer-bar").toggleClass("lsx-wc-footer-bar-search-on");
            });
        }),
        (lsx.wc_fix_messages_visual = function () {
            l(
                ".woocommerce-message,.woocommerce-info:not(.wc_points_redeem_earn_points, .wc_points_rewards_earn_points),.woocommerce-error,.woocommerce-noreviews,.woocommerce_message,.woocommerce_info:not(.wc_points_redeem_earn_points, .wc_points_rewards_earn_points),.woocommerce_error,.woocommerce_noreviews,p.no-comments,.stock,.woocommerce-password-strength"
            ).each(function () {
                var e = l(this);
                0 !== e.find(".button").length && (e.wrapInner('<div class="lsx-woocommerce-message-text"></div>'), e.addClass("lsx-woocommerce-message-wrap"), e.find(".button").appendTo(e));
            });
        }),
        (lsx.wc_fix_subscribe_to_replies_checkbox = function () {
            l('input[name="subscribe_to_replies"]').removeClass("form-control");
        }),
        (lsx.wc_add_quick_view_close_button = function () {
            l("body").on("quick-view-displayed", function (e) {
                0 === l(".pp_content_container").children(".close").length && l(".pp_content_container").prepend('<button type="button" class="close">&times;</button>');
            }),
                s.on("click", ".pp_content_container .close", function (e) {
                    l.prettyPhoto.close();
                });
        }),
        (lsx.wc_fix_subscriptions_empty_message = function () {
            "" === l(".first-payment-date").text() && l(".first-payment-date").remove();
        }),
        (lsx.sensei_courses_empty_thumbnail = function () {
            l(".course-thumbnail").each(function () {
                l.trim(l(this).html()).length || l(this).addClass("course-thumbnail-empty");
            });
        }),
        (lsx.sensei_course_participants_widget_more = function () {
            l("body").hasClass("sensei") &&
                (l(".sensei-course-participant").each(function () {
                    l(this).hasClass("show") && (l(this).addClass("sensei-show"), l(this).removeClass("show")), l(this).hasClass("hide") && (l(this).addClass("sensei-hide"), l(this).removeClass("hide"));
                }),
                l(".sensei-view-all-participants a").on("click", function () {
                    l(this).hasClass("clicked") ? l(this).removeClass("clicked") : l(this).addClass("clicked"),
                        l(".sensei-course-participant.sensei-hide").each(function () {
                            l(this).hasClass("sensei-clicked") ? l(this).removeClass("sensei-clicked") : l(this).addClass("sensei-clicked");
                        });
                }));
        }),
        (lsx.detect_has_link_block = function () {
            l(".has-link-color").each(function () {
                l(this)
                    .find("a")
                    .each(function () {
                        l(this).addClass("has-link-anchor");
                    });
            });
        }),
        (lsx.woocommerce_filters_mobile = function () {
            l("body").hasClass("woocommerce-js") &&
                l(".lsx-wc-filter-toggle").on("click", function () {
                    l(this).toggleClass("lsx-wc-filter-toggle-open"),
                        l(this).hasClass("lsx-wc-filter-toggle-open")
                            ? (l('.lsx-wc-filter-block div[class^="wp-block-woocommerce-"][class$="-filter"]').each(function () {
                                  l(this).attr("id", "lsx-wc-filter-child-open");
                              }),
                              l(".lsx-wc-filter-block .wp-block-woocommerce-product-search").each(function () {
                                  l(this).attr("id", "lsx-wc-filter-child-open");
                              }))
                            : (l('.lsx-wc-filter-block div[class^="wp-block-woocommerce-"][class$="-filter"]').each(function () {
                                  l(this).attr("id", "lsx-wc-filter-child-close");
                              }),
                              l(".lsx-wc-filter-block .wp-block-woocommerce-product-search").each(function () {
                                  l(this).attr("id", "lsx-wc-filter-child-close");
                              }));
                });
        }),
        t.resize(function () {
            e.innerHeight || o.documentElement.clientHeight || o.body.clientHeight, (n = e.innerWidth || o.documentElement.clientWidth || o.body.clientWidth);
        }),
        s.ready(function () {
            lsx.navbar_toggle_handler(),
                lsx.add_class_browser_to_html(),
                lsx.add_class_sidebar_to_body(),
                lsx.add_class_bootstrap_to_table(),
                lsx.set_main_menu_as_fixed(),
                lsx.search_form_prevent_empty_submissions(),
                lsx.remove_gallery_img_width_height(),
                lsx.replace_wc_classnames(),
                lsx.init_wc_slider(),
                lsx.fix_wc_elements(),
                lsx.fix_caldera_form_modal_title(),
                lsx.wc_footer_bar_toggle_handler(),
                lsx.wc_fix_messages_visual(),
                lsx.wc_fix_subscribe_to_replies_checkbox(),
                lsx.wc_add_quick_view_close_button(),
                lsx.wc_fix_subscriptions_empty_message(),
                lsx.sensei_courses_empty_thumbnail(),
                lsx.sensei_course_participants_widget_more(),
                lsx.woocommerce_filters_mobile(),
                lsx.detect_has_link_block();
        }),
        t.on('load', function() {
            lsx.fix_bootstrap_menus_dropdown(),
                lsx.fix_bootstrap_menus_dropdown_click(),
                lsx.fix_lazyload_envira_gallery(),
                lsx.set_search_form_effect_mobile(),
                lsx.build_slider_lightbox(),
                lsx.set_cover_template_header_height(),
                l("body.preloader-content-enable").addClass("html-loaded");
        });
})(jQuery, window, document);

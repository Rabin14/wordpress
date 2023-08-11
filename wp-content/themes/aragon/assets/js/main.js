jQuery(document).ready(function ($) {
    "use strict";
    window.requestAnimationFrame = (function () {
        return window.requestAnimationFrame ||
            window.webkitRequestAnimationFrame ||
            window.mozRequestAnimationFrame ||
            window.oRequestAnimationFrame ||
            window.msRequestAnimationFrame ||
            function (callback) {
                return window.setTimeout(callback, 1000 / 60);
            };
    })();

    const COMMON = {
        win: window,
        doc: document,
        body: $('body'),
        primary_color: '#3d67f4',
        hero_header_height: $('.hero-header').innerHeight()
    };

    const VIEWPORT = {
        w: COMMON.win.innerWidth,
        h: COMMON.win.innerHeight
    };
    let mobile_point = 992;

    class POST_TYPE {
        constructor() {
            this.comment_form = $('#commentform');
        }

        _ajax_comments() {
            this.comment_form.on('submit', function (e) {
                e.preventDefault();
                let btnLoad = aragonComments.loading + '<i class="fa fa-spinner fa-pulse loadingform-spinner fa-fw"></i>';
                let btnSend = aragonComments.send;
                if (!$('#submit').hasClass('loadingform') && !$("#author").hasClass('error') && !$("#email").hasClass('error') && !$("#comment").hasClass('error')) {
                    $.ajax({
                        type: 'POST',
                        url: aragonComments.ajax_url,
                        data: $(this).serialize() + '&action=aragon_comments' + '&nonce_code=' + aragonComments.nonce + '',
                        beforeSend: function (xhr) {
                            $('#commentform button[type="submit"]').addClass('loadingform').html(btnLoad);

                        },
                        error: function (request, status, error) {
                            if (status == 500) {
                                alert('Error');
                            } else if (status == 'timeout') {
                                alert('Error: Server does not respond, try again.');
                            } else {
                                let errormsg = request.responseText;
                            }
                        },
                        success: function (newComment) {
                            if ($('.comment-list').length > 0) {
                                if ($('#respond').parent().hasClass('comment')) {
                                    if ($('#respond').parent().children('.children').length) {
                                        if (/<div/.test(newComment)) {
                                            $(newComment).appendTo($('#respond').parent().children('.children')).hide().fadeIn(300);
                                        }
                                        else {
                                            let error = '<p class="comment-item wp-error">' + newComment + '</p>'
                                            $(error).appendTo($('#respond').parent().children('.children')).hide().fadeIn(300);
                                        }
                                    } else {
                                        newComment = '<ul class="children">' + newComment + '</ul>';
                                        $(newComment).appendTo($('#respond').parent()).hide().fadeIn(300);
                                    }
                                    $("#cancel-comment-reply-link").trigger("click");
                                } else {
                                    if (/<div/.test(newComment)) {
                                        $(newComment).appendTo('.comment-list').hide().fadeIn(250);
                                    }
                                    else {
                                        let error = '<p class="comment-item wp-error">' + newComment + '</p>'
                                        $(error).appendTo('.comment-list').hide().fadeIn(250);
                                    }
                                }
                            } else {
                                newComment = '<ol class="comment-list">' + newComment + '</ol>';
                                $('#respond').before($(newComment));
                            }
                            $('#comment').val('');
                            // Comments Counter ++
                            let Counter = $(".comments-counter");
                            if (Counter.length) {
                                let commentsCount = Number(Counter.text());
                                Counter.text(++commentsCount + " ");
                            }
                        },
                        complete: function () {
                            $('#commentform button[type="submit"]').removeClass('loadingform').html(btnSend);
                        }
                    });
                }
                return false;
            });

            function comments_resize() {
                let comment_wrap = $('.default-content .comment-wrap ');
                let comment_body = $('.default-content .comment-body');
                let comment_avatar = $('.default-content .comment-avatar');
                let width_avatar = $(comment_avatar).outerWidth(true);
                let width_wrap = $(comment_wrap).outerWidth(true);
                let width = width_wrap - width_avatar;
                $(comment_body).css({
                    'width': width
                })
            }

            $(COMMON.win).on('resize', function () {
                comments_resize();
            });
            comments_resize();
        }

        _comments() {
            $(COMMON.doc).on('click', '.aragon-likes-button', function () {
                let button = $(this);
                let post_id = button.attr('data-post-id');
                let security = button.attr('data-nonce');
                let iscomment = button.attr('data-iscomment');
                let allbuttons;
                if (iscomment === '1') {
                    allbuttons = $('.aragon-likes-comment-button-' + post_id);
                } else {
                    allbuttons = $('.aragon-likes-button-' + post_id);
                }
                if (post_id !== '') {
                    $.ajax({
                        type: 'POST',
                        url: aragonComments.ajax_url,
                        data: {
                            action: 'aragon_like',
                            post_id: post_id,
                            nonce: security,
                            is_comment: iscomment,
                        },
                        beforeSend: function () {
                        },
                        success: function (response) {
                            let icon = response.icon;
                            let count = response.count;
                            allbuttons.html(icon + count);
                            if (response.status === 'unliked') {
                                allbuttons.removeClass('liked');
                            } else {
                                allbuttons.addClass('liked');
                            }
                        }
                    });

                }
                return false;
            });
        }

        init() {
            this._comments();
            this._ajax_comments();
        }
    }

    class FUNC {
        constructor() {
            this.hover3d = $('.hover3d-wrapper');
            this.hero_header = $('.hero-header-kc');
            this.angle_down = this.hero_header.find('.arrow-down');
            this.grid_default = $('.default-grid');
            this.grid_masonry = $('.masonry-grid');
            this.video_post_inner = $('.video-post-inner');
            this.video_post_format = this.video_post_inner.find(".video-post-format--video");
            this.video_post_format_toggle = this.video_post_inner.parent().find('.video-post-format--toggle');
            this.wrapper = $('.main-wrapper');
            this.content = $('.main-content');
            this.footer_parallax_wrapper = $('.footer-parallax');
            this.footer_spacing = $('.footer-spacing');
            this.tabs = $('.tab');
            this.loader = $('.loader');
            this.sticky_content = $('.sticky-sidebar , .sticky-content ');
            this.default_content = $('.default-content');
            this.info_part_static = $('.info-part-static');
            this.swiper = {
                clients: '.swiper-clients',
                steps: '.swiper-steps-slider',
                hero: '.swiper-hero',
                team: '.swiper-team',
                testimonials: '.swiper-testimonials',
                post: '.swiper-post'
            }
        }

        _hover_3dtransform() {
            if (VIEWPORT.w >= mobile_point) {
                if (this.hover3d.length) {
                    $(this.hover3d).hover3d({
                        selector: ".hover3d-child",
                        perspective: 1000,
                        sensitivity: 100,
                        invert: true
                    });
                }
            }
        }

        _swiper_init() {
            let swiper_clients = new Swiper(this.swiper.clients, {
                slidesPerView: 4,
                loop: true,
                grabCursor: true,
                autoplay: {
                    delay: 2000,
                },
                breakpoints: {
                    1199: {
                        slidesPerView: 3,
                    },
                    767: {
                        slidesPerView: 2,
                    },
                    575: {
                        slidesPerView: 1,
                    }
                }
            });
            let swiper_steps = new Swiper(this.swiper.steps, {
                loop: true,
                slidesPerView: 3,
                grabCursor: true,
                spaceBetween: 30,
                breakpoints: {
                    1199: {
                        slidesPerView: 3,
                    },
                    1024: {
                        slidesPerView: 2,
                    },
                    575: {
                        slidesPerView: 1,
                    }
                },
                navigation: {
                    nextEl: '.swiper-button-next-steps-slider',
                    prevEl: '.swiper-button-prev-steps-slider',
                },
            });
            let swiper_post = new Swiper(this.swiper.post, {
                loop: false,
                speed: 600,
                grabCursor: true,
                navigation: {
                    nextEl: '.swiper-button-next-post',
                    prevEl: '.swiper-button-prev-post',
                },
                scrollbar: {
                    el: '.swiper-scrollbar-post',
                    draggable: true,
                },
            });
            let swiper_hero = new Swiper(this.swiper.hero, {
                loop: false,
                speed: 600,
                pagination: {
                    el: '.swiper-pagination-bullets-hero',
                    type: 'bullets',
                    clickable: true,
                },
                navigation: {
                    nextEl: '.swiper-button-next-hero',
                    prevEl: '.swiper-button-prev-hero',
                },
                scrollbar: {
                    el: '.swiper-scrollbar-hero',
                    draggable: true,
                },
            });
            let swiper_team = new Swiper(this.swiper.team, {
                loop: true,
                slidesPerView: 4,
                grabCursor: true,
                spaceBetween: 0,
                speed: 600,
                breakpoints: {
                    1440: {
                        slidesPerView: 4,
                    },
                    1199: {
                        slidesPerView: 3,
                    },
                    1024: {
                        slidesPerView: 2,
                    },
                    575: {
                        slidesPerView: 1,
                    }
                },
                scrollbar: {
                    el: '.swiper-scrollbar-team',
                    draggable: true,
                },
            });
            let swiper_testimonials = new Swiper(this.swiper.testimonials, {
                loop: true,
                slidesPerView: 4,
                grabCursor: true,
                spaceBetween: 30,
                speed: 600,
                breakpoints: {
                    1440: {
                        slidesPerView: 4,
                    },
                    1199: {
                        slidesPerView: 3,
                    },
                    1024: {
                        slidesPerView: 2,
                    },
                    575: {
                        slidesPerView: 1,
                    }
                },
                pagination: {
                    el: '.swiper-pagination-testimonials',
                    type: 'bullets',
                },
            });
        }

        _scroll_down() {
            $(this.angle_down).on("click", () => {
                let top = this.hero_header.height();
                $('body,html').animate({scrollTop: top}, 1500);
            });
        }

        _sticky_content() {
            if (this.sticky_content.length) {
                this.sticky_content.theiaStickySidebar({
                    additionalMarginTop: 120,
                    additionalMarginBottom: 40
                });
            }
        }

        _tabs_init() {
            $(this.tabs).each(function () {
                let tab_content = $(this).find('.tab-content .tabs-item');
                let tab_header = $(this).find('.tabs-header');
                for (let i = 0; i < tab_content.length; i++) {
                    let title = $(tab_content[i]).data('tab-title');
                    tab_header.append(`<li class="tab-title">${title}</li>`);
                }
                let title = tab_header.find('.tab-title');
                $(title[0]).addClass('current');
                $('.tab ul.tabs').addClass('active').find('> li:eq(0)').addClass('current');
                title.on('click', function (e) {
                    let tab = $(this).closest('.tab'),
                        index = $(this).closest('li').index();
                    title.removeClass('current');
                    $(this).closest('li').addClass('current');
                    tab.find('.tab-content').find('div.tabs-item').not('div.tabs-item:eq(' + index + ')').slideUp();
                    tab.find('.tab-content').find('div.tabs-item:eq(' + index + ')').slideDown();
                    e.preventDefault();
                });
            });
        }

        _accordions_init() {
            let $accordion = $('.js-accordion');
            $($accordion).each(function () {
                let $accordion_body = $(this).find('.accordion-body-contents');
                let $accordion_header = $(this).find('.js-accordion-header');
                let $item = $(this).find('.js-accordion-item');
                let $item_active = $(this).find('.js-accordion-item.active');
                $(COMMON.win).resize(function () {
                    $($accordion_body).each(function () {
                        let $height = $(this).children().outerHeight(true);
                        $(this).css('height', $height);
                    });
                });
                let settings = {
                    speed: 300,
                    oneOpen: true
                };
                let accordion_config = {
                    init: function ($settings) {
                        $accordion_header.on('click', function () {
                            accordion_config.toggle($(this));
                            let $accordion_body = $(this).parent().find('.accordion-body-contents');
                            let height = $accordion_body.children().outerHeight(true);
                            $accordion_body.css('height', height);
                        });
                        $.extend(settings, $settings);
                        if (settings.oneOpen && $item_active.length > 1) {
                            $('.js-accordion-item.active:not(:first)').removeClass('active');
                        }
                        $('.js-accordion-item.active').find('> .js-accordion-body').show();
                    },
                    toggle: function ($this) {
                        if (settings.oneOpen && $this[0] !== $this.closest($(this)).find($item_active).find('.accordion-header')[0]) {
                            $this.closest('.js-accordion')
                                .find('> .js-accordion-item')
                                .removeClass('active')
                                .find('.js-accordion-body')
                                .slideUp(settings.speed)
                        }
                        $this.closest($item).toggleClass('active');
                        $this.next().stop().slideToggle(settings.speed);
                    }
                };
                accordion_config.init(settings);
                $accordion_body.css('height', $accordion_body.children().outerHeight(true));
            });
        }

        _video_post_format() {
            let video = this.video_post_format;
            let toggle = this.video_post_format_toggle;
            $(video).each(function () {
                let $this = $(this);
                $this.YTPlayer({
                    containment: $this.parent(),
                    autoPlay: false,
                    showControls: false,
                    loop: true,
                    stopMovieOnBlur: true,
                    anchor: 'center,center'
                });
            });
            this.video_post_format_toggle.on('click', function () {
                let video = $(this).parent().find('.video-post-format--video');
                $(this).toggleClass('active-video');
                if ($(this).hasClass('active-video')) {
                    $(video).YTPPlay();
                } else {
                    $(video).YTPPause();
                }
            });
        }

        _isotope_grid() {
            this.grid_default.isotope({
                layoutMode: 'fitRows',
                itemSelector: '.grid-item',
                percentPosition: true,
            });
            this.grid_masonry.isotope({
                layoutMode: 'masonry',
                itemSelector: '.grid-item',
                percentPosition: true,
            });
        }

        _parallax_fix() {
            if ($(COMMON.win).innerWidth() <= 992) {
                let parallax_boxes = $('[data-kc-parallax="true"]');
                $(parallax_boxes).each(function () {
                    $(this).removeAttr("data-kc-parallax");
                });
            }
        }

        _kc_fix() {
            let elm = $('div');
            if (!$(elm).hasClass('kc-elm')) {
                $(this.content).addClass('default-content default-content-styles container');
            }
        }

        _portfolio_taxonomy_fix() {
            this.info_part_static.find('a').removeAttr("href").on('click', function (e) {
                e.preventDefault();
            });
        }

        _footer_parallax() {
            if (this.footer_parallax_wrapper.length) {
                this.footer_spacing.css({
                    'height': this.footer_parallax_wrapper.outerHeight(true),
                });
            }
        }

        _loader() {
            this.loader.addClass('off_loader');
            this.wrapper.addClass('on_wrapper');
        }

        _comments_resize() {
            let comment_wrap = this.default_content.find('.comment-wrap');
            let comment_body = this.default_content.find('.comment-body');
            let comment_avatar = this.default_content.find('.comment-avatar');
            let width_avatar = $(comment_avatar).outerWidth(true);
            let width_wrap = $(comment_wrap).outerWidth(true);
            let width = width_wrap - width_avatar;
            $(comment_body).css({
                'width': width
            })
        }

        static progress_bars(element, progress) {
            let bar = new ProgressBar.Line(element, {
                strokeWidth: 6,
                easing: 'easeInOut',
                duration: 1400,
                color: COMMON.primary_color,
                trailColor: '#eee',
                trailWidth: 11,
                svgStyle: {
                    width: '100%',
                    height: '11px'
                },
                text: {
                    style: {},
                    autoStyleContainer: false
                },
                from: {
                    color: '#FFEA82'
                },
                to: {
                    color: '#ED6A5A'
                },
                step: (state, bar) => {
                    bar.setText(Math.round(bar.value() * 100) + ' %');
                }
            });
            bar.animate(progress);
        }

        static counters(element, count) {
            $(element).waypoint(function () {
                if (!$(element).hasClass("finished_counters")) {
                    let propertiesObj = {};
                    let param = {
                        targets: propertiesObj,
                        easing: 'easeInQuad',
                        round: 1,
                        duration: function (el, i, l) {
                            return 4000 + (i * 300);
                        },
                        update: function () {
                            let el = $(element).find(".prop-obj");
                            let i = 0;
                            for (const prop in propertiesObj) {
                                el[i].innerHTML = JSON.stringify(propertiesObj[prop]);
                                i++;
                            }
                        }
                    };
                    for (let i = 1; i < count + 1; i++) {
                        propertiesObj['prop' + i] = 0;
                        param['prop' + i] = $(element).find(".prop-obj" + i).data("count");
                    }
                    anime(param);
                    $(element).addClass("finished_counters");
                }
            }, {
                offset: '100%'
            });
        }

        static background_gradient(canvas_inner) {
            let colors = [
                [130, 53, 216],
                [120, 40, 190],
                [140, 30, 200],
                [110, 30, 200],
                [100, 25, 190],
                [90, 20, 180],
            ];
            let step = 0;
            let colorIndices = [0, 1, 2, 3];
            let gradientSpeed = 0.006;

            function updateGradient() {

                if ($ === undefined) return;

                let c0_0 = colors[colorIndices[0]];
                let c0_1 = colors[colorIndices[1]];
                let c1_0 = colors[colorIndices[2]];
                let c1_1 = colors[colorIndices[3]];

                let istep = 1 - step;
                let r1 = Math.round(istep * c0_0[0] + step * c0_1[0]);
                let g1 = Math.round(istep * c0_0[1] + step * c0_1[1]);
                let b1 = Math.round(istep * c0_0[2] + step * c0_1[2]);
                let color1 = "rgb(" + r1 + "," + g1 + "," + b1 + ")";

                let r2 = Math.round(istep * c1_0[0] + step * c1_1[0]);
                let g2 = Math.round(istep * c1_0[1] + step * c1_1[1]);
                let b2 = Math.round(istep * c1_0[2] + step * c1_1[2]);
                let color2 = "rgb(" + r2 + "," + g2 + "," + b2 + ")";

                canvas_inner.css({
                    background: "-webkit-gradient(linear, left top, right top, from(" + color1 + "), to(" + color2 + "))"
                }).css({
                    background: "-moz-linear-gradient(left, " + color1 + " 0%, " + color2 + " 100%)"
                });

                step += gradientSpeed;
                if (step >= 1) {
                    step %= 1;
                    colorIndices[0] = colorIndices[1];
                    colorIndices[2] = colorIndices[3];

                    //pick two new target color indices
                    //do not pick the same as the current one
                    colorIndices[1] = (colorIndices[1] + Math.floor(1 + Math.random() * (colors.length - 1))) % colors.length;
                    colorIndices[3] = (colorIndices[3] + Math.floor(1 + Math.random() * (colors.length - 1))) % colors.length;

                }
            }

            setInterval(updateGradient, 10);
        }

        static default_particles_background(canvas_inner) {
            const json = {
                "particles": {
                    "number": {
                        "value": 200,
                        "density": {
                            "enable": true,
                            "value_area": 700
                        }
                    },
                    "color": {
                        "value": ['#3d67f4', '#995ae8']
                    },
                    "shape": {
                        "type": "circle",
                        "stroke": {
                            "width": 0,
                            "color": "#000000"
                        },
                        "polygon": {
                            "nb_sides": 2
                        },
                        "image": {
                            "src": "img/github.svg",
                            "width": 100,
                            "height": 100
                        }
                    },
                    "opacity": {
                        "value": 1,
                        "random": false,
                        "anim": {
                            "enable": true,
                            "speed": 4,
                            "opacity_min": 0.6,
                            "sync": false
                        }
                    },
                    "size": {
                        "value": 3.5,
                        "random": true,
                        "anim": {
                            "enable": true,
                            "speed": 10,
                            "size_min": 0.2,
                            "sync": false
                        }
                    },
                    "line_linked": {
                        "enable": true,
                        "distance": 110.48,
                        "color": "#995ae8",
                        "opacity": 0.5,
                        "width": 1
                    },
                    "move": {
                        "enable": true,
                        "speed": 3,
                        "direction": "none",
                        "random": true,
                        "straight": false,
                        "out_mode": "bounce",
                        "bounce": false,
                        "attract": {
                            "enable": false,
                            "rotateX": 800,
                            "rotateY": 1200
                        }
                    }
                },
                "interactivity": {
                    "detect_on": "canvas",
                    "events": {
                        "onhover": {
                            "enable": true,
                            "mode": "push"
                        },
                        "onclick": {
                            "enable": true,
                            "mode": "push"
                        },
                        "resize": true
                    },
                    "modes": {
                        "grab": {
                            "distance": 400,
                            "line_linked": {
                                "opacity": 1
                            }
                        },
                        "bubble": {
                            "distance": 400,
                            "size": 40,
                            "duration": 2,
                            "opacity": 8,
                            "speed": 3
                        },
                        "repulse": {
                            "distance": 150,
                            "duration": 0.1
                        },
                        "push": {
                            "particles_nb": 4
                        },
                        "remove": {
                            "particles_nb": 2
                        }
                    }
                },
                "retina_detect": true
            };
            particlesJS(canvas_inner, json);
        }

        static digital_particles_background(canvas_inner) {
            const json = {
                "particles": {
                    "number": {
                        "value": 150,
                        "density": {
                            "enable": true,
                            "value_area": 700
                        }
                    },
                    "color": {
                        "value": ["#aa73ff", "#f8c210", "#83d238", "#33b1f8"]
                    },
                    "shape": {
                        "type": "circle",
                        "stroke": {
                            "width": 0,
                            "color": "#000000"
                        },
                        "polygon": {
                            "nb_sides": 15
                        }
                    },
                    "opacity": {
                        "value": 0.5,
                        "random": false,
                        "anim": {
                            "enable": false,
                            "speed": 1.5,
                            "opacity_min": 0.15,
                            "sync": false
                        }
                    },
                    "size": {
                        "value": 2.5,
                        "random": false,
                        "anim": {
                            "enable": true,
                            "speed": 2,
                            "size_min": 0.15,
                            "sync": false
                        }
                    },
                    "line_linked": {
                        "enable": true,
                        "distance": 110,
                        "color": "#33b1f8",
                        "opacity": 0.25,
                        "width": 1
                    },
                    "move": {
                        "enable": true,
                        "speed": 1.6,
                        "direction": "none",
                        "random": false,
                        "straight": false,
                        "out_mode": "out",
                        "bounce": false,
                        "attract": {
                            "enable": false,
                            "rotateX": 600,
                            "rotateY": 1200
                        }
                    }
                },
                "interactivity": {
                    "detect_on": "canvas",
                    "events": {
                        "onhover": {
                            "enable": false,
                            "mode": "repulse"
                        },
                        "onclick": {
                            "enable": false,
                            "mode": "push"
                        },
                        "resize": true
                    },
                    "modes": {
                        "grab": {
                            "distance": 400,
                            "line_linked": {
                                "opacity": 1
                            }
                        },
                        "bubble": {
                            "distance": 400,
                            "size": 40,
                            "duration": 2,
                            "opacity": 8,
                            "speed": 3
                        },
                        "repulse": {
                            "distance": 200,
                            "duration": 0.4
                        },
                        "push": {
                            "particles_nb": 4
                        },
                        "remove": {
                            "particles_nb": 2
                        }
                    }
                },
                "retina_detect": true
            };
            particlesJS(canvas_inner, json);
        }

        static circles_particles_background(canvas_inner) {
            const json = {
                "particles": {
                    "number": {
                        "value": 180
                    },
                    "color": {
                        "value": "#eee"
                    },
                    "shape": {
                        "type": "circle"
                    },
                    "opacity": {
                        "value": 0.5,
                        "random": true,
                        "anim": {
                            "enable": false
                        }
                    },
                    "size": {
                        "value": 15,
                        "random": true,
                        "anim": {
                            "enable": false,
                        }
                    },
                    "line_linked": {
                        "enable": false
                    },
                    "move": {
                        "enable": true,
                        "speed": 4,
                        "direction": "none",
                        "random": true,
                        "straight": false,
                        "out_mode": "out"
                    }
                },
                "interactivity": {
                    "detect_on": "canvas",
                    "events": {
                        "onhover": {
                            "enable": false
                        },
                        "onclick": {
                            "enable": true,
                            "mode": "push"
                        },
                        "resize": true
                    },
                    "modes": {
                        "push": {
                            "particles_nb": 10
                        }
                    }
                },
                "retina_detect": true
            }
            particlesJS(canvas_inner, json);
        }

        static snow_particles_background(canvas_scene, canvas_inner) {
            let circles, target, animateHeader = true;
            let canvas = canvas_inner;
            let width = canvas_scene.innerWidth();
            let height = canvas_scene.innerHeight();
            let canvas_header = canvas_scene;
            let ctx = canvas.getContext('2d');

            initHeader();
            addListeners();

            function initHeader() {
                canvas.width = width;
                canvas.height = height;
                target = {
                    x: 0,
                    y: height
                };
                canvas_header.css({
                    'height': height + 'px'
                });
                circles = [];
                for (let x = 0; x < width * 0.5; x++) {
                    let c = new Circle();
                    circles.push(c);
                }
                animate();
            }

            function addListeners() {
                COMMON.win.addEventListener('scroll', scrollCheck);
                COMMON.win.addEventListener('resize', resize);
            }

            function scrollCheck() {
                if (COMMON.doc.body.scrollTop > height) animateHeader = false;
                else animateHeader = true;
            }

            function resize() {
                width = COMMON.win.innerWidth;
                height = COMMON.win.innerHeight;
                canvas_header.css({
                    'height': height + 'px'
                });
                canvas.width = width;
                canvas.height = height;
            }

            function animate() {
                if (animateHeader) {
                    ctx.clearRect(0, 0, width, height);
                    for (let i in circles) {
                        circles[i].draw();
                    }
                }
                requestAnimationFrame(animate);
            }


            function Circle() {
                let $this = this;

                (function () {
                    $this.pos = {};
                    init();
                })();

                function init() {
                    $this.pos.x = Math.random() * width;
                    $this.pos.y = height + Math.random() * 100;
                    $this.alpha = 0.1 + Math.random() * 0.4;
                    $this.scale = 0.1 + Math.random() * 0.3;
                    $this.velocity = Math.random();
                }

                this.draw = function () {
                    if ($this.alpha <= 0) {
                        init();
                    }
                    $this.pos.y -= $this.velocity;
                    $this.alpha -= 0.0003;
                    ctx.beginPath();
                    ctx.arc($this.pos.x, $this.pos.y, $this.scale * 10, 0, 2 * Math.PI, false);
                    ctx.fillStyle = 'rgba(255,255,255,' + $this.alpha + ')';
                    ctx.fill();
                };
            }
        }

        static waves_particles_background(canvas_inner) {
            let SEPARATION = 100;
            let AMOUNTX = 50;
            let AMOUNTY = 50;
            let camera, scene, renderer;
            let particles;
            let particle;
            let count = 0;
            let mouseX = 85;
            let mouseY = -342;
            let windowHalfX = COMMON.win.innerWidth / 2;
            let windowHalfY = COMMON.win.innerHeight / 2;
            let container = canvas_inner;

            init();
            animate();

            function init() {
                camera = new THREE.PerspectiveCamera(120, COMMON.win.innerWidth / COMMON.win.innerHeight, 1, 10000);
                camera.position.z = 1000;
                scene = new THREE.Scene();
                particles = [];
                let PI2 = Math.PI * 2;
                let material = new THREE.SpriteCanvasMaterial({
                    color: 0xe1e1e1,
                    program: function (context) {
                        context.beginPath();
                        context.arc(0, 0, .3, 0, PI2, true);
                        context.fill();
                    }
                });
                let i = 0;
                for (let ix = 0; ix < AMOUNTX; ix++) {
                    for (let iy = 0; iy < AMOUNTY; iy++) {
                        particle = particles[i++] = new THREE.Particle(material);
                        particle.position.x = ix * SEPARATION - ((AMOUNTX * SEPARATION) / 2);
                        particle.position.z = iy * SEPARATION - ((AMOUNTY * SEPARATION) / 2);
                        scene.add(particle);
                    }
                }
                renderer = new THREE.CanvasRenderer();
                renderer.setSize(COMMON.win.innerWidth, COMMON.win.innerHeight);
                container.appendChild(renderer.domElement);
                document.addEventListener('mousemove', onDocumentMouseMove, false);
                document.addEventListener('touchstart', onDocumentTouchStart, false);
                document.addEventListener('touchmove', onDocumentTouchMove, false);
                COMMON.win.addEventListener('resize', onWindowResize, false);
            }

            function onWindowResize() {
                windowHalfX = COMMON.win.innerWidth / 2;
                windowHalfY = COMMON.win.innerHeight / 2;
                camera.aspect = COMMON.win.innerWidth / COMMON.win.innerHeight;
                camera.updateProjectionMatrix();
                renderer.setSize(COMMON.win.innerWidth, COMMON.win.innerHeight);
            }

            function onDocumentMouseMove(event) {
                mouseX = event.clientX - windowHalfX;
                mouseY = event.clientY - windowHalfY;
            }

            function onDocumentTouchStart(event) {
                if (event.touches.length === 1) {
                    event.preventDefault();
                    mouseX = event.touches[0].pageX - windowHalfX;
                    mouseY = event.touches[0].pageY - windowHalfY;
                }
            }

            function onDocumentTouchMove(event) {
                if (event.touches.length === 1) {
                    event.preventDefault();
                    mouseX = event.touches[0].pageX - windowHalfX;
                    mouseY = event.touches[0].pageY - windowHalfY;
                }
            }

            function animate() {
                requestAnimationFrame(animate);
                render();
            }

            function render() {
                camera.position.x += (mouseX - camera.position.x) * .05;
                camera.position.y += (-mouseY - camera.position.y) * .05;
                camera.lookAt(scene.position);
                let i = 0;
                for (let ix = 0; ix < AMOUNTX; ix++) {
                    for (let iy = 0; iy < AMOUNTY; iy++) {
                        particle = particles[i++];
                        particle.position.y = (Math.sin((ix + count) * 0.3) * 50) + (Math.sin((iy + count) * 0.5) * 50);
                        particle.scale.x = particle.scale.y = (Math.sin((ix + count) * 0.3) + 1) * 2 + (Math.sin((iy + count) * 0.5) + 1) * 2;
                    }
                }
                renderer.render(scene, camera);
                count += 0.1;
            }
        }

        static confetti_particles_background(canvas_inner) {
            let NUM_CONFETTI = 550;
            let COLORS = [
                [110, 142, 251],
                [153, 90, 232],
                [143, 100, 222],
                [120, 132, 241],
                [143, 80, 242]
            ];
            let PI_2 = 2 * Math.PI;
            let canvas = canvas_inner;
            let context = canvas.getContext("2d");
            COMMON.win.w = 0;
            COMMON.win.h = 0;
            let resizeWindow = function () {
                COMMON.win.w = canvas.width = COMMON.win.innerWidth;
                return COMMON.win.h = canvas.height = COMMON.win.innerHeight;
            };
            COMMON.win.addEventListener('resize', resizeWindow, false);
            COMMON.win.onload = function () {
                return setTimeout(resizeWindow, 0);
            };
            let range = function (a, b) {
                return (b - a) * Math.random() + a;
            };
            let drawCircle = function (x, y, r, style) {
                context.beginPath();
                context.arc(x, y, r, 0, PI_2, false);
                context.fillStyle = style;
                return context.fill();
            };
            let xpos = 0.5;
            document.onmousemove = function (e) {
                return xpos = e.pageX / w;
            };

            let Confetti = class Confetti {
                constructor() {
                    this.style = COLORS[~~range(0, 5)];
                    this.rgb = `rgba(${this.style[0]},${this.style[1]},${this.style[2]}`;
                    this.r = ~~range(2, 6);
                    this.r2 = 2 * this.r;
                    this.replace();
                }

                replace() {
                    this.opacity = 0;
                    this.dop = 0.03 * range(1, 4);
                    this.x = range(-this.r2, w - this.r2);
                    this.y = range(-20, h - this.r2);
                    this.xmax = w - this.r;
                    this.ymax = h - this.r;
                    this.vx = range(0, 2) + 8 * xpos - 5;
                    return this.vy = 0.7 * this.r + range(-1, 1);
                }

                draw() {
                    let ref;
                    this.x += this.vx;
                    this.y += this.vy;
                    this.opacity += this.dop;
                    if (this.opacity > 1) {
                        this.opacity = 1;
                        this.dop *= -1;
                    }
                    if (this.opacity < 0 || this.y > this.ymax) {
                        this.replace();
                    }
                    if (!((0 < (ref = this.x) && ref < this.xmax))) {
                        this.x = (this.x + this.xmax) % this.xmax;
                    }
                    return drawCircle(~~this.x, ~~this.y, this.r, `${this.rgb},${this.opacity})`);
                }

            };
            let confetti = (function () {
                let j, ref, results;
                results = [];
                for (let i = j = 1, ref = NUM_CONFETTI; 1 <= ref ? j <= ref : j >= ref; i = 1 <= ref ? ++j : --j) {
                    results.push(new Confetti);
                }
                return results;
            })();
            COMMON.win.step = function () {
                let c;
                let len;
                let results;
                requestAnimationFrame(step);
                context.clearRect(0, 0, w, h);
                results = [];
                for (let j = 0, len = confetti.length; j < len; j++) {
                    c = confetti[j];
                    results.push(c.draw());
                }
                return results;
            };
            step();
        }

        static moving_particles_background(canvas_scene, canvas_inner) {
            function Star(id, x, y) {
                this.id = id;
                this.x = x;
                this.y = y;
                this.r = Math.floor(Math.random() * 2) + 1;
                let alpha = (Math.floor(Math.random() * 10) + 1) / 10 / 2;
                this.color = "rgba(110,142,251," + alpha + ")";
            }

            Star.prototype.draw = function () {
                ctx.fillStyle = this.color;
                ctx.shadowBlur = this.r * 2;
                ctx.beginPath();
                ctx.arc(this.x, this.y, this.r, 0, 2 * Math.PI, false);
                ctx.closePath();
                ctx.fill();
            };
            Star.prototype.move = function () {
                this.y -= .15 + params.backgroundSpeed / 100;
                if (this.y <= -10) this.y = height + 10;
                this.draw();
            };

            function Dot(id, x, y, r) {
                this.id = id;
                this.x = x;
                this.y = y;
                this.r = Math.floor(Math.random() * 5) + 1;
                this.maxLinks = 2;
                this.speed = .5;
                this.a = .7;
                this.aReduction = .005;
                this.color = "rgba(230,217,249," + this.a + ")";
                this.linkColor = "rgba(110,142,251," + this.a / 4 + ")";

                this.dir = Math.floor(Math.random() * 140) + 200;
            }

            Dot.prototype.draw = function () {
                ctx.fillStyle = this.color;
                ctx.shadowBlur = this.r * 2;
                ctx.beginPath();
                ctx.arc(this.x, this.y, this.r, 0, 2 * Math.PI, false);
                ctx.closePath();
                ctx.fill();
            };
            Dot.prototype.link = function () {
                if (this.id === 0) return;
                let previousDot1 = getPreviousDot(this.id, 1);
                let previousDot2 = getPreviousDot(this.id, 2);
                let previousDot3 = getPreviousDot(this.id, 3);
                if (!previousDot1) return;
                ctx.strokeStyle = this.linkColor;
                ctx.moveTo(previousDot1.x, previousDot1.y);
                ctx.beginPath();
                ctx.lineTo(this.x, this.y);
                if (previousDot2 !== false) ctx.lineTo(previousDot2.x, previousDot2.y);
                if (previousDot3 !== false) ctx.lineTo(previousDot3.x, previousDot3.y);
                ctx.stroke();
                ctx.closePath();
            };

            function getPreviousDot(id, stepback) {
                if (id === 0 || id - stepback < 0) return false;
                if (typeof dots[id - stepback] !== "undefined") return dots[id - stepback];
                else return false;
            }

            Dot.prototype.move = function () {
                this.a -= this.aReduction;
                if (this.a <= 0) {
                    this.die();
                    return
                }
                this.color = "rgba(230,217,249," + this.a + ")";
                this.linkColor = "rgba(110,142,251," + this.a / 4 + ")";
                this.x = this.x + Math.cos(degToRad(this.dir)) * (this.speed + params.dotsSpeed / 100),
                    this.y = this.y + Math.sin(degToRad(this.dir)) * (this.speed + params.dotsSpeed / 100);

                this.draw();
                this.link();
            };
            Dot.prototype.die = function () {
                dots[this.id] = null;
                delete dots[this.id];
            };
            let canvas = canvas_inner;
            let ctx = canvas.getContext('2d');
            let width = canvas_scene.innerWidth();
            let height = canvas_scene.innerHeight();
            let mouseMoving = false;
            let mouseMoveChecker;
            let mouseX;
            let mouseY;
            let stars = [];
            let initStarsPopulation = 80;
            let dots = [];
            let dotsMinDist = 2;
            let params = {
                maxDistFromCursor: 50,
                dotsSpeed: 0,
                backgroundSpeed: 0
            };
            setCanvasSize();
            init();

            function setCanvasSize() {
                canvas.setAttribute("width", width);
                canvas.setAttribute("height", height);
            }

            function init() {
                ctx.strokeStyle = "#3d67f4";
                ctx.shadowColor = "#995ae8";
                for (let i = 0; i < initStarsPopulation; i++) {
                    stars[i] = new Star(i, Math.floor(Math.random() * width), Math.floor(Math.random() * height));
                    stars[i].draw();
                }
                ctx.shadowBlur = 0;
                animate();
            }

            function animate() {
                ctx.clearRect(0, 0, width, height);

                for (let i in stars) {
                    stars[i].move();
                }
                for (let i in dots) {
                    dots[i].move();
                }
                drawIfMouseMoving();
                requestAnimationFrame(animate);
            }

            COMMON.win.onmousemove = function (e) {
                mouseMoving = true;
                mouseX = e.clientX;
                mouseY = e.clientY;
                clearInterval(mouseMoveChecker);
                mouseMoveChecker = setTimeout(function () {
                    mouseMoving = false;
                }, 100);
            };

            function drawIfMouseMoving() {
                if (!mouseMoving) return;
                if (dots.length === 0) {
                    dots[0] = new Dot(0, mouseX, mouseY);
                    dots[0].draw();
                    return;
                }
                let previousDot = getPreviousDot(dots.length, 1);
                let prevX = previousDot.x;
                let prevY = previousDot.y;
                let diffX = Math.abs(prevX - mouseX);
                let diffY = Math.abs(prevY - mouseY);
                if (diffX < dotsMinDist || diffY < dotsMinDist) return;
                let xletiation = Math.random() > .5 ? -1 : 1;
                xletiation = xletiation * Math.floor(Math.random() * params.maxDistFromCursor) + 1;
                let yletiation = Math.random() > .5 ? -1 : 1;
                yletiation = yletiation * Math.floor(Math.random() * params.maxDistFromCursor) + 1;
                dots[dots.length] = new Dot(dots.length, mouseX + xletiation, mouseY + yletiation);
                dots[dots.length - 1].draw();
                dots[dots.length - 1].link();
            }

            function degToRad(deg) {
                return deg * (Math.PI / 180);
            }

        }

        static lines_particles_background(canvas_scene, canvas_inner) {
            FUNC.background_gradient(canvas_scene);
            let mouseX = 0,
                mouseY = 0;
            let windowHalfX = COMMON.win.innerWidth / 2;
            let windowHalfY = COMMON.win.innerHeight / 2;
            let SEPARATION = 200;
            let AMOUNTX = 1;
            let AMOUNTY = 1;
            let camera;
            let scene;
            let renderer;
            let container = canvas_inner;
            let width = canvas_scene.innerWidth();
            let height = canvas_scene.innerHeight();
            init();
            animate();

            function init() {
                let separation = 1000,
                    amountX = 50,
                    amountY = 50,
                    color = 0xeeeeee,
                    particles, particle;
                camera = new THREE.PerspectiveCamera(75, COMMON.win.innerWidth / COMMON.win.innerHeight, 1, 10000);
                camera.position.z = 100;
                scene = new THREE.Scene();
                renderer = new THREE.CanvasRenderer({
                    alpha: true
                });
                renderer.setPixelRatio(COMMON.win.devicePixelRatio);
                renderer.setClearColor(0x000000, 0);
                renderer.setSize(width, height);
                container.appendChild(renderer.domElement);
                let PI2 = Math.PI * 2;
                let material = new THREE.SpriteCanvasMaterial({
                    color: color,
                    opacity: 0.5,
                    program: function (context) {
                        context.beginPath();
                        context.arc(0, 0, 0.5, 0, PI2, true);
                        context.fill();
                    }
                });
                let geometry = new THREE.Geometry();
                for (let i = 0; i < 150; i++) {
                    particle = new THREE.Sprite(material);
                    particle.position.x = Math.random() * 2 - 1;
                    particle.position.y = Math.random() * 2 - 1;
                    particle.position.z = Math.random() * 2 - 1;
                    particle.position.normalize();
                    particle.position.multiplyScalar(Math.random() * 10 + 600);
                    particle.scale.x = particle.scale.y = 5;
                    scene.add(particle);
                    geometry.vertices.push(particle.position);
                }
                let line = new THREE.Line(geometry, new THREE.LineBasicMaterial({
                    color: color,
                    opacity: 0.2
                }));
                scene.add(line);
                document.addEventListener('mousemove', onDocumentMouseMove, false);
                document.addEventListener('touchstart', onDocumentTouchStart, false);
                document.addEventListener('touchmove', onDocumentTouchMove, false);
                COMMON.win.addEventListener('resize', onWindowResize, false);
            }

            function onWindowResize() {
                windowHalfX = COMMON.win.innerWidth / 2;
                windowHalfY = COMMON.win.innerHeight / 2;
                camera.aspect = COMMON.win.innerWidth / COMMON.win.innerHeight;
                camera.updateProjectionMatrix();
                renderer.setSize(COMMON.win.innerWidth, COMMON.win.innerHeight);
            }

            function onDocumentMouseMove(event) {
                mouseX = (event.clientX - windowHalfX) * 0.05;
                mouseY = (event.clientY - windowHalfY) * 0.2;
            }

            function onDocumentTouchStart(event) {
                if (event.touches.length > 1) {
                    event.preventDefault();
                    mouseX = (event.touches[0].pageX - windowHalfX) * 0.7;
                    mouseY = (event.touches[0].pageY - windowHalfY) * 0.7;
                }
            }

            function onDocumentTouchMove(event) {
                if (event.touches.length == 1) {
                    event.preventDefault();
                    mouseX = event.touches[0].pageX - windowHalfX;
                    mouseY = event.touches[0].pageY - windowHalfY;
                }
            }

            function animate() {
                requestAnimationFrame(animate);
                render();
            }

            function render() {
                camera.position.x += (mouseX - camera.position.x) * 0.1;
                camera.position.y += (-mouseY + 200 - camera.position.y) * 0.05;
                camera.lookAt(scene.position);
                renderer.render(scene, camera);
            }
        }

        static gravity_particles_background(canvas_scene, canvas_inner) {
            let onload = function () {
                setTimeout(init(), 0)
            };
            let a, ctx, canvas, mouse, gravityStrength, particles, spawnTimer, spawnInterval, type, time,
                particleOverflow, x, y;
            canvas = canvas_inner;
            ctx = canvas.getContext('2d');
            let width = canvas_scene.innerWidth();
            let height = canvas_scene.innerHeight();
            canvas.width = width;
            canvas.height = height;
            let init = function () {
                let onresize = function () {
                    canvas.width = canvas.clientWidth;
                    canvas.height = canvas.clientHeight;
                };
                onresize();

                mouse = {
                    x: canvas.width / 2,
                    y: canvas.height / 2,
                    out: false
                }

                canvas.onmouseout = function () {
                    mouse.out = true
                };

                canvas.onmousemove = function (e) {
                    let rect = canvas.getBoundingClientRect();
                    mouse = {
                        x: e.clientX - rect.left,
                        y: e.clientY - rect.top,
                        out: false
                    }
                };

                gravityStrength = 10;
                particles = [];
                spawnTimer = 0;
                spawnInterval = 10;
                type = 0;
                requestAnimationFrame(startLoop)
            };

            let newParticle = function () {
                type = type ? 0 : 1;
                particles.push({
                    x: mouse.x,
                    y: mouse.y,
                    xv: type ? 18 * Math.random() - 9 : 24 * Math.random() - 12,
                    yv: type ? 18 * Math.random() - 9 : 24 * Math.random() - 12,
                    c: type ? 'rgb(173,' + ((110 * Math.random()) | 0) + ',' + ((242 * Math.random()) | 0) + ')' : 'rgb(255,255,255)',
                    s: type ? 5 + 10 * Math.random() : 1,
                    a: 1
                })
            };

            let startLoop = function (newTime) {
                time = newTime;
                requestAnimationFrame(loop);
            };

            let loop = function (newTime) {
                draw();
                CALCulate(newTime);
                requestAnimationFrame(loop);
            };

            let draw = function () {
                ctx.clearRect(0, 0, canvas.width, canvas.height);
                for (let i = 0; i < particles.length; i++) {
                    let p = particles[i];
                    ctx.globalAlpha = p.a;
                    ctx.fillStyle = p.c;
                    ctx.beginPath();
                    ctx.arc(p.x, p.y, p.s, 0, 2 * Math.PI);
                    ctx.fill();
                }
            };

            let CALCulate = function (newTime) {
                let dt = newTime - time;
                time = newTime;

                if (!mouse.out) {
                    spawnTimer += (dt < 100) ? dt : 100;
                    for (; spawnTimer > 0; spawnTimer -= spawnInterval) {
                        newParticle();
                    }
                }

                particleOverflow = particles.length - 700;
                if (particleOverflow > 0) {
                    particles.splice(0, particleOverflow);
                }

                for (let i = 0; i < particles.length; i++) {
                    let p = particles[i];
                    if (!mouse.out) {
                        x = mouse.x - p.x;
                        y = mouse.y - p.y;
                        a = x * x + y * y;
                        a = a > 100 ? gravityStrength / a : gravityStrength / 100;
                        p.xv = (p.xv + a * x) * 0.99;
                        p.yv = (p.yv + a * y) * 0.99;
                    }
                    p.x += p.xv;
                    p.y += p.yv;
                    p.a *= 0.99;
                }
            };
            onload();
        }

        static space_journey_particles_background(canvas_scene, canvas_inner) {
            let canvas = canvas_inner,
                c = canvas.getContext("2d"),
                particles = {},
                particleIndex = 0,
                particleNum = 0.55;
            canvas.width = canvas_scene.innerWidth();
            canvas.height = canvas_scene.innerHeight();
            canvas.id = "motion";

            function Particle() {
                this.x = canvas.width / 2;
                this.y = canvas.height / 2;
                this.vx = Math.random() * 5 - 2.5;
                this.vy = Math.random() * 2 - 1;
                this.growth = (Math.abs(this.vx) + Math.abs(this.vy)) * 0.007;
                particleIndex++;
                particles[particleIndex] = this;
                this.id = particleIndex;
                this.size = Math.random() * 1;
                this.colors = [
                    "rgba(244,255,222," + (Math.random() + .5) + ")",
                    "rgba(233,255,211," + (Math.random() + .5) + ")",
                    "rgba(255,255,244," + (Math.random() + .5) + ")",
                    "rgba(214,234,222," + (Math.random() + .5) + ")"
                ];
                this.color = this.colors[Math.floor(Math.random() * 3)];
            }

            Particle.prototype.draw = function () {
                this.x += this.vx;
                this.y += this.vy;
                this.size += this.growth;
                if (this.x > canvas.width || this.y > canvas.height) {
                    delete particles[this.id];
                }
                c.fillStyle = this.color;
                c.beginPath();
                c.arc(this.x, this.y, this.size, 0 * Math.PI, 2 * Math.PI);
                c.fill();
            };

            setInterval(function () {
                c.fillStyle = "#995ae8";
                c.fillRect(0, 0, canvas.width, canvas.height);
                /*for (let i = 0; i < particleNum; i++){
                    new Particle();
                }*/
                if (Math.random() > particleNum) {
                    new Particle();
                }
                for (let i in particles) {
                    particles[i].draw();
                }
            }, 30);
        };

        static image_modal_init(modal) {
            modal.magnificPopup({
                type: 'image',
                closeOnContentClick: true,
                closeBtnInside: false,
                fixedContentPos: true,
                mainClass: 'mfp-fade',
                image: {
                    verticalFit: true
                },
            });
        }

        static video_modal_init(modal) {
            modal.magnificPopup({
                type: 'inline',
                closeOnContentClick: true,
                mainClass: 'mfp-fade',
                modal: true,
                closeBtnInside: true,
            });
            $('.modal-video-box').on('click', function (e) {
                $.magnificPopup.close();
            });
        }

        init() {
            this._hover_3dtransform();
            this._swiper_init();
            this._scroll_down();
            this._tabs_init();
            this._accordions_init();
            this._video_post_format();
            this._isotope_grid();
            this._kc_fix();
            this._footer_parallax();
            this._parallax_fix();
            this._loader();
            this._sticky_content();
            this._comments_resize();
            this._portfolio_taxonomy_fix();
            $(COMMON.win).on('resize', () => {
                this._parallax_fix();
                this._comments_resize();
            });
        }
    }

    class NAV {
        constructor() {
            this.navbar = $('.navbar');
            this.menu_desktop = this.navbar.find('.menu-desktop');
            this.menu_item = this.menu_desktop.find('.menu-item');
            this.menu_item_has_children = this.menu_desktop.find('.menu-item-has-children');
            this.menu_item_has_megamenu = this.menu_desktop.find('.menu-item-has-megamenu');
            this.search_form_wrapper = this.navbar.find('.navigation-wrapper--search-toggle-wrapper');
            this.search_toggle = this.search_form_wrapper.find('.search-toggle');
            this.search_form = this.search_form_wrapper.find('.search-form');
            this.search_input_wrapper = this.search_form.find('.search-input-wrapper');
            this.menu_mobile = this.navbar.find('.menu-mobile');
            this.mobile_toggle_wrapper = this.navbar.find('.navigation-wrapper--navbar-toggle-wrapper');
            this.hamburger = this.mobile_toggle_wrapper.find('.hamburger');
            this.side_panel = $('.side-panel');
            this.menu_mobile.find('.menu-item-has-children').addClass('mobile-item');
            this.menu_item_has_children_mobile = this.menu_mobile.find('.mobile-item');
        }

        _toggle_icon() {
            $(this.menu_item_has_children).each(function () {
                let link = $(this).find('a');
                $(link[0]).addClass('primary-link').addClass('plus-icon');
            });
            $(this.menu_item_has_megamenu).each(function () {
                let link = $(this).find('a');
                $(link[0]).addClass('primary-link').addClass('plus-icon');
            });
        }

        _navbar_fix() {
            $(COMMON.win).on('scroll', () => {
                if ($(COMMON.win).innerWidth() <= 600) {
                    let winOffset = window.pageYOffset;
                    if (winOffset >= 1) {
                        this.navbar.addClass('top-fix');
                    } else {
                        this.navbar.removeClass('top-fix');
                    }
                } else {
                    this.navbar.removeClass('top-fix');
                }
            });
            if ($(COMMON.win).innerWidth() <= 600) {
                let winOffset = window.pageYOffset;
                if (winOffset >= 1) {
                    this.navbar.addClass('top-fix');
                } else {
                    this.navbar.removeClass('top-fix');
                }
            } else {
                this.navbar.removeClass('top-fix');
            }
        }

        _desktop_megamenu() {
            this.menu_item_has_megamenu.find('.sub-menu').siblings('a').on('click', function (e) {
                e.preventDefault();
            });
            this.menu_item_has_megamenu.children('.sub-menu').addClass('primary-sub-menu');
            this.menu_item_has_megamenu.on('hover', function (e) {
                if (e.type === "mouseenter") {
                    let link = $(this).children('a');
                    $(link).addClass('active-primary-link');
                    $(this).children('.primary-sub-menu').addClass('active-sub-menu');
                } else {
                    let link = $(this).children('a');
                    $(link).removeClass('active-primary-link');
                    $(this).children('.primary-sub-menu').removeClass('active-sub-menu');
                }
            });
        }

        _desktop_sub_menu() {
            this.menu_desktop.children('.menu-item-has-children').addClass('primary-menu-item-has-children');
            this.menu_item_has_children.find('.sub-menu').siblings('a').on('click', function (e) {
                e.preventDefault();
            });
            this.menu_item_has_children.on('hover', function (e) {
                if (e.type === "mouseenter") {
                    let sub_menu = $(this).children('.sub-menu');
                    let link = $(this).find('a')[0];
                    $(link).addClass('active-primary-link');
                    $(sub_menu).addClass('active-sub-menu');
                } else {
                    let sub_menu = $(this).children('.sub-menu');
                    let link = $(this).find('a')[0];
                    $(link).removeClass('active-primary-link');
                    $(sub_menu).removeClass('active-sub-menu');
                }
            });
        }

        _mobile_menu() {
            this.hamburger.on('click', () => {
                this.menu_mobile.slideToggle();
            });
            let link = this.menu_item_has_children_mobile.children('a').addClass('link-with-icon');
            this.menu_item_has_children_mobile.find('.sub-menu').siblings('a').on('click', function (e) {
                e.preventDefault();
            });
            let parent_items = this.menu_mobile.children(this.menu_item_has_children_mobile);
            parent_items.on('click', function () {
                let sub_menu = $(parent_items).not($(this)).find('.sub-menu');
                $(parent_items).not($(this)).find('a').removeClass('active-link');
                $(parent_items).not($(this)).find('.sub-menu').slideUp();
            });
            link.on('click', function () {
                if (!$(this).hasClass('active-link')) {
                    let sub_menu = $(this).parent().find('.sub-menu')[0];
                    $(this).addClass('active-link');
                    $(sub_menu).slideDown();
                } else {
                    let sub_menu = $(this).parent().find('.sub-menu');
                    $(this).parent().find('a').removeClass('active-link');
                    $(sub_menu).slideUp();
                }
            });
        }

        _search_form() {
            let menu_items = this.menu_item;
            let width = 700;
            this.search_toggle.on('click', () => {
                let delay = 0.1;

                function toggle_items() {
                    $(menu_items).each(function () {
                        delay += 0.02;
                        let $this = $(this);
                        $this.css({
                            'transition': 'all ' + delay + 's ease'
                        });
                        $this.toggleClass('hidden-menu-item');
                    });
                }

                this.search_input_wrapper.toggleClass('active-search-input');
                if (this.search_input_wrapper.hasClass('active-search-input')) {
                    toggle_items();
                    this.search_input_wrapper.animate({
                        opacity: 1,
                        width: width,
                    }, {
                        easing: 'swing'
                    }, 115);
                } else {
                    this.search_input_wrapper.animate({
                        opacity: 0,
                        width: 0,
                    }, {
                        easing: 'swing'
                    }, 115).promise().done(function () {
                        toggle_items();
                    });
                }
            });
        }

        init() {
            this._search_form();
            this._desktop_sub_menu();
            this._desktop_megamenu();
            this._toggle_icon();
            this._mobile_menu();
            this._navbar_fix();
            $(COMMON.win).on('resize', () => {
                this._navbar_fix();
            });
        }
    }

    /* [PRIMARY CLASSES START] */
    const NAVBAR = new NAV();
    const FUNCTIONAL = new FUNC();
    const POST_TYPE_GENERAL = new POST_TYPE();
    /* [PRIMARY CLASSES END] */

    /* ### ### ### ### ### ### ### ### */

    /* [PRIMARY CLASSES INIT START] */
    $(COMMON.body).imagesLoaded({background: '.bg_img'}, function () {
        NAVBAR.init();
        FUNCTIONAL.init();
        POST_TYPE_GENERAL.init();
    });
    /* [PRIMARY CLASSES INIT END] */

    {
        let default_particles = 'particles-background';
        let digital_particles = 'digital-particles-background';
        let circles_particles = 'circles-particles-background';
        let gradient_bg = $('.gradient-background');
        let snow_particles = COMMON.doc.querySelector('.snow-particles');
        let waves_particles = COMMON.doc.querySelector('.waves-particles');
        let confetti_particles = COMMON.doc.querySelector('.confetti-particles');
        let moving_particles = COMMON.doc.querySelector('.moving-particles');
        let lines_particles = COMMON.doc.querySelector('.lines-particles');
        let gravity_particles = COMMON.doc.querySelector('.gravity-particles');
        let journey_particles = COMMON.doc.querySelector('.journey-particles');
        if ($('#' + default_particles).length) {
            FUNC.default_particles_background(default_particles);
        }
        if ($('#' + digital_particles).length) {
            FUNC.digital_particles_background(digital_particles);
        }
        if ($('#' + circles_particles).length) {
            FUNC.circles_particles_background(circles_particles);
        }
        if ($(gradient_bg).length) {
            FUNC.background_gradient(gradient_bg);
        }
        if ($(snow_particles).length) {
            FUNC.snow_particles_background($(snow_particles).parent(), snow_particles);
        }
        if ($(snow_particles).length) {
            FUNC.snow_particles_background($(snow_particles).parent(), snow_particles);
        }
        if ($(waves_particles).length) {
            FUNC.waves_particles_background(waves_particles);
        }
        if ($(confetti_particles).length) {
            FUNC.confetti_particles_background(confetti_particles);
        }
        if ($(moving_particles).length) {
            FUNC.moving_particles_background($(moving_particles).parent(), moving_particles);
        }
        if ($(lines_particles).length) {
            FUNC.lines_particles_background($(lines_particles).parent(), lines_particles);
        }
        if ($(gravity_particles).length) {
            FUNC.gravity_particles_background($(gravity_particles).parent(), gravity_particles);
        }
        if ($(journey_particles).length) {
            FUNC.space_journey_particles_background($(journey_particles).parent(), journey_particles);
        }
    }

    {
        let image_modal = $('.image-popup');
        let video_modal = $('.video-popup');
        FUNC.image_modal_init(image_modal);
        FUNC.video_modal_init(video_modal);
    }

    {
        let progress_bars_wrapper = $('.progress-bars-wrapper');
        let index = 1;
        $(progress_bars_wrapper).each(function () {
            $(this).addClass('progress-bars-wrapper' + index);
            let this_wrapper = '.progress-bars-wrapper' + index;
            let bar = $(this).find('.progress-bar-line');
            let progress_check = true;
            let progress_bar_count = $(bar).length;
            $(bar).waypoint(() => {
                if (progress_check) {
                    progress_check = false;
                    if (progress_bar_count > 0) {
                        for (let i = 1; i < progress_bar_count + 1; i++) {
                            let progress = $(this).find('.progress-bar-line' + i).data('progress');
                            FUNC.progress_bars(this_wrapper + ' ' + '.progress-bar-line' + i, progress);
                        }
                    }
                }
            }, {
                offset: '100%'
            });
            index++;
        });
    }

    {
        let counters_wrapper = $('.counters-wrapper');
        if (counters_wrapper.length) {
            for (let i = 0; i < counters_wrapper.length; i++) {
                let count = $(counters_wrapper[i]).find('.counter-box').length;
                FUNC.counters(counters_wrapper[i], count);
            }
        }
    }
});
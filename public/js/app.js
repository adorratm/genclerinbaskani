window.addEventListener('DOMContentLoaded', () => {
    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
    const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
    let anchorlinks = document.querySelectorAll('#fixingBar a[href^="#"]');

    if (anchorlinks.length > 0) {
        for (let item of anchorlinks) { // relitere 
            item.addEventListener('click', (e) => {
                e.preventDefault();
                let hashval = item.getAttribute('href');
                let target = (document.querySelector(hashval).getBoundingClientRect().top + window.pageYOffset) - ($(".main-menu-two").height() + $(".triggerFixed").height());
                if (!$(".triggerFixed").hasClass("fixed-top")) {
                    target -= $(".main-menu-two").height() + $(".main-header-two__top").height();
                }
                $("html, body").animate({
                    scrollTop: target
                }, 'slow');
                history.pushState(null, null, hashval);
            });
        }
    }


    $(window).scroll(function () {
        var windscroll = $(window).scrollTop();
        if (windscroll >= 130) {
            $('#fixingBar a').each(function (i) {
                if ($($(this).attr("href")).position().top <= windscroll - 130) {
                    $('#fixingBar a.active').removeClass('active');
                    $('#fixingBar a').eq(i).addClass('active');
                }
            });

        } else {
            $('#fixingBar a.active').removeClass('active');
            $('#fixingBar a:first').addClass('active');
        }

    }).scroll();
    $(window).on("load", function () {
        setTimeout(function () {
            let lastAnchor = window.location.href.split("/").pop().split("#").pop();
            if ($('#' + lastAnchor).length) {
                let target = (document.querySelector('#' + lastAnchor).getBoundingClientRect().top + window.pageYOffset) - ($(".main-menu-two").height() + $(".triggerFixed").height() * 2);
                history.pushState(null, null, lastAnchor);
                $('html, body').animate({
                    scrollTop: target
                }, 'slow');
            }
        }, 1000);
    });


    $("iframe").each(() => {
        $(this).attr("loading", "lazy");
        $(this).data("src", $(this).attr("src"));
        $(this).addClass("lazyload");
    });
    $(document).on("click", ".btnSubmitForm", function (e) {
        e.preventDefault();
        e.stopImmediatePropagation();
        let $this = $(this);
        $this.attr("disabled", "disabled");
        createAjax($this.data("url"), new FormData(document.getElementById("contact-form")), () => {
            $("#contact-form")[0].reset();
            $this.removeAttr("disabled");
        }, () => {
            $this.removeAttr("disabled");
        });
    });
    $(document).on("click", ".btnSubmitCareerForm", function (e) {
        e.preventDefault();
        e.stopImmediatePropagation();
        let $this = $(this);
        $this.attr("disabled", "disabled");
        createAjax($this.data("url"), new FormData(document.getElementById("career-form")), () => {
            $("#career-form")[0].reset();
            $this.removeAttr("disabled");
        }, () => {
            $this.removeAttr("disabled");
        });
    });
    $(document).on("click", ".btnSubmitPaymentForm", function (e) {
        e.preventDefault();
        e.stopImmediatePropagation();
        let $this = $(this);
        $this.attr("disabled", "disabled");
        createAjax($this.data("url"), new FormData(document.getElementById("payment-form")), function (response) {
            $(".comment-form-2").hide();
            $(".comment-form-2-iframe").html('<iframe id="paytriframe" loading="lazy" class="lazyload" data-src="https://www.paytr.com/odeme/guvenli/' + response.token + '" frameborder="0" style="min-height: 700px; width: 100%;"></iframe>');
            iFrameResize({}, '#paytriframe');
            //$("#payment-form")[0].reset();
            $this.removeAttr("disabled");
        }, () => {
            $this.removeAttr("disabled");
        });
    });
});

/** createModal */
function createModal(modalClass = null, modalTitle = null, modalSubTitle = null, width = 600, bodyOverflow = true, padding = "20px", radius = 0, headerColor = "#1c1833", background = "#fff", zindex = 1040, onOpening = function () { }, onOpened = function () { }, onClosing = function () { }, onClosed = function () { }, afterRender = function () { }, onFullScreen = function () { }, onResize = function () { }, fullscreen = true, openFullscreen = false, closeOnEscape = true, closeButton = true, overlayClose = false, autoOpen = 0) {
    if (modalClass !== "" || modalClass !== null) {
        $(modalClass).iziModal({
            title: modalTitle,
            subtitle: modalSubTitle,
            headerColor: headerColor,
            background: background,
            width: width,
            zindex: zindex,
            fullscreen: fullscreen,
            openFullscreen: openFullscreen,
            closeOnEscape: closeOnEscape,
            closeButton: closeButton,
            overlayClose: overlayClose,
            autoOpen: autoOpen,
            padding: padding,
            bodyOverflow: bodyOverflow,
            radius: radius,
            onFullScreen: onFullScreen,
            onResize: onResize,
            onOpening: onOpening,
            onOpened: onOpened,
            onClosing: onClosing,
            onClosed: onClosed,
            afterRender: afterRender
        });
    }
    $(modalClass).iziModal('setFullscreen', false);
}
/** createModal */

/** openModal */
function openModal(modalClass = null, event = function () { }) {
    $(modalClass).iziModal('open', event);
    $(modalClass).iziModal('setFullscreen', false);
}
/** openModal */

/** closeModal */
function closeModal(modalClass = null, event = function () { }) {
    $(modalClass).iziModal('setFullscreen', false);
    $(modalClass).iziModal('close', event);
}
/** closeModal */


const createAjax = (e, t, n = () => { }, o = () => { }) => {
    $.ajax({
        type: "POST",
        url: e,
        data: t,
        cache: !1,
        contentType: !1,
        processData: !1,
        dataType: "JSON"
    }).done((e) => {
        e.success ? (iziToast.success({
            title: e.title,
            message: e.message,
            position: "topCenter",
            displayMode: "once"
        }), n(e), null !== e.redirect && "" !== e.redirect && void 0 !== e.redirect && setTimeout(() => {
            window.location.href = e.redirect
        }, 2e3)) : (iziToast.error({
            title: e.title,
            message: e.message,
            position: "topCenter",
            displayMode: "once"
        }), o(e), null !== e.redirect && "" !== e.redirect && void 0 !== e.redirect && setTimeout(() => {
            window.location.href = e.redirect
        }, 2e3))
    })
}

const setCookie = (e, t, n) => {
    let o;
    if (n) {
        let e = new Date;
        e.setTime(e.getTime() + 24 * n * 60 * 60 * 1e3), o = "; expires=" + e.toGMTString()
    } else o = "";
    document.cookie = encodeURIComponent(e) + "=" + encodeURIComponent(t) + o + "; path=/"
}

const getCookie = (e) => {
    let t = encodeURIComponent(e) + "=",
        n = document.cookie.split(";");
    for (let e = 0; e < n.length; e++) {
        let o = n[e];
        for (;
            " " === o.charAt(0);) o = o.substring(1, o.length);
        if (0 === o.indexOf(t)) return decodeURIComponent(o.substring(t.length, o.length))
    }
    return null;
};

const deleteCookie = (e) => {
    setCookie(e, "", -1);
};
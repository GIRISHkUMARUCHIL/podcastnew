var iron_vars = window.iron_vars || {},
  IRON = window.IRON || {};

var AudioPlaylists = [];

var isMobile = false;
if (
  /(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|ipad|iris|kindle|Android|Silk|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i.test(
    navigator.userAgent
  ) ||
  /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(
    navigator.userAgent.substr(0, 4)
  )
) {
  isMobile = true;
}
var isiPad = /ipad/i.test(navigator.userAgent.toLowerCase());
var isiPhone = /iphone/i.test(navigator.userAgent.toLowerCase());
var isSafari = /safari/i.test(navigator.userAgent.toLowerCase());
var waypoints;
(function ($) {
  "use strict";

  IRON.XHR = {
    settings: {
      url: iron_vars.ajaxurl,
      type: "POST",
    },
  };

  IRON.state = iron_vars;
  IRON.libraries = [];
  IRON.isSonaarTheme = true;
  var DocumentTouch = window.DocumentTouch || {};
  var ResponsiveHelper = window.ResponsiveHelper || {};
  var PlaceholderInput = window.PlaceholderInput || {};
  var TouchNav = window.TouchNav || {};
  var lib = window.lib || {};



  jQuery(function () {
    /* Fancybox overlay fix */
    // detect device type
    var isTouchDevice = (function () {
      try {
        return (
          "ontouchstart" in window ||
          (window.DocumentTouch && document instanceof DocumentTouch)
        );
      } catch (e) {
        return false;
      }
    })();

    IRON.initFitVids();

    if (IRON.state.menu.menu_type == "push-menu") {
      IRON.initDropDownClasses();
      IRON.initSideMenu();
    }
    IRON.initAjaxBlocksLoad();
    if (iron_vars.header_top_menu_hide_on_scroll == 1) IRON.initTopMenu();

    IRON.initGridDisplayAlbum();
    IRON.initPusherHeight();
    IRON.initEventCenter();
    IRON.initHeadsetCenter();
    IRON.initIOSCenter();
    IRON.initCountdownLang();
    IRON.initCountdownCenter();
    IRON.initMenuHierarchy();
    IRON.initSubmenuPosition();
    IRON.initSingleDisco();
    IRON.initNewsletterLabel();
    IRON.initBackToTop();
    IRON.initScrollToSection();
    IRON.initDisableHovers();
    if (typeof window.vc_js === "function") {
      IRON.initCircleCentering();
      IRON.initVcAnimations();
      IRON.btnPlayAudio();
      //IRON.SonaarEnableFitText();
      IRON.WPBakeryFitText();
    }
    IRON.initWooImageBack();
    IRON.initWpAdminBar();
    IRON.initSocialShare();
    IRON.pjax.init();
    IRON.initPagePadding();
    IRON.initBoxedLayout();
    IRON.eventList();
    IRON.initEventListFilter();
    IRON.archiveList();
    IRON.featuredFooterPlayer();
    if (typeof IRON.initEveryTime === 'function') {
      IRON.initEveryTime();
    }
    if (IRON.state.menu.menu_type != "elementor-menu") {
      if (iron_vars.enable_fixed_header) IRON.initFixedBar();
    }

    IRON.initCustomJS();
  });

  IRON.initWpAdminBar = function () {
    if (iron_vars.wp_admin_bar) {
      $("html").addClass("wp-admin-bar");
    }
  };

  jQuery(window).on("load", function () {
    setTimeout(function () {
      jQuery(window).trigger("resize");
    }, 200);
  });

  IRON.featuredFooterPlayer = function () {
    if (srp_pluginEnable) return;

    if (IRON.sonaar.player.playlistID != "") {
      //Dont load player twice
      return;
    }

    if (iron_vars.sonaar_music.footer_playlist) {
      if (iron_vars.sonaar_music.footer_playlist_autoplay) {
        IRON.sonaar.player.setPlayer({
          id: iron_vars.sonaar_music.footer_playlist,
          autoplay: true,
          soundwave: true,
        });
      } else {
        IRON.sonaar.player.setPlayer({
          id: iron_vars.sonaar_music.footer_playlist,
          autoplay: false,
          soundwave: true,
        });
      }
    }
    if (iron_vars.sonaar_music.footer_podcast) {
      if (iron_vars.sonaar_music.footer_podcast_autoplay) {
        IRON.sonaar.player.setPlayer({
          id: iron_vars.sonaar_music.footer_podcast,
          autoplay: true,
          soundwave: true,
        });
      } else {
        IRON.sonaar.player.setPlayer({
          id: iron_vars.sonaar_music.footer_podcast,
          autoplay: false,
          soundwave: true,
        });
      }
    }
  };

  IRON.initSocialShare = function () {
    if ($(".sharing_toolbox").length) {
      if (iron_vars.social_enabled == "1") {
        var image = $(".sharing_toolbox").data("image-social");
        var url = document.URL;
        var shareFacebook = "";
        var shareTwitter = "";
        var shareGoogle = "";
        var shareLinkedin = "";
        var sharePinterest = "";

        if (
          Object.prototype.hasOwnProperty.call(iron_vars.social, "facebook")
        ) {
          shareFacebook =
            '<a title="Share on Facebook" class="shareFacebook" href="http://www.facebook.com/sharer/sharer.php?u=' +
            url +
            '" target="_blank"><i class="fa-brands fa-facebook-square" aria-hidden="true"></i></a>';
        }
        if (Object.prototype.hasOwnProperty.call(iron_vars.social, "twitter")) {
          shareTwitter =
            '<a title="Share on Twitter" class="shareTwitter" href= " ' +
            encodeURI(
              "https://twitter.com/intent/tweet?url=" +
              url +
              "&text=" +
              document.title
            ) +
            ' " target="_blank"><i class="fa-brands fa-square-x-twitter" aria-hidden="true"></i></a>';
        }
        if (
          Object.prototype.hasOwnProperty.call(iron_vars.social, "linkedin")
        ) {
          shareLinkedin =
            '<a title="Share on LinkedIn" class="shareLinkedin" href="http://www.linkedin.com/shareArticle?mini=true&url=' +
            url +
            '" target="_blank"><i class="fa-brands fa-linkedin" aria-hidden="true"></i></a>';
        }
        if (
          Object.prototype.hasOwnProperty.call(iron_vars.social, "pinterest")
        ) {
          sharePinterest =
            '<a title="Share on Pinterest" class="sharePinterest" href="https://pinterest.com/pin/create/bookmarklet/?url=' +
            url +
            "&description=" +
            document.title +
            "&media=" +
            image +
            '" target="_blank"><i class="fa-brands fa-pinterest-square" aria-hidden="true"></i></a>';
        }

        $(".sharing_toolbox").append(
          shareFacebook +
          shareTwitter +
          shareGoogle +
          shareLinkedin +
          sharePinterest
        );
      }
    }
  };

  IRON.pagination = {
    XHR: {},
    $: {},
    loadingClass: "ajax-load",
    ajaxBusy: false,
  };

  IRON.pagination.XHR = {
    done: function (response, status, xhr) {
      // success : data, status, xhr

      var IB = IRON.pagination;

      if (response) {
        IB.$.container.append(response).fadeIn();

        var newMoreButton = IB.$.container.find(".button-more");
        if (newMoreButton.length > 0) {
          IB.$.loadButton.replaceWith(newMoreButton[0].outerHTML);
          newMoreButton.remove();
          IB.$.loadButton = $(".button-more");
        } else {
          IB.$.loadButton.remove();
        }

        IB.ajaxBusy = false;

        //IRON.initTouchNav();

        var callbacks = IB.$.loadButton.data("callback");
        if (callbacks) {
          callbacks = callbacks.split(",");

          for (var i = 0; i < callbacks.length; i++) {
            var callback = IRON[callbacks[i]];

            if (typeof callback === "function") {
              callback();
            }
          }
        }

        if (IB.method == "paginate_scroll") {
          $(document).on("scroll", function (event) {
            if (!IB.ajaxBusy) {
              var $win = $(this),
                $doc = $(document),
                $foot = $("body > footer");

              if (
                $win.scrollTop() >=
                $doc.height() - $win.height() - $foot.height()
              ) {
                IB.$.loadButton.click();
              }
            }
          });
        } else {
          IB.$.loadButton.css("visibility", "visible").fadeIn();
        }

        IRON.initAjaxBlocksLoadEvent();
      } else {
        IB.$.loadButton.remove();
        IB.XHR.fail(xhr, "error", 404);
      }
    },
    fail: function (xhr, status, error) {
      // error : xhr, status, error

      var IB = IRON.pagination;

      setTimeout(function () {
        alert(IB.$.loadButton.data("warning"));
      }, 100);
    },
    always: function () {
      // complete : data|xhr, status, xhr|error

      var IB = IRON.pagination;
      IB.$.loadButton.prop("disabled", false);

      IB.$.container.removeClass(IB.loadingClass);
    },
    before: function (xhr) {
      var IB = IRON.pagination;
      IB.$.loadButton.prop("disabled", true);
    },
  };

  IRON.RemoveHrefFromMenu = function () {
    /* Remove link on ancestor item from responsive menu */
    if (
      (!iron_vars.menu.unveil_all_mobile_items &&
        ($(".responsive-header").length || $(".side-menu").length)) ||
      $(".sr-e-menu.sr-menu--vertical").length
    ) {
      if ($(".sr-e-menu.sr-menu--vertical").length) {
        $(".sr-e-menu.sr-menu--vertical .menu-item-has-children>a").attr(
          "href",
          "#"
        );
      } else {
        $(".menu-item-has-children>a").attr("href", "#");
      }
    }
  };

  IRON.initPagePadding = function () {
    var applyPadding =
      !IRON.state.responsive &&
        !IRON.state.menu.classic_menu_over_content &&
        !IRON.state.taxonomy.banner
        ? true
        : false;

    if (IRON.state.menu.menu_type == "classic-menu") {
      var heightPadding = $(".classic-menu").outerHeight(true);
      var mainMenuDivHeight = $("#menu-main-menu").height();

      if (
        IRON.state.logo.page_logo_select == "light" ||
        (IRON.state.logo.page_logo_select == false &&
          IRON.state.logo.logo_select == "light")
      ) {
        var logoHeight = iron_vars.logo.logo_height.light;
      } else {
        var logoHeight = iron_vars.logo.logo_height.dark;
      }

      if (iron_vars.menu.classic_menu_logo_align == "pull-center") {
        //Set #wapper padding-top when logo is set to center
        if (mainMenuDivHeight < logoHeight) {
          heightPadding = heightPadding - mainMenuDivHeight + logoHeight;
        }
      }
      if (iron_vars.menu.classic_menu_logo_align == "pull-top") {
        //Set #wapper padding-top when logo is set to center&above
        const currentLogoHeight = ($(".classic-menu .logo").length)? $(".classic-menu .logo").outerHeight() : 0;
        heightPadding =
          logoHeight + heightPadding - currentLogoHeight;
      }

      if (!applyPadding) {
        $("#wrapper").css("padding-top", "0");
        return;
      } else {
        $("#wrapper").css("padding-top", heightPadding + "px");
      }
    } else if (IRON.state.menu.menu_type === "elementor-menu") {
      if ($("#wrapper").hasClass("sr_it-padtop"))
        $("#wrapper").removeClass("sr_it-padtop");

      if (applyPadding) {
        $('.sr-header').css("position", "relative");
      } else {
        $('.sr-header').css("position", "absolute");
      }
    } else {
      if (!applyPadding) {
        if ($("#wrapper").hasClass("sr_it-padtop"))
          $("#wrapper").removeClass("sr_it-padtop");
        return;
      } else {
        if (!$("#wrapper").hasClass("sr_it-padtop"))
          $("#wrapper").addClass("sr_it-padtop");
      }
    }
  };

  $(window).resize(IRON.initPagePadding);

  IRON.initFixedBar = function () {
    if (document.getElementById("wrapper")) {
      var top = 0;
      var waypoint = new Waypoint({
        element: document.getElementById("wrapper"),
        handler: function (direction) {
          if (direction == "down") {
            $("#fixed-panel").animate(
              {
                opacity: "1",
                top: top,
              },
              400
            );
          } else if (direction == "up") {
            $("#fixed-panel").animate(
              {
                opacity: "0",
                top: "-78",
              },
              200
            );
          }
        },
        offset: -1,
      });
    }
  };

  IRON.initAjaxBlocksLoad = function () {
    IRON.pagination.XHR.request = {
      dataType: "text",
      data: {
        ajax: 1,
      },
      beforeSend: IRON.pagination.XHR.before,
    };

    IRON.pagination.XHR.request = $.extend(
      true,
      IRON.pagination.XHR.request,
      IRON.XHR.settings
    );
    IRON.initAjaxBlocksLoadEvent();

    $("a.button-more").trigger("click");
  };

  IRON.initAjaxBlocksLoadEvent = function () {
    $(document).off("click", "a.button-more");
    $(document).on("click", "a.button-more", function (e) {
      e.preventDefault();

      var IB = IRON.pagination,
        $this = $(this);

      if (IB.ajaxBusy) return;

      IB.$.loadButton = $this;
      IB.$.container = $("#" + IB.$.loadButton.data("rel"));
      IRON.pagination.XHR.request.url = IB.$.loadButton.attr("href");
      IRON.XHR.settings.url = IB.$.loadButton.attr("href");

      IB.method = $this.data("paginate");

      $.ajax(IB.XHR.request)
        .done(IB.XHR.done)
        .fail(IB.XHR.fail)
        .always(IB.XHR.always);
    });
  };

  // add classes if item has dropdown
  IRON.initDropDownClasses = function () {
    jQuery(".side-menu #nav li").each(function () {
      var item = jQuery(this);
      var drop = item.find("ul");
      var link = item.find("a").eq(0);
      if (drop.length) {
        item.addClass("has-drop-down");
        if (link.length) {
          link.addClass("has-drop-down-a");
        }
      }
    });
  };

  // handle flexible video size
  IRON.initFitVids = function () {
    if (jQuery(".video-block").length) {
      jQuery(".fit-vids-style").remove();
      jQuery(".video-block").fitVids();
    }
  };

  IRON.initBoxedLayout = function () {
    if (!jQuery("#wrapper").find("#page-banner.container").length) return;

    var padding = jQuery("#wrapper")
      .find("#page-banner.container")
      .css("padding-left")
      .slice(0, -2);
    jQuery("#wrapper")
      .find("#page-banner.container .page-banner-bg")
      .css({
        "margin-left": "-" + padding + "px",
        width: "calc(100% + " + padding * 2 + "px)",
      });
  };

  // Animation for side menu

  IRON.animation = {
    right: {
      perspective: anime({
        targets: ["#pusher", "#overlay .perspective"],
        translateX: 0,
        translateY: 0,
        translateZ: -1000,
        rotateY: 15,
        autoplay: false,
        easing: "linear",
        duration: 350,
      }),
    },
    left: {
      perspective: anime({
        targets: ["#pusher", "#overlay .perspective"],
        translateX: 0,
        translateY: 0,
        translateZ: -1000,
        rotateY: -15,
        autoplay: false,
        easing: "linear",
        duration: 350,
      }),
    },
    overlay: anime.timeline({
      autoplay: false,
      direction: "alternate",
      loop: false,
    }),
  };

  IRON.animation.overlay
    .add({
      targets: ".side-menu",
      opacity: [0, 1],
      duration: 800,
      elasticity: 0,
      easing: "linear",
      offset: 1,
    })
    .add({
      targets: ".content-menu",
      opacity: [0, 1],
      scale: [0.9, 1],
      duration: 250,
      offset: "-=250",
      easing: "linear",
      elasticity: 100,
    });

  if (IRON.state.menu.menu_type == "push-menu") {
    $(window).resize(function () {
      IRON.initSideMenu();
      if (
        $(".side-menu.type2 .content-menu").outerHeight(true) >
        $(window).height()
      ) {
        $(".side-menu.type2").addClass("smallOverlay");
      } else if ($(".side-menu.type2").hasClass("smallOverlay")) {
        $(".side-menu.type2").removeClass("smallOverlay");
      }
    });
  }

  /* SIDE MENU */
  IRON.initSideMenu = function () {
    var typeside = iron_vars.menu.top_menu_position;
    var typeclass = iron_vars.menu.menu_transition;
    var mobile = false;

    if ($(window).width() < 1144) {
      var mobile = true;
      typeclass = "type2";
    }

    var bodyScroll = {};
    var pusherScroll = {};

    jQuery(".side-menu, #pusher")
      .removeClass("type1")
      .removeClass("type2")
      .removeClass("type3");
    jQuery(".site-logo,.menu-toggle,.side-menu,#pusher").addClass(typeside);
    jQuery(".side-menu, #pusher").addClass(typeclass);

    jQuery(".pusher-type-push-menu, .menu-toggle")
      .off("click")
      .on("click", function (event) {
        if (jQuery(this).attr("id") == "pusher-wrap") {
          if (!jQuery(this).hasClass("pusher-type-push-menu")) {
            return;
          } else if (!jQuery("#pusher").hasClass("open")) {
            return;
          }
        }
        if (!$(".side-menu").hasClass("open")) {
          var bodyScroll = $(document).scrollTop();

          event.preventDefault();
          var timeout = 1;

          setTimeout(function () {
            if (typeclass == "type3") {
              IRON.animation.right.perspective.reset();
              IRON.animation.right.perspective.play();
              $("body").addClass("pushMenu");
              jQuery(".site-logo").css("opacity", "0");
              jQuery(".header-top-menu").fadeOut();
              jQuery("#pusher").addClass("open");
              $(".side-menu").css("opacity", "1");
              $(".content-menu").css("transform", "scale(1)");
              $(".content-menu").css("opacity", "1");
              $("#pusher").scrollTop(bodyScroll);
            }

            if (typeclass == "type2") {
              if ($(window).width() < 769) {
                $("body").css("overflow", "hidden");
              }
              IRON.animation.overlay.reset();
              IRON.animation.overlay.play();
              jQuery("#pusher").addClass("open");
              $("#pusher").scrollTop(bodyScroll);
            }
            jQuery(".menu-toggle").addClass("toggled");
            jQuery("#pusher").addClass(typeclass);
            jQuery(".side-menu").addClass("open");
          }, 1);
        }

        if ($(".side-menu").hasClass("open")) {
          var pusherScroll = $("#pusher").scrollTop();

          if (typeclass == "type3") {
            IRON.animation.right.perspective.reverse();
            IRON.animation.right.perspective.play();

            $("body").removeClass("pushMenu");
            jQuery(".panel-networks").css("opacity", "1");
            jQuery(".site-logo").css("opacity", "1");
            jQuery(".header-top-menu").fadeIn();

            jQuery(".side-menu").removeClass("open");

            setTimeout(function () {
              $("#pusher").removeClass("open");
              $(document).scrollTop(pusherScroll);
            }, 350);

            setTimeout(function () {
              jQuery(".nav-menu li a, ul.nav-menu ul a, .nav-menu ul ul a").css(
                "pointer-events",
                "auto"
              );
              jQuery("ul.nav-menu a").css("opacity", "1");
              jQuery(".sub-menu").removeClass("active");
            }, 1200);
          }
          if (typeclass == "type2") {
            if ($(window).width() < 769) {
              $("body").css("overflow", "auto");
            }

            IRON.animation.overlay.reverse();
            IRON.animation.overlay.play();

            setTimeout(function () {
              $("#pusher").removeClass("open");
              jQuery(".side-menu").removeClass("open");
              jQuery(".nav-menu li a, ul.nav-menu ul a, .nav-menu ul ul a").css(
                "pointer-events",
                "auto"
              );
              jQuery("ul.nav-menu a").css("opacity", "1");
              jQuery(".sub-menu").removeClass("active");
              if (mobile == true && !$("body").hasClass("elementor-page")) {
                //Dont on desktop if Elementor is used
                $(document).scrollTop(pusherScroll);
              }
            }, 1200);
          }
          if (typeclass == "type1") {
            $("#pusher").removeClass("open");
            jQuery(".side-menu").removeClass("open");
            jQuery(".nav-menu li a, ul.nav-menu ul a, .nav-menu ul ul a").css(
              "pointer-events",
              "auto"
            );
            jQuery("ul.nav-menu a").css("opacity", "1");
            jQuery(".sub-menu").removeClass("active");
          }

          jQuery(".menu-toggle").removeClass("toggled");
        }
      });
    jQuery(".side-menu").css("display", "block");

    jQuery('.side-menu .menu-item:not(.has-drop-down) a[href*="#"]').click(
      function () {
        jQuery(".menu-toggle.toggled").trigger("click");
      }
    );
  };
  //
  IRON.initTopMenu = function () {
    $(document).on("scroll", function () {
      if ($(this).scrollTop() >= 400) {
        jQuery(".header-top-menu").stop().animate(
          {
            top: "-100px",
            opacity: 0,
          },
          600
        );
      } else {
        if ($("html").hasClass("wp-admin-bar")) {
          var topHeight = "31px";
        } else {
          var topHeight = "0px";
        }
        jQuery(".header-top-menu").stop().animate(
          {
            top: topHeight,
            opacity: 1,
          },
          600
        );
      }
    });
  };

  /* CIRCLE CENTERING */
  IRON.initCircleCentering = function () {
    jQuery(".centering, .circle .wpb_wrapper").each(function () {
      var halfheight = jQuery(this).height() / 2;
      jQuery(this).css("margin-top", -halfheight);
    });

    jQuery(window).resize(function () {
      if (jQuery(".circle").length > 0) {
        if (jQuery(window).innerWidth() < 660) {
          jQuery(".circle").each(function () {
            jQuery(this).closest(".wpb_column").css({
              float: "none",
              "margin-left": "0",
              width: "100%",
            });
          });
        } else {
          jQuery(".circle").each(function () {
            jQuery(this).closest(".wpb_column").removeAttr("style");
          });
        }
      }
    });
  };

  /* MUSIC ALBUM GRID DISPLAY */
  IRON.initGridDisplayAlbum = function () {
    setTimeout(function () {
      jQuery(".two_column_album").each(function () {
        var leftColumnHeight = 0;
        var rightColumnHeight = 0;
        var $articles = jQuery(this).find(".media-block");
        for (var i = 0; i < $articles.length; i++) {
          if (leftColumnHeight > rightColumnHeight) {
            rightColumnHeight += $articles
              .eq(i)
              .addClass("right")
              .outerHeight(true);
          } else {
            leftColumnHeight += $articles.eq(i).outerHeight(true);
          }
        }
        jQuery(this).css("visibility", "visible");
      });
    }, 250);
    setTimeout(function () {
      jQuery(".two_column_album .media-block").css("opacity", "1");
    }, 250);
  };

  // pjax

  IRON.btnPlayAudio = function () {
    if (srp_pluginEnable) return;

    jQuery(".pjax-container").on(
      "click",
      '.vc_btn3[data-album="1"]',
      function () {
        event.preventDefault();
        IRON.sonaar.player.setPlaylist(jQuery(this), 0);
      }
    );
  };

  IRON.fetch_Oembed = function () {
    if ($(".sr_it-videolist-screen").length) {
      $(document).off("click", ".sr_it-videolist-list article");
      $(document).on("click", ".sr_it-videolist-list article", function (e) {
        e.preventDefault();
        var oembedURL = $(this).attr("data-url");

        jQuery.post(
          iron_vars.ajaxurl,
          {
            action: "fetch_Oembed",
            oembedURL: oembedURL,
          },
          function (data, textStatus, xhr) {
            if ("success" == textStatus && data.length) {
              $(".sr_it-videolist-screen").html(data);
            }
          }
        );
      });
    }
  };

  IRON.fetch_Oembed();

  IRON.grid_column = function () {
    $.each(IRON.grid, function (index, value) {
      value.inview.destroy();
      value.inviewBottom.destroy();

      if (value.rellax.hasOwnProperty("destroy")) value.rellax.destroy();
    });

    IRON.grid = [];
    if ($(".iron_widget_grid").length) {
      $(".sr_it-grid").each(function (e, el) {
        var grid = $(this);
        var column = grid.attr("data-column");
        var parallax = grid.attr("data-parallax");
        var speeds = JSON.parse(grid.attr("data-parallax-speed"));
        var gridClassMap = grid
          .attr("class")
          .split(" ")
          .map(function (elclass) {
            return "." + elclass + "";
          });

        for (var i = 1; i <= column; i++) {
          var colunmContainer = $("<div/>", {
            class: "sr_it-column-" + column + " rellax sr_it-col-" + i + "",
            "data-rellax-speed": speeds[i - 1],
            "data-rellax-percentage": "0",
          }).appendTo(grid);

          var elements = grid.find(
            "article:not(.columnyse):nth-of-type(" + column + "n+" + i + ")"
          );
          elements.clone().appendTo(colunmContainer).addClass("columnyse");
        }

        var elementsBoom = grid.find(
          "article:not(.sr_it-column-" + column + " article)"
        );
        elementsBoom.remove();

        if (grid.attr("data-parallax") === "0" || $(window).width() < 768) {
          grid.addClass("columnactive");
        }
        if (grid.attr("data-parallax") !== "0" && $(window).width() > 768) {
          var gridObj = {
            inview: {},
            inviewBottom: {},
            rellax: {},
          };

          grid.addClass("columnactive");

          gridObj.inview = new Waypoint({
            element: grid[0],
            handler: function (direction) {
              if ("up" === direction) {
                gridObj.rellax.destroy();
                // grid.removeClass('columnactive')
              }
              if ("down" === direction) {
                gridObj.rellax = new Rellax("#" + grid[0].id + " .rellax");
                // grid.addClass('columnactive')
              }
            },
            offset: function () {
              return Waypoint.viewportHeight() + 0;
            },
          });
          gridObj.inviewBottom = new Waypoint({
            element: grid[0],
            handler: function (direction) {
              if ("up" === direction) {
                gridObj.rellax = new Rellax("#" + grid[0].id + " .rellax");
                // grid.addClass('columnactive')
              }
              if ("down" === direction) {
                gridObj.rellax.destroy();
                // grid.removeClass('columnactive')
              }
            },
            offset: function () {
              return -(
                this.element.clientHeight +
                Waypoint.viewportHeight() / 2
              );
            },
          });

          IRON.grid.push(gridObj);
        }
      });
    }
  };

  IRON.grid_column();
  IRON.eventList = function () {
    if (window.matchMedia("(max-width: 768px)").matches) return;

    if (!$("section.concerts-list").length) return;

    $('[data-countdown="true"] .event-link')
      .mouseenter(function () {
        var countdownWidth =
          $(this).find(".event-list-countdown").outerWidth() -
          $(this).find(".sr-it-event-date").width();
        $(this)
          .find(".sr-it-event-date")
          .css("padding-left", countdownWidth - 18);
        $(this).find(".event-list-countdown").css("opacity", "1");
        if ($(this).attr("data-countdown-bg-transparency") == "false") {
          $(this).find(".sr_it-event-main").css("border-left-width", "0px");
        }
        $(this)
          .parents(".event")
          .find(".sr_it-event-buttons:not(.sr_it-vertical-align)")
          .attr(
            "data-padding",
            $(this)
              .parents(".event")
              .find(".sr_it-event-buttons")
              .css("padding-left")
          )
          .css(
            "padding-left",
            $(this).find(".event-list-countdown").outerWidth()
          );
      })
      .mouseleave(function () {
        $(this).find(".sr-it-event-date").css("padding-left", "12px");
        $(this).find(".event-list-countdown").css("opacity", "0");
        if ($(this).attr("data-countdown-bg-transparency") == "false") {
          $(this).find(".sr_it-event-main").css("border-left-width", "1px");
        }
        $(this)
          .parents(".event")
          .find(".sr_it-event-buttons:not(.sr_it-vertical-align)")
          .css(
            "padding-left",
            $(this)
              .parents(".event")
              .find(".sr_it-event-buttons")
              .attr("data-padding")
          )
          .removeAttr("data-padding");
      });

    var eventInfoWider = 2000;
    var eventDateWider = 0;
    $(".concerts-list .event").each(function () {
      var eventButtonWidth = $(this).find(".sr_it-event-buttons").outerWidth();
      if ($(this).parents("#sidebar").length) {
        $(this).attr("data-countdown", false);
      }

      if ($(this).attr("data-countdown") == "true") {
        var eventMainZoneWidth =
          $(this).find(".event-link").width() -
          $(this).find(".event-list-countdown").outerWidth();
      } else {
        var eventMainZoneWidth =
          $(this).find(".event-link").width() -
          $(this).find(".sr-it-event-date").outerWidth();
      }
      var eventSpaceAvalaible =
        eventMainZoneWidth - $(this).find("h1").outerWidth();

      $(this)
        .find(".sr_it-event-main")
        .css("max-width", eventMainZoneWidth - 50);

      if (eventButtonWidth >= eventSpaceAvalaible) {
        $(".sr_it-event-buttons")
          .removeClass("sr_it-vertical-align")
          .css({
            padding: "6px 5px 5px 5px",
            "padding-left": $(".sr-it-event-date").outerWidth() + 10,
          });
      }
      if (eventInfoWider > eventMainZoneWidth - eventButtonWidth) {
        eventInfoWider = eventMainZoneWidth - eventButtonWidth;
      }
      if ($(this).find(".sr-it-event-date").width() > eventDateWider) {
        eventDateWider = $(this).find(".sr-it-event-date").width();
      }
    });
    $(".sr_it-event-info").css("max-width", eventInfoWider);
    $(".sr-it-event-date").css("width", eventDateWider + 5);
  };

  IRON.eventsFilter = function () {
    if (jQuery(".events-bar").length) {
      jQuery(document).on(
        "change",
        ".events-bar #artists_filter",
        this,
        function (e) {
          var $bar = jQuery(this).parents(".events-bar");
          var $list = jQuery(this)
            .parents(".events-bar")
            .next(".concerts-list");
          var artist_id = jQuery(this).val();

          if (artist_id == "all") {
            $list.find(".nothing-found").remove();
            $list.find("article").fadeIn();
          } else {
            $list.find("article").hide();
            $list.find(".nothing-found").remove();
            if ($list.find("article.artist-" + artist_id).length) {
              $list.find("article.artist-" + artist_id).fadeIn();
            } else {
              var noFind = jQuery("<article/>", {
                text: iron_vars.i18n.no_events,
                class: "nothing-found",
              });
              $list.find(".nothing-found").remove();
              $list.append(noFind);
            }
          }
        }
      );
    }
  };
  IRON.archiveList = function () {
    //Used by the podcast archive widget
    /*//list.js required
      DOM compositon required: 
    <id="REQUIRED" class="table-list-container" data-item-per-page="OPTIONAL"> <class="list"> {{LIST}} </> {{PARTS/PAGINATION}} </>
    */

    $(".sonaar-list.table-list-container").each(function (index) {
      if (typeof $(this).attr("data-item-per-page") !== "undefined") {
        var itemPerPage = $(this).attr("data-item-per-page");
      } else {
        var itemPerPage = 10;
      }

      var slugParameter = "?sr-podcast-id=" + index + "&sr-page=";

      var widget = this;

      var options = {
        //valueNames: [ 'sonaar-podcast-list-content'],//Required this parameter for the SEARCH Feature
        page: itemPerPage,
        pagination: {
          innerWindow: 1,
          left: 0,
          right: 0,
          paginationClass: "pagination",
        },
      };

      var tableList = new Array();
      tableList[index] = new sonaarList(this.id, options);
      var lastPage = Math.ceil(tableList[index].items.length / options.page);

      function setUrl(adjustment) {
        var pageNumber =
          Math.floor(tableList[index].i / options.page) + 1 + adjustment;
        if (pageNumber < 1) {
          pageNumber = 1;
        }
        if (pageNumber > lastPage) {
          pageNumber = lastPage;
        }
        hideButton(pageNumber);
        var url = window.location.href.split(slugParameter)[0];
        var urlEnd = window.location.href.split(slugParameter)[1];
        url = url + slugParameter + pageNumber;
        if (typeof urlEnd !== "undefined") {
          urlEnd = urlEnd.split("?")[1];
          if (typeof urlEnd !== "undefined") {
            url = url + "?" + urlEnd;
          }
        }
        window.history.pushState({}, "", url);
      }

      function hideButton(pageNumber) {
        $(widget).find(".sonaar-pagination .disabled").removeClass("disabled");
        if (pageNumber >= lastPage) {
          $(widget).find(".sr-paginateNext").addClass("disabled");
        }
        if (pageNumber <= 1) {
          $(widget).find(".sr-paginateBack").addClass("disabled");
        }
      }

      $(widget)
        .find(".sr-paginateNext")
        .on("click", function () {
          setUrl(1);
          var list = $(widget).find(".pagination").find("li");
          $.each(list, function (position, element) {
            if ($(element).is(".active")) {
              $(list[position + 1]).trigger("click");
            }
          });
        });

      $(widget)
        .find(".sr-paginateBack")
        .on("click", function () {
          setUrl(-1);
          var list = $(widget).find(".pagination").find("li");
          $.each(list, function (position, element) {
            if ($(element).is(".active")) {
              $(list[position - 1]).trigger("click");
            }
          });
        });

      $(document).ready(function () {
        if (window.location.href.includes(slugParameter)) {
          var slugPageNumber =
            window.location.href.split(slugParameter)[1].split(/\D/g)[0] - 1; // "/\D/g" regular expression = non-digits
          var currentItems = slugPageNumber * options.page + 1;
          tableList[index].show(currentItems, options.page);
          hideButton(slugPageNumber + 1);
        } else {
          hideButton(1);
        }
      });

      $(this).show();
    });
  };

  IRON.initEventListFilter = function () {
    IRON.eventListjs = [];

    if ($("section.concerts-list").length) {
      $("section.concerts-list").each(function () {
        var eventList = $(this).parents(".iron_widget_events");
        var eventnbr = $(this).data("eventnbr");

        if ($(this).parents(".widget-area").length) {
          // only for event widget located in a widget area
          var i = 0;
          $(this)
            .find("article")
            .each(function () {
              if (i < eventnbr) {
                $(this).show();
              }
              i++;
            });
        }

        var options = {
          valueNames: ["artistsList"],
          listClass: "concerts-list",
        };

        if (eventnbr > 0) {
          options.pagination = true;
          options.page = eventnbr;
        }

        eventList.listjs = new sonaarList(eventList.attr("id"), options);
        IRON.eventListjs.push(eventList);

        if (eventList.listjs.items.length > eventnbr && eventnbr > 0) {
          var pagination = $("<div>", {
            class: "event-pagination",
          }).appendTo(eventList);

          var prev = $("<button>", {
            class: "pagination-previous",
            html: "<span>" + iron_vars.i18n.events.pagination.prev + "</span>",
            click: function () {
              eventList.listjs.show(eventList.listjs.i - eventnbr, eventnbr);
              updateNavigation();
            },
          }).prependTo(eventList.find(".event-pagination"));

          var next = $("<button>", {
            class: "pagination-next",
            html: "<span>" + iron_vars.i18n.events.pagination.next + "</span>",
            click: function () {
              eventList.listjs.show(eventList.listjs.i + eventnbr, eventnbr);
              updateNavigation();
            },
          }).appendTo(eventList.find(".event-pagination"));

          var updateNavigation = function () {
            prev.show();
            next.show();
            if (eventList.listjs.i <= 1) {
              prev.hide();
              next.show();
            }

            if (
              eventList.listjs.i >=
              eventList.listjs.items.length - (eventnbr - 1)
            ) {
              prev.show();
              next.hide();
            }
          };
          updateNavigation();
        }

        if (eventList.find(".events-bar-artists").length) {
          var select = eventList.find(".events-bar-artists select");

          select.on("change", function () {
            var searchValue =
              $(this).val() !== "all"
                ? $(this).find("option:selected").text().trim()
                : false;
            if (searchValue) {
              eventList.listjs.search(searchValue, ["artistsList"]);
            } else {
              eventList.listjs.search();
            }
          });
        }
      });
    }
  };

  IRON.srpInit = function () {

    if (srp_pluginEnable) {
      setStickyPlayer();
    }
    setIronAudioplayers();
  }

  IRON.pjax = {
    oldDocument: "",
    newDocument: "",
    enablePjax: IRON.state.enable_ajax,

    defaultBarba: function () {
      var pjax = this;
      var originalFn = Barba.Pjax.Dom.parseResponse;
      var originalCheck = Barba.Pjax.preventCheck;

      Barba.Pjax.Dom.wrapperId = "pusher";
      Barba.Pjax.Dom.containerClass = "pjax-container";
      Barba.Pjax.ignoreClassLink = "no-ajax";

      Barba.Pjax.Dom.parseResponse = function (response) {
        pjax.oldDocument = window.document;
        var parser = new DOMParser();
        pjax.newDocument = parser.parseFromString(response, "text/html");

        return originalFn.apply(Barba.Pjax.Dom, arguments);
      };

      Barba.Pjax.preventCheck = function (evt, element) {
        if (
          element == null ||
          element.hasAttribute("data-vc-container") ||
          element.hasAttribute("data-slide")
        ) {
          return false;
        }

        var elementToAvoidList = $(
          '#wpadminbar a, .esgbox, .link-mode-inline a, .link-mode-lightbox a, .languages-selector a, .lang-item a, wpml-ls-menu-item a, .no-ajax a, .srmp3-product a.woocommerce-LoopProduct-link, .elementor-widget-gallery a, .elementor-widget-media-carousel a, a.bwg-a, a[download], .elementor-image-gallery a[data-elementor-open-lightbox="yes"], .uael-grid-item-content a, a.fancybox, a.lae-lightbox-item, a.envira-gallery-link'
        );
        var YouCanGo = true;

        elementToAvoidList.each(function (e, el) {
          if (el == element) YouCanGo = false;
        });

        // disable the ajax when we use the elementor editor to avoid annoying clicks on buttons
        if (typeof window.elementorFrontend === "object") {
          if (elementorFrontend.isEditMode()) YouCanGo = false;
        }

        if (element.attributes.href.value.indexOf("?add-to-cart=") !== -1)
          YouCanGo = false;

        if (element.attributes.href.value.indexOf("wp-login.php") !== -1)
          YouCanGo = false;

        if (!$("body").hasClass("elementor-page")) {
          //Dont use the theme animation if Elementor is used

          //if (element.hash != '' && element != null) {
          if (
            element.hash != "" &&
            element != null &&
            element.hash.includes("#elementor-action") !== true
          ) {
            var scrollToElement = $(element.hash).offset();
            var topPosition = scrollToElement.top;

            if (jQuery(".classic-menu").length)
              var topPosition =
                topPosition - jQuery(".classic-menu").outerHeight();

            if ($(".side-menu").hasClass("open")) {
              $(".menu-toggle").trigger("click");
            }

            $("html, body").animate(
              {
                scrollTop: topPosition,
              },
              800
            );
          }
        }

        if (!YouCanGo) return YouCanGo;

        return originalCheck.apply(Barba.Pjax, arguments);
      };
    },

    init: function () {
      var pjax = this;
      pjax.defaultBarba();

      if (pjax.enablePjax && !$("body").hasClass("woocommerce-page")) {
        if (document.getElementById("wrapper")) {
          Barba.Pjax.start();
          $("body").addClass("pjax");
        }
      } else {
        $("body").addClass("no-pjax");
      }

      Barba.Pjax.getTransition = function () {
        return pjax.HideShowTransition();
      };

      Barba.Dispatcher.on("transitionCompleted", function () {
        pjax.customJs();
        IRON.initCustomJS();
        IRON.initCountdownLang();
        IRON.initCountdownCenter();
        IRON.initPagePadding();
        pjax.ironAudioPlayer();
        pjax.wooCommerce();
        IRON.initBoxedLayout();
        IRON.eventList();
        IRON.initEventListFilter();
        IRON.archiveList();
        if (typeof IRON.initEveryTime === 'function') {
          IRON.initEveryTime();
        }
        IRON.eventsFilter();
        if (srp_pluginEnable || srp_pluginWidgetPlayer) {
          IRON.srpInit();
        }

        if (typeof window.elementorFrontend === "object") {
          elementorFrontend.init();
        }

        if (typeof window.vc_js === "function") {
          window.vc_js();
          //IRON.SonaarEnableFitText();
          IRON.WPBakeryFitText();
          IRON.btnPlayAudio();
          pjax.vc_slide();
        }

        if (typeof window.gambitLoadRowSeparators === "function") {
          window.gambitLoadRowSeparators();
        }

        IRON.grid_column();
      });

      Barba.Dispatcher.on("initStateChange", function () {

        if ($(".sr-offcanvas-toggle-wrap").length > 0) {
          SrOffCanvasContent.prototype.close();
        }

        if ($(".elementor-widget-sr-e-menu").length > 0) {
          IRON.toggleElementorMenuClose();
        }
        if (typeof ga === "function") {
          ga("send", "pageview", location.pathname);
        }
        if ($(".elementor-nav-menu--main")[0]) {
          if (typeof $.SmartMenus.destroy === "function") {
            $.SmartMenus.destroy();
          }
        }
      });

      Barba.Dispatcher.on("newPageReady", function () {
        pjax.swapMenuClass();
        pjax.swapWPAdminbar();
        pjax.swapLanguageLink();
        pjax.transfertAudio();
        pjax.cleanHtml();
        pjax.updateState();

        if (IRON.state.menu.menu_type == "classic-menu") {
          IRON.setupMenu();
        }
        if ($(".elementor-widget-sr-e-menu").length > 0) {
          IRON.setupElementorMenu();
        }
        if ($('.sr-header').length > 0) {
          IRON.elementorHeaderLogo();
        }
        if (IRON.state.menu.menu_type == "push-menu") {
          IRON.initDropDownClasses();
        }
        pjax.swapLogo();

        IRON.initFitVids();
        IRON.initAjaxBlocksLoad();

        if (iron_vars.header_top_menu_hide_on_scroll == 1) IRON.initTopMenu();

        IRON.initGridDisplayAlbum();

        if (!isMobile && !isiPad) IRON.initPusherHeight();

        IRON.initEventCenter();
        IRON.initHeadsetCenter();
        IRON.initIOSCenter();
        IRON.initSubmenuPosition();
        IRON.initSingleDisco();
        IRON.initNewsletterLabel();
        IRON.initDisableHovers();

        if (typeof window.vc_js === "function") {
          IRON.initCircleCentering();
          IRON.initVcAnimations();
        }

        IRON.initWooImageBack();
        IRON.initWpAdminBar();
        IRON.initSocialShare();
        IRON.fetch_Oembed();
        IRON.featuredFooterPlayer();

        if (IRON.state.menu.menu_type == "classic-menu") {
          $(window).on("resize", responsiveMenu);
          $(window).trigger("resize");
        }

        if(typeof IRON.players !== 'undefined' && jQuery('.iron_widget_radio:not(.srt_player-container)')) {
          IRON.players = []; // reset players if MP3 Player plugin is enabled
        }
      });
    },

    AjaxPagePass: function () {
      var pjax = this;
      if ($(pjax.newDocument).find("body.woocommerce").length) {
        window.location.reload();
        return false;
      } else {
        return true;
      }
    },
    swapMenuClass: function () {
      var pjax = this;

      var menuItemSelector = [
        "#menu-main-menu li",
        "#menu-responsive-menu li",
        ".sr-e-menu li",
      ];
      var menuItemClass = [
        "current-menu-ancestor",
        "current-menu-parent",
        "current-menu-item",
        "current_page_item",
        "active",
      ];

      $(menuItemSelector.join(", ")).removeClass(menuItemClass.join(" "));

      $(menuItemSelector).each(function () {
        var thisSelector = this;
        $(menuItemClass).each(function () {
          $(
            thisSelector +
            '[data-id="' +
            $(pjax.newDocument)
              .find(thisSelector + "." + this)
              .attr("data-id") +
            '"]'
          ).addClass(this);
        });
      });
    },

    swapLogo: function () {
      var logoSelect =
        IRON.state.logo.page_logo_select !== false
          ? IRON.state.logo.page_logo_select
          : IRON.state.logo.logo_select;
      if (typeof IRON.state.logo[logoSelect] !== "undefined") {
        var logo_url = IRON.state.logo[logoSelect].url.slice(
          IRON.state.logo[logoSelect].url.indexOf("/")
        );
        var retina_logo_url = IRON.state.logo[logoSelect].url_retina.slice(
          IRON.state.logo[logoSelect].url_retina.indexOf("/")
        );
      }
      $(".site-logo img").attr("src", logo_url);
      $(".site-logo img").attr(
        "srcset",
        logo_url + " 1x, " + retina_logo_url + " 2x"
      );
    },
    swapLanguageLink: function () {
      var pjax = this;

      if ($(pjax.newDocument).find(".languages-selector").length) {
        var langContent = $(pjax.newDocument)
          .find(".languages-selector")
          .html();
        $(pjax.oldDocument).find(".languages-selector").html(langContent);
      }
    },

    updateState: function () {
      var min = !iron_vars.sonaar_debug ? ".min" : "";
      var pjax = this;
      var pjax_iron_vars = $(pjax.newDocument)
        .find('script[src*="sonaar.scripts"]')
        .prev("script")
        .text();
      var pos1 = pjax_iron_vars.indexOf("{");
      var pos2 = pjax_iron_vars.lastIndexOf("}") - pjax_iron_vars.length + 1;

      pjax_iron_vars = JSON.parse(pjax_iron_vars.slice(pos1, pos2));

      for (var prop in pjax_iron_vars) {
        IRON.state[prop] = pjax_iron_vars[prop];
      }
    },

    HideShowTransition: function () {
      var pjax = this;
      var overlay = $("#overlay .perspective");
      var transition = Barba.BaseTransition.extend({
        start: function () {
          Promise.all([this.newContainerLoading, this.fadeOut()]).then(
            this.fadeIn.bind(this)
          );
        },

        fadeOut: function () {
          var _this = this;

          $("html, body").animate(
            {
              scrollTop: 0,
            },
            800
          );

          if ($(".side-menu").hasClass("open")) {
            $(".menu-toggle").trigger("click");
          }
          var fadeOut = anime({
            targets: [this.oldContainer, "#overlay .perspective"],
            opacity: 0,
            easing: "easeOutExpo",
            duration: 1000,
          });
          return fadeOut.finished;
        },

        fadeIn: function () {
          var _this = this;
          var $el = $(this.newContainer);

          if (pjax.AjaxPagePass()) {
            pjax.swapBodyClass();
            $(this.oldContainer).hide();
            pjax.customCss();

            jQuery(window).resize();
            $el.css({
              visibility: "visible",
              opacity: 0,
            });

            var fadeIn = anime({
              targets: [this.newContainer, "#overlay .perspective"],
              opacity: 1,
              // scale:1,
              easing: "easeOutExpo",
              duration: 1000,
            });
            return fadeIn.finished.then(_this.done());
          }
        },
      });

      return transition;
    },
    customCss: function () {
      var pjax = this;
      var oldStyleSheet = $(pjax.oldDocument).find('link[rel="stylesheet"]');
      var newStyleSheet = $(pjax.newDocument).find('link[rel="stylesheet"]');

      $(pjax.oldDocument).find('style[data-type*="vc"]').remove();
      $(pjax.newDocument).find('style[data-type*="vc"]').appendTo("head");

      $(pjax.oldDocument).find("#elementor-frontend-inline-css").remove();
      $(pjax.newDocument)
        .find("#elementor-frontend-inline-css")
        .appendTo("head");

      $(pjax.oldDocument).find("#rs-plugin-settings-inline-css").remove();
      $(pjax.newDocument)
        .find("#rs-plugin-settings-inline-css").appendTo("body");

      $(pjax.oldDocument).find("#google-fonts-1-css").remove();
      $(pjax.newDocument).find("#google-fonts-1-css").appendTo("head");

      $(pjax.oldDocument).find("#iron-custom-styles-inline-css").remove();
      $(pjax.newDocument)
        .find("#iron-custom-styles-inline-css")
        .appendTo("head");

      if (typeof sonaar_music !== "undefined") { // means sonaar music plugin activated
        $(pjax.oldDocument).find('#sonaar-music-mp3player-js-extra').remove();
        $(pjax.newDocument).find('#sonaar-music-mp3player-js-extra').appendTo("head");
        $(pjax.oldDocument).find("#sonaar-music-inline-css").remove();
        $(pjax.newDocument)
          .find("#sonaar-music-inline-css")
          .appendTo("head");
      }
      oldStyleSheet.each(function (index, element) {
        if (
          !$(pjax.newDocument).find('link[id="' + $(this).attr("id") + '"]')
            .length
        ) {
          $(this).remove();
        }
      });

      newStyleSheet.each(function (index, element) {
        if (
          !$(pjax.oldDocument).find('link[id="' + $(this).attr("id") + '"]')
            .length
        ) {
          $(this).appendTo("body");
        }
      });

      var customStyle = $(pjax.oldDocument).find("#custom-styles-inline-css");
      var newStyle = $(pjax.newDocument).find("#custom-styles-inline-css");

      customStyle.remove();
      newStyle.appendTo("head");
    },

    swapWPAdminbar: function () {
      var pjax = this;
      $("#wpadminbar").replaceWith($(pjax.newDocument).find("#wpadminbar"));
    },
    customJs: function () {
      var pjax = this;

      function loadInline() {
        $("script")
          .not('[type="text/json"]')
          .each(function () {
            var text = $(this).text();
            if (text == "") return;

            if (text.substring(7, 12) == "CDATA") {
              try {
                eval(text.substring(16, text.length - 10));
                return true;
              } catch (error) {
                iron_vars.sonaar_debug ? console.log(error) : "";
              }
            } else {
              try {
                eval(text);
              } catch (error) {
                iron_vars.sonaar_debug ? console.log(error) : "";
              }
            }
          });
      }
      var newScript = $(pjax.newDocument).find(
        "head script[src], #pusher-wrap ~ script[src]"
      );

      var DocumentScript = $(pjax.newDocument).find("#pusher-wrap script[src]");
      var loadScript = [];
      var apiFetchScriptLoaded = false;//Fix TMP ajax conflict betweem scripts api-fetch and underscore 
      var underscoreScript = '';//Fix TMP ajax conflict betweem scripts api-fetch and underscore

      newScript.each(function () {
        var script = $(this).attr("src");
        if (script.includes('api-fetch')) {
          apiFetchScriptLoaded = true;//Fix TMP ajax conflict betweem scripts api-fetch and underscore
        }
        if (script.includes('underscore')) {
          underscoreScript = $(this).attr('src');//Fix TMP ajax conflict betweem scripts api-fetch and underscore
        }

        var found = IRON.libraries.find(function (element) {
          return element == script;
        });

        if (typeof found == "undefined") {
          loadScript.push($(this).attr("src"));
        }
      });

      if (apiFetchScriptLoaded) {
        loadScript.push(underscoreScript);//Fix TMP ajax conflict betweem scripts api-fetch and underscore
      }

      DocumentScript.each(function () {
        loadScript.push($(this).attr("src"));
      });

      if (loadScript.length) {
        $.ajaxSetup({ async: false });

        for (var i = 0; i < loadScript.length; i++) {
          $.getScript(loadScript[i], function () {
            if (i == loadScript.length - 1) {
              loadInline();
            }
          });
        }
        $.ajaxSetup({ async: true });
      } else {
        loadInline();
      }



      /*Loading Revolution Slider*/
      $(pjax.oldDocument).find("#rs-initialisation-scripts").remove();
      if ($(pjax.newDocument).find("#rs-initialisation-scripts").length) {
        let srp_rsInitScripts = $(pjax.newDocument).find("#rs-initialisation-scripts").html();
        srp_rsInitScripts = srp_rsInitScripts.split('.revolutionInit({');
        let srp_nextNodeID = srp_rsInitScripts[0].split('document.getElementById("');
        srp_nextNodeID = srp_nextNodeID[1].split('")');
        srp_nextNodeID = srp_nextNodeID[0];
        srp_rsInitScripts.shift();

        var i = 0;
        function srp_rsInitScriptsLoop() {
          setTimeout(function () {
            let srp_revapi_code = srp_rsInitScripts[i].split('});');
            let srp_revapi_param = srp_revapi_code[0];
            srp_revapi_param = eval('({' + srp_revapi_param + '})');
            let srp_revapi = $('#' + srp_nextNodeID);
            if (typeof srp_revapi === 'object' && typeof srp_revapi.revolutionInit !== 'undefined') {
              srp_revapi.revolutionInit(srp_revapi_param);
            }
            srp_nextNodeID = srp_revapi_code[1].split('document.getElementById("');
            if (srp_nextNodeID.length > 1) {
              srp_nextNodeID = srp_nextNodeID[1].split('")');
              srp_nextNodeID = srp_nextNodeID[0];
            }
            i++;
            if (i < srp_rsInitScripts.length) {
              srp_rsInitScriptsLoop();
            }
          }, 200)
        }
        srp_rsInitScriptsLoop();
      }


    },

    cleanHtml: function () {
      var pjax = this;
      $(pjax.oldDocument).find(".esgbox-overlay, .esgbox-wrap").remove();
      //move this from wpadmin bar
      if (
        $('.sr-header').attr("data-template") !==
        $(pjax.newDocument).find(".sr-header").attr("data-template")
      ) {
        $('.sr-header').replaceWith($(pjax.newDocument).find(".sr-header"));
      }
    },
    swapBodyClass: function () {
      var pjax = this;
      var newClass = $(pjax.newDocument).find("body").attr("class");
      $(".vc_row.wpb_row.vc_row-fluid.in_container")
        .has(
          ".rev_slider_wrapper.fullscreen-container, .rev_slider_wrapper.fullwidthbanner-container"
        )
        .removeClass("in_container")
        .addClass("full_width");
      $("body").attr("class", newClass);
      $("body").addClass("pjax");

      if ($("#sonaar-player.srt_sticky-player").hasClass("enable")) {
        $("body").addClass("continuousPlayer-enable");
      }
    },
    activateEsgGrid: function () {
      $(".esg-grid")
        .parents(".wpb_wrapper")
        .find("script")
        .each(function () {
          eval($(this).text());
        });
    },
    wooCommerce: function () {
      $(".product.has-default-attributes.has-children>.images").css(
        "opacity",
        1
      );
    },

    vc_slide: function () {
      if ($(".vc_slide.vc_images_carousel").length) {
        $(".vc_slide.vc_images_carousel").addClass("vc_build");
        $(".vc_carousel-indicators li:first").click();
      }
    },

    transfertAudio: function () {
      IRON.playersList = [];
    },

    ironAudioPlayer: function () {
      if ($(".pjax-container .srt_player-container .iron-audioplayer").length) {
        IRON.sonaar.player.removeSpectro();
        if (IRON.sonaar.player.list.type == "podcast")
          IRON.sonaar.player.addSpectro(
            IRON.sonaar.player.list.tracks[IRON.sonaar.player.currentTrack].id
          );

        $(".pjax-container .srt_player-container .iron-audioplayer").each(function () {
          var player = Object.create(IRON.audioPlayer);
          player.init(jQuery(this));

          IRON.playersList.push(player);
        });
      }
      if (typeof elementAudio !== "undefined") {
        if (
          elementAudio.src &&
          elementAudio.played.length &&
          !IRON.sonaar.player.userPref.minimize
        ) {
          IRON.initPusherHeight();
          $("body").addClass("continuousPlayer-enable");
          IRON.sonaar.player.minimize = false;
        }
      }

      for (var player in IRON.playersList) {
        var that = IRON.playersList[player];

        if (that.autoplayEnable) {
          if (IRON.state.enable_ajax) {
            if (IRON.sonaar.player.playlistID == "") {
              //Dont load player twice
              if (IRON.sonaar.player.playerStatus == "") {
                IRON.sonaar.player.setPlaylist(that.audioPlayer);
              }
            }
          } else {
            if (!that.wavesurfer.isPlaying()) {
              that.triggerPlay(that.wavesurfer, that.audioPlayer);
            }
          }
        }
      }
    },
  };

  /* PUSHER FORCED HEIGHT */
  IRON.initPusherHeight = function () {
    return;
  };

  /* RESET PUSHER HEIGHT */
  IRON.resetPusherHeight = function () {
    return;
  };


  /* EVENT WIDGET CENTERING */
  IRON.initEventCenter = function () {
    if (jQuery(window).width() >= 767) {
      jQuery(".event-text-wrap, .event-text-wrap-single").each(function () {
        var halfheight = jQuery(this).height() / 2;
        jQuery(this).css("margin-top", -halfheight);
      });
    } else {
      jQuery(".event-text-wrap").css("margin-top", 0);
    }

    jQuery(window).resize(function () {
      if (jQuery(window).width() >= 767) {
        jQuery(".event-text-wrap, .event-text-wrap-single").each(function () {
          var halfheight = jQuery(this).height() / 2;
          jQuery(this).css("margin-top", -halfheight);
        });
      } else {
        jQuery(".event-text-wrap").css("margin-top", 0);
      }
    });

    jQuery(".title-row").mouseenter(function () {
      if (jQuery(window).width() >= 767) {
        jQuery(".event-text-wrap.btn").each(function () {
          var halfheight = jQuery(this).height() / 2;
          jQuery(this).css("margin-top", -halfheight);
        });
      } else {
        jQuery(".event-text-wrap.btn").css("margin-top", 0);
      }
    });
  };

  /* HEADSET ICON CENTERING */
  IRON.initHeadsetCenter = function () {
    jQuery(".album-listen").each(function () {
      var halfheight = jQuery(this).height() / 2;
      jQuery(this).css("margin-top", -halfheight);
    });
    jQuery(window).resize(function () {
      jQuery(".album-listen").each(function () {
        var halfheight = jQuery(this).height() / 2;
        jQuery(this).css("margin-top", -halfheight);
      });
    });
  };

  /* IOS SLIDER TEXT CENTERING */
  IRON.initIOSCenter = function () {
    jQuery(".iosSlider .slider .item .inner a").each(function () {
      var halfheight = jQuery(this).height() / 2;
      jQuery(this).css("margin-top", -halfheight);
    });
    jQuery(window).resize(function () {
      jQuery(".album-listen").each(function () {
        var halfheight = jQuery(this).height() / 2;
        jQuery(this).css("margin-top", -halfheight);
      });
    });
  };

  IRON.initCountdownLang = function () {
    if (iron_vars.lang)
      $.countdown.setDefaults($.countdown.regionalOptions[iron_vars.lang]);
  };

  /* COUNTDOWNS CENTERING */
  IRON.initCountdownCenter = function () {
    jQuery(".countdown-wrap,.event-centering").each(function () {
      var halfheight = jQuery(this).height() / 2;
      jQuery(this).css("margin-top", -halfheight);
    });
    jQuery(window).resize(function () {
      jQuery(".countdown-wrap,.event-centering").each(function () {
        var halfheight = jQuery(this).height() / 2;
        jQuery(this).css("margin-top", -halfheight);
      });
    });

    /* New Type */
    jQuery(".event-line-countdown-wrap .countdown-block").each(function () {
      var halfheight = jQuery(this).height() / 2;
      jQuery(this).css("margin-top", -halfheight);
    });
    jQuery(window).resize(function () {
      jQuery(".event-line-countdown-wrap .countdown-block").each(function () {
        var halfheight = jQuery(this).height() / 2;
        jQuery(this).css("margin-top", -halfheight);
      });
    });
  };

  /* MENU HIERARCHY */
  IRON.initMenuHierarchy = function () {
    var menulevel = 0;
    jQuery(".menu-item").each(function () {
      if (jQuery(this).has("ul").length) {
        jQuery(this)
          .children(".has-drop-down-a")
          .append(
            "<div class='sub-arrow'><i class='fa-solid fa-angle-right'></i></div>"
          );
      }
    });
    jQuery(".has-drop-down-a").click(function (event) {
      event.preventDefault();
      menulevel = menulevel + 1;
      jQuery(this)
        .parent("li")
        .parent("ul")
        .children("li")
        .each(function () {
          jQuery(this).children("a").css("opacity", "0");
          jQuery(this).children("a").css("pointer-events", "none");
          if (menulevel > 0) {
            jQuery(".panel-networks").css("opacity", "0");
            jQuery(".panel-networks").css("pointer-events", "none");
          }
        });
      jQuery(this).next("ul").addClass("active");
    });
    jQuery(".backlist").click(function (event) {
      event.preventDefault();
      menulevel = menulevel - 1;
      jQuery(this)
        .parent("ul.sub-menu")
        .parent("li")
        .parent("ul")
        .children("li")
        .each(function () {
          jQuery(this).children("a").css("opacity", "1");
          jQuery(this).children("a").css("pointer-events", "auto");
          if (menulevel === 0) {
            jQuery(".panel-networks").css("opacity", "1");
            jQuery(".panel-networks").css("pointer-events", "auto");
          }
        });
      jQuery(this).parent("ul").removeClass("active");
    });
  };

  /* SUB-MENU DYNAMIC POSITIONING */
  IRON.initSubmenuPosition = function () {
    function sidemenuoffset() {
      var menuoffset = jQuery(".nav-menu").offset();
      jQuery(".sub-menu").css("top", menuoffset);
    }
    jQuery(window).resize(function () {
      sidemenuoffset();
    });
    sidemenuoffset();
  };

  /* LARGE SINGLE DISCOGRAPHY */
  IRON.initSingleDisco = function () {
    var discocount = $(".two_column_album .media-block").length;
    if (discocount == 1) {
      $(".two_column_album .media-block").addClass("single");
    }
  };

  /* NEWSLETTER LABEL TRANSFORM */
  IRON.initNewsletterLabel = function () {
    jQuery(".nm_mc_input").each(function () {
      var thelabel = $(this).prev("label").text();
      $(this).attr("placeholder", thelabel);
    });
    $(".nm_mc_form label").css("display", "none");
  };

  /* DISABLE HOVERS ON MOBILE */
  IRON.initDisableHovers = function () {
    $(document).ready(function () {
      if (isMobile === true || isiPad === true) {
        jQuery(".countdown-wrap").css("display", "none");
        jQuery(".button-wrap").css("display", "none");
        jQuery(".buttons").removeClass("no-touchevents");
        jQuery("html").removeClass("no-touchevents");
      }
    });
  };

  IRON.initBackToTop = function () {
    $("#back-to-top, #back-to-top-mobile").on("click", function (e) {
      e.preventDefault();

      $("html, body").animate(
        {
          scrollTop: 0,
        },
        800
      );
    });
  };

  IRON.initScrollToSection = function () {
    if ($("body").hasClass("elementor-page"))
      //Dont use the theme animation if Elementor is used
      return;

    var animating = false;
    // Iterate over all nav links, setting the "selected" class as-appropriate.
    //Anchor links

    $(document).on(
      "click",
      'a[href*="#"]:not([data-vc-tabs]):not(.sandwich-icon):not(a[href*="#elementor-action"])',
      function (e) {
        var target = $(this).attr("href");

        if (target.charAt(0) != "#") {
          target = target.split("#");
          target = "#" + target[1];
        }

        var $target = $(target);
        if ($(target).hasClass("vc_tta-panel"))
          // e.preventDefault()
          return;

        if ($(this).parents(".comment-navigation").length) {
          return true;
        }

        if ($(this).parents('.wc-tabs').length) { //dont scroll when we have clicked on a Woocommerce tab
          return true;
        }

        if (animating || $(this).hasClass("ui-tabs-anchor")) return false;

        if ($(target).length > 0) {
          animating = true;

          var menu_open = $(".side-menu").hasClass("open");
          var timeout = 10;

          if (menu_open) {
            $(".side-menu.open .menu-toggle-off").click();
            timeout = 400;
          }

          setTimeout(function () {
            //Anchor link position destination
            var topPosition = $(target).offset().top;

            //Anchor link position destination on desktop
            if (jQuery(".classic-menu:not(.responsive)").length)
              var topPosition =
                topPosition - jQuery(".classic-menu").outerHeight();

            //Anchor link position destination on mobile
            if (jQuery(".classic-menu.responsive").length)
              topPosition = topPosition - 60;

            animating = true;

            $("html, body").animate(
              {
                scrollTop: topPosition,
              },
              800,
              function () {
                animating = false;
              }
            );
          }, timeout);
        }
      }
    );
  };

  IRON.initVcAnimations = function () {
    if (navigator.userAgent.match(/iPhone|iPad|iPod/i))
      jQuery(".wpb_animate_when_almost_visible").removeClass(
        "wpb_animate_when_almost_visible"
      );
  };

  IRON.initWooImageBack = function () {
    $(".attachment-shop_catalog").each(function () {
      $(this).wrap('<div class="tint"></div>');
    });
  };

  IRON.responsiveText = function (target) {
    $(target).each(function (index) {
      function caculateLineHeight(element, newFontSize) {
        var heightFactor =
          parseInt(
            window
              .getComputedStyle(element, null)
              .getPropertyValue("font-size"),
            10
          ) / parseInt(newFontSize, 10);
        var newLineHeight =
          parseInt(
            window
              .getComputedStyle(element, null)
              .getPropertyValue("line-height"),
            10
          ) / heightFactor;
        return parseInt(newLineHeight, 10) + "px";
      }
      var headingFontSize;

      if (
        window.matchMedia("(max-width:" + target[index].mediumBreakPoint + ")")
          .matches
      ) {
        $(target[index].selector).each(function () {
          caculateLineHeight(this, target[index].newFontSizeMedium);
          headingFontSize = parseInt(
            window.getComputedStyle(this, null).getPropertyValue("font-size"),
            10
          );
          if (headingFontSize > parseInt(target[index].newFontSizeMedium, 10)) {
            if (
              window.matchMedia(
                "(max-width:" + target[index].smallBreakPoint + ")"
              ).matches
            ) {
              $(this).css({
                "line-height": caculateLineHeight(
                  this,
                  target[index].newFontSizeSmall
                ),
                "font-size": target[index].newFontSizeSmall,
              });
            } else {
              $(this).css({
                "line-height": caculateLineHeight(
                  this,
                  target[index].newFontSizeMedium
                ),
                "font-size": target[index].newFontSizeMedium,
              });
            }
          }
        });
      }
    });
  };

  IRON.initCustomJS = function () {
    /* Video List archive */
    if ($("#sr_it-perfectscrollbar").length) {
      var container = document.getElementById("sr_it-perfectscrollbar");
      var ps = new PerfectScrollbar(container, {
        wheelSpeed: 0.7,
        swipeEasing: true,
        wheelPropagation: false,
        minScrollbarLength: 20,
        suppressScrollX: true,
      });
      //ps.initialize(container);
    }
    /* End Video List archive */

    /* single video */
    $(".sr-video-image-cover").click(function () {
      $(this).hide();
    });
    /* End single video */

    /* GradientMaps effect */
    function gradientMapsDarkOrLight(target) {
      // Reverse gradientmap on dark background FUNCTION
      if ($("#overlay").lightOrDark() == "dark") {
        var gradientMap = colors[1] + " 0%, " + colors[0] + " 100%";
      } else {
        var gradientMap = colors[0] + " 0%, " + colors[1] + " 100%";
      }
      return gradientMap;
    }

    function gradientMapsColors() {
      // pick colors FUCNTION
      var color1 = iron_vars.look_and_feel.color_1;
      var color2 = iron_vars.look_and_feel.body_background.color;
      return [color1, color2];
    }

    if ($(".sr_it-gradientmaps-skin").length) {
      var colors = gradientMapsColors(); // pick colors
      var x = document.getElementsByClassName("sr_it-gradientmaps-skin");
      var i;
      var ii;
      var target = [];
      for (i = 0; i < x.length; i++) {
        if (x[i].className.indexOf("wpb_single_image") >= 0) {
          // If single image
          target = x[i].querySelectorAll("img");
        }
        if (x[i].className.indexOf("vc_row") >= 0) {
          // If Row
          target = [x[i]];
        }
        if (
          x[i].className.indexOf("vc_row") >= 0 &&
          x[i].getElementsByClassName("esg-grid").length > 0
        ) {
          //If Essential Grid
          if (x[i].getElementsByClassName("esg-media-poster").length > 0) {
            target = x[i].querySelectorAll(".esg-media-poster");
          } else {
            target = x[i].querySelectorAll(".esg-entry-media");
          }
        }
        var gradientMap = gradientMapsDarkOrLight(target); // Reverse gradientmap on dark background
        for (ii = 0; ii < target.length; ii++) {
          GradientMaps.applyGradientMap(target[ii], gradientMap);
        }
      }
    }

    if (iron_vars.custom_js !== "") {
      eval(iron_vars.custom_js);
    }

    /*Footer: Align social media icon*/
    $(
      "#footer .vc_btn3-inline, #footer .vc_btn2-inline, #footer .vc_btn1-inline"
    )
      .parent()
      .css("text-align", "center");
    /*Footer: remove touchmove on the image gallery element*/
    $("#footer .vc_carousel-inner").bind("touchmove", false);

    //REVOLTION SLIDER - MOVIE CAROUSEL
    $("rs-module.sr_carousel rs-slide").one("click", function () {
      $(this).find(".slidelink").trigger("click");
    });
    // Used on some elements to create back button (eg: https://demo.sonaar.io/cinematic/movies-carousel-intro/)
    $("#sr-back-btn").on("click", function (e) {
      e.preventDefault();
      window.history.back();
    });
  };

  IRON.WPBakeryFitText = function () {
    "use strict";
    var instanceName = "__EnableFitText";
    var EnableFitText = function (el, options) {
      return this.init(el, options);
    };
    EnableFitText.defaults = {};
    EnableFitText.prototype = {
      init: function (el, options) {
        if (el.data(instanceName)) {
          return this;
        }
        this.el = el;
        this.setOptions(options).build();
        return this;
      },
      setOptions: function (options) {
        this.el.data(instanceName, this);
        this.options = $.extend(true, {}, EnableFitText.defaults, options);
        return this;
      },
      build: function () {
        var el = $("[data-fitText]");
        if (!el.length) {
          return;
        }
        $.fn.fitText = function (kompressor, options) {
          var compressor = kompressor || 1,
            settings = $.extend(
              {
                minFontSize: Number.NEGATIVE_INFINITY,
                maxFontSize: Number.POSITIVE_INFINITY,
              },
              options
            );
          return this.each(function () {
            var $this = $(this);
            var resizer = function () {
              $this.css(
                "font-size",
                Math.max(
                  Math.min(
                    $this.width() / (compressor * 10),
                    parseFloat(settings.maxFontSize)
                  ),
                  parseFloat(settings.minFontSize)
                )
              );
            };
            resizer();
            $(window).on("resize.fittext orientationchange.fittext", resizer);
          });
        };
        el.each(function () {
          var $this = $(this),
            dataMaxFontSize = $this.attr("data-max-fontSize");
          $this.fitText(1, {
            maxFontSize: dataMaxFontSize,
          });
        });
      },
    };
  };
  /*
  IRON.SonaarEnableFitText = function (settings) {
    return this.map(function () {
      var el = $(this);
      if (el.data(instanceName)) {
        return el.data(instanceName);
      } else {
        var pluginOptions = el.data("plugin-options"),
          opts;
        if (pluginOptions) {
          opts = $.extend(true, {}, settings, pluginOptions);
        }
        return new EnableFitText(el, opts);
      }
    });
  };
  */


  /*IRON.hideElementWithAnims = function () {
    var animatedRows = $(document).find(".sr-offcanvas-content .animated");
    animatedRows.each(function () {
      $(this).css("opacity", 0);
    });
  };
  IRON.restartCanvaAnim = function () {
    var animatedRows = $(document).find(".sr-offcanvas-content .animated");
    animatedRows.each(function () {
      var animType = $(this).data("settings")["_animation"];
      $(this).removeClass(animType);
      void $(this).width();
      // $(this).width(); // trigger a DOM reflow
      $(this).addClass(animType);
      $(this).css("opacity", 1);
    });
};*/
  /*********************/
  /* ON DOCUMENT READY */
  /*********************/
  $(document).ready(function () {
    var libraries = $(document).find(
      "head script[src], #pusher-wrap ~ script[src]"
    );
    libraries.each(function () {
      IRON.libraries.push($(this).attr("src"));
    });

    $(window).resize();
    if (typeof IRON.RemoveHrefFromMenu === 'function') {
      IRON.RemoveHrefFromMenu();

    }
    IRON.eventsFilter();
    if (IRON.state.menu.menu_type == "push-menu") {
      setTimeout(function () {
        $(window).resize();
        jQuery("header").animate({ opacity: 1 });
      }, 1000);
    }

    $(".vc_row.wpb_row.vc_row-fluid.in_container")
      .has(
        ".rev_slider_wrapper.fullscreen-container, .rev_slider_wrapper.fullwidthbanner-container"
      )
      .removeClass("in_container")
      .addClass("full_width");

    $(".button-widget").each(function () {
      var initialcolor = $(this).css("color");
      var initialbg = $(this).css("background-color");
      var initialborder = $(this).css("border-top-color");

      $(this).mouseover(function () {
        var bghovercolor = $(this).attr("data-hoverbg");
        var texthovercolor = $(this).attr("data-hovertext");
        var borderhovercolor = $(this).attr("data-hoverborder");
        $(this).css("border-color", borderhovercolor);
        $(this).css("background-color", bghovercolor);
        $(this).css("color", texthovercolor);
      });
      $(this).mouseout(function () {
        $(this).css("border-color", initialborder);
        $(this).css("background-color", initialbg);
        $(this).css("color", initialcolor);
      });
    });

    //$(document).SonaarEnableFitText()

    /* SUB-MENU ARROW CENTERING */
    jQuery(".sub-arrow i").each(function () {
      var halfheight = jQuery(this).height() / 2;
      jQuery(this).css("margin-top", -halfheight);
    });
    jQuery(window).resize(function () {
      jQuery(".sub-arrow i").each(function () {
        var halfheight = jQuery(this).height() / 2;
        jQuery(this).css("margin-top", -halfheight);
      });
    });

    if (iron_vars.menu.unveil_all_mobile_items) {
      $("#menu-responsive-menu").addClass("sr-unveil-menu");
    }

    /* FOOTER TEXT CENTERING */
    function footertext() {
      var footerheight = $(".footer-wrapper").height();
      $(".footer-wrapper .text").each(function () {
        var footertextheight = $(this).height();
        var centeredtext = footerheight / 2 - footertextheight / 2;
        $(this).css("top", centeredtext);
      });
    }
    footertext();
    $(window).resize(function () {
      footertext();
    });

    /* BACKTOTOP BUTTON */
    if (document.getElementById("wrapper")) {
      var wrapper = document.getElementById("wrapper");
      var offsetNeg = $(wrapper).height() / 2;
      waypoints = new Waypoint({
        element: wrapper,
        handler: function (direction) {
          if (direction == "down") {
            $(".footer-wrapper-backtotop").addClass("active");
          } else if (direction == "up") {
            $(".footer-wrapper-backtotop").removeClass("active");
          }
        },
        offset: "-" + offsetNeg + "px",
      });
    }

    /* WPML MENU CROP CURRENT LANGUAGE */
    $(".menu-item-language").first().css("display", "none");

    /*podcastlist*/
    var clickEvent = (function () {
      if ("ontouchstart" in document.documentElement === true)
        return "touchstart";
      else return "click";
    })();

    $(document).on(
      clickEvent,
      ".sonaar-podcast-list-item .sonaar-play-button",
      function () {
        var podcastID = $(this).parents(".sonaar-podcast-list-item").attr("id");
        podcastID = podcastID.replace("post-", "");
        if (!$(this).parents(".sonaar-podcast-list-item").hasClass("current")) {
          $(".sonaar-podcast-list-item").removeClass("current");
          $(this).parents(".sonaar-podcast-list-item").addClass("current");
          IRON.sonaar.player.setPlayer({ id: podcastID });
        } else {
          IRON.sonaar.player.play();
        }
      }
    );

    /*Determine if the background color of an element is light or dark.*/
    //https://gist.github.com/larryfox/1636338
    $.fn.lightOrDark = function () {
      var r,
        b,
        g,
        hsp,
        a = this.css("background-color");

      if (a.match(/^rgb/)) {
        a = a.match(
          /^rgba?\((\d+),\s*(\d+),\s*(\d+)(?:,\s*(\d+(?:\.\d+)?))?\)$/
        );
        r = a[1];
        g = a[2];
        b = a[3];
      } else {
        a = +(
          "0x" +
          a.slice(1).replace(
            // thanks to jed : http://gist.github.com/983661
            a.length < 5 && /./g,
            "$&$&"
          )
        );
        r = a >> 16;
        b = (a >> 8) & 255;
        g = a & 255;
      }
      hsp = Math.sqrt(
        // HSP equation from http://alienryderflex.com/hsp.html
        0.299 * (r * r) + 0.587 * (g * g) + 0.114 * (b * b)
      );
      if (hsp > 127.5) {
        return "light";
      } else {
        return "dark";
      }
    };
  });

  /*********************/
  /* ON RESIZE */
  /*********************/
  jQuery(window).resize(function () {
    Waypoint.refreshAll();
  });

  /*********************/
  /* ON LOAD */
  /*********************/
  /*jQuery(window).on('load',function () {
    jQuery('header').animate({ 'opacity': 1 })
  })*/
})(jQuery);

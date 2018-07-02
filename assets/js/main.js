/**
 * Custom js for theme
 */
jQuery(function($) {

  'use strict';

  var LSD = window.LSD || {};

  /* =============================================================================
     LSD SKIP LINK FOCUS FIX (from _s)
     ========================================================================== */

  LSD.skipLinkFix = function() {
      var is_webkit = navigator.userAgent.toLowerCase().indexOf('webkit') > -1,
          is_opera = navigator.userAgent.toLowerCase().indexOf('opera') > -1,
          is_ie = navigator.userAgent.toLowerCase().indexOf('msie') > -1;

      if ((is_webkit || is_opera || is_ie) && document.getElementById && window.addEventListener) {
          window.addEventListener('hashchange', function() {
              var id = location.hash.substring(1),
                  element;

              if (!(/^[A-z0-9_-]+$/.test(id))) {
                  return;
              }

              element = document.getElementById(id);

              if (element) {
                  if (!(/^(?:a|select|input|button|textarea)$/i.test(element.tagName))) {
                      element.tabIndex = -1;
                  }

                  element.focus();
              }
          }, false);
      }
  };

  /* =============================================================================
   LSD NAVIGATION
   ========================================================================== */

  LSD.navigation = function() {
      var hamburger = $('.menu-toggle');
      var drawer = $('.site-navigation');

      hamburger.click(function() {
          $('body').toggleClass('lock');
          hamburger.toggleClass('close');
          drawer.toggleClass('expanded').slideToggle(150);
          if (drawer.hasClass('expanded')) {
              hamburger.attr('aria-expanded', 'true');
          } else {
              hamburger.attr('aria-expanded', 'false');
          }
      });

      //default body padding for a fixed header
      function bodyPadding() {
          $('.fixed-header').css('padding-top',$('.site-header').height());
      }

      // jQuery to collapse the navbar on scroll
      function minimize() {
          if ($(".site-header").offset().top > 50) {
              $(".site-header").addClass("minimize");
              $('body').trigger('minimized');
          } else {
              $(".site-header").removeClass("minimize");
          }
      }

      $(window).on('minimized', function() {
        //  console.log('worked');
      });

      $(window).scroll(minimize);
      $(window).resize(bodyPadding);
      bodyPadding();
      minimize();


      $('.search-toggle button').click(function() {
        if($('.search-toggle').hasClass('open')) {
            return true;
        } else {

        //  $('.search-toggle').addClass('open');
        //  $('.menu-item').addClass('hideAway');

        return true;
      }

      });

      $(window).click(function() {
        $('.search-toggle').removeClass('open');
        $('.menu-item').removeClass('hideAway');
      });

      $('.search-toggle').click(function(event){
          event.stopPropagation();
      });

  }

  /* =============================================================================
    LSD WEBFONT
    ========================================================================== */

  LSD.webfont = function() {
      try {
          Typekit.load({
              async: true
          });
      } catch (e) {}
  }

  /* =============================================================================
      LSD WIDGETS
      ========================================================================== */

  LSD.widgets = function() {

      //rss widget tweaks
      if ($('.widget_rss').length >= 1) {
          //truncate summary
          $('.rssSummary').each(function() {
              var summary = $(this).text(); //replace with your string.
              var maxLength = 70; // maximum number of characters to extract
              //trim the string to the maximum length
              var excerpt = summary.substr(0, maxLength);
              //re-trim if we are in the middle of a word
              excerpt = excerpt.substr(0, Math.min(excerpt.length, excerpt.lastIndexOf(' ')));
              //remove &nbsp;&nbsp; indenting
              excerpt = excerpt.replace(/\s\s+/g, ' ') + '&hellip;';
              $(this).html(excerpt);
          });
      }

      //add badges to category & archive counts
      if ($('.widget_archive, .widget_categories').length >= 1) {
          $('.widget_archive li, .widget_categories li').each(function() {
              var item = $(this).html();
              item = item.replace('(', '<small class="count">');
              item = item.replace(')', '</small>');
              $(this).html(item);
              //add posts
              if ($('.count', this).text() === '1') {
                  $('.count', this).append(' Post');
              } else {
                  //  console.log($('.count', this).text())
                  $('.count', this).append(' Posts');
              }
          });
      }

      //add badges to category & archive counts
      if ($('.widget_tag_cloud').length >= 1) {
          $('.widget_tag_cloud a').each(function() {
              var count = $(this).attr('title');
              count = count.replace(' topics', '');
              count = count.replace(' topic', '');
              $(this).append(' &nbsp;<span class="badge">' + count + '</span>');
          });
      }
  };

  /* =============================================================================
    LSD FAUXWIDTH
    ========================================================================== */

  LSD.fauxWidth = function() {

      //var element = $('.fauxwidth, .page .entry-header, .single .entry-header, .size-fullscreen, .comments-area').not('.page-builder .entry-header');
      var element = $('.fauxwidth, .page .entry-header, .single .entry-header, .size-fullscreen, .comments-area').not('.page-builder .entry-header, .layout-sidebar .comments-area');
      var offset;

      function fullwidth(el) {
        el.each(function(){
          offset = el.parent().offset();
          $(this).css({
              'width': '100vw',
              'margin-left': '-' + offset.left + 'px',
          });
        });
      } //fullwidth()

      //sidebar positioning
      function sidebarPos() {
        var box = $('.layout-sidebar .entry-header');
        if (box.length >= 1) {
          $('#secondary').css({
              'margin-top': box.height(),
          });
        }
      } //sidebarPos()

      //init
      if (element.length >= 1) {
        fullwidth(element);
        sidebarPos();

        $(window).resize(function() {
            fullwidth(element);
            sidebarPos();
        });
      }

  }

  /* =============================================================================
  LSD SMOOTH SCROLL
  ========================================================================== */

 LSD.smoothScroll = function() {

   var header,
       headerHeight,
       currLink,
       refElement,
       headerLink,
       page,
       hash,
       anchor;

   page = $('html, body');
   header = $('.site-header');
   headerLink = header.find('.menu-item > a');
   anchor = $('a[href*="#"]').not('.top-link a');

   // animation
   function animateScroll(refElement) {
     headerHeight = header.height() - 1;
     if($(window).width() > 720) {
       if($(window).scrollTop() < 50) {
         $('.site-header').clone().appendTo( "body" ).css('z-index','-1000').css('transition','none').addClass('minimize cloned');
         var newHeight = $('.cloned').outerHeight();
         //console.log(newHeight);
         $('.cloned').remove();
       } else {
         newHeight = headerHeight;
       }
      } else {
        newHeight = 0;
     }
     page.animate({
     scrollTop: $(refElement).offset().top - newHeight
    }, 850,  'easeInOutQuint');
   }

   // click event on anchor tag
   anchor.on('click', function(e){
     // ignore redirecting links
     if(anchor.hasClass('redirect')) {
       // do nothing
     } else {

     e.preventDefault();
     currLink = $(this);
     refElement = $(currLink.attr("href"));
     // keep the focused/active class for a bit while it scrolls
     setTimeout(function(){ headerLink.blur(); }, 1000);
     if(page.find(refElement).length >= 1) {
       animateScroll(refElement);
     } else {
       return false;
       }
   } // endif redirect
   });

   // if arrived from other page
  hash = window.location.hash;
  if(hash && $('body').hasClass('home')) {
  if(page.find(hash).length >= 1) {
    animateScroll(hash);
   }
  }
  // anchor tags that redirect to homepage
  header.find(anchor).each(function() {
    var link = $(this).attr('href');
    if(page.find(link).length == 0) {
      $(this).attr("href", '/' +link ).addClass('redirect');
    }
   });
 }


  /* =============================================================================
   LSD MENU HIGHLIGHT
   ========================================================================== */

  LSD.menuHighlight = function(){

    var page = $('html, body');
    var header = $('.site-header');
    var classname = 'link-active'; // name of the active class
    var height = header.height();
    var link = header.find('.menu-item > a[href*="#"]');
    var scrollPos,
        currLink,
        refElement;

    function menuScroll(event){
      var scrollPos = $(document).scrollTop() + height;
      link.each(function () {

        // ignore redirecting links
        if(link.hasClass('redirect')) {
          // do nothing
        } else {

        currLink = $(this);
        refElement = $(currLink.attr("href"));
        // height of distance from top and of element combined
        if(page.find(refElement).length >= 1) {
        var fullHeight = refElement.position().top + refElement.outerHeight();
          if(refElement.position().top < scrollPos && scrollPos < fullHeight) {
            link.removeClass(classname);
            currLink.addClass(classname);
          } else {
            currLink.removeClass(classname);
            }
          }
        } // endif redirect
      });
     }

     $(document).on("scroll", menuScroll); // initiate scroll event

    }

    /* =============================================================================
     LSD PARALLAX
     ========================================================================== */

LSD.parallax = function() {

if ($(".LSD-parallax").length) {
    parallax();
}

$(window).scroll(function(e) {
  if ($(".LSD-parallax").length) {
    parallax();
  }
});

function parallax(){
  if( $(".LSD-parallax").length > 0 ) {
    var plxBackground = $(".parallax-background");
    var plxWindow = $(".LSD-parallax");

    var plxWindowTopToPageTop = $(plxWindow).offset().top;
    var windowTopToPageTop = $(window).scrollTop();
    var plxWindowTopToWindowTop = plxWindowTopToPageTop - windowTopToPageTop;

    var plxBackgroundTopToPageTop = $(plxBackground).offset().top;
    var windowInnerHeight = window.innerHeight;
    var plxBackgroundTopToWindowTop = plxBackgroundTopToPageTop - windowTopToPageTop;
    var plxBackgroundTopToWindowBottom = windowInnerHeight - plxBackgroundTopToWindowTop;
    var plxSpeed = 0.35;

    plxBackground.css('top', - (plxWindowTopToWindowTop * plxSpeed) + 'px');
  }
}


}

/* =============================================================================
LSD VIDEO BACKGROUND
========================================================================== */

LSD.videoBackground = function() {



  var container = $('.video-background'),
      videoSrc,
      aspectRatio,
      video;

  function resizeVideo() {
          container.each(function(){
          if ( ( $(this).width() / $(this).height() ) < aspectRatio ) {
              $(this).find('video').removeClass().addClass('max-height');
          } else {
              $(this).find('video').removeClass().addClass('max-width');
          }
          }); //container.each()
        //console.log( 'image dimensions: ' + heroImg.attr('width') + ' ' + heroImg.attr('height') + ' hero is ' + heroBox.width() / heroBox.height() + ' img is ' + aspectRatio)
  }

  if( container.length >= 1 ) {
    container.each(function(){
      videoSrc = $(this).data('vid');
      aspectRatio;
      video = $('<video />', {
           id: 'video',
           src: videoSrc,
           type: 'video/mp4',
           controls: false,
           autoplay: true,
           loop: true,
           muted: true
       });

      video.appendTo($(this));
      aspectRatio = video.width() / video.height();
      resizeVideo();
    }); //container.each()
}//if container

$(window).resize( resizeVideo );

}

/* =============================================================================
 LSD SLIDER
 ========================================================================== */

 LSD.slider = function() {

   $('.hero_block').each(function() {
     if($(this).find('.hero-slider').length !== 0) {
       $(this).addClass('has-slider');
     }
   });


   //init slider
   var slider = $('.hero-slider').flickity({
        cellAlign: 'left',
        contain: true,
        wrapAround: true,
        groupCells: true,
   });

   //carousel nav
   $('.hero-slider').each(function(){
       $(this).find('.flickity-prev-next-button, .flickity-page-dots').wrapAll('<div class="flickity-nav-wrapper">');
   });


  }

/* =============================================================================
 LSD CAROUSEL
 ========================================================================== */

 LSD.carousel = function() {

   //set media size
   var aspectRatio,
       mediaImg,
       mediaBox,
       mediaSize = function() {
         $('.media-block-item').each(function(){
           $(this).height($(this).width());
           mediaImg = $('img',this);
           mediaBox = $('a',this);
           aspectRatio = mediaImg.attr('width') / mediaImg.attr('height');

           if ( ( mediaBox.width() / mediaBox.height() ) < aspectRatio ) {
                mediaImg.removeClass().addClass('max-height');
            } else {
                mediaImg.removeClass().addClass('max-width');
            }

         });
       }//mediaSize

   mediaSize();
   $(window).resize( mediaSize );

   //init carousel
   var carousel = $('.carousel:not(.staff), .media-block-carousel, .dynamic-block-carousel').flickity({
        cellAlign: 'left',
        contain: true,
        autoPlay: 4000,
        wrapAround: true,
        //groupCells: false,
        groupCells: '100%',
        imagesLoaded: true
   });

   var carousel = $('.carousel.staff').flickity({
        cellAlign: 'left',
        contain: true,
        autoPlay: 5000,
        wrapAround: true,
        //groupCells: false,
        groupCells: '100%',
        imagesLoaded: true
   });

   //carousel nav
   $('.carousel, .dynamic-block-carousel, .media-block-carousel').each(function(){
      // $(this).find('.flickity-prev-next-button, .flickity-page-dots').wrapAll('<div class="flickity-nav-wrapper">');
   });

   var carousel = $('.gallery-wrapper-carousel .gallery').flickity({
        cellAlign: 'left',
        contain: true,
        autoPlay: 5000,
        wrapAround: true,
      //  prevNextButtons: false,
        //groupCells: false,
        groupCells: '100%',
        imagesLoaded: true
   });


  //lightbox
  var lightbox = function( el ) {
           var imgSrc = $( el ).data('img');
           $('.block-lightbox').removeClass('close').append('<img src="'+imgSrc+'">');

           if( $( el ).data('height') > $( el ).data('width') ) {
             $('.block-lightbox img').addClass('max-height');
           }
  }

  $(document).on('click','#close',function(){
        event.preventDefault();
        $('.block-lightbox').addClass('close').find('img').remove();
  });

   //open lightbox
   carousel.on( 'staticClick.flickity', function( event, pointer, cellElement, cellIndex ) {
     // dismiss if cell was not clicked
     if ( !cellElement ) {
       return;
     }
     //console.log( 'Cell ' + ( cellIndex + 1 )  + ' clicked' );
     lightbox( $(cellElement).find('a') );
   });

   $('.media-block-grid .media-block-item a').click(function(){
        lightbox( $(this) );
   });

  }

  /* =============================================================================
   LSD TOGGLES
   ========================================================================== */

  LSD.toggles = function() {
    //add class to first tab/panel
    $('.toggle-block-tabs, .toggle-block-accordion').each(function(index) {
       $(this).children('li').first().children('a').addClass('is-active').next().addClass('is-open').show();
     });

     //toggle tab
     $('.toggle-block-tabs').on('click', 'li > a.tab-link', function(event) {
       if (!$(this).hasClass('is-active')) {
         event.preventDefault();
         var accordionTabs = $(this).closest('.toggle-block');
         accordionTabs.find('.is-open').removeClass('is-open').toggle();

         $(this).next().toggleClass('is-open').toggle();
         accordionTabs.find('.is-active').removeClass('is-active');
         $(this).addClass('is-active');
       } else {
         event.preventDefault();
       }
     });


     //toggle accordion
     $('.toggle-block-accordion').on('click', 'li > a.tab-link', function(event) {
       if (!$(this).hasClass('is-active')) {
         event.preventDefault();
         var accordionTabs = $(this).closest('.toggle-block');
         accordionTabs.find('.is-open').removeClass('is-open').toggle();

         $(this).next().toggleClass('is-open').toggle();
         accordionTabs.find('.is-active').removeClass('is-active');
         $(this).addClass('is-active');
       } else {
         event.preventDefault();
       }
     });

     //toggle expander
     $('.toggle-block-expander').on('click', 'li > a.tab-link', function(event) {
         event.preventDefault();
         $(this).next().toggleClass('is-open').toggle();
         $(this).toggleClass('is-active');
     });

  }


  /* =============================================================================
   LSD TOGGLES
   ========================================================================== */

  LSD.subMenus = function() {

    //search fix

    var form = $('#mobile-nav #site-search'),
        menu = $("#lower-nav-left .sub-menu");

        var content = form.html();
        menu.append('<li class="sub-search">'+content+'</li>');

    var more = $('.site-header .menu-item-has-children'),
        things = $('.site-header .menu-item-has-children, .sub-menu '),
        // mini burger
        mini = $('.site-header .mini-menu'),
        actual_close = $('.site-header .mini-toggle'),
        sub = mini.find('.sub-menu');

    more.on('click', function(e) {
      e.preventDefault();
      $(this).find('.sub-menu').slideToggle(80);
      if($(this).hasClass('menu-item-23')) {
        $('.menu-button a').toggleClass('opened');
      }
    });


    $('body').on('click', function() {
      $('.sub-menu').slideUp(80);
      actual_close.removeClass('close');
      $('.menu-button a').removeClass('opened');

    });

    things.on('click', function(e) {
      e.stopPropagation();
    });



    mini.click(function(e) {
        e.preventDefault();
        //$('body').toggleClass('lock');
        actual_close.toggleClass('close');
        //sub.toggleClass('expanded').slideToggle(150);
        if (sub.hasClass('expanded')) {
          mini.attr('aria-expanded', 'true');
        } else {
          mini.attr('aria-expanded', 'false');
        }
    });


    $('#pseudo-crumb .mini-toggle').on('click', function() {
      $(this).toggleClass('close');
      $('#pseudo-crumb .sub-pages').slideToggle(100);
    });
  }



  /* =============================================================================
   LSD Lightbox
   ========================================================================== */

  LSD.lightBox = function() {

      var gallery = $('.gallery'),
          item = gallery.find('.item, .gallery-item'),
          box = $('#lightbox'),
          close = box.find('.lightbox-close');

      // check if this is a jetpack carousel
      if(gallery.find('.gallery-item').length > 0) {
          gallery.find('.gallery-item').each(function(i) {
            if(gallery.hasClass('flickity-enabled')) {
              $(this).attr('index', i + 1);
            } else {
              $(this).attr('index', i);
            }
            console.log('yep');
          });
      }

      item.on('click', function(e) {
        e.preventDefault();

        // to collect the images
        var links = [];

        // check if this is a jetpack carousel
        if(gallery.children('.gallery-item').length > 0) {
          // add index to each jetpack gallery item
          var index = $(this).closest('.gallery-item').attr('index');
        } else {
          var index = $(this).attr('index'),
              index = index - 1;
        }

        //console.log(index);
        $(this).add($(this).siblings()).each(function(i) {
          // check if this is a jetpack carousel
          if($(this).find('img').length > 0) {
            //console.log('gallery');
            var cur = $(this).find('img').attr('src');
            var fileExtension = cur.substring(cur.lastIndexOf('.') + 1);
            var parts = cur.split('-');
            var loc = parts.pop();
            var cur = parts.join('-');
            var cur = cur+'.'+fileExtension;
            //console.log(fileExtension);
            //var cur = cur.replace("-150x150", "");
            //console.log(cur);
          } else { // is not jetpack, use custom carousel markup
          var cur = $(this).attr('href');
        }
          // collect images into array
          links.push('<div index="'+i+'" class="lightbox-item" style="background-image:url('+cur+')"></div>');

        });

        // compile the lightbox and carousel
        box.find('.lightbox-inner').html(links);
        box.fadeIn(150);
        var carousel = $('.lightbox-inner').flickity({
          setGallerySize: false,
          wrapAround: true,
          groupCells: '100%'
          }
        );
        // go to the selected carousel item
        carousel.flickity('select', index , true, true);
      });

      //add class so you dont click the link while swiping
      gallery.on( 'dragMove.flickity', function() {
        $('.flickity-viewport').addClass('is-scrolling');
      });

      gallery.on( 'dragEnd.flickity', function() {
        $('.flickity-viewport').removeClass('is-scrolling');
      });

      // close button
      close.on('click', function(e) {
        e.preventDefault();
        setTimeout(function(){
          box.removeClass('staff');
        }, 150);
        box.fadeOut(150);
        $('body').removeClass('lock');
        setTimeout(function(){
          if($('.lightbox-inner').flickity()) {
            box.find('.lightbox-inner').flickity('destroy').html('');
          }
        }, 150);
      });

      var peek = $('.carousel + a');

      /*peek.on('click', function(e) {
        console.log('yep');
        e.preventDefault();
        $('.carousel a:first-child').click();
      }); */
  }


  /* =============================================================================
HERO PARALAX EFFECTS
========================================================================== */


LSD.parallax = function() {
//only run on larger screens
if($(window).width() >= 768) {
  // vertical parallax
   var scrolled = $(window).scrollTop();
   var threshold = .2;
   $('body:not(.home) .banner-bg').css('transform', 'translateY(' + (scrolled * threshold) + 'px)');
 } else {
   $('body:not(.home) .banner-bg').css('transform', 'translateY(0px)');
 }
}



  /* =============================================================================
MOBILE PHONE
========================================================================== */


LSD.mobilePhone = function() {

  var button = $('.mobile-phone'),
      numbers = $('#alert');

      button.on('click', function(e) {
        e.preventDefault();
        $(this).toggleClass('opened');
        numbers.slideToggle(100);
      });

      $('body').on('click', function() {
        if(button.hasClass('opened')) {
          if(window.innerWidth <=768) {
            numbers.slideUp(100);
            button.removeClass('opened');
          }
        }
      });

       $('#alert, .mobile-phone').on('click', function(e) {
         e.stopPropagation();
       });

}



  /* =============================================================================
MOBILE PHONE
========================================================================== */


LSD.staff = function() {

  var list = $('body:not(.home) .staff-list'),
      item = list.find('.item');

      item.find('a').on('click', function(e) {
        $('body').addClass('lock');
        e.preventDefault();
        var main = $(this).html();
        var content = $(this).closest('.item').find('.staff-content');
        var content = content[0].outerHTML;
        $('#lightbox').fadeIn(150).addClass('staff');
        $('.lightbox-inner').append('<div class="staff-box"><div class="staff-head">'+main+'</div>'+content+'</div>');
      });
      if(window.location.hash) {
        var hash = window.location.hash;
        $(hash).find('a').click();
      }
}





  /* =============================================================================
      INIT
      ========================================================================== */
  $(document).ready(function() {
      LSD.skipLinkFix();
      LSD.navigation();
      LSD.menuHighlight();
      //LSD.smoothScroll();
      //LSD.webfont();
      LSD.widgets();
      //LSD.fauxWidth();
      //LSD.parallax();
      LSD.videoBackground();
      LSD.slider();
      LSD.carousel();
      LSD.toggles();
      LSD.subMenus();
      LSD.lightBox();
      LSD.parallax();
      LSD.mobilePhone();
      LSD.staff();
  });

  $(window).resize(function() {
        LSD.parallax();
  });

  $(document).scroll(function() {
        LSD.parallax();
  })

});

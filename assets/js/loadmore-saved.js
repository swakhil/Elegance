 /*!
 * JS FOR ELEGANCE SOCIAL NETWORK
 *
 * @Team author : Smart Xplorer (smartxplorer)
 * @Team author email: smartxplorerdev@gmail.com 
 *************************************************
 * Elegance - The Elegant Social Network Platform
 * Copyright (c) 2017 Elegant. All rights reserved.
 */

 var token = jQuery("#token_id").val();



// Infinite Scrolling Profile

$(document).ready(function()

  {

    // infinite Scrolling

    function loadMore() {

      $(window).unbind('scroll.posts');

      var pointer = $('.pointer-saved:last').attr('id');

      var token = jQuery("#token_id").val();

      var page = $('#page-hidden-saved').val();

      var id_user = $('#id-hidden-saved').val();

      var last_id = pointer.replace('page-id-', '');

      var str = "last-id=" + last_id + "&page=" + page + "&id=" + id_user;

      var str = str + "&token=" + token;

      jQuery.ajax({

        type: "POST",

        url: site_url + "ajax/loadmore-hashtag",

        data: str,

        cache: false,

        success: function(html) {

          if (html && html.trim() != '') {

            $loadmore.append(html);

          } else {

            if (html == '')

            {

              $('#end-loadmore-saved').html('<i class="fa fa-folder"></i><span>Nothing to show</span>');

              $('#end-loadmore-saved').show();

              $('#spinner-saved').hide();

            }

          }

          $(window).bind('scroll.posts', scrollEvent);

        }

      });

    }

    function scrollEvent() {

      var wintop = $(window).scrollTop(),
        docheight = $(document).height(),
        winheight = $(window).height();

      var scrolltrigger = 0.95;

      if ((wintop / (docheight - winheight)) > scrolltrigger) loadMore();

    }



    var $loadmore = $('#loadmore-saved');

    $(window).bind('scroll.posts', scrollEvent);

  });
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

      var pointer = $('.pointer-id:last').attr('id');

      var page = $('#page-name-hidden').val();

      var id_user = $('#id-num-hidden').val();

      var last_id = pointer.replace('page-', '');

      var token = jQuery("#token_id").val();

      var str = "last-id=" + last_id + "&page=" + page + "&id=" + id_user;

      var str = str + "&token=" + token;

      jQuery.ajax({

        type: "POST",

        url: site_url + "ajax/loadmore-friends",

        data: str,

        cache: false,

        success: function(html) {

          if (html && html.trim() != '') {

            $loadmore.append(html);

          } else {

            if (html == '')

            {

              $('#end-loadmore-user').html('<i class="fa fa-folder"></i><span>Nothing to show</span>');

              $('#end-loadmore-user').show();

              $('#spinner-user').hide();

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



    var $loadmore = $('#loadmore-user');

    $(window).bind('scroll.posts', scrollEvent);

  });
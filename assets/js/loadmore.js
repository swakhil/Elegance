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

// Infinite Scrolling Timeline

$(document).ready(function()

  {

    // infinite Scrolling

    function loadMore() {

      $(window).unbind('scroll.posts');

      var token = jQuery("#token_id").val();

      var pointer = $('.pointer:last').attr('id');

      var page = $('#page-hidden').val();

      var id_user = $('#id-hidden').val();

      var pid = pointer.replace('pagination-', '');

      var str = "lastpid=" + pid + "&page=" + page + "&id_user=" + id_user;

      var str = str + "&token=" + token;

      //alert(pid+' '+page+' '+id_user);

      jQuery.ajax({

        type: "POST",

        url: site_url + "ajax/loadmore",

        data: str,

        cache: false,

        success: function(html) {

          html = html.trim();

          if (html && html.trim() != '') {

            $timeline.append(html);

          } else {

            if (html == '')

            {

              $('#end-loadmore').html('<i class="fa fa-newspaper-o"></i><span>No posts to show</span>');

              $('#end-loadmore').show();

              $('#spinner').hide();

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



    var $timeline = $('#loadmore');

    $(window).bind('scroll.posts', scrollEvent);

  });
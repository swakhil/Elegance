/*!
 * MAIN JS FOR ELEGANCE SOCIAL NETWORK
 *
 * @Team author : Smart Xplorer (smartxplorer)
 * @Team author email: smartxplorerdev@gmail.com 
 *************************************************
 * Elegance - The Elegant Social Network Platform
 * Copyright (c) 2017 Elegant. All rights reserved.
 */

var site_url = jQuery("#site_url").val();

var token = jQuery("#token_id").val();



jQuery(document).ready(function() {

  jQuery('#desc').click(function() {

    jQuery('#post-' + post_id).remove();

    // Cancel the default action

    e.preventDefault();

  });

});



$(document).ready(function() {

  $("#status").emojioneArea({

    autoHideFilters: true,

    pickerPosition: "bottom", // top | bottom | right

    filtersPosition: "top", // top | bottom

    hidePickerOnBlur: true,

    tones: false,

    shortcuts: true,

    autocomplete: true,

    container: null,

  });

});



$(document).ready(function() {

  var date_input = $('input[name="birthday"]'); //our date input has the name "date"

  var container = $('.birthdate').length > 0 ? $('.birthdate').parent() : "body";

  var options = {

    format: 'mm-dd-yyyy',

    container: container,

    todayHighlight: true,

    autoclose: true,

  };

  date_input.datepicker(options);

});



String.prototype.ucfirst = function() {

  return this.charAt(0).toUpperCase() + this.substr(1);

}



jQuery(document).ready(function() {

  autosize(document.getElementById("status"));

  autosize($('textarea'));

  autosize(document.getElementById("message-area"));

});



function placeCaretAtEnd(el) {

  el.focus();

  if (typeof window.getSelection != "undefined"

    &&
    typeof document.createRange != "undefined") {

    var range = document.createRange();

    range.selectNodeContents(el);

    range.collapse(false);

    var sel = window.getSelection();

    sel.removeAllRanges();

    sel.addRange(range);

  } else if (typeof document.body.createTextRange != "undefined") {

    var textRange = document.body.createTextRange();

    textRange.moveToElementText(el);

    textRange.collapse(false);

    textRange.select();

  }

}



jQuery(document).ready(function() {

  function formatText(str)

  {

    var regex = /<br\s*[\/]?>/gi;

    return str.replace(regex, "\n");

  }



  function addBr(str)

  {

    var regex = /\n/g;

    return str.replace(regex, "<br/>");

  }



  function replaceAtMentionsWithLinks(text) {

    return text.replace(/@([a-z\d_]+)/ig, '<a href="http://localhost/socialnetwork/$1">@$1</a>');

  }



  function replaceHashtagByLink(text)

  {

    return text.replace(/#(\S*)/g, '<a href="http://localhost/socialnetwork/#!/search/$1">#$1</a>');

  }

  $(document).on('click', ".post-edit", function(e) {

    var post_id = jQuery(this).attr('id').replace('post-edit-', '');

    var desc = jQuery('#desc-' + post_id).html();

    var str = "pid=" + post_id + "&token=" + token;

    jQuery.ajax({

      type: "POST",

      url: site_url + "ajax/post-edit-select",

      data: str,



      success: function(html) {



        jQuery('#desc-' + post_id).html('<textarea class="form-control status-edit" rows="2" id="status-edit-' + post_id + '" name="status-edit" placeholder="Edit your status">' + html + '</textarea> <button type="button" class="cancel-post btn btn-azure" id="cancel-post-' + post_id + '"  >Cancel</button> <button type="button" class="save-post btn btn-azure" id="save-post-' + post_id + '"  >Edit</button>');

        autosize(document.getElementById("status-edit-" + post_id));

      }

    });



    // Cancel the default action

    e.preventDefault();

  });



  $(document).on('click', ".cancel-post", function(e) {

    var post_id = jQuery(this).attr('id').replace('cancel-post-', '');

    var str = "pid=" + post_id + "&token=" + token;



    jQuery.ajax({

      type: "POST",

      url: site_url + "ajax/post-select",

      data: str,



      success: function(html) {

        jQuery('#desc-' + post_id).html(html);

      }

    });



    // Cancel the default action

    e.preventDefault();

  });



  $(document).on('click', ".save-post", function(e) {

    var post_id = jQuery(this).attr('id').replace('save-post-', '');

    var desc = jQuery('#status-edit-' + post_id).val();

    var str = "desc=" + desc + "&pid=" + post_id + "&token=" + token;

    jQuery(this).attr("disabled", "disabled");

    $('#status-edit-' + post_id).attr("disabled", "disabled");



    jQuery.ajax({

      type: "POST",

      url: site_url + "ajax/post-update",

      data: str,



      success: function(html) {

        jQuery('#desc-' + post_id).html(html);

      }

    });



    // Cancel the default action

    e.preventDefault();

  });



});



jQuery(document).ready(function() {

  $(document).on('click', '.post-report', function(e) {

    var post_id = jQuery(this).attr('id').replace('post-report-', '');



    swal({
        title: "Do you want to report this post ?",

        text: "This post would not must be on our community?",

        type: "warning",
        showCancelButton: true,

        confirmButtonColor: "#DD6B55",

        confirmButtonText: "Yes!",

        cancelButtonText: "No",

        closeOnConfirm: false,

        closeOnCancel: true
      },

      function(isConfirm) {



        if (isConfirm) {

          var str = "pid=" + post_id + "&token=" + token;

          jQuery.ajax({

            type: "POST",

            url: site_url + "ajax/post-report",

            data: str,



            success: function(html) {

              swal("Thank You!", "Your post has been reported.", "success");

            }

          });

        }

      });

    return false;



    // Cancel the default action

    e.preventDefault();

  });

});



jQuery(document).ready(function() {

  $(document).on('click', '.post-hide', function(e) {

    var post_id = jQuery(this).attr('id').replace('post-hide-', '');



    jQuery('#post-' + post_id).fadeOut(800, function() {

      jQuery('#post-' + post_id).remove();

    });

    $('#modal-post').modal('hide');



    return false;



    // Cancel the default action

    e.preventDefault();

  });

});



jQuery(document).ready(function() {

  $(document).on('click', '.post-delete', function(e) {

    var post_id = jQuery(this).attr('id').replace('post-delete-', '');



    swal({
        title: "Do you want to delete this post ?",

        text: "This is definitive!",

        type: "warning",
        showCancelButton: true,

        confirmButtonColor: "#DD6B55",

        confirmButtonText: "Yes!",

        cancelButtonText: "No",

        closeOnConfirm: false,

        closeOnCancel: true
      },

      function(isConfirm) {



        if (isConfirm) {

          var str = "pid=" + post_id + "&token=" + token;

          jQuery.ajax({

            type: "POST",

            url: site_url + "ajax/post-delete",

            data: str,



            success: function(html) {

              jQuery('#post-' + post_id).fadeOut(800, function() {

                jQuery('#post-' + post_id).remove();

              });

              $('#modal-post').modal('hide');

              swal("Deleted!", "Your post has been deleted.", "success");

            }

          });

        }

      });

    return false;



    // Cancel the default action

    e.preventDefault();

  });

});



jQuery(document).ready(function() {

  $(document).on('click', '#search-input', function(e) {

    var inputString = this.value;

    if (inputString.length == 0) {

      $.post(site_url + "ajax/autosave", {
        token: "" + token + ""
      }, function(data) {

        if (data.length > 0) {

          $("#reponse").show();

          $('#reponse').html(data);

        }

      });

    }

    $(document).click(function()

      {

        $("#reponse").hide();

      });

  });

});



jQuery(document).ready(function() {

  $(document).on('keyup', '#search-input', function(e) {

    var inputString = this.value;



    $(document).on('click', '#search-input', function(e) {

      $("#reponse").fadeIn();

      return false;

    });



    $(document).click(function()

      {

        $("#reponse").hide();

      });



    if (inputString.length == 0) {

      document.getElementById("reponse").innerHTML = "";

      return false;

    } else {

      $.post(site_url + "ajax/autosuggest", {
        queryString: "" + inputString + "",
        token: "" + token + ""
      }, function(data) {

        if (data.length > 0) {

          $('#reponse').html(data);

        }

      });

    }

  });



  $(document).on('click', '#shref', function(e) {

    var shref = jQuery(this).attr('shref');

    window.location.assign(shref);

  });

});



jQuery(document).ready(function() {

  $(document).on('click', ".trash-comment", function(e) {

    var cid = jQuery(this).attr('id').replace('trash-', '');

    var post_id = jQuery(this).attr('pid');

    var ccount = parseInt(jQuery('#comment_count_' + post_id).html(), 10);

    swal({
        title: "Do you want to delete this comment ?",

        text: "This is definitive!",

        type: "warning",
        showCancelButton: true,

        confirmButtonColor: "#DD6B55",

        confirmButtonText: "Yes!",

        cancelButtonText: "No",

        closeOnConfirm: false,

        closeOnCancel: true
      },

      function(isConfirm) {



        if (isConfirm) {

          var str = "cid=" + cid + "&token=" + token;

          jQuery.ajax({

            type: "POST",

            url: site_url + "ajax/comment-delete",

            data: str,



            success: function(html) {

              jQuery('#box-comment-' + cid).fadeOut(800, function() {

                jQuery('#box-comment-' + cid).remove();

                jQuery('#comment_count_' + post_id).html(parseInt(jQuery('#comment_count_' + post_id).html(), 10) - 1);

                if (jQuery('#comment_count_' + post_id).html() == 0) {

                  jQuery('#comment_count_' + post_id).hide();

                }



                /*For Comment in Post Modal*/

                jQuery('#box-comment-modal-' + cid).remove();

                jQuery('#comment_count-modal_' + post_id).html(parseInt(jQuery('#comment_count-modal_' + post_id).html(), 10) - 1);

                if (jQuery('#comment_count-modal_' + post_id).html() == 0) {

                  jQuery('#comment_count-modal_' + post_id).hide();

                }



              });



              swal("Deleted!", "Your comment has been deleted.", "success");

            }

          });

        }

      });

    return false;



    // Cancel the default action

    e.preventDefault();

  });

});



/*Message-Ajax*/

jQuery(document).ready(function() {

  $(document).on('click', "#message-click", function(e) {

    $('span#ajax-load-message').html('<i class="fa fa-spinner fa-pulse fa-3x fa-fw" style="margin-left: 42%; margin-top: 3%;"></i><span class="sr-only">Loading...</span>');

    var aria_expanded = jQuery(this).attr('aria-expanded');

    if (aria_expanded === 'true') {

      $('#badge-mess-color').css("color", '#fff');

    } else

    {

      $('#badge-mess-color').css("color", '#1d698c');

    }

    var str = "token=" + token;

    jQuery.ajax({

      type: "POST",

      url: site_url + "ajax/messages",

      data: str,

      success: function(html) {

        $('span#ajax-load-message').html(html);

      }

    });

    return false;

  });

});

/*******************/



//Load Online User

setInterval(function() {

  var str = "token=" + token;

  jQuery.ajax({

    type: "POST",

    url: site_url + "ajax/online-query",

    data: str,

    success: function(html) {

      $('span#ajax-header-online').html(html);

    }

  });

}, 3000)



setInterval(function() {

  var str = "token=" + token;

  jQuery.ajax({

    type: "POST",

    url: site_url + "ajax/online",

    data: str,

    success: function(html) {

      $('#online-chat-user-container').html(html);

    }

  });

}, 3000)

/*******************/



//Load Notif Count Interval

setInterval(function() {

  var str = "token=" + token;

  jQuery.ajax({

    type: "POST",

    url: site_url + "ajax/notif-count",

    data: str,

    success: function(html) {

      $('#notification-count').html(html);

    }

  });

}, 1500)

/*******************/



//Load Message Count Interval

setInterval(function() {

  var str = "token=" + token;

  jQuery.ajax({

    type: "POST",

    url: site_url + "ajax/mess-count",

    data: str,

    success: function(html) {

      $('#mess-count').html(html);

    }

  });

}, 2000)

/*******************/



/*Fixed Menu Left side on Top*/

var elementPosition = $('#navi-menu').offset();



$(window).scroll(function() {

  //if($(window).scrollTop() > elementPosition.top){

  if ($(window).scrollTop() > '300') {

    $('#navi-menu').css('position', 'fixed').css('top', '70px');

  } else {

    $('#navi-menu').css('position', 'static');

  }

});

/***********************************/



jQuery(document).ready(function() {

  $(document).on('click', "#caret-drop", function(e) {

    var aria_expanded = jQuery(this).attr('aria-expanded');

    if (aria_expanded === 'true')

    {

      $('#caret-color').css("color", '#fff');

    } else

    {

      $('#caret-color').css("color", '#1d698c');

    }

  });

});



/*Notification-Ajax*/

jQuery(document).ready(function() {

  $(document).on('click', "#notif-click", function(e) {

    var aria_expanded = jQuery(this).attr('aria-expanded');

    if (aria_expanded === 'true')

    {

      $('#badge-notif-color').css("color", '#fff');

    } else

    {

      $('#badge-notif-color').css("color", '#1d698c');

    }

    $('span#ajax-load-notif').html('<i class="fa fa-spinner fa-pulse fa-3x fa-fw" style="margin-left: 42%; margin-top: 3%;"></i><span class="sr-only">Loading...</span>');

    var str = "token=" + token;

    jQuery.ajax({

      type: "POST",

      url: site_url + "ajax/notifications",

      data: str,

      success: function(html) {

        $('span#ajax-load-notif').html(html);

      }

    });

    return false;

  });

});



$('body').click(function(evt) {

  if (evt.target.id == "notif-click" || evt.target.id == "message-click")

    return;



  //Do processing of click event here for every element except elements 

  var notif_count = $('#notif_id').html();

  if (notif_count > 0)

  {

    $('#badge-notif-color').css("color", '#fff');

  } else

  {

    $('#badge-notif-color').css("color", '#1d698c');

  }



  var mess_count = $('#mess_id').html();

  if (mess_count > 0)

  {

    $('#badge-mess-color').css("color", '#fff');

  } else

  {

    $('#badge-mess-color').css("color", '#1d698c');

  }



  $('#caret-color').css("color", '#1d698c');



});



jQuery(document).ready(function() {

  $(function() {

    var postActions = $('#list_PostActions');

    var currentAction = $('#list_PostActions li.active');

    if (currentAction.length === 0) {

      postActions.find('li:first').addClass('active');

    }

    postActions.find('li').on('click', function(e) {

      e.preventDefault();

      var self = $(this);

      if (self === currentAction) {
        return;
      }

      // else

      currentAction.removeClass('active');

      self.addClass('active');

      currentAction = self;

    });

  });

});



jQuery(document).ready(function() {

  $(document).on('click', "#modal-ajax-hide", function(e) {

    $('modal-post').modal('hide');

    $('.modal.in').modal('hide');

  });

  $(document).on('click', "#modal-ajax-com-hide", function(e) {

    $('#modal-comment').modal('hide');

  });

});



jQuery(document).ready(function() {

  $(document).on('click', ".modal_open", function(e) {

    var pid = jQuery(this).attr('data-pid');

    var img = jQuery(this).attr('rel');

    var str = "pid=" + pid + "&img=" + img + "&token=" + token;

    $('#modal-ajax-data').html('<i class="fa fa-spinner fa-pulse fa-3x fa-fw" id="loading-big-center" aria-hidden="true"></i>');



    jQuery.ajax({

      type: "POST",

      url: site_url + "ajax/modal-ajax",

      data: str,



      success: function(html) {

        $('#modal-ajax-data').html(html);

        /* $('#img-modal-post').css("top", '0%');

              var img = $('#img-modal-post');

              img.on('load', function(){

              var width = img.width();

              var height = img.height();

              //alert (height);

              if(height <= 300){

              $('#img-modal-post').css("position", 'relative');

              $('#img-modal-post').css("top", '30%');

            }

            });*/

      }

    });

    return false;

  });



  $(document).on('click', ".modal_open_com", function(e) {

    var cid = jQuery(this).attr('data-cid');

    var img = jQuery(this).attr('rel');

    var str = "cid=" + cid + "&img=" + img + "&token=" + token;

    $('#modal-ajax-data-com').html('<i class="fa fa-spinner fa-pulse fa-3x fa-fw" id="loading-big-center" aria-hidden="true"></i>');



    jQuery.ajax({

      type: "POST",

      url: site_url + "ajax/modal-ajax-com",

      data: str,



      success: function(html) {

        $('#modal-ajax-data-com').html(html);

      }

    });

    return false;

  });



  $(document).on('click', "#post-prev", function(e) {

    var pid = jQuery(this).attr('pid-prev');

    var str = "pid=" + pid + "&token=" + token;

    $('#modal-ajax-data').html('<i class="fa fa-spinner fa-pulse fa-3x fa-fw" id="loading-big-center" aria-hidden="true"></i>');

    jQuery.ajax({

      type: "POST",

      url: site_url + "ajax/modal-ajax",

      data: str,



      success: function(html) {

        $('#modal-ajax-data').html(html);

      }

    });

    return false;

  });

});



$(document).on('click', "#post-next", function(e) {

  var pid = jQuery(this).attr('pid-next');

  var str = "pid=" + pid + "&token=" + token;

  $('#modal-ajax-data').html('<i class="fa fa-spinner fa-pulse fa-3x fa-fw" id="loading-big-center" aria-hidden="true"></i>');

  jQuery.ajax({

    type: "POST",

    url: site_url + "ajax/modal-ajax",

    data: str,



    success: function(html) {

      $('#modal-ajax-data').html(html);

    }

  });

  return false;

});



/**********Privacy**********************/

jQuery(document).ready(function() {

  $(document).on('click', "#confidence", function(e) {

    $(document).on('click', "#public-privacy", function(e) {

      var p1 = $('#p1').html();

      $('#privacy-show').html('<i class="fa fa-spinner fa-pulse fa-3x fa-fw" id="privacy-spinner"></i><span class="sr-only">Loading...</span>');

      var p1val = $('#p1val').html();

      $('#privacy').val(p1val);



      //Ajax Update Privacy 

      var str = "privacy=" + p1val + "&token=" + token;

      jQuery.ajax({

        type: "POST",

        url: site_url + "ajax/privacy-update",

        data: str,



        success: function(html) {

          $('#privacy-show').html(p1);

        }

      });



      // Cancel the default action

      e.preventDefault();

    });



    $(document).on('click', "#followers-privacy", function(e) {

      var p2 = $('#p2').html();

      $('#privacy-show').html('<i class="fa fa-spinner fa-pulse fa-3x fa-fw" id="privacy-spinner"></i><span class="sr-only">Loading...</span>');

      var p2val = $('#p2val').html();

      $('#privacy').val(p2val);



      //Ajax Update Privacy 

      var str = "privacy=" + p2val + "&token=" + token;

      jQuery.ajax({

        type: "POST",

        url: site_url + "ajax/privacy-update",

        data: str,



        success: function(html) {

          $('#privacy-show').html(p2);

        }

      });



      // Cancel the default action

      e.preventDefault();

    });



    $(document).on('click', "#me-privacy", function(e) {

      var p3 = $('#p3').html();

      $('#privacy-show').html('<i class="fa fa-spinner fa-pulse fa-3x fa-fw" id="privacy-spinner"></i><span class="sr-only">Loading...</span>');

      var p3val = $('#p3val').html();

      $('#privacy').val(p3val);



      //Ajax Update Privacy 

      var str = "privacy=" + p3val + "&token=" + token;

      jQuery.ajax({

        type: "POST",

        url: site_url + "ajax/privacy-update",

        data: str,



        success: function(html) {

          $('#privacy-show').html(p3);

        }

      });



      // Cancel the default action

      e.preventDefault();

    });



    // Cancel the default action

    e.preventDefault();

  });

});

/**************************************/



jQuery(document).ready(function() {

  $(document).on('click', "#post_post", function(e) {

    var form_id = 'post_data';

    var obj = jQuery(this);

    var elp = $("#status").emojioneArea();

    var post_val = elp[0].emojioneArea.getText();

    $("#status").val(post_val);

    jQuery(this).attr("disabled", "disabled");

    jQuery(this).html('<i class="fa fa-spinner fa-pulse fa-3x fa-fw" id="post-spinner"></i><span class="sr-only">Loading...</span>');

    jQuery(this).css('cursor', 'default');

    nude.load('scan_img');

    nude.scan(

      function(result)

      {
        if (!result)

        {

          var nude = '20';

        } else {

          var nude = '100';

        }

        var str = jQuery("#" + form_id).serialize();

        var str = str + "&adult_content_score=" + nude + "&token=" + token;

        jQuery.ajax({

          type: "POST",

          url: site_url + "ajax/post",

          data: str,

          success: function(data) {

            $("#post_data")[0].reset();

            $('#img_preview').hide();

            $('#scan_img').attr('src', 'assets/img/transparent.png');

            var data = data.trim();

            $('#status').html('');

            $('#status').css('height', '46px');;

            $('#wall-append').prepend(data);

            obj.attr("disabled", false);

            obj.html('Post');

            obj.css('cursor', 'pointer');

            // Reset Emoji field

            elp[0].emojioneArea.setText('');

            $('#pic_url').val('');

            $('#pic_url_thumb').val('');

            $('.fetch-url').hide();

            $('.current_image').val('');

            $('.total_image').val('');

            $('.url_desc').val('');

            $('.url_title').val('');

            $('.url_link').val('');

            $('.url_image').val('');

            $('.v_url').val('');

            $('.v_type').val('');

            $('.v_desc').val('');

            $('.v_title').val('');

            $('.v_thumb').val('');

          }

        });

      });

    return false;

    // Cancel the default action

    e.preventDefault();

  });

});



$(window).load(function() {

  //$(".loader").fadeOut("slow");

});



/*--------------------------------------------------*/



/* Save Post  */



$(document).on('click', '.save', function(e) {

  pid = $(this).attr('id');

  container = $(this).closest('.save_container').attr('id');

  $.ajax({

    type: "POST",

    url: site_url + "ajax/save-post",

    data: {

      pid: pid,

      token: token

    },



    success: function(data) {

      if (data.trim() === '0')

      {

        $('#saved-alert-' + pid).css('display', 'inline-block');

        $('#saved-alert-' + pid).html('<i class="fa fa-bookmark blue-special"></i> Already saved, please visit your <a href="' + site_url + 'user/saved">saved posts</a><i class="fa fa-times-circle style-times blue-special" id="times-saved-' + pid + '"></i>')

        $('#saved-alert-' + pid).fadeIn();

      } else

      {

        $('#saved-alert-' + pid).css('display', 'inline-block');

        $('#saved-alert-' + pid).fadeIn();

      }

    }

  });



  $(document).on('click', '#times-saved-' + pid, function(e) {

    $('#saved-alert-' + pid).fadeOut();

  });



  // Cancel the default action

  e.preventDefault();

});

/*******************************************/



/* LIKE - SHARE - COMMENT  */



$(document).on('click', '.like', function(e) {

  id = $(this).attr('id');

  container = $(this).closest('.like_container').attr('id');

  $.ajax({

    type: "POST",

    url: site_url + "ajax/post-like",

    data: {

      id: id,

      flag: 'check_unique',

      token: token

    },



    success: function(data) {

      if (data > 0) {

        $('#' + container).removeClass('reactions_like').addClass('reactions');

      } else

      {

        $('#' + container).removeClass('reactions').addClass('reactions_like');

      }

    }

  });



  // Cancel the default action

  e.preventDefault();

});



$(document).on('click', '.like', function(e) {

  id = $(this).attr('id');

  container = $(this).closest('.like_container').attr('id');

  $.ajax({

    type: "POST",

    url: site_url + "ajax/post-like",

    data: {

      id: id,

      flag1: 'update',

      token: token

    },



    success: function(data) {

      $('#' + container).find('.score').html(data);

    }

  });



  // Cancel the default action

  e.preventDefault();

});



jQuery(document).ready(function() {

  $(document).on('click', '.share', function(e) {

    id = jQuery(this).attr('id').replace('share_', '');

    container = $(this).closest('.share_container').attr('id');

    autosize(document.getElementById("status-share"));

    swal({
        title: "Do you want to share this post ?",

        text: "<textarea class='form-control status-share' rows='2' id='status-share' name='status-share' placeholder='Write Something...'></textarea>",

        html: true,

        type: "",
        showCancelButton: true,

        confirmButtonColor: "#DD6B55",

        confirmButtonText: "Share",

        cancelButtonText: "No",

        closeOnConfirm: false,

        closeOnCancel: true
      },

      function(isConfirm) {

        if (isConfirm) {

          var desc = jQuery("#status-share").val();

          $.ajax({

            type: "POST",

            url: site_url + "ajax/post-share-ajax",

            data: {

              desc: desc,

              id: id,

              flag1: 'update',

              token: token

            },



            success: function(data) {

              $('#' + container).find('.score_share').html(data);

              document.getElementById('share_' + id).style.color = "#6f97b6";

              document.getElementById('score_share_' + id).style.color = "#6f97b6";

              swal("Shared!", "Your post has been shared.", "success");

            }

          });



        }

      });

    return false;



    // Cancel the default action

    e.preventDefault();

  });

});



$(window).load(function() {

  $(".textarea-com").children('.emojionearea-button').children('.camera-com').show();

});



jQuery(document).ready(function() {

  $(document).on('keypress', '.ac-input', function(event) {

    var post_id = jQuery(this).attr('class').replace('emojionearea form-control ac-input textarea-com ac-input_', '');

    var post_id = post_id.trim();

    $(".ac-input_" + post_id).css("max-height", '2000px');

    var keycode = (event.keyCode ? event.keyCode : event.which);

    if (keycode == '13') {

      var elp = $("#ac-input-" + post_id).emojioneArea();

      // Get text

      var comment_ = elp[0].emojioneArea.getText();

      var comment_pic = $("#pic_url_com-" + post_id).val();

      // Get html

      /*var comment_ = elp[0].emojioneArea.editor.html();*/

      $("#ac-input-" + post_id).val(comment_);

      var obj = jQuery(this);

      var post_id = obj.attr('class').replace('emojionearea form-control ac-input textarea-com ac-input_', '');

      var form_id = 'form-comment-' + post_id;

      var comment = jQuery("#ac-input-" + post_id).val();

      if (jQuery.trim(comment) != '' || jQuery.trim(comment_pic) != '') {

        var ccount = parseInt(jQuery('#comment_count_' + post_id).html(), 10);

        var cont = obj.children('.emojionearea-editor').html();

        obj.attr("contenteditable", false);



        var str = jQuery("#" + form_id).serialize();

        var str = str + "&token=" + token;

        jQuery.ajax({

          type: "POST",

          url: site_url + "ajax/comment-post",

          data: str,



          success: function(html) {

            jQuery('#box-comments_' + post_id).append(jQuery(html).fadeIn('slow'));

            jQuery('#comment_count_' + post_id).show();

            // Reset Emoji field

            elp[0].emojioneArea.setText('');

            obj.attr("contenteditable", true);



            //increment comment count

            if (jQuery('#comment_count_' + post_id).html() == '') {

              jQuery('#comment_count_' + post_id).html(parseInt(0, 10) + 1);

            } else

            {

              jQuery('#comment_count_' + post_id).html(parseInt(jQuery('#comment_count_' + post_id).html(), 10) + 1);

            }

            jQuery("#ac-input-" + post_id).val('');

            jQuery("#img_preview_com-" + post_id).hide();

            jQuery("#files_com-" + post_id).html('');

            $("#" + form_id)[0].reset();

          }

        });

      }

      return false;

    }

    event.stopPropagation();

  });

});



/* LIKE - SHARE - COMMENT FOR MODAL IMAGE */



$(document).on('click', '.like-modal', function(e) {

  id = jQuery(this).attr('id').replace('modal-', '');

  container = $(this).closest('.like_container-modal').attr('id');

  $.ajax({

    type: "POST",

    url: site_url + "ajax/post-like",

    data: {

      id: id,

      flag: 'check_unique',

      token: token

    },



    success: function(data) {

      if (data > 0) {

        $('#' + container).removeClass('reactions_like').addClass('reactions');

      } else

      {

        $('#' + container).removeClass('reactions').addClass('reactions_like');

      }

    }

  });



  // Cancel the default action

  e.preventDefault();

});



$(document).on('click', '.like-modal', function(e) {

  id = jQuery(this).attr('id').replace('modal-', '');

  container = $(this).closest('.like_container-modal').attr('id');

  $.ajax({

    type: "POST",

    url: site_url + "ajax/post-like",

    data: {

      id: id,

      flag1: 'update',

      token: token

    },



    success: function(data) {

      $('#' + container).find('.score-modal').html(data);

    }

  });

});



jQuery(document).ready(function() {

  $(document).on('click', '.share-modal', function(e) {

    id = jQuery(this).attr('id').replace('share-modal_', '');

    container = $(this).closest('.share_container-modal').attr('id');

    autosize(document.getElementById("status-share-modal"));

    swal({
        title: "Do you want to share this post ?",

        text: "<textarea class='form-control status-share' rows='2' id='status-share-modal' name='status-share' placeholder='Write Something...'></textarea>",

        html: true,

        type: "",
        showCancelButton: true,

        confirmButtonColor: "#DD6B55",

        confirmButtonText: "Share",

        cancelButtonText: "No",

        closeOnConfirm: false,

        closeOnCancel: true
      },

      function(isConfirm) {

        if (isConfirm) {

          var desc = jQuery("#status-share-modal").val();

          $.ajax({

            type: "POST",

            url: site_url + "ajax/post-share-ajax",

            data: {

              desc: desc,

              id: id,

              flag1: 'update',

              token: token

            },



            success: function(data) {

              $('#' + container).find('.score_share-modal').html(data);

              document.getElementById('share-modal_' + id).style.color = "#6f97b6";

              document.getElementById('score_share-modal_' + id).style.color = "#6f97b6";

              swal("Shared!", "Your post has been shared.", "success");

            }

          });



        }

      });

    return false;



    // Cancel the default action

    e.preventDefault();

  });

});

/* Follow | Unfollow People */

jQuery(document).ready(function() {

  $(document).on('mouseenter', '#follow-user', function(event) {

    var id = jQuery(this).attr('data-id');

    var state = jQuery(this).attr('data-state');

    if (state == 'unfollow')

    {

      $('.follow-user-' + id).html(' Unfollow <i class="fa fa-user-times"></i>');

    }

  });



  $(document).on('mouseleave', '#follow-user', function(event) {

    var id = jQuery(this).attr('data-id');

    var state = jQuery(this).attr('data-state');

    if (state == 'unfollow')

    {

      $('.follow-user-' + id).html(' Following <i class="fa fa-user"></i>');

    }

  });



});



jQuery(document).ready(function() {

  $(document).on('click', '#follow-user', function(event) {

    var id = jQuery(this).attr('data-id');

    var state = jQuery(this).attr('data-state');

    jQuery(this).html('<i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i><span class="sr-only">Loading...</span>');



    if (state == 'follow')

    {

      $.ajax({

        type: "POST",

        url: site_url + "ajax/follow",

        data: {

          id: id,

          arg: state,

          token: token

        },



        success: function(data) {

          $('.follow-user-' + id).html(' Following <i class="fa fa-user"></i>');

          $('.follow-user-' + id).attr("data-state", "unfollow");

        }

      });

    } else

    {

      $.ajax({

        type: "POST",

        url: site_url + "ajax/follow",

        data: {

          id: id,

          arg: state,

          token: token

        },



        success: function(data) {

          $('.follow-user-' + id).html(' Follow <i class="fa fa-user-plus"></i>');

          $('.follow-user-' + id).attr("data-state", "follow");

        }

      });

    }

    return false;



    // Cancel the default action

    e.preventDefault();

  });

});

/***************************************************/



/* Follow  People Recommended*/

jQuery(document).ready(function() {

  $(document).on('click', '.follow-people', function(event) {

    var id = jQuery(this).attr('data-id');

    var id_hide = jQuery(this).attr('data-id');

    var state = jQuery(this).attr('data-state');

    jQuery(this).html('<i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i><span class="sr-only">Loading...</span>');



    if (state == 'follow')

    {

      $.ajax({

        type: "POST",

        url: site_url + "ajax/follow",

        data: {

          id: id,

          arg: state,

          token: token

        },

        success: function(html) {

          $('#recommended' + id).fadeOut();

        }

      });

    }

    return false;



    // Cancel the default action

    event.preventDefault();

  });

});

/***************************************************/



jQuery(document).ready(function() {

  $(document).on('keypress', '.ac-input-modal', function(event) {

    var post_id = jQuery(this).attr('class').replace('emojionearea form-control ac-input-modal textarea-com ac-input-modal_', '');

    var post_id = post_id.trim();

    $(".ac-input-modal_" + post_id).css("max-height", '2000px');

    var keycode = (event.keyCode ? event.keyCode : event.which);

    if (keycode == '13') {

      var elp = $("#ac-input-modal-" + post_id).emojioneArea();

      // Get text

      var comment_ = elp[0].emojioneArea.getText();

      // Get html

      /*var comment_ = elp[0].emojioneArea.editor.html();*/

      $("#ac-input-modal-" + post_id).val(comment_);

      var obj = jQuery(this);

      var post_id = obj.attr('class').replace('emojionearea form-control ac-input-modal textarea-com ac-input-modal_', '');

      var form_id = 'form-comment-modal-' + post_id;

      var comment = jQuery("#ac-input-modal-" + post_id).val();

      if (jQuery.trim(comment) != '') {

        var ccount = parseInt(jQuery('#comment_count-modal_' + post_id).html(), 10);

        var cont = obj.children('.emojionearea-editor').html();

        obj.attr("contenteditable", false);



        var str = jQuery("#" + form_id).serialize();

        var str = str + "&token=" + token;

        jQuery.ajax({

          type: "POST",

          url: site_url + "ajax/comment-post",

          data: str,



          success: function(html) {

            jQuery('#box-comments-modal_' + post_id).append(jQuery(html).fadeIn('slow'));

            jQuery('#comment_count-modal_' + post_id).show();

            // Reset Emoji field

            elp[0].emojioneArea.setText('');

            obj.attr("contenteditable", true);



            //increment comment count

            if (jQuery('#comment_count-modal_' + post_id).html() == '') {

              jQuery('#comment_count-modal_' + post_id).html(parseInt(0, 10) + 1);

            } else

            {

              jQuery('#comment_count-modal_' + post_id).html(parseInt(jQuery('#comment_count-modal_' + post_id).html(), 10) + 1);

            }

            jQuery("#ac-input-modal-" + post_id).val('');

          }

        });

      }

      return false;

    }

    event.stopPropagation();

  });

});



function timeDifference(current, previous) {



  var msPerMinute = 60 * 1000;

  var msPerHour = msPerMinute * 60;

  var msPerDay = msPerHour * 24;

  var msPerMonth = msPerDay * 30;

  var msPerYear = msPerDay * 365;



  var elapsed = current - previous;



  if (elapsed < msPerMinute) {

    return Math.round(elapsed / 1000) + ' seconds ago';

  } else if (elapsed < msPerHour) {

    return Math.round(elapsed / msPerMinute) + ' minutes ago';

  } else if (elapsed < msPerDay) {

    return Math.round(elapsed / msPerHour) + ' hours ago';

  } else if (elapsed < msPerMonth) {

    return 'approximately ' + Math.round(elapsed / msPerDay) + ' days ago';

  } else if (elapsed < msPerYear) {

    return 'approximately ' + Math.round(elapsed / msPerMonth) + ' months ago';

  } else {

    return 'approximately ' + Math.round(elapsed / msPerYear) + ' years ago';

  }

}



/**************Chat Container*************************/



jQuery(document).ready(function() {



  $(document).on('click', '.online-user', function(e) {



    var container_1 = $('.chat-1').html();

    var container_2 = $('.chat-2').html();

    var container_3 = $('.chat-3').html();

    var container_4 = $('.chat-4').html();



    if (typeof container_1 == 'undefined') {



      container = $(this).closest('.online_container').attr('id');

      container = $('#' + container);

      cvid = container.attr('cvid');

      data_id = container.attr('data-id');

      id_chat = '1';

      fullname = container.attr('data-fullname');

      username = container.attr('data-username');

      container = container.closest('.online_container').attr('id');



      $.ajax({

        type: "POST",

        url: site_url + "ajax/start-chat",

        data: {

          cvid: cvid,

          id: data_id,

          id_chat: id_chat,

          token: token

        },



        success: function() {



          $.ajax({

            type: "POST",

            url: site_url + "ajax/chat-1",

            data: {

              cvid: cvid,

              id: data_id,

              token: token

            },



            success: function(data) {

              $('#title-chat-1').html('<a href="' + site_url + 'messages/' + username + '">' + fullname + '</a>');

              $('.online_container_1').addClass('chat-1');

              $('.chat-1').show();

              $('#chat-ajax-1').html(data);

              $('#send-chat-1').attr('cvid', cvid);

              $('#send-chat-1').attr('user-to', data_id);

              $(".msg_container_base").scrollTop($(".msg_container_base")[0].scrollHeight);

            }

          });



        }

      });

      // Cancel the default action

      e.preventDefault();

    } else if (typeof container_1 != 'undefined' && typeof container_2 == 'undefined') {

      var container_1 = $('.chat-1').html();

      var container_2 = $('.chat-2').html();

      var container_3 = $('.chat-3').html();

      var container_4 = $('.chat-4').html();



      container = $(this).closest('.online_container').attr('id');

      container = $('#' + container);

      cvid = container.attr('cvid');

      data_id = container.attr('data-id');

      id_chat = '2';

      fullname = container.attr('data-fullname');

      username = container.attr('data-username');

      container = container.closest('.online_container').attr('id');



      $.ajax({

        type: "POST",

        url: site_url + "ajax/start-chat",

        data: {

          cvid: cvid,

          id: data_id,

          id_chat: id_chat,

          token: token

        },



        success: function() {



          $.ajax({

            type: "POST",

            url: site_url + "ajax/chat-2",

            data: {

              cvid: cvid,

              id: data_id,

              token: token

            },



            success: function(data) {

              $('#title-chat-2').html('<a href="' + site_url + 'messages/' + username + '">' + fullname + '</a>');

              $('.online_container_2').addClass('chat-2');

              $('.chat-2').show();

              $('#chat-ajax-2').html(data);

              $('#send-chat-2').attr('cvid', cvid);

              $('#send-chat-2').attr('user-to', data_id);

              $(".msg_container_base").scrollTop($(".msg_container_base")[0].scrollHeight);

            }

          });

        }

      });

      // Cancel the default action

      e.preventDefault();

    } else if (typeof container_1 != 'undefined' && typeof container_2 != 'undefined' && typeof container_3 == 'undefined') {

      var container_1 = $('.chat-1').html();

      var container_2 = $('.chat-2').html();

      var container_3 = $('.chat-3').html();

      var container_4 = $('.chat-4').html();



      container = $(this).closest('.online_container').attr('id');

      container = $('#' + container);

      cvid = container.attr('cvid');

      data_id = container.attr('data-id');

      id_chat = '3';

      fullname = container.attr('data-fullname');

      username = container.attr('data-username');

      container = container.closest('.online_container').attr('id');



      $.ajax({

        type: "POST",

        url: site_url + "ajax/start-chat",

        data: {

          cvid: cvid,

          id: data_id,

          id_chat: id_chat,

          token: token

        },



        success: function() {



          $.ajax({

            type: "POST",

            url: site_url + "ajax/chat-3",

            data: {

              cvid: cvid,

              id: data_id,

              token: token

            },



            success: function(data) {

              $('#title-chat-3').html('<a href="' + site_url + 'messages/' + username + '">' + fullname + '</a>');

              $('.online_container_3').addClass('chat-3');

              $('.chat-3').show();

              $('#chat-ajax-3').html(data);

              $('#send-chat-3').attr('cvid', cvid);

              $('#send-chat-3').attr('user-to', data_id);

              $(".msg_container_base").scrollTop($(".msg_container_base")[0].scrollHeight);

            }

          });

        }

      });

      // Cancel the default action

      e.preventDefault();

    } else if (typeof container_1 != 'undefined' && typeof container_2 != 'undefined' && typeof container_3 != 'undefined' && typeof container_4 == 'undefined') {

      //alert(container_1);

      var container_1 = $('.chat-1').html();

      var container_2 = $('.chat-2').html();

      var container_3 = $('.chat-3').html();

      var container_4 = $('.chat-4').html();



      container = $(this).closest('.online_container').attr('id');

      container = $('#' + container);

      cvid = container.attr('cvid');

      data_id = container.attr('data-id');

      id_chat = '4';

      fullname = container.attr('data-fullname');

      username = container.attr('data-username');

      container = container.closest('.online_container').attr('id');



      $.ajax({

        type: "POST",

        url: site_url + "ajax/start-chat",

        data: {

          cvid: cvid,

          id: data_id,

          id_chat: id_chat,

          token: token

        },



        success: function() {



          $.ajax({

            type: "POST",

            url: site_url + "ajax/chat-4",

            data: {

              cvid: cvid,

              id: data_id,

              token: token

            },



            success: function(data) {

              $('#title-chat-4').html('<a href="' + site_url + 'messages/' + username + '">' + fullname + '</a>');

              $('.online_container_4').addClass('chat-4');

              $('.chat-4').show();

              $('#chat-ajax-4').html(data);

              $('#send-chat-4').attr('cvid', cvid);

              $('#send-chat-4').attr('user-to', data_id);

              $(".msg_container_base").scrollTop($(".msg_container_base")[0].scrollHeight);

            }

          });

        }

      });

      // Cancel the default action

      e.preventDefault();

    }



  });

});



$(document).on('click', '.panel-heading span.icon_minim', function(e) {

  var $this = $(this);

  if (!$this.hasClass('panel-collapsed')) {

    $this.parents('.panel').find('.panel-body').slideUp();

    $this.addClass('panel-collapsed');

    $this.removeClass('glyphicon-minus').addClass('glyphicon-plus');

    $this.parents('.panel').parents('.page-edit').css('bottom', '0px');

  } else {

    $this.parents('.panel').find('.panel-body').slideDown();

    $this.removeClass('panel-collapsed');

    $this.removeClass('glyphicon-plus').addClass('glyphicon-minus');

    $this.parents('.panel').parents('.page-edit').css('bottom', '43px');

  }

});

$(document).on('focus', '.panel-footer input.chat_input', function(e) {

  var $this = $(this);

  if ($('#minim_chat_window').hasClass('panel-collapsed')) {

    $this.parents('.panel').find('.panel-body').slideDown();

    $('#minim_chat_window').removeClass('panel-collapsed');

    $('#minim_chat_window').removeClass('glyphicon-plus').addClass('glyphicon-minus');

  }

});



$(document).on('click', '.panel-heading span.icon_close', function(e) {

  $(this).parent().parent().parent().parent().parent().hide();

  $(this).parent().parent().parent().parent().parent().removeClass('chat-1');

  $(this).parent().parent().parent().parent().parent().removeClass('chat-2');

  $(this).parent().parent().parent().parent().parent().removeClass('chat-3');

  $(this).parent().parent().parent().parent().parent().removeClass('chat-4');



  if (typeof intervalStart_1 != 'undefined') {

    clearTimeout(intervalStart_1);

  }

  if (typeof intervalStart_2 != 'undefined') {

    clearTimeout(intervalStart_2);

  }

  if (typeof intervalStart_3 != 'undefined') {

    clearTimeout(intervalStart_3);

  }

  if (typeof intervalStart_4 != 'undefined') {

    clearTimeout(intervalStart_4);

  };



  // Cancel the default action

  e.preventDefault();

});



//Send-chat



$(document).on('keypress', '.send-chat', function(event) {

  var keycode = (event.keyCode ? event.keyCode : event.which);

  if (keycode == '13') {

    var obj = jQuery(this);

    var container = obj.attr('container');

    var cvid = obj.attr('cvid');

    var user_to = obj.attr('user-to');

    var message = obj.val().trim();

    $.ajax({

      type: "POST",

      url: site_url + "ajax/send-chat",

      data: {

        message: message,

        cvid: cvid,

        user_to: user_to,

        token: token

      },



      success: function(data) {

        //$('#'+container).html(data);

        obj.val('');

        $(".msg_container_base").scrollTop($(".msg_container_base")[0].scrollHeight);

      }

    });

    // Cancel the default action

    e.preventDefault();

  }

});



$('.glyphicon-facetime-video').click(function(event) {



  window.open($('#popup_video').attr("href"), "popupWindow", "width=800,height=800,scrollbars=yes");

  return false;

});

/*******************************************************/

jQuery(document).ready(function() {

  $(document).on('click', "#film", function(e) {

    $("#status_id").attr('placeholder', 'Enter a youtube | vimeo | dailymotion | metacafe link to share a video!');

  });

  $(document).on('click', "#user-mentions", function(e) {

    $("#msgbox-tag").slideDown('show');

    $("#msgbox-tag").html("Type @ with the name of someone or something...");

    $("#status_id").attr('placeholder', 'Enter an @username or @something!');

  });

});



jQuery(document).ready(function() {

  $(document).on('click', "#update_general", function(e) {

    var form_id = 'general-form';

    var obj = jQuery(this);

    jQuery(this).attr("disabled", "disabled");

    jQuery(this).html('<i class="fa fa-spinner fa-pulse fa-3x fa-fw" id="post-spinner"></i><span class="sr-only">Loading...</span>');

    jQuery(this).css('cursor', 'default');



    var str = jQuery("#" + form_id).serialize();

    var str = str + "&token=" + token;

    jQuery.ajax({

      type: "POST",

      url: site_url + "ajax/settings.data",

      data: str,



      success: function(data) {

        $("#general-form")[0].reset();

        var data = data.trim();

        $('#msg-update').html(data);

        obj.attr("disabled", false);

        obj.html('Update');

        obj.css('cursor', 'pointer');

        //$('#general-update').load(site_url+'ajax/settings-general').fadeIn("slow");

        var str = "token=" + token;

        jQuery.ajax({

          type: "POST",

          url: site_url + "ajax/settings-general",

          data: str,

          success: function(html) {

            $('#general-update').html(html);

          }

        });



      }

    });

    return false;



    // Cancel the default action

    e.preventDefault();

  });



  $(document).on('click', "#update_email", function(e) {

    var form_id = 'general-form';

    var obj = jQuery(this);

    jQuery(this).attr("disabled", "disabled");

    jQuery(this).html('<i class="fa fa-spinner fa-pulse fa-3x fa-fw" id="post-spinner"></i><span class="sr-only">Loading...</span>');

    jQuery(this).css('cursor', 'default');



    var str = jQuery("#" + form_id).serialize();

    var str = str + "&token=" + token;

    jQuery.ajax({

      type: "POST",

      url: site_url + "ajax/settings.notif",

      data: str,



      success: function(data) {

        $("#general-form")[0].reset();

        var data = data.trim();

        $('#msg-update').html(data);

        obj.attr("disabled", false);

        obj.html('Update');

        obj.css('cursor', 'pointer');

        var str = "token=" + token;

        jQuery.ajax({

          type: "POST",

          url: site_url + "ajax/settings-notif",

          data: str,

          success: function(html) {

            $('#general-update').html(html);

          }

        });

      }

    });

    return false;



    // Cancel the default action

    e.preventDefault();

  });



  $(document).on('click', "#update_password", function(e) {

    $('#msg-update').html('');

    var form_id = 'general-form';

    var obj = jQuery(this);

    jQuery(this).attr("disabled", "disabled");

    jQuery(this).html('<i class="fa fa-spinner fa-pulse fa-3x fa-fw" id="post-spinner"></i><span class="sr-only">Loading...</span>');

    jQuery(this).css('cursor', 'default');



    var str = jQuery("#" + form_id).serialize();

    var str = str + "&token=" + token;

    jQuery.ajax({

      type: "POST",

      url: site_url + "ajax/settings.password",

      data: str,



      success: function(data) {

        $("#general-form")[0].reset();

        var data = data.trim();

        $('#msg-update').html(data);

        obj.attr("disabled", false);

        obj.html('Update');

        obj.css('cursor', 'pointer');

      }

    });

    return false;



    // Cancel the default action

    e.preventDefault();

  });



  $(document).on('click', "#unblocked", function(e) {

    var form_id = 'general-form';

    $('#msg-update').html('');

    jQuery(this).attr("disabled", "disabled");

    jQuery(this).html('<i class="fa fa-spinner fa-pulse fa-3x fa-fw" id="post-spinner"></i><span class="sr-only">Loading...</span>');

    jQuery(this).css('cursor', 'default');



    var str = jQuery("#" + form_id).serialize();

    var str = str + "&token=" + token;

    jQuery.ajax({

      type: "POST",

      url: site_url + "ajax/settings.blocked",

      data: str,



      success: function(data) {

        $("#general-form")[0].reset();

        var data = data.trim();

        $('#msg-update').html(data);

        obj.attr("disabled", false);

        obj.html('Update');

        obj.css('cursor', 'pointer');

        var str = "token=" + token;

        jQuery.ajax({

          type: "POST",

          url: site_url + "ajax/settings-blocked",

          data: str,

          success: function(html) {

            $('#general-update').html(html);

          }

        });

      }

    });

    return false;



    // Cancel the default action

    e.preventDefault();

  });



  $(document).on('click', "#update_delete", function(e) {

    var form_id = 'general-form';

    var obj = jQuery(this);

    jQuery(this).attr("disabled", "disabled");

    jQuery(this).html('<i class="fa fa-spinner fa-pulse fa-3x fa-fw" id="post-spinner"></i><span class="sr-only">Loading...</span>');

    jQuery(this).css('cursor', 'default');



    var str = jQuery("#" + form_id).serialize();

    var str = str + "&token=" + token;

    swal({
        title: "Are you sure to delete your account ?",

        text: "This is so sad!",

        type: "warning",
        showCancelButton: true,

        confirmButtonColor: "#DD6B55",

        confirmButtonText: "Yes!",

        cancelButtonText: "No",

        closeOnConfirm: false,

        closeOnCancel: true
      },

      function(isConfirm) {



        if (isConfirm) {

          jQuery.ajax({

            type: "POST",

            url: site_url + "ajax/settings.deactivate",

            data: str,



            success: function(data) {

              swal("Deleted!", "Your account has been deleted.", "success");

              $("#general-form")[0].reset();

              var data = data.trim();

              $('#msg-update').html(data);

              obj.attr("disabled", false);

              obj.html('Delete Account');

              obj.css('cursor', 'pointer');

              var Timeout = setTimeout(

                function()

                {

                  window.location.assign(site_url + "user/logout")

                }, 1000);

            }

          });

        } else

        {

          obj.attr("disabled", false);

          obj.html('Delete Account');

          obj.css('cursor', 'pointer');

        }

      });



    return false;



    // Cancel the default action

    e.preventDefault();

  });



  $(document).on('click', ".ajax-general", function(e) {

    var str = "token=" + token;

    jQuery.ajax({

      type: "POST",

      url: site_url + "ajax/settings-general",

      data: str,

      success: function(html) {

        $('#general-update').html(html);

      }

    });

    $('#msg-update').html('');

  });

  $(document).on('click', ".ajax-email", function(e) {

    var str = "token=" + token;

    jQuery.ajax({

      type: "POST",

      url: site_url + "ajax/settings-notif",

      data: str,

      success: function(html) {

        $('#general-update').html(html);

      }

    });

    $('#msg-update').html('');

  });

  $(document).on('click', ".ajax-password", function(e) {

    var str = "token=" + token;

    jQuery.ajax({

      type: "POST",

      url: site_url + "ajax/settings-password",

      data: str,

      success: function(html) {

        $('#general-update').html(html);

      }

    });

    $('#msg-update').html('');

  });

  $(document).on('click', ".ajax-blocked", function(e) {

    var str = "token=" + token;

    jQuery.ajax({

      type: "POST",

      url: site_url + "ajax/settings-blocked",

      data: str,

      success: function(html) {

        $('#general-update').html(html);

      }

    });

    $('#msg-update').html('');

  });

  $(document).on('click', ".ajax-deactivate", function(e) {

    var str = "token=" + token;

    jQuery.ajax({

      type: "POST",

      url: site_url + "ajax/settings-deactivate",

      data: str,

      success: function(html) {

        $('#general-update').html(html);

      }

    });

    $('#msg-update').html('');

  });

});



/* Photos Controls */

jQuery(document).ready(function() {

  /*$(document).on('mouseenter', '.carousel-inner', function(event) {

    $('#controls-lr').show();

 }); 



   $(document).on('mouseleave', '.carousel-inner', function(event) {

    $('#controls-lr').hide();

 }); 

*/

});



$(document).on('click', "#close-fetch", function(e) {

  $('.fetch-url').hide();

  $('.current_image').val('');

  $('.total_image').val('');

  $('.url_desc').val('');

  $('.url_title').val('');

  $('.url_link').val('');

  $('.url_image').val('');

  $('.v_url').val('');

  $('.v_type').val('');

  $('.v_desc').val('');

  $('.v_title').val('');

  $('.v_thumb').val('');

});



$(document).on('click', "#close-img", function(e) {

  $('#img_preview').hide();

  $('#scan_img').attr('src', 'assets/img/transparent.png');

  $('#pic_url').val('');

  $('#pic_url_thumb').val('');

});



$(document).on('click', "#close-img-com", function(e) {

  var pid = jQuery(this).attr('pid');

  $('#img_preview_com-' + pid).hide();

  $('#files_com-' + pid).html('');

  $('#pic_url_com-' + pid).val('');

  $('#pic_url_thumb_com-' + pid).val('');

});



var timer = null;

$('.status').click(function() {
  $('.arrow').css("left", 0);
});

$(document).on('keyup', "#status_id", function(e) {



  clearTimeout(timer);

  timer = setTimeout(function() {

    var elp = $("#status").emojioneArea();

    var post_val = elp[0].emojioneArea.getText();

    $("#status").val(post_val);



    content = $('#status').val();

    content = $.trim(content);

    if (content !== '') {

      geturl = new RegExp(

        "(^|[ \t\r\n])((http|https):(([A-Za-z0-9$_.+!*(),;/?:@&~=-])|%[A-Fa-f0-9]{2}){2,}(#([a-zA-Z0-9][a-zA-Z0-9$_.+!*(),;/?:@&~=%-]*))?([A-Za-z0-9$_+!*();/?:~-]))"

        , "g"

      );

      url = content.match(geturl);

      if (url !== null) {

        $('#loader_post').html('<span>Wait, fetching url...</span>');
        var loader = jQuery('#post_post');
        loader.attr("disabled", "disabled");
        loader.html('<i class="fa fa-spinner fa-pulse fa-3x fa-fw" id="post-spinner"></i><span class="sr-only">Loading...</span>');
        
        $.post(site_url + 'ajax/getContents', {
          'url': url.toString(),
          'token': token,
          'type': 'POST'
        }, function(response, status, xhr) {

          $('#loader_post').html('');

          loader.attr("disabled", false);

          loader.html('Post');

          $('.fetch-url').show();

          htmlContent = '';

          if (response !== null) {

            if (response.type === 'image') {

              htmlContent = imageContentView(response);

              $('.ext-content').html(htmlContent);

              $('.url_desc').val(response.description);

              $('.url_title').val(response.title);

              $('.url_link').val(response.url);

              $('.url_image').val(response.images[0]);

            }

            if (response.type === 'video') {

              htmlContent = videoContentView(response);

              $('.ext-content').html(htmlContent);

              $('.v_type').val(response.provider);

              $('.v_url').val(response.url);

              $('.v_desc').val(response.description);

              $('.v_title').val(response.title);

              $('.v_thumb').val(response.video.thumbnail);

            }

            if (response.type === 'url') {

              htmlContent = urlContentView(response);

              $('.ext-content').html(htmlContent);

              $('.current_image').val(2);

              var currentImg = $('.current_image').val();

              $(".total_image").val(response.images.length);

              $("div.ext-images img").hide().filter(":nth-child(2)").show();

              $('.url_desc').val(response.description);

              $('.url_title').val(response.title);

              $('.url_link').val(response.url);

              $('.url_image').val(response.images[parseInt(currentImg) - parseInt(1)]);

            }

          }

        });

      }

    }

  }, 900);



  //return false;

  // Cancel the default action

  e.preventDefault();



});



$(document).on('click', ".img-next", function(e) {

  currentImg = $('.current_image').val();

  if (parseInt(currentImg) < parseInt($('.total_image').val())) {

    $('div.ext-images img#' + currentImg).hide();

    currentImg = parseInt(currentImg) + parseInt(1);

    total_image = $('.total_image').val();

    $('#total_length').html('Total ' + currentImg + '/' + total_image + ' images');

    $('.current_image').val(currentImg);

    $('div.ext-images img#' + currentImg).show();

    var img = $('div.ext-images img#' + currentImg).attr('src');

    $('.url_image').val(img);

  }

});



$(document).on('click', ".img-prev", function(e) {

  currentImg = $('.current_image').val();

  if (parseInt(currentImg) != parseInt(1)) {

    nextImg = parseInt(currentImg) - parseInt(1);

    $('#total_length').html('Total ' + nextImg + '/13 images');

    if (parseInt(nextImg) > 0) {

      $('div.ext-images img#' + currentImg).hide();

      $('.current_image').val(nextImg);

      $('div.ext-images img#' + nextImg).show();

      var img = $('div.ext-images img#' + nextImg).attr('src');

      $('.url_image').val(img);

    }

  }

});



function imageContentView(data) {



  html = '<div class="image-type"><div class="row">';

  html = html + '<div class="col-md-12"><img src="' + data.images[0] + '" class="img-responsive" /></div>';

  html = html + '<div class="col-md-12"> <h4>' + data.title + '</h4>';

  html = html + '<p class="ext-url"> <a href="' + data.url + '" target="_blank">' + data.urlHost + '</a></p>';

  html = html + '<p>' + data.description + '</p></div>';

  html = html + '</div></div>';

  return html;

}



function urlContentView(data) {



  html = '<div class="url-type"><div class="row>';

  if (data.images.length > 0) {

    html = html + '<div class="col-md-12 ext-row"> <div class="ext-images">';

    $.each(data.images, function(key, data) {

      html = html + '<img src="' + data + '" class="extimg img-responsive" id="' + (key + 1) + '" />';

    });

    nav = '<div class="img-nav"><a href="javascript:void(0);" class="btn btn-default img-prev pull-left"><span class="glyphicon glyphicon-chevron-left"></span></a><a href="javascript:void(0);" class="btn btn-default img-next pull-right"><span class="glyphicon glyphicon-chevron-right"></span></a><center id="total_length">Total 2/' + data.images.length + ' images</center></div>'

    html = html + nav + '</div></div><br/>';

  }

  html = html + '<div class="col-md-12 ext-data-body"> <h4>' + data.title + '</h4>';

  html = html + '<p class="ext-url"> <a href="' + data.url + '" target="_blank">' + data.urlHost + '</a></p>';

  html = html + '<p class="ext-data">' + data.description + '</p></div>';

  html = html + '</div></div>';

  return html;

}



function videoContentView(data) {



  html = '<div class="video-type"><div class="row"><div class="display-video">';

  html = html + '<div class="col-md-6 ext-row"><img src="' + data.video.thumbnail + '" class="featurette-image img-responsive" /></div>';

  html = html + '<div class="col-md-6 ext-data-body"> <h4>' + data.title + '</h4>';

  html = html + '<p class="ext-url"> <a href="' + data.url + '" target="_blank">' + data.urlHost + '</a></p>';

  html = html + '<p class="ext-data">' + data.description + '</p></div>';

  html = html + '</div></div></div>';

  return html;

}



jQuery(document).ready(function($) {

  $(document).on('click', ".videos .expand-video a.youtube", function(e) {

    $(this).parent().parent().css('display', 'block');

    $(this).parent().parent().css('border', '0');

    $(this).parent().removeClass('col-md-6').addClass('col-md-12');

    $(this).parent().next().removeClass('col-md-6').addClass('col-md-12');

    $(this).parent().next().css('height', '100%');

    $(this).parent().next().css('padding', '15');



    var videoURL = jQuery(this).attr("href");

    var regExp_YT = /^.*((youtu.be\/)|(v\/)|(\/u\/\w\/)|(embed\/)|(watch\?))\??v?=?([^#\&\?]*).*/;

    var youtubeurl = videoURL.match(regExp_YT);

    var videoID = youtubeurl[7];

    var videoWidth = parseInt(jQuery(this).parent().css("width")) - parseInt('30');

    var videoHeight = Math.ceil(videoWidth * (0.56) + 1);

    $(this).parent().html('<iframe src="http://www.youtube.com/embed/' + (videoID) + '?rel=0&autoplay=1" frameborder="0" allowfullscreen></iframe>');

    return false;

  });



  $(document).on('click', ".videos .expand-video a.vimeo", function(e) {

    $(this).parent().parent().css('display', 'block');

    $(this).parent().parent().css('border', '0');

    $(this).parent().removeClass('col-md-6').addClass('col-md-12');

    $(this).parent().next().removeClass('col-md-6').addClass('col-md-12');

    $(this).parent().next().css('height', '100%');

    $(this).parent().next().css('padding', '15');



    var videoURL = jQuery(this).attr("href");

    var regExp_VMO = /^.*(vimeo\.com\/)((channels\/[A-z]+\/)|(groups\/[A-z]+\/videos\/))?([0-9]+)/;

    var vimeourl = regExp_VMO.exec(videoURL);

    var videoID = vimeourl[5];

    var videoWidth = parseInt(jQuery(this).parent().css("width")) - parseInt('30');

    var videoHeight = Math.ceil(videoWidth * (0.56) + 1);

    $(this).parent().html('<iframe src="http://player.vimeo.com/video/' + videoID + '?portrait=0"  frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>');

    return false;

  });



  $(document).on('click', ".videos .expand-video a.metacafe", function(e) {

    $(this).parent().parent().css('display', 'block');

    $(this).parent().parent().css('border', '0');

    $(this).parent().removeClass('col-md-6').addClass('col-md-12');

    $(this).parent().next().removeClass('col-md-6').addClass('col-md-12');

    $(this).parent().next().css('height', '100%');

    $(this).parent().next().css('padding', '15');



    var videoURL = jQuery(this).attr("href");

    var n = videoURL.split("/watch/");

    var videoID = n[1].split("/");

    var videoWidth = parseInt(jQuery(this).parent().css("width")) - parseInt('30');

    var videoHeight = Math.ceil(videoWidth * (0.56) + 1);

    $(this).parent().html('<iframe src="http://www.metacafe.com/embed/' + videoID[0] + '/" allowFullScreen frameborder=0></iframe>');

    return false;

  });



  $(document).on('click', ".videos .expand-video a.dailymotion", function(e) {

    $(this).parent().parent().css('display', 'block');

    $(this).parent().parent().css('border', '0');

    $(this).parent().removeClass('col-md-6').addClass('col-md-12');

    $(this).parent().next().removeClass('col-md-6').addClass('col-md-12');

    $(this).parent().next().css('height', '100%');

    $(this).parent().next().css('padding', '15');



    var videoURL = jQuery(this).attr("href");

    var n = videoURL.split("/video/");

    var videoID = n[1].split("/");

    var videoWidth = parseInt(jQuery(this).parent().css("width")) - parseInt('30');

    var videoHeight = Math.ceil(videoWidth * (0.56) + 1);

    $(this).parent().html('<iframe src="http://www.dailymotion.com/embed/video/' + videoID[0] + '/" allowFullScreen frameborder=0></iframe>');

    return false;

  });



  $(document).on('click', "a.souncloud", function(e) {



    var scURL = jQuery(this).attr("href");

    $(this).parent().parent().css('display', 'block');

    $(this).parent().next().css('height', '100%');

    $(this).parent().parent().css('border', '0');

    $(this).parent().removeClass('col-md-6').addClass('col-md-12');

    $(this).parent().next().removeClass('col-md-6').addClass('col-md-12');

    $(this).parent().next().css('padding', '15');

    $(this).parent().html('<iframe width="100%" height="166" scrolling="yes" frameborder="no" style="outline: none;" src="http://w.soundcloud.com/player/?url=' + scURL + '&amp;color=ff5500&amp;auto_play=true&amp;hide_related=false&amp;buying=false&amp;sharing=false&amp;show_playcount=true&amp;show_comments=false&amp;show_user=true&amp;show_reposts=false">');

    return false;



    // Cancel the default action

    e.preventDefault();

  });



});



$(document).ready(function() {



  var start = /@/ig;

  var word = /@(\w+)/ig;



  $(document).on('keyup', ".p-text-area .emojionearea-editor", function(e) {

    var content = $(this).text();

    var go = content.match(start);

    var name = content.match(word);

    var dataString = 'searchword=' + name + "&token=" + token;



    if (go != 0) {

      $("#msgbox-tag").slideDown('show');

      $("#display-tag").slideUp('show');

      $("#msgbox-tag").html("Type @ with the name of someone or something...");

      if (name != 0) {

        $.ajax({

          type: "POST",

          url: site_url + "ajax/tag-search",

          data: dataString,



          success: function(html) {

            $("#msgbox-tag").hide();

            $("#display-tag").html(html).show();

          }

        });



      }

    }

    return false;

  });



  $(document).on('click', ".addname", function(e) {

    var username = $(this).attr('title');

    var editor = $(".p-text-area .emojionearea-editor");

    var old = editor.html();

    var content = old.replace(word, "");

    editor.html(content);

    var E = "<a class='color-tag' contenteditable='true' href='#' ><span style='display:none'>{@}</span>" + username + "</a> ";

    editor.append(E);

    $("#display-tag").hide();

    $("#msgbox-tag").hide();

    $(".color-tag").css('text-decoration', 'underline!important');

    //document.getElementsByClassName("p-text-area emojionearea-editor");

    //$(".p-text-area .emojionearea-editor").get(0).focus();

    placeCaretAtEnd(document.getElementById('status_id'));

  });

});

/* Timeline Image Upload Process */

$(document).ready(function() {

  $(document).on('click', 'a #pic', function(e) {

    var buttonfile = $("#photoimg");

    buttonfile.click();

    var loader = jQuery('#post_post');

    $('#imageform').on('change', buttonfile, function(e) {

      loader.html('');

      loader.attr("disabled", "disabled");

      loader.html('<i class="fa fa-spinner fa-pulse fa-3x fa-fw" id="post-spinner"></i><span class="sr-only">Loading...</span>');

      $("#imageform").ajaxForm(function(result) {

        if (result != '') {

          var file = result;

          $('#img_preview').show();

          jQuery('#pic_url').val('uploads/images/' + file);

          jQuery('#pic_url_thumb').val('uploads/images_thumb/' + file);

          file = 'uploads/images/' + file;

          //jQuery('#files').html('<img src="uploads/images/'+file+'" id="scannude" style="width: 30%">');

          $('#scan_img').attr('src', file);

          jQuery('#status_id').focus();

          loader.attr("disabled", false);

          loader.html('Post');

        } else

        {

          loader.attr("disabled", false);

          loader.html('Post');

          $('#img_preview').hide();

          $('#scan_img').attr('src', 'assets/img/transparent.png');

        }

      }).submit();

    });

    

    // Cancel the default action

    e.preventDefault();

  });

});



$(document).ready(function() {

  $(document).on('click', '.camera-com', function(e) {

    var pid = $(this).attr('pid');

    var buttonfile = $("#photoimg-" + pid);

    buttonfile.click();

    var loader = jQuery('.loader-com-' + pid);

    $('#imageform-' + pid).on('change', buttonfile, function(e) {

      $('#img_preview_com-' + pid).show();

      loader.html('');

      loader.html('<i class="fa fa-spinner fa-pulse fa-3x fa-fw" id="post-spinner-cl"></i><span class="sr-only">Loading...</span>');

      $("#imageform-" + pid).ajaxForm(function(result) {

        if (result != '') {

          var file = result;

          jQuery('#pic_url_com-' + pid).val('uploads/images/' + file);

          jQuery('#pic_url_thumb_com-' + pid).val('uploads/images_thumb/' + file);

          loader.html('');

          jQuery('#files_com-' + pid).html('<img src="uploads/images/' + file + '" style="width: 40%">');

          jQuery('#ac-input-' + pid + '_id').focus();

        } else

        {

          loader.html('');

          $('#img_preview_com-' + pid).hide();

        }

      }).submit();

    });

    

    // Cancel the default action

    e.preventDefault();

  });

});



/* Function Replace Cover*/

function replace_cover()

{

  $('#cover-container').attr("data-toggle", "");

  var newContainer = $('#cover-container').clone();

  $(function() {

    document.getElementById('cover-container').style.cursor = "move";

    $('#cover-container').html('');

    $('#cover-container').html('<div class="pull-right"><button type="button" class="btn btn-azure pull-right" id="save-position" style="margin: 20px">Save cover position</button></div>');

    $('#drop-down').hide();

    $('#drop-down2').hide();

    $('#cover-container').backgroundDraggable();



    $('#cover-container').backgroundDraggable({

      done: function() {

      }

    });

  });

  return newContainer;

}



function save_position(newContainer)

{

  var token = jQuery("#token_id").val();

  var bp = $('#cover-container').css('background-position');

  $('#cover-wrapper').html(newContainer);

  $("#cover-container").css("background-position", bp);

  $('#drop-down').show();

  $('#drop-down2').show();



  $.ajax({

    type: "POST",

    url: site_url + "ajax/cover-position",

    data: {

      position: bp,

      token: token

    },

    async: false,

    success: function(data) {

      $('#cover-container').attr("data-toggle", "modal");

      var pid = $('.pointer').attr('id').replace('pagination-', '');

      //var pid = parseFloat(pid) + parseFloat(1);

      $('#cover-container').attr("data-pid", pid);

    }

  });

  // Cancel the default action

  //e.preventDefault();

}

/*****************************************/



/********* Upload - Cover *********/

$(document).ready(function() {

  $(document).on('click', '#upload-cover', function(e) {

    var buttonfile = $("#photocover");

    var loader = jQuery('.loading-cover');

    buttonfile.click();

    $('#imageformcover').on('change', buttonfile, function(e) {

      loader.html('');

      loader.html('<i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i><span class="sr-only">Loading...</span>');

      $('#imageformcover').ajaxForm(function(result) {

        if (result != '') {

          var file = result;

          var ftab = file.split(",");

          var img_crop = ftab[0];

          var img = ftab[1];

          document.getElementById("cover-container").style.backgroundImage = "url('" + img_crop + "')";

          loader.html('');

          $.ajax({

            type: "POST",

            url: "ajax/post",

            data: {

              status: '',

              image: 'uploads/images/' + img,

              cover_status: '1',

              avatar_status: '0',

              token: token

            },

            async: false,

            success: function(data) {

              $('#wall-append').prepend(data);

              var newContainer = replace_cover();

              $(document).on('click', '#save-position', function(e) {

                save_position(newContainer);

              });

            }

          });

        } else

        {

          loader.html('');

        }

      }).submit();

    });

    

    // Cancel the default action

    e.preventDefault();

  });

});



/********* Upload - Avatar *********/

$(document).ready(function() {

  $(document).on('click', '#upload-avatar', function(e) {

    var buttonfile = $("#photoavatar");

    var container = jQuery('#avatar-href');

    buttonfile.click();

    $('#imageformavatar').on('change', buttonfile, function(e) {

      container.html('<center class="bg-white"><i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i><span class="sr-only">Loading...</span></center>');

      $('#imageformavatar').ajaxForm(function(result) {

        if (result != '') {

          var file = result;

          var ftab = file.split(",");

          var img_crop = ftab[0];

          var img = ftab[1];

          container.html('<img src="' + img_crop + '" class="avatar br-radius">');

          $('#avatar-href').attr("data-toggle", "modal");

          $.ajax({

            type: "POST",

            url: "ajax/post",

            data: {

              status: '',

              image: 'uploads/images/' + img,

              cover_status: '0',

              avatar_status: '1',

              token: token

            },

            async: false,

            success: function(data) {

              $('#wall-append').prepend(data);

              var imgs = 'uploads/images/' + img;

              var pid = $('.pointer').attr('id').replace('pagination-', '');

              //var pid = parseFloat(pid) + parseFloat(1);

              $('#avatar-href').attr("rel", imgs);

              $('#avatar-href').attr("data-pid", pid);

            }

          });

        } else

        {

          loader.html('');

        }

      }).submit();

    });

    

    // Cancel the default action

    e.preventDefault();

  });

});



/*Background Replace*/



jQuery(document).ready(function() {

  $(document).on('click', '#replace-cover', function(e) {

    var newContainer = replace_cover();

    $(document).on('click', '#save-position', function(e) {

      save_position(newContainer);

    });

  });

});



/*Add user in group*/

$(document).ready(function() {



  var start = /@/ig;

  var word = /@(\w+)/ig;



  $(document).on('keyup', "#add-group", function(e) {

    //$("#add-group").keyup('s');

    var content = $(this).text();

    var go = content.match(start);

    var name = content.match(word);

    var dataString = 'searchword=' + name + "&token=" + token;



    if (go != 0) {

      $("#msgbox-user-add").slideDown('show');

      $("#display-user-add").slideUp('show');

      $("#msgbox-user-add").html("Type the name of the user you want to add in group...");

      if (name != 0) {

        //alert(dataString);

        dataString = dataString.trim();

        $.ajax({

          type: "POST",

          url: site_url + "ajax/tag-search-group",

          data: dataString,



          success: function(html) {

            $("#msgbox-user-add").hide();

            $("#display-user-add").html(html).show();

          }

        });



      }

    }

    return false;

  });



  $(document).on('click', ".addname-group", function(e) {

    var username = $(this).attr('title');

    var editor = $("#add-group");

    var old = editor.html();

    var content = old.replace(word, "");

    editor.html(content);

    var E = "<a class='color-tag group-tag' contenteditable='false' href='#' spellcheck='false' autocorrect='false'><span style='display:none'>{@}</span> " + username + " </a> ";

    editor.append(E);

    $("#display-user-add").hide();

    $("msgbox-user-add").hide();

    $(".color-tag").css('text-decoration', 'underline!important');

    placeCaretAtEnd(document.getElementById('add-group'));

  });

});



/*****************Soundcloud Musxic Integration***************************/



$(document).ready(function() {

  //when side cart toggle anchor is clicked

  $(".side-cart-toggle").click(function(e) {

    e.preventDefault();

    $("#side-cart").toggleClass("side-cart-open");

    $(".search-music").focus();

    $(".overlay").toggle();

  });

  $("#music-box").click(function(e) {

    e.preventDefault();

    $("#side-cart").toggleClass("side-cart-open");

    $(".search-music").focus();

    $(".overlay").toggle();

  });

});

var clientid = 'client_id=2010872379d388118fe90f01ace38d03';

function search(inputString) {

  $("#q").click(function()
    {

      $("#sounds").fadeIn();

      return false;

    });

  if (inputString.length == 0) {

    document.getElementById("sounds").innerHTML = "";
    return false;

  } else {
    var loader = $('#sounds'); 
    loader.html('<center><i class="fa fa-spinner fa-pulse fa-3x fa-fw" id="post-spinner"></i><span class="sr-only">Loading...</span></center>');
    
    $.ajax({

      url: "https://api.soundcloud.com/tracks.json?" + $('#search').serialize(),

      dataType: 'json',

      beforeSend:

        function(data) {

        $('#sounds').empty();

      },
      success:

        function(data) {

        $('#sounds').html('')

        var items = [];

        $.each(data, function(key, val) {

          items.push("<div id='tracks_list'><a style='text-shadow: 1px 4px 15px black;' data-artist='" + val.user.username + "' data-title='" + val.title + "' data-url=" + val.stream_url + " href='javascript:void();'><li class='notPlaying' style='margin: 4px; /*background: url(" + val.user.avatar_url + ");*/ padding:5px;'><h2><img src='" + val.user.avatar_url + "' style='width:40px; border 1px solid #ddd; border-radius: 5px; margin: 1px' title='Play' alt='Play'/>" +

            "<img style='max-width: 30px; padding: 3px' src='" + site_url + "assets/img/sc.png'/>" + val.title + "</h2><span class='plays' >" + val.user.username + " -  <b>" + msToTime(val.duration) + "</b></span></li></a>");
        });
        $('#sounds').html(items.join(' '));
        trackClick();
      }
    });
  }
}

jQuery(document).ready(function() {

  $(document).on('keyup', '.search-music', function(e) {
    var loader = $('#sounds'); 
    loader.html('<center><i class="fa fa-spinner fa-pulse fa-3x fa-fw" id="post-spinner"></i><span class="sr-only">Loading...</span></center>');
    search(this.value);

    });
  });



function msToTime(duration) {

  var milliseconds = parseInt((duration % 1000) / 100)

  , seconds = parseInt((duration / 1000) % 60)

  , minutes = parseInt((duration / (1000 * 60)) % 60)

  , hours = parseInt((duration / (1000 * 60 * 60)) % 24);



  hours = (hours < 10) ? "0" + hours : hours;

  minutes = (minutes < 10) ? "0" + minutes : minutes;

  seconds = (seconds < 10) ? "0" + seconds : seconds;

  if (hours == "00")

    return minutes + ":" + seconds;

  else

    return hours + ":" + minutes + ":" + seconds;

}



function trackClick() {

  $('#tracks_list a').click(function() {

    var url = $(this).data('url') + "?" + clientid;

    var title = $(this).data('title');

    var artist = $(this).data('artist');

    $(this).addClass('playedSong');

    $('#navbar h2').html(title);

    var audioPlayer = document.getElementById('player');

    audioPlayer.src = url;

    audioPlayer.load();

    document.getElementById('player').play();

    document.title = "Playing " + title;

    $('#play23a').hide();

    $("#sc23").hide();

    $("#pause23a").show();

    $('#sc24').html(title);

    //$("#sounds").hide();

    return false;

  });

}



var vid = document.getElementById("player");

function playVid() {

  player.play();

  document.title = "Playing music";

  $("#play23a").hide();

  $("#pause23a").show();

}



function pauseVid() {

  player.pause();

  document.title = "Pausing music";

  $("#pause23a").hide();

  $("#play23a").show();

}



$("#play23a").click(function() {

  document.title = "Playing music";

  $("#play23a").hide();

  $("#pause23a").show();



});



$("#pause23a").click(function() {

  document.title = "Pausing music";

  $("#pause23a").hide();

  $("#play23a").show();



});



function play_control()

{

  $(".title2").click(function() {

    $('#sc23').html("<i class='fa fa-play-circle'> </i>");

    playVid();

    pause_control();

  });

}

function detectIE() {
  var ua = window.navigator.userAgent;

  var msie = ua.indexOf('MSIE ');
  if (msie > 0) {
    // IE 10 or older => return version number
    return parseInt(ua.substring(msie + 5, ua.indexOf('.', msie)), 10);
  }

  var trident = ua.indexOf('Trident/');
  if (trident > 0) {
    // IE 11 => return version number
    var rv = ua.indexOf('rv:');
    return parseInt(ua.substring(rv + 3, ua.indexOf('.', rv)), 10);
  }

  var edge = ua.indexOf('Edge/');
  if (edge > 0) {
    // Edge (IE 12+) => return version number
    return parseInt(ua.substring(edge + 5, ua.indexOf('.', edge)), 10);
  }

  // other browser
  return false;
}

var browser = detectIE();

if (browser === false) {} else {
  $("#blur-img").css('background', '#dddfe2');
}
/************************************************************************/
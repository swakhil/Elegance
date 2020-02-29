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

 function ChangeMessageUrl(url,pagename) {

  if (typeof (history.pushState) != "undefined") {

 var new_url = site_url+'messages/'+url;

 window.history.pushState("data","Title",new_url);

 document.title=pagename;

}

 else {

        alert("Browser does not support HTML5.");

      }

} 



function show_message(username) {

  var token = jQuery("#token_id").val();

  if(typeof username !== 'undefined' && username !== '')

  {

          $.ajax({

            type : "POST",

            url: site_url+"ajax/message-post",

            data : {

                u : username,

                token : token

            },

            cache : false,

            success : function(data) {

              $('.message-text-display').html(data);

            }

        });

          $.ajax({

            type : "POST",

            url: site_url+"ajax/message-online",

            data : {

                u : username,

                token : token

            },

            cache : false,

            success : function(data) {

              $('.message-caption').html(data);

            }

        });



    }

}



function show_message_MS() {

  var token = jQuery("#token_id").val();

  var helpjs = $('.message-text-display').attr('getu');

    if (helpjs !== '') {

          $.ajax({

            type : "POST",

            url: site_url+"ajax/message-post",

            data : {

                u : helpjs,

                token : token

            },

            cache : false,

            success : function(data) {

              $('.message-text-display').html(data);

            }

        });

          $.ajax({

            type : "POST",

            url: site_url+"ajax/message-online",

            data : {

                u : helpjs,

                token : token

            },

            cache : false,

            success : function(data) {

              $('.message-caption').html(data);

            }

        });

    }

}



//Load Message Text Interval 

   var interval_start = setInterval(function(){

    show_message_MS();

  }, 3000);



   var intervalafter = setInterval(function(){

               show_message(username);

              }, 3000);

 /*******************/



   $(document).on('click', '.add-active', function(e) {

        clearInterval(interval_start);

        clearInterval(intervalafter);

        $('.actives').removeClass('actives');

        $('.mess-badge').hide();

        cvid = $(this).attr('cvid');

        username = $('.cm_'+cvid).attr('username');

        fullname = $(this).attr('fullname');

        user_to = $(this).attr('user-to');

        $('.message_write').show();

        $('.cm_'+cvid).addClass('actives');

        $('.message-text-display').html('<center><i class="fa fa-spinner fa-pulse fa-3x fa-fw" style="color: gray; margin-top: 15%;"></i><span class="sr-only">Loading...</span></center>');



            $.ajax({

            type : "POST",

            url: site_url+"ajax/message-post",

            data : {

                cvid_2 : cvid,

                token : token

            },

            cache : false,

            success : function(data) {

              $('.message-text-display').html(data);

               intervalafter = setInterval(function(){

               show_message(username);

              }, 3000);

              $('.message-title').html(fullname);

              $(".chat_area").scrollTop($(".chat_area")[0].scrollHeight);

              $('.send-message').attr("cvid", cvid);

              $('.send-message').attr("user-to", user_to);

              ChangeMessageUrl(username, 'Messenger | '+username.ucfirst());

            }

        });



        // Cancel the default action

    e.preventDefault();

    });



      $(window).load(function() {

        $(".chat_area").scrollTop($(".chat_area")[0].scrollHeight);

    });





/*Message*/

 jQuery(document).ready(function() {

   $(document).on('click', ".send-message", function(e) {

    $('.message_write').show();

    var msg = $('#message-area').val();

    var obj = jQuery(this);

    var cvid = jQuery(this).attr('cvid');

    var user_to = jQuery(this).attr('user-to');

    if(msg.trim() != '') {

    jQuery(this).attr("disabled", "disabled");

    jQuery(this).html('<i class="fa fa-spinner fa-pulse fa-3x fa-fw" id="post-spinner"></i><span class="sr-only">Loading...</span>');

    jQuery(this).css('cursor', 'default');

    var str = "message="+msg+"&cvid="+cvid+"&user_to="+user_to;

    var str = str+"&token="+token;

          jQuery.ajax({

          type: "POST",

          url: site_url+"ajax/message-post",

          data: str,

          cache: false,

          success: function(html){

            $('.message-text-display').html(html);

            obj.attr("disabled", false);

            obj.html('Send');

            $(".chat_area").scrollTop($(".chat_area")[0].scrollHeight);

            $('#message-area').val('');

            obj.css('cursor', 'pointer');

        }

      });

     }

    return false;

  });



   $(document).on('click', '.delete-msg', function(e) {

          var mid =  $(this).attr('mid');

          var data_mid =  $(this).attr('data-mid');

          var obj = $(this);

          var str = "mid="+mid+"&data_mid="+data_mid;

          var str = str+"&token="+token;

          swal({   title: "Are you sure to delete this message ?",

            text: "This action doesn't delete the message already sent.",

            type: "warning",   showCancelButton: true,

            confirmButtonColor: "#DD6B55",

            confirmButtonText: "Yes!",

            cancelButtonText: "No",

            closeOnConfirm: false,

            closeOnCancel: true },

            function(isConfirm){



      if (isConfirm) {

        jQuery.ajax({

         type: "POST",

         url: site_url+"ajax/delete-message",

         data: str,

         cache: false,

         success: function(data){

          swal("Deleted!", "Your message has been deleted.", "success");

        }

      });

      obj.parent().parent().hide();

     }

    });

          return false;

        });



  $(document).on('keyup', '.search-query', function(e) {

  var inputString = this.value;

  var loader = $('.loader-search-msg');



  $(document).on('click', '.search-query', function(e) {

          $("#ajax-list-user").fadeIn();

          return false;

        });



      $(document).click(function()

        {

          $("#ajax-list-user").hide();

        });



        if(inputString.length == 0) {

            document.getElementById("ajax-list-user").innerHTML=""; 

            return false;

          }

          else {

            loader.html('<i class="fa fa-spinner fa-pulse fa-3x fa-fw" id="post-spinner-cl"></i><span class="sr-only">Loading...</span>');

            $.post(site_url+"ajax/query-user-messages", {key_user: ""+inputString+""}, function(data){

                if(data.length >0) {

                    loader.html('');

                    $('#ajax-list-user').html(data);

                  }

                  else

                  {

                    loader.html('');

                  }

             });

           }

      });

 });

 /*******************/
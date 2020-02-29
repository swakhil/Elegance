

var searchVisible = 0;
var transparent = true;

var transparentDemo = true;
var fixedTop = false;

var navbar_initialized = false;

$(document).ready(function(){
    window_width = $(window).width();
    
    // check if there is an image set for the sidebar's background
    lbd.checkSidebarImage();
    
    // Init navigation toggle for small screens   
    if(window_width <= 991){
        lbd.initRightMenu();   
    }
     
    //  Activate the tooltips   
    $('[rel="tooltip"]').tooltip();

    //      Activate the switches with icons 
    if($('.switch').length != 0){
        $('.switch')['bootstrapSwitch']();
    }  
    //      Activate regular switches
    if($("[data-toggle='switch']").length != 0){
         $("[data-toggle='switch']").wrap('<div class="switch" />').parent().bootstrapSwitch();     
    }
     
    $('.form-control').on("focus", function(){
        $(this).parent('.input-group').addClass("input-group-focus");
    }).on("blur", function(){
        $(this).parent(".input-group").removeClass("input-group-focus");
    });
      
});

// activate collapse right menu when the windows is resized 
$(window).resize(function(){
    if($(window).width() <= 991){
        lbd.initRightMenu();   
    }
});
    
lbd = {
    misc:{
        navbar_menu_visible: 0
    },
    
    checkSidebarImage: function(){
        $sidebar = $('.sidebar');
        image_src = $sidebar.data('image');
        
        if(image_src !== undefined){
            sidebar_container = '<div class="sidebar-background" style="background-image: url(' + image_src + ') "/>'
            $sidebar.append(sidebar_container);
        }  
    },
    initRightMenu: function(){  
         if(!navbar_initialized){
            $navbar = $('nav').find('.navbar-collapse').first().clone(true);
            
            $sidebar = $('.sidebar');
            sidebar_color = $sidebar.data('color');
            
            $logo = $sidebar.find('.logo').first();
            logo_content = $logo[0].outerHTML;
                    
            ul_content = '';
             
            $navbar.attr('data-color',sidebar_color);
             
            // add the content from the sidebar to the right menu
            content_buff = $sidebar.find('.nav').html();
            ul_content = ul_content + content_buff;
            
            //add the content from the regular header to the right menu
            $navbar.children('ul').each(function(){
                content_buff = $(this).html();
                ul_content = ul_content + content_buff;   
            });
             
            ul_content = '<ul class="nav navbar-nav">' + ul_content + '</ul>';
            
            navbar_content = logo_content + ul_content;
            
            $navbar.html(navbar_content);
             
            $('body').append($navbar);
             
            background_image = $sidebar.data('image');
            if(background_image != undefined){
                $navbar.css('background',"url('" + background_image + "')")
                       .removeAttr('data-nav-image')
                       .addClass('has-image');                
            }
             
             
             $toggle = $('.navbar-toggle');
             
             $navbar.find('a').removeClass('btn btn-round btn-default');
             $navbar.find('button').removeClass('btn-round btn-fill btn-info btn-primary btn-success btn-danger btn-warning btn-neutral');
             $navbar.find('button').addClass('btn-simple btn-block');
            
             $toggle.click(function (){    
                if(lbd.misc.navbar_menu_visible == 1) {
                    $('html').removeClass('nav-open'); 
                    lbd.misc.navbar_menu_visible = 0;
                    $('#bodyClick').remove();
                     setTimeout(function(){
                        $toggle.removeClass('toggled');
                     }, 400);
                
                } else {
                    setTimeout(function(){
                        $toggle.addClass('toggled');
                    }, 430);
                    
                    div = '<div id="bodyClick"></div>';
                    $(div).appendTo("body").click(function() {
                        $('html').removeClass('nav-open');
                        lbd.misc.navbar_menu_visible = 0;
                        $('#bodyClick').remove();
                         setTimeout(function(){
                            $toggle.removeClass('toggled');
                         }, 400);
                    });
                   
                    $('html').addClass('nav-open');
                    lbd.misc.navbar_menu_visible = 1;
                    
                }
            });
            navbar_initialized = true;
        }
   
    }
}


// Returns a function, that, as long as it continues to be invoked, will not
// be triggered. The function will be called after it stops being called for
// N milliseconds. If `immediate` is passed, trigger the function on the
// leading edge, instead of the trailing.

function debounce(func, wait, immediate) {
	var timeout;
	return function() {
		var context = this, args = arguments;
		clearTimeout(timeout);
		timeout = setTimeout(function() {
			timeout = null;
			if (!immediate) func.apply(context, args);
		}, wait);
		if (immediate && !timeout) func.apply(context, args);
	};
};

   $(document).ready(function() { 
   var token = jQuery("#token_id").val();

   $(document).on('click', '#pic_del', function(e) {
    var img ='ads_img_1';
    var str = "img="+img+"&token="+token;
    jQuery.ajax({
          type: "POST",
          url: "ajax/delete",
          data: str,
          
          success: function(html){
            $('#preview').html(html);
            }
      });
   });

   $(document).on('click', '#pic2_del', function(e) {
    var img ='ads_img_2';
    var str = "img="+img+"&token="+token;
    jQuery.ajax({
          type: "POST",
          url: "ajax/delete",
          data: str,
          
          success: function(html){
            $('#preview2').html('');
            }
      });
   });

  $(document).on('click', '#pic', function(e) {
    var buttonfile = $("#photoimg");
    buttonfile.click();
    $('#imageform').on('change', buttonfile, function(e) {
           $("#preview").html('');
           $("#preview").html('<img src="assets/img/loader.gif" alt="Uploading...."/>');
           $("#imageform").ajaxForm(function(result){
            if(result != '') {
              $("#preview").html(result);
             }
             else
             {
              $("#preview").html('');
             }
            }).submit();
      });
    // Cancel the default action
    e.preventDefault();
   
       });
   
   $(document).on('click', '#pic2', function(e) {
    var buttonfile = $("#photoimg2");
    buttonfile.click();
    $('#imageform2').on('change', buttonfile, function(e) {
           $("#preview2").html('');
           $("#preview2").html('<img src="assets/img/loader.gif" alt="Uploading...."/>');
           $("#imageform2").ajaxForm(function(result){
            if(result != '') {
              $("#preview2").html(result);
             }
             else
             {
              $("#preview2").html('');
             }
            }).submit();
      });
    // Cancel the default action
    e.preventDefault();
   
       });
   
   
   $(document).on('click', '#pic3', function(e) {
    var buttonfile = $("#photoimg3");
    buttonfile.click();
    $('#imageform3').on('change', buttonfile, function(e) {
           $("#preview3").html('');
           $("#preview3").html('<img src="assets/img/loader.gif" alt="Uploading...."/>');
           $("#imageform3").ajaxForm(function(result){
            if(result != '') {
              $("#preview3").html(result);
             }
             else
             {
              $("#preview3").html('');
             }
            }).submit();
      });
    // Cancel the default action
    e.preventDefault();
   
       });
   
  $(document).on('click', '#pic4', function(e) {
    var buttonfile = $("#photoimg4");
    buttonfile.click();
    $('#imageform4').on('change', buttonfile, function(e) {
           $("#preview4").html('');
           $("#preview4").html('<img src="assets/img/loader.gif" alt="Uploading...."/>');
           $("#imageform4").ajaxForm(function(result){
            if(result != '') {
              $("#preview4").html(result);
             }
             else
             {
              $("#preview4").html('');
             }
            }).submit();
      });
    // Cancel the default action
    e.preventDefault();
   
       });

  $(document).on('click', '#pic5', function(e) {
    var buttonfile = $("#photoimg5");
    buttonfile.click();
    $('#imageform5').on('change', buttonfile, function(e) {
           $("#preview5").html('');
           $("#preview5").html('<img src="assets/img/loader.gif" alt="Uploading...."/>');
           $("#imageform5").ajaxForm(function(result){
            if(result != '') {
              $("#preview5").html(result);
             }
             else
             {
              $("#preview5").html('');
             }
            }).submit();
      });
    // Cancel the default action
    e.preventDefault();
   
       });

  $(document).on('click', '#piclogo', function(e) {
    var buttonfile = $("#photoimglogo");
    buttonfile.click();
    $('#imageformlogo').on('change', buttonfile, function(e) {
           $("#previewlogo").html('');
           $("#previewlogo").html('<img src="assets/img/loader.gif" alt="Uploading...."/>');
           $("#imageformlogo").ajaxForm(function(result){
            if(result != '') {
              $("#previewlogo").html(result);
             }
             else
             {
              $("#previewlogo").html('');
             }
            }).submit();
      });
    // Cancel the default action
    e.preventDefault();
   
       });

   $(document).on('click', '#picfavicon', function(e) {
    var buttonfile = $("#photoimgfavicon");
    buttonfile.click();
    $('#imageformfavicon').on('change', buttonfile, function(e) {
           $("#previewfavicon").html('');
           $("#previewfavicon").html('<img src="assets/img/loader.gif" alt="Uploading...."/>');
           $("#imageformfavicon").ajaxForm(function(result){
            if(result != '') {
              $("#previewfavicon").html(result);
             }
             else
             {
              $("#previewfavicon").html('');
             }
            }).submit();
      });
    //buttonfile.setClickable(false);
    // Cancel the default action
    e.preventDefault();
   
       });
   
   }); 

jQuery(document).ready(function() {
  autosize($('textarea'));
});

jQuery(document).ready(function() {
   $(document).on('click', ".block-ajax", function(e) {
    var link =  jQuery(this).attr('link');
    var id = jQuery(this).attr('id');
    var q = jQuery(this).attr('q');
    var p = jQuery(this).attr('p');
    var c = jQuery(this).attr('c');
    var token = $('#token').val();
        swal({   title: "Do you want to block this user ?",
            text: "This is definitive!",
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
          url: link,
          data : {
                q : q,
                c : c,
                p : p,
                token : token,
            },
          success: function(htmls){
           jQuery.ajax({
           type: "POST",
           url: 'ajax/show-table-col',
           data : {
                id : id,
                flag : 'block',
                token : token,
            },
           success: function(html){
              $('#details').html(htmls);
              swal("Active", "This account has been blocked.", "success");
              $('#table-options-'+id).html(html);
           }
         });
        }
      });
     }
    });
    return false;

    // Cancel the default action
    e.preventDefault();
  });

   $(document).on('click', ".delete-ajax", function(e) {
    var link =  jQuery(this).attr('link');
    var id = jQuery(this).attr('id');
    var q = jQuery(this).attr('q');
    var c = jQuery(this).attr('c');
    var p = jQuery(this).attr('p');
    var token = $('#token').val();
        swal({   title: "Do you want to delete this user ?",
            text: "This is definitive!",
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
          url: link,
          data : {
                q : q,
                c : c,
                p : p,
                token : token,
            },
          success: function(htmls){
              $('#details').html(htmls);
              swal("Deleted!", "This user has been deleted.", "success");
              $('#table-options-'+id).remove();
        }
      });
     }
    });
    return false;

    // Cancel the default action
    e.preventDefault();
  });

   $(document).on('click', ".activate-ajax", function(e) {
    var link =  jQuery(this).attr('link');
    var id = jQuery(this).attr('id');
    var q = jQuery(this).attr('q');
    var c = jQuery(this).attr('c');
    var p = jQuery(this).attr('p');
    var token = $('#token').val();
        swal({   title: "Do you want to activate the account of this user ?",
            text: "This is definitive!",
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
          url: link,
          data : {
                q : q,
                c : c,
                p : p,
                token : token,
            },
          success: function(htmls){
           jQuery.ajax({
           type: "POST",
           url: 'ajax/show-table-col',
           data : {
                id : id,
                flag : 'activate',
                token : token,
            },
           success: function(html){
              $('#details').html(htmls);
              swal("Active", "This account has been activated.", "success");
              $('#table-options-'+id).html(html);
           }
         });
        }
      });
     }
    });
    return false;

    // Cancel the default action
    e.preventDefault();
  });

   $(document).on('click', ".view-more", function(e) {

    // Cancel the default action
    e.preventDefault();
  });

 });



jQuery(document).ready(function() {
   
   $('#seo').focus();
   $(document).on('click', "#submit_seo", function(e) {
    var seo =  $('#seo').text();
    var token = $('#token').val();
    jQuery.ajax({
           type: "POST",
           url: 'ajax/save-seo',
           data : {
                seo : seo,
                token : token,
            },
           success: function(html){
              $('#details').html(html);
           }
         });
    return false;
    // Cancel the default action
    e.preventDefault();
    });

   $(document).on('click', "#update_submit", function(e) {
    var privacy = $("#privacy").Editor("getText");
    var str = jQuery("#form-privacy").serialize();
    var str = str+"&privacy="+privacy;
    jQuery.ajax({
           type: "POST",
           url: 'ajax/general.func',
           data : str,
           success: function(html){
              swal({   title: "Notice",
            text: html,
            html: true,
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "View",
            cancelButtonText: "OK",
            closeOnConfirm: true,
            closeOnCancel: true },
            function(isConfirm){
                if (isConfirm) {
                document.location="general.php";
             }
            });
           }
         });
    return false;
    // Cancel the default action
    e.preventDefault();
    });

  });


 $(document).ready(function() { 
   
  $(document).on('click', '#pic_ads', function(e) {
    var buttonfile = $("#photoimg");
    buttonfile.click();
    $('#imageform').on('change', buttonfile, function(e) {
           $("#preview").html('');
           $("#preview").html('<img src="assets/img/loader.gif" alt="Uploading...."/>');
           $("#imageform").ajaxForm(function(result){
            if(result != '') {
              $("#preview").html("<img class='img-responsive' src='"+result+"'  class='preview'>");
              $("#ads_img_1").val(result);
             }
             else
             {
              $("#preview").html('');
             }
            }).submit();
      });
     buttonfile.setClickable(false);
    // Cancel the default action
    e.preventDefault();
   
       });
   
   $(document).on('click', '#pic2_ads', function(e) {
    var buttonfile = $("#photoimg2");
    buttonfile.click();
    $('#imageform2').on('change', buttonfile, function(e) {
           $("#preview2").html('');
           $("#preview2").html('<img src="assets/img/loader.gif" alt="Uploading...."/>');
           $("#imageform2").ajaxForm(function(result){
            if(result != '') {
              $("#preview2").html("<img class='img-responsive' src='"+result+"'  class='preview'>");
              $("#ads_img_2").val(result);
             }
             else
             {
              $("#preview2").html('');
             }
            }).submit();
      });
     buttonfile.setClickable(false);
    // Cancel the default action
    e.preventDefault();
   
  });


   $(document).on('click', '.view-more', function(e) {
    var link =  jQuery(this).attr('link');
    var id = jQuery(this).attr('id');
    var token = jQuery(this).attr('token');
    var str = "id="+id+"&token="+token;
    jQuery.ajax({
           type: "POST",
           url: link,
           data : str,
           success: function(html){
            $('#ajax-user').html(html);
           }
         });
    return false;
    // Cancel the default action
    e.preventDefault();
   
  });

   $(document).on('click', '#save-change', function(e) {
    var link =  jQuery(this).attr('link');
    var id = jQuery(this).attr('id_user');
    var str = $("#form-user").serialize();
    var str = str+"&id="+id;
    jQuery.ajax({
           type: "POST",
           url: link,
           data : str,
           success: function(html){
            $('#table-options-'+id).html(html);
           }
         });
    return false;
    // Cancel the default action
    e.preventDefault();
   
  });


  /**POST**/

  $(document).on('click', ".delete-ajax-post", function(e) {
    var link =  jQuery(this).attr('link');
    var pid = jQuery(this).attr('pid');
    var q = jQuery(this).attr('q');
    var c = jQuery(this).attr('c');
        swal({   title: "Do you want to delete this post ?",
            text: "This is definitive!",
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
          url: link,
          data : {
                q : q,
                token : c,
                pid : pid,
            },
          success: function(htmls){
              $('#details').html(htmls);
              swal("Deleted!", "This post has been deleted.", "success");
              $('#table-options-post-'+pid).remove();
        }
      });
     }
    });
    return false;

    // Cancel the default action
    e.preventDefault();
  });
});

$(document).on('click', '.view-more-post', function(e) {
    var link =  jQuery(this).attr('link');
    var pid = jQuery(this).attr('pid');
    var token = jQuery(this).attr('token');
    var str = "pid="+pid+"&token="+token;
    jQuery.ajax({
           type: "POST",
           url: link,
           data : str,
           success: function(html){
            $('#ajax-post').html(html);
           }
         });
    return false;
    // Cancel the default action
    e.preventDefault();
   
  });

   $(document).on('click', '#save-change-post', function(e) {
    var link =  jQuery(this).attr('link');
    var pid = jQuery(this).attr('pid');
    var str = $("#form-post").serialize();
    var str = str+"&pid="+pid;
    jQuery.ajax({
           type: "POST",
           url: link,
           data : str,
           success: function(html){
            $('#table-options-post-'+pid).html(html);
           }
         });
    return false;
    // Cancel the default action
    e.preventDefault();
   
  });
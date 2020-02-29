
 <!--Plugins SweetAlert -->
 <script src="<?php echo $site_url; ?>assets/plugins/sweetalert/dist/sweetalert-dev.js"></script>

 <!--Plugins jQuery and dependancies-->
 <script src="<?php echo $site_url; ?>assets/js/ajaxupload.3.5.js" type="text/javascript"></script>
 <script type="text/javascript" src="<?php echo $site_url; ?>assets/js/jquery.form.js"></script>
 <script src="<?php echo $site_url; ?>assets/js/draggable_background.js"></script>
 <script src="<?php echo $site_url; ?>assets/js/main.js" type="text/javascript"></script>
 <?php
 if ($page == 'messages') {
     echo '<script src="'.$site_url.'assets/js/messages.js"></script>';
 }

 if (isset($_GET['u']) && $page == 'message') {
     ?>
 	   <script type="text/javascript">
    jQuery.fn.scrollTo = function(elem, speed) {
        $(this).animate({
                scrollTop: $(this).scrollTop()-
                $(this).offset().top+
                $(elem).offset().top},
            speed == undefined? 2000:
                speed);
        return this;

    };

   $(window).load(function() {
        $(".member_list").scrollTo(".cm_<?php echo $cvid; ?>");
    });
   </script>
 	<?php
 }
 ?>
 <?php
 if ($page == 'followers' || $page == 'following' || $page == 'photos' && $page != 'messages') {
     echo '<script src="'.$site_url.'assets/js/loadmore-user.js"></script>';
 } elseif ($page == 'saved') {
     echo '<script src="'.$site_url.'assets/js/loadmore-saved.js"></script>';
 } elseif ($page == 'settings') {
 } elseif ($page == 'hashtag') {
     echo '<script src="'.$site_url.'assets/js/loadmore-hashtag.js"></script>';
 } else {
     echo '<script src="'.$site_url.'assets/js/loadmore.js"></script>';
 }
 ?>
        <!-- please download excanvas if you use ie -->
        <!--[if IE]>
        <script type="text/javascript" src="<?php echo $site_url; ?>assets/js/excanvas.js"></script>  
        <![endif]-->
        <script type="text/javascript" src="<?php echo $site_url; ?>assets/js/nude.min.js"></script>
 <script src="<?php echo $site_url; ?>assets/bootstrap/js/bootstrap.js"></script>
</body>
</html>
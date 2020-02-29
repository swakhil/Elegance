<?php
include '../functions/functions.php';

//Applying CSRF, XSS Protection
if (verify_token_general($name = $id_csrf)) {
    if (isset($_SESSION['id'])) {
        echo count_global_message(returnID(), true);

        if (count_global_message(returnID(), false) > 0) {
            ?>
         <script type='text/javascript'>
                var count = <?php echo count_global_message(returnID(), false); ?>;
                $('#badge-mess-color').css("color", '#fff');
        </script>
<?php
        } elseif (count_global_message(returnID(), false) == '0') {
            ?>
	 <script type='text/javascript'>
	 var aria_expanded = $('#message-click').attr('aria-expanded');
	  if(aria_expanded == 'false') {
             $('#badge-mess-color').css("color", '#1d698c');
          }
        </script>
	<?php
        }
    }
}
?>
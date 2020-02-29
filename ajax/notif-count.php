<?php
include '../functions/functions.php';

//Applying CSRF, XSS Protection
if (verify_token_general($name = $id_csrf)) {
    if (isset($_SESSION['id'])) {
        echo notif_count(true);

        if (notif_count() > '0') {
            ?>
         <script type='text/javascript'>
                $('#badge-notif-color').css("color", '#fff');
        </script>
<?php
        } elseif (notif_count() == '0') {
            ?>
	 <script type='text/javascript'>
	  var aria_expanded = $('#notif-click').attr('aria-expanded');
	  if(aria_expanded === 'false') {
              $('#badge-notif-color').css("color", '#1d698c');
          }
     </script>
	<?php
        }
    } ?>
    <script type='text/javascript'>
	  var count = <?php echo notif_count() + count_global_message(returnID(), false); ?>;
	  if(count > 0)
	  {
	  	document.title= '('+count+') '+title;
	  }
	  else
	  {
	  	if(count == 0)
	  {
	  	document.title= title;
	  }
	  }
    </script>

<?php
}
?>
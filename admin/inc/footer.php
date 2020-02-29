</div>

</body>
<!--   Core JS Files   -->
<script src="assets/js/autosize.js"></script>
 <!--Plugins SweetAlert -->
 <script src="<?php echo $site_url; ?>admin/assets/sweetalert/dist/sweetalert-dev.js"></script>
<script src="assets/js/bootstrap.min.js" type="text/javascript"></script>
<script src="assets/js/dashboard.js"></script>
<script src="assets/js/script-chart.js"></script>
<script type="text/javascript" src="assets/js/jquery.form.js"></script>

	<?php 
    if ($page == 'general') {
        ?>
		<script src="<?php echo $site_url; ?>admin/assets/js/editor.js"></script>
		<script type="text/javascript">
		$(document).ready(function() {
          var html = $("#privacy").text();
          var editor = $("#privacy").Editor();
          var text_privacy = html;
          $("#privacy").Editor("setText", text_privacy);
      });
		</script>
		<?php
    }
    ?>
</html>

<!-- Large Modal User -->
<div class="modal fade bd-example-modal-lg" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content" id="ajax-user">
      
    </div>
  </div>
</div>

<!-- Large Modal Post -->
<div class="modal fade bd-example-modal-lg" id="modal-post" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content" id="ajax-post">
      
    </div>
  </div>
</div>
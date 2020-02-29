<?php
include '../functions/functions.php';

//Applying CSRF, XSS Protection
if (verify_token_general($name = $id_csrf)) {
    ?>
<div class="col-sm-10 col-sm-offset-1">
<form method="POST" id="general-form">
                                          <label class="control-label">Users Blocked </label>
                                             <input name="userblocked" type="text" class="form-control" id="settings-input">
</form>
</div>
<?php
}
?>
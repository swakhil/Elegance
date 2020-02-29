<?php
include '../functions/functions.php';

//Applying CSRF, XSS Protection
if (verify_token_general($name = $id_csrf)) {
    ?>
<form method="POST" id="general-form">
                                    <div class="col-sm-10 col-sm-offset-1">
                                       <label>
                                          <span class="text"><span class="text-design"><i class="fa fa-trash fa-fw"></i> Delete account.</span></span>
                                        </label>
                                        <input type="hidden" name="deleted">
                                         <div class="pull-right" style="margin-top: 15px;">
                                        <input type='submit' class='btn btn-finish btn-fill btn-success btn-wd' name='delete' id="update_delete" value='Delete account' />
                                        </div>
   </div>
</form>
<?php
}
?>
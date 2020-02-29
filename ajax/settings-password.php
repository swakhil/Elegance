<?php
include '../functions/functions.php';

//Applying CSRF, XSS Protection
if (verify_token_general($name = $id_csrf)) {
    ?>
<div class="col-sm-10 col-sm-offset-1">
  <form method="POST" id="general-form">
                                             <label class="control-label">Actual Password </label>
                                             <input name="password" type="password" class="form-control" id="settings-input">
                                       <br/>
                                             <label class="control-label">New Password </label>
                                             <input name="newpassword" type="password" class="form-control" id="settings-input">
                                       <br/>
                                    
                                             <label class="control-label">New Password Again </label>
                                             <input name="newpasswordagain" type="password" class="form-control" id="settings-input">
                                       
                                           <br/>
                                          <div class="pull-right" style="margin-top: 15px;">
                                            <input type='submit' class='btn btn-finish btn-fill btn-success btn-wd' id='update_password' value='Update' />
                                          </div>
                                        </form>
 </div>
 <?php
}
?>
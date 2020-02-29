<?php
include '../includes/settings-notif.php';

//Applying CSRF, XSS Protection
if (verify_token_general($name = $id_csrf)) {
    ?>
<form method="POST" id="general-form">
                                    <div class="col-sm-10 col-sm-offset-1">
                                       <label>
                                          <input class="checkbox-slider slider-icon colored-blue" type="checkbox" id="settings-input" name="email_follow" <?php echo $checked_follows; ?> >
                                          <span class="text"><span class="text-design">E-mail me when someone follows me.</span></span>
                                        </label>
                                       <br/>

                                       <label>
                                          <input class="checkbox-slider slider-icon colored-blue" type="checkbox" id="settings-input" name="email_comments" <?php echo $checked_comments; ?> >
                                          <span class="text"><span class="text-design">E-mail me when someone comments on my posts.</span></span>
                                        </label>
                                       <br/>
                                        
                                         <label>
                                          <input class="checkbox-slider slider-icon colored-blue" type="checkbox" id="settings-input" name="email_likes" <?php echo $checked_likes; ?> >
                                          <span class="text"><span class="text-design"> E-mail me when someone likes my post.</span></span>
                                        </label>
                                       <br/>

                                        <label>
                                          <input class="checkbox-slider slider-icon colored-blue" type="checkbox" id="settings-input" name="email_shares" <?php echo $checked_shares; ?>>
                                          <span class="text"><span class="text-design">E-mail me when someone shares my post.</span></span>
                                        </label>

                                        <label>
                                          <input class="checkbox-slider slider-icon colored-blue" type="checkbox" id="settings-input" name="email_messages" <?php echo $checked_messages; ?>>
                                          <span class="text"><span class="text-design">E-mail me when someone messages me.</span></span>
                                       </label>

                                       <label>
                                          <input class="checkbox-slider slider-icon colored-blue" type="checkbox" id="settings-input" name="block_adult_content" <?php echo $checked_adult_content; ?>>
                                          <span class="text"><span class="text-design">Enable restriction of adult content.</span></span>
                                       </label>
                                        

                                        <div class="pull-right" style="margin-top: 15px;">
                                         <input type='submit' class='btn btn-finish btn-fill btn-success btn-wd' name='update_email' id="update_email" value='Update' />
                                        </div>
          </div>
        </form>
<?php
}
?>
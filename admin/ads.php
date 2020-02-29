<?php
// +------------------------------------------------------------------------+
// | @Team author : Smart Xplorer (smartxplorer)
// | @Team author email: smartxplorerdev@gmail.com
// +------------------------------------------------------------------------+
// | Elegance - The Elegant Social Network Platform
// | Copyright (c) 2017 Elegant. All rights reserved.
// +------------------------------------------------------------------------+
   $page = 'ads';
   include_once 'functions/functions.php';
   include 'inc/ads.func.php';
   include 'inc/header.php';
   $data = fetch_general_settings();
   foreach ($data as $row) {
       ?>
<div class="content">
   <div class="container-fluid">
      <div class="row">
         <div class="col-md-12">
            <div class="card">
               <div class="header">
                  <h4 class="title">Website Ads</h4>
               </div>
                <div class="content">
                 <div class="container-fluid">

                  <hr/>
                  <p class="col-sm-12" > <?php echo $msg; ?> </p>
                  <form method="POST" action="">
                    <div class="row">
                      <div class="col-md-12">
                        <label>
                          <input class="checkbox-slider slider-icon colored-blue" type="checkbox" id="settings-input" name="enable_ads" <?php echo $checked_enable_ads; ?>>
                            <span class="text"><span class="text-design">Enable ads on Website</span></span>
                        </label>
                      </div>
                    </div>
                    <h5>Enter Ads Code (Eg : google ads sense code)</h5>
                     <div class="row">
                        <div class="col-md-12">
                           <div class="form-group">
                              <label>Ads 1 - Position: Right side (Container min-width: 321px)</label>
                             <textarea name="ads_1" class="form-control" placeholder="Enter ads code" id="textarea-ads"><?php echo trim($row['ads_1']); ?></textarea>
                           </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-12">
                           <div class="form-group">
                              <label>Ads 2 - Position: timeline (Container min-width: 506px)</label>
                              <textarea name="ads_2" class="form-control" placeholder="Enter ads code" id="textarea-ads"><?php echo trim($row['ads_2']); ?></textarea>
                           </div>
                        </div>
                     </div>
                     <br/>
                      <hr/>
                     <h5>Create your own ads</h5>
                     <div class="row">
                      <div class="col-md-12">
                        <label>
                          <input class="checkbox-slider slider-icon colored-blue" type="checkbox" id="settings-input" name="ads_options" <?php echo $checked_ads_options; ?>>
                            <span class="text"><span class="text-design">Enable your own ads (this will disable ads codes).</span></span>
                        </label>
                      </div>
                    </div>
                     <div class="row">
                        <div class="col-md-12">
                           <div class="form-group">
                              <label>Ads 1 - Position: Right side (Container min-width: 321px)</label>
                              <input type="text" class="form-control" name="ads_link_1" placeholder="Ads Link" value="<?php echo trim($row['ads_link_1']); ?>">
                              <textarea name="ads_text_1" class="form-control" placeholder="Ads text" id="textarea-ads"><?php echo trim($row['ads_text_1']); ?></textarea>
                              <input name="ads_img_1" type="hidden" id="ads_img_1" value="<?php echo $row['ads_img_1']; ?>">
                             <div class="col-md-3">
                              <div class="form-group">
                              <label>Ads Image</label>
                              <br/><span id="pic_ads"><span class="fa fa-camera"></span> Upload</span>
                              <span id="pic_del" class="fa-design"><span class="fa fa-trash"></span> Delete </span>
                              <div id='preview'><?php echo ShowImageAds($row['ads_img_1']); ?></div>
                              </div>
                            </div>
                           </div>
                        </div>
                     </div>

                      <div class="row">
                        <div class="col-md-12">
                           <div class="form-group">
                              <label>Ads 2 - Position: timeline (Container min-width: 506px)</label>
                              <input type="text" class="form-control" name="ads_link_2" placeholder="Ads Link" value="<?php echo trim($row['ads_link_2']); ?>">
                              <textarea name="ads_text_2" class="form-control" placeholder="Ads text" id="textarea-ads"><?php echo trim($row['ads_text_2']); ?></textarea>
                              <input type="hidden" name="ads_img_2" id="ads_img_2" value="<?php echo $row['ads_img_2']; ?>">
                            <div class="col-md-3">
                             <div class="form-group">
                              <label>Ads Image</label>
                              <br/><span id="pic2_ads"><span class="fa fa-camera"></span> Upload </span>
                              <span id="pic2_del" class="fa-design"><span class="fa fa-trash"></span> Delete </span>
                              <div id='preview2'><?php echo ShowImageAds($row['ads_img_2']); ?></div>
                            </div>
                           </div>
                          </div>
                        </div>
                     </div>
                     <input type="hidden" name="ads_link_3"> <input type="hidden" name="ads_link_4">

                     <input type="hidden" name="token" value="<?php echo $_SESSION[$id_csrf.'_token'] ; ?>">
                     <button type="submit" name="submit" class="btn btn-info btn-fill pull-right">Update Ads</button>
                     <div class="clearfix"></div>
                  </form>


                  <form id="imageform" method="post" enctype="multipart/form-data" action='ajax/ajaximage_ads'>
                    <input type="hidden" name="token" value="<?php echo $_SESSION[$id_csrf.'_token'] ; ?>">
                    <input type="file" class="form-control inputadm-file" name="photoimg" id="photoimg" />
                  </form>

                  <form id="imageform2" method="post" enctype="multipart/form-data" action='ajax/ajaximage2_ads'>
                    <input type="hidden" name="token" id="token_id" value="<?php echo $_SESSION[$id_csrf.'_token'] ; ?>">
                    <input type="file" class="form-control inputadm-file" name="photoimg2" id="photoimg2" />
                  </form>
                  <center>*Don't forget to press the button "Update Ads" after uploading your image ads or after adding your text ads.</center>
                  <center>*Please leave ads container empty to delete ads.</center>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<?php
   }
   ?>
    <?php
     include 'inc/footer.php';
   ?>

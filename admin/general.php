<?php

// +------------------------------------------------------------------------+
// | @Team author : Smart Xplorer (smartxplorer)
// | @Team author email: smartxplorerdev@gmail.com
// +------------------------------------------------------------------------+
// | Elegance - The Elegant Social Network Platform
// | Copyright (c) 2017 Elegant. All rights reserved.
// +------------------------------------------------------------------------+


   $page = 'general';
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
                  <h4 class="title">General Settings</h4>
               </div>
               
               <div class="content">
                <hr>
                <h5 class="title">Website Images</h5><br/>
                  <div class="row">
                     <form id="imageform" method="post" enctype="multipart/form-data" action='ajax/ajaximage'>
                        <div class="col-md-3">
                           <div class="form-group">
                              <label>Background Image Welcome 1</label>
                              <input type="file" class="form-control inputadm-file" name="photoimg" id="photoimg" />
                              <br/><span id="pic"><span class="fa fa-camera"></span> Upload & Save</span>
                              <input type="hidden" name="token" value="<?php echo $_SESSION[$id_csrf.'_token'] ; ?>">
                              <div id='preview'><img class="img-responsive" src="<?php echo $row['background_home1']; ?>" /></div>
                           </div>
                        </div>
                     </form>
                     <form id="imageform2" method="post" enctype="multipart/form-data" action='ajax/ajaximage2'>
                        <div class="col-md-3">
                           <div class="form-group">
                              <label>Background Image Welcome 2</label>
                              <input type="file" class="form-control inputadm-file" name="photoimg2" id="photoimg2" />
                              <br/><span id="pic2"><span class="fa fa-camera"></span> Upload & Save</span>
                              <input type="hidden" name="token" value="<?php echo $_SESSION[$id_csrf.'_token'] ; ?>">
                              <div id='preview2'><img class="img-responsive" src="<?php echo $row['background_home2']; ?>" /></div>
                           </div>
                        </div>
                     </form>
                     <form id="imageform3" method="post" enctype="multipart/form-data" action='ajax/ajaximage3'>
                        <div class="col-md-3">
                           <div class="form-group">
                              <label>Background Image Welcome 3</label>
                              <input type="file" class="form-control inputadm-file" name="photoimg3" id="photoimg3" />
                              <br/><span id="pic3"><span class="fa fa-camera"></span> Upload & Save</span>
                              <input type="hidden" name="token" value="<?php echo $_SESSION[$id_csrf.'_token'] ; ?>">
                              <div id='preview3'><img class="img-responsive" src="<?php echo $row['background_home3']; ?>" /></div>
                           </div>
                        </div>
                     </form>
                     <form id="imageform4" method="post" enctype="multipart/form-data" action='ajax/ajaximage4'>
                        <div class="col-md-3">
                           <div class="form-group">
                              <label>Background Image Welcome 4</label>
                              <input type="file" class="form-control inputadm-file" name="photoimg4" id="photoimg4" />
                              <br/><span id="pic4"><span class="fa fa-camera"></span> Upload & Save</span>
                              <input type="hidden" name="token" value="<?php echo $_SESSION[$id_csrf.'_token'] ; ?>">
                              <div id='preview4'><img class="img-responsive" src="<?php echo $row['background_home4']; ?>" /></div>
                           </div>
                        </div>
                     </form>
                   </div>
                     <div class="row">
                     <form id="imageform5" method="post" enctype="multipart/form-data" action='ajax/ajaximage5'>
                        <div class="col-md-4">
                           <div class="form-group">
                              <label>Background Image Login/Signup </label>
                              <input type="file" class="form-control inputadm-file" name="photoimg5" id="photoimg5" />
                              <br/><span id="pic5"><span class="fa fa-camera"></span> Upload & Save</span>
                              <input type="hidden" name="token" value="<?php echo $_SESSION[$id_csrf.'_token'] ; ?>">
                              <div id='preview5'><img class="img-responsive" src="<?php echo $row['background_home5']; ?>" /></div>
                           </div>
                        </div>
                     </form>
                     <form id="imageformlogo" method="post" enctype="multipart/form-data" action='ajax/ajaxlogo'>
                        <div class="col-md-4">
                           <div class="form-group">
                              <label>Logo</label>
                              <input type="file" class="form-control inputadm-file" name="photoimglogo" id="photoimglogo" />
                              <br/><span id="piclogo"><span class="fa fa-camera"></span> Upload & Save</span>
                              <input type="hidden" name="token" value="<?php echo $_SESSION[$id_csrf.'_token'] ; ?>">
                              <div id='previewlogo'><img class="img-responsive back-transparent" src="<?php echo $row['site_logo']; ?>" /></div>
                           </div>
                        </div>
                     </form>
                     <form id="imageformfavicon" method="post" enctype="multipart/form-data" action='ajax/ajaxfavicon'>
                        <div class="col-md-4">
                           <div class="form-group">
                              <label>Favicon</label>
                              <input type="file" class="form-control inputadm-file" name="photoimgfavicon" id="photoimgfavicon" />
                              <br/><span id="picfavicon"><span class="fa fa-camera"></span> Upload & Save</span>
                              <input type="hidden" name="token" value="<?php echo $_SESSION[$id_csrf.'_token'] ; ?>">
                              <div id='previewfavicon'><img class="img-responsive back-transparent" src="<?php echo $row['site_favicon']; ?>" /></div>
                           </div>
                        </div>
                     </form>
                    </div>
                  <hr/>
                  <h5 class="title">Website Informations</h5><br/>
                  <p class="col-sm-12" id="details"></p>
                  <form method="POST" action="" id="form-privacy">
                     <div class="row">
                        <div class="col-md-6">
                           <div class="form-group">
                              <label>Website Name</label>
                              <input type="text" name="site_name" class="form-control" placeholder="Website Name"
                                 value="<?php echo $row['site_name']; ?>">
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <label>Website Url</label>
                              <input type="text" name="site_url" class="form-control" placeholder="Enter your Website URL like: https://www.google.com/" value="<?php echo $row['site_url']; ?>">
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-md-6">
                           <div class="form-group">
                              <label>Website Description 1</label>
                              <input type="text" name="site_desc" class="form-control" placeholder="Website Description" value="<?php echo $row['site_desc']; ?>">
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <label>Website Description 2</label>
                              <input type="text" name="site_desc2" class="form-control" placeholder="Website Description 2" value="<?php echo $row['site_desc2']; ?>">
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-md-6">
                           <div class="form-group">
                              <label>Email noreply</label>
                              <input type="text" name="email_noreply" class="form-control" placeholder="Email noreply" value="<?php echo $row['email_noreply']; ?>">
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <label>Email for Support</label>
                              <input type="text" name="email_contact" class="form-control" placeholder="Email for support" value="<?php echo $row['email_contact']; ?>">
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-md-12">
                           <div class="form-group">
                              <label>Privacy</label>
                              <textarea name="privacy" class="form-control no-resize" placeholder="Website Privacy" id="privacy"><?php echo $row['privacy']; ?></textarea>
                           </div>
                        </div>
                     </div>
                     <input type="hidden" name="token" value="<?php echo $_SESSION[$id_csrf.'_token'] ; ?>">
                     <button type="submit" name="submit" id="update_submit" class="btn btn-info btn-fill pull-right">Update Website Informations</button>
                     <div class="clearfix"></div>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<?php
   }
   include 'inc/footer.php';
   ?>
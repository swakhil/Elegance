<?php
// +------------------------------------------------------------------------+
// | @Team author : Smart Xplorer (smartxplorer)
// | @Team author email: smartxplorerdev@gmail.com
// +------------------------------------------------------------------------+
// | Elegance - The Elegant Social Network Platform
// | Copyright (c) 2017 Elegant. All rights reserved.
// +------------------------------------------------------------------------+
$page = 'photos';
include 'includes/top-profile.php';
$page_title = $fullname.' | Photos';
include 'includes/profile-head.php';
include 'includes/profile-nav.php';
?>
            <!-- Tab panes -->
            <div class="tab-content">
             
              <!-- photos -->
              <div role="tabpanel" class="tab-pane active" id="settings">
                <div class="row">
                  <div class="col-md-12"> 
                    <ul class="gallery-list">
                      <?php
                      $data = show_friends($id, 'photos', '15');
                      foreach ($data as $row) {
                          include 'includes/load-photos.php';
                      }
                    ?>
                  </ul>
                  <ul class="gallery-list" id="loadmore-user">
                    </ul>
                  </div>
                  <div id="end-loadmore-user" class="end-loadmore"></div>
                  <div class="spinnera" id="spinner-user" <?php echo count_friends($id, 'photos', $style = true); ?>>
                      <div class="bounce1"></div>
                      <div class="bounce2"></div>
                      <div class="bounce3"></div>
                  </div>

                </div>
              </div><!-- end photos -->
            </div>
          </div>  
        </div>
      </div>
    </div>
    
  <?php
      include 'includes/modal.php';
      include 'includes/chat.php';
      include 'includes/footer.php';
?>
<?php
// +------------------------------------------------------------------------+
// | @Team author : Smart Xplorer (smartxplorer)
// | @Team author email: smartxplorerdev@gmail.com
// +------------------------------------------------------------------------+
// | Elegance - The Elegant Social Network Platform
// | Copyright (c) 2017 Elegant. All rights reserved.
// +------------------------------------------------------------------------+
$page = 'following';
include 'includes/top-profile.php';
$page_title = $fullname.' | Following';
include 'includes/profile-head.php';
include 'includes/profile-nav.php';
?>
            <!-- Tab panes -->
            <div class="tab-content">
            
              <!-- friends -->
              <div role="tabpanel" class="tab-pane active" id="messages" >
                <div class="row">
                <?php
                  $data = show_friends($id, 'following', '4');
                  foreach ($data as $row) {
                      include 'includes/load.php';
                  }
                ?>
                <div id="loadmore-user"></div>
                </div> 
                <div id="end-loadmore-user" class="end-loadmore" style="display: none;"></div>
                  <div class="spinnera" id="spinner-user" <?php echo count_friends($id, 'followers', $style = true); ?>>
                      <div class="bounce1"></div>
                      <div class="bounce2"></div>
                      <div class="bounce3"></div>
                  </div> 
              </div><!-- end friends -->
              
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
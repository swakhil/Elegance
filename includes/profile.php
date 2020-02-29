<?php
$page = 'timeline';
include 'profile-head.php';
include 'profile-nav.php';
?>
            <!-- Tab panes -->
            <div class="tab-content">
              <!-- Timeline -->
              <!-- class="tab-pane active" -->
              <div role="tabpanel" id="timeline">
                <div class="row">
                  <div class="col-md-5">
                    <div class="widget">
                    <?php echo is_follow_you($id, show_username(select_sql_id($id, 'username')).' follows you.'); ?>
                      <div class="widget-header">
                       <h3 class="widget-caption">About</h3>
                      </div>
                      <div class="widget-body bordered-top bordered-sky">
                        <ul class="list-unstyled profile-about margin-none">
                          <li class="padding-v-5">
                            <div class="row">
                              <div class="col-sm-4"><span class="text-muted">Date of Birth</span></div>
                              <div class="col-sm-8"><?php echo select_sql_id($id, 'birthday'); ?></div>
                            </div>
                          </li>
                          <li class="padding-v-5">
                            <div class="row">
                              <div class="col-sm-4"><span class="text-muted">Gender</span></div>
                              <div class="col-sm-8"><?php echo select_sql_id($id, 'sex'); ?></div>
                            </div>
                          </li>
                          <li class="padding-v-5">
                            <div class="row">
                              <div class="col-sm-4"><span class="text-muted">Lives in</span></div>
                              <div class="col-sm-8"><?php echo select_sql_id($id, 'country'); ?></div>
                            </div>
                          </li>
                          <li class="padding-v-5">
                            <div class="row">
                              <div class="col-sm-4"><span class="text-muted">About me</span></div>
                              <div class="col-sm-8 about"><?php echo select_sql_id($id, 'about'); ?></div>
                            </div>
                          </li>
                        </ul>
                      </div>
                    </div>

                    <div class="widget widget-friends">
                      <div class="widget-header">
                        <h3 class="widget-caption">Following</h3>
                      </div>
                      <div class="widget-body bordered-top  bordered-sky">
                        <div class="row">
                          <div class="col-md-12">
                            <ul class="img-grid" style="margin: 0 auto;">
                            <?php
                              $data = show_friends($id, 'following', '15');
                               foreach ($data as $row) {
                                   ?>
                              <li>
                                <a href="<?php echo $site_url.$row['username']; ?>">
                                  <img src="<?php echo $site_url.$row['avatar_thumb']; ?>" alt="<?php echo $row['username']; ?> profile's picture">
                                </a>
                              </li>
                              <?php
                               }
                             ?>
                             </ul>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <!--============= timeline posts-->
                  <div class="col-md-7">
                    <?php
                    include 'timeline.php';
                    ?>
                  </div><!-- end timeline posts-->
                </div>
              </div><!-- end timeline -->
             
            </div>
          </div>  
        </div>
      </div>
    </div>
    
  <?php
      include 'chat.php';
      include 'footer.php';
?>
         <div class="row">
            <!-- left posts-->
            <div <?php echo class_center($page); ?>>

              
             <div class="well well-sm well-social-post">
              <form  method="POST" action="" id="post_data">
              <ul class="list-inline" id='list_PostActions'>
                <li class='active lis'><a href='#'><i class="fa fa-pencil"></i> Update status</a></li>
                <li class='active lis'><a href='#'><span id="loader_post"></span></a></li>
              </ul>
            <textarea class="form-control input-lg p-text-area" rows="2" id="status" name="status" placeholder="Whats in your mind today?"></textarea>
            <div id='display-tag'></div>
            <div id="msgbox-tag"></div>
            <div class="box-footer box-form" id="img_preview" style="display: none;">
              <button type='button' class='close' id="close-img" data-dismiss='alert' aria-hidden='true'>&times;</button>
                     <span id="files">
                       <img id='scan_img' class='img-responsive' style='width: 30%' src='<?php echo $site_url; ?>assets/img/transparent.png' alt='Photo'>
                     </span>
            </div>
            <div class="fetch-url col-md-12">
              <button type='button' class='close' id="close-fetch" data-dismiss='alert' aria-hidden='true'>&times;</button>
             <input class="current_image" name="current_image" type="hidden" />
             <input class="total_image" name="total_image" type="hidden" />
             <input class="url_desc" name="url_desc" type="hidden"/>
             <input class="url_title" name="url_title" type="hidden" />
             <input class="url_link" name="link_url" type="hidden"/> 
             <input class="url_image" name="url_image" type="hidden" />

             <input class="v_url" name="v_url" type="hidden"/> 
             <input class="v_type" name="v_type" type="hidden"/>
             <input class="v_desc" name="v_desc" type="hidden"/>
             <input class="v_title" name="v_title" type="hidden" />
             <input class="v_thumb" name="v_thumb" type="hidden"/>
             <div class="ext-content"></div>
            </div>
            <ul class='padding-inline list-inline post-actions'>
                <li><a href="#"><span id="pic" class="fa fa-camera"></span></a></li>
                <li><a href="#"><span id="film" class="fa fa-file-video-o"></span></a></li>
                <li><a href="#"><span class='fa fa-user-plus' id='user-mentions'></span></a></li>
                <input type="hidden" name="adult_content_score" class="scan-nude-input">
                <input type="hidden" id="pic_url" name="image">
                <input type="hidden" id="pic_url_thumb" name="image_thumb">
                <input type="hidden" id="page-hidden" value="<?php echo $page; ?>">
                <input type="hidden" id="id-hidden" value="<?php echo $id; ?>">
                <li class='pull-right'><a href="#" class='btn btn-azure btn-ls' id="post_post">Post</a></li>
                <li class="dropdown pull-right hidden-xs">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" id="confidence">
                  <span id="privacy-show"><?php echo privacy(select_sql_id($id, 'privacy'), '<span class="fa fa-globe"></span> Public', '<span class="fa fa-group"></span> Followers', '<span class="fa fa-lock"></span> Only me'); ?></span> <span class="fa fa-caret-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-menuxms privacy-drop">
                  <li class="notification">
                           <a href="#" id="public-privacy">
                           <div class="media">
                              <div class="media-body">
                                 <p class="notification-desc"><strong><span id="p1"><span class="fa fa-globe dark-color"></span><span id="p1val"> Public</span></span></strong></p>
                                 <div class="notification-meta">
                                    <small class="timestamp">Everyone on or off <?php echo $site_name; ?></small>
                                 </div>
                              </div>
                           </div>
                           </a>
                           <a href="#" id="followers-privacy">
                           <div class="media">
                              <div class="media-body">
                                 <p class="notification-desc"><strong><span id="p2"><span class="fa fa-group dark-color"></span><span id="p2val"> Followers</span></span></strong></p>
                                 <div class="notification-meta">
                                    <small class="timestamp">People who follow you on <?php echo $site_name; ?></small>
                                 </div>
                              </div>
                           </div>
                           </a>
                           <a href="#" id="me-privacy">
                           <div class="media">
                              <div class="media-body">
                                 <p class="notification-desc"><strong><span id="p3"><span class="fa fa-lock dark-color"></span><span id="p3val"> Only me</span></span></strong></p>
                                 <div class="notification-meta">
                                    <small class="timestamp">Only me</small>
                                 </div>
                              </div>
                           </div>
                           </a>
                           <input type="hidden" id="privacy" name="privacy" value="<?php echo privacy(select_sql_id($id, 'privacy'), 'Public', 'Followers', 'Only me'); ?>">
                        </li>
                 </ul>
                </li>
            </ul>
        </form>
        <form id="imageform" class="form-hide" method="post" enctype="multipart/form-data" action='ajax/upload-img'>
         <input type="file" name="uploadfile" id="photoimg" />
         <input type="hidden" name="token" id="token_id" value="<?php echo $_SESSION[$id_csrf.'_token'] ; ?>">
        </form>
      </div>     
                  <!--   posts -->
                <div id="wall-append">
                <?php


                 include 'show_timeline.php';
                ?>

                <!-- Part for mobile-->
         <div class="hidden-lg hidden-md">
           <?php $activity = ShowActivity('6'); ?>
           <!-- Tags -->
  <div class="widget">
        
        <div class="widget-header">
          <h3 class="widget-caption">Contributions/Interests</h3>
        </div>
        <div class="widget-body bordered-top bordered-sky">
          <div class="card">
            <div class="content">
              <ul class="list-unstyled team-members">
                <?php
                  $tag = array("Caring","Cleanliness","Community Development","Conservation","Health Care","Natural Calamities","Support Differently Abled","Women Empowerment");
                  $tag_link = array("caring","cleanliness","communitydevelopment","conservation","healthcare","naturalcalamities","supportdifferentlyabled","womenempowerment");
                  $icon = array("fa-heartbeat","fa-star","fa-users","fa-cloud","fa-medkit","fa-exclamation-triangle","fa-wheelchair","fa-female");
                  for($i = 0;$i < sizeof($tag);$i++) {
                    ?>
                 <li>
                  <div class="row">
                    <div class="col-xs-9 blue-design">
                      <a href="<?php echo $site_url.$tag_link[$i]; ?>">
                      <?php echo '<span class="fa '.$icon[$i].'"></span>  '.$tag[$i]; ?>
                      </a>
                    </div>
                  </div>
                </li>
                <?php
                }
                ?>
              </ul>
            </div>
          </div>
        </div>
        </div><!-- End Tags -->
          <!-- Friends activity -->
          <div class="widget">
            <div class="widget-header">
              <h3 class="widget-caption">Friends activity</h3>
            </div>
            <div class="widget-body bordered-top bordered-sky">
              <div class="card">
                <div class="content">
                   <ul class="list-unstyled team-members">
                    <?php
                    foreach ($activity as $row) {
                        if ($row['id_user'] != returnID()) {
                            ?>
                    <li>
                      <div class="row">
                        <div class="col-xs-3">
                          <div class="avatar">
                              <img src="<?php echo $site_url.select_sql_id($row['id_user'], 'avatar_thumb'); ?>" alt="img" class="img-circle img-no-padding img-responsive">
                          </div>
                        </div>
                        <div class="col-xs-9">
                          <b><a href="<?php echo $site_url.select_sql_id($row['id_user'], 'username'); ?>"><?php echo select_sql_id($row['id_user'], 'fullname'); ?></a></b> <a href="<?php echo $site_url.'post/'.$row['pid']; ?>"><?php echo notif_friend_parameters('post', 'has followed you', 'has post something', 'has liked a <b>publication</b>', 'has commented a <b>publication</b>', 'shared a publication'); ?></a>. 
                          <span class="timeago"><?php echo get_timeago($row['time_post']); ?></span>
                        </div>
                      </div>
                    </li>
                    <?php
                        }
                    }
                    ?>
                  </ul>         
                </div>
              </div>
            </div>
          </div><!-- End Friends activity -->


          <!-- People You May Know 
          <div class="widget">
      
            <div class="widget-header">
              <h3 class="widget-caption">People You May Know</h3>
            </div>
            <div class="widget-body bordered-top bordered-sky">
              <div class="card">
                  <div class="content">
                      <ul class="list-unstyled team-members">
                      <?php
                      $data = show_recommended('5');
                      foreach ($data as $row) {
                          if (is_follow_user($row['id']) == 0) {
                              ?>
                        <li id="recommended-<?php echo $row['id']; ?>">
                              <div class="row">
                                  <div class="col-xs-3">
                                      <div class="avatar">
                                      <a href="<?php echo $site_url.$row['username']; ?>">
                                          <img src="<?php echo $site_url.$row['avatar']; ?>" alt="Circle Image" class="img-circle img-no-padding img-responsive">
                                          </a>
                                      </div>
                                  </div>
                                  <div class="col-xs-6 blue-design">
                                  <a href="<?php echo $site_url.$row['username']; ?>">
                                     <?php echo $row['firstname'].' '.$row['lastname']; ?>
                                     </a>
                                  </div>
                                  <div class="col-xs-6">
                                     <a href="<?php echo $site_url.$row['username']; ?>"><?php echo show_username($row['username']); ?></a>
                                  </div>
                      
                                  <div class="col-xs-3 text-right">
                                      <btn class="btn btn-sm btn-azure btn-icon" id="follow-people" data-id="<?php echo $row['id']; ?>" data-state="follow"><i class="fa fa-user-plus"></i></btn>
                                  </div>
                              </div>
                          </li>
                          <?php
                          }
                      }
                      ?>
                      </ul>
                  </div>
              </div>          
            </div>
          </div><!-- End people yout may know --> 
        </div><!-- end -->
                <!-- -->

                <div id="loadmore"></div>
                <div id="end-loadmore" class="end-loadmore" style="display: none;"></div>
                  <div class="spinnera" id="spinner" <?php echo post_count(true, '6', $page); ?>>
                      <div class="bounce1"></div>
                      <div class="bounce2"></div>
                      <div class="bounce3"></div>
                  </div>
                 </div>
            </div><!-- end left posts-->
          </div>
          <?php
          include 'includes/modal.php';
          ?>
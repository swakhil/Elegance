</div><!-- end  center posts -->
<?php
$activity = ShowActivity('6');
?>
<!-- right posts -->
<div <?php echo class_right($page); ?>>

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
            $data = ShowNotifications(returnID(), '5');
            foreach ($data as $row) {
                if ($row['type'] == 'post') {
                    ?>
               <li class="notification">

                           <div class="media">

                              <div class="media-left">

                                 <div class="media-object">

                                    <a href="<?php echo $site_url; ?><?php echo select_sql_id($row['sender_id'], 'username'); ?>"><img src="<?php echo $site_url.select_sql_id($row['sender_id'], 'avatar_thumb'); ?>" class="img-circle width-notif-avatar" alt="Name">

                                    </a>

                                 </div>

                              </div>

                              <div class="media-body">

                                 <span class="notification-title">

                                 <b><a href="<?php echo $site_url; ?><?php echo select_sql_id($row['sender_id'], 'username'); ?>"><?php echo select_sql_id($row['sender_id'], 'fullname'); ?></a></b>

                                   <?php echo notif_post_parameters($row['parameters'], 'has liked a <a href="'.$site_url.'post/'.$row['reference_id'].'"><b>post</b></a>', 'has commented a <a href="'.$site_url.'post/'.$row['reference_id'].'"><b>post</b></a>', 'has shared a <a href="'.$site_url.'post/'.$row['reference_id'].'"><b>post</b></a>', 'has tagged you in a <a href="'.$site_url.'post/'.$row['reference_id'].'"><b>post</b></a>'); ?> </span>

                                 <p class="notification-desc"><?php echo convert_links(truncate(select_post_id($row['reference_id'], 'texts'), '25')); ?>

                                 </p>

                                 <div class="notification-meta">

                                    <small class="timestamp"><?php echo timeago($row['created_at']); ?></small>

                                 </div>

                              </div>

                           </div>

                        </li>
                        <?php
                }
            }
            foreach ($activity as $row) {
                if ($row['id_user'] != returnID()) {
                    ?>
            


               <li class="notification">

                           <div class="media">

                              <div class="media-left">

                                 <div class="media-object">

                                    <a href="<?php echo $site_url; ?><?php echo select_sql_id($row['id_user'], 'username'); ?>"><img src="<?php echo $site_url.select_sql_id($row['id_user'], 'avatar_thumb'); ?>" class="img-circle width-notif-avatar" alt="Name">

                                    </a>

                                 </div>

                              </div>

                              <div class="media-body">

                                 <span class="notification-title">

                                 <b><a href="<?php echo $site_url; ?><?php echo select_sql_id($row['id_user'], 'username'); ?>"><?php echo select_sql_id($row['id_user'], 'fullname'); ?></a></b>

                                   <a href="<?php echo $site_url.'post/'.$row['pid']; ?>"><b><?php echo notif_friend_parameters('post', 'has followed you', 'has post something', 'has liked a <b>publication</b>', 'has commented a <b>publication</b>', 'shared a publication'); ?></a></b> </span>

                                 <p class="notification-desc">"<?php echo convert_links(truncate(select_post_id($row['pid'], 'texts'), '25')); ?>"

                                 </p>

                                 <div class="notification-meta">

                                    <small class="timestamp"><?php echo get_timeago($row['time_post']); ?></small>

                                 </div>

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
              <li id="recommended<?php echo $row['id']; ?>">
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
                    <btn class="btn btn-sm btn-azure btn-icon follow-people"  data-id="<?php echo $row['id']; ?>" data-state="follow"><i class="fa fa-user-plus"></i></btn>
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
      </div> End people yout may know -->

      <!-- Trends -->
      <div class="widget">
        
        <div class="widget-header">
          <h3 class="widget-caption">Trends</h3>
        </div>
        <div class="widget-body bordered-top bordered-sky">
          <div class="card">
            <div class="content">
              <ul class="list-unstyled team-members">
                <?php
                $data = ShowTrends('5');
                foreach ($data as $row) {
                    ?>
                <li>
                  <div class="row">
                    <div class="col-xs-9 blue-design">
                      <a href="<?php echo $site_url.'hashtags/'.$row['hashtag']; ?>">
                        <?php echo '#'.$row['hashtag']; ?>
                      </a>
                    </div>
                    <div class="col-xs-3">
                      <?php echo get_timeago_short($row['time_post']); ?>
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
        </div><!-- End Trends -->
        <!-- Sponsored -->
        <?php
        if ($website_ads == '1') {
            ?>
        <div class="widget">
          <div class="widget-header">
            <h3 class="widget-caption"><i class="fa fa-globe fa-sponsored"></i> Sponsored</h3>
          </div>
          <div class="widget-body bordered-top bordered-sky">
            <div class="card">
              <div class="content">
                <!-- Display Ads -->
                <?php
                if (trim($ads_options) == '1') {
                    echo display_own_ads('1');
                } else {
                    echo html_entity_decode(display_ads('1'), ENT_QUOTES, 'UTF-8');
                } ?>
              </div>
            </div>
          </div>
          </div><!-- End Sponsored -->
          <?php
        }
          ?>
          
          </div><!-- end right posts -->
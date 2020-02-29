 <!-- Profile Nav Tabs -->
            <ul class="nav nav-pills nav-pills-custom-minimal custom-minimal-bottom profile-tabs">
              <li role="presentation" class="<?php echo show_active($page, 'active0');?>"><a href="<?php echo $site_url.select_sql_id($id, 'username'); ?>" >Timeline</a></li>
              <li role="presentation" class="<?php echo show_active($page, 'active2');?>"><a href="<?php echo $site_url.select_sql_id($id, 'username'); ?>/following">Following <?php echo count_friends($id, 'following'); ?></a></li>
              <li role="presentation" class="<?php echo show_active($page, 'active3');?>"><a href="<?php echo $site_url.select_sql_id($id, 'username'); ?>/followers">Followers <?php echo count_friends($id, 'followers'); ?></a></li>
              <li role="presentation" class="<?php echo show_active($page, 'active4');?>"><a href="<?php echo $site_url.select_sql_id($id, 'username'); ?>/photos">Photos <?php echo count_friends($id, 'photos'); ?></a></li>
                <input type="hidden" id="page-name-hidden" value="<?php echo $page; ?>">
                <input type="hidden" id="id-num-hidden" value="<?php echo $id; ?>">
            </ul>
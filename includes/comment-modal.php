                  <div class="box-comment" id="box-comment-modal-<?php echo $row_com['cid']; ?>">
                        <a href="<?php echo $site_url.select_sql_id($row_com['id_user_com'], 'username'); ?>">
                        <img class="img-circle img-sm" src="<?php echo $site_url.select_sql_id($row_com['id_user_com'], 'avatar'); ?>" alt="User Image">
                        </a>
                        <div class="comment-text">
                          <span class="username">
                          <a href="<?php echo $site_url.select_sql_id($row_com['id_user_com'], 'username'); ?>">
                          <?php echo select_sql_id($row_com['id_user_com'], 'firstname'); ?> <?php echo select_sql_id($row_com['id_user_com'], 'lastname'); ?>
                          </a>
                          <a href="<?php echo $site_url.select_sql_id($row_com['id_user_com'], 'username'); ?>"><?php echo show_username(select_sql_id($row_com['id_user_com'], 'username')); ?>
                          </a>
                          <span class="text-muted pull-right">
                            <div class="dropdown float-drop-post">
                              <?php echo get_timeago($row_com['times_com']); ?>
                            <a href="#" class="dropdown-toggle" style="padding: 5px;" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-chevron-down color-drop-icon-post"></span></a>
                            <ul class="dropdown-menu">
                            <?php echo ReturnCommentPopSecond($row_com['id_user_com'], $row_com['cid'], 'Delete', 'Report', $row['pid']);?>
                           </ul>
                          </div>
                          </span>
                          </span>
                          <span class="comment-desc">
                          <?php 
                            echo nl2br(htmlspecialchars_decode(convert_links(emoji_unified_to_html($row_com['comment']))));
                             ?>
                           </span>
                           <span>
                             <?php echo ShowImageComment($row_com['cid'], $row_com['img']); ?>
                           </span>
                        </div>
                      </div>
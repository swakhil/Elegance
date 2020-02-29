<!-- Notifications Saved-->
<span class="box box-widget box-header saved-alert" id="saved-alert-<?php echo $row['pid']; ?>"><i class="fa fa-check-circle green"></i> Saved, view your saved posts <a href="<?php echo $site_url; ?>user/saved">here</a>.<i class="fa fa-times-circle style-times green" id="times-saved-<?php echo $row['pid']; ?>"></i></span>

<!-- Post -->
<div class="box box-widget" id="post-<?php echo $row['pid']; ?>"> 
 <i class="pointer" id="pagination-<?php echo $row['pid']; ?>"></i>
                    <div class="box-header with-border">
                      <div class="user-block">
                       <div class="dropdown float-drop-post">
                           <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="fa fa-ellipsis-h color-drop-icon-post"></span></a>
                        <ul class="dropdown-menu">
                        <?php echo ReturnPopupFirst($row['id_user'], $row['pid'], 'Edit', 'Hide'); ?>
                        <?php echo ReturnPopupSecond($row['id_user'], $row['pid'], 'Delete', 'Report');?>
                        <li class="notification">
                        <span>
                           <div class="media">
                              <div class="media-body">
                                 <p class="notification-desc"><strong>
                                  <?php echo privacy($row['privacy'], '<span class="fa fa-globe dark-color"></span> Public', '<span class="fa fa-group dark-color"></span> Followers', '<span class="fa fa-lock dark-color"></span> Only me'); ?>
                                 </strong></p>
                              </div>
                           </div>
                           </span>
                         </li>

                         <li class="notification save_container" id="save_container_<?php echo $row['pid']; ?>">
                           <a href="#" id="<?php echo $row['pid']; ?>" class="save">
                           <div class="media">
                              <div class="media-body">
                                 <p class="notification-desc"><strong>
                                 <span class="fa fa-bookmark dark-color"></span> Save Post
                                 </strong></p>
                              </div>
                           </div>
                           </a>
                         </li>
                         <li class="notification">
                           <a target="_blank" href="<?php echo $site_url; ?>post/<?php echo $row['pid']; ?>">
                           <div class="media">
                              <div class="media-body">
                                 <p class="notification-desc"><strong>
                                 <span class="fa fa-newspaper-o dark-color"></span> Open Post in new page
                                 </strong></p>
                              </div>
                           </div>
                           </a>
                         </li>
                         </ul>
                       </div>

                        <a href="<?php echo select_sql_id($row['id_user'], 'username'); ?>">
                         <img class="img-circle" src="<?php echo $site_url.select_sql_id($row['id_user'], 'avatar'); ?>" alt="User Image">
                        </a>
                        <span class="username"><a href="<?php echo select_sql_id($row['id_user'], 'username'); ?>"><?php echo select_sql_id($row['id_user'], 'firstname'); ?> <?php echo select_sql_id($row['id_user'], 'lastname'); ?></a> <?php echo CheckAutoStatus($row['pid']); ?></span>
                        <span class="description">
                         <a href="<?php echo select_sql_id($row['id_user'], 'username'); ?>"><?php echo show_username(select_sql_id($row['id_user'], 'username')); ?></a> - <?php echo get_timeago($row['time_post']); ?>
                        </span>
                      </div>
                    </div>

                    <div class="box-body">
                    <p class="desc-text" id="desc-<?php echo $row['pid']; ?>"><?php echo convert_links(nl2br(htmlspecialchars_decode(emoji_unified_to_html($row['texts'])))); ?></p>
                     <?php echo ShowImage($row['pid'], $row['image_url']);

                       if ($row['user_share'] != '') {
                           include 'post-share.php';
                       }
                       ?>
                       <?php
                       if (!empty($row['video_url']) && !empty($row['video_url_type'])) {
                           ?>
         <div class="row">
            <div class="display-video videos">
               <div class="col-md-6 ext-row expand-video">
                <a class="<?php echo $row['video_url_class']; ?>" href="<?php echo $row['video_url']; ?>" >
                  <span></span>
                  <?php
                  if (trim($row['video_url_thumb']) != '') {
                      ?>
                   <img src="<?php echo $row['video_url_thumb']; ?>" class="img-responsive">
                  <?php
                  } ?>
                </a>
              </div>
               <div class="col-md-6 ext-data-body details">
                  <h4><?php echo $row['video_url_title']; ?></h4>
                  <p class="ext-url"> <a href="<?php echo $row['video_url']; ?>" target="_blank"><?php echo getHost($row['video_url']); ?></a></p>
                  <p class="ext-data"><?php echo $row['video_url_desc']; ?></p>
               </div>
            </div>
         </div>
                        <?php
                       } elseif (!empty($row['link_url'])) {
                           ?>
                         <div class="url">
                                        <div class="expand-url">
                                          <a href="<?php echo $row['link_url']; ?>" target="_blank"><span></span>
                                            <?php
                                            if (trim($row['link_img_url']) != '') {
                                                ?>
                                            <img class="img-responsive" src="<?php echo $row['link_img_url']; ?>" />
                                            <?php
                                            } ?>
                                          </a>
                                        </div>
                                        <div class="details-url">
                                            <h6><?php echo $row['link_title_url']; ?></h6>

                                            <p class="link-url"><?php echo getHost($row['link_url']); ?></p>

                                            <p class="desc-url"><?php echo $row['link_desc_url']; ?></p>
                                        </div>

                         </div>
                      <?php
                       }
                       ?>
                      <p id="like_container<?php echo $row['pid']; ?>" class="<?php echo like_color($row['pid']);?> like_container">
                      <a  id="<?php echo $row['pid']; ?>" class="like" href="#"> 
                               <i class="fa fa-thumbs-up"></i>
                               Like
                                <span class="dis"> </span></a>
                                <a href="#" id="score_<?php echo $row['pid']; ?>"><span class="score"><?php echo people_likes($row['pid']); ?>  </span>
                            </a>
                       </p>
                     <p id="share_container<?php echo $row['pid']; ?>" class="<?php echo share_color($row['pid']);?> share_container">
                      <a data-toggle="tooltip" data-placement="top" title="share" id="share_<?php echo $row['pid']; ?>" class="share" href="#"> 
                               <i class="fa fa-share" ></i> Share
                                <span class="dis_share"> </span></a>
                                <a href="#" id="score_share_<?php echo $row['pid']; ?>"><span class="score_share"><?php echo people_share($row['pid']); ?>  </span>
                            </a>
                       </p>
                      <?php
                      $datas = show_comment($row['pid']);
                      $data_count = count_comment($row['pid']);
                       ?>
                      <span class="pull-right text-muted">
                        <a href="#">
                           <i class="fa fa-comments"></i> 
                           <span id="comment_count_<?php echo $row['pid'];?>"><?php echo show_count($data_count); ?></span> Comments
                        </a>
                      </span>
                    </div>
                    <div class="box-footer box-comments" id="box-comments_<?php echo $row['pid']; ?>">
                    <?php
                     foreach ($datas as $row_com) {
                         include "comment.php";
                     }
                     ?>
                    </div>
                    <div class="box-footer">
                       <form id="form-comment-<?php echo $row['pid']; ?>" method="POST">
                        <img class="img-responsive img-circle img-sm img" src="<?php echo $site_url.select_sql_id(returnID(), 'avatar_thumb'); ?>" alt="<?php echo select_sql_id(returnID(), 'username'); ?>'s avatar">
                        <div class="img-push">
                          <textarea class="form-control ac-input textarea-com ac-input_<?php echo $row['pid']; ?>" placeholder="Press enter to post comment" id="ac-input-<?php echo $row['pid']; ?>" name="comment" pid="<?php echo $row['pid']; ?>"></textarea>
                          <div class="box-footer box-form comment-box" id="img_preview_com-<?php echo $row['pid']; ?>">
                            <button type='button' class='close' id="close-img-com" pid="<?php echo $row['pid']; ?>" data-dismiss='alert' aria-hidden='true'>&times;</button>
                             <span class="loader-com-<?php echo $row['pid']; ?>"></span>
                            <span id="files_com-<?php echo $row['pid']; ?>"></span>
                          </div>
                          <input type="hidden" name="pid" value="<?php echo $row['pid']; ?>">
                          <input type="hidden" id="pic_url_com-<?php echo $row['pid']; ?>" name="image">
                          <input type="hidden" id="pic_url_thumb_com-<?php echo $row['pid']; ?>" name="image_thumb">
                          <script type="text/javascript">
                            $("#ac-input-<?php echo $row['pid']; ?>").emojioneArea({
                            autoHideFilters: true,
                          });
                          </script>
                        </div>
                      </form>
                      <form id="imageform-<?php echo $row['pid']; ?>" method="post" enctype="multipart/form-data" action='ajax/upload-img' class="form-hide"><input type="file" name="uploadfile" id="photoimg-<?php echo $row['pid']; ?>" />
                      <!-- CSRF ID -->
                      <input type="hidden" name="token" id="token_id" value="<?php echo $_SESSION[$id_csrf.'_token'] ; ?>">
                    </form>
                     </div>
                   </div><!--  end posts-->
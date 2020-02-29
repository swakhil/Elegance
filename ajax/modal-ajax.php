<?php
    include '../functions/functions.php';

//Applying CSRF, XSS Protection
if (verify_token_general($name = $id_csrf)) {

    //Format and Sanitize Variables
    $img = trim(filter_input(INPUT_POST, "img", FILTER_SANITIZE_STRING));
    $pid = trim(filter_input(INPUT_POST, "pid", FILTER_SANITIZE_STRING));

    $id_user = select_sqlarg('posts', 'pid', $pid, 'id_user');
    $privacy = select_sqlarg('posts', 'pid', $pid, 'privacy');
    $img = select_sqlarg('posts', 'pid', $pid, 'image_url');
    $texts = select_sqlarg('posts', 'pid', $pid, 'texts');
    $time_post = select_sqlarg('posts', 'pid', $pid, 'time_post'); ?>

    <div class="modal-dialog modal-lg" role="document" style="margin-left: 2%;width: 98%;" >
                <div class="modal-content">
                    <div class="row" id="modal-row">
                        <div class="col-md-8 background-modal" >
                                <!-- Wrapper for slides -->
                                <div class="carousel-inner" role="listbox" >
                                 <div class="item active item-design" style="display:flex;">
                                        <img alt="image" class="img-responsive img-modal" src="<?php echo $site_url.$img; ?>" id="img-modal-post" class="img-responsive" style="text-align: center;">
                                    </div>
                                </div>

                                 <!-- Left and right controls -->
                                 <span id="controls-lr">
                                  <?php
                                        echo select_pid_prev($pid, $html = true);
    echo select_pid_next($pid, $html = true); ?>
                                </span>
                        </div>
                        <div class="col-md-4" id="modal-md-4">
                            <div class="modal-body inline">

                      <div class="box-widget" id="post-<?php echo $pid; ?>">
                      <div class="user-block">

                      <i class="fa fa-times times-modal" id="modal-ajax-hide"></i>

                       <div class="dropdown right-float">
                           <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="fa fa-ellipsis-h lightgray"></span></a>
                        <ul class="dropdown-menu" id="drop-modal">
                         <?php echo ReturnPopupFirst($id_user, $pid, 'Edit', 'Hide'); ?>
                         <?php echo ReturnPopupSecond($id_user, $pid, 'Delete', 'Report'); ?>
                         <li class="notification">
                           <a href="#">
                           <div class="media">
                              <div class="media-body">
                                 <p class="notification-desc"><strong>
                                  <?php echo privacy($privacy, '<span class="fa fa-globe dark-color"></span> Public', '<span class="fa fa-group dark-color"></span> Followers', '<span class="fa fa-lock dark-color"></span> Only me'); ?>
                                 </strong></p>
                              </div>
                           </div>
                           </a>
                         </li>

                         <li class="notification save_container" id="save_container_<?php echo $pid; ?>">
                           <span id="<?php echo $pid; ?>" class="save">
                           <div class="media">
                              <div class="media-body">
                                 <p class="notification-desc"><strong>
                                 <span class="fa fa-bookmark dark-color"></span> Save Post
                                 </strong></p>
                              </div>
                           </div>
                           </span>
                         </li>
                         <li class="notification">
                           <a target="_blank" href="<?php echo $site_url; ?>post/<?php echo $pid; ?>">
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

                        <a href="<?php echo $site_url.select_sql_id($id_user, 'username'); ?>">
                         <img class="img-circle" src="<?php echo $site_url.select_sql_id($id_user, 'avatar'); ?>" alt="User Image">
                        </a>
                        <span class="username"><a href="<?php echo $site_url.select_sql_id($id_user, 'username'); ?>"><?php echo select_sql_id($id_user, 'firstname'); ?> <?php echo select_sql_id($id_user, 'lastname'); ?></a></span>

                        <span class="description">
                         <a href="<?php echo $site_url.select_sql_id($id_user, 'username'); ?>"><?php echo show_username(select_sql_id($id_user, 'username')); ?></a> - <?php echo get_timeago($time_post); ?>
                        </span>
                      </div>
                    </div>

                    <div class="box-body">
                    <p class="desc-text" id="desc-<?php echo $pid; ?>"><?php echo convert_links(nl2br(truncate($texts, $chars = 55, $trunc_at_space = true))); ?></p> 

                      <p id="like_container-modal<?php echo $pid; ?>" class="<?php echo like_color($pid); ?> like_container-modal">
                      <a  id="modal-<?php echo $pid; ?>" class="like-modal" href="#"> 
                               <i class="fa fa-heart"></i>
                               Like
                                <span class="dis"> </span></a>
                                <a href="#" id="score-modal_<?php echo $pid; ?>"><span class="score-modal"><?php echo people_likes($pid); ?>  </span>
                            </a>
                       </p>
                     <p id="share_container-modal<?php echo $pid; ?>" class="<?php echo share_color($pid); ?> share_container-modal">
                      <a id="share-modal_<?php echo $pid; ?>" class="share-modal" href="#"> 
                               <i class="fa fa-share" ></i> Share
                                <span class="dis_share"> </span></a>
                                <a href="#" id="score_share-modal_<?php echo $pid; ?>"><span class="score_share-modal"><?php echo people_share($pid); ?>  </span>
                            </a>
                       </p>
                      <?php
                      $datas = show_comment($pid);
    $data_count = count_comment($pid); ?>
                      <span class="pull-right text-muted">
                        <a href="#">
                           <i class="fa fa-comments"></i> 
                           <span id="comment_count-modal_<?php echo $pid; ?>"><?php echo show_count($data_count); ?></span> 
                        </a>
                      </span>
                    </div>
                    <div class="box-footer box-comments modal-box-comments" id="box-comments-modal_<?php echo $pid; ?>">
                    <?php
                     foreach ($datas as $row_com) {
                         $row['pid'] = $pid;
                         include "../includes/comment-modal.php";
                     } ?>
                    </div>
                     <div class="box-footer">
                       <form id="form-comment-modal-<?php echo $pid; ?>" method="POST">
                        <img class="img-responsive img-circle img-sm img" src="<?php echo $site_url.select_sql_id(returnID(), 'avatar_thumb'); ?>" alt="<?php echo select_sql_id(returnID(), 'username'); ?>'s avatar">
                        <div class="img-push">
                          <span class="loader-com"></span>
                          <textarea class="form-control ac-input-modal textarea-com ac-input-modal_<?php echo $pid; ?>" placeholder="Press enter to post comment" id="ac-input-modal-<?php echo $pid; ?>" name="comment"></textarea>
                          <div class="box-footer box-form" id="img_preview_com" style="display: none">
                            <span id="files_com"></span>
                          </div>
                          <input type="hidden" name="pid" value="<?php echo $pid; ?>">
                          <input type="hidden" id="pic_url_com" name="image">
                          <input type="hidden" id="pic_url_thumb_com" name="image_thumb">
                          <script type="text/javascript">
                            $("#ac-input-modal-<?php echo $pid; ?>").emojioneArea({
                            autoHideFilters: true,
                            pickerPosition: "top", // top | bottom | right
                          });
                          </script>
                        </div>
                      </form>
                     </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
<?php
}
?>
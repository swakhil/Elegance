<?php
    include '../functions/functions.php';

//Applying CSRF, XSS Protection
if (verify_token_general($name = $id_csrf)) {

    //Format and Sanitize Variables
    $img = trim(filter_input(INPUT_POST, "img", FILTER_SANITIZE_STRING));
    $cid = trim(filter_input(INPUT_POST, "cid", FILTER_SANITIZE_STRING));
    $pid = select_sqlarg('comments', 'cid', $cid, 'cpid');

    $id_user = select_sqlarg('comments', 'cid', $cid, 'id_user_com');
    $img = select_sqlarg('comments', 'cid', $cid, 'img');
    $texts = select_sqlarg('comments', 'cid', $cid, 'comment');
    $time_post = select_sqlarg('comments', 'cid', $cid, 'times_com'); ?>

    <div class="modal-dialog modal-lg" role="document" style="margin-left: 16%; width: 70%;" >
                <div class="modal-content">
                    <div class="row" id="modal-row">
                        <div class="col-md-8 background-modal border-modal-com">
                                <!-- Wrapper for slides -->
                                <div class="carousel-inner" role="listbox" >
                                 <div class="item active item-design" style="display:flex;">
                                        <img alt="image" class="img-responsive img-modal" src="<?php echo $site_url.$img; ?>" id="img-modal-post" class="img-responsive" style="text-align: center;">
                                    </div>
                                </div>

                                 <!-- Left and right controls -->
                                 <span id="controls-lr">
                                  <?php
                                        //echo select_pid_prev($pid,$html = true);
                                        //echo select_pid_next($pid,$html = true);
                                   ?>
                                </span>
                        </div>
                        <div class="col-md-4" id="modal-md-4">
                            <div class="modal-body inline">

                      <div class="box-widget" id="post-<?php echo $pid; ?>">
                      <div class="user-block">

                      <i class="fa fa-times times-modal" id="modal-ajax-com-hide"></i>

                       <div class="dropdown right-float">
                           <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="fa fa-ellipsis-h lightgray"></span></a>
                        <ul class="dropdown-menu" id="drop-modal">
                        <?php echo ReturnCommentPopSecond($id_user, $cid, 'Delete', 'Report', $pid); ?>
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
                    <p class="desc-text" id="desc-<?php echo $pid; ?>"><?php echo nl2br(htmlspecialchars_decode(convert_links(emoji_unified_to_html($texts)))); ?></p>
                      
                       </div>
                     </div>
                        </div>
                    </div>
                </div>
            </div>
<?php
}
?>
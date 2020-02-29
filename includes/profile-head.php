<?php 
include 'includes/head.php';
?>



   <body class="animated fadeIn">

     <!-- Fixed navbar -->

    <?php
       include 'includes/header.php';
    ?>

    <div class="container page-content profile-margin">

      <div class="row">

        <div class="col-md-10">

    

          <div class="row">



           <div class="col-md-12 cover-wrapper" id="cover-wrapper">

            <div class="bg-picture modal_open" id="cover-container" style="background-image:url('<?php echo $site_url.select_sql_id($id, 'cover'); ?>'); background-position: <?php echo select_sqlarg('cover_position', 'id_user', $id, 'position_x');?> <?php echo select_sqlarg('cover_position', 'id_user', $id, 'position_y'); ?>;" data-toggle='<?php echo show_modal(select_sql_id($id, 'cover')); ?>' data-target='#modal-post' data-pid="<?php echo select_doublearg('posts', 'cover_status', '1', 'id_user', $id, 'pid'); ?>" rel='<?php echo select_doublearg('posts', 'cover_status', '1', 'id_user', $id, 'image_url'); ?>'>

            

              <span class="loading-cover"></span>

                <span class="bg-picture-overlay"></span>

                <!-- meta -->

                <div class="box-layout meta bottom">

                  <div class="col-md-6 clearfix">

                    <span class="img-wrapper pull-left m-r-15">

                      <span class="img-wrapper pull-left m-r-15" id="avatar-container">

                      <a href='#' class='modal_open no-outline' id="avatar-href" data-pid='<?php echo select_doublearg('posts', 'avatar_status', '1', 'id_user', $id, 'pid'); ?>' data-toggle='<?php echo show_modal(select_sql_id($id, 'avatar')); ?>' data-target='#modal-post' rel='<?php echo select_doublearg('posts', 'avatar_status', '1', 'id_user', $id, 'image_url'); ?>'><img class="avatar br-radius no-outline" src="<?php echo $site_url.select_sql_id($id, 'avatar'); ?>" alt="">

                      </a>

                      </span>



                    </span>

                    <div class="media-body">

                      <a href="<?php echo $site_url.select_sql_id($id, 'username'); ?>" >

                      <h3 class="text-white mb-2 m-t-10 ellipsis" id="profile-name"><?php echo $fullname; ?></h3>

                      </a>

                      <a href="<?php echo $site_url.select_sql_id($id, 'username'); ?>" >

                      <h5 class="text-white" id="profile-name"><?php echo show_username(select_sql_id($id, 'username')); ?></h5>

                      </a>

                    </div>

                  </div>

                  <?php
                   if (returnID() != $id) {
                       ?>

                  <div class="col-md-6 visible-lg" id="screen1">

                    <div class="pull-right">

                      <div class="dropdown">

                      <?php
                      $isFollow = select_doublearg('friends', 'id_sender', returnID(), 'id_recipient', $id, 'date_send');
                       if ($isFollow == '') {
                           ?>

                        <a data-toggle="dropdown" data-state="follow" class="btn btn-azure follow-user-<?php echo $id; ?>" href="#" id="follow-user" data-id="<?php echo $id; ?>"> Follow <i class="fa fa-user-plus"></i></a>

                        <?php
                       } else {
                           ?>

                          <a data-toggle="dropdown" data-state="unfollow" class="btn btn-azure follow-user-<?php echo $id; ?>" href="#" id="follow-user" data-id="<?php echo $id; ?>"> Following <i class="fa fa-user"></i></a>

                          <?php
                       } ?>

                       <span class="online_container" id="online_container<?php echo $id; ?>" data-fullname="<?php echo select_sql_id($id, 'fullname'); ?>" data-id="<?php echo $id; ?>" cvid="<?php echo $cvid; ?>" data-username="<?php echo select_sql_id($id, 'username'); ?>">

                        <a data-toggle="dropdown" class="dropdown-toggle btn btn-azure online-user" href="#" aria-expanded="false"> Message <i class="fa fa-comments"></i>

                        </a>

                       </span>



                      </div>

                    </div>

                  </div>



                  <div class="col-md-6 hidden-lg" id="screen2">

                    <div class="pull-right">

                      <div class="dropdown">

                          <?php
                      $isFollow = select_doublearg('friends', 'id_sender', returnID(), 'id_recipient', $id, 'date_send');
                       if ($isFollow == '') {
                           ?>

                        <a data-toggle="dropdown" data-state="follow" class="btn btn-azure follow-user-<?php echo $id; ?>" href="#" id="follow-user" data-id="<?php echo $id; ?>"> Follow <i class="fa fa-user-plus"></i></a>

                        <?php
                       } else {
                           ?>

                          <a data-toggle="dropdown" data-state="unfollow" class="btn btn-azure follow-user-<?php echo $id; ?>" href="#" id="follow-user" data-id="<?php echo $id; ?>"> Following <i class="fa fa-user"></i></a>

                          <?php
                       } ?>

                      </div>

                    </div>

                  </div>

                  <?php
                   }
                  ?>

                </div><!--/ meta -->

              </div>

            </div>

            <?php
            if (returnID() == $id) {
                ?>

           <span class="dropdownm" id="drop-down">

            <a href="#" class="dropdown-toggle" data-toggle="dropdown">

                <p data-toggle="tooltip" id="cover-drop" data-placement="right" title="Change Cover Photo"  class="fa fa-camera bouton-c"   >

                </p>

              </a>

            <ul class="dropdown-menu" id="cover-drop-menu" role="menu">

                <li><a href="#" id="upload-cover">Change Cover Photo</a></li>

                <li><a href="#" id="replace-cover">Replace Cover Photo</a></li>

            </ul>

            <form id="imageformcover" class="form-hide" method="post" enctype="multipart/form-data" action='ajax/upload-cover'>

              <input type="file" name="uploadcover" id="photocover" />

              <input type="hidden" name="token" id="token_id" value="<?php echo $_SESSION[$id_csrf.'_token'] ; ?>">

            </form>

          </span>



           <span class="dropdownm" id="drop-down2">

            <a href="#" class="dropdown-toggle" data-toggle="dropdown">

                       <p data-toggle="tooltip" id="avatar-drop" data-placement="right" title="Change Profile Photo"  class="fa fa-camera bouton-c" >

                       </p>

                     </a>

                <ul class="dropdown-menu" id="avatar-drop-menu" role="menu">

                   <li><a href="#" id="upload-avatar">Change Profile Photo</a></li>

                </ul>

           </span>

            <form id="imageformavatar" class="form-hide" method="post" enctype="multipart/form-data" action='ajax/upload-avatar'>

              <input type="file" name="uploadavatar" id="photoavatar" />

              <input type="hidden" name="token" id="token_id" value="<?php echo $_SESSION[$id_csrf.'_token'] ; ?>">

            </form>

            <?php
            }
          ?>

          </div>

          <div class="row">

           
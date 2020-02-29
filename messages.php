<?php 
// +------------------------------------------------------------------------+
// | @Team author : Smart Xplorer (smartxplorer)
// | @Team author email: smartxplorerdev@gmail.com
// +------------------------------------------------------------------------+
// | Elegance - The Elegant Social Network Platform
// | Copyright (c) 2017 Elegant. All rights reserved.
// +------------------------------------------------------------------------+
   include 'functions/functions.php';
   include 'functions/redirect.php';
   
   $page_title = 'Messenger | '.$site_name;
   $page = 'messages';
   include 'includes/head.php';
   include 'includes/intro-message.php';
?>

<body class="animated fadeIn">
   <!-- Fixed navbar -->
   <?php
      include 'includes/header.php';
      ?>
   <div class="main_section">
      <div class="chat_container">
         <div class="col-sm-3 chat_sidebar">
            <div class="row">
            <p class="messenger-header"><i class="fa fa-comments"></i> <?php echo $site_name; ?> Messenger</p>
               <div id="custom-search-input">
                  <div class="input-group col-md-12">
                     <input type="text" class="search-query form-control" placeholder="Search in <?php echo $site_name; ?> Messenger" />
                     <button class="btn" type="button">
                     <span class=" glyphicon glyphicon-search"></span>
                     </button>
                  </div>
               </div>
               <div class="dropdown all_conversation">
                  <i class="fa fa-weixin" aria-hidden="true"></i>
                  All Conversations
               </div>
               <div class="member_list">
               <!-- list-group text-left default-skin barscrool -->
               <span class="loader-search-msg"></span>
                  <ul class="list-unstyled">
                     <span id="ajax-list-user"></span>
                  <?php
                  foreach ($data_conversation as $row) {
                      ?>
                     <li class="left clearfix cm_<?php echo $row['cvid']; ?> <?php echo active_li_mess($row['user_id']); ?>" username="<?php echo select_sql_id($row['user_id'], 'username'); ?>" >
                     <span class="add-active" cvid="<?php echo $row['cvid']; ?>" fullname="<?php echo select_sql_id($row['user_id'], 'fullname'); ?>" user-to="<?php echo $row['user_id']; ?>">
                        <span class="chat-img pull-left">
                        <img src="<?php echo $site_url.select_sql_id($row['user_id'], 'avatar'); ?>" alt="User Avatar" class="img-circle">
                        </span>
                        <div class="chat-body clearfix">
                           <div class="header_sec">
                              <strong class="primary-font"><?php echo select_sql_id($row['user_id'], 'fullname'); ?></strong> <strong class="pull-right">
                              <?php echo timeago($row['dates_cv']); ?></strong>
                           </div>
                           <div class="contact_sec">
                              <strong class="primary-font"><?php echo truncate(select_last_message($row['cvid'], 'message'), '35'); ?></strong> <?php echo count_message($row['cvid'], true); ?>
                           </div>
                        </div>
                        </span>
                     </li>
                     <?php
                  }
                  ?>
                  </ul>
               </div>
            </div>
         </div>
         <!--chat_sidebar-->
         <div class="col-sm-9 message_section">
            <div class="row">
            <p class="message-title"> <?php echo $fullname; ?></p>
            <p class="message-caption"><?php echo $online; ?></p>
               <div class="new_message_head">
                  <div class="pull-left"><button><i class="fa fa-comment" aria-hidden="true"></i> Conversation</button></div>
               </div>
               <!--new_message_head-->
               <div class="chat_area">
                <ul class="list-unstyled message-text-display" getu="<?php echo issetGetU(); ?>">
             <?php
              if (!isset($_GET['u'])) {
                  ?>
               <div class="end-loadmore">
               <i class="fa fa-comments"></i><span>Welcome to <?php echo $site_name; ?>'s Messenger!</span>
               </div>
             <?php
              }

             if (isset($_GET['u'])) {
                 $data_message = select_message($cvid);
                 foreach ($data_message as $row) {
                     if (returnID() == $row['user_from']) {
                         if ($row['hide_user_from'] == 0) {
                             //All Messages with flag read
                             $make_read = update_sql_arg('messages', 'unread', '0', 'cvid_fk', $cvid);
                             $make_read = update_sql_arg('messages', 'notif_unread', '0', 'cvid_fk', $cvid); ?>
                <li class="left clearfix help-js">
                        <span class="chat-img1 pull-left">
                        <img src="<?php echo $site_url.select_sql_id($row['user_from'], 'avatar'); ?>" alt="<?php echo select_sql_id($row['user_from'], 'fullname'); ?> avatar" class="img-circle">
                        </span>
                        <div class="chat-body1 clearfix">
                           <span class="fa fa-trash dark-color delete-msg" mid="<?php echo $row['mid']; ?>" data-mid="<?php echo crypt_data('0', 'e'); ?>"></span>
                           <p><?php echo $row['message']; ?></p>
                           <div class="chat_time pull-right"><?php echo show_username(select_sql_id($row['user_from'], 'username')); ?> <?php echo timeago($row['dates_send']); ?></div>
                        </div>
                     </li>
                 <?php
                         }
                     } else {
                         if ($row['hide_user_to'] == 0) {
                             ?>
                     <li class="left clearfix admin_chat">
                        <span class="chat-img1 pull-right">
                        <img src="<?php echo $site_url.select_sql_id($row['user_from'], 'avatar'); ?>" alt="<?php echo select_sql_id($row['user_from'], 'fullname'); ?> avatar" class="img-circle">
                        </span>
                        <div class="chat-body1 clearfix">
                           <span class="fa fa-trash dark-color delete-msg" mid="<?php echo $row['mid']; ?>" data-mid="<?php echo crypt_data('1', 'e'); ?>"></span>
                           <p><?php echo $row['message']; ?></p>
                           <div class="chat_time pull-left"><?php echo show_username(select_sql_id($row['user_from'], 'username')); ?> <?php echo timeago($row['dates_send']); ?></div>
                        </div>
                     </li>
                     <?php
                         }
                     }
                 }
             }
                  ?>
                  </ul>
               </div>
               <!--chat_area-->
               <div class="message_write" <?php echo show_boxsender(); ?>>
                  <textarea class="form-control" id="message-area" placeholder="type a message"></textarea>
                  <div class="clearfix"></div>
                  <div class="chat_bottom">
                     <?php
                     if (isset($_GET['u'])) {
                         ?>
                     <a href="#" cvid="<?php echo $cvid; ?>" user-to="<?php echo $id; ?>" class="pull-right btn btn-success send-message">
                     Send</a>
                     <?php
                     } else {
                         ?>
                        <a href="#" cvid="" user-to="" class="pull-right btn btn-success send-message">Send</a>
                        <?php
                     }
                     ?>
                  </div>
               </div>
            </div>
         </div>
         <!--message_section-->
      </div>
   </div>
   <?php 
      //include 'includes/chat.php';
      include 'includes/modal.php';
      include 'includes/footer.php';
   ?>
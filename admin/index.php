<?php

// +------------------------------------------------------------------------+
// | @Team author : Smart Xplorer (smartxplorer)
// | @Team author email: smartxplorerdev@gmail.com
// +------------------------------------------------------------------------+
// | Elegance - The Elegant Social Network Platform
// | Copyright (c) 2017 Elegant. All rights reserved.
// +------------------------------------------------------------------------+


include_once 'functions/check_install.php';
   $page = 'dashboard';
   include 'inc/header.php';
   $data = show_users_details('4', 'DESC');
   $data_post = show_users_post('4', 'DESC');
   ?>
<div class="content">
   <div class="container-fluid">
         <div class="col-md-6">
            <div class="card">
               <div class="header">
                  <h4 class="title"><b>Users</b></h4>
               </div>
               <div class="content">
                  <p><i class="pe-7s-users"></i> <span>Total: <?php echo number_format(allusers()); ?></span></p>
                  <p><i class="pe-7s-user"></i> <span>Man: <?php echo number_format(select_count('id', 'users', 'sex', 'Male')); ?></span></p>
                  <p><i class="pe-7s-user-female"></i> <span>Woman: <?php echo number_format(select_count('id', 'users', 'sex', 'Female')); ?></span></p>
               </div>
            </div>
         </div>
         <div class="col-md-6">
            <div class="card">
               <div class="header">
                  <h4 class="title"><b>Posts</b></h4>
               </div>
               <div class="content">
                  <p><i class="pe-7s-news-paper"></i> <span>Total: <?php echo number_format(allposts()); ?></span></p>
                  <p><i class="pe-7s-user"></i> <span>Man: <?php echo number_format(select_count_post('Male')); ?></span></p>
                  <p><i class="pe-7s-user-female"></i> <span>Woman: <?php echo number_format(select_count_post("Female")); ?></span></p>
               </div>
            </div>
         </div>
         <div class="col-md-12">
          <span id="details"></span>
            <div class="card">
               <div class="header">
                  <h4 class="title">Last Users</h4>
                  <p class="category">User's Details</p>
               </div>
               <div class="content table-responsive table-full-width">
                  <table class="table table-hover table-striped">
                     <thead>
                        <th>Id</th>
                        <th>Full Name</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Username</th>
                        <th>Options</th>
                        <th>More</th>
                     </thead>
                     <tbody>
                        <?php
                           foreach ($data as $row) {
                               $row['fullname'] = $row['firstname'].' '.$row['lastname']; ?>
                        <tr id="table-options-<?php echo $row['id']; ?>">
                           <td><?php echo $row['id']; ?></td>
                           <td><b><?php echo $row['fullname']; ?></b></td>
                           <td><?php echo $row['email']; ?></td>
                           <td><?php echo show_status($row['active']); ?></td>
                           <td><?php echo $row['username']; ?>
                           <td><?php 
                                 if ($row['active'] == '0') {
                                     ?>
                              <span class="table-options activate-ajax" id="<?php echo $row['id']; ?>" q="<?php echo base64_encode('ub'); ?>" link="<?php echo $site_url; ?>admin/action" p="<?php echo base64_encode($row['id']); ?>" c="<?php echo $_SESSION[$id_csrf.'_token'] ; ?>"><br/><i class="fa fa-check"></i>Activate</span> 
                              <?php
                                 } elseif ($row['active'] == '1') {
                                     ?>
                              <span class="table-options block-ajax" id="<?php echo $row['id']; ?>" q="<?php echo base64_encode('b'); ?>" link="<?php echo $site_url; ?>admin/action" p="<?php echo base64_encode($row['id']); ?>" c="<?php echo $_SESSION[$id_csrf.'_token'] ; ?>"><br/><i class="fa fa-ban"></i>Block</span>    
                              <?php
                                 } ?>
                              <span class="table-options delete-ajax" id="<?php echo $row['id']; ?>" q="<?php echo base64_encode('d'); ?>" link="<?php echo $site_url; ?>admin/action" p="<?php echo base64_encode($row['id']); ?>" c="<?php echo $_SESSION[$id_csrf.'_token'] ; ?>"><br/><i class="fa fa-trash"></i>Delete</span>
                           </td>

                           <td><span class="table-options view-more" link="<?php echo $site_url; ?>admin/ajax/user" id="<?php echo $row['id']; ?>" id_user="<?php echo $_SESSION['aid']; ?>" data-toggle="modal" token="<?php echo $_SESSION[$id_csrf.'_token'] ; ?>" data-target="#myModal"><b>View more/Edit</b></span></td>
                        </tr>
                        <?php
                           }
                           ?>
                           <input type="hidden" id="token" name="token" value="<?php echo $_SESSION[$id_csrf.'_token'] ; ?>">
                     </tbody>
                  </table>
               </div>
            </div>
         </div>
      </div>

      <div class="row">
        <div class="col-md-12" style="overflow-x: scroll;">
            <div class="card">
         <span id="details"></span>
               <div class="header">
                  <h4 class="title">Last Posts</h4>
                  <p class="category">Post's Details</p>
               </div>
               <div class="content table-responsive table-full-width">
                  <table class="table table-bordered table-hover table-striped">
                     <thead>
                        <th>Post ID</th>
                        <th>User</th>
                        <th>Text</th>
                        <th>Hashtag</th>
                        <th>Date</th>
                        <th>Likes</th>
                        <th>Share</th>
                        <th>Nude Score</th>
                        <th>Options</th>
                        <th>More</th>
                     </thead>
                     <tbody>
                        <?php
                           $data = $data_post;
                          foreach ($data as $row) {
                              ?>
                        <tr id="table-options-post-<?php echo $row['pid']; ?>">
                          <td class="table-post-td"><?php echo $row['pid']; ?></td>
                           <td><b><?php echo select_sql_id($row['id_user'], 'fullname'); ?></b></td>
                           <td class="table-post-td"><?php echo $row['texts']; ?></td>
                           <td class="table-post-td"><?php echo $row['hashtag']; ?></td>
                           <td class="table-post-td"><?php echo $row['date_post']; ?></td>
                           <td class="table-post-td"><?php echo $row['likes']; ?></td>
                           <td class="table-post-td"><?php echo $row['share']; ?></td>
                           <td class="table-post-td"><?php echo $row['adult_content_score']; ?></td>
                           <td class="table-post-td">
                            <span class="table-options delete-ajax-post" pid="<?php echo $row['pid']; ?>"  link="<?php echo $site_url; ?>admin/inc/action" q="<?php echo base64_encode('dp'); ?>" c="<?php echo $_SESSION[$id_csrf.'_token'] ; ?>"><br/><i class="fa fa-trash"></i>Delete</span></td>
                           <td class="table-post-td">
                              <span class="table-options view-more-post" link="<?php echo $site_url; ?>admin/ajax/post" pid="<?php echo $row['pid']; ?>" id_user="<?php echo $_SESSION['aid']; ?>" data-toggle="modal" token="<?php echo $_SESSION[$id_csrf.'_token'] ; ?>" data-target="#modal-post"><b>View more/Edit</b></span>
                           </td>
                        </tr>
                     <?php
                          }
                      ?>
                           <input type="hidden" id="token" name="token" value="<?php echo $_SESSION[$id_csrf.'_token'] ; ?>">
                     </tbody>
                  </table>
               </div>
            </div>
         </div>
      </div>

   </div>
</div>

<?php include 'inc/footer.php'; ?>

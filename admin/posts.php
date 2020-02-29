<?php

// +------------------------------------------------------------------------+
// | @Team author : Smart Xplorer (smartxplorer)
// | @Team author email: smartxplorerdev@gmail.com
// +------------------------------------------------------------------------+
// | Elegance - The Elegant Social Network Platform
// | Copyright (c) 2017 Elegant. All rights reserved.
// +------------------------------------------------------------------------+


   $page = 'posts';
   include 'inc/header.php';
   $data = show_users_post('50');
   ?>
<div class="content">
   <div class="container-fluid">
    <div class="row">
         
         <div class="col-md-12" style="overflow-x: scroll;">
            <span id="details"></span>
            <div class="card">
               <div class="header">
                  <h4 class="title">Post's Dashboard</h4>
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
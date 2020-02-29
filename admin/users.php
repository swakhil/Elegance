<?php

// +------------------------------------------------------------------------+
// | @Team author : Smart Xplorer (smartxplorer)
// | @Team author email: smartxplorerdev@gmail.com
// +------------------------------------------------------------------------+
// | Elegance - The Elegant Social Network Platform
// | Copyright (c) 2017 Elegant. All rights reserved.
// +------------------------------------------------------------------------+


   $page = 'users';
   include 'inc/header.php';
   $data = show_users_details('12');
   ?>
<div class="content">
   <div class="container-fluid">
    <div class="row">
         
         <div class="col-md-12">
           <span id="details"></span>
            <div class="card">
               <div class="header">
                  <h4 class="title">User's Dashboard</h4>
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
                              <span class="table-options activate-ajax" id="<?php echo $row['id']; ?>" q="<?php echo base64_encode('ub'); ?>" link="<?php echo $site_url; ?>admin/inc/action" p="<?php echo base64_encode($row['id']); ?>" c="<?php echo $_SESSION[$id_csrf.'_token'] ; ?>"><br/><i class="fa fa-check"></i>Activate</span> 
                              <?php
                                 } elseif ($row['active'] == '1') {
                                     ?>
                              <span class="table-options block-ajax" id="<?php echo $row['id']; ?>" q="<?php echo base64_encode('b'); ?>" link="<?php echo $site_url; ?>admin/inc/action" p="<?php echo base64_encode($row['id']); ?>" c="<?php echo $_SESSION[$id_csrf.'_token'] ; ?>"><br/><i class="fa fa-ban"></i>Block</span>    
                              <?php
                                 } ?>
                              <span class="table-options delete-ajax" id="<?php echo $row['id']; ?>" q="<?php echo base64_encode('d'); ?>" link="<?php echo $site_url; ?>admin/inc/action" p="<?php echo base64_encode($row['id']); ?>" c="<?php echo $_SESSION[$id_csrf.'_token'] ; ?>"><br/><i class="fa fa-trash"></i>Delete</span>
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
   </div>
</div>
<?php include 'inc/footer.php'; ?>
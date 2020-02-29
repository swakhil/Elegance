<?php

$data = show_users_details_id($id, '1');
     foreach ($data as $row) {
         $row['fullname'] = $row['firstname'].' '.$row['lastname']; ?>
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
<?php
     }

<?php

     foreach ($data as $row) {
         ?>
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
     <?php
     }
?>
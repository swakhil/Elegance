<?php

if (file_exists('../../functions/connect.php')) {
    include_once '../../functions/connect.php';
}
include '../functions/functions.php';

//Applying CSRF, XSS Protection
if (verify_token_double($website_url.'admin/', $website_url.'admin/posts', $name = $id_csrf)) {
    $pid = trim(filter_input(INPUT_POST, 'pid', FILTER_SANITIZE_STRING));
    $data = show_users_post_id($pid, '1'); ?>
<form method="POST" id="form-post">
<div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update Post</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="modal-body">

<div class="content table-responsive table-full-width">
                  <table class="table table-bordered table-hover table-striped">
                     <thead>
                        <th>User ID</th>
                        <th>Text</th>
                        <th>Hashtag</th>
                        <th>Image</th>
                        <th>Date</th>
                        <th>Likes</th>
                        <th>Share</th>
                        <th>Nude Score</th>
                        <th>Privacy</th>
                     </thead>
                     <tbody>
                        <?php
                           foreach ($data as $row) {
                               ?>
                        <tr id="table-options-post-<?php echo $row['pid']; ?>">
                           <input type="hidden" value="<?php echo $row['pid']; ?>" name="pid" />
                           <td><input class="form-control form-table" value="<?php echo $row['id_user']; ?>" name="id_user" /></td>
                           <td><input class="form-control form-table" value="<?php echo $row['texts']; ?>" name="texts" /></td>
                           <td><input class="form-control form-table" value="<?php echo $row['hashtag']; ?>" name="hashtag" /></td>
                           <td><input class="form-control form-table" value="<?php echo $row['image_url']; ?>" name="image_url" /></td>
                           <td><input class="form-control form-table" value="<?php echo $row['date_post']; ?>" name="date_post" /></td>
                           <td><input class="form-control form-table" value="<?php echo $row['likes']; ?>" name="likes" /></td>
                           <td><input class="form-control form-table" value="<?php echo $row['share']; ?>" name="share" /></td>
                           <td><input class="form-control form-table" value="<?php echo $row['adult_content_score']; ?>" name="adult_content_score" /></td>
                           <td><input class="form-control form-table" value="<?php echo $row['privacy']; ?>" name="privacy" /></td>
                           <input type="hidden" id="token" name="token" value="<?php echo $_SESSION[$id_csrf.'_token'] ; ?>">
                        </tr>
                        <?php
                           } ?>
                           <input type="hidden" id="token" name="token" value="<?php echo $_SESSION[$id_csrf.'_token'] ; ?>">
                     </tbody>
                  </table>
               </div>

          </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" name="submit" class="btn btn-primary" data-dismiss="modal" id="save-change-post" pid="<?php echo $pid; ?>" link="<?php echo $site_url; ?>admin/ajax/update-post">Save changes</button>
      </div>
      </form>
  <?php
}
?>
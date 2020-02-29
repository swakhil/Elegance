<?php

if (file_exists('../../functions/connect.php')) {
    include_once '../../functions/connect.php';
}
include '../functions/functions.php';

//Applying CSRF, XSS Protection
if (verify_token_double($website_url.'admin/', $website_url.'admin/users', $name = $id_csrf)) {
    $id = trim(filter_input(INPUT_POST, 'id', FILTER_SANITIZE_STRING));
    $data = show_user($id); ?>

<form method="POST" id="form-user">
<div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="modal-body">

<div class="content table-responsive table-full-width">
                  <table class="table table-bordered table-hover table-striped">
                     <thead>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Sex</th>
                        <th>Birthday</th>
                        <th>Country</th>
                        <th>Code</th>
                        <th>Username</th>
                        <th>Language</th>
                        <th>Registration Date</th>
                     </thead>
                     <tbody>
<?php
 foreach ($data as $row) {
     $row['fullname'] = $row['firstname'].' '.$row['lastname']; ?>
                        <tr id="table-options-<?php echo $row['id']; ?>">
                           <input type="hidden" value="<?php echo $row['id']; ?>" name="id" />
                           <td><input class="form-control form-table" value="<?php echo $row['firstname']; ?>" name="firstname" /></td>
                           <td><input class="form-control form-table" value="<?php echo $row['lastname']; ?>" name="lastname" /></td>
                           <td><input class="form-control form-table" value="<?php echo $row['email']; ?>" name="email" /></td>
                           <td><input class="form-control form-table" value="<?php echo $row['sex']; ?>" name="sex" /></td>
                           <td><input class="form-control form-table" value="<?php echo $row['birthday']; ?>" name="birthday" /></td>
                           <td><input class="form-control form-table" value="<?php echo $row['country']; ?>" name="country" /></td>
                           <td><input class="form-control form-table" value="<?php echo $row['code']; ?>" name="code" /></td>
                           <td><input class="form-control form-table" value="<?php echo $row['username']; ?>" name="username" /></td>
                           <td><input class="form-control form-table" value="<?php echo $row['language']; ?>" name="language" /></td>
                           <td><input class="form-control form-table" value="<?php echo $row['date_signin']; ?>" name="date_signin" /></td>
                           <input type="hidden" id="token" name="token" value="<?php echo $_SESSION[$id_csrf.'_token'] ; ?>">
                        </tr>
                        <?php
 } ?>
                    </tbody>
                  </table>
               </div>

          </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" name="submit" class="btn btn-primary" data-dismiss="modal" id="save-change" id_user="<?php echo $id; ?>" link="<?php echo $site_url; ?>admin/ajax/update-user">Save changes</button>
      </div>
      </form>
  <?php
}
?>
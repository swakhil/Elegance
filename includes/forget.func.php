<?php

$msg='';

if (isset($_GET['t']) && isset($_GET['i'])) {
    $token = trim(filter_input(INPUT_GET, 't', FILTER_SANITIZE_STRING));
    $id = trim(filter_input(INPUT_GET, 'i', FILTER_SANITIZE_STRING));
    $id = crypt_data($id, 'd');
    $password_db = select_sql_id($id, 'password');
    $token_db = sha1($password_db.$id);
    $forget_pwd = select_sql_id($id, 'forget_pwd');
}

 if (isset($_POST['submit'])) {
     //Applying CSRF, XSS Protection
     if (verify_token($website_url.'user/forget', $name = 'security')) {
         $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
         $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

         if (is_already_in_use('email', $email, 'users')) {
             $id = select_sqlarg('users', 'email', $email, 'id');
             update_sql_arg('users', 'forget_pwd', '1', 'id', $id);
             include '../includes/email_pwd.php';

             $msg = "<div class='alert alert-success' role='alert'>

            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>Verify your e-mail. A mail has been sent to your email address!</div>";
         } else {
             $msg = "<div class='alert alert-danger' role='alert'>

            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>*This email doesn't match with any account!</div>";
         }
     }
 }

//Applying CSRF, XSS Protection
if (verify_token_general($name = 'security')) {
    if (isset($_POST['submit_pwd'])) {
        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
        $password2 = filter_input(INPUT_POST, 'password2', FILTER_SANITIZE_STRING);

        if ($password != '' && $password == $password2) {
            $password= crypt($password, '$6$rl$stringforsalt$');
            update_sql_arg('users', 'password', $password, 'id', $id);
            update_sql_arg('users', 'forget_pwd', '0', 'id', $id);
            $msg = "<div class='alert alert-success' role='alert'>
            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>Success! Your password has been updated!</div>";
        } else {
            $msg = "<div class='alert alert-danger' role='alert'>
            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>*Passwords don't match!</div>";
        }
    }
}
?>
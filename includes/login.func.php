<?php
include_once 'functions/functions.php';
$msg='';

 if (isset($_POST['submit'])) {
     //Applying CSRF, XSS Protection
     if (verify_token_double($website_url, $website_url.'login', $name = 'security')) {
         $pdo = connectDB();
         $max_time_in_seconds = 60 * 2;
         $max_attempts = 3;
         if (login_attempt_count($max_time_in_seconds, $pdo) <= $max_attempts) {
             $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
             $username = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
             $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
             if (is_already_in_use('email', $email, 'users')) {
                 $id = select_sqlarg('users', 'email', $email, 'id');
                 $passworddb = select_sqlarg('users', 'email', $email, 'password');
             } elseif (is_already_in_use('username', $username, 'users')) {
                 $id = select_sqlarg('users', 'username', $username, 'id');
                 $passworddb = select_sqlarg('users', 'username', $username, 'password');
             } else {
                 $passworddb = '';
                 $msg = "<div class='alert alert-danger' role='alert'>
            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>*Incorrect email or username!</div>";
             }
             if (trim($passworddb) != '') {
                 if (password_verify($password, $passworddb)) {
                     $_SESSION['id'] = $id;
                     //Prevent CSRF attack
                     $token = generate_token($name = $id);
                     redirect($site_url);
                 } else {
                     $msg = "<div class='alert alert-danger' role='alert'>
            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>*Incorrect password!</div>";
                 }
             }
         } else {
             $msg = "<div class='alert alert-danger' role='alert'>

            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>You've made too many attempts to log in too quickly, For security reason you are blocked for 120 seconds..</div>";
         }
     }
 }

if (isset($_POST['submit_signup'])) {
    $email = crypt_data($_POST['email'], 'e');
    $password = crypt_data($_POST['password'], 'e');
    redirect('signup?e='.$email.'&p='.$password);
}

<?php
// +------------------------------------------------------------------------+
// | @Team author : Smart Xplorer (smartxplorer)
// | @Team author email: smartxplorerdev@gmail.com
// +------------------------------------------------------------------------+
// | Elegance - The Elegant Social Network Platform
// | Copyright (c) 2017 Elegant. All rights reserved.
// +------------------------------------------------------------------------+
include '../functions/functions.php';

$errors1 = ''; // Variable To Store Error Message
$errors2 = ''; // Variable To Store Error Message
$errors3 = ''; // Variable To Store Error Message
$errors4 = ''; // Variable To Store Error Message
$errors5 = ''; // Variable To Store Error Message
$errors6 = ''; // Variable To Store Error Message

//Applying CSRF Protection
if (verify_token_adms($name = 'admin')) {
    if (isset($_POST['signup_admin'])) {
        $firstname = trim(filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_STRING));
        $lastname = trim(filter_input(INPUT_POST, 'lastname', FILTER_SANITIZE_STRING));
        $fullname = $firstname.' '.$lastname;
        $username = trim(filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING));
        $sex = trim(filter_input(INPUT_POST, 'sex', FILTER_SANITIZE_STRING));
        $email = trim(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING));
        $url = trim(filter_input(INPUT_POST, 'url', FILTER_SANITIZE_URL));
        $password = trim(filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING));
        $passwordrepeat = trim(filter_input(INPUT_POST, 'passwordConfirm', FILTER_SANITIZE_STRING));

        if (substr($url, -1) == '/') {
            //Do anything
        } else {
            //Add a slash
            $url = $url.'/';
        }

        if (empty($fullname)) {
            $errors1 = "<div class='alert alert-danger' role='alert'>
            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>Enter your Firstname!</div>";
        }

        if (empty($sex)) {
            $errors6 = "<div class='alert alert-danger' role='alert'>
            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>Choose your sex!</div>";
        }

        if (empty($email)) {
            $errors2 = "<div class='alert alert-danger' role='alert'>
            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>Enter your Email Address!</div>";
        } else {
            if (!filter_var(trim($email), FILTER_VALIDATE_EMAIL)) {
                $errors2 = "<div class='alert alert-danger' role='alert'>
            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>Enter a valid Email address!</div>";
            } elseif (is_already_in_use('email', $email, 'users')) {
                $errors2 = "<div class='alert alert-warning' role='alert'>
            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>Email adress already in use!</div>";
            }
        }

        if (empty($url)) {
            $errors3 = "<div class='alert alert-danger' role='alert'>
            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>Enter your Website URL!</div>";
        } else {
            if (!filter_var(trim($url), FILTER_VALIDATE_URL) && $url != 'localhost') {
                $errors3 = "<div class='alert alert-danger' role='alert'>
            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>Enter a valid URL!</div>";
            } elseif (is_already_in_use('url', $url, 'users')) {
                $errors3 = "<div class='alert alert-warning' role='alert'>
            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>URL already in use!</div>";
            }
        }

        if (empty($password)) {
            $errors4 = "<div class='alert alert-danger' role='alert'>
            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>Enter your Password!</div>";
        } else {
            extract($_POST);
            if (mb_strlen($password) < 7) {
                $errors4 = "<div class='alert alert-danger' role='alert'>
            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>Enter a strong password with at least 7 characters!</div>";
            }
        }
        if ($password != $passwordrepeat) {
            $errors5 = "<div class='alert alert-danger' role='alert'>
            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>Passwords not match! Please confirm your password!</div>";
        }

        if ($errors1 == '' && $errors2 == '' && $errors3 == '' && $errors4 == '' && $errors5 == '' && $errors6 == '') {
            $password = crypt($password, '$6$rl$stringforsalt$');
            $signup = signup_adm($fullname, $email, $password);
            $signup_adm = $signup;
            update_url($url);
            $city = '';
            $adresse = '';
            $cover = 'assets/img/default_cover.jpg';
            $cover_thumb = 'assets/img/default_cover_thumb.jpg';

            if ($sex == 'Male') {
              $avatar = 'assets/img/avatar_male.jpg' ;
              $avatar_thumb = 'assets/img/avatar_male.jpg';
            } elseif ($sex == 'Female') {
              $avatar = 'assets/img/avatar_female.jpg' ;
              $avatar_thumb = 'assets/img/avatar_female.jpg';
            } else {
              $avatar = 'assets/img/avatar_male.jpg' ;
              $avatar_thumb = 'assets/img/avatar_male.jpg';
            }
            
            $code = rand_string(3, 2);
            $level = '1';
            $time = time();
            $language = 'EN-en';
            $date_signin = date('Y-m-d');

            $signup = signup($firstname, $lastname, $email, '0', $sex, '0', '0', '0', '0', $password, $code, $avatar, $avatar_thumb, $cover, $cover_thumb, '1', $username, '0', '0', $language, $date_signin, $level, $time, '0');
            $insert_email_notif = insert_email_notif($signup);
            $insert_position = insert_position($signup, '50%', '50%');

            if ($signup == 0 || $signup_adm == 0) {
                $errors1 = "<div class='alert alert-danger' role='alert'>
            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>*Unknown Error! Please contact the administrator system.</div>";
            } else {
                $_SESSION['aid'] = $signup_adm;

                //Prevent CSRF, XSS attack
                $token = generate_token($name = $signup_adm);

                redirect('../admin/general');
            }
        }
    }
}

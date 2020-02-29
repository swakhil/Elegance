<?php

include_once '../functions/functions.php';

if (file_exists('../functions/PHPMail/class.phpmailer.php')) {
    include_once '../functions/PHPMail/class.phpmailer.php';
}

//Applying CSRF, XSS Protection
if (verify_token_general($name = 'security')) {
    $errors1=''; // Variable To Store Error Message
$errors2=''; // Variable To Store Error Message
$errors3=''; // Variable To Store Error Message
$errors4=''; // Variable To Store Error Message
$errors5=''; // Variable To Store Error Message
$errors6=''; // Variable To Store Error Message
$errors7=''; // Variable To Store Error Message
$errors8=''; // Variable To Store Error Message
$errors10=''; // Variable To Store Error Message
$errors13=''; // Variable To Store Error Message
$errors14=''; // Variable To Store Error Message
$errors15=''; // Variable To Store Error Message
$success = '';



    $img_src = trim(filter_input(INPUT_POST, 'img_src', FILTER_SANITIZE_STRING));
    $firstname = trim(filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_STRING));
    $lastname = trim(filter_input(INPUT_POST, 'lastname', FILTER_SANITIZE_STRING));
    $email = trim(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING));
    //$sex = trim(filter_input(INPUT_POST, 'sex', FILTER_SANITIZE_STRING));
    //$birthday_day = trim(filter_input(INPUT_POST, 'birthday_day', FILTER_SANITIZE_STRING));
    //$birthday_month = trim(filter_input(INPUT_POST, 'birthday_month', FILTER_SANITIZE_STRING));
    //$birthday_year = trim(filter_input(INPUT_POST, 'birthday_year', FILTER_SANITIZE_STRING));
    //$birthday = $birthday_day.'-'.$birthday_month.'-'.$birthday_year;
    //$country  = trim(filter_input(INPUT_POST, 'country', FILTER_SANITIZE_STRING));
    $sex = '';
    $birthday_day = '';
    $birthday_month = '';
    $birthday_year = '';
    $birthday = $birthday_day.'-'.$birthday_month.'-'.$birthday_year;
    $country = '';
    $username  = trim(filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING));
    $username = str_replace(' ', '', $username);
    $password  = trim(filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING));
    $password2  = trim(filter_input(INPUT_POST, 'password2', FILTER_SANITIZE_STRING));
    $phone = $privacy = '1';
    $active = '1';

    if (empty($firstname)) {
        $errors1 = "<div class='alert alert-danger' role='alert'>
            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>*Enter your Firstname!</div>";
    }

    if (empty($lastname)) {
        $errors2 = "<div class='alert alert-danger' role='alert'>
            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>*Enter your Lastname!.</div>";
    }

    if (empty($email)) {
        $errors3 = "<div class='alert alert-danger' role='alert'>
            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>*Enter your Email Address!</div>";
    } else {
        if (!filter_var(trim($email), FILTER_VALIDATE_EMAIL)) {
            $errors3 = "<div class='alert alert-danger' role='alert'>
            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>*Enter a valid Email address!</div>";
        } elseif (is_already_in_use('email', $email, 'users')) {
            $errors3 = "<div class='alert alert-warning' role='alert'>
            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>*Email adress already in use!</div>";
        }
    }

    /*if (empty($sex)) {
        $errors5 = "<div class='alert alert-danger' role='alert'>
            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>*Please, choose your sex.</div>";
    }

    if (empty($birthday_day)) {
        $errors6 = "<div class='alert alert-danger' role='alert'>
            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>*Please choose your birthday.</div>";
    }

    if (empty($birthday_month)) {
        $errors7 = "<div class='alert alert-danger' role='alert'>
            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>*Please choose your birthmonth.</div>";
    }

    if (empty($birthday_year)) {
        $errors8 = "<div class='alert alert-danger' role='alert'>
            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>*Please choose your birthyear.</div>";
    }

    if (empty($country)) {
        $errors10 = "<div class='alert alert-danger' role='alert'>
            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>*Please choose your country.</div>";
    }
    */
    
    if (empty($password)) {
        $errors13 = "<div class='alert alert-danger' role='alert'>
            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>*Enter your password</div>";
    } else {
        extract($_POST);
        if (mb_strlen($password) < 8) {
            $errors13 = "<div class='alert alert-danger' role='alert'>
            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>*Your password must contain eight characters.</div>";
        }
    }
    if ($password != $password2) {
        $errors14 = "<div class='alert alert-danger' role='alert'>
            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>*Your passwords are not the same!</div>";
    }
    
    if (empty($username)) {
        $errors15 = "<div class='alert alert-danger' role='alert'>
            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>*Enter your Username!</div>";
    } else {
        if (!ctype_alpha($username)) {
            $Valid = array('-', '_');
            if (!ctype_alnum(str_replace($Valid, '', $username))) {
                // valid username, alphanumeric & longer than or equals 5 chars
                $errors15 = "<div class='alert alert-danger' role='alert'>
            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>*Enter a valid alphanumeric username!</div>";
            }
        } elseif (is_already_in_use('username', $username, 'users')) {
            $errors15 = "<div class='alert alert-warning' role='alert'>
            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>*Username adress already in use!</div>";
        }
    }

    if ($errors1 =='' && $errors2 =='' && $errors3 =='' && $errors4 =='' && $errors5 =='' && $errors6 =='' && $errors7 =='' && $errors8 =='' && $errors10 =='' && $errors13 =='' && $errors14 =='' && $errors15 =='') {
        $password= crypt($password, '$6$rl$stringforsalt$');
        $city = '0';
        $adresse = '0';
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
        $about = '0';
        $level = '1';
        $time = time();
        $language = 'EN-en';
        $verified = '0';
        $date_signin = date('Y-m-d');

        $signup = signup($firstname, $lastname, $email, $phone, $sex, $birthday, $city, $adresse, $country, $password, $code, $avatar, $avatar_thumb, $cover, $cover_thumb, $active, $username, $verified, $about, $language, $date_signin, $level, $time, $privacy);
        $insert_email_notif = insert_email_notif($signup);
        $insert_position = insert_position($signup, '50%', '50%');

        if ($signup == 0) {
            $errors1 = "<div class='alert alert-danger' role='alert'>
            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>*Unknown error! Try Again.</div>";
        } else {
            $_SESSION['id'] = $signup;
            $success = "1";
            
            $email_noreply = general_settings('email_noreply');
            $site_name = general_settings('site_name');
            $email_contact = general_settings('email_contact');
            $site_name_and_year = $site_name.'|'.date('Y');
            $template_include = 'template/template_1.html';;
            $site_url = general_settings('site_url');
            $title_desc = 'Please, '.$firstname.' confirm your email address by clicking the link below';
            $desc = 'Welcome! We may need to send you critical information about our service and it is important that we have an accurate email address.';
            $main_desc = $code;
            $main_button_url = $site_url.'user/activate?t='.sha1($password.$email).'&q='.crypt_data($signup, 'e');
            $main_button_text = 'Confirm email address';
            $title = 'Activate your account';
            send_mail($email, $email_noreply, $site_name, $title, $firstname, $title_desc, $desc, $main_desc, $main_button_url, $main_button_text, $email_contact, $site_name_and_year, $template_include, $site_url);

            //Prevent CSRF attack
            $token = generate_token($name = $signup);
            die($success);
        }
    } ?><p class="col-sm-12" >
                       <?php echo $errors1;
    echo $errors2;
    echo $errors3;
    echo $errors4;
    echo $errors5;
    echo $errors6;
    echo $errors7;
    echo $errors8;
    echo $errors10;
    echo $errors13;
    echo $errors14;
    echo $errors15; ?>
                        </p>
<?php
}
?>
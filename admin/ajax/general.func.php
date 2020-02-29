<?php

error_reporting(E_ALL);
$msg = ''; // Variable To Store Error Message

if (file_exists('../../functions/connect.php')) {
    include_once '../../functions/connect.php';
}
include '../functions/functions.php';

//Applying CSRF Protection
if (verify_token($website_url.'admin/general', $name = $id_csrf)) {
    $site_name = trim(filter_input(INPUT_POST, 'site_name', FILTER_SANITIZE_STRING));
    $site_url = trim(filter_input(INPUT_POST, 'site_url', FILTER_SANITIZE_URL));
    if (substr($site_url, -1) == '/') {
        //Do anything
    } else {
        //Add a slash
        $site_url = $site_url.'/';
    }

    $site_desc = trim(filter_input(INPUT_POST, 'site_desc', FILTER_SANITIZE_STRING));
    $site_desc2 = trim(filter_input(INPUT_POST, 'site_desc2', FILTER_SANITIZE_STRING));
    $privacy = trim(filter_input(INPUT_POST, 'privacy', FILTER_SANITIZE_SPECIAL_CHARS));
    $email_noreply = trim(filter_input(INPUT_POST, 'email_noreply', FILTER_SANITIZE_STRING));
    $email_contact = trim(filter_input(INPUT_POST, 'email_contact', FILTER_SANITIZE_STRING));

    $email = trim(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING));

    if (empty($site_name) || empty($site_url) || empty($site_desc) || empty($site_desc2) || empty($privacy) || empty($email_noreply) || empty($email_contact)) {
        $msg = "<div class='alert alert-danger' role='alert'>
            *Error! Please Fill out all fields.</div>";
    } else {
        $update = update_generals_info($site_name, $site_url, $site_desc, $site_desc2, $privacy, $email_noreply, $email_contact);

        if ($update == '1') {
            $msg = "<div class='alert alert-success' role='alert'>Successful Update!</div>";
        } elseif ($update == '0') {
            $msg = "<div class='alert alert-danger' role='alert'>
            *Unknown Error! Please try again!</div>";
        }
    }
    die($msg);
}

<?php

if (file_exists('../../functions/connect.php')) {
    include_once '../../functions/connect.php';
}
include '../functions/functions.php';

//Applying CSRF Protection
if (verify_token($website_url.'admin/seo', $name = $id_csrf)) {
    $seo = trim(filter_input(INPUT_POST, 'seo', FILTER_SANITIZE_SPECIAL_CHARS));

    if (empty($seo)) {
        $msg = "<div class='alert alert-danger' role='alert'>
            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>*Error! Please Fill out all fields.</div>";
    } else {
        $update = update_seo($seo);

        if ($update == '1') {
            $msg = "<div class='alert alert-success' role='alert'>
            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>Successful Update!</div>";
        } elseif ($update == '0') {
            $msg = "<div class='alert alert-danger' role='alert'>
            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>*Unknown Error! Please try again!</div>";
        }
        die($msg);
    }
}

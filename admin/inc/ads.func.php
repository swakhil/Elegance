<?php

// +------------------------------------------------------------------------+
// | @Team author : Smart Xplorer (smartxplorer)
// | @Team author email: smartxplorerdev@gmail.com
// +------------------------------------------------------------------------+
// | Elegance - The Elegant Social Network Platform
// | Copyright (c) 2017 Elegant. All rights reserved.
// +------------------------------------------------------------------------+


error_reporting(E_ALL);
$msg = ''; // Variable To Store Error Message

$enable_ads = general_settings('website_ads');
if ($enable_ads == '1') {
    $checked_enable_ads = 'checked="checked"';
} else {
    $checked_enable_ads = '';
}

$ads_options = general_settings('ads_options');
if ($ads_options == '1') {
    $checked_ads_options = 'checked="checked"';
} else {
    $checked_ads_options = '';
}


//Applying CSRF Protection
if (verify_token($website_url.'admin/ads', $name = $id_csrf)) {
    if (isset($_POST['enable_ads'])) {
        update_enable_ads('1');
    } else {
        update_enable_ads('0');
    }


    if (isset($_POST['ads_options'])) {
        update_ads_options('1');
    } else {
        update_ads_options('0');
    }

    if (isset($_POST['submit'])) {
        $ads_1 = trim(filter_input(INPUT_POST, 'ads_1', FILTER_SANITIZE_SPECIAL_CHARS));
        $ads_2 = trim(filter_input(INPUT_POST, 'ads_2', FILTER_SANITIZE_SPECIAL_CHARS));
        $ads_3 = '';
        $ads_4 = '';
        $ads_link_1 = trim(filter_input(INPUT_POST, 'ads_link_1', FILTER_SANITIZE_URL));
        $ads_link_2 = trim(filter_input(INPUT_POST, 'ads_link_2', FILTER_SANITIZE_URL));
        $ads_link_3 = '';
        $ads_link_4 = '';
        $ads_text_1 = trim(filter_input(INPUT_POST, 'ads_text_1', FILTER_SANITIZE_STRING));
        $ads_text_2 = trim(filter_input(INPUT_POST, 'ads_text_2', FILTER_SANITIZE_STRING));
        $ads_text_3 = '';
        $ads_text_4 = '';
        $ads_img_1 = trim(filter_input(INPUT_POST, 'ads_img_1', FILTER_SANITIZE_STRING));
        $ads_img_2 = trim(filter_input(INPUT_POST, 'ads_img_2', FILTER_SANITIZE_STRING));
        $ads_img_3 = '';
        $ads_img_4 = '';

        $update = update_ads($ads_1, $ads_2, $ads_3, $ads_4, $ads_link_1, $ads_link_2, $ads_link_3, $ads_link_4, $ads_text_1, $ads_text_2, $ads_text_3, $ads_text_4, $ads_img_1, $ads_img_2, $ads_img_3, $ads_img_4);

        if ($update == '1') {
            redirect($site_url.'admin/ads');
        } elseif ($update == '0') {
            $msg = "<div class='alert alert-danger' role='alert'>
            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>*Unknown Error! Please try again!</div>";
        }
    }
}

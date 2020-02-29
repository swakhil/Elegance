<?php

include '../../functions/connect.php';
include '../inc/ajax.func.php';

$db = connectDB();

if (isset($_SESSION['aid'])) {
    //Applying CSRF Protection
    if (verify_token($website_url.'admin/ads', $name = $id_csrf)) {
        $img = trim(filter_input(INPUT_POST, 'img', FILTER_SANITIZE_STRING));
        if ($img == 'ads_img_1') {
            update_ads_img();
        } elseif ($img == 'ads_img_2') {
            update_ads_img2();
        }
    }
}

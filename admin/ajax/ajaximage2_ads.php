<?php

include '../../functions/connect.php';
include '../inc/ajax.func.php';

$path = '../assets/img/';
$path_db = 'assets/img/';
$db = connectDB();

if (isset($_SESSION['aid'])) {
    //Applying CSRF Protection
    if (verify_token($website_url.'admin/ads', $name = $id_csrf)) {
        $valid_formats = array('jpg', 'png', 'gif', 'bmp');
        if (isset($_POST) and $_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = htmlentities($_FILES['photoimg2']['name']);
            $size = htmlentities($_FILES['photoimg2']['size']);

            if (strlen($name)) {
                list($txt, $ext) = explode('.', $name);
                if (in_array($ext, $valid_formats)) {
                    $actual_image_name = time().substr(str_replace(' ', '_', $txt), 5).'.'.$ext;
                    $tmp = htmlentities($_FILES['photoimg2']['tmp_name']);
                    if (move_uploaded_file($tmp, $path.$actual_image_name)) {
                        echo trim($path_db.$actual_image_name);
                    } else {
                        echo 'failed';
                    }
                } else {
                    echo 'Invalid file format..';
                }
            } else {
                echo 'Please select image..!';
            }

            exit;
        }
    }
}

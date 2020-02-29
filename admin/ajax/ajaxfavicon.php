<?php

include '../../functions/connect.php';
include '../inc/ajax.func.php';

$path = '../assets/logo/';
$path_db = 'assets/logo/';
$db = connectDB();

if (isset($_SESSION['aid'])) {
    //Applying CSRF Protection
    if (verify_token($website_url.'admin/general', $name = $id_csrf)) {
        $valid_formats = array('jpg', 'png', 'gif', 'bmp', 'ico');
        if (isset($_POST) and $_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = htmlentities($_FILES['photoimgfavicon']['name']);
            $size = htmlentities($_FILES['photoimgfavicon']['size']);

            if (strlen($name)) {
                list($txt, $ext) = explode('.', $name);
                if (in_array($ext, $valid_formats)) {
                    $actual_image_name = time().substr(str_replace(' ', '_', $txt), 5).'.'.$ext;
                    $tmp = htmlentities($_FILES['photoimgfavicon']['tmp_name']);
                    if (move_uploaded_file($tmp, $path.$actual_image_name)) {
                        update_back_imgfavicon($path_db.$actual_image_name);
                        echo "<img class='img-responsive' src='".$site_url.$path_db.$actual_image_name."'  class='preview'>";
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

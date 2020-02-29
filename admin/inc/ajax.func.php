<?php

// +------------------------------------------------------------------------+
// | @Team author : Smart Xplorer (smartxplorer)
// | @Team author email: smartxplorerdev@gmail.com
// +------------------------------------------------------------------------+
// | Elegance - The Elegant Social Network Platform
// | Copyright (c) 2017 Elegant. All rights reserved.
// +------------------------------------------------------------------------+


session_start();

error_reporting(E_ALL);

function returnID()
{
    $id = '';
    if (isset($_SESSION['aid'])) {
        $id = $_SESSION['aid'];
    } else {
        $id = '';
    }
    return $id;
}

$id_csrf = returnID();

function update_back_img1($img)
{
    $conn = connectDB();

    $query = 'UPDATE general_settings SET background_home1 = :background_home1';

    $sql = $conn->prepare($query);

    $sql->execute(array(':background_home1' => $img));
}

function update_back_img2($img)
{
    $conn = connectDB();

    $query = 'UPDATE general_settings SET background_home2 = :background_home2';

    $sql = $conn->prepare($query);

    $sql->execute(array(':background_home2' => $img));
}

function update_back_img3($img)
{
    $conn = connectDB();

    $query = 'UPDATE general_settings SET background_home3 = :background_home3';

    $sql = $conn->prepare($query);

    $sql->execute(array(':background_home3' => $img));
}

function update_back_img4($img)
{
    $conn = connectDB();

    $query = 'UPDATE general_settings SET background_home4 = :background_home4';

    $sql = $conn->prepare($query);

    $sql->execute(array(':background_home4' => $img));
}

function update_back_img5($img)
{
    $conn = connectDB();

    $query = 'UPDATE general_settings SET background_home5 = :background_home5';

    $sql = $conn->prepare($query);

    $sql->execute(array(':background_home5' => $img));
}

function update_back_imgfavicon($img)
{
    $conn = connectDB();

    $query = 'UPDATE general_settings SET site_favicon = :favicon';

    $sql = $conn->prepare($query);

    $sql->execute(array(':favicon' => $img));
}

function update_back_imglogo($img)
{
    $conn = connectDB();

    $query = 'UPDATE general_settings SET site_logo = :logo';

    $sql = $conn->prepare($query);

    $sql->execute(array(':logo' => $img));
}


function verify_token($referer, $name = '')
{
    if (isset($_SESSION[$name.'_token']) && isset($_POST['token'])) {
        if ($_SESSION[$name.'_token'] == $_POST['token']) {
            if (isset($_SERVER['HTTP_REFERER'])) {
                if ($_SERVER['HTTP_REFERER'] == $referer) {
                    return true;
                }
            }
        }
    }

    return false;
}

function verify_token_adm($name = '')
{
    if (isset($_SESSION[$name.'_token']) && isset($_POST['token'])) {
        if ($_SESSION[$name.'_token'] == $_POST['token']) {
            return true;
        }
    }

    return false;
}

function general_settings($col)
{
    $db = connectDB();

    $query = "SELECT $col FROM general_settings";

    $sql = $db->prepare($query);

    $sql->execute();

    $data = $sql->fetchAll();

    foreach ($data as $row) {
        $row1 = $row[$col];
    }

    return $row1;
}

function update_ads_img()
{
    $id = $_SESSION['aid'];
    $ads = '';
    $conn = connectDB();
    $sql = $conn->prepare('UPDATE general_settings SET ads_img_1 = ?');
    $sql->bindParam(1, $ads);
    if ($sql->execute() === true) {
        return 1;
    } else {
        return 0;
    }
}

function update_ads_img2()
{
    $id = $_SESSION['aid'];
    $ads = '';
    $conn = connectDB();
    $sql = $conn->prepare('UPDATE general_settings SET ads_img_2 = ?');
    $sql->bindParam(1, $ads);
    if ($sql->execute() === true) {
        return 1;
    } else {
        return 0;
    }
}

$website_url = general_settings('site_url');
$site_url = general_settings('site_url').'admin/';

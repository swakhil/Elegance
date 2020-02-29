<?php

// +------------------------------------------------------------------------+
// | @Team author : Smart Xplorer (smartxplorer)
// | @Team author email: smartxplorerdev@gmail.com
// +------------------------------------------------------------------------+
// | Elegance - The Elegant Social Network Platform
// | Copyright (c) 2017 Elegant. All rights reserved.
// +------------------------------------------------------------------------+


error_reporting(E_ALL);

session_start();

if (file_exists('../functions/connect.php')) {
    include_once '../functions/connect.php';
}

$desc = '';

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
    if (isset($row1)) {
        return $row1;
    }
}

$site_name = general_settings('site_name');
$site_logo = general_settings('site_logo');
$site_favicon = general_settings('site_favicon');
$site_desc = general_settings('site_desc');
$website_url = general_settings('site_url');
$site_url = general_settings('site_url');
$background_home_1 = general_settings('background_home1');
$background_home_2 = general_settings('background_home2');
$background_home_3 = general_settings('background_home3');
$background_home_4 = general_settings('background_home4');
$background_home_5 = general_settings('background_home5');
$meta = general_settings('meta');
$ads_1 = general_settings('ads_1');
$ads_2 = general_settings('ads_2');
$ads_3 = general_settings('ads_3');
$ads_4 = general_settings('ads_4');
$website_ads = general_settings('website_ads');
$ads_options = general_settings('ads_options');


function show_paid($paid)
{
    if ($paid == '0') {
        $paid = 'Yes';
    } else {
        $paid = 'No';
    }

    return $paid;
}

function show_status($status)
{
    if ($status == '1') {
        $status = 'Active';
    } else {
        $status = 'Inactive';
    }

    return $status;
}

function update_active($id)
{
    $conn = connectDB();

    $query = 'UPDATE users SET active = :num WHERE id = :id';

    $sql = $conn->prepare($query);

    $sql->execute(array(':num' => 1, ':id' => $id));
}

function url()
{
    if (isset($_SERVER['HTTPS'])) {
        $protocol = ($_SERVER['HTTPS'] && $_SERVER['HTTPS'] != 'off') ? 'https' : 'http';
    } else {
        $protocol = 'http';
    }

    return $protocol.'://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
}

function redirect($url, $permanent = false)
{
    if ($permanent) {
        header('HTTP/1.1 301 Moved Permanently');
    }
    header('Location: '.$url);
    exit();
}

function asDollars($value)
{
    return '$'.number_format($value, 2);
}

function url_base()
{
    if ($_SERVER['SERVER_NAME'] == 'localhost') {
        $url = url();
        $explode = explode('/', $url);
        $url = $explode[0].'/'.$explode[1].'/'.$explode[2].'/'.$explode[3].'';
    } else {
        $url = url();
        //$url= 'https://www.google.com/';
        $explode = explode('/', $url);
        $url = $explode[0].'/'.$explode[1].'/'.$explode[2].'';
    }

    return $url;
}

function select_sql($argument)
{
    $id = $_SESSION['aid'];

    $db = connectDB();

    $query = "SELECT * FROM admin WHERE id ='$id'";

    $sql = $db->prepare($query);

    $sql->execute();

    $data = $sql->fetchAll();

    foreach ($data as $row) {
        $row1 = $row[$argument];
    }

    return $row1;
}

function select_sqlarg($table, $col, $coldata, $arg)
{
    $db = connectDB();

    $query = "SELECT * FROM $table WHERE $col ='$coldata'";

    $sql = $db->prepare($query);

    $sql->execute();

    $data = $sql->fetchAll();

    if ($arg == 'fullname') {
        foreach ($data as $row) {
            $row1 = $row['firstname'].' '.$row['lastname'];
        }
    } else {
        foreach ($data as $row) {
            $row1 = $row[$arg];
        }
    }
    if (isset($row1)) {
        return $row1;
    }
}

function fetch_general_settings()
{
    $db = connectDB();

    $query = 'SELECT * FROM general_settings';

    $sql = $db->prepare($query);

    $sql->execute();

    $data = $sql->fetchAll();

    return $data;
}

function truncate($text, $chars = 1, $trunc_at_space = false, $points = '...')
{
    $text = html_entity_decode($text, ENT_QUOTES, 'UTF-8');
    $char_text = strlen($text);
    if ($char_text <=  $chars) {
        $texts = $text;
    } else {
        $texts = substr($text, 0, $chars).$points;
    }
    return $texts;
}

function show_active($page, $active)
{
    $active0 = '';
    $active1 = '';
    $active2 = '';
    $active3 = '';
    $active4 = '';

    if ($page == 'home') {
        $active0 = 'active';
    } elseif ($page == 'bitcoin') {
        $active1 = 'active';
    } elseif ($page == 'api') {
        $active2 = 'active';
    } elseif ($page == 'pricing') {
        $active3 = 'active';
    } elseif ($page == 'connect') {
        $active4 = 'active';
    }

    if ($active == 'active0') {
        return $active0;
    } elseif ($active == 'active1') {
        return $active1;
    } elseif ($active == 'active2') {
        return $active2;
    } elseif ($active == 'active3') {
        return $active3;
    } elseif ($active == 'active4') {
        return $active4;
    }
}

function generate_token($name = '')
{
    $token = uniqid(rand(), true);
    $_SESSION[$name.'_token'] = $token;

    return $token;
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

function verify_token_double($referer1, $referer2, $name = '')
{
    if (isset($_SESSION[$name.'_token']) && isset($_POST['token'])) {
        if ($_SESSION[$name.'_token'] == $_POST['token']) {
            if (isset($_SERVER['HTTP_REFERER'])) {
                if ($_SERVER['HTTP_REFERER'] == $referer1 || $_SERVER['HTTP_REFERER'] == $referer2) {
                    return true;
                }
            }
        }
    }

    return false;
}

function verify_token_triple($referer1, $referer2, $referer3, $name = '')
{
    if (isset($_SESSION[$name.'_token']) && isset($_POST['token'])) {
        if ($_SESSION[$name.'_token'] == $_POST['token']) {
            if (isset($_SERVER['HTTP_REFERER'])) {
                if ($_SERVER['HTTP_REFERER'] == $referer1 || $_SERVER['HTTP_REFERER'] == $referer2 || $_SERVER['HTTP_REFERER'] == $referer3) {
                    return true;
                }
            }
        }
    }

    return false;
}

function verify_token_adm($name = '')
{
    if (isset($_SESSION[$name.'_token']) && isset($_GET['c'])) {
        if ($_SESSION[$name.'_token'] == $_GET['c']) {
            return true;
        }
    }

    return false;
}

function isCurrency($number)
{
    return preg_match("/^\d+(?:\.\d{2})?$/", $number);
}

function send_email($firstname, $password, $email)
{
    $site_name = '';

    $link = '';

    //send email

    $token = sha1($firstname.$password.$email);

    $mail = new PHPMailer();

    $mail->From = 'noreply@cc.com';

    $mail->FromName = $site_name;

    $mail->Subject = $site_name.' Activate your account';

    $body = file_get_contents('PHPMail/email.html');

    $body = str_replace('%firstname%', $firstname, $body);

    $body = str_replace('%site_name%', $site_name, $body);

    $body = str_replace('%link%', $link, $body);

    $mail->MsgHTML($body);

    $mail->AltBody = $firstname.', Activate your account!';

    $mail->AddAddress($email, $firstname);

    $mail->CharSet = 'UTF-8';

    $mail->send();
}


function update_generals_info($site_name, $site_url, $site_desc, $site_desc2, $privacy, $email_noreply, $email_contact)
{
    $id = $_SESSION['aid'];
    $conn = connectDB();
    $sql = $conn->prepare('UPDATE general_settings SET site_name = ?, site_url = ?, site_desc = ?, site_desc2 = ?,  privacy = ?, email_noreply = ?, email_contact = ?');
    $sql->bindParam(1, $site_name);
    $sql->bindParam(2, $site_url);
    $sql->bindParam(3, $site_desc);
    $sql->bindParam(4, $site_desc2);
    $sql->bindParam(5, $privacy);
    $sql->bindParam(6, $email_noreply);
    $sql->bindParam(7, $email_contact);
    if ($sql->execute() === true) {
        return 1;
    } else {
        return 0;
    }
}


function update_ads($ads_1, $ads_2, $ads_3, $ads_4, $ads_link_1, $ads_link_2, $ads_link_3, $ads_link_4, $ads_text_1, $ads_text_2, $ads_text_3, $ads_text_4, $ads_img_1, $ads_img_2, $ads_img_3, $ads_img_4)
{
    $id = $_SESSION['aid'];
    $conn = connectDB();
    $sql = $conn->prepare('UPDATE general_settings SET ads_1 = ?, ads_2 = ?, ads_3 = ?, ads_4 = ?, ads_link_1 = ?, ads_link_2 = ?, ads_link_3 = ?, ads_link_4 = ?, ads_text_1 = ?, ads_text_2 = ?, ads_text_3 = ?, ads_text_4 = ?, ads_img_1 = ?, ads_img_2 = ?, ads_img_3 = ?, ads_img_4 = ?');
    $sql->bindParam(1, $ads_1);
    $sql->bindParam(2, $ads_2);
    $sql->bindParam(3, $ads_3);
    $sql->bindParam(4, $ads_4);
    $sql->bindParam(5, $ads_link_1);
    $sql->bindParam(6, $ads_link_2);
    $sql->bindParam(7, $ads_link_3);
    $sql->bindParam(8, $ads_link_4);
    $sql->bindParam(9, $ads_text_1);
    $sql->bindParam(10, $ads_text_2);
    $sql->bindParam(11, $ads_text_3);
    $sql->bindParam(12, $ads_text_4);
    $sql->bindParam(13, $ads_img_1);
    $sql->bindParam(14, $ads_img_2);
    $sql->bindParam(15, $ads_img_3);
    $sql->bindParam(16, $ads_img_4);

    if ($sql->execute() === true) {
        return 1;
    } else {
        return 0;
    }
}

function update_seo($seo)
{
    $id = $_SESSION['aid'];
    $conn = connectDB();
    $sql = $conn->prepare('UPDATE general_settings SET meta = ?');
    $sql->bindParam(1, $seo);
    if ($sql->execute() === true) {
        return 1;
    } else {
        return 0;
    }
}

function update_enable_ads($var)
{
    $id = $_SESSION['aid'];
    $conn = connectDB();
    $sql = $conn->prepare('UPDATE general_settings SET website_ads = ?');
    $sql->bindParam(1, $var);
    if ($sql->execute() === true) {
        return 1;
    } else {
        return 0;
    }
}

function update_ads_options($var)
{
    $id = $_SESSION['aid'];
    $conn = connectDB();
    $sql = $conn->prepare('UPDATE general_settings SET ads_options = ?');
    $sql->bindParam(1, $var);
    if ($sql->execute() === true) {
        return 1;
    } else {
        return 0;
    }
}

function update_users($col, $data)
{
    $id = $_SESSION['aid'];

    $conn = connectDB();

    $sql = $conn->prepare("UPDATE users SET $col = ? WHERE (id = ? )");

    $sql->bindParam(1, $data);

    $sql->bindParam(2, $id);

    if ($sql->execute() === true) {
        return 1;
    } else {
        return 0;
    }
}

function ShowImageAds($image_url)
{
    if ($image_url != '') {
        $image_url = '<img class="img-responsive" src="'.$image_url.'"/>';
    } else {
        $image_url = '';
    }
    return $image_url;
}

function subtract_request($api_key)
{
    $one = '1';

    $conn = connectDB();

    $sql = $conn->prepare('UPDATE users SET api_request_remaining  = api_request_remaining - ? WHERE (api_key = ? )');

    $sql->bindParam(1, $one);

    $sql->bindParam(2, $api_key);

    if ($sql->execute() === true) {
        return 1;
    } else {
        return 0;
    }
}

function timeago($date)
{
    $timestamp = strtotime($date);

    $strTime = array('second', 'minute', 'hour', 'day', 'month', 'year');

    $length = array('60', '60', '24', '30', '12', '10');

    $currentTime = time();

    if ($currentTime >= $timestamp) {
        $diff = time() - $timestamp;

        for ($i = 0; $diff >= $length[$i] && $i < count($length) - 1; ++$i) {
            $diff = $diff / $length[$i];
        }

        $diff = round($diff);

        return $diff.' '.$strTime[$i].'(s) ago ';
    }
}

function get_timeago($ptime)
{
    $estimate_time = time() - $ptime;

    if ($estimate_time < 1) {
        return 'less than 1 second ago';
    }

    $condition = array(

        12 * 30 * 24 * 60 * 60 => 'year',

        30 * 24 * 60 * 60 => 'month',

        24 * 60 * 60 => 'day',

        60 * 60 => 'hour',

        60 => 'minute',

        1 => 'second',

    );

    foreach ($condition as $secs => $str) {
        $d = $estimate_time / $secs;

        if ($d >= 1) {
            $r = round($d);

            return 'about '.$r.' '.$str.($r > 1 ? 's' : '').' ago';
        }
    }
}

function is_already_in_use($field, $value, $table)
{
    $db = connectDB();

    $query = "SELECT * FROM $table WHERE $field='$value'";

    $sql = $db->prepare($query);

    $sql->execute();

    $count = $sql->rowCount();

    $sql->closeCursor();

    return $count;
}

function show_user($id)
{
    $db = connectDB();

    $query = "SELECT * FROM users WHERE id = ".$id."";

    $sql = $db->prepare($query);

    $sql->execute();
    $data = $sql->fetchAll();

    return $data;
}

function update_posts_adm($pid, $id_user, $texts, $hashtag, $image_url, $date_post, $likes, $share, $adult_content_score, $privacy)
{
    $conn = connectDB();

    $sql = $conn->prepare("UPDATE posts SET pid = ?, id_user = ?, texts = ?, hashtag = ?, image_url = ?, date_post = ?, likes = ?, share = ?, adult_content_score = ?, privacy = ? WHERE pid =".$pid."");

    $sql->bindParam(1, $pid);

    $sql->bindParam(2, $id_user);

    $sql->bindParam(3, $texts);

    $sql->bindParam(4, $hashtag);

    $sql->bindParam(5, $image_url);

    $sql->bindParam(6, $date_post);

    $sql->bindParam(7, $likes);

    $sql->bindParam(8, $share);

    $sql->bindParam(9, $adult_content_score);

    $sql->bindParam(10, $privacy);

    if ($sql->execute() === true) {
        return 1;
    } else {
        return 0;
    }
}

function update_users_adm($id, $firstname, $lastname, $email, $sex, $birthday, $country, $code, $username, $language, $date_signin)
{
    $conn = connectDB();

    $sql = $conn->prepare("UPDATE users SET id = ?, firstname = ?, lastname = ?, email = ?, sex = ?, birthday = ?, country = ?, code = ?, username = ?, language = ?, date_signin = ? WHERE id =".$id."");

    $sql->bindParam(1, $id);

    $sql->bindParam(2, $firstname);

    $sql->bindParam(3, $lastname);

    $sql->bindParam(4, $email);

    $sql->bindParam(5, $sex);

    $sql->bindParam(6, $birthday);

    $sql->bindParam(7, $country);

    $sql->bindParam(8, $code);

    $sql->bindParam(9, $username);

    $sql->bindParam(10, $language);

    $sql->bindParam(11, $date_signin);

    if ($sql->execute() === true) {
        return 1;
    } else {
        return 0;
    }
}

function show_users_details($limit, $tri = 'ASC')
{
    $db = connectDB();

    $query = "SELECT * FROM users order by id ".$tri." LIMIT ".$limit."";

    $sql = $db->prepare($query);

    $sql->execute();
    $data = $sql->fetchAll();

    return $data;
}

function show_users_details_id($id, $limit)
{
    $db = connectDB();

    $query = "SELECT * FROM users WHERE id = ".$id." order by id ASC LIMIT ".$limit."";

    $sql = $db->prepare($query);

    $sql->execute();
    $data = $sql->fetchAll();

    return $data;
}

function show_users_post($limit, $tri = 'ASC')
{
    $db = connectDB();

    $query = "SELECT * FROM posts order by pid ".$tri." LIMIT ".$limit."";

    $sql = $db->prepare($query);

    $sql->execute();
    $data = $sql->fetchAll();

    return $data;
}

function show_users_post_id($pid, $limit)
{
    $db = connectDB();

    $query = "SELECT * FROM posts WHERE pid = ".$pid." order by pid ASC LIMIT ".$limit."";

    $sql = $db->prepare($query);

    $sql->execute();
    $data = $sql->fetchAll();

    return $data;
}

function allusers()
{
    $db = connectDB();

    $query = 'SELECT COUNT(id) as count FROM users';

    $sql = $db->prepare($query);

    $sql->execute();

    $data = $sql->fetchAll();

    foreach ($data as $row) {
        $row1 = $row['count'];
    }

    if (isset($row1)) {
        return $row1;
    }

    return $count;
}

function allposts()
{
    $db = connectDB();

    $query = 'SELECT COUNT(pid) as count FROM posts';

    $sql = $db->prepare($query);

    $sql->execute();

    $data = $sql->fetchAll();

    foreach ($data as $row) {
        $row1 = $row['count'];
    }

    if (isset($row1)) {
        return $row1;
    }

    $sql->closeCursor();
}

function select_count($col_count, $table, $col, $coldata)
{
    $db = connectDB();

    $query = "SELECT COUNT($col_count) as count FROM $table WHERE $col = '$coldata'";

    $sql = $db->prepare($query);

    $sql->execute();

    $data = $sql->fetchAll();

    foreach ($data as $row) {
        $row1 = $row['count'];
    }

    if (isset($row1)) {
        return $row1;
    }

    $sql->closeCursor();
}

function select_sql_id($id, $argument)
{
    $db = connectDB();

    $query = "SELECT * FROM users WHERE id ='$id'";

    $sql = $db->prepare($query);

    $sql->execute();

    $data = $sql->fetchAll();

    if ($argument == 'fullname') {
        foreach ($data as $row) {
            $row1 = $row['firstname'].' '.$row['lastname'];
        }
    } else {
        foreach ($data as $row) {
            $row1 = $row[$argument];
        }
    }
    if (isset($row1)) {
        return $row1;
    }
}

function select_count_post($sexdata)
{
    $db = connectDB();

    $query = "SELECT COUNT(pid) as count FROM posts INNER JOIN users ON users.id = posts.id_user WHERE sex = '$sexdata'";

    $sql = $db->prepare($query);

    $sql->execute();

    $data = $sql->fetchAll();

    foreach ($data as $row) {
        $row1 = $row['count'];
    }

    if (isset($row1)) {
        return $row1;
    }

    $sql->closeCursor();
}

function sum_all($table, $field)
{
    $db = connectDB();

    $query = "SELECT sum($field) AS $field FROM $table";

    $sql = $db->prepare($query);

    $sql->execute();

    $data = $sql->fetchAll();

    foreach ($data as $row) {
        $row1 = $row[$field];
    }

    if (isset($row1)) {
        return $row1;
    }
}

function block_user($id)
{
    $conn = connectDB();

    $query = 'UPDATE users SET active = :num WHERE id = :id';

    $sql = $conn->prepare($query);

    $sql->execute(array(':num' => 0, ':id' => $id));
}

function delete_user($id)
{
    $conn = connectDB();
    $query = 'DELETE FROM users WHERE id= :id';
    $sql = $conn->prepare($query);
    $sql->execute(array(':id' => $id));
}

function delete_post($pid)
{
    $conn = connectDB();
    $query = 'DELETE FROM posts WHERE pid= :pid';
    $sql = $conn->prepare($query);
    $sql->execute(array(':pid' => $pid));
}


function login_attempt_count($seconds, $pdo)
{
    try {

        // First we delete old attempts from the table

        $del_old = 'DELETE FROM attempts WHERE `when` < ?';

        $oldest = strtotime(date('Y-m-d H:i:s').' - '.$seconds.' seconds');

        $oldest = date('Y-m-d H:i:s', $oldest);

        $del_data = array($oldest);

        $remove = $pdo->prepare($del_old);

        $remove->execute($del_data);

        // Next we insert this attempt into the table

        $insert = 'INSERT INTO attempts (`ip`, `when`) VALUES ( ?, ? )';

        $data = array($_SERVER['REMOTE_ADDR'], date('Y-m-d H:i:s'));

        $input = $pdo->prepare($insert);

        $input->execute($data);

        // Finally we count the number of recent attempts from this ip address

        $count = 'SELECT count(*) as number FROM attempts where `ip` = ?';

        $num = $pdo->prepare($count);

        $num->execute(array($_SERVER['REMOTE_ADDR']));

        foreach ($num as $attempt) {
            $attempts = $attempt['number'];
        }

        return $attempts;
    } catch (PDOEXCEPTION $e) {
        echo 'Error: '.$e;
    }
}

function is_connected()
{
    $connected = @fsockopen("www.example.com", 80);
    //website, port  (try 80 or 443)
    if ($connected) {
        $is_conn = true; //action when connected
        fclose($connected);
    } else {
        $is_conn = false; //action in connection failure
    }
    return $is_conn;
}

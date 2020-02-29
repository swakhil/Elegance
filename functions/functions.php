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

require 'connect.php';

if (file_exists('../functions/PHPMail/class.phpmailer.php')) {
    include_once '../functions/PHPMail/class.phpmailer.php';
}

if (file_exists('assets/plugins/php-emoji/emoji.php')) {
    include_once 'assets/plugins/php-emoji/emoji.php';
} elseif (file_exists('../assets/plugins/php-emoji/emoji.php')) {
    include_once '../assets/plugins/php-emoji/emoji.php';
}

function returnID()
{
    $id = '';
    if (isset($_SESSION['id'])) {
        $id = $_SESSION['id'];
    } else {
        $id = '';
    }
    return $id;
}

$id_csrf = returnID();
$id_csrf_ip = $_SERVER['REMOTE_ADDR'];

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

function general_users($col)
{
    $db = connectDB();

    $query = "SELECT $col FROM users";

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

define('SITE_NAME', general_settings('site_name'));
$site_name = general_settings('site_name');
$site_logo = general_settings('site_logo');
$site_favicon = general_settings('site_favicon');
$site_desc = general_settings('site_desc');
$site_url = general_settings('site_url');
$website_url = general_settings('site_url');
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


function display_ads($value)
{
    switch ($value) {
  case "1":
   $ads = general_settings('ads_1');
   $mlt = '321x400';
   break;
  case "2":
   $ads = general_settings('ads_2');
   $mlt = '506x400';
   break;
  case "3":
   $ads = general_settings('ads_3');
   $mlt = '321x400';
   break;
  case "4":
   $ads = general_settings('ads_4');
   $mlt = '506x400';
   break;
 }
    /*if(trim($ads) == '') {
       $ads = '<img src="http://via.placeholder.com/'.$mlt.'" class="img-responsive img-ads" style="margin-bottom: 10px;">';
    }*/
    return $ads;
}
 
function ShowImageAdSite($image_url)
{
    $site_url = general_settings('site_url');
    if ($image_url != '') {
        $image_url = '<img class="img-responsive img-url" src="'.$site_url.'admin/'.$image_url.'"/>';
    } else {
        $image_url = '';
    }
    return $image_url;
}


function display_own_ads($value)
{
    $site_url = general_settings('site_url');
    switch ($value) {
  case "1":
   $ads_text = general_settings('ads_text_1');
   $ads = "<p id='sponsored_text'><a href='".general_settings('ads_link_1')."' target='_blank'>".general_settings('ads_text_1')."</a></p>";
   $ads .= "<a href='".general_settings('ads_link_1')."' target='_blank'>".ShowImageAdSite(general_settings('ads_img_1'))."</a>";
   $mlt = '321x400';
   break;
  case "2":
   $ads_text = general_settings('ads_text_2');
   $ads = "<p id='sponsored_text'><a href='".general_settings('ads_link_2')."' target='_blank'>".general_settings('ads_text_2')."</a></p>";
   $ads .= "<a href='".general_settings('ads_link_2')."' target='_blank'>".ShowImageAdSite(general_settings('ads_img_2'))."</a>";
   $mlt = '506x400';
   break;
  case "3":
   $ads_text = general_settings('ads_text_3');
   $ads = "<p id='sponsored_text'><a href='".general_settings('ads_link_3')."' target='_blank'>".general_settings('ads_text_3')."</a></p>";
   $ads .= "<a href='".general_settings('ads_link_3')."' target='_blank'>".ShowImageAdSite(general_settings('ads_img_3'))."</a>";
   $mlt = '321x400';
   break;
  case "4":
   $ads_text = general_settings('ads_text_4');
   $ads = "<p id='sponsored_text'><a href='".general_settings('ads_link_4')."' target='_blank'>".general_settings('ads_text_4')."</a></p>";
   $ads .= "<a href='".general_settings('ads_link_4')."' target='_blank'>".ShowImageAdSite(general_settings('ads_img_4'))."</a>";
   $mlt = '506x400';
   break;
 }
    /*if(trim($ads_text) == '') {
       $ads = '<img src="http://via.placeholder.com/'.$mlt.'" class="img-responsive img-ads" style="margin-bottom: 10px;">';
    }*/
    return $ads;
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

function url()
{
    if (isset($_SERVER['HTTPS'])) {
        $protocol = ($_SERVER['HTTPS'] && $_SERVER['HTTPS'] != 'off') ? 'https' : 'http';
    } else {
        $protocol = 'http';
    }

    return $protocol.'://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
}

function update_active($id)
{
    $conn = connectDB();

    $query = 'UPDATE users SET active = :num WHERE id = :id';

    $sql = $conn->prepare($query);

    $sql->execute(array(':num' => 1, ':id' => $id));
}

function redirect($url, $permanent = false)
{
    if ($permanent) {
        header('HTTP/1.1 301 Moved Permanently');
    }
    header('Location: '.$url);
    exit();
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

function select_sql_username($username, $argument)
{
    $db = connectDB();

    $query = "SELECT * FROM users WHERE username ='$username'";

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

function verif_pid($pid)
{
    $db = connectDB();

    $query = "SELECT * FROM posts WHERE pid ='$pid'";

    $sql = $db->prepare($query);

    $sql->execute();

    $count = $sql->rowCount();

    if (isset($count)) {
        return $count;
    }
}

function select_post_id($pid, $argument)
{
    $db = connectDB();

    $query = "SELECT * FROM posts WHERE pid ='$pid'";

    $sql = $db->prepare($query);

    $sql->execute();

    $data = $sql->fetchAll();

    foreach ($data as $row) {
        $row1 = $row[$argument];
    }

    if (isset($row1)) {
        return $row1;
    }
}

function select_post($pid)
{
    $db = connectDB();
    $query = "SELECT * FROM posts WHERE pid ='$pid'";
    $sql = $db->prepare($query);
    $sql->execute();
    return $sql->fetchAll();
}

function select_sql($argument)
{
    $id = $_SESSION['id'];

    $db = connectDB();

    $query = "SELECT * FROM users WHERE id ='$id'";

    $sql = $db->prepare($query);

    $sql->execute();

    $data = $sql->fetchAll();

    foreach ($data as $row) {
        $row1 = $row[$argument];
    }

    if (isset($row1)) {
        return $row1;
    }
}

function select_last_message($cvid, $arg)
{
    $db = connectDB();
    $id = $_SESSION['id'];
    $query = "SELECT * FROM messages WHERE cvid_fk = ".$cvid." AND `user_from` = ".$id." AND `hide_user_from` = 0 UNION SELECT * FROM messages WHERE cvid_fk = ".$cvid." AND `user_to` = ".$id." AND `hide_user_to` = 0 ORDER BY mid DESC LIMIT 1";

    $sql = $db->prepare($query);

    $sql->execute();

    $data = $sql->fetchAll();

    foreach ($data as $row) {
        $row1 = $row[$arg];
    }

    if (isset($row1)) {
        return $row1;
    }
}

function format_edit($string)
{
    $text = preg_replace("/<br\W*?\/>/", "\n", $string);
    return $text;
}

function select_count($table, $where_row, $where_data, $where_row2, $where_data2)
{
    $db = connectDB();

    $query = "SELECT count(*) as count FROM $table where $where_row = $where_data and $where_row2 = $where_data2";

    $sql = $db->prepare($query);

    $sql->execute();

    $data = $sql->fetchAll();

    foreach ($data as $row) {
        $row1 = $row[0];
    }

    if (isset($row1)) {
        return $row1;
    }
}

function generate_token($name = '')
{
    $token = uniqid(rand(), true);
    $_SESSION[$name.'_token'] = $token;

    return $token;
}

function verify_token_general($name = '')
{
    $site_url = general_settings('site_url');
    $site_url_length = mb_strlen($site_url);
    if (isset($_SESSION[$name.'_token']) && isset($_POST['token'])) {
        if ($_SESSION[$name.'_token'] == $_POST['token']) {
            if (isset($_SERVER['HTTP_REFERER'])) {
                $server_referer = truncate($_SERVER['HTTP_REFERER'], $chars = $site_url_length, $trunc_at_space = false, $points = '');
                if ($server_referer == $site_url) {
                    return true;
                }
            }
        }
    }

    return false;
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

function verify_token_adms($name = '')
{
    if (isset($_SESSION[$name.'_token']) && isset($_POST['token'])) {
        if ($_SESSION[$name.'_token'] == $_POST['token']) {
            return true;
        }
    }

    return false;
}

function mini_truncate($text, $max_length = 14, $replacement = '', $trunc_at_space = false)
{
    $max_length -= strlen($replacement);
    $string_length = strlen($text);

    if ($string_length <= $max_length) {
        return $text;
    }

    if ($trunc_at_space && ($space_position = strrpos($string, ' ', $max_length - $string_length))) {
        $max_length = $space_position;
    }
    $text = substr_replace($text, $replacement, $max_length);
    $text = $text.'...';

    return $text;
}

function select_sqlarg($table, $col, $coldata, $arg, $count='false')
{
    $db = connectDB();

    $query = "SELECT * FROM $table WHERE $col ='$coldata'";

    $sql = $db->prepare($query);

    $sql->execute();

    $data = $sql->fetchAll();
    $count = $sql->rowCount();

    if ($count == 'true') {
        return $count;
    } else {
        foreach ($data as $row) {
            $row1 = $row[$arg];
        }

        if (isset($row1)) {
            return $row1;
        }
    }
}

function select_doublearg($table, $row, $rowdata, $row2, $rowdata2, $arg, $count='false')
{
    $db = connectDB();

    $query = "SELECT * FROM $table WHERE $row ='$rowdata' AND $row2 ='$rowdata2'";

    $sql = $db->prepare($query);

    $sql->execute();

    $data = $sql->fetchAll();
    $count = $sql->rowCount();

    if ($count == 'true') {
        return $count;
    } else {
        foreach ($data as $row) {
            $row1 = $row[$arg];
        }

        if (isset($row1)) {
            return $row1;
        }
    }
}

function active_li_mess($user_id)
{
    $actives = '';
    if (isset($_GET['u'])) {
        $u = trim(filter_input(INPUT_GET, 'u', FILTER_SANITIZE_STRING));
        $id = select_sqlarg('users', 'username', $u, 'id');
        if ($id == $user_id) {
            $actives = 'actives';
        }
    }
    return $actives;
}

function show_boxsender()
{
    $style = '';
    if (isset($_GET['u'])) {
        $u = trim(filter_input(INPUT_GET, 'u', FILTER_SANITIZE_STRING));
        $id = select_sqlarg('users', 'username', $u, 'id');
        if ($id == '') {
            $style = 'style="display: none"';
        }
    } else {
        $style = 'style="display: none"';
    }
    return $style;
}

function insert_online($online_ip, $online_user, $online_time)
{
    try {
        $conn =  connectDB();
        $num = "0";
        $sql = $conn->prepare("INSERT INTO online (online_ip, online_user, online_time, absent) VALUES (?,?,?,?)");
        $sql->bindParam(1, $online_ip);
        $sql->bindParam(2, $online_user);
        $sql->bindParam(3, $online_time);
        $sql->bindParam(4, $num);

        if ($sql->execute() === true) {
            return $conn->lastInsertId('online_id');
        } else {
            return 0;
        }
    } catch (PDOException $e) {
        die('Erreur : ' . $e->getMessage());
    }
}

function select_online($var, $count='false')
{
    $db = connectDB();
    $id = $_SESSION['id'];
    $query = "SELECT * FROM friends INNER JOIN users ON  users.id = friends.id_recipient INNER JOIN online ON  online.online_user = friends.id_recipient WHERE id_sender ='$id' && id != '$id' && absent = '$var'";
    $sql = $db->prepare($query);

    $sql->execute();

    $data = $sql->fetchAll();
    $count = $sql->rowCount();

    if ($count == 'true') {
        return $count;
    } else {
        return $data;
    }
}

function select_pid_prev($pid, $html = false)
{
    $db = connectDB();
    $id = select_sqlarg('posts', 'pid', $pid, 'id_user');
    $query = "SELECT * FROM `posts` WHERE pid < '$pid' AND id_user = '$id' AND image_url !='' ORDER BY pid DESC LIMIT 1";

    $sql = $db->prepare($query);

    $sql->execute();

    $data = $sql->fetchAll();

    foreach ($data as $row) {
        $row1 = $row['pid'];
    }

    if (isset($row1)) {
        if ($html) {
            if ($row1 != '') {
                $html='<a class="left carousel-control" href="#" role="button" data-slide="prev"   pid-prev="'.$row1.'"  id="post-prev">
                                    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                </a>';
            } else {
                $html = '';
            }
            return $html;
        } else {
            return $row1;
        }
    }
}

function select_pid_next($pid, $html = false)
{
    $db = connectDB();
    $id = select_sqlarg('posts', 'pid', $pid, 'id_user');
    $query = "SELECT * FROM `posts` WHERE pid > '$pid' AND id_user = '$id' AND image_url !='' ORDER BY pid ASC LIMIT 1";

    $sql = $db->prepare($query);

    $sql->execute();

    $data = $sql->fetchAll();

    foreach ($data as $row) {
        $row1 = $row['pid'];
    }

    if (isset($row1)) {
        if ($html) {
            if ($row1 != '') {
                $html='<a class="right carousel-control" href="#" role="button" data-slide="next"   pid-next="'.$row1.'" id="post-next">
                                    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                </a>';
            } else {
                $html = '';
            }
            return $html;
        } else {
            return $row1;
        }
    }
}

function select_conversation($int = 0, $user_one, $user_two = 0, $arg = 0)
{
    $db = connectDB();

    if ($int == 0) {
        $query = "SELECT * FROM `conversation` WHERE `user_one` = '$user_one' AND `user_two` = '$user_two' OR `user_one` = '$user_two' AND `user_two` = '$user_one'";

        $sql = $db->prepare($query);

        $sql->execute();

        $data = $sql->fetchAll();

        foreach ($data as $row) {
            $row1 = $row[$arg];
        }

        if (isset($row1)) {
            return $row1;
        }
    } else {
        $query = "SELECT cvid,dates_cv,user_one AS user_id FROM conversation WHERE user_two = ".$user_one." UNION ALL SELECT cvid,dates_cv,user_two AS user_id FROM conversation WHERE user_one = ".$user_one." ORDER BY cvid DESC LIMIT ".$int."";
        $sql = $db->prepare($query);

        $sql->execute();

        $data = $sql->fetchAll();
        return $data;
    }
}

function select_message($cvid_fk, $count = false)
{
    $db = connectDB();

    $query = "SELECT * FROM messages WHERE cvid_fk =".$cvid_fk." ORDER BY mid ASC";

    $sql = $db->prepare($query);

    $sql->execute();
   
    if ($count) {
        $count = $sql->rowcount();
        return $count;
    } else {
        $data = $sql->fetchAll();
        return $data;
    }
}

function count_message_all($user_from)
{
    $db = connectDB();

    $query = "SELECT count(*) AS count FROM messages WHERE user_to = ".$user_from." OR user_from = ".$user_from."";

    $sql = $db->prepare($query);

    $sql->execute();

    $data = $sql->fetchAll();

    foreach ($data as $row) {
        $row1 = $row['count'];
    }

        if (isset($row1)) {
            return $row1;
        }
}

function count_message($cvid, $badge = false)
{
    $db = connectDB();
    $id = $_SESSION['id'];
    $query = "SELECT count(*) AS count FROM messages WHERE cvid_fk = ".$cvid." AND unread = 1 AND user_from != ".$id."";

    $sql = $db->prepare($query);

    $sql->execute();

    $data = $sql->fetchAll();

    foreach ($data as $row) {
        $row1 = $row['count'];
    }

    if ($badge) {
        if (isset($row1) && $row1 > 0) {
            $badge = '<span class="badge pull-right mess-badge">'.$row1.'</span>';
            return $badge;
        }
    } else {
        if (isset($row1)) {
            return $row1;
        }
    }
}

function issetGetU()
{
    $var = '';
    if (isset($_GET['u'])) {
        $var = trim(filter_input(INPUT_GET, 'u', FILTER_SANITIZE_STRING));
    }
    return $var;
}

function count_global_message($user_from, $badge = false)
{
    $db = connectDB();

    $query = "SELECT count(*) AS count FROM messages WHERE user_to = ".$user_from." AND notif_unread = 1";

    $sql = $db->prepare($query);

    $sql->execute();

    $data = $sql->fetchAll();

    foreach ($data as $row) {
        $row1 = $row['count'];
    }

    if ($badge == true) {
        if (isset($row1) && $row1 > 0) {
            $badge = '<span class="badge badgesx badgesx-default" id="mess_id">'.$row1.'</span>';
            return $badge;
        }
    } elseif ($badge == false) {
        if (isset($row1)) {
            return $row1;
        }
    }
}


function insert_message($cvid_fk, $user_from, $user_to, $message, $img_url, $unread, $notif_unread, $dates_send)
{
    try {
        $conn =  connectDB();

        $sql = $conn->prepare("INSERT INTO messages (cvid_fk,user_from,user_to,message,img_url,unread,notif_unread,dates_send) VALUES (?,?,?,?,?,?,?,?)");
        $sql->bindParam(1, $cvid_fk);
        $sql->bindParam(2, $user_from);
        $sql->bindParam(3, $user_to);
        $sql->bindParam(4, $message);
        $sql->bindParam(5, $img_url);
        $sql->bindParam(6, $unread);
        $sql->bindParam(7, $notif_unread);
        $sql->bindParam(8, $dates_send);

        if ($sql->execute() === true) {
            return $conn->lastInsertId('mid');
        } else {
            return 0;
        }
    } catch (PDOException $e) {
        die('Erreur : ' . $e->getMessage());
    }
}

function getHost($Address)
{
    $parseUrl = parse_url(trim($Address));
    return trim($parseUrl['host'] ? $parseUrl['host'] : array_shift(explode('/', $parseUrl['path'], 2)));
}

function start_chat($id_chat, $cvid, $id_user)
{
    try {
        $conn =  connectDB();
        $id_session = $_SESSION['id'];
        $sql = $conn->prepare("INSERT INTO chatting (id_chat,cvid,id_user,id_session) VALUES (?,?,?,?)");
        $sql->bindParam(1, $id_chat);
        $sql->bindParam(2, $cvid);
        $sql->bindParam(3, $id_user);
        $sql->bindParam(4, $id_session);

        if ($sql->execute() === true) {
            return $conn->lastInsertId('id');
        } else {
            return 0;
        }
    } catch (PDOException $e) {
        die('Erreur : ' . $e->getMessage());
    }
}


function show_active($page, $active)
{
    $active0 = '';
    $active1 = '';
    $active2 = '';
    $active3 = '';
    $active4 = '';

    if ($page == 'timeline') {
        $active0 = 'active';
    } elseif ($page == 'about') {
        $active1 = 'active';
    } elseif ($page == 'following') {
        $active2 = 'active';
    } elseif ($page == 'followers') {
        $active3 = 'active';
    } elseif ($page == 'photos') {
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

function show_active_left($page, $active)
{
    $active0 = '';
    $active1 = '';
    $active2 = '';
    $active3 = '';
    $active4 = '';
    $active5 = '';
    $active_text = 'active-navi active';

    if ($page == 'home') {
        $active0 = $active_text;
    } elseif ($page == 'messages') {
        $active1 = $active_text;
    } elseif ($page == 'saved') {
        $active2 = $active_text;
    } elseif ($page == 'photos') {
        $active3 = $active_text;
    } elseif ($page == 'recommended') {
        $active4 = $active_text;
    } elseif ($page == 'support') {
        $active5 = $active_text;
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
    } elseif ($active == 'active5') {
        return $active5;
    }
}

function search_friends($key, $limit = '6')
{
    $id = $_SESSION['id'];
    $db = connectDB();
    $query = "SELECT * FROM `friends` INNER JOIN users on users.id = friends.id_recipient WHERE firstname LIKE '$key%' or lastname LIKE '$key%' or username LIKE '$key%' AND id_sender = '.$id.' LIMIT ".$limit."";
    $sql = $db->prepare($query);
    $sql->execute();
    $data = $sql->fetchAll();
    return $data;
}

function search_data($key, $limit = '6')
{
    $id = $_SESSION['id'];
    $db = connectDB();
    $query = "SELECT * FROM users WHERE firstname LIKE '$key%' or lastname LIKE '$key%' or username LIKE '$key%' LIMIT ".$limit."";
    $sql = $db->prepare($query);

    $sql->execute();
    $data = $sql->fetchAll();

    return $data;
}

function isCurrency($number)
{
    return preg_match("/^\d+(?:\.\d{2})?$/", $number);
}

function send_mail($email, $email_noreply, $site_name, $title, $firstname, $title_desc, $desc, $main_desc, $main_button_url, $main_button_text, $email_contact, $site_name_and_year, $template_include, $site_url)
{
    $mail = new PHPMailer();

    $site_logo = $site_url.'admin/'.general_settings('site_logo');

    $mail->From = $email_noreply;

    $mail->FromName = $site_name;

    $mail->Subject = $site_name.' '.$title;

    $body = file_get_contents('../assets/'.$template_include);
    
    $body = str_replace('{site_logo}', $site_logo, $body);

    $body = str_replace('{title}', $title, $body);

    $body = str_replace('{firstname}', $firstname, $body);

    $body = str_replace('{title_desc}', $title_desc, $body);

    $body = str_replace('{desc}', $desc, $body);

    $body = str_replace('{main_desc}', $main_desc, $body);

    $body = str_replace('{main_button_url}', $main_button_url, $body);

    $body = str_replace('{main_button_text}', $main_button_text, $body);

    $body = str_replace('{email_contact}', $email_contact, $body);

    $body = str_replace('{site_name_and_year}', $site_name_and_year, $body);

    $body = str_replace('{site_url}', $site_url, $body);

    $mail->MsgHTML($body);

    $mail->AltBody = $firstname.','.$title;

    $mail->AddAddress($email, $firstname);

    $mail->CharSet = 'UTF-8';

    $mail->send();
}

function update_url($url)
{
    $conn = connectDB();
    $sql = $conn->prepare('UPDATE general_settings SET site_url = ?');
    $sql->bindParam(1, $url);
    if ($sql->execute() === true) {
        return 1;
    } else {
        return 0;
    }
}

function signup_adm($fullname, $email, $password)
{
    try {
        $conn = connectDB();

        $sql = $conn->prepare('INSERT INTO admin (fullname, email, password) VALUES (? ,? ,?)');

        $sql->bindParam(1, $fullname);

        $sql->bindParam(2, $email);

        $sql->bindParam(3, $password);

        if ($sql->execute() === true) {
            return $conn->lastInsertId('id');
        } else {
            return 0;
        }
    } catch (PDOException $e) {

        //return "Error: " . $e‐>getMessage();

        die('Erreur : '.$e->getMessage());
    }
}

function update_sql_arg($table, $row, $rowdata, $rowhere, $wheredata)
{
    $conn = connectDB();
    $sql = $conn->prepare("UPDATE $table SET $row = ? WHERE ($rowhere = ?)");
    $sql->bindParam(1, $rowdata);
    $sql->bindParam(2, $wheredata);
    if ($sql->execute() === true) {
        return 1;
    } else {
        return 0;
    }
}

function update_sqldouble_arg($table, $row, $rowdata, $rowhere, $rowhere2, $wheredata, $wheredata2)
{
    $conn = connectDB();
    $sql = $conn->prepare("UPDATE $table SET $row = ? WHERE ($rowhere = ? AND $rowhere2 = ?)");
    $sql->bindParam(1, $rowdata);
    $sql->bindParam(2, $wheredata);
    $sql->bindParam(3, $wheredata2);
    if ($sql->execute() === true) {
        return 1;
    } else {
        return 0;
    }
}

function update_sql($table, $row, $rowdata)
{
    $conn = connectDB();
    $sql = $conn->prepare("UPDATE $table SET $row = ?");
    $sql->bindParam(1, $rowdata);
    if ($sql->execute() === true) {
        return 1;
    } else {
        return 0;
    }
}


function update_users($col, $data)
{
    $id = $_SESSION['id'];

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

function select_save_data($parameter, $limit = '0')
{
    $db = connectDB();
    $id = $_SESSION['id'];
    $query = "SELECT DISTINCT save FROM saved WHERE id_user = '$id' AND parameter = '$parameter' order by id desc limit ".$limit;
    $sql = $db->prepare($query);

    $sql->execute();
    $data = $sql->fetchAll();
    return $data;
}

function select_save_count($parameter, $limit = '0')
{
    $db = connectDB();
    $id = $_SESSION['id'];
    $query = "SELECT DISTINCT save FROM saved WHERE id_user = '$id' AND parameter = '$parameter' order by id desc limit ".$limit;
    $sql = $db->prepare($query);

    $sql->execute();
    $data = $sql->rowCount();
    return $data;
}

function select_save_user($parameter, $limit = '0')
{
    $db = connectDB();
    $id = $_SESSION['id'];
    $query = "SELECT DISTINCT save,created_at FROM saved WHERE id_user = '$id' AND parameter = '$parameter' order by created_at desc limit ".$limit;
    $sql = $db->prepare($query);

    $sql->execute();
    $data = $sql->fetchAll();
    return $data;
}

function save($key, $parameter)
{
    $id_user = $_SESSION['id'];
    $created_at = time();
    try {
        $conn =  connectDB();

        $sql = $conn->prepare("INSERT INTO saved(id_user,parameter,save,created_at) VALUES (?,?,?,?)");
        $sql->bindParam(1, $id_user);
        $sql->bindParam(2, $parameter);
        $sql->bindParam(3, $key);
        $sql->bindParam(4, $created_at);

        if ($sql->execute() === true) {
            return $conn->lastInsertId('id');
        } else {
            return 0;
        }
    } catch (PDOException $e) {
        die('Erreur : ' . $e->getMessage());
    }
}

function update_save($key)
{
    $db = connectDB();
    $created_at = time();
    $query = "UPDATE saved SET created_at = ? WHERE (save = ?)";
    $sql = $db->prepare($query);
    $sql->bindParam(1, $created_at);
    $sql->bindParam(2, $key);
    if ($sql->execute() === true) {
        return 1;
    } else {
        return 0;
    }
}

function create_conversation($user_one, $user_two)
{
    $dates = date('Y-m-d H:i:s');
    try {
        $conn =  connectDB();

        $sql = $conn->prepare("INSERT INTO conversation(user_one,user_two,dates_cv) VALUES (?,?,?)");
        $sql->bindParam(1, $user_one);
        $sql->bindParam(2, $user_two);
        $sql->bindParam(3, $dates);

        if ($sql->execute() === true) {
            return $conn->lastInsertId('cid');
        } else {
            return 0;
        }
    } catch (PDOException $e) {
        die('Erreur : ' . $e->getMessage());
    }
}

function notif_count($badge = false, $all = 'AND unread = 1')
{
    $db = connectDB();
    $id = $_SESSION['id'];
    $query = 'SELECT COUNT(*) AS count FROM `notifications` WHERE recipient_id = '.$id.' '.$all.'';
    $sql = $db->prepare($query);
    $sql->execute();
    $count = $sql->fetch();
    $count = $count['count'];

    if ($badge) {
        if ($count != 0) {
            $count = '<span class="badge badgesx badgesx-default" id="notif_id">'.$count.'</span>';
        } else {
            $count = '';
        }
    }
    return $count;
}

function search_count($key, $varchar = false, $string = 'search result', $strings = 'search results')
{
    $db = connectDB();
    $id = $_SESSION['id'];
    $query = "SELECT COUNT(*) AS count FROM users WHERE firstname LIKE '$key%' or lastname LIKE '$key%' or username LIKE '$key%'";
    $sql = $db->prepare($query);
    $sql->execute();
    $count = $sql->fetch();
    $count = $count['count'];

    if ($varchar) {
        if ($count == 0) {
            $count = $count.' '.$string;
        } elseif ($count == 1) {
            $count = $count.' '.$string;
        } else {
            $count = $count.' '.$strings;
        }
    }
    return $count;
}

function save_count($parameter, $varchar = false, $string = 'save result', $strings = 'save results')
{
    $db = connectDB();
    $id = $_SESSION['id'];
    $query = "SELECT DISTINCT COUNT(save) AS count FROM saved WHERE id_user = '$id' AND parameter = '$parameter'";
    $sql = $db->prepare($query);
    $sql->execute();
    $count = $sql->fetch();
    $count = $count['count'];

    if ($varchar) {
        if ($count == 0) {
            $count = $count.' '.$string;
        } elseif ($count == 1) {
            $count = $count.' '.$string;
        } else {
            $count = $count.' '.$strings;
        }
    }
    return $count;
}


function notif_friend_parameters($parameters, $follow, $post, $like, $comment, $share)
{
    $notif_friend_parameters = '';
    if ($parameters == 'follow') {
        $notif_friend_parameters = $follow;
    } elseif ($parameters == 'post') {
        $notif_friend_parameters = $post;
    } elseif ($parameters == 'like') {
        $notif_friend_parameters = $like;
    } elseif ($parameters == 'comment') {
        $notif_friend_parameters = $comment;
    } elseif ($parameters == 'share') {
        $notif_friend_parameters = $share;
    }

    return $notif_friend_parameters;
}

function notif_post_parameters($parameters, $like, $comment, $share, $tag)
{
    $notif_post_parameters = '';
    if ($parameters == 'like') {
        $notif_post_parameters = $like;
    } elseif ($parameters == 'comment') {
        $notif_post_parameters = $comment;
    } elseif ($parameters == 'share') {
        $notif_post_parameters = $share;
    } elseif ($parameters == 'tag') {
        $notif_post_parameters = $tag;
    }

    return $notif_post_parameters;
}

function show_modal($img)
{
    if ($img == 'assets/img/avatar_female.jpg' || $img == 'assets/img/avatar_female.jpg'  || $img == 'assets/img/default_cover.jpg' || $img == 'assets/img/avatar_male.jpg') {
        $modal = '';
    } else {
        $modal = 'modal';
    }

    return $modal;
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

function get_timeago_short($ptime)
{
    $estimate_time = time() - $ptime;

    if ($estimate_time < 1) {
        return '1 sec';
    }

    $condition = array(

        12 * 30 * 24 * 60 * 60 => 'year',

        30 * 24 * 60 * 60 => 'month',

        24 * 60 * 60 => 'day',

        60 * 60 => 'hour',

        60 => 'min',

        1 => 'sec',

    );

    foreach ($condition as $secs => $str) {
        $d = $estimate_time / $secs;

        if ($d >= 1) {
            $r = round($d);

            return $r.' '.$str.($r > 1 ? 's' : '');
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


function rand_string($length)
{
    $length += 3;
    $chars = "0123456789";
    $str= "";
    $size = strlen($chars);
    for ($i = 0; $i < $length; $i++) {
        if ($i == 5 || $i == 11 || $i == 17) {
            $str .= '';
        } else {
            $str .= $chars[ rand(0, $size - 1) ];
        }
    }

    return $str;
}

function crypt_data($string, $action = 'e')
{
    $secret_key = "dtorei dto etpartu wrey ermwatyaq rqy"; // 32bits

    $secret_iv = md5('sA*(DH');
    $secret_iv = md5($secret_iv);

 

    $output = false;

    $encrypt_method = "AES-256-CBC";

    $key = hash('sha256', $secret_key);

    $iv = substr(hash('sha256', $secret_iv), 0, 16);

 

    if ($action == 'e') {
        $output = base64_encode(openssl_encrypt($string, $encrypt_method, $key, 0, $iv));
    } elseif ($action == 'd') {
        $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
    }

    return $output;
}

function show_username($username)
{
    $username = '@'.$username;
    return $username;
}
  
 function social_time_ago($timestamp)
 {
     $time_ago = strtotime($timestamp);
     $current_time = time();
     $time_difference = $current_time - $time_ago;
     $seconds = $time_difference;
     $minutes      = round($seconds / 60);           // value 60 is seconds
      $hours           = round($seconds / 3600);           //value 3600 is 60 minutes * 60 sec
      $days          = round($seconds / 86400);          //86400 = 24 * 60 * 60;
      $weeks          = round($seconds / 604800);          // 7*24*60*60;
      $months          = round($seconds / 2629440);     //((365+365+365+365+366)/5/12)*24*60*60
      $years          = round($seconds / 31553280);     //(365+365+365+365+366)/5 * 24 * 60 * 60
      if ($seconds <= 60) {
          return "Just Now";
      } elseif ($minutes <=60) {
          if ($minutes==1) {
              return "one minute ago";
          } else {
              return "$minutes minutes ago";
          }
      } elseif ($hours <=24) {
          if ($hours==1) {
              return "an hour ago";
          } else {
              return "$hours hrs ago";
          }
      } elseif ($days <= 7) {
          if ($days==1) {
              return "yesterday";
          } else {
              return "$days days ago";
          }
      } elseif ($weeks <= 4.3) { //4.3 == 52/12
          if ($weeks==1) {
              return "a week ago";
          } else {
              return "$weeks weeks ago";
          }
      } elseif ($months <=12) {
          if ($months==1) {
              return "a month ago";
          } else {
              return "$months months ago";
          }
      } else {
          if ($years==1) {
              return "one year ago";
          } else {
              return "$years years ago";
          }
      }
 }

function InsertNotifications($recipient_id, $sender_id, $type, $parameters, $reference_id)
{
    try {
        if ($sender_id != $recipient_id) {
            $conn =  connectDB();
            $time = time();
            $unread = '1';
            $created_at = date("Y-m-d h:i:sa");
            $sql = $conn->prepare("INSERT INTO notifications(recipient_id,sender_id,unread,type,parameters,reference_id,created_at,time_notif) VALUES (?,?,?,?,?,?,?,?)");
            $sql->bindParam(1, $recipient_id);
            $sql->bindParam(2, $sender_id);
            $sql->bindParam(3, $unread);
            $sql->bindParam(4, $type);
            $sql->bindParam(5, $parameters);
            $sql->bindParam(6, $reference_id);
            $sql->bindParam(7, $created_at);
            $sql->bindParam(8, $time);

            if ($sql->execute() === true) {
                return $conn->lastInsertId('id');
            } else {
                return 0;
            }
        }
    } catch (PDOException $e) {
        die('Erreur : ' . $e->getMessage());
    }
}

function ShowTrends($nbr)
{
    $db = connectDB();
    $id = $_SESSION['id'];
    $query = 'SELECT *, count(hashtag) as cnt from posts INNER JOIN users ON  users.id= posts.id_user WHERE `hashtag` != "" group by hashtag order by pid DESC LIMIT '.$nbr.'';
    $sql = $db->prepare($query);
    $sql->execute();
    $data = $sql->fetchAll();
    return $data;
}

function post_count($style = false, $nbr, $page='home')
{
    $db = connectDB();
    $id = $_SESSION['id'];
    $query = 'SELECT DISTINCT `pid`, `id_user`, `texts`, `hashtag`, `image_url`, `image_url_thumb`, `video`, `video_thumb`, `video_url`, `video_url_thumb`, `video_url_type`, `video_url_desc`, `video_url_title`, `video_url_class`, `link_url`, `link_title_url`, `link_img_url`, `link_desc_url`, `date_post`, `time_post`, `likes`, `share`, `location`, `user_share`, `pid_share`, `avatar_status`, `cover_status`, `privacy`, `adult_content_score` FROM posts WHERE id_user = '.$id.' UNION SELECT DISTINCT `pid`, `id_user`, `texts`, `hashtag`, `image_url`, `image_url_thumb`, `video`, `video_thumb`, `video_url`, `video_url_thumb`, `video_url_type`, `video_url_desc`, `video_url_title`, `video_url_class`, `link_url`, `link_title_url`, `link_img_url`, `link_desc_url`, `date_post`, `time_post`, `likes`, `share`, `location`, `user_share`, `pid_share`, `avatar_status`, `cover_status`, `privacy` , `adult_content_score` FROM `posts` INNER JOIN friends on friends.id_recipient = posts.id_user WHERE id_sender = '.$id.' order by pid desc limit '.$nbr.'';
    $sql = $db->prepare($query);
    $sql->execute();
    $count = $sql->rowCount();
    if ($count == 0 || $page == 'timeline') {
        $query = 'SELECT * FROM posts WHERE id_user = "$id" order by pid desc limit "$nbr"';
        $sql = $db->prepare($query);
        $sql->execute();
        $count = $sql->rowCount();
    }
    if ($style) {
        if ($count <= 4) {
            $style = 'style = "display: none;"';
        }
        return $style;
    } else {
        return $count;
    }
}

function ShowActivity($nbr)
{
    $db = connectDB();
    $id = $_SESSION['id'];
    $query = 'SELECT DISTINCT `pid`, `id_user`, `texts`, `hashtag`, `image_url`, `image_url_thumb`, `video`, `video_thumb`, `video_url`, `video_url_thumb`, `video_url_type`, `video_url_desc`, `video_url_title`, `video_url_class`, `link_url`, `link_title_url`, `link_img_url`, `link_desc_url`, `date_post`, `time_post`, `likes`, `share`, `location`, `user_share`, `pid_share`, `avatar_status`, `cover_status`, `privacy`, `adult_content_score` FROM posts WHERE id_user = '.$id.' UNION SELECT DISTINCT `pid`, `id_user`, `texts`, `hashtag`, `image_url`, `image_url_thumb`, `video`, `video_thumb`, `video_url`, `video_url_thumb`, `video_url_type`, `video_url_desc`, `video_url_title`, `video_url_class`, `link_url`, `link_title_url`, `link_img_url`, `link_desc_url`, `date_post`, `time_post`, `likes`, `share`, `location`, `user_share`, `pid_share`, `avatar_status`, `cover_status`, `privacy`, `adult_content_score` FROM `posts` INNER JOIN friends on friends.id_recipient = posts.id_user WHERE id_sender = '.$id.' order by pid desc limit '.$nbr.'';
    $sql = $db->prepare($query);
    $sql->execute();
    $data = $sql->fetchAll();
    return $data;
}

function show_timeline($nbr, $page, $id_user)
{
    $db = connectDB();
    $id = $_SESSION['id'];
    $query = 'SELECT DISTINCT `pid`, `id_user`, `texts`, `hashtag`, `image_url`, `image_url_thumb`, `video`, `video_thumb`, `video_url`, `video_url_thumb`, `video_url_type`, `video_url_desc`, `video_url_title`, `video_url_class`, `link_url`, `link_title_url`, `link_img_url`, `link_desc_url`, `date_post`, `time_post`, `likes`, `share`, `location`, `user_share`, `pid_share`, `avatar_status`, `cover_status`, `privacy`, `adult_content_score` FROM posts WHERE id_user = '.$id.' UNION SELECT DISTINCT `pid`, `id_user`, `texts`, `hashtag`, `image_url`, `image_url_thumb`, `video`, `video_thumb`, `video_url`, `video_url_thumb`, `video_url_type`, `video_url_desc`, `video_url_title`, `video_url_class`, `link_url`, `link_title_url`, `link_img_url`, `link_desc_url`, `date_post`, `time_post`, `likes`, `share`, `location`, `user_share`, `pid_share`, `avatar_status`, `cover_status`, `privacy`, `adult_content_score` FROM `posts` INNER JOIN friends on friends.id_recipient = posts.id_user WHERE id_sender = '.$id.' order by pid desc limit '.$nbr.'';
    $sql = $db->prepare($query);
    $sql->execute();
    $data = $sql->fetchAll();
    $count = $sql->rowCount();

    if ($count == 0 || $page == 'timeline') {
        $query = 'SELECT * FROM posts WHERE id_user = '.$id_user.' order by pid desc limit '.$nbr.'';
        $sql = $db->prepare($query);

        $sql->execute();
        $data = $sql->fetchAll();
    }
    return $data;
}

function show_timeline_loadmore($pid, $nbr, $page, $id_user)
{
    $db = connectDB();
    $id = $_SESSION['id'];
    $query = 'SELECT DISTINCT `pid`, `id_user`, `texts`, `hashtag`, `image_url`, `image_url_thumb`, `video`, `video_thumb`, `video_url`, `video_url_thumb`, `video_url_type`, `video_url_desc`, `video_url_title`, `video_url_class`, `link_url`, `link_title_url`, `link_img_url`, `link_desc_url`, `date_post`, `time_post`, `likes`, `share`, `location`, `user_share`, `pid_share`, `avatar_status`, `cover_status`, `privacy`, `adult_content_score` FROM posts WHERE id_user = '.$id.' AND `pid` < '.$pid.' UNION SELECT DISTINCT `pid`, `id_user`, `texts`, `hashtag`, `image_url`, `image_url_thumb`, `video`, `video_thumb`, `video_url`, `video_url_thumb`, `video_url_type`, `video_url_desc`, `video_url_title`, `video_url_class`, `link_url`, `link_title_url`, `link_img_url`, `link_desc_url`, `date_post`, `time_post`, `likes`, `share`, `location`, `user_share`, `pid_share`, `avatar_status`, `cover_status`, `privacy`, `adult_content_score` FROM `posts` INNER JOIN friends on friends.id_recipient = posts.id_user WHERE id_sender = '.$id.' AND `pid` < '.$pid.' order by pid desc limit '.$nbr.'';
    $sql = $db->prepare($query);

    $sql->execute();
    $data = $sql->fetchAll();
    $count = $sql->rowCount();

    if ($count == 0 || $page == 'timeline') {
        $query = 'SELECT * FROM posts WHERE id_user = '.$id_user.' AND `pid` < '.$pid.'  order by pid desc limit '.$nbr.'';
        $sql = $db->prepare($query);

        $sql->execute();
        $data = $sql->fetchAll();
    }
    return $data;
}

function select_save_data_loadmore($parameter, $id_order, $limit = '0')
{
    $db = connectDB();
    $id = $_SESSION['id'];
    $query = "SELECT DISTINCT save FROM saved WHERE id_user = '$id' AND parameter = '$parameter' AND `id` < '$id_order' order by id desc limit  ".$limit;
    $sql = $db->prepare($query);

    $sql->execute();
    $data = $sql->fetchAll();
    return $data;
}

function show_comment($pid)
{
    $db = connectDB();

    $query = "SELECT * FROM comments WHERE cpid = '$pid' order by cid desc";

    $sql = $db->prepare($query);

    $sql->execute();
    $data = $sql->fetchAll();

    return $data;
}

function count_comment($pid)
{
    $db = connectDB();

    $query = "SELECT * FROM comments WHERE cpid = '$pid' order by cid desc";

    $sql = $db->prepare($query);

    $sql->execute();
    $count = $sql->rowCount();

    return $count;
}


function show_count($comment_count)
{
    if ($comment_count == '0') {
        $comment_count = '';
    }
    return $comment_count;
}

function addLinks($text)
{
    return preg_replace('@(http)?(s)?(://)?(([a-zA-Z])([-\w]+\.)+([^\s\.]+[^\s]*)+[^,.\s])@', 'http$2://$4', $text);
}

function formatUrlsInText($text)
{
    // URL starting www.
    $reg_exUrl = "/(^|\A|\s)((www\.)[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,4}(\/\S*)?)/";
    if (preg_match($reg_exUrl, $text, $url)) {

   // make the urls hyper links
        //$text=preg_replace( $reg_exUrl, "$1<a href=\"http://$2\">$2</a>", $text );
        $text=preg_replace($reg_exUrl, " http://$2 ", $text);
    }
    return $text;
}

function getemail($text)
{
    $pattern = '#([0-9a-z]([-_.]?[0-9a-z])*@[0-9a-z]([-.]?[0-9a-z])*\\.';
    $pattern .= '[a-wyz][a-z](fo|g|l|m|mes|o|op|pa|ro|seum|t|u|v|z)?)#i';
    preg_match_all($pattern, $text, $matchedEmails);
    $email = '';
    if (!empty($matchedEmails[0])) {
        foreach ($matchedEmails[0] as $match) {
            $email .=  $match.' ';
        }
    }
    //to remove last comma in a string
    return rtrim($email, ',');
}

function convert_links($message)
{
    //$message = html_entity_decode($message, ENT_QUOTES, 'UTF-8');
    $site_url = general_settings('site_url');
    if (trim(getemail($message)) == '') {
        //Convert all urls to links
        //$message = addLinks($message);
        $message = formatUrlsInText($message);
        $message = preg_replace('#([\s|^])(www)#i', '$1http://$2', $message);
        $pattern = '#((http|https|ftp|telnet|news|gopher|file|wais):\/\/[^\s]+)#i';
        $replacement = '<a href="$1" target="_blank">$1</a>';
        $message = preg_replace($pattern, $replacement, $message);
    } else {
        $message = formatUrlsInText($message);
        $message = preg_replace('#([\s|^])(www)#i', '$1http://$2', $message);
        $pattern = '#((http|https|ftp|telnet|news|gopher|file|wais):\/\/[^\s]+)#i';
        $replacement = '<a href="$1" target="_blank">$1</a>';
        $message = preg_replace($pattern, $replacement, $message);
    }

    /* Convert all E-mail matches to appropriate HTML links */
    $pattern = '#([0-9a-z]([-_.]?[0-9a-z])*@[0-9a-z]([-.]?[0-9a-z])*\\.';
    $pattern .= '[a-wyz][a-z](fo|g|l|m|mes|o|op|pa|ro|seum|t|u|v|z)?)#i';
    $replacement = '<a href="mailto:\\1">\\1</a>';
    $message = preg_replace($pattern, $replacement, $message);

    $pattern = '/(?<=^|(?<=[^a-zA-Z0-9-_\.]))#([A-Za-z]+[A-Za-z0-9]+)/i';
    $message = preg_replace($pattern, "<a href=\"".$site_url."hashtags/$1\">#$1</a>", $message);

    $pattern = '/(?<=^|(?<=[^a-zA-Z0-9-_\.])){@}([A-Za-z]+[A-Za-z0-9]+)/i';
    $message = preg_replace($pattern, "<a href=\"".$site_url."$1\">@$1</a>", $message);

    $pattern = '/(?<=^|(?<=[^a-zA-Z0-9-_\.]))@([A-Za-z]+[A-Za-z0-9]+)/i';
    $message = preg_replace($pattern, "<a href=\"".$site_url."$1\">@$1</a>", $message);

    return $message;
}

function autolinke($message)
{
    //Convert all urls to links
    $message = preg_replace('#([\s|^])(www)#i', '$1http://$2', $message);
    $pattern = '#((http|https|ftp|telnet|news|gopher|file|wais):\/\/[^\s]+)#i';
    $replacement = '<a href="$1" target="_blank">$1</a>';
    $message = preg_replace($pattern, $replacement, $message);

    /* Convert all E-mail matches to appropriate HTML links */
    $pattern = '#([0-9a-z]([-_.]?[0-9a-z])*@[0-9a-z]([-.]?[0-9a-z])*\\.';
    $pattern .= '[a-wyz][a-z](fo|g|l|m|mes|o|op|pa|ro|seum|t|u|v|z)?)#i';
    $replacement = '<a href="mailto:\\1">\\1</a>';
    $message = preg_replace($pattern, $replacement, $message);
    return $message;
}


function gethashtags($text)
{
    //Match the hashtags
    preg_match_all('/(^|[^a-z0-9_])#([a-z0-9_]+)/i', $text, $matchedHashtags);
    $hashtag = '';
    // For each hashtag, strip all characters but alpha numeric
    if (!empty($matchedHashtags[0])) {
        foreach ($matchedHashtags[0] as $match) {
            $hashtag .= preg_replace("/[^a-z0-9]+/i", "", $match).',';
        }
    }
    //to remove last comma in a string
    return rtrim($hashtag, ',');
}

function insert_user_share($share_id, $user_id, $share_post_owner, $date_send, $date_receive, $date_seen, $date_notif, $dates)
{
    try {
        $conn =  connectDB();

        $sql = $conn->prepare("INSERT INTO user_share (share_id,user_id,share_post_owner,date_send,date_receive,date_seen, date_notif, dates) VALUES (?,?,?,?,?,?,?,?)");
        $sql->bindParam(1, $share_id);
        $sql->bindParam(2, $user_id);
        $sql->bindParam(3, $share_post_owner);
        $sql->bindParam(4, $date_send);
        $sql->bindParam(5, $date_receive);
        $sql->bindParam(6, $date_seen);
        $sql->bindParam(7, $date_notif);
        $sql->bindParam(8, $dates);

        if ($sql->execute() === true) {
            return $conn->lastInsertId('id');
        } else {
            return 0;
        }
    } catch (PDOException $e) {
        die('Erreur : ' . $e->getMessage());
    }
}

function insert_position($id, $px, $py)
{
    try {
        $conn =  connectDB();

        $sql = $conn->prepare("INSERT INTO cover_position (id_user,position_x,position_y) VALUES (?,?,?)");
        $sql->bindParam(1, $id);
        $sql->bindParam(2, $px);
        $sql->bindParam(3, $py);

        if ($sql->execute() === true) {
            return 1;
        } else {
            return 0;
        }
    } catch (PDOException $e) {
        die('Erreur : ' . $e->getMessage());
    }
}

function insert_email_notif($id)
{
    try {
        $conn =  connectDB();
        $p = '1';
        $sql = $conn->prepare("INSERT INTO email_notifications (id_user,follows,comments,likes,shares,messages) VALUES (?,?,?,?,?,?)");
        $sql->bindParam(1, $id);
        $sql->bindParam(2, $p);
        $sql->bindParam(3, $p);
        $sql->bindParam(4, $p);
        $sql->bindParam(5, $p);
        $sql->bindParam(6, $p);

        if ($sql->execute() === true) {
            return 1;
        } else {
            return 0;
        }
    } catch (PDOException $e) {
        die('Erreur : ' . $e->getMessage());
    }
}


function insert_comment($comment, $img, $cpid, $times, $id_user_com, $id_post_owner, $date_send, $date_receive, $date_seen, $adult_content_score)
{
    try {
        $conn =  connectDB();

        $sql = $conn->prepare("INSERT INTO comments (comment, img, cpid, times_com, id_user_com, id_post_owner, date_send, date_receive, date_seen,adult_content_score) VALUES (?,?,?,?,?,?,?,?,?,?)");
        $sql->bindParam(1, $comment);
        $sql->bindParam(2, $img);
        $sql->bindParam(3, $cpid);
        $sql->bindParam(4, $times);
        $sql->bindParam(5, $id_user_com);
        $sql->bindParam(6, $id_post_owner);
        $sql->bindParam(7, $date_send);
        $sql->bindParam(8, $date_receive);
        $sql->bindParam(9, $date_seen);
        $sql->bindParam(10, $adult_content_score);

        if ($sql->execute() === true) {
            return $conn->lastInsertId('cid');
        } else {
            return 0;
        }
    } catch (PDOException $e) {
        die('Erreur : ' . $e->getMessage());
    }
}

function getConnected($time_online)
{
    $time_out = time()-5;
    if ($time_online > $time_out) {
        $online = "Online";
    } else {
        $online = "Active ".get_timeago($time_online);
    }
    if ($time_online == '') {
        $online = "Not connected";
    }
    return $online;
}

function insert_user_likes($like_id, $user_id, $like_post, $date_send, $date_receive, $date_seen, $date_notif, $dates)
{
    try {
        $conn =  connectDB();

        $sql = $conn->prepare("INSERT INTO user_likes (like_id,user_id,like_post_owner,date_send,date_receive,date_seen,date_notif,dates) VALUES (?,?,?,?,?,?,?,?)");
        $sql->bindParam(1, $like_id);
        $sql->bindParam(2, $user_id);
        $sql->bindParam(3, $like_post);
        $sql->bindParam(4, $date_send);
        $sql->bindParam(5, $date_receive);
        $sql->bindParam(6, $date_seen);
        $sql->bindParam(7, $date_notif);
        $sql->bindParam(8, $dates);

        if ($sql->execute() === true) {
            return $conn->lastInsertId('id');
        } else {
            return 0;
        }
    } catch (PDOException $e) {
        die('Erreur : ' . $e->getMessage());
    }
}


function insert_post($id_user, $texts, $hashtag, $image_url, $image_url_thumb, $video, $video_thumb, $video_url, $video_url_thumb, $video_url_type, $video_url_desc, $video_url_title, $video_url_class, $link_url, $link_title_url, $link_img_url, $link_desc_url, $date_post, $time_post, $likes, $share, $location, $user_share, $pid_share, $avatar_status, $cover_status, $privacy, $adult_content_score)
{
    try {
        $conn =  connectDB();

        $sql = $conn->prepare("INSERT INTO posts (id_user, texts, hashtag, image_url, image_url_thumb, video, video_thumb, video_url, video_url_thumb, video_url_type, video_url_desc, video_url_title, video_url_class, link_url, link_title_url, link_img_url, link_desc_url, date_post, time_post, likes, share, location, user_share, pid_share,avatar_status,cover_status,privacy,adult_content_score ) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
        $sql->bindParam(1, $id_user);
        $sql->bindParam(2, $texts);
        $sql->bindParam(3, $hashtag);
        $sql->bindParam(4, $image_url);
        $sql->bindParam(5, $image_url_thumb);
        $sql->bindParam(6, $video);
        $sql->bindParam(7, $video_thumb);
        $sql->bindParam(8, $video_url);
        $sql->bindParam(9, $video_url_thumb);
        $sql->bindParam(10, $video_url_type);
        $sql->bindParam(11, $video_url_desc);
        $sql->bindParam(12, $video_url_title);
        $sql->bindParam(13, $video_url_class);
        $sql->bindParam(14, $link_url);
        $sql->bindParam(15, $link_title_url);
        $sql->bindParam(16, $link_img_url);
        $sql->bindParam(17, $link_desc_url);
        $sql->bindParam(18, $date_post);
        $sql->bindParam(19, $time_post);
        $sql->bindParam(20, $likes);
        $sql->bindParam(21, $share);
        $sql->bindParam(22, $location);
        $sql->bindParam(23, $user_share);
        $sql->bindParam(24, $pid_share);
        $sql->bindParam(25, $avatar_status);
        $sql->bindParam(26, $cover_status);
        $sql->bindParam(27, $privacy);
        $sql->bindParam(28, $adult_content_score);

        if ($sql->execute() === true) {
            return $conn->lastInsertId('pid');
        } else {
            return 0;
        }
    } catch (PDOException $e) {
        die('Error : ' . $e->getMessage());
    }
}


function signup($firstname, $lastname, $email, $phone, $sex, $birthday, $city, $adresse, $country, $password, $code, $avatar, $avatar_thumb, $cover, $cover_thumb, $active, $username, $verified, $about, $language, $date_signin, $level, $last_time_session, $privacy)
{
    try {
        $conn =  connectDB();

        $sql = $conn->prepare("INSERT INTO users (firstname, lastname, email, phone, sex, birthday, city, address, country, password, code,avatar,avatar_thumb,cover,cover_thumb,active,username,verified,about,language,date_signin,level,last_time_session,privacy) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
        $sql->bindParam(1, $firstname);
        $sql->bindParam(2, $lastname);
        $sql->bindParam(3, $email);
        $sql->bindParam(4, $phone);
        $sql->bindParam(5, $sex);
        $sql->bindParam(6, $birthday);
        $sql->bindParam(7, $city);
        $sql->bindParam(8, $adresse);
        $sql->bindParam(9, $country);
        $sql->bindParam(10, $password);
        $sql->bindParam(11, $code);
        $sql->bindParam(12, $avatar);
        $sql->bindParam(13, $avatar_thumb);
        $sql->bindParam(14, $cover);
        $sql->bindParam(15, $cover_thumb);
        $sql->bindParam(16, $active);
        $sql->bindParam(17, $username);
        $sql->bindParam(18, $verified);
        $sql->bindParam(19, $about);
        $sql->bindParam(20, $language);
        $sql->bindParam(21, $date_signin);
        $sql->bindParam(22, $level);
        $sql->bindParam(23, $last_time_session);
        $sql->bindParam(24, $privacy);

        if ($sql->execute() === true) {
            return $conn->lastInsertId('id');
        } else {
            return 0;
        }
    } catch (PDOException $e) {
        die('Error : ' . $e->getMessage());
    }
}

function show_recommended($limit, $count = false)
{
    $db = connectDB();
    $id = returnID();
    $query = "SELECT * FROM `users` WHERE id != ".$id." ORDER BY RAND() DESC LIMIT ".$limit."";
    $sql = $db->prepare($query);
    $sql->execute();
    $data = $sql->fetchAll();
    $count_data = $sql->rowCount();
    if ($count) {
        return $count_data;
    } else {
        return $data;
    }
}

function show_img_modal($id_user)
{
    $db = connectDB();
    $query = "SELECT * FROM posts WHERE id_user ='$id_user' AND image_url != ''";
    $sql = $db->prepare($query);
    $sql->execute();
    return $sql->fetchAll();
}


function email_session_infos()
{
    $db = connectDB();
    $email = $_SESSION['email'];
    $query = "SELECT * FROM users WHERE id ='$email'";
    $sql = $db->prepare($query);
    $sql->execute();
    return $sql->fetchAll();
}

function privacy($privacy, $p1, $p2, $p3)
{
    if ($privacy == 0) {
        $return = $p1;
    } elseif ($privacy == 1) {
        $return = $p2;
    } elseif ($privacy == 2) {
        $return = $p3;
    }
    return $return;
}

function id_session_infos()
{
    $db = connectDB();
    $id = $_SESSION['id'];
    $query = "SELECT * FROM users WHERE id ='$id'";
    $sql = $db->prepare($query);
    $sql->execute();
    return $sql->fetchAll();
}

function search_hashtag($hashtag, $limit)
{
    $db = connectDB();
    $id = $_SESSION['id'];
    $query = "SELECT * FROM `posts` INNER JOIN users ON  users.id = posts.id_user WHERE hashtag LIKE '%$hashtag%' AND id = $id ORDER BY `pid` DESC LIMIT $limit";
    $sql = $db->prepare($query);
    $sql->execute();
    return $sql->fetchAll();
}

function search_hashtag_loadmore($hashtag, $limit, $last_post_id)
{
    $db = connectDB();
    $id = $_SESSION['id'];
    $query = "SELECT * FROM `posts` INNER JOIN users ON  users.id = posts.id_user WHERE hashtag LIKE '%$hashtag%' AND id = $id AND pid < $last_post_id ORDER BY `pid` DESC LIMIT $limit";
    $sql = $db->prepare($query);
    $sql->execute();
    return $sql->fetchAll();
}

function verif_code($id)
{
    $db = connectDB();
    $query = "SELECT * FROM users WHERE id ='$id'";
    $sql = $db->prepare($query);
    $sql->execute();
    return $sql->fetchAll();
}

function deleteSQL($table, $row, $data)
{
    $db = connectDB();
    $query = "DELETE FROM $table WHERE `$row` = ?";
    $sql = $db->prepare($query);
    $sql->bindParam(1, $data);

    if ($sql->execute() === true) {
        return 1;
    } else {
        return 0;
    }
}

function deleteOnline($table, $row, $data)
{
    $db = connectDB();
    $query = "UPDATE $table SET absent = '1' WHERE `$row` < ?";
    $sql = $db->prepare($query);
    $sql->bindParam(1, $data);

    if ($sql->execute() === true) {
        return 1;
    } else {
        return 0;
    }
}

function delete_comment($cid)
{
    $db = connectDB();
    $query = "DELETE FROM comments WHERE `cid` = ?";
    $sql = $db->prepare($query);
    $sql->bindParam(1, $cid);

    if ($sql->execute() === true) {
        return 1;
    } else {
        return 0;
    }
}

function delete_msg_user_to($mid)
{
    $db = connectDB();
    $query = "UPDATE messages SET hide_user_to = 1 WHERE (mid = ? )";
    $sql = $db->prepare($query);
    $sql->bindParam(1, $mid);
    if ($sql->execute() === true) {
        return 1;
    } else {
        return 0;
    }
}

function delete_msg_user_from($mid)
{
    $db = connectDB();
    $query = "UPDATE messages SET hide_user_from = 1 WHERE (mid = ? )";
    $sql = $db->prepare($query);
    $sql->bindParam(1, $mid);
    if ($sql->execute() === true) {
        return 1;
    } else {
        return 0;
    }
}

function delete_post($pid)
{
    $db = connectDB();
    $query = "DELETE FROM posts WHERE `pid` = ?";
    $sql = $db->prepare($query);
    $sql->bindParam(1, $pid);

    if ($sql->execute() === true) {
        return 1;
    } else {
        return 0;
    }
}

function delete_user_likes($pid, $user_id)
{
    $db = connectDB();
    $query = "DELETE FROM user_likes where `like_id` = ? and `user_id` = ?";
    $sql = $db->prepare($query);
    $sql->bindParam(1, $pid);
    $sql->bindParam(2, $user_id);

    if ($sql->execute() === true) {
        return 1;
    } else {
        return 0;
    }
}

function unfollow_user($id_sender, $id_recipient)
{
    $db = connectDB();
    $query = "DELETE FROM friends where `id_sender` = ? and `id_recipient` = ?";
    $sql = $db->prepare($query);
    $sql->bindParam(1, $id_sender);
    $sql->bindParam(2, $id_recipient);

    if ($sql->execute() === true) {
        return 1;
    } else {
        return 0;
    }
}

function DeleteNotifications($id_sender, $id_recipient, $type, $parameters, $reference_id)
{
    $db = connectDB();
    $query = "DELETE FROM notifications where `sender_id` = ? and `recipient_id` = ? and `type` = ? and `parameters` = ? and `reference_id` = ?";
    $sql = $db->prepare($query);
    $sql->bindParam(1, $id_sender);
    $sql->bindParam(2, $id_recipient);
    $sql->bindParam(3, $type);
    $sql->bindParam(4, $parameters);
    $sql->bindParam(5, $reference_id);

    if ($sql->execute() === true) {
        return 1;
    } else {
        return 0;
    }
}

function add_share($pid)
{
    $conn = connectDB();

    $sql = $conn->prepare("UPDATE posts SET share = share+1 WHERE (pid = ? )");

    $sql->bindParam(1, $pid);

    if ($sql->execute() === true) {
        return 1;
    } else {
        return 0;
    }
}

function add_like($pid)
{
    $conn = connectDB();

    $sql = $conn->prepare("UPDATE posts SET likes = likes+1 WHERE (pid = ? )");

    $sql->bindParam(1, $pid);

    if ($sql->execute() === true) {
        return 1;
    } else {
        return 0;
    }
}

function substract_like($pid)
{
    $conn = connectDB();

    $sql = $conn->prepare("UPDATE posts SET likes = likes-1 WHERE (pid = ? )");

    $sql->bindParam(1, $pid);

    if ($sql->execute() === true) {
        return 1;
    } else {
        return 0;
    }
}

function returnBlurImg($avatar)
{
    if ($avatar == 'assets/img/avatar_male.jpg' || $avatar == 'assets/img/avatar_female.jpg') {
        $img = 'assets/img/default-avatar.png';
    } else {
        $img = $avatar;
    }

    return $img;
}

function ShowImageNotif($pid, $image_url)
{
    $site_url = general_settings('site_url');
    $block_adult_content = select_sqlarg('email_notifications', 'id_user', returnID(), 'block_adult_content');
    $nude_score = select_sqlarg('posts', 'pid', $pid, 'adult_content_score');
    if ($image_url != '') {
        if ($block_adult_content == '1' && $nude_score >= 40) {
            $image_url = "<div class='box box-widget box-share'>
                    <div class='box-body'>
                    <p class='desc-text'>Adult picture blocked
                    </p>
                    </div>
                   </div>";
        } else {
            $image_url = "<a href='#' class='modal_open' data-pid='".$pid."' data-toggle='modal' data-target='#modal-post' rel='".$image_url."'><img class='width-notif-img' src='".$site_url.$image_url."' alt='Photo'></a>";
        }
    } else {
        $image_url = '';
    }
    return $image_url;
}

function ShowImagePhotos($pid, $image_url)
{
    $block_adult_content = select_sqlarg('email_notifications', 'id_user', returnID(), 'block_adult_content');
    $nude_score = select_sqlarg('posts', 'pid', $pid, 'adult_content_score');
    $site_url = general_settings('site_url');
    if ($image_url != '') {
        if (preg_match('/gif/i', $image_url)) {
            $image_gif = $image_url;
            $image_url = "<p><img class='img-responsive show-in-modal img-url img-url-".$pid."' data-pid='".$pid."' src='".$site_url."includes/convertGifToJpeg.php?gif_name=../".$image_gif."' data-gif='".$site_url.$image_gif."' alt='Photo'></p>";
            $image_url .= '<script type="text/javascript"> 
            $(function() {
                $(".img-url-'.$pid.'").jqGifPreview(); 
            });
            </script>';
        } else {
            if ($block_adult_content == '1' && $nude_score >= 40) {
                $image_url = "<div class='box box-widget box-share'>
                    <div class='box-body'>
                    <p class='desc-text'>
                      <center class='dark-color'>You have enabled the restriction of adult content. This picture seems to be a nude picture. We blocked it.</center>
                    </p>
                    </div>
                   </div>";
            } else {
                $image_url = "<div class='image-p'><a href='#' class='modal_open' data-pid='".$pid."' data-toggle='modal' data-target='#modal-post' rel='".$image_url."'><img class='img-responsive show-in-modal img-url' src='".$site_url.$image_url."' alt='Post Photo'></a></div>";
            }
        }
    } else {
        $image_url = '';
    }
    return $image_url;
}

function ShowImage($pid, $image_url)
{
    $block_adult_content = select_sqlarg('email_notifications', 'id_user', returnID(), 'block_adult_content');
    $nude_score = select_sqlarg('posts', 'pid', $pid, 'adult_content_score');
    $site_url = general_settings('site_url');
    if ($image_url != '') {
        if (preg_match('/gif/i', $image_url)) {
            $image_gif = $image_url;
            $image_url = "<p><img class='img-responsive show-in-modal img-url img-url-".$pid."' data-pid='".$pid."' src='".$site_url."includes/convertGifToJpeg.php?gif_name=../".$image_gif."' data-gif='".$site_url.$image_gif."' alt='Photo'></p>";
            $image_url .= '<script type="text/javascript"> 
            $(function() {
                $(".img-url-'.$pid.'").jqGifPreview(); 
            });
            </script>';
        } else {
            if ($block_adult_content == '1' && $nude_score >= 40) {
                $image_url = "<div class='box box-widget box-share'>
                    <div class='box-body'>
                    <p class='desc-text'>
                      <center class='dark-color'>You have enabled the restriction of adult content. This picture seems to be a nude picture. We blocked it.</center>
                    </p>
                    </div>
                   </div>";
            } else {
                $image_url = "<p><a href='#' class='modal_open' data-pid='".$pid."' data-toggle='modal' data-target='#modal-post' rel='".$image_url."'><img class='img-responsive show-in-modal img-url' src='".$site_url.$image_url."' alt='Post Photo'></a></p>";
            }
        }
    } else {
        $image_url = '';
    }
    return $image_url;
}

function ShowImageComment($cid, $image_url)
{
    $site_url = general_settings('site_url');
    if ($image_url != '') {
        $image_url = "<a href='#' class='modal_open_com' data-cid='".$cid."' data-toggle='modal' data-target='#modal-comment' rel='".$image_url."'><img class='img-responsive show-in-modal img-url img-comment' src='".$site_url.$image_url."' alt='Photo'></a>";
    } else {
        $image_url = '';
    }
    return $image_url;
}

function ReturnPopupFirst($id_user, $pid, $val1, $val2)
{
    if ($id_user == $_SESSION['id']) {
        $function = '<li class="notification post-edit" id="post-edit-'.$pid.'"><span><div class="media"><div class="media-body"><p class="notification-desc"><strong><span class="fa fa-edit dark-color"></span> '.$val1.'</strong></p></div></div></span></li>';
    } else {
        $function = '<li class="notification post-hide" id="post-hide-'.$pid.'"><span><div class="media"><div class="media-body"><p class="notification-desc"><strong><span class="fa fa-times-circle dark-color"></span> '.$val2.'</strong></p></div></div></span></li>';
    }
    return $function;
}

function ReturnPopupSecond($id_user, $pid, $val1, $val2)
{
    if ($id_user == $_SESSION['id']) {
        $function = '<li class="notification post-delete" id="post-delete-'.$pid.'"><span><div class="media"><div class="media-body"><p class="notification-desc" ><strong><span class="fa fa-trash dark-color"></span> '.$val1.'</strong></p></div></div></span></li>';
    } else {
        $function = '<li class="notification post-report" id="post-report-'.$pid.'"><span><div class="media"><div class="media-body"><p class="notification-desc"><strong><span class="fa fa-flag dark-color"></span> '.$val2.'</strong></p></div></div></span></li>';
    }
    return $function;
}

function ReturnCommentPopFirst($id_user, $cid, $val1, $val2, $pid)
{
    if ($id_user == $_SESSION['id']) {
        $function = '<li class="notification comment-edit" id="comment-edit-'.$cid.'" pid='.$pid.'><span><div class="media"><div class="media-body"><p class="notification-desc"><strong><span class="fa fa-edit dark-color"></span> '.$val1.'</strong></p></div></div></span></li>';
    } else {
        $function = '<li class="notification comment-hide" id="comment-hide-'.$cid.'" pid='.$pid.'><span><div class="media"><div class="media-body"><p class="notification-desc"><strong><span class="fa fa-times-circle dark-color"></span> '.$val2.'</strong></p></div></div></span></li>';
    }
    return $function;
}

function ReturnCommentPopSecond($id_user, $cid, $val1, $val2, $pid)
{
    if ($id_user == $_SESSION['id']) {
        $function = '<li class="notification trash-comment" id="trash-'.$cid.'" pid='.$pid.'><span><div class="media"><div class="media-body"><p class="notification-desc" ><strong><span class="fa fa-trash dark-color"></span> '.$val1.'</strong></p></div></div></span></li>';
    } else {
        $function = '<li class="notification comment-report" id="comment-report-'.$cid.'" pid='.$pid.'><span><div class="media"><div class="media-body"><p class="notification-desc"><strong><span class="fa fa-flag dark-color"></span> '.$val2.'</strong></p></div></div></span></li>';
    }
    return $function;
}

function show_friends($id, $arg, $limit)
{
    $db = connectDB();
    if ($arg == 'following') {
        $query = 'SELECT * FROM `friends` INNER JOIN users on users.id = friends.id_recipient WHERE id_sender = '.$id.' ORDER BY date_send DESC LIMIT '.$limit.'';
    } elseif ($arg == 'followers') {
        $query = 'SELECT * FROM `friends` INNER JOIN users on users.id = friends.id_sender WHERE id_recipient = '.$id.' ORDER BY date_send DESC LIMIT '.$limit.'';
    } elseif ($arg == 'photos') {
        $query = 'SELECT * FROM `posts` INNER JOIN users on users.id = posts.id_user WHERE id_user = '.$id.' AND image_url != "" ORDER BY pid DESC LIMIT '.$limit.'';
    }


    $sql = $db->prepare($query);
    $sql->execute();
    $data = $sql->fetchAll();
    return $data;
}

function show_friends_loadmore($last_id, $id, $arg, $limit)
{
    $db = connectDB();
    if ($arg == 'following') {
        $query = 'SELECT * FROM `friends` INNER JOIN users on users.id = friends.id_recipient WHERE id_sender = '.$id.' AND `fid` < '.$last_id.' ORDER BY date_send DESC LIMIT '.$limit.'';
    } elseif ($arg == 'followers') {
        $query = 'SELECT * FROM `friends` INNER JOIN users on users.id = friends.id_sender WHERE id_recipient = '.$id.' AND `fid` < '.$last_id.' ORDER BY date_send DESC LIMIT '.$limit.'';
    } elseif ($arg == 'photos') {
        $query = 'SELECT * FROM `posts` INNER JOIN users on users.id = posts.id_user WHERE id_user = '.$id.' AND image_url != "" AND `pid` < '.$last_id.' ORDER BY pid DESC LIMIT '.$limit.'';
    }


    $sql = $db->prepare($query);
    $sql->execute();
    $data = $sql->fetchAll();
    return $data;
}

function count_friends($id, $arg, $style = false)
{
    $db = connectDB();
    if ($arg == 'following') {
        $query = 'SELECT COUNT(*) AS count FROM `friends` INNER JOIN users on users.id = friends.id_recipient WHERE id_sender = '.$id.'';
    } elseif ($arg == 'followers') {
        $query = 'SELECT COUNT(*) AS count FROM `friends` INNER JOIN users on users.id = friends.id_sender WHERE id_recipient = '.$id.'';
    } elseif ($arg == 'photos') {
        $query = 'SELECT COUNT(*) AS count FROM `posts` INNER JOIN users on users.id = posts.id_user WHERE id_user = '.$id.' AND image_url != ""';
    }


    $sql = $db->prepare($query);
    $sql->execute();
    $data = $sql->fetchAll();
    foreach ($data as $row) {
        $count = $row['count'];
    }

    if (isset($count)) {
        if ($style) {
            if ($arg == 'following' || $arg == 'followers') {
                if ($count == 0 || $count < 4) {
                    $style = 'style = "display: none;"';
                }
            } elseif ($arg == 'photos') {
                if ($count == 0 || $count < 10) {
                    $style = 'style = "display: none;"';
                }
            }
            return $style;
        } else {
            return $count;
        }
    }
}


function ShowNotifications($recipient_id, $limit)
{
    $db = connectDB();
    $id = $_SESSION['id'];
    $query = 'SELECT * FROM `notifications` WHERE recipient_id = '.$recipient_id.' ORDER BY created_at DESC, unread DESC LIMIT '.$limit.'';
    $sql = $db->prepare($query);
    $sql->execute();
    $data = $sql->fetchAll();
    return $data;
}


function messageForNotification($recipient_id, $limit, $type, $parmeter)
{
    $db = connectDB();
    $id = $_SESSION['id'];
    //$query = 'SELECT * FROM `notifications` WHERE recipient_id = '.$recipient_id.'';
    $query = 'SELECT *,COUNT(*) AS count FROM notifications WHERE recipient_id = '.$recipient_id.' GROUP BY `type`, `reference_id` ORDER BY created_at DESC, unread DESC LIMIT '.$limit.'';
    $sql = $db->prepare($query);
    $sql->execute();
    $realCount = $sql->rowCount();

    if ($realCount === 0) {
        return $realCount;
    }

    // when there are two
    if ($realCount === 2) {
        $row1 = $sql->fetch();
        $row2 = $sql->fetch();
        if ($row1['sender_id'] == $row2['sender_id']) {
            echo select_sql_id($row1['sender_id'], 'fullname');
        } else {
            echo select_sql_id($row1['sender_id'], 'fullname').' and '.select_sql_id($row2['sender_id'], 'fullname');
        }
    }
    // less than five
    elseif ($realCount < 5) {
    }
    // to many
    else {
    }
}

function update_post($pid, $desc)
{
    $id = $_SESSION['id'];

    $conn = connectDB();

    $sql = $conn->prepare("UPDATE posts SET texts = ? WHERE (pid = ? )");

    $sql->bindParam(1, $desc);

    $sql->bindParam(2, $pid);

    if ($sql->execute() === true) {
        return $desc;
    } else {
        return 0;
    }
}

function people_share($pid)
{
    $share = select_sqlarg('posts', 'pid', $pid, 'share');
    if ($share == 0) {
        $people = '';
    } else {
        $people = $share;
    }
    return $people;
}

function people_likes($pid)
{
    $likes = select_sqlarg('posts', 'pid', $pid, 'likes');
    if ($likes == 0) {
        $people = '';
    } else {
        $people = $likes;
    }
    return $people;
}


function like_color($pid)
{
    $id = $_SESSION['id'];
    $count = select_count('user_likes', 'like_id', $pid, 'user_id', $id);
    if ($count == 0) {
        $class = "reactions";
    } else {
        $class = "reactions_like";
    }
    return $class;
}

function share_color($pid)
{
    $id = $_SESSION['id'];
    $count = select_count('user_share', 'share_id', $pid, 'user_id', $id);
    if ($count == 0) {
        $class = "reactions";
    } else {
        $class = "reactions_like";
    }
    return $class;
}

function class_right($page)
{
    if ($page == 'home') {
        $class = 'class="col-md-4 hidden-xs hidden-sm" id="right-side" style="width:30%; margin-left: -5%"';
    } else {
        $class = 'class="col-md-3 hidden-xs hidden-sm"';
    }
    return $class;
}

function class_center($page)
{
    if ($page == 'home') {
        $class = 'class="col-md-11"';
    } else {
        $class = 'class="col-md-12"';
    }
    return $class;
}

function CheckAutoStatus($pid)
{
    $site_url = general_settings('site_url');
    $cover_status = select_sqlarg('posts', 'pid', $pid, 'cover_status');
    $avatar_status = select_sqlarg('posts', 'pid', $pid, 'avatar_status');
    $user_share = select_sqlarg('posts', 'pid', $pid, 'user_share');

    if ($avatar_status == '1') {
        $echo = 'updated his profile picture.';
    } elseif ($cover_status == '1') {
        $echo = 'updated his cover picture.';
    } elseif ($user_share != '') {
        $echo = 'has shared a <a href="'.$site_url.'post/'.$pid.'">post</a>.';
    } else {
        $echo = '';
    }
    return $echo;
}


function is_follow_you($id, $string)
{
    $isFollow = select_doublearg('friends', 'id_sender', $id, 'id_recipient', returnID(), 'date_send');
    if ($isFollow != '') {
        $return = '<div class="widget-header border-gray-bottom"><h3 class="widget-caption">'.$string.'</h3></div>';
        return $return;
    }
}

function is_follow_user($id)
{
    $isFollow = select_doublearg('friends', 'id_sender', returnID(), 'id_recipient', $id, 'date_send');
    if ($isFollow == '') {
        $return = '0';
    } else {
        $return = '1';
    }
    return $return;
}




 //**********Functions for upload and crop image******************//

function CropImg($src, $name, $fileType, $thumb_width, $thumb_height)
{
    $image = $src;
    $filename = $name;
    $width = imagesx($image);
    $height = imagesy($image);

    $original_aspect = $width / $height;
    $thumb_aspect = $thumb_width / $thumb_height;

    if ($original_aspect >= $thumb_aspect) {
        // If image is wider than thumbnail (in aspect ratio sense)
        $new_height = $thumb_height;
        $new_width = $width / ($height / $thumb_height);
    } else {
        // If the thumbnail is wider than the image
        $new_width = $thumb_width;
        $new_height = $height / ($width / $thumb_width);
    }

    $thumb = imagecreatetruecolor($thumb_width, $thumb_height);

    // Resize and crop
    imagecopyresampled(
    $thumb,
                   $image,
                   0 - ($new_width - $thumb_width) / 2, // Center the image horizontally
                   0 - ($new_height - $thumb_height) / 2, // Center the image vertically
                   0,
    0,
                   $new_width,
    $new_height,
                   $width,
    $height
);
    imagejpeg($thumb, $filename, 80);
    return $filename;
}

function createDir($path)
{
    if (!file_exists($path)) {
        $old_mask = umask(0);
        mkdir($path, 0777, true);
        umask($old_mask);
    }
}

function cropCover($path1, $path2, $file_type, $new_w, $new_h, $squareSize)
{
    /* read the source image */
    $source_image = false;
    
    if (preg_match("/jpg|JPG|jpeg|JPEG/", $file_type)) {
        $source_image = imagecreatefromjpeg($path1);
    } elseif (preg_match("/png|PNG/", $file_type)) {
        if (!$source_image = @imagecreatefrompng($path1)) {
            $source_image = imagecreatefromjpeg($path1);
        }
    } elseif (preg_match("/gif|GIF/", $file_type)) {
        $source_image = imagecreatefromgif($path1);
    }
    if ($source_image == false) {
        $source_image = imagecreatefromjpeg($path1);
    }

    $orig_w = imageSX($source_image);
    $orig_h = imageSY($source_image);
            
    if ($squareSize != '') {
        $desired_width = $new_w;
        $desired_height = $orig_h;
    }

    /* create a new, "virtual" image */
    $virtual_image = imagecreatetruecolor($desired_width, $desired_height);
    // for PNG background white----------->
    $kek = imagecolorallocate($virtual_image, 255, 255, 255);
    imagefill($virtual_image, 0, 0, $kek);
    
    if ($squareSize == '') {
        /* copy source image at a resized size */
        imagecopyresampled($virtual_image, $source_image, 0, 0, 0, 0, $desired_width, $desired_height, $orig_w, $orig_h);
    } else {
        $wm = $orig_w / $squareSize;
        $hm = $orig_h / $squareSize;
        $h_height = $squareSize / 2;
        $w_height = $squareSize / 2;
        
        if ($orig_w > $orig_h) {
            $adjusted_width = $orig_w / $hm;
            $half_width = $adjusted_width / 2;
            $int_width = $half_width - $w_height;
            imagecopyresampled($virtual_image, $source_image, -$int_width, 0, 0, 0, $adjusted_width, $squareSize, $orig_w, $orig_h);
        } elseif (($orig_w <= $orig_h)) {
            $adjusted_height = $orig_h / $wm;
            $half_height = $adjusted_height / 2;
            imagecopyresampled($virtual_image, $source_image, 0, 0, 0, 0, $squareSize, $adjusted_height, $orig_w, $orig_h);
        } else {
            imagecopyresampled($virtual_image, $source_image, 0, 0, 0, 0, $squareSize, $squareSize, $orig_w, $orig_h);
        }
    }
    
    if (@imagejpeg($virtual_image, $path2, 90)) {
        imagedestroy($virtual_image);
        imagedestroy($source_image);
        return true;
    } else {
        return false;
    }
}

function createThumb($path1, $path2, $file_type, $new_w, $new_h, $squareSize = '')
{
    /* read the source image */
    $source_image = false;
    
    if (preg_match("/jpg|JPG|jpeg|JPEG/", $file_type)) {
        $source_image = imagecreatefromjpeg($path1);
    } elseif (preg_match("/png|PNG/", $file_type)) {
        if (!$source_image = @imagecreatefrompng($path1)) {
            $source_image = imagecreatefromjpeg($path1);
        }
    } elseif (preg_match("/gif|GIF/", $file_type)) {
        $source_image = imagecreatefromgif($path1);
    }
    if ($source_image == false) {
        $source_image = imagecreatefromjpeg($path1);
    }

    $orig_w = imageSX($source_image);
    $orig_h = imageSY($source_image);
    
    if ($orig_w < $new_w && $orig_h < $new_h) {
        $desired_width = $orig_w;
        $desired_height = $orig_h;
    } else {
        $scale = min($new_w / $orig_w, $new_h / $orig_h);
        $desired_width = ceil($scale * $orig_w);
        $desired_height = ceil($scale * $orig_h);
    }
            
    if ($squareSize != '') {
        $desired_width = $desired_height = $squareSize;
    }

    /* create a new, "virtual" image */
    $virtual_image = imagecreatetruecolor($desired_width, $desired_height);
    // for PNG background white----------->
    $kek = imagecolorallocate($virtual_image, 255, 255, 255);
    imagefill($virtual_image, 0, 0, $kek);
    
    if ($squareSize == '') {
        /* copy source image at a resized size */
        imagecopyresampled($virtual_image, $source_image, 0, 0, 0, 0, $desired_width, $desired_height, $orig_w, $orig_h);
    } else {
        $wm = $orig_w / $squareSize;
        $hm = $orig_h / $squareSize;
        $h_height = $squareSize / 2;
        $w_height = $squareSize / 2;
        
        if ($orig_w > $orig_h) {
            $adjusted_width = $orig_w / $hm;
            $half_width = $adjusted_width / 2;
            $int_width = $half_width - $w_height;
            imagecopyresampled($virtual_image, $source_image, -$int_width, 0, 0, 0, $adjusted_width, $squareSize, $orig_w, $orig_h);
        } elseif (($orig_w <= $orig_h)) {
            $adjusted_height = $orig_h / $wm;
            $half_height = $adjusted_height / 2;
            imagecopyresampled($virtual_image, $source_image, 0, 0, 0, 0, $squareSize, $adjusted_height, $orig_w, $orig_h);
        } else {
            imagecopyresampled($virtual_image, $source_image, 0, 0, 0, 0, $squareSize, $squareSize, $orig_w, $orig_h);
        }
    }
    
    if (@imagejpeg($virtual_image, $path2, 90)) {
        imagedestroy($virtual_image);
        imagedestroy($source_image);
        return true;
    } else {
        return false;
    }
}

function getExtension($str)
{
    $i = strrpos($str, ".");
    if (!$i) {
        return "";
    }
    $l = strlen($str) - $i;
    $ext = substr($str, $i+1, $l);
    return $ext;
}

function optimize_img($img, $source, $dest, $quality = '45')
{
    $jpg = $source.$img;
    $path = $dest.$img;

    if ($jpg) {
        $info = getimagesize($jpg);
        if ($info['mime'] == 'image/jpeg') {
            $source = imagecreatefromjpeg($jpg);
            imagejpeg($source, $path, $quality);
        } elseif ($info['mime'] == 'image/gif') {
            $source = imagecreatefromgif($jpg);
            imagegif($source, $path, $quality);
        } elseif ($info['mime'] == 'image/png') {
            $source = imagecreatefrompng($jpg);
            imagepng($source, $path, '8');
        }
    }
    imagedestroy($source);
}

function follow_user($id_sender, $id_recipient, $date_send, $date_receive, $date_seen, $date_format, $active, $block)
{
    try {
        $conn =  connectDB();

        $sql = $conn->prepare("INSERT INTO friends (id_sender,id_recipient,date_send,date_receive,date_seen,date_format,active,block) VALUES (?,?,?,?,?,?,?,?)");
        $sql->bindParam(1, $id_sender);
        $sql->bindParam(2, $id_recipient);
        $sql->bindParam(3, $date_send);
        $sql->bindParam(4, $date_receive);
        $sql->bindParam(5, $date_seen);
        $sql->bindParam(6, $date_format);
        $sql->bindParam(7, $active);
        $sql->bindParam(8, $block);

        if ($sql->execute() === true) {
            return $conn->lastInsertId('fid');
        } else {
            return 0;
        }
    } catch (PDOException $e) {
        die('Erreur : ' . $e->getMessage());
    }
}

function createThumbnail($src, $dest, $desiredWidth, $desiredHeight, $fileName, $fileType)
{
 
 // Read the source image.
    switch ($fileType) {
 case "jpg":
 case "jpeg":
  $sourceImage = imagecreatefromjpeg($src);
  break;
 case "png":
  $sourceImage = imagecreatefrompng($src);
  break;
 case "gif":
  $sourceImage = imagecreatefromgif($src);
  break;
 }
 
    // Get the source image size.
    $width = imagesx($sourceImage);
    $height = imagesy($sourceImage);
 
    if ($width > $height) {
        $desiredHeight = floor($height * ($desiredWidth/$width));
    }
    if ($height > $width) {
        $desiredWidth = floor($width * ($desiredHeight/$height));
    }
 
    // If the source image size is bigger than the desired size, crop it.
    if ($width > $desiredWidth || $height > $desiredHeight) {
        // Create the virtual image.
        $virtualImage = imagecreatetruecolor($desiredWidth, $desiredHeight);
        // Create a copy of the source image at its desired size.
        imagecopyresampled($virtualImage, $sourceImage, 0, 0, 0, 0, $desiredWidth, $desiredHeight, $width, $height);
        // Create the physical thumbnail in the desired destination.
        switch ($fileType) {
   case "jpg":
   case "jpeg":
    return imagejpeg($virtualImage, $dest.$fileName);
    break;
   case "png":
    return imagepng($virtualImage, $dest.$fileName);
    break;
   case "gif":
    return imagegif($virtualImage, $dest.$fileName);
    break;
  }
        // If the source image is smaller than the desired image, don't resample just copy the image to the desired destination.
    } else {
        copy($src, $dest.$fileName);
    }
}

function file_get_contents_curl($url)
{
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);

    $data = curl_exec($ch);
    curl_close($ch);

    return $data;
}

function get_title_desc_meta($url)
{
    $html = file_get_contents_curl($url);
    $doc = new DOMDocument();
    @$doc->loadHTML($html);
    $nodes = $doc->getElementsByTagName('title');
    $title = $nodes->item(0)->nodeValue;
    $metas = $doc->getElementsByTagName('meta');
    for ($i = 0; $i < $metas->length; $i++) {
        $meta = $metas->item($i);
        if ($meta->getAttribute('name') == 'description') {
            $description = $meta->getAttribute('content');
        }
        if ($meta->getAttribute('name') == 'keywords') {
            $keywords = $meta->getAttribute('content');
        }
    }
    $data = array();
    $data['title'] = $title;
    $data['description'] = $description;
    $data['keywords'] = $keywords;
    return $data;
}

function get_meta($url)
{
    $tags = get_meta_tags($url);
    $data = array();
    $data['description'] = $tags['description'];
    $data['image'] = $tags['twitter:image'];
    return $data;
}

function getUsername($msg)
{
    preg_match_all('/(^|[^a-z0-9_])@([a-z0-9_]+)/i', $msg, $matchedUsernames);
    $username = '';
    if (!empty($matchedUsernames[0])) {
        foreach ($matchedUsernames[0] as $match) {
            $username .= preg_replace("/[^a-z0-9_]+/i", "", $match).',';
        }
    }
    return rtrim($username, ',');
}

function TagNotifUsername($msg, $pid)
{
    $id = $_SESSION['id'];
    preg_match_all('/(^|[^a-z0-9_]){@}([a-z0-9_]+)/i', $msg, $matchedUsernames);
    $username = '';
    if (!empty($matchedUsernames[0])) {
        foreach ($matchedUsernames[0] as $match) {
            $username .= preg_replace("/[^a-z0-9_]+/i", "", $match);
            $id_user = select_sql_username($username, 'id');
            $username = show_username($username);
            InsertNotifications($id_user, $id, 'post', 'tag', $pid);
        }
    }
}

function active_icon($count)
{
    if ($count > 0) {
        $class = 'active-icon';
    } else {
        $class = '';
    }
    return $class;
}

function ReturnCSRF($session_id_csrf)
{
    /********* CSRF ID **********/
    $input = '<input type="hidden" name="token" id="token_id" value="'.$session_id_csrf.'">';
    return $input;
}

function TagNotifUsername2($msg, $pid)
{
    $id = $_SESSION['id'];
    preg_match_all('/(^|[^a-z0-9_])@([a-z0-9_]+)/i', $msg, $matchedUsernames);
    $username = '';
    if (!empty($matchedUsernames[0])) {
        foreach ($matchedUsernames[0] as $match) {
            $username .= preg_replace("/[^a-z0-9_]+/i", "", $match);
            $id_user = select_sql_username($username, 'id');
            $username = show_username($username);
            InsertNotifications($id_user, $id, 'post', 'tag', $pid);
        }
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

function get_youtube_thumbnail($url)
{
    $parse = parse_url($url);
    if (!empty($parse['query'])) {
        preg_match("/v=([^&]+)/i", $url, $matches);
        $id = $matches[1];
    } else {
        //to get basename
        $info = pathinfo($url);
        $id = $info['basename'];
    }
    $img = "http://img.youtube.com/vi/$id/0.jpg";
    return $img;
}

function get_metacafe_thumbnail($id, $title, $size='large')
{
    if ($id && $title) {
        if ($size=='large') {
            return "http://cdn.mcstatic.com/contents/videos_screenshots/2972000/{$id}/830x467/1.jpg";
        } elseif ($size=='small') {
            return "http://cdn.mcstatic.com/contents/videos_screenshots/2972000/{$id}/830x467/2.jpg";
        }
    }
    return false;
}

function metacafe_video_details($url)
{
    preg_match('|metacafe\.com/watch/([\w\-\_]+)(.*)|', $url, $matches);
    if ($matches) {
        $metacafe = array();
        $metacafe['id'] = $matches[1];
        $metacafe['title'] = ltrim(rtrim($matches[2], '/'), '/');
        return $metacafe;
    }
}

function get_vimeo_thumbnail($url)
{
    $id = parse_vimeo($url);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "http://vimeo.com/api/v2/video/$id.php");
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    $output = unserialize(curl_exec($ch));
    $output = $output[0]['thumbnail_medium'];
    curl_close($ch);
    return $output;
}

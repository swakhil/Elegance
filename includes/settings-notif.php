<?php
require '../functions/functions.php';

$follows = select_sqlarg('email_notifications', 'id_user', returnID(), 'follows');
if ($follows == '1') {
    $checked_follows = 'checked="checked"';
} else {
    $checked_follows = '';
}

$comments = select_sqlarg('email_notifications', 'id_user', returnID(), 'comments');
if ($comments == '1') {
    $checked_comments = 'checked="checked"';
} else {
    $checked_comments = '';
}

$likes = select_sqlarg('email_notifications', 'id_user', returnID(), 'likes');
if ($likes == '1') {
    $checked_likes = 'checked="checked"';
} else {
    $checked_likes = '';
}



$shares = select_sqlarg('email_notifications', 'id_user', returnID(), 'shares');
if ($shares == '1') {
    $checked_shares = 'checked="checked"';
} else {
    $checked_shares = '';
}


$messages = select_sqlarg('email_notifications', 'id_user', returnID(), 'messages');
if ($messages == '1') {
    $checked_messages = 'checked="checked"';
} else {
    $checked_messages = '';
}

$adult_content = select_sqlarg('email_notifications', 'id_user', returnID(), 'block_adult_content');
if ($adult_content == '1') {
    $checked_adult_content = 'checked="checked"';
} else {
    $checked_adult_content = '';
}

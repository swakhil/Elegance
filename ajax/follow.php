<?php

// +------------------------------------------------------------------------+
// | @Team author : Smart Xplorer (smartxplorer)
// | @Team author email: smartxplorerdev@gmail.com
// +------------------------------------------------------------------------+
// | Elegance - The Elegant Social Network Platform
// | Copyright (c) 2017 Elegant. All rights reserved.
// +------------------------------------------------------------------------+


include '../functions/functions.php';

//Applying CSRF, XSS Protection
if (verify_token_general($name = $id_csrf)) {
    $id_recipient = trim(filter_input(INPUT_POST, 'id', FILTER_SANITIZE_STRING));
    $arg = trim(filter_input(INPUT_POST, 'arg', FILTER_SANITIZE_STRING));
    $id_sender = returnID();

    if ($arg == 'follow') {
        $isFollow = select_doublearg('friends', 'id_sender', $id_sender, 'id_recipient', $id_recipient, 'date_send');
        if ($isFollow == '') {
            $time = time();
            $date = date('Y-m-d');
            $null = '0';

            $follow_user = follow_user($id_sender, $id_recipient, $time, $null, $null, $date, $null, $null);
            InsertNotifications($id_recipient, $id_sender, 'friends', 'follow', '0');
            $id_user_post = $id_sender;
            $id_email = $id_recipient;
            $email_notif_follows = select_sqlarg('email_notifications', 'id_user', $id_email, 'follows');
            if ($email_notif_follows == '1') {
                include '../includes/email_follow.php';
            }
        }
    } elseif ($arg == 'unfollow') {
        $time = time();
        $date = date('Y-m-d');
        $null = '0';

        $unfollow_user = unfollow_user($id_sender, $id_recipient);
        //InsertNotifications($recipient_id,$sender_id,$type,$parameters,$reference_id);
        DeleteNotifications($id_sender, $id_recipient, 'friends', 'follow', '0');
    }
}

<?php
/***Start send email Notification***/
    $email = select_sql_id($id_email, 'email');
    $email_noreply = general_settings('email_noreply');
    $site_name = general_settings('site_name');
    $firstname = select_sql_id($id_email, 'firstname');
    $email_contact = general_settings('email_contact');
    $site_name_and_year = $site_name.'|'.date('Y');
    $template_include = 'template/template_1.html';
    $site_url = general_settings('site_url');
    $title_desc = select_sql_id($id_user_post, 'firstname').' has followed you';
    $desc = '';
    $main_desc = select_sql_id($id_user_post, 'fullname').' ('.select_sql_id($id_user_post, 'username').') has now followed you.';
    $main_button_url = $site_url.'user/notifications';
    $main_button_text = 'View on '.$site_name;
    $title = $site_name.' New followers!';
    send_mail($email, $email_noreply, $site_name, $title, $firstname, $title_desc, $desc, $main_desc, $main_button_url, $main_button_text, $email_contact, $site_name_and_year, $template_include, $site_url);
 /***End send email Notification***/

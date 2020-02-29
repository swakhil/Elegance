<?php
/***Start send email Notification***/
            $email = $email_user;
            $email_noreply = general_settings('email_noreply');
            $site_name = general_settings('site_name');
            $firstname = select_sql_id($id_email, 'firstname');
            $password = select_sql_id($id_email, 'password');
            $email_contact = general_settings('email_contact');
            $site_name_and_year = $site_name.'|'.date('Y');
            $template_include = 'template/template_1.html';
            $site_url = general_settings('site_url');
            $title_desc = 'Please, '.$firstname.' confirm your email address by clicking the link below';
            $desc = 'Hi! We send you this message cause you request to change your email address to : '.$email_user.'. If you don\'t do this, please ignore this message.';
            $main_desc = 'Follow the link to change your email address.';
            $main_button_url = $site_url.'user/change-email?t='.sha1($password.$email).'&i='.crypt_data($id_email, 'e').'&e='.crypt_data($email, 'e');
            $main_button_text = 'Confirm your email address';
            $title = 'Change your email address';
            send_mail($email, $email_noreply, $site_name, $title, $firstname, $title_desc, $desc, $main_desc, $main_button_url, $main_button_text, $email_contact, $site_name_and_year, $template_include, $site_url);
/***End send email Notification***/

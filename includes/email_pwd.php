<?php
/***Start send email for reset password***/
            $email_noreply = general_settings('email_noreply');
            $site_name = general_settings('site_name');
            $firstname = select_sql_id($id, 'firstname');
            $password = select_sql_id($id, 'password');
            $email_contact = general_settings('email_contact');
            $site_name_and_year = $site_name.'|'.date('Y');
            $template_include = 'template/template_1.html';
            $site_url = general_settings('site_url');
            $title_desc = $firstname.', you request to reset your password.';
            $desc = 'Hi! We are sending you this message because you requested to change your password. If you don\'t do this, please ignore this message.';
            $main_desc = 'Follow the link to change your password.';
            $main_button_url = $site_url.'user/forget?t='.sha1($password.$id).'&i='.crypt_data($id, 'e');
            $main_button_text = 'Reset your password';
            $title = 'Reset Password Request';
            send_mail($email, $email_noreply, $site_name, $title, $firstname, $title_desc, $desc, $main_desc, $main_button_url, $main_button_text, $email_contact, $site_name_and_year, $template_include, $site_url);
/***End send email for reset password***/

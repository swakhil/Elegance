<?php
require '../functions/functions.php';

//Applying CSRF, XSS Protection
if (verify_token_general($name = $id_csrf)) {
    if (isset($_SESSION['id'])) {
        $msg = '';
        if (isset($_POST['email_follow'])) {
            update_sql_arg('email_notifications', 'follows', '1', 'id_user', returnID());
            $msg = "<div class='alert alert-success' role='alert'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>Updated!</div>";
        } else {
            update_sql_arg('email_notifications', 'follows', '0', 'id_user', returnID());
            $msg = "<div class='alert alert-success' role='alert'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>Updated!</div>";
        }


        if (isset($_POST['email_comments'])) {
            update_sql_arg('email_notifications', 'comments', '1', 'id_user', returnID());
            $msg = "<div class='alert alert-success' role='alert'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>Updated!</div>";
        } else {
            update_sql_arg('email_notifications', 'comments', '0', 'id_user', returnID());
            $msg = "<div class='alert alert-success' role='alert'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>Updated!</div>";
        }


        if (isset($_POST['email_likes'])) {
            update_sql_arg('email_notifications', 'likes', '1', 'id_user', returnID());
            $msg = "<div class='alert alert-success' role='alert'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>Updated!</div>";
        } else {
            update_sql_arg('email_notifications', 'likes', '0', 'id_user', returnID());
            $msg = "<div class='alert alert-success' role='alert'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>Updated!</div>";
        }


        if (isset($_POST['email_shares'])) {
            update_sql_arg('email_notifications', 'shares', '1', 'id_user', returnID());
            $msg = "<div class='alert alert-success' role='alert'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>Updated!</div>";
        } else {
            update_sql_arg('email_notifications', 'shares', '0', 'id_user', returnID());
            $msg = "<div class='alert alert-success' role='alert'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>Updated!</div>";
        }


        if (isset($_POST['email_messages'])) {
            update_sql_arg('email_notifications', 'messages', '1', 'id_user', returnID());
            $msg = "<div class='alert alert-success' role='alert'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>Updated!</div>";
        } else {
            update_sql_arg('email_notifications', 'messages', '0', 'id_user', returnID());
            $msg = "<div class='alert alert-success' role='alert'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>Updated!</div>";
        }

        if (isset($_POST['block_adult_content'])) {
            update_sql_arg('email_notifications', 'block_adult_content', '1', 'id_user', returnID());
            $msg = "<div class='alert alert-success' role='alert'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>Updated!</div>";
        } else {
            update_sql_arg('email_notifications', 'block_adult_content', '0', 'id_user', returnID());
            $msg = "<div class='alert alert-success' role='alert'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>Updated!</div>";
        }
    
        die($msg);
    }
}

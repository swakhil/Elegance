<?php
include '../functions/functions.php';

//Applying CSRF, XSS Protection
if (verify_token_general($name = $id_csrf)) {
    if (isset($_SESSION['id'])) {
        $id_online = select_doublearg('online', 'online_user', returnID(), 'absent', '0', 'online_user', $count = 'false');
        $count = select_doublearg('online', 'online_user', returnID(), 'absent', '0', 'online_user', $count = 'true');
        if ($count == 0) {
            $count = select_doublearg('online', 'online_user', returnID(), 'absent', '1', 'online_user', $count = 'true');
            if ($count == 0) {
                $insert_online = insert_online($_SERVER["REMOTE_ADDR"], returnID(), time());
            } else {
                $update_online = update_sql_arg('online', 'online_time', time(), 'online_user', returnID());
                update_sql_arg('online', 'absent', '0', 'online_user', returnID());
            }
        } else {
            $update_online = update_sql_arg('online', 'online_time', time(), 'online_user', returnID());
        }

        $time_out = time()-5;
        deleteOnline('online', 'online_time', $time_out);
    }
}

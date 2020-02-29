<?php

if (isset($_GET['u'])) {
    $u = trim(filter_input(INPUT_GET, 'u', FILTER_SANITIZE_STRING));
    $id = select_sqlarg('users', 'username', $u, 'id');
    $fullname = select_sql_id($id, 'fullname');
    $time_online = select_sqlarg('online', 'online_user', $id, 'online_time');
    $online = getConnected($time_online);

    if ($id == returnID() || $id == '') {
        /*******************/
        redirect($site_url);
    } else {
        $cvid = select_conversation(0, returnID(), $id, 'cvid');
        if ($cvid == '') {
            //Create a conversation
            $cvid  = create_conversation(returnID(), $id);
        }
    }
} else {
    $fullname = $site_name;
    $online= 'Messenger';
}
  $data_conversation = select_conversation(8, returnID());

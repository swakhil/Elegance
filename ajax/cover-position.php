<?php

// +------------------------------------------------------------------------+
// | @Team author : Smart Xplorer (smartxplorer)
// | @Team author email: smartxplorerdev@gmail.com
// +------------------------------------------------------------------------+
// | Elegance - The Elegant Social Network Platform
// | Copyright (c) 2017 Elegant. All rights reserved.
// +------------------------------------------------------------------------+


include('../functions/functions.php');

//Applying CSRF, XSS Protection
if (verify_token_general($name = $id_csrf)) {
    if (isset($_POST['position'])) {
        $position = trim(filter_input(INPUT_POST, 'position', FILTER_SANITIZE_STRING));
        $id = returnID();

        $position = explode(' ', $position);
        $px = $position[0];
        $py = $position[1];
        update_sql_arg('cover_position', 'position_x', $px, 'id_user', $id);
        update_sql_arg('cover_position', 'position_y', $py, 'id_user', $id);
    }
}

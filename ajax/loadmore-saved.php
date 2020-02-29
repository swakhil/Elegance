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
    if (!empty($_POST['last-id'])) {

    //Format and Sanitize Variables
        $id_order = trim(filter_input(INPUT_POST, "last-id", FILTER_SANITIZE_STRING));
        $id = trim(filter_input(INPUT_POST, "id_user", FILTER_SANITIZE_STRING));
        $page = trim(filter_input(INPUT_POST, "page", FILTER_SANITIZE_STRING));
        $select_save_data = select_save_data_loadmore('pid', $id_order, '4');
        foreach ($select_save_data as $rew) {
            $pid = $rew['save'];
            $id_order = select_sqlarg('saved', 'save', $pid, 'id');
            $datas = select_post($pid);
            foreach ($datas as $row) {
                ?>
         <i class="pointer-saved" id="page-id-<?php echo $id_order; ?>"></i>
         <?php
         include '../includes/post.php';
            }
        }
    }
}

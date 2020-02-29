<?php
if (file_exists('../../functions/connect.php')) {
    include_once '../../functions/connect.php';
}
include '../functions/functions.php';

//Applying CSRF, XSS Protection
if (verify_token_double($website_url.'admin/', $website_url.'admin/users', $name = $id_csrf)) {
    if (isset($_POST['id'])) {
        $id = trim(filter_input(INPUT_POST, 'id', FILTER_SANITIZE_STRING));
        include 'show-table.php';
    }
}

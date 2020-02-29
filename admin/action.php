<?php

// +------------------------------------------------------------------------+
// | @Team author : Smart Xplorer (smartxplorer)
// | @Team author email: smartxplorerdev@gmail.com
// +------------------------------------------------------------------------+
// | Elegance - The Elegant Social Network Platform
// | Copyright (c) 2017 Elegant. All rights reserved.
// +------------------------------------------------------------------------+


include 'functions/functions.php';
include 'functions/redirect.php';

//Applying CSRF Protection
if (verify_token($website_url.'admin/', $name = $id_csrf)) {
    if (isset($_POST['q'])) {
        $q = base64_decode(trim(filter_input(INPUT_POST, 'q', FILTER_SANITIZE_STRING)));
        if ($q == 'b') {
            //Block the user
            if (isset($_POST['p'])) {
                $id = base64_decode(trim(filter_input(INPUT_POST, 'p', FILTER_SANITIZE_STRING)));
                block_user($id);
                $details = "<div class='alert alert-success' role='alert'>You block successfully ".select_sqlarg('users', 'id', $id, 'fullname').", 'status' are set to inactive.</div>";
            }
        } elseif ($q == 'ub') {
            //Unblock the user
            if (isset($_POST['p'])) {
                $id = base64_decode(trim(filter_input(INPUT_POST, 'p', FILTER_SANITIZE_STRING)));
                update_active($id);
                $details = "<div class='alert alert-success' role='alert'>You activate successfully the account of ".select_sqlarg('users', 'id', $id, 'fullname').", 'status' are set to active.</div>";
            }
        } elseif ($q == 'd') {
            //Delete the user
            if (isset($_POST['p'])) {
                $id = base64_decode(trim(filter_input(INPUT_POST, 'p', FILTER_SANITIZE_STRING)));
                delete_user($id);
                $details = "<div class='alert alert-success' role='alert'>
               <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>You delete successfully ".select_sqlarg('users', 'id', $id, 'fullname').'.</div>';
            }
        }
        die($details);
    }
}

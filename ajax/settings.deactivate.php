<?php
require '../functions/functions.php';

//Applying CSRF, XSS Protection
if (verify_token_general($name = $id_csrf)) {
    if (isset($_SESSION['id'])) {
        if (isset($_POST['deleted'])) {
            $deleteSQL = deleteSQL('users', 'id', returnID());
            if ($deleteSQL == 1) {
                $msg = "<div class='alert alert-success' role='alert'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>Password Updated!</div>";
            } else {
                $msg = "<div class='alert alert-danger' role='alert'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>Error on deleting account! Please retry!</div>";
            }
        }

        die($msg);
    }
}

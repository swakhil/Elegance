<?php

$msg='';
if (isset($_SESSION['id'])) {
    $active = select_sql('active');
    if ($active == 0) {
        if (isset($_POST['submit'])) {
            $id = $_SESSION['id'];
            $code = filter_input(INPUT_POST, 'code', FILTER_SANITIZE_STRING);
            $verif_code = verif_code($id);

            foreach ($verif_code as $row) {
                $verif_row = $row['code'];

                if ($verif_row == $code) {
                    update_active($id);
                    redirect($site_url.'user/avatar');
                } else {
                    $msg = "<div class='alert alert-danger' role='alert'>

            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>*Invalid Code!</div>";
                }
            }
        }
    } else {
        redirect($site_url);
    }
}

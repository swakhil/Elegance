<?php

// +------------------------------------------------------------------------+
// | @Team author : Smart Xplorer (smartxplorer)
// | @Team author email: smartxplorerdev@gmail.com
// +------------------------------------------------------------------------+
// | Elegance - The Elegant Social Network Platform
// | Copyright (c) 2017 Elegant. All rights reserved.
// +------------------------------------------------------------------------+


include_once 'functions.php';

if (isset($_SESSION['id'])) {
    $active = select_sql('active');
    if ($active == '0') {
        redirect($site_url.'user/active');
    }
}

if (!isset($_SESSION['id'])) {
    redirect($site_url);
}

<?php
// +------------------------------------------------------------------------+
// | @Team author : Smart Xplorer (smartxplorer)
// | @Team author email: smartxplorerdev@gmail.com
// +------------------------------------------------------------------------+
// | Elegance - The Elegant Social Network Platform
// | Copyright (c) 2017 Elegant. All rights reserved.
// +------------------------------------------------------------------------+
include_once 'functions/check_install.php';
include 'functions/functions.php';

if (isset($_SESSION['id'])) {
    include 'includes/home.php';
} else {
    include 'includes/main.php';
}

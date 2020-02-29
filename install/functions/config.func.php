<?php

// +------------------------------------------------------------------------+
// | @Team author : Smart Xplorer (smartxplorer)
// | @Team author email: smartxplorerdev@gmail.com
// +------------------------------------------------------------------------+
// | Elegance - The Elegant Social Network Platform
// | Copyright (c) 2017 Elegant. All rights reserved.
// +------------------------------------------------------------------------+

error_reporting(E_ALL);
//Applying CSRF Protection
if (verify_token_adms($name = 'config')) {
    if (isset($_POST['save'])) {
        $file = '../functions/connect.php';
        $dbname = filter_input(INPUT_POST, 'dbname', FILTER_SANITIZE_STRING);
        $servername = filter_input(INPUT_POST, 'servername', FILTER_SANITIZE_STRING);
        $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
        $dbpassword = filter_input(INPUT_POST, 'dbpassword', FILTER_SANITIZE_STRING);
        $filename = 'SQL/database.sql';

        //for create database
        //create_db($dbname, $servername, $username, $dbpassword);
        import_sql_db($dbname, $servername, $username, $dbpassword, $filename);
        write_config($dbname, $servername, $username, $dbpassword);

        redirect('administrator.php');
    }
}

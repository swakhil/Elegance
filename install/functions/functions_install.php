<?php

// +------------------------------------------------------------------------+
// | @Team author : Smart Xplorer (smartxplorer)
// | @Team author email: smartxplorerdev@gmail.com
// +------------------------------------------------------------------------+
// | Elegance - The Elegant Social Network Platform
// | Copyright (c) 2017 Elegant. All rights reserved.
// +------------------------------------------------------------------------+


error_reporting(E_ALL);

session_start();

function redirect($url, $permanent = false)
{
    if ($permanent) {
        header('HTTP/1.1 301 Moved Permanently');
    }
    header('Location: '.$url);
    exit();
}

function verify_token_adms($name = '')
{
    if (isset($_SESSION[$name.'_token']) && isset($_POST['token'])) {
        if ($_SESSION[$name.'_token'] == $_POST['token']) {
            return true;
        }
    }

    return false;
}

// Function to write the config file
function write_config($dbname, $servername, $username, $dbpassword)
{

    // Config path
    $template_path = 'functions/connect_sample.php';
    $output_path = '../functions/connect.php';

    // Open the file
    $database_file = file_get_contents($template_path);

    $new = str_replace('{HOSTNAME}', $servername, $database_file);
    $new = str_replace('%USERNAME%', $username, $new);
    $new = str_replace('%PASSWORD%', $dbpassword, $new);
    $new = str_replace('%DATABASE%', $dbname, $new);

    // Write the new database.php file
    $handle = fopen($output_path, 'w+');

    // Chmod the file, in case the user forgot
    @chmod($output_path, 0777);

    // Verify file permissions
    if (is_writable($output_path)) {

        // Write the file
        if (fwrite($handle, $new)) {
            return true;
        } else {
            return false;
        }
    } else {
        return false;
    }
}

function create_db($dbname, $servername, $username, $dbpassword)
{
    $host = $servername;
    $root = $username;
    $root_password = $dbpassword;
    $db = $dbname;

    try {
        $dbh = new PDO("mysql:host=$host", $root, $root_password);
        $dbh->exec("CREATE DATABASE IF NOT EXISTS `$db`;")
            or die(print_r($dbh->errorInfo(), true));
    } catch (PDOException $e) {
        die('DB ERROR: '.$e->getMessage());
    }
}

function import_sql_db($dbname, $servername, $username, $dbpassword, $filename)
{
    // MySQL host
    $mysql_host = $servername;
    // MySQL username
    $mysql_username = $username;
    // MySQL password
    $mysql_password = $dbpassword;
    // Database name
    $mysql_database = $dbname;
    // Connect to MySQL server
    $conn = new PDO("mysql:host=$mysql_host;dbname=$mysql_database", $mysql_username, $mysql_password);

    // Temporary variable, used to store current query
    $templine = '';
    // Read in entire file
    $lines = file($filename);
    // Loop through each line
    foreach ($lines as $line) {
        // Skip it if it's a comment
        if (substr($line, 0, 2) == '--' || $line == '') {
            continue;
        }
        // Add this line to the current segment
        $templine .= $line;
        // If it has a semicolon at the end, it's the end of the query
        if (substr(trim($line), -1, 1) == ';') {
            // Perform the query
            $sql = $conn->prepare($templine);
            $sql->execute();
            // Reset temp variable to empty
            $templine = '';
        }
    }
}

function generate_token($name = '')
{
    $token = uniqid(rand(), true);
    $_SESSION[$name.'_token'] = $token;

    return $token;
}

function verify_token($referer, $name = '')
{
    if (isset($_SESSION[$name.'_token']) && isset($_POST['token'])) {
        if ($_SESSION[$name.'_token'] == $_POST['token']) {
            if (isset($_SERVER['HTTP_REFERER'])) {
                if ($_SERVER['HTTP_REFERER'] == $referer) {
                    return true;
                }
            }
        }
    }

    return false;
}

function url_base()
{
    if ($_SERVER['SERVER_NAME'] == 'localhost') {
        $url = url();
        $explode = explode('/', $url);
        $url = $explode[0].'/'.$explode[1].'/'.$explode[2].'/'.$explode[3].'';
    } else {
        //$url= 'https://www.google.com/';
        $explode = explode('/', $url);
        $url = $explode[0].'/'.$explode[1].'/'.$explode[2].'';
    }

    return $url;
}

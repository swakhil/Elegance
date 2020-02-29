<?php

// +------------------------------------------------------------------------+
// | @Team author : Smart Xplorer (smartxplorer)
// | @Team author email: smartxplorerdev@gmail.com
// +------------------------------------------------------------------------+
// | Elegance - The Elegant Social Network Platform
// | Copyright (c) 2017 Elegant. All rights reserved.
// +------------------------------------------------------------------------+


error_reporting(E_ALL);

function connectDB()
{

    //Database credentials
    $dbHost = '{HOSTNAME}';

    $dbUsername = '%USERNAME%';

    $dbPassword = '%PASSWORD%';

    $dbName = '%DATABASE%';

    try {
        $conn = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUsername, $dbPassword);
    } catch (Exception $e) {
        die('Erreur : '.$e->getMessage());
    }

    return $conn;
}

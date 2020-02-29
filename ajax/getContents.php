<?php	

// +------------------------------------------------------------------------+
// | @Team author : Smart Xplorer (smartxplorer)
// | @Team author email: smartxplorerdev@gmail.com
// +------------------------------------------------------------------------+
// | Elegance - The Elegant Social Network Platform
// | Copyright (c) 2017 Elegant. All rights reserved.
// +------------------------------------------------------------------------+

require_once "../functions/functions.php";
require_once "../includes/Class/MediaExtracterHandler.php";

//Applying CSRF, XSS Protection
if (verify_token_general($name = $id_csrf)) {
    if (isset($_POST['url']) && !empty($_POST['url']) && isset($_POST['type']) && $_POST['type'] == 'POST') {
        $extracter = new MediaExtracterHandler();
        $data = $extracter->getDetails($_POST['url']);
        $res = array();
        if (!empty($data)) {
            $res = $data;
        }
        header('Content-Type: application/json');
        echo json_encode($res, true);
    } else {
        die('Url cannot be empty');
    }

    function validateUrl($content)
    {
        $pattern = '/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i';
        preg_match($pattern, $content, $match);
        if (!empty($match)) {
            return $match[0];
        }
        return false;
    }
}

<?php
if (isset($_GET['q']) && $_GET['q'] != '') {

//Format and Sanitize
    $key = trim(filter_input(INPUT_GET, "q", FILTER_SANITIZE_STRING));

    $page_title = $key.' - Search '.$site_name;
} else {
    $page_title = 'Search '.$site_name;
}
$page = 'search';

include 'includes/head.php';

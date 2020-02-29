<?php
include_once 'functions.php';

if (isset($_POST['submit_signup'])) {
    $email = crypt_data($_POST['email'], 'e');
    $password = crypt_data($_POST['password'], 'e');
}

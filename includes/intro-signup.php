<?php
   if (isset($_GET['e']) && isset($_GET['p'])) {
       $email = crypt_data(trim(filter_input(INPUT_GET, 'e', FILTER_SANITIZE_STRING)), 'd');
       $password = crypt_data(trim(filter_input(INPUT_GET, 'p', FILTER_SANITIZE_STRING)), 'd');
   }

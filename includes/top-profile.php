<?php
   include 'functions/redirect.php';
   $u = trim(filter_input(INPUT_GET, 'u', FILTER_SANITIZE_STRING));
   $id = select_sqlarg('users', 'username', $u, 'id');
   $fullname = select_sql_id($id, 'firstname').' '.select_sql_id($id, 'lastname');
   $cvid = trim(select_conversation(0, returnID(), $id, 'cvid'));

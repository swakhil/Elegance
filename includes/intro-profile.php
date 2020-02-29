<?php
   $u = trim(filter_input(INPUT_GET, 'u', FILTER_SANITIZE_STRING));
   $id = select_sqlarg('users', 'username', $u, 'id');
   $fullname = select_sql_id($id, 'firstname').' '.select_sql_id($id, 'lastname');
   $page_title = $fullname.' | Profile';
   $url_table = explode('?', $_SERVER['REQUEST_URI']);

  //Saves Recent Search
  if (isset($_GET['s']) && $_GET['s'] == '1') {
      //Format and Sanitize
      $s = trim(filter_input(INPUT_GET, "s", FILTER_SANITIZE_STRING));
      $parameter = 'id';
      if (is_already_in_use('save', $id, 'saved')) {
          update_save($id);
          redirect($site_url.select_sql_id($id, 'username'));
      } else {
          save($id, $parameter);
          redirect($site_url.select_sql_id($id, 'username'));
      }
  }

   if (!isset($_GET['u']) || ($id == '')) {
       if (isset($url_table['1'])) {
           $url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
           $url = str_replace($site_url, "", $url);
           $url= explode('?', $url);
           $new_url = $url[0];
           redirect($site_url.$new_url);
       }
       include 'includes/404.php';
   } else {
       $cvid = trim(select_conversation(0, returnID(), $id, 'cvid'));
       if (isset($url_table['1'])) {
           $url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
           $url = str_replace($site_url, "", $url);
           $url= explode('?', $url);
           $new_url = $url[0];
           redirect($site_url.$new_url);
       }
       include 'includes/profile.php';
   }

<?php
                  include '../functions/functions.php';
                  //Applying CSRF, XSS Protection
                  if (verify_token_general($name = $id_csrf)) {
                      if (isset($_SESSION['id'])) {
                          include 'post.func.php';
                          if ($status != '' || $image_url != '') {
                              include '../includes/post.php';
                          }
                      }
                  }

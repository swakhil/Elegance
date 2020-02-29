<?php

// +------------------------------------------------------------------------+
// | @Team author : Smart Xplorer (smartxplorer)
// | @Team author email: smartxplorerdev@gmail.com
// +------------------------------------------------------------------------+
// | Elegance - The Elegant Social Network Platform
// | Copyright (c) 2017 Elegant. All rights reserved.
// +------------------------------------------------------------------------+


include '../functions/redirect.php';

/*defined settings - start*/
ini_set('post_max_size', '20M');
define('IMAGE_SMALL_DIR', '../uploads/avatar_thumb/');
define('IMAGE_MEDIUM_DIR', '../uploads/avatar/');
define('IMAGE_SMALL_DIR_DB', 'uploads/avatar_thumb/');
define('IMAGE_MEDIUM_DIR_DB', 'uploads/avatar/');
define('IMAGE_SMALL_SIZE', 100);
define('IMAGE_MEDIUM_SIZE', 450);
/*defined settings - end*/

//Applying CSRF, XSS Protection
if (verify_token_general($name = $id_csrf)) {
    if (isset($_FILES['image_upload_file'])) {
        $output['status']=false;
        set_time_limit(0);
        $allowedImageType = array("image/gif",   "image/jpeg",   "image/pjpeg",   "image/png",   "image/x-png"  );
    
        if ($_FILES['image_upload_file']["error"] > 0) {
            $output['error']= "Error in File";
        } elseif (!in_array($_FILES['image_upload_file']["type"], $allowedImageType)) {
            $output['error']= "You can only upload JPG, PNG and GIF file";
        } elseif (round($_FILES['image_upload_file']["size"] / 1024) > 4096) {
            $output['error']= "You can upload file size up to 4 MB";
        } else {
            /*create directory with 777 permission if not exist - start*/
            createDir(IMAGE_SMALL_DIR);
            createDir(IMAGE_MEDIUM_DIR);
            /*create directory with 777 permission if not exist - end*/
            $path[0] = $_FILES['image_upload_file']['tmp_name'];
            $file = pathinfo($_FILES['image_upload_file']['name']);
            $fileType = $file["extension"];
            $desiredExt='jpg';
            $avatar='avatar_';
            $thumb='avatar_thumb_';
            $fileNameNew = $avatar.rand(333, 999) . time() . ".".$desiredExt;
            $fileNameNew2 = $thumb.rand(333, 999) . time() . ".".$desiredExt;
            $path[1] = IMAGE_MEDIUM_DIR . $fileNameNew;
            $path[2] = IMAGE_SMALL_DIR . $fileNameNew2;
            $name = $path[1];
            $name2 = $path[2];


            if (createThumb($path[0], $path[1], $fileType, IMAGE_MEDIUM_SIZE, IMAGE_MEDIUM_SIZE, IMAGE_MEDIUM_SIZE)) {
                if (createThumb($path[1], $path[2], "$desiredExt", IMAGE_SMALL_SIZE, IMAGE_SMALL_SIZE, IMAGE_SMALL_SIZE)) {
                    $output['status']=true;
                    $output['image_medium']= IMAGE_MEDIUM_DIR_DB . $fileNameNew;
                    $output['image_small']= IMAGE_SMALL_DIR_DB . $fileNameNew2;

                    update_sql_arg('users', 'avatar', $output['image_medium'], 'id', returnID());
                    update_sql_arg('users', 'avatar_thumb', $output['image_small'], 'id', returnID());
                }
            }
        }
        echo json_encode($output);
    }
}
?>	
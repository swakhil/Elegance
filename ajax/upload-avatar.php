<?php
include '../functions/redirect.php';
include('../includes/Class/SimpleImage.php');
$paths = '../uploads/images/';

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
    if (($_FILES["uploadavatar"]["type"] == "image/png") || ($_FILES["uploadavatar"]["type"] == "image/jpg") || ($_FILES["uploadavatar"]["type"] == "image/jpeg")) {

    /*Upload imge without Cropping*/

        $actual_image_name="";
        $valid_formats = array("jpg", "png", "gif", "bmp","jpeg","PNG","JPG","JPEG","GIF","BMP");
        $imagename = $_FILES['uploadavatar']['name'];
        $size = $_FILES['uploadavatar']['size'];

        if (strlen($imagename)) {
            $ext = strtolower(getExtension($imagename));
            if (in_array($ext, $valid_formats)) {
                $actual_image_name = basename('img_'.rand().time().'_'.uniqid().'_.'.$ext);
                $file=$paths.$actual_image_name;

                $uploadedfile = $_FILES['uploadavatar']['tmp_name'];
                if (move_uploaded_file($uploadedfile, $file)) {
                    if ($size > 1024*1024) {
                        $image = new SimpleImage();
                        $image->load($file);
                        $image->resizeToWidth(1024);
                        $image->save($file);
                    }
                    $image_final = $actual_image_name;
                } else {
                    echo "Fail upload folder with read access.";
                }
           
                $src= $file;
                $img = $actual_image_name;
                $source = $paths;
                $dest = $paths;
                optimize_img($img, $source, $dest, '80');
                $dest = "../uploads/images_thumb/";
                createThumbnail($src, $dest, '400', '400', $img, $ext);
            } else {
                echo "error";
            }
        } else {
            echo "Please select image..!";
        }


        /*Upload image and Cropping*/
        $allowedImageType = array("image/gif",   "image/jpeg",   "image/pjpeg",   "image/png",   "image/x-png"  );
    
        if ($_FILES['uploadavatar']["error"] > 0) {
            $output['error']= "Error in File";
            echo "error";
        } elseif (!in_array($_FILES['uploadavatar']["type"], $allowedImageType)) {
            $output['error']= "You can only upload JPG, PNG and GIF file";
            echo "error";
        } elseif (round($_FILES['uploadavatar']["size"] / 1024) > 4096) {
            $output['error']= "You can upload file size up to 4 MB";
            echo "error";
        } else {
            /*create directory with 777 permission if not exist - start*/
            createDir(IMAGE_SMALL_DIR);
            createDir(IMAGE_MEDIUM_DIR);
            /*create directory with 777 permission if not exist - end*/
            $path[0] = $paths.$actual_image_name;
            $file = pathinfo($_FILES['uploadavatar']['name']);
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
                    $image_medium= IMAGE_MEDIUM_DIR_DB . $fileNameNew;
                    $image_small= IMAGE_SMALL_DIR_DB . $fileNameNew2;

                    update_sql_arg('users', 'avatar', $image_medium, 'id', returnID());
                    update_sql_arg('users', 'avatar_thumb', $image_small, 'id', returnID());
                    $pid = select_doublearg('posts', 'avatar_status', '1', 'id_user', returnID(), 'pid');
                    update_sql_arg('posts', 'avatar_status', '0', 'pid', $pid);
                }
            }

            echo $image_medium.','.$image_final;
        }
    }
}
?>	
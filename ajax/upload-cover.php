<?php
include '../functions/redirect.php';
include('../includes/Class/SimpleImage.php');

/*defined settings - start*/
define('IMAGE_POST_DIR', '../uploads/images/');
define('IMAGE_POST_THUMB_DIR', '../uploads/images_thumb/');
define('IMAGE_SMALL_DIR', '../uploads/cover_thumb/');
define('IMAGE_MEDIUM_DIR', '../uploads/cover/');
define('IMAGE_SMALL_DIR_DB', 'uploads/cover_thumb/');
define('IMAGE_MEDIUM_DIR_DB', 'uploads/cover/');
define('IMAGE_SMALL_SIZE', 100);
define('IMAGE_MEDIUM_SIZE', 975);
/*defined settings - end*/

//Applying CSRF, XSS Protection
if (verify_token_general($name = $id_csrf)) {
    if (($_FILES["uploadcover"]["type"] == "image/png") || ($_FILES["uploadcover"]["type"] == "image/jpg") || ($_FILES["uploadcover"]["type"] == "image/jpeg")) {

    /*Check and Uploading image*/

        $actual_image_name="";
        $valid_formats = array("jpg", "png", "gif", "bmp","jpeg","PNG","JPG","JPEG","GIF","BMP");
        $imagename = $_FILES['uploadcover']['name'];
        $size = $_FILES['uploadcover']['size'];

        if (strlen($imagename)) {
            $ext = strtolower(getExtension($imagename));
            if (in_array($ext, $valid_formats)) {
                /*Upload Image Cover*/
                $actual_image_name = 'cover_'.rand(333, 999) . time() . ".".$ext;
                $file = IMAGE_MEDIUM_DIR.$actual_image_name;

                $uploadedfile = $_FILES['uploadcover']['tmp_name'];
                if (move_uploaded_file($uploadedfile, $file)) {
                    if ($size > 1024*1024) {
                        $image = new SimpleImage();
                        $image->load($file);
                        $image->resizeToWidth(1024);
                        $image->save($file);
                    }
                    $image_final = $actual_image_name;
                }
                $src= $file;
                $img = $actual_image_name;
                $source = IMAGE_MEDIUM_DIR;
                $dest = IMAGE_MEDIUM_DIR;
                optimize_img($img, $source, $dest, '80');
                $dest = IMAGE_SMALL_DIR;
                createThumbnail($src, $dest, '400', '400', $img, $ext);
                /**************************************/


                /*Make a copy for Image Post*/
                $image_name = basename('img_'.rand().time().'_'.uniqid().'_.'.$ext);
                $file_post = IMAGE_POST_DIR.$image_name;
                $src_post = IMAGE_MEDIUM_DIR.$actual_image_name;
                copy($src_post, $file_post);
                $dest = IMAGE_POST_THUMB_DIR;
                createThumbnail($src_post, $dest, '400', '400', $image_name, $ext);
                $image_post_final = $image_name;
                /***********************************/


                /*Update Cover Photo*/
                $cover = IMAGE_MEDIUM_DIR_DB.$image_final;
                $cover_thumb = IMAGE_SMALL_DIR_DB.$image_final;
                update_sql_arg('users', 'cover', $cover, 'id', returnID());
                update_sql_arg('users', 'cover_thumb', $cover_thumb, 'id', returnID());
                $pid = select_doublearg('posts', 'cover_status', '1', 'id_user', returnID(), 'pid');
                update_sql_arg('posts', 'cover_status', '0', 'pid', $pid);
                $px = '50%';
                $py = '50%';
                update_sql_arg('cover_position', 'position_x', $px, 'id_user', returnID());
                update_sql_arg('cover_position', 'position_y', $py, 'id_user', returnID());
                /***************************************/

                /**Final return**/
                echo $cover.','.$image_post_final;
            } else {
                echo "error";
            }
        } else {
            echo "Please select image..!";
        }
    }
}
?>  
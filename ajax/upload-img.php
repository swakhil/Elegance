<?php
include('../includes/Class/SimpleImage.php');
include('../functions/functions.php');

/*defined settings - start*/
$path = '../uploads/images/';
ini_set("memory_limit", "99M");
ini_set('post_max_size', '20M');
ini_set('max_execution_time', 600);
/*defined settings - end*/

//Applying CSRF, XSS Protection
if (verify_token_general($name = $id_csrf)) {
    $actual_image_name="";
    $valid_formats = array("jpg", "png", "gif", "bmp","jpeg","PNG","JPG","JPEG","GIF","BMP");
    if (isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST") {
        if (($_FILES["uploadfile"]["type"] == "image/png") || ($_FILES["uploadfile"]["type"] == "image/jpg") || ($_FILES["uploadfile"]["type"] == "image/jpeg") || ($_FILES["uploadfile"]["type"] == "image/gif")) {
            $imagename = $_FILES['uploadfile']['name'];
            $size = $_FILES['uploadfile']['size'];

            if (strlen($imagename)) {
                $ext = strtolower(getExtension($imagename));
                if (in_array($ext, $valid_formats)) {
                    $actual_image_name = basename('img_'.rand().time().'_'.uniqid().'_.'.$ext);
                    $file = $path.$actual_image_name;

                    $uploadedfile = $_FILES['uploadfile']['tmp_name'];
                
                    if (move_uploaded_file($uploadedfile, $file)) {
                        if ($size > 1024*1024) {
                            $image = new SimpleImage();
                            $image->load($file);
                            $image->resizeToWidth(1024);
                            $image->save($file);
                        }

                        echo $actual_image_name;
                    } else {
                        echo "Fail upload folder with read access.";
                    }
           
                    $src= $file;
                    $img = $actual_image_name;
                    $source = $path;
                    $dest = $path;
                    if ($ext != 'gif') {
                        optimize_img($img, $source, $dest);
                        $dest = "../uploads/images_thumb/";
                        createThumbnail($src, $dest, '400', '400', $img, $ext);
                    }
                } else {
                    echo "error";
                }
            } else {
                echo "Please select image..!";
            }
            exit;
        }
    }
}

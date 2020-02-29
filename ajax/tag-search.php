<?php
require '../functions/functions.php';

//Applying CSRF, XSS Protection
if (verify_token_general($name = $id_csrf)) {
    if ($_POST) {
        $q=$_POST['searchword'];
        $key=str_replace("@", "", $q);
        $data = search_data($key, $limit = '6');
        foreach ($data as $row) {
            ?>
<a href="#" class='addname' title='<?php echo $row['username']; ?>'>
<div class="display_box" align="left">
<img src="<?php echo $site_url.$row['avatar']; ?>" class="image-tag"/>
<?php echo $row['firstname']; ?> <?php echo $row['lastname']; ?> <br/>
</div>
</a>
<?php
        }
    }
}
?>
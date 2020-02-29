<?php
require '../functions/functions.php';

//Applying CSRF, XSS Protection
if (verify_token_general($name = $id_csrf)) {
    $key = trim(filter_input(INPUT_POST, "key_user", FILTER_SANITIZE_SPECIAL_CHARS));
    $search_friends = search_friends($key, $limit = '6');
    $data = $search_friends;
    foreach ($data as $row) {
        $cvid = trim(select_conversation(0, returnID(), $row['id'], 'cvid'));
        if ($cvid != '') {
            ?>
<li class="left clearfix cm_<?php echo $cvid; ?> <?php echo active_li_mess($row['id']); ?>" username="<?php echo $row['username']; ?>">
                     <span class="add-active" cvid="<?php echo $cvid; ?>" fullname="<?php echo select_sql_id($row['id'], 'fullname'); ?>" user-to="<?php echo $row['id']; ?>">
                        <span class="chat-img pull-left">
                         <img src="<?php echo $site_url.$row['avatar']; ?>" alt="User Avatar" class="img-circle">
                        </span>
                        <div class="chat-body clearfix">
                           <div class="header_sec">
                              <strong class="primary-font"><?php echo select_sql_id($row['id'], 'fullname'); ?></strong> <strong class="pull-right"></strong>
                           </div>
                        </div>
                        </span>
                     </li>
<?php
        }
    }
}
?>
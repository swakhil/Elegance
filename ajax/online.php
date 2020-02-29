<?php
include '../functions/functions.php';

//Applying CSRF, XSS Protection
if (verify_token_general($name = $id_csrf)) {
    if (isset($_SESSION['id'])) {
        $count_online = select_online('0', $count='true');
        $select_online = select_online('0', $count='false');
        if ($count_online != 0) {
            foreach ($select_online as $row) {
                $cvid = select_conversation(0, returnID(), $row['online_user'], 'cvid'); ?>
 	 	<span class="online_container" id="online_container<?php echo $row['online_user']; ?>"  cvid="<?php echo $cvid; ?>" data-fullname="<?php echo select_sql_id($row['online_user'], 'fullname'); ?>" data-id="<?php echo $row['online_user']; ?>" data-username="<?php echo select_sql_id($row['online_user'], 'username'); ?>">
         <a href="#" class="list-group-item online-user">
          <b class="connected-status">•</b>
          <img src="<?php echo $site_url.select_sql_id($row['online_user'], 'avatar_thumb'); ?>" class="img-chat img-thumbnail">
          <span class="chat-user-name"><?php echo select_sql_id($row['online_user'], 'fullname'); ?></span>
          </a>
        </span>
 	 	<?php
            }
        }


        $count_absent = select_online('1', $count='true');
        $select_absent = select_online('1', $count='false');
        if ($count_absent != 0) {
            foreach ($select_absent as $row) {
                $cvid = select_conversation(0, returnID(), $row['online_user'], 'cvid'); ?>
    <span class="online_container" id="online_container<?php echo $row['online_user']; ?>"  cvid="<?php echo $cvid; ?>" data-fullname="<?php echo select_sql_id($row['online_user'], 'fullname'); ?>" data-id="<?php echo $row['online_user']; ?>" data-username="<?php echo select_sql_id($row['online_user'], 'username'); ?>">
         <a href="#" class="list-group-item online-user">
          <b class="absent-status">•</b>
          <img src="<?php echo $site_url.select_sql_id($row['online_user'], 'avatar_thumb'); ?>" class="img-chat img-thumbnail">
          <span class="chat-user-name"><?php echo select_sql_id($row['online_user'], 'fullname'); ?></span>
          </a>
        </span>
    <?php
            }
        }
        if ($count_online == 0 && $count_absent == 0) {
            ?>
 	 	<br/>
 	 	<span class="online_container">
         <a href="#" class="list-group-item online-user">
          <span class="chat-user-name-o"><center>No recent user</center></span>
          </a>
        </span>
 	 	<?php
        }
    }
}

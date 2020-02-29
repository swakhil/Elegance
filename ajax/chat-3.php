<?php
include '../functions/functions.php';

//Applying CSRF, XSS Protection
if (verify_token_general($name = $id_csrf)) {
    $cvid = select_doublearg('chatting', 'id_session', returnID(), 'id_chat', '3', 'cvid');
    $id = select_doublearg('chatting', 'id_session', returnID(), 'id_chat', '3', 'id_user');

    //All Messages with flag read
    $make_read = update_sql_arg('messages', 'unread', '0', 'cvid_fk', $cvid);

    $count = select_message($cvid, true);
    $data_message = select_message($cvid);
    if ($count > 0) {
        foreach ($data_message as $row) {
            if (returnID() == $row['user_from']) {
                if ($row['hide_user_from'] == 0) {
                    ?>
                 <div class="row msg_container base_sent">
                        <div class="col-md-10 col-md-10-edit col-xs-10">
                            <div class="messages msg_sent">
                                <p><?php echo $row['message']; ?></p>
                                <time datetime=""><?php echo show_username(select_sql_id($row['user_from'], 'username')); ?> • <?php echo timeago($row['dates_send']); ?></time>
                            </div>
                        </div>
                        <div class="col-md-2 col-md-2-edit col-xs-2 avatar-edit">
                            <img src="<?php echo $site_url.select_sql_id($row['user_from'], 'avatar'); ?>" class=" img-responsive" alt="<?php echo select_sql_id($row['user_from'], 'fullname'); ?> avatar">
                        </div>
                    </div>
                    <?php
                }
            } else {
                if ($row['hide_user_to'] == 0) {
                    ?>
                    <div class="row msg_container base_receive">
                        <div class="col-md-2 col-md-2-edit col-xs-2 avatar-edit">
                            <img src="<?php echo $site_url.select_sql_id($row['user_from'], 'avatar'); ?>" class=" img-responsive" alt="<?php echo select_sql_id($row['user_from'], 'fullname'); ?> avatar">
                        </div>
                        <div class="col-md-10 col-md-10-edit col-xs-10">
                            <div class="messages msg_receive">
                                <p><?php echo $row['message']; ?></p>
                                <time datetime=""><?php echo show_username(select_sql_id($row['user_from'], 'username')); ?> • <?php echo timeago($row['dates_send']); ?></time>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            }
        }
    } else {
        ?>
  <li class="notification">
                           <div class="media">
                              <div class="media-body">
                                 <p class="notification-desc"><center><span class="primary-font">Start a chat with <?php echo select_sql_id($id, 'fullname'); ?> today!</span></center></p>
                              </div>
                           </div>
                        </li>
  <?php
    }
}
?>

<script type="text/javascript">

                var cvid = '<?php echo $cvid ; ?>';
                var data_id = '<?php echo $id ; ?>';
                var site_url = '<?php echo $site_url; ?>';
                var token = jQuery("#token_id").val();
                
                //Load Message Text Interval 
      intervalStart_3 = setTimeout(function(){
        $.ajax({
            type : "POST",
            url: site_url+"ajax/chat-3",
            data : {
                cvid : cvid,
                id : data_id,
                token : token
            },
            cache : false,
            success : function(data) {
              $('#chat-ajax-3').html(data);
            }
        });
              }, 2000)
</script>
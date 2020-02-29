<?php
$pid_share = $row['pid_share'];
$datas = select_post($pid_share);
$pid_check = select_post_id($pid_share, 'pid');
if (trim($pid_check) != '') {
    foreach ($datas as $rows) {
        ?>
<div class="box box-widget box-share" id="post-<?php echo $rows['pid']; ?>"> 
 <i class="pointer" id="pagination-<?php echo $rows['pid']; ?>"></i>
                    <div class="box-header with-border">
                      <div class="user-block">
                        <a href="<?php echo select_sql_id($rows['id_user'], 'username'); ?>">
                         <img class="img-circle" src="<?php echo $site_url.select_sql_id($rows['id_user'], 'avatar'); ?>" alt="User Image">
                        </a>
                        <span class="username"><a href="<?php echo select_sql_id($rows['id_user'], 'username'); ?>"><?php echo select_sql_id($rows['id_user'], 'firstname'); ?> <?php echo select_sql_id($rows['id_user'], 'lastname'); ?></a> <?php echo CheckAutoStatus($rows['pid']); ?></span>
                        <span class="description">
                         <a href="<?php echo select_sql_id($rows['id_user'], 'username'); ?>"><?php echo show_username(select_sql_id($rows['id_user'], 'username')); ?></a> - <?php echo get_timeago($rows['time_post']); ?>
                        </span>
                      </div>
                    </div>

                    <div class="box-body">
                    <p class="desc-text" id="desc-<?php echo $rows['pid']; ?>"><?php echo convert_links(nl2br($rows['texts'])); ?></p>
                     <?php echo ShowImage($rows['pid'], $rows['image_url']); ?>
                    </div>
                   </div><!--  end posts-->
                   <?php
    }
} elseif ($pid_check == '') {
    ?>
                   <div class="box box-widget box-share">
                    <div class="box-body">
                    <p class="desc-text">
                      <center class="dark-color">This content are no longer available.</center>
                    </p>
                    </div>
                   </div><!--  end posts-->
                      <?php
}
                 ?>
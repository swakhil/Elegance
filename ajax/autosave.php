<?php
include '../functions/functions.php';

//Applying CSRF, XSS Protection
if (verify_token_general($name = $id_csrf)) {
    if (isset($_SESSION['id'])) {
        $data = select_save_user('id', $limit = '5'); ?>
<div class="container autosuggest" >
    <div class="row">
        <div class="panel panel-default user_panel" id="panel-head">
            <div class="panel-heading" id="panel-head">
                <a href="#">
                  <h3 class="panel-title">
                   <span class="head-search"><i class="fa fa-search"></i> Your recent searches...</span>
                  </h3>
                </a>
            </div>
                <div class="table-container">
                    <table class="table-users table" border="0">
                        <tbody>
                        <?php
                        foreach ($data as $row) {
                            ?>
                           <tr id="shref" shref="<?php echo $site_url.select_sql_id($row['save'], 'username'); ?>">
                                <td align="left" class="img-search">
                                 <a href="<?php echo $site_url.select_sql_id($row['save'], 'username'); ?>">
                                    <img class="img-search" src="<?php echo $site_url.select_sql_id($row['save'], 'avatar'); ?>" alt="User Image"/>
                                  </a>
                                </td>
                                <td class="user-search">
                                     <a href="<?php echo $site_url.select_sql_id($row['save'], 'username'); ?>"><?php echo select_sql_id($row['save'], 'firstname'); ?> <?php echo select_sql_id($row['save'], 'lastname'); ?></a>
                                     <br>
                                     <a href="<?php echo $site_url.select_sql_id($row['save'], 'username'); ?>"><?php echo show_username(select_sql_id($row['save'], 'username')); ?>
                                     </a>
                                </td>
                                <td align="center">
                                </td>
                            </tr>
                           <?php
                        }
        if (save_count('id') == 0) {
            ?>
                             <p class="no-saved-search">You don't have recent searches. Start to search something.</p>
                           <?php
        } ?>
                        </tbody>
                    </table>
                </div>
        </div>

    </div>
</div>
<?php
    }
}
?>
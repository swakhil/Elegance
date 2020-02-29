<?php
include '../functions/functions.php';

//Applying CSRF, XSS Protection
if (verify_token_general($name = $id_csrf)) {
    if (isset($_POST['queryString']) && $_POST['queryString'] != '' && isset($_SESSION['id'])) {
        //Format and Sanitize
        $key = trim(filter_input(INPUT_POST, "queryString", FILTER_SANITIZE_STRING));
        $data = search_data($key); ?>
<div class="container autosuggest">
	<div class="row">
        <div class="panel panel-default user_panel" id="panel-head">
            <div class="panel-heading" id="panel-head">
                <a href="<?php echo $site_url; ?>search/<?php echo $key; ?>">
                 <h3 class="panel-title">
                  <span class="head-search"><i class="fa fa-search"></i>View More...</span>
                 </h3>
                </a>
            </div>
				<div class="table-container">
                    <table class="table-users table" border="0">
                        <tbody>
                        <?php
                        foreach ($data as $row) {
                            ?>
                           <tr id="shref" shref="<?php echo $site_url.$row['username']; ?>/1">
                                <td align="left" class="img-search">
                                 <a href="<?php echo $site_url.$row['username']; ?>/1">
                                    <img class="img-search" src="<?php echo $site_url.$row['avatar']; ?>" alt="User Image"/>
                                  </a>
                                </td>
                                <td class="user-search">
                                     <a href="<?php echo $site_url.$row['username']; ?>/1"><?php echo $row['firstname']; ?> <?php echo $row['lastname']; ?></a>
                                     <br>
                                     <a href="<?php echo $site_url.$row['username']; ?>/1"><?php echo show_username($row['username']); ?>
                                     </a>
                                </td>
                                <td align="center">
                                    
                                </td>
                            </tr>
                           <?php
                        }
        if (search_count($key) == 0) {
            ?>
                             <tr>
                                <td class="user-search" align="center">
                                     No result to show.
                                </td>
                            </tr>
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

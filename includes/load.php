 <div class="col-md-3">
                  <i class="pointer-id" id="page-<?php echo $row['fid']; ?>"></i>
                    <div class="contact-box center-version">
                      <a href="<?php echo $site_url.$row['username']; ?>" style="background-image:url('<?php echo $site_url.select_sql_id($row['id'], 'cover'); ?>'); background-position: <?php echo select_sqlarg('cover_position', 'id_user', $row['id'], 'position_x');?> <?php echo select_sqlarg('cover_position', 'id_user', $row['id'], 'position_y');?>;">
                        <img alt="image" class="img-circle follow-avatar" src="<?php echo $site_url.$row['avatar']; ?>">

                        <h3 class="m-b-xs fullname-follow">
                         <strong><?php echo $row['firstname'].$row['lastname']; ?></strong>
                        </h3>
                        <div class="font-bold username-follow"><?php echo show_username($row['username']); ?></div>
                      </a>
                      <div class="contact-box-footer">
                        <div class="m-t-xs ">
                          <a href="#" class="btn btn-xs btn btn-info  btn-circle"><i class="fa fa-comments"></i></a>
                          <a href="#" class="btn btn-xs btn btn-info  btn-circle"><i class="fa fa-user-plus"></i></a>
                        </div>
                      </div>
                    </div>
                  </div>

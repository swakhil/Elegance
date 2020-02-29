<?php
 if ($website_ads == '1') {
     ?>
<div class="box box-widget" id="post-0"> 
                    <div class="box-header with-border">
                      <div class="user-block">
                       <div class="dropdown float-drop-post">
                           <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="fa fa-ellipsis-h color-drop-icon-post"></span></a>
                        <ul class="dropdown-menu">
                          <li class="notification post-hide" id="post-hide-0">
                            <span>
                              <div class="media">
                                <div class="media-body">
                                  <p class="notification-desc">
                                    <strong>
                                      <span class="fa fa-times-circle dark-color"></span> Hide ads
                                    </strong>
                                    </p>
                                  </div>
                                </div>
                          </span>
                          </li>
                         </ul>
                       </div>
                        <span class="description" id="desc-sponsored">
                          <i class="fa fa-globe"></i> Sponsored
                        </span>
                      </div>
                    </div>

                    <div class="box-body">
                          <!-- Display Ads -->
                      <?php
                      if (trim($ads_options) == '1') {
                          echo display_own_ads('2');
                      } else {
                          echo html_entity_decode(display_ads('2'), ENT_QUOTES, 'UTF-8');
                      } ?>   
                     </div>
                   </div><!--  end posts-->
<?php
 }
?>
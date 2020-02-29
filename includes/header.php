<nav class="navbar navbar-white navbar-fixed-top" role="navigation">

   <div class="container">

      <!-- Brand and toggle get grouped for better mobile display -->

      <div>

         <ul class="nav navbar-nav navbar-left">

            <li>

               <a class="navbar-brand" href="<?php echo $site_url; ?>">

               <img height="30px" src="<?php echo $site_url.'admin/'.$site_logo; ?>"/>

               </a>

            </li>

            <li>

               <form type="get" action="<?php echo $site_url; ?>search/" onsubmit="return false;" role="search" class="navbar-form border-null" autocomplete="off">

                  <div class="input-group" id="search-group">

                     <input type="text" autocomplete="off" class="form-control search-style-input" id="search-input" placeholder="Search for people, trends, pages and groups" name="q">

                     <div class="input-group-btn">

                        <button class="btn btn-default" id="search-send" type="submit" onclick="window.location.href=this.form.action + this.form.q.value;"><i class="glyphicon glyphicon-search"></i></button>

                     </div>

                  </div>

               </form>

               <div id="reponse"></div>

            </li>

         </ul>

      </div>

      <!-- Collect the nav links, forms, and other content for toggling -->

      <div id="bs-example-navbar-collapse-1">

         <ul class="nav navbar-nav navbar-right">

            <li class="user-head-menu"><a href="<?php echo $site_url; ?><?php echo select_sql_id(returnID(), 'username'); ?>" id="top-head-image">

               <img src="<?php echo $site_url.select_sql_id(returnID(), 'avatar'); ?>" alt="" class="br-radius width-avatar">

               </a>

            </li>

            <li class="dropdown">

               <a href="#" class="dropdown-toggle" id="message-click" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">

               <i id="badge-mess-color" class="fa fa-comments size-comments <?php echo active_icon(count_global_message(returnID(), false)); ?>"></i>

               <span id="mess-count"><?php echo count_global_message(returnID(), true); ?></span>

               </a>

               <ul class="notifications dropdown-menu dropdown-menuxms">

                     <span id="ajax-load-message">

                     </span>

                     <h3 class="panel-title footer-notif">

                        <a href="<?php echo $site_url; ?>messages">

                        <span class="head-search"><i class="fa fa-comments"></i> View More...</span>

                        </a>

                     </h3>

               </ul>

            </li>

            <li class="dropdown">

               <a href="#" class="dropdown-toggle" id="notif-click" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">

               <i id="badge-notif-color" class="glyphicon glyphicon-globe <?php echo active_icon(notif_count(false)); ?>"></i>

               <span id="notification-count"><?php echo notif_count(true); ?></span>

               </a>

               <ul class="notifications dropdown-menu dropdown-menuxs">

                     <span id="ajax-load-notif">

                     </span>

                     <h3 class="panel-title footer-notif">

                        <a href="<?php echo $site_url; ?>user/notifications">

                        <span class="head-search" ><i class="fa fa-globe"></i> View More...</span>

                        </a>

                     </h3>

               </ul>

            </li>
            <!--
            <li class="dropdown">

               <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" id="tags-color">

               <i class="glyphicon glyphicon-tags" id="tags-color"></i>

               <input type="hidden" id="site_url" value="<?php echo $site_url; ?>">

               </a>

               <ul class="dropdown-menu dropdown-menuxxs">

                  <li class="notification">

                     <a href="<?php echo $site_url; ?>caring">

                     <div class="media">

                        <div class="media-body">

                           <p class="notification-desc"><strong>

                           <span class="fa fa-heartbeat dark-color"></span> Caring

                           </strong></p>

                        </div>

                     </div>

                     </a>

                  </li>

                  <li class="notification">

                     <a href="<?php echo $site_url; ?>cleanliness">

                        <div class="media">

                           <div class="media-body">

                              <p class="notification-desc"><strong>

                              <span class="fa fa-star dark-color"></span> Cleanliness

                              </strong></p>

                           </div>

                        </div>

                     </a>

                  </li>

                  <li class="notification">

                     <a href="<?php echo $site_url; ?>communitydevelopment">

                        <div class="media">

                           <div class="media-body">

                              <p class="notification-desc"><strong>

                              <span class="fa fa-users dark-color"></span> Community Development

                              </strong></p>

                           </div>

                        </div>

                     </a>

                  </li>

                  <li class="notification">

                     <a href="<?php echo $site_url; ?>conservation">

                        <div class="media">

                           <div class="media-body">

                              <p class="notification-desc"><strong>

                              <span class="fa fa-cloud dark-color"></span> Conservation

                              </strong></p>

                           </div>

                        </div>

                     </a>

                  </li>

                  <li class="notification">

                     <a href="<?php echo $site_url; ?>healthcare">

                        <div class="media">

                           <div class="media-body">

                              <p class="notification-desc"><strong>

                              <span class="fa fa-medkit dark-color"></span> Health Care

                              </strong></p>

                           </div>

                        </div>

                     </a>

                  </li>

                  <li class="notification">

                     <a href="<?php echo $site_url; ?>naturalcalamities">

                        <div class="media">

                           <div class="media-body">

                              <p class="notification-desc"><strong>

                              <span class="fa fa-exclamation-triangle dark-color"></span> Natural Calamities

                              </strong></p>

                           </div>

                        </div>

                     </a>

                  </li>

                  <li class="notification">

                     <a href="<?php echo $site_url; ?>supportdifferentlyabled">

                        <div class="media">

                           <div class="media-body">

                              <p class="notification-desc"><strong>

                              <span class="fa fa-wheelchair dark-color"></span> Support Differently Abled

                              </strong></p>

                           </div>

                        </div>

                     </a>

                  </li>

                  <li class="notification">

                     <a href="<?php echo $site_url; ?>womenempowerment">

                        <div class="media">

                           <div class="media-body">

                              <p class="notification-desc"><strong>

                              <span class="fa fa-female dark-color"></span> Women Empowerment

                              </strong></p>

                           </div>

                        </div>

                     </a>

                  </li>

               </ul>
               
            </li>
            -->
            <li class="dropdown">

               <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" id="caret-drop" >

               <i class="glyphicon glyphicon-chevron-down" id="caret-color"></i>

               <input type="hidden" id="site_url" value="<?php echo $site_url; ?>">

               </a>

               <ul class="dropdown-menu dropdown-menuxxs">

                        <li class="notification dropdown-menu-avatar" id="user-drop-li">

                          <a href="<?php echo $site_url; ?><?php echo select_sql_id(returnID(), 'username'); ?>" >

                           <div class="media"> <!--id="top-head-image"-->

                              <div class="media-body">

                                 <p class="notification-desc"><strong>

                                 <img src="<?php echo $site_url.select_sql_id(returnID(), 'avatar'); ?>" alt="" class="br-radius width-avatar" style="margin: 0; padding: 0; display: inline" > <?php echo select_sql_id(returnID(), 'username'); ?>

                                 </strong></p>

                              </div>

                           </div>

                           </a>

                         </li>



                         <li class="notification" id="message-drop-li">

                           <a href="<?php echo $site_url; ?>messages">

                           <div class="media">

                              <div class="media-body">

                                 <p class="notification-desc"><strong>

                                 <span class="fa fa-comments dark-color"></span> Messages

                                 </strong></p>

                              </div>

                           </div>

                           </a>

                         </li>

                         <li class="notification" id="notif-drop-li">

                           <a href="<?php echo $site_url; ?>user/notifications">

                           <div class="media">

                              <div class="media-body">

                                 <p class="notification-desc"><strong>

                                 <span class="fa fa-globe dark-color"></span> Notifications

                                 </strong></p>

                              </div>

                           </div>

                           </a>

                         </li>

                         <li class="notification">

                           <a href="<?php echo $site_url; ?>user/policy">

                           <div class="media">

                              <div class="media-body">

                                 <p class="notification-desc"><strong>

                                 <span class="fa fa-user-secret dark-color"></span> Privacy Policy

                                 </strong></p>

                              </div>

                           </div>

                           </a>

                         </li>
                         
                         <li class="notification">

                           <a href="<?php echo $site_url; ?>user/settings">

                           <div class="media">

                              <div class="media-body">

                                 <p class="notification-desc"><strong>

                                 <span class="fa fa-cog dark-color"></span> Settings

                                 </strong></p>

                              </div>

                           </div>

                           </a>

                         </li>

                         <?php
                         if (is_already_in_use('email', select_sql('email'), 'admin')) {
                             ?>
                         <li class="notification">

                           <a href="<?php echo $site_url; ?>user/switch-admin">

                           <div class="media">

                              <div class="media-body">

                                 <p class="notification-desc"><strong>

                                 <span class="fa fa-caret-right dark-color"></span> Go to Admin

                                 </strong></p>

                              </div>

                           </div>

                           </a>

                         </li>
                         <?php
                         }
                         ?>



                         <li class="notification">

                           <a href="<?php echo $site_url; ?>user/logout">

                           <div class="media">

                              <div class="media-body">

                                 <p class="notification-desc"><strong>

                                 <span class="fa fa-sign-out dark-color"></span> Logout

                                 </strong></p>

                              </div>

                           </div>

                           </a>

                         </li>

               </ul>

            </li>

         </ul>

      </div>

      <!-- /.navbar-collapse -->

   </div>

   <!-- /.container-fluid -->

</nav>

<span id="ajax-header-online"></span>

<span id="data-cvid-js"></span>

<?php include 'chat-container.php'; ?>
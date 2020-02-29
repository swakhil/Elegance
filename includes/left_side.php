        <!-- left links -->



        <!-- sidebar -->

      <div class="column col-sm-2 col-xs-1 sidebar-offcanvas hidden-xs screen-993" id="sidebar">

          <div class="profile-nav">

            <div class="widget">

              <div class="widget-body">



              <div id="element">

                  <a href="<?php echo $site_url.select_sql_id(returnID(), 'username'); ?>" id="element-inner">

                      <img src="<?php echo $site_url.select_sql_id(returnID(), 'avatar'); ?>" alt="" id="unblur-img" >

                  </a>

                   <a href="<?php echo $site_url.select_sql_id(returnID(), 'username'); ?>"><h1 class="shadow"><?php echo truncate(select_sql('firstname').' '.select_sql('lastname'), '11');?></h1></a>

                  <a href="<?php echo $site_url.select_sql_id(returnID(), 'username'); ?>"><p class="shadow"><?php echo truncate(show_username(select_sql('username')), '22'); ?></p></a>

                </div>



                <div class="user-heading round" id="blur-img" style="background:url(<?php echo $site_url.returnBlurImg(select_sql_id(returnID(), 'avatar')); ?>) no-repeat center center;">
                  <span class="blur-picture-overlay"></span>

                </div>

              </div>

            </div>

          </div>



         

              <span id="navi-menu">

                <ul class="nav" id="lg-menu">

                    <li class="<?php echo show_active_left($page, $active='active0'); ?>"><a href="<?php echo $site_url; ?>"><i class="fa fa-newspaper-o"></i> NewsFeed</a></li>

                    <li class="<?php echo show_active_left($page, $active='active1'); ?>"><a href="<?php echo $site_url; ?>messages"><i class="fa fa-comments"></i> Messenger</a></li>

                    <li class="top-shortcuts"><a href="#"><b>Favorites</b></a></li>

                    <li class="<?php echo show_active_left($page, $active='active2'); ?>"><a href="<?php echo $site_url; ?>user/saved"><i class="fa fa-bookmark"></i> Saved</a></li>

                    <li class="<?php echo show_active_left($page, $active='active3'); ?>"><a href="<?php echo $site_url.select_sql('username'); ?>/photos"><i class="fa fa-image"></i> Photos</a></li>

                    <li class="<?php echo show_active_left($page, $active='active4'); ?>"><a href="<?php echo $site_url; ?>user/recommended"><i class="fa fa-user"></i> Find Friends</a></li>

                    <!--<li><a href="#" id="music-box"><i class="fa fa-music"></i> Music Box</a></li>-->

                    <li class="<?php echo show_active_left($page, $active='active5'); ?>"><a href="<?php echo $site_url; ?>user/support" ><i class="fa fa-usd"></i> Support this Cause</a></li>

                </ul>

                <ul class="list-unstyled" id="sidebar-footer">

                    

                </ul>

            

            </span>

           </div>

          <!-- /sidebar -->

           <div class="col-md-3 visible-xs visible-sm md-xs-top"></div>

     <!-- end left links -->

      

        <!-- center posts -->

        <?php

        if ($page == 'settings') {
            echo '<div class="col-md-9">';
        } else {
            echo '<div class="col-md-6">';
        }

        ?>

        
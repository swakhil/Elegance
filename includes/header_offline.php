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

         </ul>

      </div>

      <!-- Collect the nav links, forms, and other content for toggling -->

      <div id="bs-example-navbar-collapse-1">

         <ul class="nav navbar-nav navbar-right">

            <li>
               <a href="<?php echo $site_url; ?>login">

               <i id="badge-notif-color" class="fa fa-sign-in"></i> Login

               </a>
            </li>

            <li>

               <a href="<?php echo $site_url; ?>signup">

               <span class="fa fa-user-plus"></span> Signup

               <input type="hidden" id="site_url" value="<?php echo $site_url; ?>">

               </a>

            </li>

         </ul>

      </div>

      <!-- /.navbar-collapse -->

   </div>

   <!-- /.container-fluid -->

</nav>

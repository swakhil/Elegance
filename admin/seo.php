<?php

// +------------------------------------------------------------------------+
// | @Team author : Smart Xplorer (smartxplorer)
// | @Team author email: smartxplorerdev@gmail.com
// +------------------------------------------------------------------------+
// | Elegance - The Elegant Social Network Platform
// | Copyright (c) 2017 Elegant. All rights reserved.
// +------------------------------------------------------------------------+

   $page = 'seo';
   include 'inc/header.php';
       ?>
<div class="content">
   <div class="container-fluid">
      <div class="row">
         <div class="col-md-12">
            <div class="card">
               <div class="header">
                  <h4 class="title">Website SEO</h4>
               </div>
                <div class="content">
                 <div class="container-fluid">
                  <hr/>
                  <p class="col-sm-12" id="details"></p>
                  <form method="POST" action="">
                     <div class="row">
                        <div class="col-md-12">
                           <div class="form-group">
                              <label>Enter Meta Tags | Enter code in website header</label>
                                <pre><code class="" contenteditable="true" spellcheck="false" autocorrect="false" placeholder="Website Meta Tags" id="seo"><?php echo $meta; ?></code></pre>
                           </div>
                        </div>
                     </div>

                     <input type="hidden" name="token" id="token" value="<?php echo $_SESSION[$id_csrf.'_token'] ; ?>">
                     <button type="submit" name="submit_seo" id="submit_seo" class="btn btn-info btn-fill pull-right">Update SEO Meta Tags</button>
                     <div class="clearfix"></div>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<?php
   include 'inc/footer.php';
   ?>
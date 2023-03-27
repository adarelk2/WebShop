
      <?php require_once $_SERVER['DOCUMENT_ROOT']."/include/header.php";?>
      <?php require_once $_SERVER['DOCUMENT_ROOT']."/config/home.php";?>
      <style>
         .carousel-control-next:hover, .carousel-control-prev:hover
         {
            color:orange!important;
            background-color:#fff!important;
            border:1px solid orange!important;
         }
      </style>
      <section class="banner_main">
         <div id="banner1" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
               <li data-target="#banner1" data-slide-to="0" class="active"></li>
               <li data-target="#banner1" data-slide-to="1"></li>
               <li data-target="#banner1" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner mt-5">
               <div class="carousel-item active">
                  <div class="container">
                     <div class="carousel-caption">
                        <div class="text-bg">
                           <h1 style="color:orange;" class="p-0"> Flipper Zero</h1><span style='font-size:2em;color:rgb(43, 43, 43);'>Multi-tool Device for Geeks</span>
                           <figure><img src="images/Product4.png" style='height:200px!important;' alt="#"/></figure>
                           <a class="read_more" style='color:#fff;background-color:orange; border:0px solid;' href="shop.php">Order Now</a>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <!-- <a class="carousel-control-prev" href="#banner1" role="button" data-slide="prev">
            <i class="fa fa-arrow-left" aria-hidden="true"></i> -->
            </a>
            <!-- <a class="carousel-control-next" href="#banner1" role="button" data-slide="next">
            <i class="fa fa-arrow-right" aria-hidden="true"></i> -->
            </a>
         </div>
      </section>
      <!-- end banner -->
      <!-- about section -->
      <div class="about">
         <div class="container">
            <div class="row d_flex">
               <div class="col-md-5">
                  <div class="about_img">
                     <figure><img src="images/Product.jpeg" alt="#"/></figure>
                  </div>
               </div>
               <div class="col-md-7">
                  <div class="titlepage">
                     <h2><?php echo $line[0];?></h2>
                     <p><?php echo $line[1];?></p>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- about section -->
      <!-- Our  Glasses section -->
      <div class="glasses">
         <div class="container">
            <div class="row">
               <div class="col-md-10 offset-md-1">
                  <div class="titlepage">
                     <h2><?php echo $line[2];?></h2>
                     <p><?php echo $line[3];?>
                     </p>
                  </div>
               </div>
            </div>
         </div>
         <div class="container-fluid items_list">
           
         </div>

      <?php require_once $_SERVER['DOCUMENT_ROOT']."/include/footer.php";?>
   </body>

   <script src="/js/Application/home.js?<?php echo rand(9999,455555);?>" type='module'></script>
</html>


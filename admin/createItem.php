<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/db_config.php';
require_once $_SERVER['DOCUMENT_ROOT']."/include/header.php";
?>

<section class="banner_main">
         <div id="banner1" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
               <li data-target="#banner1" data-slide-to="0" class="active"></li>
               <li data-target="#banner1" data-slide-to="1"></li>
               <li data-target="#banner1" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
               <div class="carousel-item active">
                  <div class="container">
                     <div class="carousel-caption">
                        <div class="text-bg">
                           <h1> <span style="color:orange;">Welcome <br></span>To Our Sunglasses</h1>
                           <figure><img src="/images/Product2.png" alt="#"/></figure>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="carousel-item">
                  <div class="container">
                     <div class="carousel-caption">
                        <div class="text-bg">
                           <h1> <span  style="color:orange;">Welcome <br></span>To Our Sunglasses 3</h1>
                           <figure><img src="/images/Product4.png" alt="#"/></figure>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <a class="carousel-control-prev" href="#banner1" role="button" data-slide="prev">
            <i class="fa fa-arrow-left" aria-hidden="true"></i>
            </a>
            <a class="carousel-control-next" href="#banner1" role="button" data-slide="next">
            <i class="fa fa-arrow-right" aria-hidden="true"></i>
            </a>
         </div>
      </section>
      <!-- end banner -->
      <!-- about section -->

      <!-- about section -->
      <!-- Our  Glasses section -->
      <?php require_once $_SERVER['DOCUMENT_ROOT']."/include/adminNavbar.php";?>

      <script src="/js/Application/admin/createItem.js" type=module></script>
<?php
require_once $_SERVER['DOCUMENT_ROOT']."/include/footer.php";

?>
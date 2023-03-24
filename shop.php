      <?php require_once $_SERVER['DOCUMENT_ROOT']."/include/header.php";?>
      <?php require_once $_SERVER['DOCUMENT_ROOT']."/config/home.php";?>

      <section class="banner_main">
        
      </section>

      <div class="glasses">
         <div class="container-fluid ">
            <h1 class="text-center">Filter by categories</h1>
            <div class="d-flex col-3 mb-5 mx-auto justify-content-around flex-wrap" id="categoriesBTN">
   
            </div>
           <div class="items_list"></div>
         </div>

         <?php require_once $_SERVER['DOCUMENT_ROOT']."/include/footer.php";?>

      <script src="js/jquery.min.js"></script>
      <script src="js/popper.min.js"></script>
      <script src="js/bootstrap.bundle.min.js"></script>
      <script src="js/jquery-3.0.0.min.js"></script>
      <!-- sidebar -->
      <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
      <script src="js/custom.js"></script>
   </body>

   <script src="/js/Application/shop.js?<?php echo rand(9999,455555);?>" type='module'></script>
</html>


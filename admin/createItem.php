<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/db_config.php';
require_once $_SERVER['DOCUMENT_ROOT']."/include/header.php";
?>

<section class="banner_main">
         <div id="banner1" class="carousel slide" data-ride="carousel">
         </div>
      </section>
      <!-- end banner -->
      <!-- about section -->

      <!-- about section -->
      <!-- Our  Glasses section -->
      <?php require_once $_SERVER['DOCUMENT_ROOT']."/include/adminNavbar.php";?>

      <script src="/js/Application/admin/createItem.js?<?php echo rand(9999,455555);?>" type=module></script>
<?php
require_once $_SERVER['DOCUMENT_ROOT']."/include/footer.php";

?>
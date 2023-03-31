<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/db_config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/admin.php';
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
        <div class="container mt-4">
            <form method="POST">
                <div class="form-group">
                    <label for="Username">Username: </label>
                    <input type="text" class="form-control" id="Username" name="Username">
                </div>

                <div class="form-group">
                    <label for="Password">Password: </label>
                    <input type="text" class="form-control" id="Password" name="Password">
                </div>

                <div class="mt-2 text-center mb-2">
                    <input type="submit" value="Login" name="Login" class="btn btn-primary">
                </div>
            </form>
            <?php
                if(isset($_POST['Login']))
                {
                    if($_POST['Username'] == ADMIN_USERNAME && $_POST['Password'] == ADMIN_PASSWORD)
                    {
                        $_SESSION['user'] = array("rule"=>2);
                        echo "<script>location.replace('/admin');</script>";
                    }
                    else
                    {
                        echo "<font color=red>Username or password is invalid.</font>";
                    }
                }
     
            ?>
        </div>
      <!-- about section -->
      <!-- Our  Glasses section -->

<?php
require_once $_SERVER['DOCUMENT_ROOT']."/include/footer.php";

?>
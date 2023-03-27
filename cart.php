      <?php require_once $_SERVER['DOCUMENT_ROOT']."/include/header.php";?>
      <?php require_once $_SERVER['DOCUMENT_ROOT']."/config/home.php";?>

      <section class="banner_main">
        
      </section>

      <div class="glasses">
         <div class="container-fluid ">
            <h1 class="text-center">Your cart:</h1>
            <div class="d-flex justify-content-around col-12 mx-auto flex-wrap">
               <div class="items_list mb-5 col-md-4 col-12 order-2 order-md-1"></div>
               <div class="customer_details col-md-7 col-12 order-1 order-md-2">
                  <div class="form-group">
                     <label for="FullName">Full Name</label>
                     <input type="text" class="form-control" id="FullName" placeholder="Enter your full name">
                  </div>
                  <div class="form-group">
                     <label for="Email">Email</label>
                     <input type="email" class="form-control" id="Email" placeholder="Enter your email address">
                  </div>
                  <div class="form-group">
                     <label for="Telegram">Telegram</label>
                     <input type="text" class="form-control" id="Telegram" placeholder="Enter your telegram ">
                  </div>
                  <div class="form-group">
                     <label for="Country">Country</label>
                     <select class="form-control" id="Country">
                        <option value="">-- Select a country --</option>
                        <option value="isr">Israel</option>
                        <option value="usa">USA</option>
                        <option value="canada">Canada</option>
                        <option value="uk">UK</option>
                        <option value="australia">Australia</option>
                     </select>
                  </div>
                  <div class="form-group">
                     <label for="City">City</label>
                     <input type="text" class="form-control" id="City" placeholder="Enter your city">
                  </div>
                  <div class="form-group">
                     <label for="Street">Street Address</label>
                     <input type="text" class="form-control" id="Street" placeholder="Enter your street address">
                  </div>
               </div>
            </div>
            
            <div class="text-center mb-3">
               <button class="btn btn-warning" id="createOrder"> Pay with BTC</button>
            </div>
         </div>
      </div>
         <?php require_once $_SERVER['DOCUMENT_ROOT']."/include/footer.php";?>
   </body>

   <script src="/js/Application/cart.js?<?php echo rand(9999,455555);?>" type='module'></script>
</html>


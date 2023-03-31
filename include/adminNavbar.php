<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/API/consts/user.php';
if(!isset($_SESSION['user']) || (isset($_SESSION['user']) && $_SESSION['user']['rule'] != 2))
{
   echo "<script>location.replace('/admin/login.php');</script>";
}
?>

<div class="glasses">
         <div class="container row d-flex align-items-start flex-wrap justify-content-around col-12 mb-3">
            <div class="col-3 row flex-wrap" style='background-color:gray;color:#fff;'>
                <div class="col-12 p-2 text-center"><a href='index.php'>Orders Log</a></div>
                <div class="col-12 p-2 text-center"><a href='createCategory.php'>Create New Category</a></div>
                <div class="col-12 p-2 text-center"><a href='editCategories.php'>Edit Categories</a></div>
                <div class="col-12 p-2 text-center"><a href='createItem.php'>Create New Item</a></div>
                <div class="col-12 p-2 text-center"><a href='editItems.php'>Edit Items</a></div>
                <div class="col-12 p-2 text-center"><a href='logout.php'>Logout</a></div>

            </div>
            <div class="col-8 page">

            </div>
         </div>
           
     </div>
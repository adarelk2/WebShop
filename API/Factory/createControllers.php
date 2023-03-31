<?php
class CreateControllers
{
 private $user = [];
 function __construct($_user)
 {
    $this->user = $_user;
 }
 
 function execute()
 {
   switch($this->user['rule'])
   {
      case USER_MANAGER:
         $storageOfControllers = array("items"=>"Items_Controller", "categories"=>"Categories_Controller", 
         "orders"=>"Orders_Controller", "itemsManager"=>"ItemsManager_Controller", "categoriesManager"=>"CategoriesManager_Controller");
         break;
      default:
      $storageOfControllers = array("items"=>"Items_Controller", "categories"=>"Categories_Controller", "orders"=>"Orders_Controller");
      case USER_NORMAL:
         break;
   }

    return $storageOfControllers;
 }
}
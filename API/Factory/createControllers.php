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
   $storageOfControllers = array("items"=>"Items_Controller", "categories"=>"Categories_Controller", "orders"=>"Orders_Controller");
   switch($this->user['rule'])
   {
      case USER_MANAGER:
         $storageOfControllers = array("items"=>"Items_Controller", "categories"=>"Categories_Controller", "orders"=>"Orders_Controller", "itemsManager"=>"ItemsManager_Controller");
         break;
      default:
      case USER_NORMAL:
         break;
   }

    return $storageOfControllers;
 }
}
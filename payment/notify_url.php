<?php
ini_set('display_errors', 1);

require_once $_SERVER['DOCUMENT_ROOT'] . '/config/db_config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/API/consts/orders.php';

$order = $con->query("SELECT * FROM orders where invoice_ext = '$_REQUEST[id]'")->fetch_assoc();

if($order['id'])
{
    $con->query("UPDATE `orders` SET `status` = $_REQUEST[status_code] WHERE `orders`.`id` = $order[id]");
}

session_destroy();
?>
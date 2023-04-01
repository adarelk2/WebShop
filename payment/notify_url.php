<?php
ini_set('display_errors', 1);

require_once $_SERVER['DOCUMENT_ROOT'] . '/config/db_config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/orders.php';

// Prepare the SQL statement with a placeholder for the user input
$stmt = $con->prepare("SELECT * FROM orders where invoice_ext = ?");
$stmt->bind_param("s", $_REQUEST['id']); // Bind the user input to the placeholder
$stmt->execute();
$order = $stmt->get_result()->fetch_assoc();

if($order['id'])
{
    // Prepare the SQL statement with placeholders for the user inputs
    $stmt = $con->prepare("UPDATE `orders` SET `status` = ? WHERE `orders`.`id` = ?");
    $stmt->bind_param("ii", $_REQUEST['status_code'], $order['id']); // Bind the user inputs to the placeholders
    $stmt->execute();
}

session_destroy();
?>

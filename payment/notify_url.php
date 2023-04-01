<?php
ini_set('display_errors', 1);

require_once $_SERVER['DOCUMENT_ROOT'] . '/config/db_config.php';
$json = json_encode($_REQUEST);
$con->query("INSERT into orders(response_json) VALUES('$json')");
session_destroy();
?>
<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/db_config.php';
session_destroy();
echo "<script>location.replace('/');</script>";

?>
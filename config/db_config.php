<?php
if (!isset($_SESSION)) 
{
    $lifetime=36000;
    session_set_cookie_params($lifetime);
    session_start();
}

$DATABASE_HOST = "localhost";
$DATABASE_USER = "root";
$DATABASE_PASS = "root";
$DATABASE_NAME = "WebShop";

$con = new mysqli($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
$con->set_charset("utf8");
?>
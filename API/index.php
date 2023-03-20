<?php
ini_set('display_errors', 1);

require_once $_SERVER['DOCUMENT_ROOT'] . "/API/classes/Response.php";
require_once $_SERVER['DOCUMENT_ROOT'] . '/API/Application.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/API/classes/Controller.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/API/classes/DB.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/API/classes/Model.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/DB/db_config.php';

$response = new Response();
$app = new App($_REQUEST['controller'], $_REQUEST['method'], $_REQUEST['params']);
$result = $app->execute();

echo $response->setState($result['state'])->setMsg($result['msg'])->renderToEncode();
?>
<?php
ini_set('display_errors', 0);
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/db_config.php';

require_once $_SERVER['DOCUMENT_ROOT'] . "/API/classes/Response.php";
require_once $_SERVER['DOCUMENT_ROOT'] . '/API/classes/Application.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/API/classes/Controller.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/API/classes/DB.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/API/classes/Model.php';

require_once $_SERVER['DOCUMENT_ROOT'] . '/API/consts/api_wallet.php';

$response = new Response();
$app = new App($_REQUEST['controller'], $_REQUEST['method'], $_REQUEST['params']);
$result = $app->execute();

echo $response->setState($result['state'])->setMsg($result['msg'])->renderToEncode();
?>
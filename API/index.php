<?php
ini_set('display_errors', 0);
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/db_config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/api_wallet.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/user.php';

require_once $_SERVER['DOCUMENT_ROOT'] . '/API/Factory/createControllers.php';

require_once $_SERVER['DOCUMENT_ROOT'] . "/API/classes/Response.php";
require_once $_SERVER['DOCUMENT_ROOT'] . '/API/classes/Application.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/API/classes/FileUpload.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/API/controllers/Controller.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/API/classes/DB.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/API/models/Model.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/API/classes/TimeHelper.php';

if(isset($_FILES) && count ($_FILES))
{
    $_REQUEST['params'] = $_REQUEST;
    $_REQUEST['params']['files'] = $_FILES;
    unset($_REQUEST['params']['controller']);
    unset($_REQUEST['params']['method']);
}

$response = new Response();
$app = new App($_REQUEST['controller'], $_REQUEST['method'], $_REQUEST['params']);
$result = $app->execute();

echo $response->setState($result['state'])->setMsg($result['msg'])->renderToEncode();
?>
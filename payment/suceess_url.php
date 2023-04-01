<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/db_config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/api_wallet.php';

    $curl = curl_init();
    $json_wallet = json_encode(array("api_key"=>API_BTC_KEY, "password"=>API_BTC_PASSWORD, "invoice_id"=>"BTC005"));
    curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://coinremitter.com/api/v3/BTC/get-invoice',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS =>$json_wallet,
    CURLOPT_HTTPHEADER => array(
        'Content-Type: application/json',
        'Cookie: coinremitter=y8OhhgAGyEpWoAWC898W76LwqReDctaCZvqb52mx'
    ),
    ));

    $response = json_decode(curl_exec($curl), true);

    echo "<pre>";
    echo "<script>location.replace('".$response['data']['url']."');</script>";
    print_r($response);
?>
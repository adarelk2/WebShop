<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/API/classes/PaymentRequest.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/API/classes/BTC_Payment.php';

class CreatePaymentRequest
{
    private $typeOfPayment = false;
    private $price;
    private $_items = [];
    private $customerDetails = [];
    
    function __construct($_type, $_items, $_customerDetails)
    {
        $this->typeOfPayment = $_type;
        $this->items = $_items;
        $this->customerDetails = $_customerDetails;
    }

    function create()
    {
        switch($this->typeOfPayment)
        {
            case "BTC":
                return new BTC_Payment($this->items);
                break;
            default:
            break;
        }
    }
}
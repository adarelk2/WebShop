<?php
abstract class PaymentRequest
{
    private $customerDetails = [];
    protected $items;

    public $errors = [];
    public $state = false;
    public $url_payment = "";
    public $invoice_ext = "";
    public $invoice_int = "";
    public $msg = array();

    abstract public function createJsonForAPI($_price);
    abstract public function execute();
    
    function createPriceInvoice()
    {
        $price = 0;
        foreach($this->items as $item)
        {
            $price = $price + ($item['price'] * $item['count']);
        }

        return $price;
    }
}

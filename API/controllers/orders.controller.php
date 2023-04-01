<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/API/Factory/CreatePaymentRequest.php";

class Orders_Controller extends Controller
{
    public $params = "";
    
    function __construct($_params) 
    {
        $this->params = $_params;
        parent::__construct("orders.model"); 
    }

    function getOrders()
    {
        if(!count($this->params))
        {
            return $this->model->getLastOrders();
        }
        else
        {
            return $this->model->filter($this->params);
        }
    }

    function createOrder()
    {
        $response = $this;

        $IP_Client = $_SERVER['REMOTE_ADDR'];
        $lastOrdersByIP = $this->model->filter(array("ip"=>$IP_Client));
        $timeHelper = new TimeHelper(time());
        if(count($lastOrdersByIP) && $timeHelper->minutesPassed($lastOrdersByIP[0]['created_at']) < 5)
        {
            array_push($this->errors, "Error, please try again later");
        }
        else
        {   
            $this->setModel("items.model");
    
            $items = $this->model->getItemsByCart(array_keys($this->params['items']));

            $createPayment = new CreatePaymentRequest("BTC", $this->createItemsInvocie($items, $this->params['items']), $this->params['customerDetails']);
            $payment = $createPayment->create();
            $payment->execute();
            if(empty($payment->errors))
            {
                $this->setModel("orders.model");

                $_SESSION['invoice_id'] = $payment->invoice_ext;
                
                $this->model->addNewOrderToDatabase($payment, $payment->invoice_ext, $payment->invoice_int, 
                $this->params['customerDetails'], $this->params['items']);
    
                $response = $payment->url_payment;
            }
            else
            {
                $this->errors = $payment->errors;
            }
        }
        return $response;
    }

    function createItemsInvocie($_items, $_itemsFromCart)
    {
        foreach($_items as $key=>$item)
        {
            $_items[$key]["count"] = $_itemsFromCart[$item['id']];
        }

        return $_items;
    }
}
?>
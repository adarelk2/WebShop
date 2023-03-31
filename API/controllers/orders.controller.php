<?php
class Orders_Controller extends Controller
{
    public $params = "";
    
    function __construct($_params) 
    {
        $this->params = $_params;
        parent::__construct("orders.model"); 
    }

    function createOrder()
    {
        $response = $this;

        $IP_Client = $_SERVER['REMOTE_ADDR'];
        $lastOrdersByIP = $this->model->filter(array("ip"=>$IP_Client));
        $timeHelper = new TimeHelper(time());
        if(count($lastOrdersByIP) && $timeHelper->hoursPassed($lastOrdersByIP[0]['created_at']) < LAST_HOUR)
        {
            array_push($this->errors, "Error, please try again later");
        }
        else
        {
            $url='https://bitpay.com/api/rates'; 
            $json=json_decode( file_get_contents( $url ) ); 
            $dollar=$btc=0; 
            
            foreach( $json as $obj ){ 
                  if( $obj->code=='USD' )$btc=$obj->rate; 
            } 
            
            $this->setModel("items.model");
    
            $items = $this->model->getItemsByCart(array_keys($this->params['items']));
            
            $price = $this->createPrice($items, $this->params['items']) / $btc;
    
            $jsonForAPI = $this->createJsonForAPI($price);
    
            $createPaymentRequest = $this->createPaymentAPI($jsonForAPI);
            if($createPaymentRequest['data']['url'])
            {
                $this->setModel("orders.model");
                $_SESSION['invoice_id'] = $createPaymentRequest['data']['invoice_id'];
                $this->model->addNewOrderToDatabase($createPaymentRequest, $createPaymentRequest['data']['id'], $createPaymentRequest['data']['invoice_id'], 
                $this->params['customerDetails'], $this->params['items']);
    
                $response = $createPaymentRequest['data']['url'];
            }
            else
            {
                array_push($this->errors, "Request payment failed.");
            }
        }
        return $response;
    }

    function createPrice($_items, $_itemsFromCart)
    {
        $price = 0;
        foreach($_items as $item)
        {
            $price = $price + ($item['price'] * $_itemsFromCart[$item['id']]);
        }

        return $price;
    }

    function createJsonForAPI($_price)
    {
        return json_encode(array("api_key"=>API_BTC_KEY, "password"=>API_BTC_PASSWORD, "amount"=>round($_price, 8),
         "notify_url"=>notify_url, "suceess_url"=>suceess_url, "fail_url"=>fail_url));
    }

    function createPaymentAPI($_json)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://coinremitter.com/api/v3/BTC/create-invoice',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS =>$_json,
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json',
            'Cookie: coinremitter=cqYAT020X1P2sxPzWzWkvYtbgLYTA7Z7K0mFPQSa'
        ),
        ));

        return json_decode(curl_exec($curl), true);
    }
}
?>
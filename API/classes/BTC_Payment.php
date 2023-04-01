<?php
class BTC_Payment extends PaymentRequest
{
    private $btc;
    public function __construct($_items)
    {
        $this->items= $_items;

        $url='https://bitpay.com/api/rates'; 
        $json=json_decode( file_get_contents( $url ) ); 
        $dollar=$btc=0; 
        
        foreach( $json as $obj ){ 
              if( $obj->code=='USD' )$btc=$obj->rate; 
        } 
        
        $this->btc = $btc;
    }

    function createPriceInvoice()
    {
        return parent::createPriceInvoice() / $this->btc;
    }

    public function createJsonForAPI($_price)
    {
        return json_encode(array("api_key"=>API_BTC_KEY, "password"=>API_BTC_PASSWORD, "amount"=>round($_price, 8),
         "notify_url"=>notify_url, "suceess_url"=>suceess_url, "fail_url"=>fail_url));
    }

    public function execute()
    {
        $price = $this->createPriceInvoice();
        
        $json = $this->createJsonForAPI($price);

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
        CURLOPT_POSTFIELDS =>$json,
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json',
            'Cookie: coinremitter=cqYAT020X1P2sxPzWzWkvYtbgLYTA7Z7K0mFPQSa'
        ),
        ));
    
        $API_Response = json_decode(curl_exec($curl), true);

        if($API_Response['flag'] == "1")
        {
            $this->state = $API_Response['flag'];
            $this->url_payment = $API_Response['data']['url'];
            $this->invoice_ext = $API_Response['data']['id'];
            $this->invoice_int = $API_Response['data']['invoice_id'];
            $this->msg = $API_Response;
        }
        else
        {
            $this->errors[] = $API_Response['msg'];
        }

        return $this;
    }
}
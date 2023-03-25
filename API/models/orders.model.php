<?php
class Orders_Model extends Model
{
    function __construct()
    {
        $this->db = new DB();
        $this->table = "orders";
    }

    function filter($_params = [])
    {
        $array_search = array("id"=>['i'], "ip"=>['s']);

        return parent::filter($_params, $array_search);
    }

    function addNewOrderToDatabase($_details, $_invoice_ext, $_invoice_int, $_customerDetails)
    {
        $IP_Client = $_SERVER['REMOTE_ADDR'];
        $response = $this->db->insert(array("details"=>['s', json_encode($_details)], "invoice_ext"=>['s', $_invoice_ext], 
        "invoice_int"=>['s', $_invoice_int], "customerDetails"=>['s', json_encode($_customerDetails)], "ip"=>['s', $IP_Client]), $this->table);
    
        return $response;
    }
}
?>
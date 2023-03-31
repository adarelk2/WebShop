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

    function getLastOrders($_limit = 20)
    {
        return $this->db->mysqli->query("SELECT * from orders where 1  order by id desc LIMIT $_limit")->fetch_all(MYSQLI_ASSOC);
    }

    function addNewOrderToDatabase($_details, $_invoice_ext, $_invoice_int, $_customerDetails, $_items)
    {
        $IP_Client = $_SERVER['REMOTE_ADDR'];
        $response = $this->db->insert(array("details"=>['s', json_encode($_details)], "invoice_ext"=>['s', $_invoice_ext], 
        "invoice_int"=>['s', $_invoice_int], "customerDetails"=>['s', json_encode($_customerDetails)], 
        "ip"=>['s', $IP_Client], "items"=>['s', json_encode($_items)]), $this->table);
    
        return $response;
    }
}
?>
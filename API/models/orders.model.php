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
        $array_search = array("id"=>['i']);

        return parent::filter($_params, $array_search);
    }
}
?>
<?php
class Items_Model extends Model
{
    public $db, $table;
    public $errors = [];

    function __construct()
    {
        $this->db = new DB();
        $this->table = "items";
    }

    function filter($_params = [])
    {
        $array_search = array("id"=>['i'], "category"=>['s'], 
        "active"=>['i'], "price"=>['i']);

        return parent::filter($_params, $array_search);
    }
}
?>
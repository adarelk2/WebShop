<?php
class Categories_Model extends Model
{
    public $db, $table;
    public $errors = [];

    function __construct()
    {
        $this->db = new DB();
        $this->table = "categories";
    }

    function filter($_params = [])
    {
        $array_search = array("id"=>['i'], "active"=>['i']);

        return parent::filter($_params, $array_search);
    }
}
?>
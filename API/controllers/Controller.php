<?php
class Controller
{
    public $model;
    public $errors = [];
    function __construct($_model)
    {
        $this->setModel($_model);
    }

    function setModel($_model)
    {
        $filename = $_SERVER['DOCUMENT_ROOT']."/API/models/".$_model.".php";
        $models = array("items.model" => "Items_Model", "categories.model"=>"Categories_Model", "orders.model"=>"Orders_Model");

        if (file_exists($filename)) 
        {
            require_once $_SERVER['DOCUMENT_ROOT']."/API/models/".$_model.".php";
            $this->model = new $models[$_model]();
        } 
        else 
        {
            array_push($this->errors, "Model doesnt exists");
        }
    }
}
?>
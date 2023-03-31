<?php
class Items_Controller extends Controller
{
    public $params = "";
    
    function __construct($_params, $_model = "items.model") 
    {
        $this->params = $_params;
        parent::__construct($_model); 
    }

    function getItems()
    {
        return $this->model->filter($this->params);
    }

    function getItemsByCart()
    {
       return $this->model->getItemsByCart($this->params);
    }
}
?>
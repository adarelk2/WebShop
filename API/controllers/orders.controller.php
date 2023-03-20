<?php
class Orders_Controller extends Controller
{
    public $errors = array();
    public $params = "";
    
    function __construct($_params) 
    {
        $this->params = $_params;
        parent::__construct("orders.model"); 
    }
}
?>
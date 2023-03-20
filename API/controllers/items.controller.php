<?php
class Items_Controller extends Controller
{
    public $params = "";
    
    function __construct($_params) 
    {
        $this->params = $_params;
        parent::__construct("items.model"); 
    }

    function getItems()
    {
        return $this->model->filter($this->params);
    }
}
?>
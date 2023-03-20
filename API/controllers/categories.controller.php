<?php
class Categories_Controller extends Controller
{
    public $params = "";
    
    function __construct($_params) 
    {
        $this->params = $_params;
        parent::__construct("categories.model"); 
    }

    function getCategories()
    {
        return $this->model->filter($this->params);
    }
}
?>
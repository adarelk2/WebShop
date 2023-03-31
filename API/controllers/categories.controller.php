<?php
class Categories_Controller extends Controller
{
    public $params = "";
    
    function __construct($_params, $_model = "categories.model") 
    {
        $this->params = $_params;
        parent::__construct($_model); 
    }

    function getCategories()
    {
        return $this->model->filter($this->params);
    }
}
?>
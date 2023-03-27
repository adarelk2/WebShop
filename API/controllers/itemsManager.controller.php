<?php
class ItemsManager_Controller extends Controller
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

    function getItemsByCart()
    {
       return $this->model->getItemsByCart($this->params);
    }

    function createNewPrudct()
    {
        $response = $this;
        if((!isset($this->params['files']) && count($this->params['files'])) || !$this->params['category'] || 
        !$this->params['price'] || !$this->params['title'] || !$this->params['description'])
        {
            $this->errors[] = "All inputs is required.";
        }
        else
        {
            $fileUpload = new FileUpload($this->params['files']['img']);
            $fileName = $fileUpload->uploadFile("/images/Product");
            if(empty($fileUpload->errors))
            {
                $this->params['fileName'] = $fileName;
                $insert = $this->model->createItem($this->params);
                if(!empty($this->model->errors))
                {
                    $this->errors = $this->model->errors;
                }
                else
                {
                    $response = $insert;
                }
            }
            else
            {
                $this->errors = $fileUpload->errors;
            }
        }
   
        return $response;
    }
}
?>
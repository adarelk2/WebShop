<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/API/controllers/items.controller.php';
class ItemsManager_Controller extends Items_Controller
{
    function updateItem()
    {
        $item = $this->model->filter(array("id"=>$this->params['id']))[0];
        if($item['id'])
        {
            $updated = $this->model->updateItem($this->params);
            if(!$updated)
            {
                $this->errors[] = "Update item was failed.";
            }
            
            return $this;
        }
        else
        {
            $this->errors[] = "Item doesn't exist";
            return $this;
        }
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
<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/API/controllers/categories.controller.php';
class CategoriesManager_Controller extends Categories_Controller
{
    function updateCategory()
    {
        $response = $this;

        $category = $this->model->filter(array("id"=>$this->params['id']))[0];
        if($category['id'])
        {
            $updated = $this->model->updateCategory($this->params);
            if(!$updated)
            {
                $this->errors[] = "Update category was failed.";
            }
            else
            {
                $response = $updated;
            }
        }
        else
        {
            $this->errors[] = "category doesn't exist";
        }

        return $response;
    }

    function deleteCategory()
    {
        $response = $this;

        $category = $this->model->filter(array("id"=>$this->params['id']))[0];
        if($category['id'])
        {
            $updated = $this->model->updateCategory(array("id"=>$this->params['id'], "active"=>"0"));
            if(!$updated)
            {
                $this->errors[] = "delete category was failed.";
            }
            else
            {
                $this->setModel("items.model");
                $items = $this->model->db->update(array("active"=>['i',0]),$this->model->table, "where category=".$this->params['id']);
                $response = $updated;
            }
        }
        else
        {
            $this->errors[] = "category doesn't exist";
        }

        return $response;
    }

    function createNewCategory()
    {
        $response = $this;
        if((!isset($this->params['title']) && count($this->params['title'])))
        {
            $this->errors[] = "All inputs is required.";
        }
        else
        {
            $insert = $this->model->createCategory($this->params);
            if(!empty($this->model->errors))
            {
                $this->errors = $this->model->errors;
            }
            else
            {
                $response = $insert;
            }
        }
   
        return $response;
    }
}
?>
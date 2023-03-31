<?php

class App
{
    private $controller;
    private $method;
    public $errors = array();
    function __construct($_controller, $_method, $_params)
    {
        $filename = $_SERVER['DOCUMENT_ROOT']."/API/controllers/".$_controller.".controller.php";

        $controllersFactory = new CreateControllers($_SESSION['user']);
        $controllers = $controllersFactory->execute();
        if (file_exists($filename) && isset($controllers[$_controller])) 
        {
            require_once $_SERVER['DOCUMENT_ROOT']."/API/controllers/".$_controller.".controller.php";
            $this->controller = new $controllers[$_controller]($_params);
        } 
        else 
        {
            array_push($this->errors, "Controller doesnt exists");
        }

        if(empty($this->errors))
        {
            if(method_exists($this->controller,$_method))
            {
                $this->method = $_method;
            }
            else
            {
                array_push($this->errors, "Method doesnt exists");
            }
        }
    }

    function execute()
    {
        $msg = RESPONSE_ERROR;
        $state = false;
        $function = STATUS_SUCCESS;
        
        if(empty($this->errors))
        {
            $state = true;
            $function = STATUS_SUCCESS;
            if(empty($this->controller->errors))
            {
                $method = $this->method;
                $msg = $this->controller->$method();
                if(!$msg || isset($msg->errors) && !empty($msg->errors))
                {
                    if(isset($msg->errors))
                    {
                        $msg = implode(",",$msg->errors);
                    }
                    $state = false;
                }
            }
            else
            {
                $msg = implode(",",$this->controller->errors);
                $state = false;
            }
        }
        else
        {
            $msg = implode(",",$this->errors);
            $state = false;
        }

        return array("msg"=>$msg, "state"=>$state, "function"=>$function);
    }
}
?>
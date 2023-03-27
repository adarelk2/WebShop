<?php
class FileUpload 
{
    protected $file;
    protected $allowedFormats = array('jpg', 'jpeg', 'png', 'gif');
    protected $maxSize = 10485760; // 10 MB
    public $errors = array();

    public function __construct($file) 
    {
        $this->file = $file;
    }

    public function validator()
    {
        $path = $this->file['name'];
        $ext = pathinfo($path, PATHINFO_EXTENSION);
       
        if(!in_array($ext, $this->allowedFormats))
        {
            $this->errors[] = "Format does'nt suportted.";
        }

        if($this->file['size'] > $this->maxSize)
        {
            $this->errors[] = "File size is too large.";
        }
    }

    public function uploadFile($_targetFile)
    {
        $this->validator();
        
        $response = $this;

        if(empty($this->errors))
        {
            $file_tmp = $this->file['tmp_name'];
            $file_name =  time() . "_". $this->file['name'];
            $file_destination = $_SERVER['DOCUMENT_ROOT']. '/'.$_targetFile.'/' . $file_name;
            $fileCreated = move_uploaded_file($file_tmp, $file_destination);
            if($fileCreated)
            {
                $response = $_targetFile . "/". $file_name;
            }
            else
            {
                $this->errors[] = "Upload file was failed.";
            }
         }

        return $response;
    }
}
    ?>
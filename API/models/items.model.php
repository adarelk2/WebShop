<?php
class Items_Model extends Model
{
    function __construct()
    {
        $this->db = new DB();
        $this->table = "items";
    }

    function filter($_params = [])
    {
        $array_search = array("id"=>['i'], "category"=>['i'], 
        "active"=>['i'], "price"=>['i'],'favorite'=>['i']);

        return parent::filter($_params, $array_search);
    }

    function getItemsByCart($_items)
    {
        $stmt = $this->db->mysqli->prepare("SELECT * FROM items WHERE id IN (" . rtrim(str_repeat('?,', count($_items)), ',') . ")");
        if ($stmt) 
        {
          $stmt->bind_param(str_repeat('i', count($_items)), ...$_items);
          $stmt->execute();
          $result = $stmt->get_result();
          $data = $result->fetch_all(MYSQLI_ASSOC);
          $stmt->close();
          return $data;
        } 
        else 
        {
            array_push($this->errors, "Error, please try again");
        }    
    }

    function createItem($_params)
    {
        $insert = $this->db->insert(array("category"=>['i', $_params['category']],"img"=>['s',$_params['fileName']],
        "title"=>['s', $_params['title']], "body"=>['s', $_params['description']], "price"=>['i', $_params['price']],
        "favorite"=>['i', ($_params['favorite'] == "true") ? 1 : 0]), $this->table);

        if(!$insert)
        {
            array_push($this->errors, "Created prudct failed");
        }
  
        return $insert;
        
    }
}
?>
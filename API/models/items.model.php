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
}
?>
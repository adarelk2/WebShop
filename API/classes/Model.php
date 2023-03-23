<?php
class Model
{
    function filter($_params = [], $_array_search)
    {        
        foreach($_array_search as $key=>$val)
        {
            if(isset($_params[$key]))
            {
                array_push($_array_search[$key], $_params[$key]);
            }
            else
            {
                unset($_array_search[$key]);
            }
        }

       if(count($_array_search))
       {
            $query = $this->db->select($_array_search, $this->table, false)->fetch_all(MYSQLI_ASSOC);
            $response = (count($query)) ? $query : [];
       }
       else
       {
            array_push($this->errors, "No fields were sent to search");
            $response = $this;
       }

       return $response;
    }
}
?>

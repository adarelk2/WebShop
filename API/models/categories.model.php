<?php
class Categories_Model extends Model
{
    function __construct()
    {
        $this->db = new DB();
        $this->table = "categories";
    }

    function filter($_params = [])
    {
        $array_search = array("id"=>['i'], "active"=>['i']);

        return parent::filter($_params, $array_search);
    }

    function updateCategory($_params)
    {
        $columnsUpdated = $this->createDefaultCategory($_params);
        return $this->db->update($columnsUpdated, $this->table, "where id=".$_params['id']);
    }

    function createDefaultCategory($_form)
    {
        $json = array(
            "titleCategory"=>['s', $_form['titleCategory']],
            "active"=>['i',$_form['active']]);

            foreach($json as $key=>$value)
            {
                if(!isset($_form[$key]))
                {
                    unset($json[$key]);
                }
            }

            $json["updated_at"] = array('s',date("Y-m-d H:i:s"));

            return $json;
    }

    function createCategory($_params)
    {
        $insert = $this->db->insert(array("titleCategory"=>['s', $_params['title']]), $this->table);
    
        if(!$insert)
        {
            array_push($this->errors, "Created Category was failed");
        }
  
        return $insert;
        
    }
}
?>
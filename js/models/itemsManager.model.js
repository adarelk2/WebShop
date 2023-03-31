import Model from "./Model.js";
class ItemsManager_Model extends Model
{
    items = []
    constructor()
    {
        super("itemsManager");
    }

    filterAPI(_params)
    {
        for (const [key, value] of Object.entries(_params)) {
           if(_params[key] == "")
           {
                delete _params[key];
           }
          }
        return this.API.get("getItems",_params).then(res=>res);
    }

    createNewProduct(_form)
    {
        return this.API.postFile("createNewPrudct", _form).then(res=>res)
    }

    save(_form)
    {
        return this.API.post("updateItem", _form).then(res=>res)
    }
}

export default ItemsManager_Model;
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
}

export default ItemsManager_Model;
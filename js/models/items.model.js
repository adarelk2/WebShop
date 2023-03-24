import Model from "./Model.js";
class Items_Model extends Model
{
    items = []
    constructor()
    {
        super("items");
    }

    filterAPI(_params)
    {
        return this.API.get("getItems",_params).then(res=>res);
    }

    setItems(_items)
    {
        this.items = _items;
    }
}

export default Items_Model;
import Model from "./Model.js";
class Categories_Model extends Model
{
    items = []
    constructor()
    {
        super("categories");
    }

    filterAPI(_params)
    {
        return this.API.get("getCategories",_params).then(res=>res);
    }

    setItems(_items)
    {
        this.items = _items;
    }
}

export default Categories_Model;
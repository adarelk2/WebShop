import Controller from "./controller.js";
class Items_Controller extends Controller
{
    constructor()
    {
        super("items");
    }

    getItems(_params)
    {
        _params.active = 1;
        return this.model.filterAPI(_params).then(res=>res.msg);
    }

    getItemsByCart(_items)
    {
        return this.model.API.get("getItemsByCart", _items).then(res=>res.msg)
    }
}

export default Items_Controller;
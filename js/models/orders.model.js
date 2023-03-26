import Model from "./Model.js";
class Orders_Model extends Model
{
    items = []
    constructor()
    {
        super("orders");
    }

    filterAPI(_params)
    {
        for (const [key, value] of Object.entries(_params)) {
           if(_params[key] == "")
           {
                delete _params[key];
           }
          }
        return this.API.get("getOrders",_params).then(res=>res);
    }

    createNewOrder(_params)
    {
        return this.API.get("createOrder",_params).then(res=>res);
    }
}

export default Orders_Model;
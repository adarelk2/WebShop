import Controller from "./controller.js";
class Orders_Controller extends Controller
{
    constructor()
    {
        super("orders");
    }

    createOrder(_items, _form)
    {
        const API_BODY = 
        {
            items:_items,
            customerDetails: _form
        }
        return this.model.createNewOrder(API_BODY).then(res=>res);
    }

    getOrders(_params)
    {
        return this.model.filterAPI(_params).then(res=>res.msg);
    }

}

export default Orders_Controller;
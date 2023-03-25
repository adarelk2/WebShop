import Controller from "./controller.js";
class Orders_Controller extends Controller
{
    constructor()
    {
        super("orders");
    }

    createOrder(_params, _form)
    {
        return this.model.createNewOrder(_params, _form).then(res=>res);
    }
}

export default Orders_Controller;
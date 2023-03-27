import Items_Controller from "./items.controller.js";
class ItemsManager extends Items_Controller
{
    constructor()
    {
        super("itemsManager");
    }

    createNewPrudct(_form)
    {
        return this.model.API.postFile("createNewPrudct", _form).then(res=>res);
    }
}

export default ItemsManager;
import Items_Controller from "./items.controller.js";
class ItemsManager extends Items_Controller
{
    constructor()
    {
        super("itemsManager");
    }
    
    createNewPrudct(_form)
    {
        return this.model.createNewProduct(_form);
    }

    saveItem(_form)
    {
        return this.model.save(_form);
    }
}

export default ItemsManager;
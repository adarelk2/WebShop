import Items_Controller from "./items.controller.js";
class ItemsManager extends Items_Controller
{
    createNewPrudct(_form)
    {
        return this.model.createNewProduct(_form);
    }

    saveItem(_form)
    {
        this.setModel("itemsManager");
        return this.model.save(_form);
    }
}

export default ItemsManager;
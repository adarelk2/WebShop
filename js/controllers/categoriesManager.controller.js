import Categories_Controller from "./categories.controller.js";

class CategoriesManager_Controller extends Categories_Controller
{
    constructor()
    {
        super("categoriesManager");
    }

    createNewCategory(_form)
    {
        return this.model.createNewCategory(_form);
    }

    saveCategory(_form)
    {
        return this.model.save(_form);
    }

    deleteCategory(_id)
    {
        return this.model.deleteCategory(_id);
    }
}

export default CategoriesManager_Controller;
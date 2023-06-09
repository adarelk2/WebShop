import Items_Model from "../models/items.model.js";
import Categories_Model from "../models/categories.model.js";
import Orders_Model from "../models/orders.model.js";
import ItemsManager_Model from "../models/itemsManager.model.js";
import CategoriesManager_Model from "../models/categoriesManager.model.js";
class createModel
{
    model;
    constructor(_model)
    {
        this.model = _model;
    }   

    execute() 
    {
        const modelStorage = 
        {
            items: new Items_Model(),
            orders: new Orders_Model(),
            itemsManager: new ItemsManager_Model(),
            categoriesManager: new CategoriesManager_Model(),
            categories: new Categories_Model()
        }

        return  modelStorage[this.model];
    }
}

export default createModel;
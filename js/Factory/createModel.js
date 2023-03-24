import Items_Model from "../models/items.model.js";
import Categories_Model from "../models/categories.model.js";
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
            // orders:  Orders_Model(),
            categories: new Categories_Model()
        }

        return  modelStorage[this.model];
    }
}

export default createModel;
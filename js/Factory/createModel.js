import Items_Model from "../models/items.model.js";
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
            items: new Items_Model()
            // orders:  Orders_Model(),
            // categories:  Categories_Model()
        }

        return  modelStorage[this.model];
    }
}

export default createModel;
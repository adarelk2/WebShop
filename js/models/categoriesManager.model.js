import Model from "./Model.js";
class CategoriesManager_Model extends Model
{
    items = []
    constructor()
    {
        super("categoriesManager");
    }

    filterAPI(_params)
    {
        for (const [key, value] of Object.entries(_params)) {
           if(_params[key] == "")
           {
                delete _params[key];
           }
          }
        return this.API.get("getCategories",_params).then(res=>res);
    }

    createNewCategory(_form)
    {
        return this.API.post("createNewCategory", _form).then(res=>res)
    }

    deleteCategory(_id)
    {
        return this.API.post("deleteCategory", {id:_id}).then(res=>res)
    }

    save(_form)
    {
        return this.API.post("updateCategory", _form).then(res=>res)
    }
}

export default CategoriesManager_Model;
import Controller from "./controller.js";
class Categories_Controller extends Controller
{
    constructor(_model = "categories")
    {
        super(_model);
    }

    getCategories(_params)
    {

        if(!("active" in _params))
        {
            _params.active = 1;
        }

        console.log(_params);
        return this.model.filterAPI(_params).then(res=>res.msg);
    }
}

export default Categories_Controller;
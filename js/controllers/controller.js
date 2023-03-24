import createModel from "../Factory/createModel.js";
class Controller
{
    model;
    errors = []
    constructor(_model)
    {
        this.setModel(_model);
    }
    
    setModel(_model)
    {
        const factory = new createModel(_model);
        this.model = factory.execute();
    } 
}

export default Controller;
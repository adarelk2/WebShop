import callAPI from "../utilities/callAPI.js";

class Model
{
    API;
    errors = []
    constructor(_controller)
    {
        this.API = new callAPI("/API/", _controller);
    }
}

export default Model;
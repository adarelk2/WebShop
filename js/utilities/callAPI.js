/*/
allways when you used get,post function you get 3 variables, state,status,msg from the server
*/
class callAPI
{
    #controller;
    #url;
    constructor(_url ,_controller)
    {
        this.#controller = _controller;
        this.#url = _url;
    }
    
    get(_method, _params) // this.#url = the url you want to send or get detalis, _data = object
    {
        return new Promise((resolve, reject) => {
            $.ajax({
                url: this.#url,
                method: "GET",
                data: {controller: this.#controller, method:_method,params:_params},
                success: function(res) {
                    try {
                        let data = JSON.parse(res);
                        // console.log(data);
                        if (data.status >= 200 && data.status <= 204)

                            resolve(data); /// after you got the callback you have to check if state(data.state) is true or false
                        else {
                            reject(data);
                        }
                    } catch {
                        // console.log(res);
                        reject(res);
                    }
                },
                error: function(e) {
                    console.log('failed');

                    console.log(e);
                    reject(e);
                }
            })
        })
    }
    post(_method, _params)
    {
        return new Promise((resolve, reject) => {
            $.ajax({
                url: this.#url,
                method: "POST",
                data: {controller: this.#controller, method:_method,params:_params},
                success: function(res) {
                    try {
                        let data = JSON.parse(res);
                        // console.log(data);
                        if (data.status >= 200 && data.status <= 204)
                            resolve(data); /// after you got the callback you have to check if state(data.state) is true or false
                        else {
                            reject(data);
                        }
                    } catch {
                        console.log(res);
                        reject(res);
                    }
                },
                error: function(e) {
                    console.log(e);
                    reject(e);
                }
            })
        })
    }


    postFile(_method, _params)
    {
        _params.append('controller', this.#controller);
        _params.append('method', _method);

        return new Promise((resolve, reject) => {
            $.ajax({
                url: this.#url,
                method: "POST",
                data:_params,
                contentType: false,
                processData: false,
                success: function(res) {
                    try {
                        let data = JSON.parse(res);
                        if (data.status >= 200 && data.status <= 204) resolve(data);
                        /// after you got the callback you have to check if state(data.state) is true or false
                        else {
                            reject(data);
                        }
                    } catch {
                        reject(res);
                    }
                },
                error: function(e) {
                    reject(e);
                },
            });
        });
    };
}

export default callAPI;
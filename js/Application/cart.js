import Cart from "../utilities/Cart.js?2";
import CreateInvoice from "../utilities/components/createInvoice.js";
import Orders_Controller from "../controllers/orders.controller.js";

const cart = new Cart()
let invoice = new CreateInvoice(cart, ".items_list");

const orders_controller = new Orders_Controller();
window.onload= async()=>
{
    await invoice.render()
    declareViewEvent();
}

const declareViewEvent=()=>
{
    $("#createOrder").on("click", function(){
        let errors = [];

        let form = 
        {
            FullName: $("#FullName").val(),
            Email: $("#Email").val(),
            Country: $("#Country").val(),
            City: $("#City").val(),
            Street: $("#Street").val()
        }

        for (const [key, value] of Object.entries(form)) 
        {
            if(value == "")
            {
                errors.push(`${key} is required`)
            }
        }

        if(errors.length)
        {
            Swal.fire("error", errors.join("<br>"), "error");
        }
        else
        {
            $(this).attr("disabled", true);
            orders_controller.createOrder(cart.getCart(), form).then(res=>{
            $(this).attr("disabled", false);
            if(res.state)
            {
                console.log(res.msg);
                location.replace(res.msg);
            }
            else
            {
                Swal.fire("error", res.msg, 'error');
            }
            })
        }
    })
}
import Items_Controller from "../controllers/items.controller.js?12"
import Items_List from "../utilities/components/items_list.js?2";
import Cart from "../utilities/Cart.js?2";
window.onload = async()=>
{
    const Cart = new Cart()

    const Controller = new Items_Controller();
    let items = await Controller.getItems({favorite:1});

    const items_list = new Items_List(items, new Cart("cart"));
    items_list.render();
    
    $(".items_list").html(items_list.getElement())
}
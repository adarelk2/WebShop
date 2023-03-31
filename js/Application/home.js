import Items_Controller from "../controllers/items.controller.js?12"
import Items_List from "../utilities/components/items_list.js?2344";
import Cart from "../utilities/Cart.js?2";
window.onload = async()=>
{
    const cart = new Cart()

    const Controller = new Items_Controller();
    let items = await Controller.getItems({favorite:1});

    const items_list = new Items_List(items, cart);
    items_list.render();
    
    $(".items_list").html(items_list.getElement())
}
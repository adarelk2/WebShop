import Cart from "../utilities/Cart.js?2";

const cart = new Cart()

window.onload=()=>
{
    console.log(cart.getCart());
}
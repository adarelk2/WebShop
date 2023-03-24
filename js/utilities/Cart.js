class Cart
{
    key;
    myCart = [];
    constructor(_key = "cart")
    {
        this.key = _key;

        if(!localStorage.getItem(this.key))
        {
            localStorage.setItem(this.key, JSON.stringify({}));
        }

        this.myCart = JSON.parse(localStorage.getItem(this.key));
    }

    getCart()
    {
        return this.myCart;
    }

    addItemToCart(_item)
    {
        this.myCart.push(_item);
        this.#saveInLocalStorage();
    }

    #saveInLocalStorage()
    {
        localStorage.setItem(this.key, JSON.stringify(this.myCart));
    }
}

export default Cart;
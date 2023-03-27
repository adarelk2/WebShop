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

    addItem(_item)
    {
        let count = (_item.id in this.myCart) ? this.myCart[_item.id] : 0;
        this.myCart[_item.id] = count + 1;
        this.#saveInLocalStorage();
        
        Swal.fire({
            position: 'top-end',
            html: "<a href=cart.php><span style='color:#fff;'> Success click here for see your cart</span></a>",
            showConfirmButton: false,
            timer: 3500
          })
    }

    deleteItem(_id)
    {
        delete this.myCart[_id];
        this.#saveInLocalStorage();
    }

    empty()
    {
        this.myCart = [];
        this.#saveInLocalStorage();
    }

    #saveInLocalStorage()
    {
        localStorage.setItem(this.key, JSON.stringify(this.myCart));
    }
}

export default Cart;
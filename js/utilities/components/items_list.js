class Items_List
{
    items = []
    #element
    cart 
    constructor(_items, _cart)
    {
        this.cart = _cart;
        this.items = _items;
        this.#element = this.createElement();
    }

    createElement()
    {
        let element = document.createElement("div");
        element.className = "row";

        return element;
    }
    
    empty()
    {
        this.items = [];
        this.render();
    }

    setItems(_items)
    {
        this.items = _items;
        this.render();
    }

    render()
    {
        this.#element.innerHTML = "";

        let itemElement = []
        this.items.map(item=>{
            itemElement.push(this.createItemDiv(item));
        })

        itemElement.map(itemDiv=>{
            this.#element.append(itemDiv); 
        })
    }

    createItemDiv(_item)
    {
        let box = document.createElement("div");
        box.className = "col-xl-3 col-lg-3 col-md-6 col-sm-6";

        let glasses_box = document.createElement("div");
        glasses_box.className = "glasses_box";   
        glasses_box.innerHTML = `<figure><img src="${_item.img}" alt="#"></figure>
                            <h3><span class="blu">$</span>${_item.price}</h3>
                            <p>${_item.title}</p>`

        let readDetails = document.createElement("span");
        readDetails.innerHTML = "Read More<br>";
        readDetails.style = "cursor:pointer;";
        readDetails.addEventListener("click",()=>{
            Swal.fire({
                html:`<h3 class='text-center'>${_item.title}</h3><span>${_item.body}</span>`
            });
        })

        let addToCartBTN = document.createElement("button");
        addToCartBTN.className = "btn";
        addToCartBTN.style = 'background-color:rgb(60,60,60);color:#fff;border-radius:8px;';
        addToCartBTN.innerHTML = "Add to cart";
        addToCartBTN.addEventListener("click", ()=>{
            this.cart.addItem({id:_item.id});
        })

        $(glasses_box).append(readDetails);
        $(glasses_box).append(addToCartBTN);

        $(box).append(glasses_box);

        return box;
    }

    getElement()
    {
        return this.#element;
    }
}

export default Items_List;
import Items_Controller from "../../controllers/items.controller.js";

class CreateInvoice {
  cart;
  invoiceElement;
  parent
  total;
  constructor(_cart, _parent) {
    this.cart = _cart;
    this.invoiceElement = this.createElement();
    this.parent = _parent;
    this.total = 0;
  }

  createElement() {
    let element = document.createElement("div");
    element.className = "p-3 col-12";
    element.style =
      "background-color:rgb(70,70,70);border:1px solid #000;color:#fff;";

    let table_responsive = document.createElement("div");
    table_responsive.className = "table-responsive";

    let table = document.createElement("table");
    table.className = "table table-striped";
    table.innerHTML = `
      <thead>
        <tr>
          <th scope="col">Product</th>
          <th scope="col">Price</th>
          <th scope="col">Count</th>
          <th scope="col">Delete</th>
        </tr>
      </thead>
      <tbody></tbody>
    `;

    $(table_responsive).append(table);
    
    element.appendChild(table_responsive);

    return element;
  }

  async render() {

    this.invoiceElement = this.createElement();

    const itemsInCart = Object.keys(this.cart.getCart());
    if(itemsInCart.length)
    {
        const items_controller = new Items_Controller();

        const itemsFromServer = await items_controller.getItemsByCart(itemsInCart);
        
        itemsFromServer.map((item) => {
          this.addItemToInvoiceElement(item);
        });    

        this.calculatorPrice(itemsFromServer);
    }
    
    $(this.invoiceElement).append(`<h2 class='text-center text-light'>in Total: ${this.total}$</h2>`);

    $(this.parent).html(this.invoiceElement);
    
    return this.invoiceElement;
  }

  addItemToInvoiceElement(_item) {
    const itemsFromCart = this.cart.getCart();
    let row = document.createElement("tr");
    row.innerHTML = `
      <td>${_item.title}</td>
      <td>${_item.price}$</td>
      <td>${itemsFromCart[_item.id]}</td>
    `;

    let deleteProductFromCart = document.createElement("td");
    deleteProductFromCart.style = "cursor:pointer;"
    deleteProductFromCart.innerHTML = "<i class='fa fa-trash-o' aria-hidden='true'></i>";
    deleteProductFromCart.addEventListener("click", ()=>{
        this.cart.deleteItem(_item.id);
        this.render();
    })

    $(row).append(deleteProductFromCart);
    this.invoiceElement.querySelector("tbody").appendChild(row);
  }

  calculatorPrice(_items)
  {
    const itemsFromCart = this.cart.getCart();
    this.total = 0;
    _items.map(item=>{
        this.total = this.total + (item.price * itemsFromCart[item.id]);
    })
  }
}

export default CreateInvoice;
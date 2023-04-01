class Items_List {
    // Initialize class variables
    items = [];
    #element;
    cart;
    currency;
    categories = []
    callbacks = 
    {
      saveItem:false,
      deleteItem: false
    }

    // Constructor method for the class
    constructor(_items, _cart = [], _currency = "$") {
      this.cart = _cart;
      this.items = _items;
      this.#element = this.createElement();
      this.currency = _currency
    }
  
    // Create element for the class
    createElement() {
      let element = document.createElement("div");
      element.className = "row";
      return element;
    }
  
    // Empty the list of items
    empty() 
    {
      this.items = [];
      this.render();
    }
  
    // Set new items for the list
    setItems(_items) 
    {
      this.items = _items;
      this.render();
    }

    setCategories(_categories)
    {
        this.categories = _categories;
    }
    
    setCallback(_callbacks)
    {
      for (const [key, value] of Object.entries(_callbacks)) 
      {
        this.callbacks[key] = value;
      }
    }
    // Render list of items view
    render(_isAdmin = false) 
    {
      this.#element.innerHTML = "";
      
      let keyMethod = _isAdmin ? "createItemDivForAdmin" : "createItemDiv"
      // Create item element array
      let itemElement = [];
      this.items.map((item) => {
        itemElement.push(this[keyMethod](item));
      });
  
      // Append item divs to element
      itemElement.map((itemDiv) => {
        this.#element.append(itemDiv);
      });
    }
    
    // Create item div for regular user view
    createItemDiv(_item) 
    {
        console.log(this.currency);
      let box = document.createElement("div");
      box.className = "col-xl-3 col-lg-3 col-md-6 col-sm-6";
  
      let glassesBox = document.createElement("div");
      glassesBox.className = "glasses_box";
      glassesBox.innerHTML = `
          <figure>
              <div class="col-10">
                  <img src="${_item.img}" alt="#" style='width:100%;height:25vh;'>
              </div>
          </figure>
          <h3><span style='color:orange;'>${this.currency}</span>${_item.price}</h3>
          <p>${_item.title}</p>`;
  
      let readDetails = document.createElement("span");
      readDetails.innerHTML = "Read More<br>";
      readDetails.style = "cursor:pointer;";
      readDetails.addEventListener("click", () => {
        Swal.fire({
          html: `<h3 class='text-center'>${_item.title}</h3><span>${_item.body}</span>`,
        });
      });
  
      let addToCartBtn = document.createElement("button");
      addToCartBtn.className = "btn";
      addToCartBtn.style =
        "background-color:rgb(60,60,60);color:#fff;border-radius:8px;";
      addToCartBtn.innerHTML = "Add to cart";
      addToCartBtn.addEventListener("click", () => {
        this.cart.addItem({ id: _item.id });
      });
  
      $(glassesBox).append(readDetails);
      $(glassesBox).append(addToCartBtn);
  
      $(box).append(glassesBox);
  
      return box;
    }
  
    createItemDivForAdmin(_item) 
    {
      console.log(_item);
        let box = document.createElement("div");
        box.className = "col-xl-3 col-lg-3 col-md-6 col-sm-6 mb-4";

        let selectCategories = (this.categories.length) ? this.createSelectCategories(_item) : "";
      
        let itemBox = document.createElement("div");
        itemBox.className = "glasses_box p-2";
        itemBox.innerHTML = `
          <h3>${_item.id}</h3>
          <div class="form-group">
            <label for="title">Title: </label>
            <input type='text' data-item=${_item.id} id=title class='form-control title' value=${_item.title}>
          </div>
          <div class="form-group">
            <label for="body">Description: </label>
            <input type='text' data-item=${_item.id} id=body class='form-control body' value=${_item.body}>
          </div>
          <div class="form-group">
            <label for="price">Price: </label>
            <input type='number' data-item=${_item.id} id=price class='form-control price' value=${_item.price}>
          </div>
          ${selectCategories}
          <div class="form-group">
            <label for="favorite">Favorite: </label>
            <input type='checkbox' data-item=${_item.id} id=favorite class='favorite' ${_item.favorite ? "checked" : ""}>
          </div>
        `;
        
        let saveBTN = document.createElement("button");
        saveBTN.innerHTML = `SAVE`;
        saveBTN.className = "btn btn-primary mx-2";
        saveBTN.addEventListener("click",async()=>{
          if(this.callbacks.saveItem)
          {
            let form = {
              category: $(`.category[data-item=${_item.id}]`).val(),
              price:$(`.price[data-item=${_item.id}]`).val(),
              title : $(`.title[data-item=${_item.id}]`).val(),
              body: $(`.body[data-item=${_item.id}]`).val(),
              favorite: $(`.favorite[data-item=${_item.id}]`).is(":checked"),
              id:_item.id
            }

            $(saveBTN).attr("disabled", true);
             await this.callbacks.saveItem(form, _item);
            $(saveBTN).attr("disabled", false);
          }
          else
          {
            Swal.fire('error', "There is not callback for this action",'error');
          }
        })

        let deleteBTN = document.createElement("button");
        deleteBTN.innerHTML = `DELETE`;
        deleteBTN.className = "btn btn-danger";
        deleteBTN.addEventListener("click",async()=>{
          if(this.callbacks.saveItem)
          {
            let form = {
              active:"0",
              id:_item.id
            }

            $(saveBTN).attr("disabled", true);
             await this.callbacks.saveItem(form, _item);
            $(saveBTN).attr("disabled", false);
          }
          else
          {
            Swal.fire('error', "There is not callback for this action",'error');
          }
        })

        $(itemBox).append(saveBTN);
        $(itemBox).append(deleteBTN);

        $(box).append(itemBox);
      
        return box;
    }

    createSelectCategories(_item)
    {
        let select = `<div class="form-group">
            <label for="category">Category: </label>
            <select id=category class='form-control category' data-item=${_item.id}>
       `

        this.categories.map(category=>{
            select = `${select}<option value = ${category.id} ${category.id == _item.category ? "selected" : ""}>${category.titleCategory}</option>`; 
        })

        select = `${select}</select> </div>`;
        return select;
    }
      
    getElement()
    {
        return this.#element;
    }
}

export default Items_List;
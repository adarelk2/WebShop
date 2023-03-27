import Categories_Controller from "../../controllers/categories.controller.js"
import ItemsManager_Controller from "../../controllers/itemsManager.controller.js"

const CategoriesController = new Categories_Controller();
const ItemsController = new ItemsManager_Controller();
console.log(ItemsController);
window.onload = ()=>{
    init();
}

const init = async()=>
{
    const elementInForm = createInput([
        {id:"title", labelName:"Title", type:"text"},
        {id:"price", labelName:"Price", type:"number"},
        {id:"description", labelName:"Description", type:"text"},
        {id:"img", labelName:"Produt Image", type:"file"},
    ]);

    let form = document.createElement("form");
    form.classList.add("p-3", "border", "rounded");

    const divBox = document.createElement("div");
    divBox.className = "text-center mb-3";
    divBox.innerHTML = "<h1>Add new Product</h1>";

    let categories = await CategoriesController.getCategories({active:1}).then(res=>res);
    let selectCategoriesElement = createCategoriesSelect(categories);

    $(form).append(selectCategoriesElement);

    elementInForm.map(element=>{
        $(form).append(element);
    })
    
    let favoriteDiv = document.createElement("div");
    favoriteDiv.className = "form-group";
    favoriteDiv.innerHTML = `
    <label for="favorite">Favorite Product: </label><input type='checkbox' class="mx-2" id="favorite">
    `
    $(form).append(favoriteDiv);

    const submitBtn = document.createElement("button");
    submitBtn.type = "submit";
    submitBtn.textContent = "Submit";
    submitBtn.className = "btn btn-primary";

    form.addEventListener("submit", (event) => {
        event.preventDefault();
        console.log(event.target);
        const formData = new FormData(event.target);
        formData.append('category', $("#category").val());
        formData.append('favorite', $("#favorite").is(":checked"));

        ItemsController.createNewPrudct(formData).then(res=>{           
            if(res.state)
            {
                Swal.fire("done", res.msg, 'success').then(()=>{
                    location.reload();
                });
            }
            else
            {
                Swal.fire("error", res.msg, 'error')
            }
     
        });
    });

    $(form).append(submitBtn);

    $(divBox).append(form);

    $(".page").html(divBox)
}

const createCategoriesSelect = (_categories)=>
{
    let select = `<div class="form-group"><label for="category">Category:</label><select id=category class="form-control"><option value="">בחירת קטגוריה</option>`;
    _categories.map(category=>{
        select = `${select}<option value="${category.id}">${category.titleCategory}</option>`;
    })

    select = `${select}</select></div>`;

    return select;
}

const createInput = (_inputs = [])=>
{
    let elements = [];

    _inputs.map(input=>{
        let groupBox = document.createElement("div");
        groupBox.className = "form-group";
     
        groupBox.innerHTML = `<label for=${input.id}>${input.labelName}:</label><input type='${input.type}' id='${input.id}' class="form-control" name="${input.id}">`;
        
        elements.push(groupBox);
    })

   return elements
}

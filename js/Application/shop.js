import Categories_Controller from "../controllers/categories.controller.js?12"
import Items_Controller from "../controllers/items.controller.js?12"
import Items_List from "../utilities/components/items_list.js?2";
import Cart from "../utilities/Cart.js?2";

const cart = new Cart()

const CategoriesController = new Categories_Controller();

const ItemsController = new Items_Controller();
let items = [];

const items_list = new Items_List([], cart);

let filters = 
{
    category: "",
    favorite: 0
}

window.onload = async()=>
{
    init();
    let categoires = await CategoriesController.getCategories({});
    createCategoriesBTN(categoires);

}

const init = async()=>
{
    items = await ItemsController.getItems(filters);
    items_list.setItems(items)
    $(".items_list").html(items_list.getElement())
}

const createCategoriesBTN = (_categories)=>
{
    _categories.push({titleCategory:"All Products", id:""})

    $("#categoriesBTN").empty();    
    _categories.map(category=>{
        let btn = document.createElement("button");
        btn.style = "background-color:rgb(60,60,60);color:#fff";
        btn.className = "btn";
        btn.innerHTML = category.titleCategory;
        btn.addEventListener("click", ()=>{
            filters.category = category.id;
            init();
        })

        $("#categoriesBTN").append(btn);
    })
}
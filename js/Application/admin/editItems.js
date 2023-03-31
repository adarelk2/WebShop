import Categories_Controller from "../../controllers/categories.controller.js"
import ItemsManager_Controller from "../../controllers/itemsManager.controller.js"
import Items_List from "../../utilities/components/items_list.js"

const CategoriesController = new Categories_Controller();
const ItemsController = new ItemsManager_Controller();
console.log(ItemsController);
window.onload = ()=>{
    init();
}

const init = async()=>
{
   let categories = await CategoriesController.getCategories({active:1}).then(res=>res);

    let items = await ItemsController.getItems({active:1}).then(res=>res);

    let itemsList = new Items_List(items);

    itemsList.setCategories(categories);
    itemsList.setCallback({saveItem:saveCallback});
    console.log(itemsList);
    itemsList.render(true);

    $(".page").html(itemsList.getElement());
}

const saveCallback = (_form, _item)=>
{
    return ItemsController.saveItem(_form).then((res)=>{
        if(res.state)
        {
            Swal.fire("done", res.msg, 'success');
            init();
        }
        else
        {
            Swal.fire("error", res.msg, 'error');
        }
        return res;
    });
}



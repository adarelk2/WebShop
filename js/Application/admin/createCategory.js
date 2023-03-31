import CategoriesManager_Controller from "../../controllers/categoriesManager.controller.js"

const CategoriesController = new CategoriesManager_Controller();
console.log(CategoriesController);
window.onload = ()=>{
    init();
}

const init = async()=>
{
    const elementInForm = createInput([
        {id:"titleCategory", labelName:"Title", type:"text"}
    ]);

    let form = document.createElement("form");
    form.classList.add("p-3", "border", "rounded");

    const divBox = document.createElement("div");
    divBox.className = "text-center mb-3";
    divBox.innerHTML = "<h1>Add new Category</h1>";

    elementInForm.map(element=>{
        $(form).append(element);
    })

    const submitBtn = document.createElement("button");
    submitBtn.type = "submit";
    submitBtn.textContent = "Submit";
    submitBtn.className = "btn btn-primary";

    form.addEventListener("submit", (event) => {
        event.preventDefault();
        console.log($("#titleCategory").val());
        CategoriesController.createNewCategory({title: $("#titleCategory").val()}).then(res=>{
           if(res.state)
           {
                Swal.fire("done", "A new category was created.", 'success').then(()=>{
                    location.reload();
                });
           }
           else
           {
                Swal.fire("failed", res.msg, 'error');
           }
        })
    });

    $(form).append(submitBtn);

    $(divBox).append(form);

    $(".page").html(divBox)
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

import CategoriesManager_Controller from "../../controllers/categoriesManager.controller.js"

const CategoriesController = new CategoriesManager_Controller();
window.onload = ()=>{
    init();
}

const init = async()=>
{
    let categories = await CategoriesController.getCategories({active:1});

    let table = buildCategoryTable(categories);
   


    $(".page").html(table)
}

function buildCategoryTable(categories) {
    // create table element
    let divBox = document.createElement("div");
    divBox.className = "responsive-table";

    const table = document.createElement('table');
    table.className = "table";
  
    // create table header row
    const headerRow = document.createElement('tr');
    const idHeader = document.createElement('th');
    idHeader.textContent = 'ID';
    headerRow.appendChild(idHeader);
    const titleHeader = document.createElement('th');
    titleHeader.textContent = 'Title Category';
    headerRow.appendChild(titleHeader);
    const saveHeader = document.createElement('th');
    saveHeader.textContent = 'Save';
    headerRow.appendChild(saveHeader);
    const deleteHeader = document.createElement('th');
    deleteHeader.textContent = 'Delete';
    headerRow.appendChild(deleteHeader);

    table.appendChild(headerRow);
  
    // create table body rows
    categories.forEach((category) => {
      const row = document.createElement('tr');
  
      const idCell = document.createElement('td');
      idCell.textContent = category.id;
      row.appendChild(idCell);
  
      const titleCell = document.createElement('td');
      const titleInput = document.createElement('input');
      titleInput.type = 'text';
      titleInput.value = category.titleCategory;
      titleCell.appendChild(titleInput);
      row.appendChild(titleCell);

      const saveCell = document.createElement('td');
      const saveButton = document.createElement('button');
      saveButton.className = "btn btn-primary";
      saveButton.textContent = 'Save';
      saveButton.addEventListener('click', () => {
        // handle save button click here
        CategoriesController.saveCategory({titleCategory:$(titleInput).val(), id: category.id}).then(res=>{
           if(res.state)
           {
            Swal.fire("done", res.msg, "success");
           }
           else
           {
              Swal.fire("error", res.msg, "error")
           }
        })
      });
      saveCell.appendChild(saveButton);
      row.appendChild(saveCell);
  
      const deleteCell = document.createElement('td');
      const deleteButton = document.createElement('button');
      deleteButton.textContent = 'Delete';
      deleteButton.className = "btn btn-danger"
      deleteButton.addEventListener('click', () => {
        // handle delete button click here
        CategoriesController.deleteCategory(category.id).then(res=>{
            console.log(res);
            if(res.state)
            {
              Swal.fire("done", res.msg, "success").then(()=>{
                init();
              })
            }
            else
            {
              Swal.fire("error", res.msg, "error")
            }
        })
      });
      deleteCell.appendChild(deleteButton);
      row.appendChild(deleteCell);
  
      table.appendChild(row);
    });
    
    $(divBox).append(table);
    return divBox;
  }
  
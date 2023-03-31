import Orders_Controller from "../../controllers/orders.controller.js"

const OrdersController = new Orders_Controller();
window.onload = ()=>{
    init();
}

const init = async()=>
{
    let orders = await OrdersController.getOrders({});
    let divBox = document.createElement("div");
    divBox.style = "max-height:500px;overflow:scroll;"
    divBox.className = "table-responsive";
    let table = createOrdersTable(orders);
    
    $(divBox).append(table);

    $(".page").html(divBox)
}

const createOrdersTable = (_orders)=>
{
    let table = document.createElement("table");
    table.className = "table";
    
    let thead = document.createElement("thead");
    thead.innerHTML = `
    <th>#</th>
    <th>Status</th>
    <th>Fullname</th>
    <th>Email</th>
    <th>Telegram</th>
    <th>Address</th>
    <th>Invoice</th>
    <th>Created at</th>`;

    let tbody = document.createElement("tbody");
    _orders.map(order=>{
        console.log(order);
        let customerDetails = JSON.parse(order.customerDetails);
        let Address = `${customerDetails.Country}, ${customerDetails.City} ${customerDetails.Street}`;
        let tr = document.createElement("tr");
        tr.innerHTML = `
        <td>${order.id}</td>
        <td>${order.status}</td>
        <td>${customerDetails.FullName}</td>
        <td>${customerDetails.Email}</td>
        <td>${customerDetails.Telegram}</td>
        <td>${Address}</td>
        <td>${order.invoice_int}</td>
        <td>${order.created_at}</td>
        `
        $(tbody).append(tr);
    })

    $(table).append(thead);
    $(table).append(tbody);

    return table;
}
import Orders_Controller from "../../controllers/orders.controller.js"

const OrdersController = new Orders_Controller();
window.onload = ()=>{
    let filterBox = document.createElement("div");

    let orders = document.createElement("div");
    orders.className = "order_list";

    filterBox.innerHTML = `
    <div class="form-group">
    <label for="status">Filter by status: </label>
    <select id="status">
    <option value="">select</option>
    <option value="0">Pending</option>
    <option value="1">Paid</option>
    <option value="2">Underpaid</option>
    <option value="3">Over Paid</option>
    <option value="4">Expired</option>
    <option value="5">Cancelled</option>
    </select>
    `
    $(".page").html(filterBox);
    $(".page").append(orders);
    
    init();
}

const getFilters = ()=>
{
   const filter ={status: $("#status").val()}
   if(filter.status == "")
   delete filter.status;

   return filter;
}

const init = async()=>
{
    let filters = getFilters();
    let orders = await OrdersController.getOrders(filters);

    let divBox = document.createElement("div");
    divBox.style = "max-height:500px;overflow:scroll;"
    divBox.className = "table-responsive";
    
    let table = createOrdersTable(orders);
    
    $(divBox).append(table);

    $(".order_list").html(divBox)
}

const createOrdersTable = (_orders)=>
{
    let statusOrder = ["Pending", "Paid", "Underpaid", "Over Paid", "Expired", "Cancelled"];
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
    <th>items<small>(id/count)</small></th>
    <th>Total</th>
    <th>Created at</th>`;

    let tbody = document.createElement("tbody");
    _orders.map(order=>{
        let items = JSON.parse(order.items);
        let items_selected = []
        for (const [key, value] of Object.entries(items)) {
            items_selected.push(`${key}/${value}`);
          }
        let orderDetails = JSON.parse(order.details);
        console.log(orderDetails);
        let customerDetails = JSON.parse(order.customerDetails);
        let Address = `${customerDetails.Country}, ${customerDetails.City} ${customerDetails.Street}`;
        let tr = document.createElement("tr");
        tr.innerHTML = `
        <td>${order.id}</td>
        <td>${statusOrder[order.status]}</td>
        <td>${customerDetails.FullName}</td>
        <td>${customerDetails.Email}</td>
        <td>${customerDetails.Telegram}</td>
        <td>${Address}</td>
        <td><a href='https://coinremitter.com/invoice/${order.invoice_ext}' target=_blank>${order.invoice_int}</a></td>
        <td>${items_selected.join(", ")}</td>
        <td>${orderDetails.msg.data.total_amount.BTC}</td>
        <td>${order.created_at}</td>
        `
        $(tbody).append(tr);
    })

    $(table).append(thead);
    $(table).append(tbody);

    return table;
}

$(document).on("change", "#status", function(){
    console.log($(this).val());
   init($(this).val());
})
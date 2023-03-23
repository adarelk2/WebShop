import callAPI from "../utilities/callAPI.js";
window.onload = ()=>
{
    let api = new callAPI();
    api.get("/API/index.php", {method:"getItems", controller:"items", params:{active:1}}).then(res=>{
    console.log(res);
   });
}
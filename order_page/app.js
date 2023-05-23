'use strict';
const bars = document.querySelector(".bars");
const contact = document.querySelector('.contact');
const cat = document.querySelector('.categories');
const searchBar = document.querySelector(".search-bar");
const login = document.querySelector('.login');
const cart = document.querySelector('.cart');
const search = document.querySelector(".search");
const searchResult = document.querySelector(".search-result");
const faTimes = document.querySelector(".fa-times");


search.addEventListener("click",()=>{
    searchBar.classList.toggle("show-searchbar");
    login.classList.toggle("show-login");
    cart.classList.toggle("show-cart");
    search.classList.toggle("show-search");
})
faTimes.addEventListener("click",()=>{
    searchBar.classList.toggle("show-searchbar");
    login.classList.toggle("show-login");
    cart.classList.toggle("show-cart");
    search.classList.toggle("show-search");
})

//order page

function orderPage(){
    let placeorder = document.querySelector(".placeorder");
    let customerName = document.querySelector(".hiddencustomer");
    let xml = new XMLHttpRequest();
    xml.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            console.log(this.responseText);
            let response = JSON.parse(this.responseText);
            let quantity = response[1];
            let price = response[0];
            placeorder.innerHTML =  `
            <p>Collection place: huddersfields</p>
            <hr> 
                <h1>Order summary</h1>
                <p class="totalitems">Items total: ${quantity}</p>
                <p class="totalpayment">Total payment: £${price}</p>
                <p class="tax">All taxes included</p>
                <button class="orderbtn">Place order</button>
           
            `;
            invoicemodal();
        }
    }
    xml.open("POST", "orderPage.php?name="+customerName.value, true);
    xml.send();



}
orderPage();



function invoicemodal(){
    const backdrop = document.querySelector(".backdrop");
    const orderBtn = document.querySelector(".orderbtn");
    const invoice = document.querySelector(".invoice");
    const cross = document.querySelector(".invoice .cross i");
    console.log(orderBtn);
    orderBtn.addEventListener("click",()=>{
        console.log("hello");
        invoice.classList.remove("hideinvoice");
        backdrop.classList.remove('hidebackdrop');
    })
    backdrop.addEventListener("click",()=>{
        invoice.classList.add("hideinvoice");
        backdrop.classList.add('hidebackdrop');
    })
    cross.addEventListener("click",()=>{
        invoice.classList.add("hideinvoice");
        backdrop.classList.add('hidebackdrop');
    })

}



function getCookie(cname) {
    let name = cname + "=";
    let decodedCookie = decodeURIComponent(document.cookie);
    let ca = decodedCookie.split(';');
    for(let i = 0; i <ca.length; i++) {
      let c = ca[i];
      while (c.charAt(0) == ' ') {
        c = c.substring(1);
      }
      if (c.indexOf(name) == 0) {
        return c.substring(name.length, c.length);
      }
    }
    return "";
  }
// console.log(getCookie('color'));
if (getCookie('color')==='dark') {
    document.documentElement.style.setProperty('--primary-color', '#27374D');
    document.documentElement.style.setProperty('--secondary-color', '#526D82');
    document.documentElement.style.setProperty('--tertiary-color', '#9DB2BF');
    document.documentElement.style.setProperty('--black', '#000000');
    document.documentElement.style.setProperty('--white', '#DDE6ED');
    document.documentElement.style.setProperty('--selected', '#000000');
    document.documentElement.style.color = '#FFFFFF';
    document.documentElement.style.opacity = '87%';

} else {
    document.documentElement.style.setProperty('--primary-color', '#D10000');
    document.documentElement.style.setProperty('--secondary-color', '#0C6980');
    document.documentElement.style.setProperty('--tertiary-color', '#228B22');
    document.documentElement.style.setProperty('--black', '#000000');
    document.documentElement.style.setProperty('--white', '#ffffff');
    document.documentElement.style.setProperty('--selected', '#D9D9D9');
    document.documentElement.style.color = 'black';



}

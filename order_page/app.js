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
        }
    }
    xml.open("POST", "orderPage.php?name="+customerName.value, true);
    xml.send();



}
orderPage();
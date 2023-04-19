'use strict';
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

// login page 

const label = document.querySelectorAll(".form-box form .input-box label");
let valueInput = document.querySelectorAll(".form-box form input");
label.forEach((item,i)=>{
    let value = valueInput.value;
    console.log('hello');
    let arr = [];
    arr.push(value);
    item.addEventListener("onfocusout",()=>{
        value = "";
    })
    item.addEventListener("onfocusin",()=>{
        valueInput.value = arr[i];
    })
})
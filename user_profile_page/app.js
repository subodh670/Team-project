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

// switch tabs
//hide all tabs
const dashItems = document.querySelectorAll(".profilecontainer .dashitem");
const tabs = document.querySelectorAll(".dashprofile p");
tabs.forEach((tab,i)=>{
    dashItems[i].style.display = 'none';
    dashItems[0].style.display = 'flex';
    tab.addEventListener("click",(e)=>{
        let id = e.currentTarget.dataset.go;
        document.querySelector(`#${id}`).style.display = "flex";
        for(let j=0; j<4; j++){
            if(j!=i){
                dashItems[j].style.display = 'none';
            }
        }
    })
})
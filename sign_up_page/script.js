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

// flash messages

const errormsg = document.querySelectorAll(".container-sign form p");
errormsg.forEach((item)=>{
    setTimeout(()=>{
        item.style.display = 'none';
    }, 10000)
})


// two forms in one

const nextBtn = document.querySelectorAll(".btn p")[0];
const prevBtn = document.querySelectorAll(".btn p")[1];
const form1 = document.querySelector("form .wrapper:nth-child(1)");
const form2 = document.querySelector("form .wrapper:nth-child(2)");
nextBtn.addEventListener("click",()=>{
    form1.classList.add('showwrap');
    form2.style.display = 'flex';
    form2.style.position = 'absolute';
    form2.style.transform = 'translate(-50%,-50%)';
    form2.style.top = '50%';
    form2.style.left = '50%';
})
prevBtn.addEventListener('click',()=>{
    form1.classList.remove('showwrap');
    form1.classList.add("animateme");
    form2.classList.add('animateme2');
    form2.style.display = 'none';
    form2.style.position = 'relative';
    form1.style.animateNae = 'animateform1first';
})
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

const errormsg = document.querySelectorAll(".container-sign .signup p");
errormsg.forEach((item)=>{
    setTimeout(()=>{
        item.style.display = 'none';
    }, 10000)
})


// two forms in one

const nextBtn = document.querySelectorAll(".btn h4")[0];
const prevBtn = document.querySelectorAll(".btn h4")[1];
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
    document.documentElement.style.color = 'white';

} else {
    document.documentElement.style.setProperty('--primary-color', '#D10000');
    document.documentElement.style.setProperty('--secondary-color', '#0C6980');
    document.documentElement.style.setProperty('--tertiary-color', '#228B22');
    document.documentElement.style.setProperty('--black', '#000000');
    document.documentElement.style.setProperty('--white', '#ffffff');
    document.documentElement.style.setProperty('--selected', '#D9D9D9');
    document.documentElement.style.color = 'black';



}

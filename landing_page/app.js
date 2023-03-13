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


bars.addEventListener("click",(e)=>{
    cat.classList.toggle("show-cat");
});
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



//slides show

const photos = document.querySelectorAll(".slider>div");
const slider1 = document.querySelector(".slider");
const circle1 = document.querySelector(".circle1");
const circle = document.querySelectorAll(".circle");
const circle2 = document.querySelector(".circle2");
const circle3 = document.querySelector(".circle3");
const infoImg = document.querySelectorAll(".info-img");
const photosImg =  document.querySelectorAll(".slider>div img");
const navSlide = document.querySelector(".navslide");

photos.forEach((item, i)=>{
    item.style.right = `-${i*100}%`;
    
})

circle.forEach((item,i)=>{
    circle[0].style.backgroundColor = '#3F36E9';
    item.addEventListener("click",()=>{
        for(let j=0; j<3; j++){
            if(j===i){
                circle[j].style.backgroundColor = '#3F36E9';
            }
            else{
                circle[j].style.backgroundColor = 'gray';
                
            }
        }
    })
})


photosImg.forEach((photo,i)=>{
    photo.addEventListener("click",(e)=>{
        infoImg[i].classList.toggle("show-info-img");
        navSlide.classList.toggle('shownavslide');
    })
    
})

function slidebyBut(){
    circle1.addEventListener("click",()=>{
        photos.forEach((photo,i)=>{
            photo.style.transform = `translateX(-${0*100}%)`;
        })
    })
    circle2.addEventListener("click",()=>{
        photos.forEach((photo,i)=>{
            photo.style.transform = `translateX(-${1*100}%)`;
        })
    
    })
    circle3.addEventListener("click",()=>{
        photos.forEach((photo,i)=>{
            photo.style.transform = `translateX(-${2*100}%)`;
        })
    })
}
slidebyBut();
let count = 0;
function slider(count){
    if(count>2){
        count = 0;
    }
    setTimeout(()=>{
        photos.forEach((photo,i)=>{
            photo.style.transform = `translateX(-${count*100}%)`;
        })
        count++;
        slider(count);
    },1200 )
}
// slider(count);


//mouse over price

const prices = document.querySelectorAll(".price");
prices.forEach((price)=>{
    price.addEventListener("mouseover",(e)=>{
        price.innerHTML = 'Rs: 1200/-';
        price.style.textDecoration = 'line-through';
    })
})
prices.forEach((price)=>{
    price.addEventListener('mouseout',(e)=>{
        price.innerHTML = 'Rs: 1000/-';
        price.style.textDecoration = 'none';
    })
})



//categories close

const closeCat =  document.querySelector(".close-cat");
closeCat.addEventListener("click",()=>{
    cat.classList.toggle("show-cat");
})
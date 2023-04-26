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


//main photo of item changer after click

const mainImg = document.querySelector(".main-img img");
const subimg = document.querySelectorAll(".sub-img img");
mainImg.src = subimg[1].src;

subimg.forEach((img)=>{
    img.addEventListener("click",(e)=>{
        mainImg.src = img.src;
    })
})



//Displaying reviews

const ratingsReview = document.querySelector(".ratingsreviews");
let idPro = document.querySelectorAll(".cust-review input")[0].value;
let username = document.querySelectorAll(".cust-review input")[1].value;



function displayReview(){
    ratingsReview.innerHTML = '<h1>Ratings and Reviews</h1>';
    let httpXml = new XMLHttpRequest();
    httpXml.onreadystatechange = function(){
        if(this.readyState == 4 && this.status==200){
            let response = JSON.parse(this.responseText);
            for(let i=0; i<response.length; i++){
                let username = response[i][0];
                let image = response[i][1];
                let review = response[i][2];
                ratingsReview.innerHTML += `
                <div class="personandrating">
                  <div class="person">
                    <img src="../images/${image}" alt="profileimage">
                    <p class="username">${username}</p>
                    <div class="rate_product">
                      <p><i class="fa-solid fa-star"></i></p>
                      <p><i class="fa-solid fa-star"></i></p>
                      <p><i class="fa-solid fa-star"></i></p>
                      <p><i class="fa-solid fa-star"></i></p>
                      <p><i class="fa-regular fa-star"></i></p>
                    </div>
                  </div>
          
                </div>
                <div class="message">
                  <p>${review}</p>
                </div>`;
            }
            // console.log(this.responseText);
        }
    }
    httpXml.open("POST", `display_comment.php?pid=${idPro}`, true);
    httpXml.send();

}

displayReview();


// add reviews

const commentBox = document.querySelector(".cust-review textarea");
const butReview = document.querySelector(".cust-review button");


if(butReview != null){
    butReview.addEventListener("click",()=>{
        let comment = commentBox.value;
        let json1 = new XMLHttpRequest();
        json1.onreadystatechange = function(){
            if(this.readyState == 4 && this.status == 200){
                comment = "";
                displayReview();
            }
        }
        json1.open("POST", `comment.php?comment=${comment}&idPro=${idPro}&c_username=${username}`,true);
        json1.send();
    })
}



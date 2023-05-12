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
    const commentBox = document.querySelector(".cust-review textarea");
    let httpXml = new XMLHttpRequest();
    httpXml.onreadystatechange = function(){
        if(this.readyState == 4 && this.status==200){
            console.log(this.responseText); 
            let response = JSON.parse(this.responseText);
            // console.log(usernameLocal,image, review, reviewID); 
            for(let i=0; i<response.length; i++){
                let usernameLocal = response[i][0];
                let image = response[i][1];
                let review = response[i][2];
                let reviewID = response[i][3];
                if(username == usernameLocal){
                    ratingsReview.innerHTML += ` <div class="personandrating">
                    <div class="person">
                      <img src="../images/${image}" alt="profileimage">
                      <p class="username">${usernameLocal}</p>
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
                    <input type='hidden' value="${reviewID}">
                    <button class="deletereview">Delete</button>
                  </div>`;
                }
                else{
                    ratingsReview.innerHTML += `
                    <div class="personandrating">
                      <div class="person">
                        <img src="../images/${image}" alt="profileimage">
                        <p class="username">${usernameLocal}</p>
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
                
            }
            // addReview();
            if(commentBox != null){
                commentBox.value = "";
            }
            // delete review or comment
            function deleteReview(){
                const deleteReview = document.querySelectorAll(".message input");
                const deletebtn = document.querySelectorAll(".message button");
                deleteReview.forEach((dr,i)=>{
                        deletebtn[i].addEventListener("click",()=>{
                        let xml = new XMLHttpRequest();
                        xml.onreadystatechange = function(){
                            if(this.readyState == 4 && this.status == 200){
                                displayReview();
                            }
                        }
                        xml.open("POST",`deletereview.php?commentid=${dr.value}`, true);
                        xml.send();
                    })
                })
            }
            deleteReview();
            // console.log(this.responseText);
        }
    }
    httpXml.open("POST", `display_comment.php?pid=${idPro}`, true);
    httpXml.send();

}

displayReview();


// add reviews or comment

const commentBox = document.querySelector(".cust-review textarea");
const butReview = document.querySelector(".cust-review button");


function addReview(){
    const commentBox = document.querySelector(".cust-review textarea");
    const butReview = document.querySelector(".cust-review button");
    const emptytextarea = document.querySelector(".emptytextarea");
    let rate = rate_product();
    console.log(rate);
    if(emptytextarea != null && commentBox != null && butReview != null){
        
        butReview.addEventListener("click",()=>{
            let comment = commentBox.value;
            console.log(comment);
            if(comment!=""){
                let json1 = new XMLHttpRequest();
                json1.onreadystatechange = function(){
                    if(this.readyState == 4 && this.status == 200){
                        console.log(this.responseText);
                        comment = "";
                        displayReview();
                    }
                }
                json1.open("POST", `comment.php?comment=${comment}&idPro=${idPro}&c_username=${username}&rate=${rate}`,true);
                json1.send();
            }
            else{
                emptytextarea.textContent = "Please type something to comment";
            }
            
        })
    }
    
}
addReview();
// }

//quantity error 

const errorQuant = document.querySelector('.quantity .quantity_error');
setTimeout(()=>{
    errorQuant.style.display = "none";
},10000);        


//hiding and showing signin page

const modalLogin = document.querySelector('.modal-login');
const closeSignIn = document.querySelector(".modal-login .close-signin");
const backdrop = document.querySelector(".backdrop");

if(closeSignIn !=null){

    closeSignIn.addEventListener("click",()=>{
        modalLogin.style.display = 'none';
        backdrop.style.display = 'none';
    })
}
if(backdrop != null){

    backdrop.addEventListener("click",()=>{
        modalLogin.style.display = 'none';
        backdrop.style.display = 'none';
    })
}

// increase quantity

function increaseQuant(){

    let value = 1;
    let butInc = document.querySelectorAll(".quantity button")[1];
    let butDec = document.querySelectorAll(".quantity button")[0];
    let inputValue = document.querySelector(".quantity input");
    let hiddenQuantity = document.querySelector(".hiddenQ").value;
    // console.log(butInc);
    butInc.onclick = () =>{
        value++;
        // console.log(hiddenQuantity);
        inputValue.value = value;
        if(value >= hiddenQuantity){
            inputValue.value = hiddenQuantity;
            value = hiddenQuantity;
        }
    }
    butDec.onclick = () =>{
        value--;
        inputValue.value = value;
        console.log(value);
        if(value <= 1){
            inputValue.value = 1;
            value = 1;
        }
    }
    

}
increaseQuant();



//data love in javascript

function wishlist(){
    let wishLove = document.querySelector(".ratings-sec > i");
    wishLove.addEventListener("click",()=>{
        if(wishLove.classList.contains('fa-solid')){
            wishLove.classList.remove("fa-solid");
            wishLove.classList.add("fa-regular");
            wishLove.dataset.love = "0";
        }
        else{
            wishLove.classList.remove("fa-regular");
            wishLove.classList.add("fa-solid");
            wishLove.dataset.love = "1";

        }
        let ajax = new XMLHttpRequest();
        ajax.onreadystatechange = function(){
            if(this.readyState == 4 && this.status == 200){
                console.log(this.responseText);
            }
        }
        let proId = document.querySelectorAll(".cust-review input")[0].value;
        let custname = document.querySelectorAll(".cust-review input")[1].value;
        ajax.open("POST", `wishlist.php?wish=${wishLove.dataset.love}&proid=${proId}&custname=${custname}`, true)
        ajax.send();

    })
}
if(document.querySelectorAll(".cust-review input")[1].value != null){
    wishlist();
}


function rate_product(){
    let proId = document.querySelectorAll(".cust-review input")[0].value;
    let custname = document.querySelectorAll(".cust-review input")[1].value;
    let ratings = document.querySelectorAll(".onlyrating p i");
    let rate = null;
    ratings.forEach((rating,i)=>{
        rating.addEventListener("click",()=>{
            // console.log(rating);
            for(let j=0; j<=i; j++){
                ratings[j].classList.remove("fa-regular");
                ratings[j].classList.add("fa-solid");

            }
            for(let j=i+1; j<=4; j++){
                ratings[j].classList.add("fa-regular");
                ratings[j].classList.remove("fa-solid");
            }
            let xml = new XMLHttpRequest();
            xml.onreadystatechange = function(){
                if(this.readyState == 4 && this.status == 200){
                    // console.log(this.responseText);
                }
            }
            xml.open("POST", `rateProduct.php?proid=${proId}&custname=${custname}&star=${i+1}`, true);
            xml.send();
            rate = i+1;
            
        })
        rate = 0;

    })
    return rate;

}
rate_product();

// function rateInComment(){
//     let proId = document.querySelectorAll(".cust-review input")[0].value;
//     let custname = document.querySelectorAll(".cust-review input")[1].value;
//     const rateProduct = document.querySelectorAll(".ratingsreviews .rate_product");
//     rateProduct.forEach((item)=>{
//         let xml = new XMLHttpRequest();
//         xml.onreadystatechange = function(){
//             if(this.readyState == 4 && this.status == 200){
//                 console.log(this.responseText);
//             }
//         }
//         xml.open("POST", `displayRate.php?proid=${proId}`, true);
//         xml.send();
//         // item.innerHTML = ``;
//     })
// }
// // rateInComment();
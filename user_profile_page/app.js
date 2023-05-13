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
    tabs[0].style.fontWeight = 'bolder';
    tab.addEventListener("click",(e)=>{
        tab.style.fontWeight = 'bolder';
        let id = e.currentTarget.dataset.go;
        document.querySelector(`#${id}`).style.display = "flex";
        for(let j=0; j<4; j++){
            if(j!=i){
                dashItems[j].style.display = 'none';
                tabs[j].style.fontWeight = 'normal';
            }
        }
    })
})


// update customer info

// open updated customer info

const triggerEditBtn = document.querySelector(".editbtntrigger");
const editprofilemodal = document.querySelector(".editprofile");
const xmarkClose = document.querySelector(".xmark i");
const backdrop = document.querySelector(".backdrop");


    triggerEditBtn.addEventListener("click",(e)=>{
        editprofilemodal.classList.remove("hideEditprofile");
        backdrop.classList.remove("hidebackdrop");
    })
    xmarkClose.addEventListener("click",()=>{
        editprofilemodal.classList.add("hideEditprofile");
        backdrop.classList.add("hidebackdrop");
        
    })
    backdrop.addEventListener("click",()=>{
        editprofilemodal.classList.add("hideEditprofile");
        backdrop.classList.add("hidebackdrop");
    })


// edit customer profile

function editCustPro(){
    const username = document.querySelector(".editusername input");
    const useremail = document.querySelector(".editemail input");
    const userfirstname = document.querySelector(".editfirstname input");
    const userlastname = document.querySelector(".editlastname input");
    const editmobile = document.querySelector('.editmobile input');
    const editgender = document.querySelector('.editgender select');
    const gendervalue = editgender.options[editgender.selectedIndex].value;
    const editaddress = document.querySelector('.editaddress input');
    const updateBtn = document.querySelector(".updatebtn2 button");
    const cid = document.querySelector(".chidden");
    const errorusername = document.querySelector(".errorusername");
    const erroremail = document.querySelector(".erroremail");
    const errormobile = document.querySelector(".errormobile");
    // console.log(updateBtn);
    updateBtn.addEventListener("click",()=>{
        console.log(updateBtn);
        let xmlHttp = new XMLHttpRequest();
        xmlHttp.onreadystatechange = function(){
            if(this.readyState == 4 && this.status == 200){
                console.log(this.responseText);
                let response = JSON.parse(this.responseText);
                if(response[1]==true && response[2]==true && response[0]==true && response[3]==false){
                    // console.log("hello");
                    location.reload();
                }
                if(response[1]===false){
                    errorusername.textContent = 'Username already exists';
                }
                else if(response[2]===false){
                    errormobile.textContent = 'mobile number is already found in database';
                }
                else if(response[0]===false){
                     errormobile.textContent = 'Email address is already found in database';
                }
                if(response[3] === true){
                    window.location.href = "http://localhost/Team%20project-oracle/Team-project/otp_page/index.php";
                }
            }
        }
        xmlHttp.open("POST", `updateprofile.php?name=${username.value}&email=${useremail.value}&firstname=${userfirstname.value}&lastname=${userlastname.value}&mobile=${editmobile.value}&gender=${gendervalue}&address=${editaddress.value}&cid=${cid.value}`, true );
        xmlHttp.send();
    }
    )
}
editCustPro();


// edit password customers
const changepassbtn = document.querySelector(".changepassbtn");
const updatepassdiv = document.querySelector('.updatepass');
const xmarkClose1 = document.querySelector(".xmark1 i");
changepassbtn.addEventListener("click",()=>{
    updatepassdiv.classList.remove('hidepass');
    backdrop.classList.remove("hidebackdrop");
})
xmarkClose1.addEventListener("click",(e)=>{
    updatepassdiv.classList.add('hidepass');
    backdrop.classList.add("hidebackdrop");
})
backdrop.addEventListener("click",()=>{
    updatepassdiv.classList.add('hidepass');
    backdrop.classList.add("hidebackdrop");
})
const errorsflash = document.querySelector(".errorsflash");
setTimeout(()=>{
    errorsflash.style.display = 'none';
},6000);


//delete review
function deleteReview(){

    let reviewdelete = document.querySelectorAll(".review-comment .deletereviewbtn");
    let dashItem = document.querySelector(".dashitem2");
    console.log(reviewdelete);
    let reviewId = document.querySelectorAll(".review-comment .reviewid");
    reviewdelete.forEach((item,i)=>{
        item.addEventListener("click",()=>{
            reviewId = reviewId[i]?.value;
            let xml = new XMLHttpRequest();
            xml.onreadystatechange = function(){
                if(this.readyState == 4 && this.status == 200){
                    window.location.reload();
                    // window.location.replace = "index.php#review";
                }
            }
            xml.open("POST", `deletereview.php?id=${reviewId}`, true);
            xml.send();
        })
    })
}
deleteReview();

function wishtocart(){

    const wishToCartBtn = document.querySelectorAll(".wishtocartbtn");
    let wishlistid = document.querySelectorAll(".wishlistidclass");
    let wishlistname = document.querySelectorAll(".wishlistnameclass");
    let cid = document.querySelector(".dashitem3 .cid");
    console.log(wishToCartBtn);
    wishToCartBtn.forEach((item,i)=>{
        item.addEventListener("click",()=>{
            wishlistid = wishlistid[i].value;
            wishlistname = wishlistname[i].value;
            let xml = new XMLHttpRequest();
            xml.onreadystatechange = function(){
                if(this.readyState == 4 && this.status == 200){
                  location.reload();
                    // console.log(this.responseText);
                }
            }
            xml.open("POST", `wishtocart.php?id=${wishlistid}&name=${wishlistname}&cid=${cid}`, true);
            xml.send();
        })
    })
}
wishtocart();
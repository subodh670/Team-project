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
    circle[0].style.backgroundColor = 'var(--secondary-color)';
    item.addEventListener("click",()=>{
        for(let j=0; j<3; j++){
            if(j===i){
                circle[j].style.backgroundColor = 'var(--secondary-color)';
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
    },5000)
}
// slider(count);


//mouse over price







//categories close

const closeCat =  document.querySelector(".close-cat");
closeCat.addEventListener("click",()=>{
    cat.classList.toggle("show-cat");
})


// flash login page
const flashlogin = document.querySelector(".flashlogin");
setTimeout(()=>{
    flashlogin.style.display = 'none';
}, 5000);



// ajax for landing page items
const seeMore = document.querySelector(".loader h1");

function gettingProduct(type, items){
    let itemsContainer = document.querySelector(".items-container");
    const xmlhttp = new XMLHttpRequest();
    const loaderItem = document.querySelector(".loader span");
    loaderItem.textContent = "";
    let content = itemsContainer.innerHTML;
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            const item = JSON.parse(this.responseText);
            let pId = item['PRODUCT_ID'];
            let pName = item['PRODUCT_NAME'];
            var pPrice = item["PRODUCT_PRICE"];
            let pQuantity = item['PRODUCT_QUANTITY'];
            let pDesc = item['PRODUCT_DESCRIPTION'];
            let pCategory = item['PRODUCT_CATEGORY'];
            var pDiscount = item['PRODUCT_DISCOUNT'];
            let pAllergy = item['PRODUCT_ALLERGY_INFORMATION'];
            let pImage1 = item['PRODUCT_IMAGE1'];
            let pImage2 = item['PRODUCT_IMAGE2'];
            let pImage3 = item['PRODUCT_IMAGE3'];
            let prevPrice = [];    
            itemsContainer.innerHTML = ""
                for(let i=0; i<pId.length; i++){
                    prevPrice.push(parseInt(Number(pPrice[i]) + (Number(pDiscount[i])*Number(pPrice[i]))/100));
                    if(type === null){
                        itemsContainer.innerHTML = content;
                    }
                    else if(type === 'load'){  
                        if(i===items){
                            break;
                        }
                        let itemsLength = pId.length - items;
                        loaderItem.textContent = itemsLength<0 ? `${0} Items remaining` : `${pId.length - items} Items remaining`;
                        itemsContainer.innerHTML += `<div class="item">
                        <img src="../productsImage/${pImage2[i]}" alt="productImage">
                        <div>
                            <h1>${pName[i]}</h1>
                            <p>${pDesc[i]}</p>
                            <div class="btn_rate">
                                <div class="btn"><a href="../item_page/index.php?id=${pId[i]}">View More</a></div>
                                <p class="price">£${pPrice[i]}</p>
        
                            </div>
                        </div>
                    </div>`;
                    
                    }
                }
            const prices = document.querySelectorAll(".price");
            prices.forEach((price,i)=>{
                price.addEventListener("mouseover",(e)=>{
                    price.innerHTML = "£"+prevPrice[i];
                    price.style.textDecoration = 'line-through';
                })
            })
            prices.forEach((price,i)=>{
                price.addEventListener('mouseout',(e)=>{
                    price.innerHTML = "£"+pPrice[i];
                    price.style.textDecoration = 'none';
                })
            })
            
        }
    };
    xmlhttp.open("POST", "product.php", true);
    xmlhttp.send();
}
gettingProduct(null, 9);

// price cut discount and viewing items in columnn and rows

const itemsContainer = document.querySelector(".items-container");
const viewItemsGrid = document.querySelectorAll(".pricefilter .view-range i")[0];
const viewItemsList = document.querySelectorAll(".pricefilter .view-range i")[1];
let itemSingle = document.querySelectorAll(".items-container>div");

viewItemsGrid.style.color = 'black';
viewItemsList.addEventListener("click",()=>{
    viewItemsList.style.color = 'black';
    viewItemsGrid.style.color = 'white';
    itemsContainer.style.flexDirection = 'column';
})


itemSingle.forEach((item1)=>{
    item1.style.flexDirection = '';
})
viewItemsGrid.addEventListener("click",()=>{
    itemsContainer.style.flexDirection = 'row';
    viewItemsList.style.color = 'white';
    viewItemsGrid.style.color = 'black';
    itemSingle.forEach((item)=>{
        item.style.flexDirection = 'column';
        item.style.width = '28%';
        item.style.margin = '0px 0px';
    })
})


//see more items

let noItems = 9;
seeMore.addEventListener("click",()=>{
    noItems += 6;
    gettingProduct("load", noItems);
})


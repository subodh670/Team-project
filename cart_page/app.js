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

// select items





function selectboxMain(){
    const selectAllPro = document.querySelector("input[name=selectallpro]");
    const mainselectall = document.querySelectorAll("input[name=mainselectall]");
    selectAllPro.addEventListener("change",()=>{
        if(selectAllPro.checked){
            mainselectall.forEach((item,i)=>{

                item.checked = true;
                const el = document.querySelectorAll(`.oneitemselect${i} .orderitem`);
                el.forEach((prod)=>{
                    prod.checked = true;
                })
            })
        }
        else{
            mainselectall.forEach((item,i)=>{

                item.checked = false;
                const el = document.querySelectorAll(`.oneitemselect${i} .orderitem`);
                    el.forEach((prod)=>{
                        prod.checked = false;
                    })

            })
        }
    })
    mainselectall.forEach((item,i)=>{
            item.parentElement.parentElement.parentElement.classList.add(`oneitemselect${i}`);
            item.addEventListener("change",()=>{
                if(item.checked){
                    const el = document.querySelectorAll(`.oneitemselect${i} .orderitem`);
                    el.forEach((prod)=>{
                        prod.checked = true;
                    })
                }
                else{
                    const el = document.querySelectorAll(`.oneitemselect${i} .orderitem`);
                    el.forEach((prod)=>{
                        prod.checked = false;
                    })
                }
            })
    })

}
selectboxMain();



//  increasing prices


function cartCounter(){
    const increaseCount = document.querySelectorAll(".price--qty .countitem input");
const increaseValue = document.querySelectorAll('.price--qty .countitem .increase');
const decreaseValue = document.querySelectorAll('.price--qty .countitem .decrease');
const priceIncrease = document.querySelectorAll(".price--qty .wish_price_del p");
let globalPrice = null;
    increaseValue.forEach((item,i)=>{
    globalPrice = Number(priceIncrease[i].textContent.substring(5));
        item.addEventListener("click",(e)=>{
            increaseCount[i].value = Number(increaseCount[i].value)+1;
            let price = Number(priceIncrease[i].textContent.substring(5));
            price += globalPrice;
            priceIncrease[i].innerHTML =  `Rs: £${price}`;
        })
    })
    decreaseValue.forEach((item,i)=>{
    globalPrice = Number(priceIncrease[i].textContent.substring(5));
        item.addEventListener("click",(e)=>{
            if(Number(increaseCount[i].value) <= 0){
                increaseCount[i].value = 0;
            }
            else{
                increaseCount[i].value = `${Number(increaseCount[i].value)-1}`;
                let price = Number(priceIncrease[i].textContent.substring(5));
            price -= globalPrice;
            priceIncrease[i].innerHTML =  `Rs: £${price}`;
            }
        })
    })
}
cartCounter();


// total cost

function totalCost(unique){
    let total = 0;
    let checkedItem = document.querySelectorAll(".productselect .orderitem");
    let prices = document.querySelectorAll(".price--qty .wish_price_del p");
    let finalExpense = document.querySelectorAll(".container-order .total p");
    checkedItem.forEach((item,i)=>{
        
        // item.addEventListener("change",()=>{
        //     if(item.checked){
        //         let cost = Number(prices[i].textContent.substring(5));
        //         total += cost;
        //     }
        //     else{
        //         let cost = Number(prices[i].textContent.substring(5));
        //         total -= cost;
        //     }
        //     finalExpense[1].textContent = `£${total}`;
    
        // })
        if(item.value === 'on' && unique === 'var1'){
            console.log(item.value);
            let cost = Number(prices[i].textContent.substring(5));
            total += cost;
        }
        else if(item.value === 'off' && unique === 'var2'){
            console.log(item.value);
            let cost = Number(prices[i].textContent.substring(5));
            total -= cost;
        }
        finalExpense[1].textContent = `£${total}`;
    })
}




// ajax for displaying the saved products in cart

function showingsavedProduct(){

    const oneItemSelect = document.querySelector("main");

    let xml1 = new XMLHttpRequest();
    xml1.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
           let items = JSON.parse(this.responseText);
            // console.log(items);
            items.forEach((item)=>{
                let productName = item[0];
                let productPrice = item[1];
                let shopId = item[2];
                let shopName = item[3];
                let productQuantity = item[4];
                let productCategory = item[5];
                let productImage2 = item[6];
                let productId = item[7];
                let productssaved = item[8];
                oneItemSelect.innerHTML += `
                <section class="oneitemselect">
                <div class="selectone">
                    <div class="onlyone">
                        <input type="checkbox" name="mainselectall">
                        <p>${shopName}</p>
                    </div>
                </div>
                <div class="productselect">
                    <div class="onlyone">
                        <input type="checkbox" name="secselect" class="orderitem">
                        <div class="product-desc">
                            <img src="../productsImage/${productImage2}" alt="">
                            <div class="desc">
                                <p>${productName}</p>
                                <p>${productCategory}</p>
                                <p>only ${productQuantity} items remaining</p>
                            </div>
                        </div>
                    </div>
                    <div class="price--qty">
                        <div class="wish_price_del">
                            <p>Rs: £${productPrice}</p>
                            <div>
                            <input class="getProid" type='hidden' value=${productId}>
                                <i data-love='0' class="fa-regular fa-heart"></i>
                               
                                <i class="fa-solid fa-trash-can"></i>
            
                                
                            </div>
                        </div>
                        <div class="countitem">
                            <button class="decrease">-</button>
                          <input type="text" value="${productssaved}">
                          <button class="increase">+</button>
                        </div>
                    </div>
                </div>
            </section>
                `;
            })
            selectboxMain();
            cartCounter();
            heartItem();

        }
    }
    xml1.open("POST", "displaySave.php?cid=", true);
    xml1.send();

}
showingsavedProduct();


function heartItem(){
    const heartIcon = document.querySelectorAll(".wish_price_del .fa-heart");
    const proidset = document.querySelectorAll(".getProid");
    const username = document.querySelector(".usernameFind").value;
    heartIcon.forEach((icon,i)=>{
        let xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function(){
            if(this.readyState == 4 && this.status == 200){
                if(JSON.parse(this.responseText)[0]==0){
                    icon.classList.add("fa-regular");
                    icon.classList.remove("fa-solid");
                    icon.dataset.love = '0';

                }
                else{
                    icon.classList.add("fa-solid");
                    icon.classList.remove("fa-regular");
                    icon.dataset.love = '1';
                }
            }

        }
        xmlhttp.open("POST",`getReact.php?proId=${proidset[i].value}&username=${username}`, true);
        xmlhttp.send();
    })  



    heartIcon.forEach((icon,i)=>{ 
        icon.addEventListener("click",()=>{
            if(icon.classList.contains("fa-regular")) {
                icon.classList.add("fa-solid");
                icon.classList.remove("fa-regular");
                icon.dataset.love = '1';
            } 
            else if(icon.classList.contains("fa-solid")) {
                icon.classList.add("fa-regular");
                icon.classList.remove("fa-solid");
                icon.dataset.love = '0';

            }
            let reactXml = new XMLHttpRequest();
            reactXml.onreadystatechange = function(){
                if(this.readyState == 4 && this.status == 200){
                    console.log(this.responseText);
                }
            }
            reactXml.open("POST", `reactItem.php?proId=${proidset[i].value}&wish=${icon.dataset.love}&custname=${username}`, true);
            reactXml.send();  
        })
    })
  
    
      
}
function deleteCartItem(){
    const trashIcon = document.querySelectorAll(".wish_price_del .fa-trash-can");
    trashIcon.forEach((trash,i)=>{
        trash.addEventListener("click",()=>{
            let xml = new XMLHttpRequest();
            xml.onreadystatechange = () =>{
                if(this.readyState == 4 && this.status == 200){

                }
            }
            xml.open("POST", "deletCartItem.php", true);
            xml.send();
        })
    })
}
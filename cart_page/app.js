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


//prevent default in keypress

function preventTyping(){
    const countItem = document.querySelectorAll(".countitem input");
    countItem.forEach((item)=>{
        // console.log(item);
        item.addEventListener("change",(e)=>{
            if(isNaN(item.value)){
                item.value = 0;  
                // e.preventDefault();
            }
        })
        
    })
    

}

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
// selectboxMain();


// checking the checkbox of items
function checkingItems(){
        const checkBoxItems = document.querySelectorAll(".productselect .onlyone input");
        // console.log(checkBoxItems);
        checkBoxItems.forEach((checkitem,i)=>{
            // console.log(checkitem);
            checkitem.addEventListener("change",(e)=>{
                // console.log(e.target);
                // checkBoxItems();
                let isChecked = e.target.matches(':checked');
                checkitem.dataset.tick = "1" ? isChecked === true : "0";
                // console.log(checkitem);
    
            })
        })
    
}
// checkingItems();


// adding checked item to database



//  increasing prices


function cartCounter(){
    const increaseCount = document.querySelectorAll(".price--qty .countitem input");
const increaseValue = document.querySelectorAll('.price--qty .countitem .increase');
const decreaseValue = document.querySelectorAll('.price--qty .countitem .decrease');
// const priceIncrease = document.querySelectorAll(".price--qty .wish_price_del p");
let globalPrice = null;
    increaseValue.forEach((item,i)=>{
    // globalPrice = Number(priceIncrease[i].textContent.substring(5));
        item.addEventListener("click",(e)=>{
            
                increaseCount[i].value = Number(increaseCount[i].value)+1;
            
            // let price = Number(priceIncrease[i].textContent.substring(5));
            // price += globalPrice;
            // priceIncrease[i].innerHTML =  `Rs: £${price}`;
        })
    })
    decreaseValue.forEach((item,i)=>{
    // globalPrice = Number(priceIncrease[i].textContent.substring(5));
        item.addEventListener("click",(e)=>{
            if(Number(increaseCount[i].value) <= 0){
                

                    increaseCount[i].value = 0;
                
            }
            else{
                

                    increaseCount[i].value = `${Number(increaseCount[i].value)-1}`;
                
                // let price = Number(priceIncrease[i].textContent.substring(5));
            // price -= globalPrice;
            // priceIncrease[i].innerHTML =  `Rs: £${price}`;
            }
        })
    })
}
// cartCounter();


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
            console.log(this.responseText);
           let items = JSON.parse(this.responseText);
            // console.log(items);
            let arr = [];
            // console.log(items);
            items.forEach((item,i)=>{
                let productName = item[0];
                let productPrice = item[1];
                let shopId = item[2];
                let shopName = item[3];
                let productQuantity = item[4];
                let productCategory = item[5];
                let productImage2 = item[6];
                let productId = item[7];
                let productssaved = item[8];
                arr.push(item[1]);
                console.log(productId);
                // let cookieQ = document.cookie;
                let cookieid = document.querySelector('.idcookie')?.value;
                let quantcookie = document.querySelector(".idquant")?.value;
                let arr1 = [];
                // console.log(quantcookie);
                if(cookieid != null && quantcookie != null){
                    let cookieQ2 = quantcookie.split(" ");
                    for(let i=0; i<cookieQ2.length; i++){
                        arr1.push(Number(cookieQ2[i]));
                        productssaved = Number(cookieQ2[i]);
                    }
                }
                // console.log(cookieid);
                // console.log(quantcookie);
                // console.log(arr1);

                // arr1 = 34;
                // console.log(cookieQ1, cookieQ2);
                // productssaved = productssaved != null ? productssaved : getcookie("quantity");
                if(items.length === 1 && items[0]===""){
                    oneItemSelect.innerHTML = "<h2 style='width: 100%; text-align: center;'>No products in your cart!!</h2>";
                }
                else{
                    oneItemSelect.innerHTML += `
                    <section class="oneitemselect">
                    <input type="hidden" value="${productId}" class="getproductid">
                    <div class="selectone">
                        <div class="onlyone">
                            <p>${shopName}</p>
                        </div>
                    </div>
                    <div class="productselect">
                        <div class="onlyone">
                            
                            <div class="product-desc">
                                <img src="../productsImage/${productImage2}" alt="">
                                <div class="desc">
                                    <p class="itempro">${productName}</p>
                                    <p>${productCategory}</p>
                                    <p>only ${productQuantity} items remaining</p>
                                </div>
                            </div>
                        </div>
                        <div class="price--qty">
                            <div class="wish_price_del">
                                <p>£${productPrice}</p>
                                <div>
                                <input class="getProid" type='hidden' value=${productId}>
                                    <i data-love='0' class="fa-regular fa-heart"></i>
                                   
                                    <i class="fa-solid fa-trash-can"></i>      
                                </div>
                            </div>
                            <div class="countitem">
                                <button class="decrease">-</button>
                              <input type="number" value="${productssaved}">
                              <button class="increase">+</button>
                            </div>
                        </div>
                    </div>
                </section>
                    `;
                }
                
                
            


            })
            function itemPlus(arr){
                let inputValue = document.querySelectorAll('.countitem input');
                let price = document.querySelectorAll(".wish_price_del>p");
                let flashMessage = document.querySelector(".flashmessage");
                // console.log(inputValue[i]);
                // console.log(inputValue[i]);
                let quant = inputValue;
                let pricefinal = arr;
                // console.log(price);
                // console.log(quant);
                price.forEach((item,i)=>{
                    price[i].textContent = `£${Number(quant[i].value)*pricefinal[i]}`;
                })
                let totalsummary = document.querySelector(".ordersummary .ordercost");
                let totalprice = 0;
                // console.log(Number(price[0].textContent.slice(1)));
                for(let j=0; j<inputValue.length; j++){
                    totalprice += Number(price[j].textContent.slice(1));
                }
                totalsummary.textContent = `£${totalprice}`;
                
                inputValue.forEach((item,i)=>{
                    item.oninput = function(){
                        // console.log(inputValue[i]);
                        let quant = Number(inputValue[i].value);
                        let price1 = Number(pricefinal[i]);
                        // console.log(price);
                        // console.log(quant);
                        price[i].textContent = `£${quant*price1}`;
                        let totalprice = 0;
                        // console.log(Number(price[0].textContent.slice(1)));
                        
                        let totalinput = 0;
                        for(let j=0; j<inputValue.length; j++){
                            totalinput += Number(inputValue[j].value);
                        }
                        if(totalinput>=20){
                            price[i].textContent = `£${items[i][1]}`;
                            inputValue[i].value = 0;
                            // alert("Total cart should have not more than 20 items!!");
                            flashMessage.style.display = 'block';
                            flashMessage.textContent = "Total cart should have not more than 20 items!!";
                        }
                        for(let j=0; j<inputValue.length; j++){
                            totalprice += Number(price[j].textContent.slice(1));
                        }
                        // console.log(totalprice);
                        totalsummary.textContent = `£${totalprice}`;
                    }
                })
                
                let decreaseVal = document.querySelectorAll(".countitem .decrease");
                let increaseVal = document.querySelectorAll(".countitem .increase");
                increaseVal.forEach((item,i)=>{
                    item.addEventListener("click",()=>{
                        let quant = Number(inputValue[i].value);
                        let price1 = Number(pricefinal[i]);
                        // console.log(price);
                        // console.log(quant);
                        // console.log(quant);
                        // console.log(price1);
                        price[i].textContent = `£${(quant+1)*price1}`;
                        let totalprice = 0;
                        // console.log(Number(price[0].textContent.slice(1)));
                       
                        let totalinput = 0;
                        for(let j=0; j<inputValue.length; j++){
                            totalinput += Number(inputValue[j].value);
                        }
                        console.log(totalinput);
                        if(totalinput>=20){
                            inputValue[i].value = 0;
                            // price[i].textContent = '£0';
                            price[i].textContent = `£${items[i][1]}`;
                            flashMessage.style.display = 'block';

                            // alert("Total cart should have not more than 20 items!!");
                            flashMessage.textContent = "Total cart should have not more than 20 items!!";
                            
                        }
                        for(let j=0; j<inputValue.length; j++){
                            totalprice += Number(price[j].textContent.slice(1));
                        }
                        // console.log(totalprice);
                        totalsummary.textContent = `£${totalprice}`;
                    })
                })
                
                decreaseVal.forEach((item,i)=>{
                    item.addEventListener("click",()=>{
                        let quant = Number(inputValue[i].value);
                        let price1 = Number(pricefinal[i]);
                        // console.log(price);
                        // console.log(quant);
                        // console.log(quant);
                        // console.log(price1);
                        let price2 = (quant-1)*price1;
                        if(price2<0){
                            price2 = 0;
                        }
                        price[i].textContent = `£${price2}`;
                        let totalprice = 0;
                        // console.log(Number(price[0].textContent.slice(1)));
                        for(let j=0; j<inputValue.length; j++){
                            totalprice += Number(price[j].textContent.slice(1));
                        }
                        // let totalinput = 0;
                        // for(let j=0; j<inputValue.length; j++){
                        //     totalinput += inputValue[j].value;
                        // }
                        // console.log(totalinput);
                        // if(totalinput>20){
                        //     inputValue[i].value = 0;
                        //     alert("Total cart should have not more than 20 items!!");
                        // }
                        // console.log(totalprice);
                        totalsummary.textContent = `£${totalprice}`;
                    })
                })
                increaseVal.forEach((item,i)=>{
                    item.addEventListener("click",()=>{
                        // console.log(inputValue[i]);
                        let quant = Number(inputValue[i].value);
                        let stock = Number(items[i][4]);
                        console.log("hello");
                        if(quant>stock-1){
                            inputValue[i].value = 0;
                            // price[i].textContent = '£0';
                            price[i].textContent = `£${items[i][1]}`;
                            flashMessage.style.display = 'block';
                            // alert("Quantities exceeded the stock!!");
                            flashMessage.textContent = "Quantities exceeded the stock!!";

                        }
                    }
                    )
                })
                   
                inputValue.forEach((item,i)=>{
                    item.oninput = function(){
                        // console.log(inputValue[i]);
                        let quant = Number(inputValue[i].value);
                        let stock = Number(items[i][4]);
                        if(quant>stock){
                            inputValue[i].value = 0;
                            // price[i].textContent = '£0';
                            price[i].textContent = `£${items[i][1]}`;
                            flashMessage.style.display = 'block';

                            // alert("Quantities exceeded the stock!!");
                            flashMessage.textContent = "Quantities exceeded the stock!!";

                        }
                    }
                })
            }  
            itemPlus(arr);
            // addToCart();
            // addtocart2();
            
            // getTotal();
            
            // preventTyping();
            trashCart();
            // selectboxMain();
            // addingToOrders();
            // orderCost();

            // checkingItems();
            cartCounter();
            heartItem();
            updateCart();
            // checkingIfordersHappened();
            // updateCartAndTotal();
            // trashOrder();
            function trashCart(){
                const proidset = document.querySelectorAll(".getProid");
                const username = document.querySelector(".usernameFind")?.value;
                const trashIcon = document.querySelectorAll(".wish_price_del .fa-trash-can");
                trashIcon.forEach((trash,i)=>{
                    trash.addEventListener("click",()=>{
                        let xml = new XMLHttpRequest();
                        xml.onreadystatechange = function(){
                            if(this.readyState == 4 && this.status == 200){
                                location.reload(); 
                                // console.log(this.responseText);
                            }
                        }
                        xml.open("POST", `deleteCartItem.php?cname=${username}&pid=${proidset[i].value}&quant=${items[i][4]}&saved=${items[i][8]}&pName=${items[i][0]}`, true);
                        xml.send();
                        
                    })
                })
                 
            }
           
            

        }
    }
    xml1.open("POST", "displaySave.php", true);
    xml1.send();

}
showingsavedProduct();


function heartItem(){
    const heartIcon = document.querySelectorAll(".wish_price_del .fa-heart");
    const proidset = document.querySelectorAll(".getProid");
    const username = document.querySelector(".usernameFind")?.value;
    if(username != null){
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
  
}


//checkout

let checkout = document.querySelector(".checkout");

checkout.addEventListener("click",()=>{
    const slots = document.querySelector('.slots #slotscollection');
    

})







// checking if button in clicked when tick is given and increase orders quantity in database


function updateCart(){
    let pIdAll = document.querySelectorAll(".getproductid");
    const username = document.querySelector(".usernameFind")?.value;
    let inputValue = document.querySelectorAll('.countitem input');
    let decrease = document.querySelectorAll(".countitem .decrease");
    let increase = document.querySelectorAll(".countitem .increase");
    if(username !=null){
        increase.forEach((inc,i)=>{
            inc.addEventListener("click",()=>{
                let xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function(){
                    if(this.readyState == 4 && this.status == 200){
                        console.log(this.responseText);
                        console.log(JSON.parse(this.responseText));
                        if(JSON.parse(this?.responseText)[0]==true){

                            console.log("start");
                        }
                        else{
                            // inputValue[i].disabled = false;
                            console.log("end");
                        }
                    }
                }
                xmlhttp.open("POST", `cartIncrease.php?pid=${pIdAll[i].value}&name=${username}&quant=${inputValue[i].value}`, true);
                xmlhttp.send();
            })
        })
        decrease.forEach((inc,i)=>{
            inc.addEventListener("click",()=>{
                let xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function(){
                    if(this.readyState == 4 && this.status == 200){
                        console.log(this.responseText);
                        console.log(JSON.parse(this.responseText));
                        if(JSON.parse(this?.responseText)[0]==true){

                            console.log("start");
                        }
                        else{
                            // inputValue[i].disabled = false;
                            console.log("end");
                        }
                    }
                }
                xmlhttp.open("POST", `cartIncrease.php?pid=${pIdAll[i].value}&name=${username}&quant=${inputValue[i].value}`, true);
                xmlhttp.send();
            })
        })
        inputValue.forEach((inp,i)=>{
            inp.addEventListener("input",()=>{
                if(inputValue[i].value<0){
                    inputValue[i].value = 0;
                }
                console.log(inputValue[i].value);
                let xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function(){
                    if(this.readyState ==4 && this.status == 200){
                        console.log(JSON.parse(this.responseText));
                        if(JSON.parse(this?.responseText)[0]==true){

                            console.log("start");
                        }
                        else{
                            // inputValue[i].disabled = false;
                            console.log("end");
                        }
                    }
                }
                xmlhttp.open("POST", `cartIncrease.php?pid=${pIdAll[i].value}&name=${username}&quant=${inputValue[i].value}`, true);
                xmlhttp.send();
            })
        })
    }
}


const button = document.querySelector(".order-checkout button");
button.addEventListener("click",()=>{
    window.location.href = "../order_page/index.php";
})

const flashmessage = document.querySelector(".flashmessage");
setTimeout(() => {
    flashmessage.style.display = 'none';
}, 5000);

// getcollectionId();

// dayslots();



// dark mode



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
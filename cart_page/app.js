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
            console.log(items);
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
                
                // console.log(inputValue[i]);
                // console.log(inputValue[i]);
                let quant = inputValue;
                let pricefinal = arr;
                console.log(quant, pricefinal); 
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
                        for(let j=0; j<inputValue.length; j++){
                            totalprice += Number(price[j].textContent.slice(1));
                        }
                        let totalinput = 0;
                        for(let j=0; j<inputValue.length; j++){
                            totalinput += Number(inputValue[j].value);
                        }
                        console.log(totalinput);
                        if(totalinput>=20){
                            inputValue[i].value = 0;
                            alert("Total cart should have not more than 20 items!!");
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
                        for(let j=0; j<inputValue.length; j++){
                            totalprice += Number(price[j].textContent.slice(1));
                        }
                        let totalinput = 0;
                        for(let j=0; j<inputValue.length; j++){
                            totalinput += Number(inputValue[j].value);
                        }
                        console.log(totalinput);
                        if(totalinput>=20){
                            inputValue[i].value = 0;
                            alert("Total cart should have not more than 20 items!!");
                            price[j].textContent = 0;
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
            // function trashOrder(){
            //     const proidset = document.querySelectorAll(".getProid");
            //     const username = document.querySelector(".usernameFind")?.value;
            //     const trashIcon = document.querySelectorAll(".wish_price_del .fa-trash-can");
            //     trashIcon.forEach((trash,i)=>{
            //         trash.addEventListener("click",()=>{
            //             let xml = new XMLHttpRequest();
            //             xml.onreadystatechange = function(){
            //                 if(this.readyState == 4 && this.status == 200){
            //                     // location.reload(); 
            //                     console.log(this.responseText);
            //                 }
            //             }
            //             xml.open("POST", `deleteorderitem.php?cname=${username}&pid=${proidset[i].value}&quant=${items[i][4]}&saved=${items[i][8]}&pName=${items[i][0]}`, true);
            //             xml.send();
                        
            //         })
            //     })
            // }
            

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

//total cost of order
function orderCost(){

    const username = document.querySelector(".usernameFind")?.value;
    if(username != null){
        let costOfOrder = document.querySelector(".container-order .ordercost");
        let xml = new XMLHttpRequest();
        xml.onreadystatechange = function(){
            if(this.readyState == 4 && this.status == 200){
                if(this.responseText != ""){
                    // console.log(this.responseText);
                    let response = JSON.parse(this.responseText);
                    // console.log(this.responseText);                                 
                    
                    let sum = 0;
                    for(let i=0; i<response.length; i++){
                        sum += parseInt(response[i]);
                    }
                    // console.log(sum);
                    if(sum>0){
                        costOfOrder.textContent = `£${sum}`;
                    }
                    
                }
                else{
                        costOfOrder.textContent = `£${0}`;
                }
                
            }
        }
        xml.open("POST",`findTotalCost.php?name=${username}`, true );
        xml.send();
    }
    
}   
// console.log(costOfOrder);


function checkingIfordersHappened(){
    const username = document.querySelector(".usernameFind")?.value;
    if(username != null){
        const items = document.querySelectorAll(".countitem input");
        let checkingbox = document.querySelectorAll(".onlyone input");
        let itemName = document.querySelectorAll(".desc .itempro");
        let xml = new XMLHttpRequest();
        xml.onreadystatechange = function(){
            if(this.readyState == 4 && this.status == 200){
                console.log(this.responseText);
                let arr = JSON.parse(this.responseText);
                console.log(arr[0]);
                // console.log(itemName);
                for(let i=0; i<itemName.length; i++){
                    if(arr.includes(itemName[i].textContent)){
                        let indexof = arr.indexOf(itemName[i].textContent);
                        checkingbox[i].checked = 'true';
                        items[i].value = arr[indexof + 1];
                        console.log(arr[indexof+1]);
                    }
                }
            }
        }
        xml.open("POST", "selectedItem.php?cname="+username, true);
        xml.send();
    }
    
}



// checkingIfordersHappened();


// checking if button in clicked when tick is given and increase orders quantity in database
function updateCartAndTotal(){
    let checkBox = document.querySelectorAll('.onlyone input');
    let pIdAll = document.querySelectorAll(".getproductid");
    const username = document.querySelector(".usernameFind")?.value;
    let decrease = document.querySelectorAll(".countitem .decrease");
    let increase = document.querySelectorAll(".countitem .increase");
    let inputValue = document.querySelectorAll('.countitem input');

    if(username != null){
        checkBox.forEach((item,i)=>{
            // console.log(checkBox);
            let xml = new XMLHttpRequest();
            xml.onreadystatechange = function(){
                if(this.readyState == 4 && this.status == 200){
                    console.log(this.responseText);
                    let arr = JSON.parse(this.responseText);
                    if(arr[0]==true){
                    
                        // console.log("hee");
                        increase[i].addEventListener("click",()=>{
                            // console.log("hello");
                            let xmlhttp = new XMLHttpRequest();
                            xmlhttp.onreadystatechange = function(){
                                if(this.readyState == 4 && this.status == 200){
                                    console.log(this.responseText);
                                    console.log(JSON.parse(this.responseText));
                                    if(JSON.parse(this?.responseText)[0]==false){
    
                                        inputValue[i].disabled = true;
                                    }
                                    else{
                                        inputValue[i].disabled = false;
                                    }
                                }
                            }
                            xmlhttp.open("POST", `addfromIncrease.php?pid=${pIdAll[i].value}&name=${username}&quant=${inputValue[i].value}`, true);
                            xmlhttp.send();
                        })
                        decrease[i].addEventListener("click",()=>{
                            // console.log("hello");
                            let xmlhttp = new XMLHttpRequest();
                            xmlhttp.onreadystatechange = function(){
                                if(this.readyState == 4 && this.status == 200){
                                    // console.log(this.responseText);
                                    // console.log(JSON.parse(this.responseText));
                                    if(JSON.parse(this?.responseText)[0]==false){
    
                                        inputValue[i].disabled = true;
                                    }
                                    else{
                                        inputValue[i].disabled = false;
                                    }
                                }
                            }
                            xmlhttp.open("POST", `addfromIncrease.php?pid=${pIdAll[i].value}&name=${username}&quant=${inputValue[i].value}`, true);
                            xmlhttp.send();
                        })
                        
                        inputValue[i].addEventListener("input",()=>{
                            let xmlhttp = new XMLHttpRequest();
                            xmlhttp.onreadystatechange = function(){
                                if(this.readyState ==4 && this.status == 200){
                                    // console.log(this.responseText);

                                    // console.log(JSON.parse(this.responseText));
                                    if(JSON.parse(this.responseText)[0]==false){
    
                                        inputValue[i].disabled = true;
                                    }
                                    else{
                                        inputValue[i].disabled = false;
                                    }
                                }
                            }
                            xmlhttp.open("POST", `addfromIncrease.php?pid=${pIdAll[i].value}&name=${username}&quant=${inputValue[i].value}`, true);
                            xmlhttp.send();
                        })
                        
                    }
                    // console.log(this.responseText);
                }
            }
            xml.open("POST", `checkingordered.php?pid=${pIdAll[i].value}&name=${username}`, true);
            xml.send();
        })
    }
    
}
// updateCartAndTotal();

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

function addToCart(){
    const button = document.querySelector(".order-checkout button");
    let pIdAll = document.querySelectorAll(".getproductid");
    const collectionSlot = document.querySelector(".slots input");
    const slots = document.querySelector('.slots #slotscollection');
    const username = document.querySelector(".usernameFind")?.value;
    let slotsdaydisplay = document.querySelector(".collectionday");
    let slotsday = null;
    slots.addEventListener("change",()=>{
        slotsday = new Date(slots?.value).getDay() + 1;
        console.log(slotsday);
    })
    console.log(slots);
   if(slotsday === 1){
       slotsdaydisplay.textContent = 'Day chosen: sunday';
   }
   else if(slotsday === 2){
       slotsdaydisplay.textContent = 'Day chosen: monday';

   }
   else if(slotsday === 3){
       slotsdaydisplay.textContent = 'Day chosen: tuesday';

   }else if(slotsday === 4){
       slotsdaydisplay.textContent = 'Day chosen: wednesday';

   }else if(slotsday === 5){
       slotsdaydisplay.textContent = 'Day chosen: thursday';

   }else if(slotsday === 6){
       slotsdaydisplay.textContent = 'Day chosen: friday';

   }else if(slotsday === 7){
       slotsdaydisplay.textContent = 'Day chosen: saturday';

   }
   console.log(slotsday);
    button.addEventListener("click",()=>{
       
        let xml = new XMLHttpRequest();
        xml.onreadystatechange = function(){
            if(this.readyState ==4 && this.status == 200){
                console.log(this.responseText);
                // console.log(JSON.parse(this.responseText));
                // console.log(slots.value);
                if(JSON.parse(this.responseText)[0] === true)
                    window.location.href = "../order_page/index.php";
                    // console.log('redirect');                                                                                                                                                           
                else if(collectionSlot.value === null)
                    alert("collection date is not provided");
                    // alert("Collection date is not chosen!!");
            }
                
            }
           
        xml.open("POST","addtoorderpage.php?date="+collectionSlot.value+"&cname="+username+"&day="+slotsday, true);
        xml.send();
    })
    
}

const button = document.querySelector(".order-checkout button");
button.addEventListener("click",()=>{
    window.location.href = "../order_page/index.php";
})

function addtocart2(){
    let pIdAll = document.querySelectorAll(".getproductid");
    const slots = document.querySelector('.slots #slotscollection');
    const username = document.querySelector(".usernameFind")?.value;
    const button = document.querySelector(".order-checkout button");
    let inputValue = document.querySelectorAll('.countitem input');
    let price = document.querySelectorAll(".wish_price_del>p");
    console.log(pIdAll);   
    let slotsday = null;
    slots.addEventListener("change",()=>{
        slotsday = new Date(slots?.value).getDay() + 1;
        console.log(slotsday);
    })     
    button.addEventListener("click",()=>{
        console.log("hel");
        pIdAll.forEach((pid,i)=>{
            console.log(price[i].textContent);
            let xml = new XMLHttpRequest();
            xml.onreadystatechange = function(){
                if(this.readyState ==4 && this.status == 200){
                    console.log(this.responseText);
                    // console.log(JSON.parse(this.responseText));
                    // console.log(slots.value);
                    // if(JSON.parse(this.responseText)[0] === true)
                    //     window.location.href = "../order_page/index.php";                                                                                                                                                           
                    // else if(JSON.parse(this.responseText)[0] === false)
                    //     alert("collection date is not provided");
                    //     alert("Collection date is not chosen!!");
                }
                    
                }
               
            xml.open("POST",`addtoorderpage2.php?cname=${username}&pid=${pIdAll[i].value}&quant=${inputValue[i].value}&price=${price[i].textContent.slice(1)}&slots=${slots.value}`, true);
            xml.send();
        })
    })
   
}
// addtocart2();


function getcollectionId(){
    const collectionSlot = document.querySelector(".slots input");
    let xml = new XMLHttpRequest();
    xml.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            console.log(this.responseText);
            let json = JSON.parse(this.responseText);
            if(json[0] != ""){
                collectionSlot.value = json[1];
                collectionSlot.disabled = true;
            }
        }
    }
    xml.open("POST",'getslots.php', true);
    xml.send();

}
// getcollectionId();

// dayslots();
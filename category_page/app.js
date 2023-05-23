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


// search.addEventListener("click",()=>{
//     searchBar.classList.toggle("show-searchbar");
//     login.classList.toggle("show-login");
//     cart.classList.toggle("show-cart");
//     search.classList.toggle("show-search");
// })
// faTimes.addEventListener("click",()=>{
//     searchBar.classList.toggle("show-searchbar");
//     login.classList.toggle("show-login");
//     cart.classList.toggle("show-cart");
//     search.classList.toggle("show-search");
// })

function gettingProduct(type, items, item1=null){
    let itemsContainer = document.querySelector(".items-container");
    const xmlhttp = new XMLHttpRequest();
    let catname = document.querySelector(".catnamehidden");
    const loaderItem = document.querySelector(".loader span");
    const loaderBtn = document.querySelector(".loader h1");
    loaderItem.textContent = "";
    let content = itemsContainer.innerHTML;
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            // console.log(this.responseText);
            let item = JSON.parse(this.responseText);
            if(item1 == null){
                item = JSON.parse(this.responseText);
            }
            // else if(item1===null){
            //     item = JSON.parse(this.responseText);
            // }
            else{
                item = item1;
            }
            // console.log(item);
            let pId = item['PRODUCT_ID'];
            // console.log(pId);
            let pName = item['NAME'];
            var pPrice = item["PRICE"];
            let pQuantity = item['STOCK_AVAILABLE'];
            let pDesc = item['DESCRIPTION'];
            let pCategory = item['CATEGORY_NAME'];
            // var pDiscount = item['PRODUCT_DISCOUNT'];
            var pDiscount = 8;
            let pAllergy = item['ALLERGY_INFORMATION'];
            let pImage1 = item['IMAGE1'];
            let pImage2 = item['IMAGE2'];
            let pImage3 = item['IMAGE3'];
            let prevPrice = [];    
            itemsContainer.innerHTML = ""
                for(let i=0; i<pId.length; i++){
                    // console.log(i);
                    prevPrice.push(parseInt(Number(pPrice[i]) + (Number(pDiscount[i])*Number(pPrice[i]))/100));
                    if(type === null){
                        itemsContainer.innerHTML = content;
                    }
                    else if(type === 'load'){ 
                        // console.log(i); 
                        if(i===items){
                            break;
                        }
                        let itemsLength = pId.length - items;
                        loaderItem.textContent = itemsLength<0 ? `${0} Items remaining` : `${pId.length - items} Items remaining`;
                        if(itemsLength<0){
                            loaderBtn.style.display = 'none';
                        }
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
            // filtershops();
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
    xmlhttp.open("POST", "product.php?catname="+catname.value, true);
    xmlhttp.send();
}
gettingProduct('load', 9);














function filtershops(){
    const shopRadio = document.querySelectorAll('.radio-select input');
    const radioSubmit = document.querySelector(".radio-select button");
    let dateform = document.querySelector(".radio-select .datefrom").value;
    let dateto = document.querySelector(".radio-select .dateto").value;
    // console.log(dateform);
    let value = 'all';
    shopRadio.forEach((item)=>{
        item.addEventListener("change",()=>{
            if(item.checked){
                value = item.value;
                let dateform = document.querySelector(".radio-select .datefrom").value;

                // console.log(dateform);
                // console.log(value);
                // console.log(dateform,dateto);
            }
        })
    })
    radioSubmit.onclick = function(){
        let xml = new XMLHttpRequest();
        xml.onreadystatechange = function(){
            if(this.readyState == 4 && this.status == 200){
                let item = JSON.parse(this.responseText);
                console.log(this.responseText);
                gettingProduct("load", 9, item);

            }
        }
        xml.open("POST", `filtershop.php?value=${value}&datefrom=${dateform}&dateto=${dateto}`, true);
        xml.send();
        
    }
    
}
filtershops();


function moreFilter(){
    // let minRange = document.querySelector(".pricerange .minrange").value;
    // let maxRange = document.querySelector(".pricerange .maxrange").value;
    let sort = document.querySelector(".sort #sortby");
    let apply = document.querySelector(".sort button");
    let sortValue = 1;
    sort.addEventListener("change",()=>{
        sortValue = sort.options[sort.selectedIndex].value;
        // console.log(sortvalue);
    })
    apply.addEventListener("click",()=>{
        let xml = new XMLHttpRequest();
        xml.onreadystatechange = function(){
            if(this.readyState == 4 && this.status == 200){
                console.log(this.responseText);
                let items = JSON.parse(this.responseText);
                gettingProduct("load", 9, items);
            }
        }
        xml.open("POST", `morefilter.php?sort=${sortValue}`, true);
        xml.send();
    })
    

}
moreFilter();

function priceRangeChange(){
    let minRange = document.querySelector(".pricerange .minrange");
    let maxRange = document.querySelector(".pricerange .maxrange");
    let applyrangebtn = document.querySelector(".pricerange .applyrange");
    let minrangevalue = Number(minRange?.value);
    let maxrangevalue = Number(maxRange?.value);
    if(!isNaN(minrangevalue) && !isNaN(maxrangevalue)){
        applyrangebtn.addEventListener("click",()=>{
           let xml = new XMLHttpRequest();
        xml.onreadystatechange = function(){
            if(this.readyState == 4 && this.status == 200){
                console.log(this.responseText);
                let items = JSON.parse(this.responseText);
                // console.log(items[0]);
                gettingProduct("load", 9, items);
                
            }
        }
        xml.open("POST", `rangefilter.php?min=${minRange?.value}&max=${maxRange?.value}`, true);
        xml.send();
       })
                
            
            

    }   
    

}
priceRangeChange();

function searchanything(){
   
    let searchBtn = document.querySelector('.item-search button');
    searchBtn.addEventListener("click",()=>{
        let search = document.querySelector('.item-search input').value;
        // console.log(search);
        let xml = new XMLHttpRequest();
        xml.onreadystatechange = function(){
            if(this.readyState == 4 && this.status == 200){
                let items = JSON.parse(this.responseText);
                // console.log(this.responseText);
                gettingProduct("load", 9, items);
            }
        }
        xml.open("POST", `searchanything.php?search=${search}`, true);
        xml.send();
    })


}

searchanything();





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

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

//order page

function orderPage(){
    let placeorder = document.querySelector(".placeorder");
    let customerName = document.querySelector(".hiddencustomer");
    let xml = new XMLHttpRequest();
    xml.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            console.log(this.responseText);
            let response = JSON.parse(this.responseText);
            let quantity = response[1];
            let price = response[0];
            placeorder.innerHTML =  `
            
            <hr>
                <h1>Order summary</h1>
                <p class="totalitems">Items total: ${quantity}</p>
                <p class="totalpayment">Total payment: ${price}</p>
                <p class="tax">No taxes included</p>
                <form action="" method="POST">
                    <input type="hidden" class="postcollectdate" name="postcollectdate">
                    <input type="hidden" class="posttimeslot" name="posttimeslot">
                    <input type="hidden" class="postday" name="postday">
                    <button type="submit" class="orderbtn" name="orderbtn">Place order</button>
                </form>
           
            `;
            // invoicemodal();
            getcollectionId();

        }
    }
    xml.open("POST", "orderPage.php?name="+customerName.value, true);
    xml.send();



}
orderPage();



function invoicemodal(){
    const backdrop = document.querySelector(".backdrop");
    const orderBtn = document.querySelector(".orderbtn");
    const invoice = document.querySelector(".invoice");
    const cross = document.querySelector(".invoice .cross i");
    console.log(orderBtn);
    orderBtn.addEventListener("click",()=>{
        console.log("hello");
        invoice.classList.remove("hideinvoice");
        backdrop.classList.remove('hidebackdrop');
    })
    backdrop.addEventListener("click",()=>{
        invoice.classList.add("hideinvoice");
        backdrop.classList.add('hidebackdrop');
    })
    cross.addEventListener("click",()=>{
        invoice.classList.add("hideinvoice");
        backdrop.classList.add('hidebackdrop');
    })

}



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
    document.documentElement.style.color = '#FFFFFF';
    document.documentElement.style.opacity = '87%';

} else {
    document.documentElement.style.setProperty('--primary-color', '#D10000');
    document.documentElement.style.setProperty('--secondary-color', '#0C6980');
    document.documentElement.style.setProperty('--tertiary-color', '#228B22');
    document.documentElement.style.setProperty('--black', '#000000');
    document.documentElement.style.setProperty('--white', '#ffffff');
    document.documentElement.style.setProperty('--selected', '#D9D9D9');
    document.documentElement.style.color = 'black';



}

function getcollectionId(){
    const collectionSlot = document.querySelector(".slots input");
    let collectiondate = document.querySelector(".collection_date");
    let xml = new XMLHttpRequest();
    xml.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            console.log(this.responseText);
            let json = JSON.parse(this.responseText);
            console.log(json);
            if(json[0] != ""){
                collectiondate.textContent =  `Collection slot: ${json[1]}`;
            }
        }
    }
    xml.open("POST",'../cart_page/getslots.php', true);
    xml.send();

}


function dayslots(){
    const collectionSlot = document.querySelector(".slots #slotscollection");
    let yourDate = new Date();
    yourDate.setDate(yourDate.getDate()+1);
    let x = yourDate.toISOString().split('T')[0]
    collectionSlot.min = x;
    const day = document.querySelector(".slots .slotsday");
    const fixingtheday = document.querySelector(".disabledate");

    const dayhidden = document.querySelector(".dayhidden");
    let slotsday = "";
    collectionSlot.addEventListener("change",()=>{
        slotsday = new Date(collectionSlot?.value).getDay() + 1;
        // if(slotsday!=""){
            dayhidden.value = slotsday;
            if(slotsday === 1){
                day.textContent = 'Day chosen: sunday';
            }
            else if(slotsday === 2){
                day.textContent = 'Day chosen: monday';
         
            }
            else if(slotsday === 3){
                day.textContent = 'Day chosen: tuesday';
         
            }else if(slotsday === 4){
                day.textContent = 'Day chosen: wednesday';
         
            }else if(slotsday === 5){
                day.textContent = 'Day chosen: thursday';
         
            }else if(slotsday === 6){
                day.textContent = 'Day chosen: friday';
         
            }else if(slotsday === 7){
                day.textContent = 'Day chosen: saturday';
         
            }
            // day.textContent = slotsday;
        // }
    }) 
    if(fixingtheday.value == 'true'){
        collectionSlot.disabled = true;
    }
setCollectionDate();

    // console.log(dayhidden.value);

      
}
dayslots();

function setCollectionDate(){
    const collectSlot = document.querySelector("#slotscollection");
    const timeSlot = document.querySelector(".slots select");
    // const slotsDay = document.querySelector(".dayhidden").textContent;
    let value = '10-13';
    timeSlot.addEventListener("change",()=>{
        value = timeSlot.options[timeSlot.selectedIndex].value;
        
    })
    let slotsday = null;
    let collectdate = null;
    collectSlot.addEventListener("change",()=>{
        collectdate = collectSlot.value;
        slotsday = new Date(collectSlot?.value).getDay() + 1;
        console.log(value, slotsday, collectdate);
        if(slotsday != null && collectdate != null){
            let xml = new XMLHttpRequest();
            xml.onreadystatechange = function(){
                if(xml.status==200 && xml.readyState == 4){
                    // console.log(this.responseText);
                    // console.log(JSON.parse(this.responseText)); 
                    document.querySelector('.flashmessage').innerHTML = JSON.parse(this.responseText)[0];
                    if(JSON.parse(this.responseText)[2] != null){
                        document.querySelector(".postcollectdate").value = JSON.parse(this.responseText)[2];
                        document.querySelector(".posttimeslot").value = JSON.parse(this.responseText)[3];;
                        document.querySelector(".postday").value = JSON.parse(this.responseText)[1];;
                    }

                }
            }
            xml.open("POST", `collectiondate.php?cslot=${collectdate}&timeslot=${value}&slotsday=${slotsday}`, true);
            xml.send();
    
        }
    })
    
   

}
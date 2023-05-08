"use strict";

function mainLinkClick(){
    const listsMenu = document.querySelectorAll(".container-fluid .col-2 ul li");
    // listsMenu[0].style.fontSize = '1rem';
    const showDesc = document.querySelectorAll(".showdesc");
    listsMenu[0].style.fontSize = "1rem";
    listsMenu[0].style.fontWeight = "bolder";
    showDesc[0].style.display = 'block';
    listsMenu.forEach((item,i)=>{
        item.addEventListener("click",(e)=>{
            let link1 = e.currentTarget.dataset.type;
            // console.log(link1);
            listsMenu[i].style.fontSize = "1.1rem";
            listsMenu[i].style.fontWeight = "bolder";

            document.getElementById(`${link1}`).style.display = 'block';
            for(let j=0; j<showDesc.length; j++){
                if(j!=i){
                    showDesc[j].style.display = 'none';
                    listsMenu[j].style.fontSize = "1rem";
                    listsMenu[j].style.fontWeight = 'normal';
                }
            }
        })
    })
}
mainLinkClick();


//submenu click
function submenuClick(keyel){
    const pages = document.querySelectorAll(`.showdesc .${keyel}>div`);
    const navItem = document.querySelectorAll(`.${keyel} .nav-item a`);
    // console.log(pages);
    pages[0].style.display = 'block';
    navItem[0].style.fontWeight = "bolder";
    navItem.forEach((item, i)=>{
        item.addEventListener("click",()=>{
            let link = item.dataset.link;
            document.querySelector(`.${keyel} > #${link}`).style.display = 'block';
            navItem[i].style.fontWeight = "bolder";

            for(let j=0; j<pages.length; j++){
                if(j!=i){
                    navItem[j].style.fontWeight = "normal";
                    pages[j].style.display = 'none';
                }
            }
        })
    })
}

submenuClick("overall-manage");
submenuClick("shops-manage");
submenuClick("products-manage");
submenuClick("offers-manage");
submenuClick("profile-manage");


function flashAddproduct(){
    const flashAddproduct = document.querySelectorAll("#onelink p");
    flashAddproduct.forEach((item)=>{
        setTimeout(()=>{
            item.style.display = 'none';
        },3000)
    })
}
flashAddproduct();

function modalEditProduct(){
    const triggerEdit = document.querySelectorAll(".edittriggerpro");
    const modalEditPro = document.querySelector(".editingpanelpro");
    const backdrop = document.querySelector(".backdrop");
    const xmark = document.querySelector('.cross .fa-xmark');
    triggerEdit.forEach((item,i)=>{ 
        // console.log(item);
        item.addEventListener("click",()=>{
            modalEditPro.classList.remove('hidemodal');
            backdrop.classList.remove('hidebackdrop');
            spawningProductDetails(i);
        })
        backdrop.addEventListener("click",()=>{
            modalEditPro.classList.add('hidemodal');
            backdrop.classList.add('hidebackdrop');
        })
        xmark.addEventListener("click",()=>{
            modalEditPro.classList.add('hidemodal');
            backdrop.classList.add('hidebackdrop');
        })

    })

}
modalEditProduct();

function spawningProductDetails(id){
    const id1 = document.querySelectorAll(".hiddenpid");
    const productname = document.querySelectorAll(".editproduct .productname input");
    const productprice = document.querySelectorAll(".editproduct .productprice input");
    const productQuant = document.querySelectorAll('.editproduct .productquantity input');
    const productdesc = document.querySelectorAll(".editproduct .proDescription textarea");
    const productAllergy = document.querySelectorAll(".editproduct .productallergy input");
    const shopname = document.querySelectorAll('.editproduct .shop select');


    const xml = new XMLHttpRequest();
    xml.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            let response = JSON.parse(this.responseText);
            console.log(response);
            response.forEach((item,i)=>{
                    productname[i].value = item['PRODUCT_NAME'];
                    productprice[i].value = "£"+item['PRODUCT_PRICE'];
                    productQuant[i].value = item['PRODUCT_QUANTITY'];
                    productdesc[i].value = item['PRODUCT_DESCRIPTION'];
                    productAllergy[i].value = item['PRODUCT_ALLERGY_INFORMATION'];
            })
        }
    }
    xml.open("POST", `specificProduct.php?id=${id1[id].value}`, true);
    xml.send();
}

// disable shops

function disableShop(){
    const disableShop = document.querySelector(".disableshop");
    const enableshop = document.querySelector(".enableshop");
    disableShop.innerHTML = "";
    enableshop.innerHTML = "";
    let xml = new XMLHttpRequest();
    xml.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            // console.log(this.responseText);
            let result = JSON.parse(this.responseText);
            // console.log(result);
            result.forEach((item)=>{
                if(item['SHOP_STATUS'] == 'enabled'){
                    disableShop.innerHTML += `<div class="shopDetail">
                    <p>${item['SHOP_NAME']}</p>
                    <p>${item["SHOP_CATEGORY"]}</p>
                    <input type="hidden" class="activeInput" value=${item['SHOP_ID']}>
                    <button>Disable</button>
                  </div>`;
                }
                if(item['SHOP_STATUS'] == 'disabled'){
                    enableshop.innerHTML += `<div class="shopDetail">
                    <p>${item['SHOP_NAME']}</p>
                    <p>${item['SHOP_CATEGORY']}</p>
                    <input type="hidden" class="inactiveInput" value=${item['SHOP_ID']}>
                    <button>Enable</button>
                  </div>`;
                }
            })
            triggerenablebtn();
            
        }
    }
    xml.open("POST", `enableshop.php?trader=${3003}`, true);
    xml.send();
}

disableShop();

function triggerenablebtn(){
    const disabledBtn = document.querySelectorAll(".disableshop button");
    const inputId = document.querySelectorAll(".shopDetail .activeInput");
    const inputId2 = document.querySelectorAll(".shopDetail .inactiveInput");
    // console.log(inputId);
    disabledBtn.forEach((btn,i)=>{
        btn.addEventListener("click",()=>{
            console.log(inputId[i].value);
            let xml = new XMLHttpRequest();
            xml.onreadystatechange = function(){
                if(this.readyState == 4 && this.status == 200){
                    disableShop();
                }
            }
            xml.open("POST", `triggershopstatus.php?status=enable&id=${inputId[i].value}`, true);
            xml.send();
        })
    })
    const enableBtn = document.querySelectorAll(".enableshop button");
    enableBtn.forEach((btn,i)=>{
        btn.addEventListener("click",()=>{
            let xml = new XMLHttpRequest();
            xml.onreadystatechange = function(){
                if(this.readyState == 4 && this.status == 200){
                    disableShop();
                }
            }
            xml.open("POST", `triggershopstatus.php?status=disable&id=${inputId2[i].value}`, true);
            xml.send();
        })
    })
}
triggerenablebtn();


function addofferoption(){
    let selectProduct = document.querySelectorAll('.pro1')[0];
    let selectProd = document.querySelector('.selectproduct');
    let poffer = document.querySelectorAll(".selectproduct #poffer")[0];
    let poffer1 = document.querySelectorAll(".selectproduct #poffer1")[0];

    let labeloffer = document.querySelectorAll(".selectproduct label")[0];
    let pro1 = document.querySelectorAll(".selectproduct .pro1")[0];
    let xml = new XMLHttpRequest();
    poffer.innerHTML = "";
    poffer1.innerHTML = "";

    // console.log(poffer.innerHTML);
    xml.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            // console.log(this.responseText);
            let response = JSON.parse(this.responseText);
            response.forEach((resp)=>{
                poffer.innerHTML += ` 
                <option value="${resp['PRODUCT_ID']}">${resp['PRODUCT_NAME']}</option>
                `;
                poffer1.innerHTML += ` 
                <option value="${resp['PRODUCT_ID']}">${resp['PRODUCT_NAME']}</option>
                `;
                // document.querySelector('.hidcid').value = response['PRODUCT_ID'];
            })
            
        }
    }
    xml.open("POST", `customersList.php?trader=${3003}`, true);
    xml.send();

}
addofferoption();


function offerAdd(){
    let offerInput = document.querySelector('.offeradd');
    let offerDate = document.querySelector('.offerdate');
    // let 
    let poffer = document.querySelector(".pofferclass");
    let offerBtn = document.querySelector('.offerbtn button');
    offerBtn.addEventListener("click",()=>{
        let offer = offerInput.value;
        let Date = offerDate.value
        let offerProid = poffer.options[poffer.selectedIndex].value;
        let xml = new XMLHttpRequest();
        xml.onreadystatechange = function(){
            if(this.readyState == 4 && this.status == 200){
               location.reload();
            }
        }
        xml.open("POST", `addoffer.php?offer=${offer}&date=${Date}&offerPro=${offerProid}&traderid=${3003}`, true);
        xml.send();

        
    })

}

offerAdd();







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
    const tid = document.querySelector(".chidden");
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
        xmlHttp.open("POST", `updateprofile.php?name=${username.value}&email=${useremail.value}&firstname=${userfirstname.value}&lastname=${userlastname.value}&mobile=${editmobile.value}&gender=${gendervalue}&address=${editaddress.value}&tid=${tid.value}`, true );
        xmlHttp.send();
    }
    )
}
editCustPro();
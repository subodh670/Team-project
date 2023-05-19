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
    pages.forEach((item,i)=>{
        if(i>0){
            pages[i].style.display = 'none';
        }
    })
    navItem[0].style.fontWeight = "bolder";
    navItem.forEach((item, i)=>{
        item.addEventListener("click",()=>{
            let link = item.dataset.link;
            document.querySelector(`.${keyel} > #${link}`).style.display = 'block';
            navItem[i].style.fontWeight = "bolder";

            for(let j=0; j<pages.length; j++){
                if(j!=i){
                    // console.log(pages[j]);
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
                    productname[i].value = item['NAME'];
                    productprice[i].value = "£"+item['PRICE'];
                    productQuant[i].value = item['STOCK_AVAILABLE'];
                    productdesc[i].value = item['DESCRIPTION'];
                    productAllergy[i].value = item['ALLERGY_INFORMATION'];
            })
        }
    }
    xml.open("POST", `specificProduct.php?id=${id1[id].value}`, true);
    xml.send();
}

// disable shops

function addShop(){
    const shopname = document.querySelector(".shop-name input");
    const shopcategory = document.querySelector(".shop-name input");
    const shopcontact = document.querySelector(".shop-contact input");

    const shopBtn = document.querySelector(".addshopbtn button");
    shopBtn.addEventListener("click",()=>{
        let xml = new XMLHttpRequest();
    xml.onreadystatechange = function(){    
        if(this.readyState == 4 && this.status == 200){ 
            showShop();
            location.reload();
            // console.log(this.responseText);
        }
    }
    xml.open("POST", `addshop.php?name=${shopname.value}&category=${shopcategory.value}&contact=${shopcontact.value}`, true);
    xml.send();
    })

}
addShop();


function showShop(){
    const disableShop = document.querySelector(".disableshop");
    const enableshop = document.querySelector(".enableshop");
    const allshops = document.querySelector(".deleteshop");
    disableShop.innerHTML = "<div class='shoptitle'><p>Name</p><p>Address</p><p>Contact Number</p><p></p></div>";
    enableshop.innerHTML = "<div class='shoptitle'><p>Name</p><p>Address</p><p>Contact Number</p><p></p></div>";
    allshops.innerHTML = "<div class='shoptitle'><p>Name</p><p>Address</p><p>Contact Number</p><p></p></div>";
    let xml = new XMLHttpRequest();
    xml.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            // console.log(this.responseText);
            let result = JSON.parse(this.responseText);
            // console.log(result);
            result.forEach((item)=>{
                if(item['SHOP_STATUS'] == 1){
                    disableShop.innerHTML += `<div class="shopDetail">
                    <p>${item['NAME']}</p>
                    <p>${item["ADDRESS"]}</p>
                    <p>${item['CONTACT_NUMBER']}</p>
                    <input type="hidden" class="activeInput" value=${item['SHOP_ID']}>
                    <button>Disable</button>
                  </div>`;
                }
                if(item['SHOP_STATUS'] == 0){
                    enableshop.innerHTML += `<div class="shopDetail">
                    <p>${item['NAME']}</p>
                    <p>${item['ADDRESS']}</p>
                    <p>${item['CONTACT_NUMBER']}</p>
                    <input type="hidden" class="inactiveInput" value=${item['SHOP_ID']}>
                    <button>Enable</button>
                  </div>`;
                }
                allshops.innerHTML += `<div class="shopDetail">
                <p>${item['NAME']}</p>
                <p>${item['ADDRESS']}</p>
                <p>${item['CONTACT_NUMBER']}</p>
                <input type="hidden" class="deleteInput" value=${item['SHOP_ID']}>
                <button>Delete</button>
              </div>`;
            })
            triggerenablebtn();
            triggerDeleteBtn();
        }
    }
    xml.open("POST", `enableshop.php?trader=${1029}`, true);
    xml.send();
}

showShop();

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
                    showShop();
                }
            }
            xml.open("POST", `triggershopstatus.php?status=1&id=${inputId[i].value}`, true);
            xml.send();
        })
    })
    const enableBtn = document.querySelectorAll(".enableshop button");
    enableBtn.forEach((btn,i)=>{
        btn.addEventListener("click",()=>{
            let xml = new XMLHttpRequest();
            xml.onreadystatechange = function(){
                if(this.readyState == 4 && this.status == 200){
                    showShop();
                }
            }
            xml.open("POST", `triggershopstatus.php?status=0&id=${inputId2[i].value}`, true);
            xml.send();
        })
    })
}
// triggerenablebtn();

function triggerDeleteBtn(){
    const deleteshop = document.querySelectorAll(".deleteshop button");
    const inputId = document.querySelectorAll(".deleteshop .deleteInput");
    // console.log(inputId);
    console.log("HELLO");
    console.log(deleteshop);
    deleteshop.forEach((btn,i)=>{
        btn.addEventListener("click",()=>{
            console.log(inputId[i].value);
            let xml = new XMLHttpRequest();
            xml.onreadystatechange = function(){
                if(this.readyState == 4 && this.status == 200){
                    showShop();
                    location.reload();
                    // console.log(this.responseText);
                }
            }
            xml.open("POST", `deleteshop.php?id=${inputId[i].value}`, true);
            xml.send();
        })
    })
}
// triggerDeleteBtn();

function addofferoption(){
    let selectProduct = document.querySelectorAll('.pro1')[0];
    let selectProd = document.querySelector('.selectproduct');
    let poffer = document.querySelectorAll(".selectproduct #poffer")[0];
    let poffer1 = document.querySelectorAll(".selectproduct #poffer1")[0];
    console.log(poffer);
    console.log(poffer1);
    let labeloffer = document.querySelectorAll(".selectproduct label")[0];
    let pro1 = document.querySelectorAll(".selectproduct .pro1")[0];
    let xml = new XMLHttpRequest();
    if(poffer != null || poffer1 != null){
        poffer.innerHTML = "";
        if(poffer1!=null)
            poffer1.innerHTML = "";
        xml.onreadystatechange = function(){
            if(this.readyState == 4 && this.status == 200){
                console.log(this.responseText);
                let response = JSON.parse(this.responseText);
                response.forEach((resp)=>{
                    poffer.innerHTML += ` 
                    <option value="${resp['PRODUCT_ID']}">${resp['NAME']}</option>
                    `;
                    if(poffer1!=null)
                        poffer1.innerHTML += ` 
                        <option value="${resp['PRODUCT_ID']}">${resp['NAME']}</option>
                        `;
                    // document.querySelector('.hidcid').value = response['PRODUCT_ID'];
                })
                offerAdd();
    
                                            
            }
        }
        xml.open("POST", `customersList.php?trader=${1029}`, true);
        xml.send();
    }

    // console.log(poffer.innerHTML);
   

}
addofferoption();


function offerAdd(){
    let offerInput = document.querySelector('.offeradd');
    let offername = document.querySelector('.offername');

    let offerDate = document.querySelector('.offerdate');
    // let 
    let poffer = document.querySelector(".pofferclass");
    let pofferoption = document.querySelectorAll('.addoffers .selectproduct #poffer option')[0];
    let offerBtn = document.querySelector('.offerbtn button');
    // let offerProid =  pofferoption.value;
    let offerProid = pofferoption.value;
    poffer.onchange = function(){
        offerProid = poffer.options[poffer.selectedIndex].value;
    }
    offerBtn.addEventListener("click",()=>{
        let offer = offerInput.value;
        // console.log(offer);
        offername = offername.value;
        let Date = offerDate.value
        let xml = new XMLHttpRequest();
        xml.onreadystatechange = function(){
            if(this.readyState == 4 && this.status == 200){
                console.log(this.responseText);
               location.reload();
            }
        }
        xml.open("POST", `addoffer.php?offername=${offername}&offer=${offer}&date=${Date}&offerPro=${offerProid}&traderid=${1029}`, true);
        xml.send();

        
    })

}








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
    const editaddress = document.querySelector('.editaddress input');
    const updateBtn = document.querySelector(".updatebtn2 button");
    const tid = document.querySelector(".chidden");
    const errorusername = document.querySelector(".errorusername");
    const erroremail = document.querySelector(".erroremail");
    const errormobile = document.querySelector(".errormobile");
    // console.log(updateBtn);
    let gendervalue = 'male';
    editgender.onchange=function(){
        gendervalue = editgender.options[editgender.selectedIndex].value;    
    }
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


function modaladdoffers(){
    const offerBtn = document.querySelectorAll('.Updateoffer');
    let addoffers = document.querySelectorAll('.addoffers1');
    const backdrop = document.querySelector(".backdrop");
    offerBtn.forEach((item,i)=>{
        item.addEventListener('click',()=>{
            addoffers[i].classList.remove('updateoffer');
            backdrop.classList.remove('hidebackdrop');
        })
        backdrop.addEventListener("click",()=>{
            addoffers[i].classList.add('updateoffer');
            backdrop.classList.add('hidebackdrop');
        })
    })
    const addoffer = document.querySelector(".addoffer");
    const addoffersmodal = document.querySelector(".addoffers");
    addoffer.addEventListener("click",()=>{
        addoffersmodal.classList.remove('hideaddoffer');
        backdrop.classList.remove('hidebackdrop');
        // addofferoption();
    })
    backdrop.addEventListener("click",()=>{
        addoffersmodal.classList.add('hideaddoffer');
        backdrop.classList.add('hidebackdrop');
    })

}

modaladdoffers();
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
            console.log('alert');
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


// const traderaccess = document.querySelector(".traderaccess");
// console.log(traderaccess.value);
// const profilemanage = document.querySelector(".reports");
// const profilemanage2 = document.querySelector(".reports2");
// console.log(profilemanage2);

mainLinkClick();
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
    const pidupdate = document.querySelectorAll(".pidupdate");

    const xml = new XMLHttpRequest();
    xml.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            let response = JSON.parse(this.responseText);
            // console.log(response);
            // console.log(response[0]['MANUFACTURE_DATE']);

            response.forEach((item,i)=>{
                    productname[i].value = item['NAME'];
                    productprice[i].value = item['PRICE'];
                    productQuant[i].value = item['STOCK_AVAILABLE'];
                    productdesc[i].value = item['DESCRIPTION'];
                    productAllergy[i].value = item['ALLERGY_INFORMATION'];
                    pidupdate[i].value = item['PRODUCT_ID'];
                    // console.log(manudate[0].value);
            })
        }
    }
    xml.open("POST", `specificProduct.php?id=${id1[id].value}`, true);
    xml.send();
}

// disable shops

function addShop(){
    let traderId = document.querySelector(".hiddentraderid").value;
    const shopname = document.querySelector(".shop-name input");
    const shopaddress = document.querySelector(".shop-address input");
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
    xml.open("POST", `addshop.php?name=${shopname.value}&address=${shopaddress.value}&contact=${shopcontact.value}&trader=${traderId}`, true);
    xml.send();
    })

}
addShop();

function addProduct(){
    const pname = document.querySelector('.productname input');
    const pprice = document.querySelector(".productprice input");
    const pquant = document.querySelector(".productquantity input");
    const prodesc = document.querySelector(".proDescription input");
    const promanu = document.querySelector('.productmanudate input');
    const proexpire = document.querySelector(".productexpiredate input");
    const productallergy = document.querySelector(".productallergy input");
    const shopName = document.querySelector('.shop #shopname');
    const image1 = document.querySelector(".image1 input");
    const image2 = document.querySelector(".image2 input");
    const image3 = document.querySelector(".image3 input");
    const button = document.querySelector(".btnaddpro button");
    shopName.addEventListener("change",()=>{
        shopName = shopName.options[shopName.selectedIndex].value;
    })
    button.addEventListener("click",()=>{
        let xml = new XMLHttpRequest();
        xml.onreadystatechange = function(){
            if(this.readyState == 4 && this.status == 200){
                console.log(this.responseText);
            }
        }
        xml.open("POST", `addproduct.php?pname=${pname.value}&pprice=${pprice.value}&pquant=${pquant.value}&prodesc=${prodesc.value}&promanu=${promanu.value}&proexpire=${proexpire.value}&proallergy=${productallergy}&shopid=${shopName.value}&image1=${image1.value}&image2=${image2.value}&image3=${image3.value}`, true);
        xml.send();
    })


}

function addshopoption(){
    let pshop = document.querySelector(".shop #shopname");
    let pshop1 = document.querySelector(".shop #shopname1");
    let traderId = document.querySelector(".hiddentraderid").value;
    // let pshop1 = document.querySelector(".shop #pshop1");
    // let labeloffer = document.querySelectorAll(".selectproduct label")[0];
    // let pro1 = document.querySelectorAll(".selectproduct .pro1")[0];
    let xml = new XMLHttpRequest();
    if(pshop != null){
        pshop.innerHTML = "";
        pshop1.innerHTML = "";
        // if(pshop1!=null)
        //     pshop1.innerHTML = "";
        xml.onreadystatechange = function(){
            if(this.readyState == 4 && this.status == 200){
                console.log(this.responseText);
                let response = JSON.parse(this.responseText);
                response.forEach((resp)=>{
                    pshop.innerHTML += ` 
                    <option value="${resp['SHOP_ID']}">${resp['NAME']}</option>
                    `;
                    pshop1.innerHTML += ` 
                    <option value="${resp['SHOP_ID']}">${resp['NAME']}</option>
                    `;
                    // document.querySelector('.hidcid').value = response['PRODUCT_ID'];
                })
                // offerAdd();                               
            }
        }
        xml.open("POST", `shoplist.php?trader=${traderId}`, true);
        xml.send();
    }
}
addshopoption();

function showShop(){
    let traderId = document.querySelector(".hiddentraderid").value;
    console.log(traderId);
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
    xml.open("POST", `enableshop.php?trader=${traderId}`, true);
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
    let traderId = document.querySelector(".hiddentraderid").value;

    let selectProduct = document.querySelectorAll('.pro1')[0];
    let selectProd = document.querySelector('.selectproduct');
    let poffer = document.querySelectorAll(".selectproduct .pofferclass2");
    let poffer1 = document.querySelector(".selectproduct #poffer1");
    console.log(poffer);
    console.log(poffer1);
    let labeloffer = document.querySelectorAll(".selectproduct label")[0];
    let pro1 = document.querySelectorAll(".selectproduct .pro1")[0];
    let xml = new XMLHttpRequest();
    if(poffer.length>0 || poffer1 != null){
        poffer.forEach((pof)=>{
            pof.innerHTML = "";
        })
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
                poffer.forEach((pof)=>{
                    response.forEach((resp)=>{
                        pof.innerHTML += ` 
                        <option value="${resp['PRODUCT_ID']}">${resp['NAME']}</option>
                        `;
                    })
                })
                // offeradd();
                // offerupdate(); 
                offerupdate();                              
            }
        }
        xml.open("POST", `productslist.php?trader=${traderId}`, true);
        xml.send();
    }

    // console.log(poffer.innerHTML);
   

}
addofferoption();


function offerupdate(){
    let traderId = document.querySelector(".hiddentraderid").value;

    let offerInput = document.querySelectorAll('.offeradd2');
    let offername = document.querySelectorAll('.offername2');

    let offerDate = document.querySelectorAll('.offerdate2');
    // let 
    let poffer = document.querySelectorAll(".pofferclass2");
    let pofferoption = document.querySelectorAll('.addoffers1 .selectproduct .pofferclass2 option')[0];
    let offerBtn = document.querySelectorAll('.offerbtn2 button');
    let offerhideId = document.querySelectorAll(".hideofferupdate");
    // console.log(offerhideId);
    // console.log(poffer[0]);
    // let offerProid =  pofferoption.value;
    // console.log(pofferoption.value);
    console.log("HEY");
    offerBtn.forEach((item,i)=>{
        // if(offerProid !=)
        let offerProid = [];
        poffer[i].onchange = function(){
            offerProid.push(poffer[i].options[poffer[i].selectedIndex].value);
        }
        if(offerProid.length != i+1){
            offerProid.push(pofferoption.value);
        }
        console.log(pofferoption.value);
        console.log(offerProid[i]);
        item.addEventListener("click",()=>{
            
            let offer = offerInput[i].value;
            console.log("ITS ME");
            offername = offername[i].value;
            let Date = offerDate[i].value
            let xml = new XMLHttpRequest();
            xml.onreadystatechange = function(){
                if(this.readyState == 4 && this.status == 200){
                    // console.log(this.responseText);
                   location.reload();
                }
            }
            // console.log(offerProid[i]);
            console.log(offername);
            console.log(offer);
            console.log(Date);
            // console.log(offerProid);
            console.log(traderId);
            xml.open("POST", `updateoffer.php?offername=${offername}&offer=${offer}&date=${Date}&offerPro=${offerProid[i]}&traderid=${traderId}&offerid=${offerhideId[i].value}`, true);
            xml.send();
    
            
        })
    })
  

}
// offerupdate();   

function offeradd(){
    let traderId = document.querySelector(".hiddentraderid").value;

    let offerInput = document.querySelector('.offeradd1');
    let offername = document.querySelector('.offername1');

    let offerDate = document.querySelector('.offerdate1');
    // let 
    let poffer = document.querySelector(".pofferclass1");
    let pofferoption = document.querySelectorAll('.addoffers .selectproduct #poffer1 option')[0];
    let offerBtn = document.querySelectorAll('.offerbtn1 button')[0];
    // let offerProid =  pofferoption.value;
    let offerProid = pofferoption?.value;
    poffer.onchange = function(){
        offerProid = poffer.options[poffer.selectedIndex].value;
    }
    // console.log(offerProid);

    offerBtn.addEventListener("click",()=>{
        let offer = offerInput.value;
        console.log("ITS YOU");
        offername = offername.value;
        let Date = offerDate.value
        let xml = new XMLHttpRequest();
        xml.onreadystatechange = function(){
            if(this.readyState == 4 && this.status == 200){
                console.log(this.responseText);
            //    location.reload();
            }
        }
        console.log(offerProid);
        console.log(offername);
        console.log(offer);
        console.log(Date);
        console.log(offerProid);
        console.log(traderId);
        xml.open("POST", `addoffer.php?offername=${offername}&offer=${offer}&date=${Date}&offerPro=${offerProid}&traderid=${traderId}`, true);
        xml.send();

        
    })

}
// offeradd();

const triggerEditBtn = document.querySelector(".editbtntrigger");
const editprofilemodal = document.querySelector(".editprofile");
const xmarkClose = document.querySelector(".xmark i");
const backdrop = document.querySelector(".backdrop");


    triggerEditBtn.addEventListener("click",(e)=>{
        editprofilemodal.classList.remove("hideEditprofile");
        backdrop.classList.remove("hidebackdrop");
        // edittraderPro();
    })
    xmarkClose.addEventListener("click",()=>{
        editprofilemodal.classList.add("hideEditprofile");
        backdrop.classList.add("hidebackdrop");
        
    })
    backdrop.addEventListener("click",()=>{
        editprofilemodal.classList.add("hideEditprofile");
        backdrop.classList.add("hidebackdrop");
    })

function edittraderPro(){
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
    console.log(updateBtn);
    let gendervalue = 'male';
    editgender.onchange = function(){
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
edittraderPro();


function modaladdoffers(){
    const offerBtn = document.querySelectorAll('.Updateoffer');
    let addoffers = document.querySelectorAll('.addoffers1');
    const backdrop = document.querySelector(".backdrop");
    console.log("ME");
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

function selectcategory(){
    let traderId = document.querySelector(".hiddentraderid").value;
    let othercat = document.querySelector(".categoryselect input");

    let pcategory = document.querySelector(".categoryselect #category");
    // let pcategory1 = document.querySelector(".shop #pcategory1");
    // let labeloffer = document.querySelectorAll(".selectproduct label")[0];
    // let pro1 = document.querySelectorAll(".selectproduct .pro1")[0];
    let xml = new XMLHttpRequest();
    if(pcategory != null){
        pcategory.innerHTML = "";
        // if(pcategory1!=null)
        //     pcategory1.innerHTML = "";
        xml.onreadystatechange = function(){
            if(this.readyState == 4 && this.status == 200){
                console.log(this.responseText);
                let response = JSON.parse(this.responseText);
                let num = 0;
                response.forEach((resp, i)=>{
                    pcategory.innerHTML += ` 
                    <option value="${resp['CATEGORY_ID']}">${resp['CATEGORY_NAME']}</option>
                    `;
                    num++;
                    // document.querySelector('.hidcid').value = response['PRODUCT_ID'];
                })
                
                pcategory.innerHTML += ` <option value="others" class='othercategory'>others</option>`
                // offerupdate();  
                console.log(num);
                otherCategory(); 
                if(num===0){
                        document.querySelector(".categoryselect input").type= 'text';

                }                            
            }

        }
        xml.open("POST", `categorylist.php?trader=${traderId}`, true);
        xml.send();
    }
}
selectcategory();

function otherCategory(x){
    let pcategory = document.querySelector(".categoryselect #category");
    let othercat = document.querySelector(".categoryselect input");
    if(x===0){
        othercat.type = 'text';
    }
    pcategory.addEventListener("input",()=>{
        console.log("HEY");
        pcategory = pcategory.options[pcategory.selectedIndex].value;
        if(pcategory === 'others'){
            othercat.type = 'text';
        }
        else{
            console.log("hello");
            othercat.type = 'hidden';
        }
    })
}
otherCategory();
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



const traderpic = document.querySelector(".changetraderpicture");
const traderpicbtn = document.querySelector(".changetraderpicture button");

const uploadpic = document.querySelector(".uploadpicture");
traderpic.addEventListener("click",()=>{
        uploadpic.style.display = 'flex';
        traderpicbtn.style.display = 'none';

})
const cancel = document.querySelectorAll(".uploadpicture button")[1];
if(cancel != null){
    cancel.addEventListener("click",()=>{
        uploadpic.style.display = 'none';
        traderpicbtn.style.display = 'block';

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


// const buttonUpdateOffer = document.querySelectorAll(".updateofferbtn");
// buttonUpdateOffer.forEach((item)=>{
//     item.addEventListener("click",()=>{
//         item.type = 'submit';
//     })
// })
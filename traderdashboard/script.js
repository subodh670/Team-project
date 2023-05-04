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
        console.log(item);
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
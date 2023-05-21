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


    
function editAdmin(){
    const username = document.querySelector(".editusername input");
    const useremail = document.querySelector(".editemail input");
    const userfirstname = document.querySelector(".editfirstname input");
    const userlastname = document.querySelector(".editlastname input");
    const editmobile = document.querySelector('.editmobile input');
    const editgender = document.querySelector('.editgender select');
    let gendervalue = 'male';
    editgender.addEventListener("change",()=>{
        gendervalue = editgender.options[editgender.selectedIndex].value;
    })
    // const gendervalue = editgender.options[editgender.selectedIndex].value;
    const editaddress = document.querySelector('.editaddress input');
    const updateBtn = document.querySelector(".updatebtn2 button");
    const aid = document.querySelector(".chidden");
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
        xmlHttp.open("POST", `updateprofile.php?name=${username.value}&email=${useremail.value}&firstname=${userfirstname.value}&lastname=${userlastname.value}&mobile=${editmobile.value}&gender=${gendervalue}&address=${editaddress.value}&cid=${aid.value}`, true );
        xmlHttp.send();
    }
    )
}
editAdmin();


//supportedadmins

const adminsPara = document.querySelectorAll(".supportedadmin p");
// const adminsiconspan = document.querySelectorAll(".supportedadmin p ");
adminsPara.forEach((item)=>{
    item.addEventListener("mouseover",()=>{
        let span = item.childNodes;
        span.forEach((next,j)=>{
            if(j>0){
                next.style.display = 'block';
                // next.style.transition = '0.8s';
            }
        })
        // adminsiconspan.style.display = 'block';
    })
    item.addEventListener("mouseout",()=>{
        let span = item.childNodes;
        span.forEach((next,j)=>{
            if(j>0){
                next.style.display = 'none';
                // next.style.transition = '0.8s';

            }
        })
        // adminsiconspan.style.display = 'block';
    })
})

const adminpic = document.querySelector(".changeadminpicture");
const adminpicbtn = document.querySelector(".changeadminpicture button");

const uploadpic = document.querySelector(".uploadpicture");
adminpic.addEventListener("click",()=>{
        uploadpic.style.display = 'flex';
        adminpicbtn.style.display = 'none';

})
const cancel = document.querySelectorAll(".uploadpicture button")[1];
if(cancel != null){
    cancel.addEventListener("click",()=>{
        uploadpic.style.display = 'none';
        adminpicbtn.style.display = 'block';

    })
}
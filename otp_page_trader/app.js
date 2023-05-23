"use strict";

const counter = document.querySelector(".counter");
const form1 = document.querySelector(".otp form");
let count = 180;
let intervalOutput = setInterval(()=>{
    counter.innerHTML = `${count} seconds remaining`
    count--;
    if(count === -1){
        clearInterval(intervalOutput);
    }
},1000);
// console.log(count);


setTimeout(()=>{
    form1.innerHTML = `<p>Request timeout failed</p>
         <div class='btn'>
            <button name='resend'>Resend</button>    
         </div>
        `;
},180000);



const verify = document.querySelector(".verify");
const otp = document.querySelector(".inputotp #otp");
const finalOtp = document.querySelector("#finalotp");
verify.onclick = function(){
    let email = document.querySelector(".validtop");
    let xmlhttp = new XMLHttpRequest();
    if(otp.value === finalOtp.value){
        verify.type='submit';
        verify.innerHTML = "Redirect";
        form1.innerHTML = `<p>OTP matched</p> <div class='btn'><button type='submit' name='verify' class='verify'>Redirect</button></div>`;
    }
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

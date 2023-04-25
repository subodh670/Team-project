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
verify.onclick = function(){
    let email = document.querySelector(".validtop");
    let xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            const item = JSON.parse(this.responseText);
            console.log(item);
            if(otp.value === item){
                verify.type='submit';
                verify.innerHTML = "Redirect";
                form1.innerHTML = `<p>Password matched</p> <div class='btn'><button type='submit' name='verify' class='verify'>Redirect</button></div>`;
            }
            
        }
    }
    xmlhttp.open("POST",`otp.php?email=${email.value}`, true);
    xmlhttp.send();
}

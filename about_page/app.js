"use strict";


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



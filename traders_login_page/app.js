"use strict";

const bars = document.querySelector(".bars");
const form = document.querySelector('.container form');
const backdrop = document.querySelector(".backdrop");

bars.addEventListener("click",(e)=>{
    const target = e.currentTarget;
    form.classList.toggle("show-form");
    backdrop.classList.toggle("show-back");
})
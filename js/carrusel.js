"use strict";

document.addEventListener("DOMContentLoaded", () => {
    const nextBtn = document.querySelector(".carrusel-next");
    const prevBtn = document.querySelector(".carrusel-prev");
    const slide = document.querySelector(".carrusel-slide");

    if (!nextBtn || !prevBtn || !slide) return;

    nextBtn.addEventListener("click", function () {
        const items = document.querySelectorAll(".carrusel-item");
        if (items.length > 0) {
            slide.appendChild(items[0]);
        }
    });

    prevBtn.addEventListener("click", function () {
        const items = document.querySelectorAll(".carrusel-item");
        if (items.length > 0) {
            slide.prepend(items[items.length - 1]);
        }
    });
});
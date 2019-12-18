"use strict";

// Like posts
let likeImgs = document.querySelectorAll(".like-img");

function toggleImage() {
  if ((this.src = "/assets/icons/star.png")) {
    let liked = "/assets/icons/filledstar.png";
    this.src = liked;
    console.log(this);
  }
}

likeImgs.forEach(likeImg => {
  likeImg.addEventListener("click", toggleImage);
});

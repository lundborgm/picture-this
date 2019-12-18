"use strict";

const likeBtns = document.querySelectorAll(".like-btn");

likeBtns.forEach(likeBtn => {
  likeBtn.addEventListener("click", toggleImage);
});

function toggleImage() {
  let liked = "/assets/icons/filledstar.png";
  let likeImg = document.querySelector(".like-img");

  likeImg.src = liked;
}

"use strict";

// Like posts
let likeImgs = document.querySelectorAll(".like-img");
let url = "/app/posts/likes.php";
let formData = new formData();

function toggleImage() {
  if ((this.src = "/assets/icons/star.png")) {
    let liked = "/assets/icons/filledstar.png";
    this.src = liked;
    console.log(this);
  }
}

likeImgs.forEach(likeImg => {
  likeImg.addEventListener("click", toggleImage);
  console.log(likeImg.dataset.id);
});

fetch(url, {
  method: "POST",
  body: formData
})
  .then(response => response.json())
  .then(likes => {});

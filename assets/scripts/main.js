"use strict";

// Like posts
const likeImgs = document.querySelectorAll(".like-img");
const likeForm = document.querySelector(".like-form");
const url = "/app/posts/likes.php";

// console.log(likeForm);

// function toggleImage() {
//   if ((this.src = "/assets/icons/star.png")) {
//     let liked = "/assets/icons/filledstar.png";
//     this.src = liked;
//     console.log(this);
//   }
// }

// likeImgs.forEach(likeImg => {
//   likeImg.addEventListener("click", toggleImage);
//   console.log(likeImg.dataset.id);
// });

// likeForm.addEventListener("submit", function(e) {
//   e.preventDefault();

//   const formData = new FormData(this);

//   fetch(url, {
//     method: "POST",
//     body: formData
//   })
//     .then(response => {
//       return response.json();
//     })
//     .then(json => {
//       console.log("hello");
//     });
// });

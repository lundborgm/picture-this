"use strict";

const buttons = document.querySelectorAll(".like-btn");
const forms = document.querySelectorAll(".like-form");
const stars = document.querySelectorAll(".fa-star");
const url = "http://localhost:8000/app/posts/likes.php";

function toggleStar() {
  if (this.classList.contains("far")) {
    this.classList.remove("far");
    this.classList.add("fas");
  } else {
    this.classList.remove("fas");
    this.classList.add("far");
  }
}

stars.forEach(star => {
  star.addEventListener("click", toggleStar);
});

forms.forEach(form => {
  form.addEventListener("submit", e => {
    e.preventDefault();
    const formData = new FormData(form);

    fetch(url, {
      method: "POST",
      body: formData
    })
      .then(response => {
        // Take the response Promise and return it as JSON.
        return response.json();
      })
      .then(json => {
        // Now it is possible to use the JSON as a normal object.
        const likes = e.target.querySelector(".likes");

        console.log(json);

        if (json === 0) {
          likes.textContent = " ";
        } else {
          likes.textContent = json;
        }
      });
  });
});

"use strict";

const buttons = document.querySelectorAll(".like-btn");
const stars = document.querySelectorAll(".fa-star");
const forms = document.querySelectorAll(".like-form");
const url = "http://localhost:8000/app/posts/likes.php";

function toggleStar() {
  if (this.classList.contains("far")) {
    this.classList.add("fas");
    this.classList.remove("far");
  } else {
    this.classList.add("far");
    this.classList.remove("fas");
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
        console.log(json);
      });
  });
});

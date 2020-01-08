"use strict";

// const followers = document.querySelector(".followers");
// const following = document.querySelector(".following");
const form = document.querySelector(".follow-form");

if (form) {
  form.addEventListener("submit", e => {
    e.preventDefault();
    const formData = new FormData(form);

    fetch("http://localhost:8000/app/users/follow.php", {
      method: "POST",
      body: formData
    })
      .then(response => {
        return response.json();
      })
      .then(json => {
        console.log(json);

        const followBtn = document.querySelector(".follow-btn");

        if (json === 0) {
          followBtn.innerHTML = "Follow";
        } else {
          followBtn.innerHTML = "Unfollow";
        }
      });
  });
}

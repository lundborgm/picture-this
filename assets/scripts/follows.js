"use strict";

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
        const followBtn = document.querySelector(".follow-btn");
        const followers = document.querySelector(".followers");
        followers.innerHTML = json.followers;

        if (json.isFollowing === false) {
          followBtn.innerHTML = "Follow";
        } else {
          followBtn.innerHTML = "Unfollow";
        }
      });
  });
}

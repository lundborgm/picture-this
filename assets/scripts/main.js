"use strict";

const logout = document.querySelector(".logout");
const deletePost = document.querySelector(".delete-post");

if (logout) {
  logout.addEventListener("click", function(e) {
    const confirmLogout = confirm("Are you sure you want to log out?");

    if (!confirmLogout) {
      e.preventDefault();
    }
  });
}

if (deletePost) {
  deletePost.addEventListener("click", function(e) {
    const confirmDelete = confirm("Are you sure you want to delete your post?");

    if (!confirmDelete) {
      e.preventDefault();
    }
  });
}

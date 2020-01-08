"use strict";

// const buttons = document.querySelectorAll(".send");
const commentForms = document.querySelectorAll(".comment-form");
// const commentList = document.querySelector(".comment-list");
// const comments = document.querySelectorAll(".comment");

commentForms.forEach(form => {
  form.addEventListener("submit", e => {
    e.preventDefault();
    const formData = new FormData(form);

    fetch("http://localhost:8000/app/posts/comments.php", {
      method: "POST",
      body: formData
    })
      .then(response => {
        // Take the response Promise and return it as JSON.
        return response.json();
      })
      .then(json => {
        // Now it is possible to use the JSON as a normal object.
        const newComment = json.comment;

        console.log(newComment);
      });
  });
});

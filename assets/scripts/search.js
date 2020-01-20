"use strict";

const search = document.querySelectorAll(".search-form");

search[0].addEventListener("submit", e => {
    e.preventDefault();
    const formData = new FormData(search[0]);
        
    fetch("http://localhost:8000/app/posts/search.php", {
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
        //link to new page
        
      });
  });


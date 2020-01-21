"use strict";

const search = document.querySelector(".search-form");

search.addEventListener("submit", e => {
    e.preventDefault();
    const formData = new FormData(search);
        
    fetch("http://localhost:8000/app/posts/search.php", {
      method: "POST",
      body: formData
    })
      .then(response => {
        // Take the response Promise and return it as JSON.
        return response.json();
      })
      .then(json => {
          
          if (!window.location.toString().includes("searchView.php")){
              window.location.href = "http://localhost:8000/searchView.php";
            }
              
                              
                        
            
                      console.log(json);
                    
                    });
  });


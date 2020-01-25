"use strict";
const getUrl =(json)=>{
    window.location.href =
      searchView +
      "?usr=" +
      json["users"].length +
      "&" +
      "posts=" +
      json["users"].length;
      }

  const searchResult =(elementArray,json,event)=>{      
      let forEachNum = 0;  
        elementArray.forEach(element => {
        switch (event) {
          case "img":
            element.src ="uploads/avatar/" + json["users"][forEachNum].avatar_image;
            break;
          case "name":
            element.innerHTML =json["users"][forEachNum].name;
            break;
            case "link":
            element.href = "visitprofile.php?id=" + json["users"][forEachNum].id
        }
        forEachNum++;
          
          
        });
    }
    


const users = document.querySelectorAll(".search-box");
const imgAvatar = document.querySelectorAll(".search-avatar");
const userName = document.querySelectorAll(".search-box h3");
const userLink = document.querySelectorAll(".search-box a");

const search = document.querySelector(".search-form");
const searchView = "http://localhost:8000/searchView.php";

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
            localStorage.setItem('json',JSON.stringify(json))
               getUrl(json)
            
        
      });


      
    });
    const searchJson  = JSON.parse(localStorage.getItem("json"));
    // top links to users
    if(searchJson !== null){
      searchResult(imgAvatar,searchJson,"img")
      searchResult(userName,searchJson,"name");
      searchResult(userLink, searchJson, "link");
    }
  

      console.log(searchJson);

     localStorage.removeItem("json");
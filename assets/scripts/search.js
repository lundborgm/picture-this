"use strict";


const getUrl =(json)=>{
  if(json['search'] === ""){
    window.location.href = searchView;
  }else{

    window.location.href =
    searchView +
    "?usr=" +
    json["users"].length
    +"&"+"search="+json["search"];
        }
      }

  const searchResult =(elementArray,json,event, userOrPost)=>{      
      let forEachNum = 0;  
        elementArray.forEach(element => {
        switch (event) {
          case "img":
            element.src ="uploads/avatar/" + json[userOrPost][forEachNum].avatar_image;
            break;
          case "name":
            element.innerHTML = json[userOrPost][forEachNum].name;
            break;
            case "link":
            element.href =
              "visitprofile.php?id=" + json[userOrPost][forEachNum].id;
        }
        forEachNum++;
          
          
        });
    }
    

//!ALL USERS
const users = document.querySelectorAll(".search-box");
const imgAvatar = document.querySelectorAll(".search-avatar");
const userName = document.querySelectorAll(".search-box h3");
const userLink = document.querySelectorAll(".search-box a");

//! FETCH SEARCH
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
          ''
            getUrl(json)
      });


      
    });
    const searchJson  = JSON.parse(localStorage.getItem("json"));
    // top links to users
    if(searchJson !== null){
      searchResult(imgAvatar,searchJson,"img","users")
      searchResult(userName, searchJson, "name", "users");
      searchResult(userLink, searchJson, "link","users");
    }
  

      

     localStorage.removeItem("json");
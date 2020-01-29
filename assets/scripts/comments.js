"use strict";

const commentForms = document.querySelectorAll(".comment-form");
//comment

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
        const newAuthor = json.name;
        const comment = e.target.querySelector(".comment");
        const author = e.target.querySelector(".author");
      
        comment.innerHTML = newComment;
        author.innerHTML = newAuthor;
        location.reload();
      });
  });
});
//reply comment
const showReplyBtns  = document.querySelectorAll('.show-replyBtn');
showReplyBtns.forEach(showReplyBtn => {
  
  showReplyBtn.addEventListener("click", e => {
    
    const ShowReplyForm = showReplyBtn.parentNode.querySelector('.reply-form').classList
    const replyForm = showReplyBtn.parentNode.querySelector(".reply-form");
    if(ShowReplyForm[1] === 'hide-reply'){
      ShowReplyForm.remove('hide-reply')
        replyForm.querySelector('.reply-input').focus();
      showReplyBtn.textContent = "Cancel";
        
    }else{
      ShowReplyForm.add('hide-reply');
      showReplyBtn.textContent = "Reply";
    }

  });  

});
//post

const replyForm = document.querySelectorAll('.reply-form')
replyForm.forEach(form => {
    form.addEventListener('submit',e=>{
     e.preventDefault()
            const formData = new FormData(form);
            const changeBtn = form.parentNode.querySelector('button')
            changeBtn.textContent = 'Reply';

    fetch("http://localhost:8000/app/posts/comments.php", {
      method: "POST",
      body: formData
    })
      .then(response => {
        // Take the response Promise and return it as JSON.
        
        return response.json();
      })
      .then(json => {
        location.reload();
      })

      form.classList.add('hide-reply')

     
    })


})
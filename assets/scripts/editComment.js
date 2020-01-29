const edits = document.querySelectorAll('.edit-form');



let num = 0;  
edits.forEach(edit => {
    edit.addEventListener("submit", e => {

        
        const change = edit.parentNode.parentNode.parentNode.querySelector('.comment');
        const editBtn = edit.querySelector('button')
        const inputs = edit.querySelectorAll('input');
        
        if(num%2 === 0){
            e.preventDefault();
            //posible to write in the comment
            change.contentEditable = true;
            change.focus();
            //change how edit button look
            editBtn.textContent ="Confirm";
            editBtn.classList.add('confirm-btn')
       }
       if (num%2 ===1) {
                    e.preventDefault();
                        //disable write in the comment
                         change.contentEditable = false;
                         //get's the value of the comment
                         const thetext = change.textContent;
                         //change how edit button look
                         inputs[0].value = thetext; //put the value in a hidden input
                         editBtn.textContent = "Edit";
                         editBtn.classList.remove("confirm-btn");
                         
                           
                            const formData = new FormData(edit);

                           fetch("/app/posts/editComment.php", {
                             method: "post",
                             body: formData
                           })
                             .then(response => {
                               return response;
                             })
                             .catch(error => {
                               console.log(error);
                             })
                             .then(myJson => {
                               
                             });
                       
                          
                }    
     
       num++
       (num === 2)? num =0 : num;
    });    

  });
const ReplyEdits = document.querySelectorAll(".replyEdit-form");
let num2 = 0;
ReplyEdits.forEach(edit => {
  edit.addEventListener("submit", e => {
    const change = edit.parentNode.parentNode.childNodes[1].querySelector('.comment')
    const editBtn = edit.querySelector("button");
    const inputs = edit.querySelectorAll("input");
    
    if (num2 % 2 === 0) {
      e.preventDefault();
      //posible to write in the comment
      change.contentEditable = true;
      change.focus();
      //change how edit button look
      editBtn.textContent = "Confirm";
      editBtn.classList.add("confirm-btn");
    }
    if (num2 % 2 === 1) {
      e.preventDefault();
      //disable write in the comment
      change.contentEditable = false;
      //get's the value of the comment
      const thetext = change.textContent;
      //change how edit button look
      inputs[0].value = thetext; //put the value in a hidden input
      editBtn.textContent = "Edit";
      editBtn.classList.remove("confirm-btn");

      const formData = new FormData(edit);

      fetch("/app/posts/editComment.php", {
        method: "post",
        body: formData
      })
        .then(response => {
          return response;
        })
        .catch(error => {
          console.log(error);
        })
        .then(myJson => {});
    }

    num2++;
    num2 === 2 ? (num2 = 0) : num2;
  });
});

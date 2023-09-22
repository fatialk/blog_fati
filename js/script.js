let postForm = document.querySelector(".create-post-hidden");
let addPost = document.querySelector(".add-post");
console.log(addPost)
addPost.addEventListener("click", (event) => {
   if(postForm.style.display != "block"){
    postForm.style.display= "block";
  } else {
    postForm.style.display= "none";
  }
})


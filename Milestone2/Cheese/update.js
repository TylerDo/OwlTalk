function editPost(id){
    let post = document.querySelector(`.form${id} .post-container`)
    let form = document.querySelector(`.form${id} form`);
    let title = document.querySelector(`.form${id} h3`);
    let body = document.querySelector(`.form${id} p`);
    let titleInput = document.querySelector(`.form${id} .title`);
    let bodyInput = document.querySelector(`.form${id} .body`);

    if(form.classList.contains("d-none")){
       titleInput.value = title.innerHTML;
       bodyInput.value = body.innerHTML;
    }

    form.classList.toggle("d-none");
        post.classList.toggle("d-none");
}

console.log("Hello")
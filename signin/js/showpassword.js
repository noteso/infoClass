const pwField = document.querySelector("#Password");
const toggleBtn = document.querySelector(".input-group-text");
const icon = document.querySelector(".bi-eye-fill");

toggleBtn.onclick = () => {
    if(pwField.type == "password"){
        pwField.type = "text";
        icon.classList.add("bi-eye-slash-fill");
        icon.classList.remove("bi-eye-fill");
    }
    else{
        pwField.type = "password";
        icon.classList.replace("bi-eye-slash-fill", "bi-eye-fill");
    }
}
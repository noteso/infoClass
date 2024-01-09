const pwField = document.querySelector("#Password");
const toggleBtn = document.querySelector("#toggleBtn");
const icon = document.querySelector("#icon");

const rePwField = document.querySelector("#RepeatPassword");
const toggleReBtn = document.querySelector("#toggleReBtn");
const reIcon = document.querySelector("#reIcon");

toggleBtn.onclick = () => {
    if(pwField.type == "password"){
        pwField.type = "text";
        icon.classList.replace("bi-eye-fill", "bi-eye-slash-fill")
    }
    else{
        pwField.type = "password";
        icon.classList.replace("bi-eye-slash-fill", "bi-eye-fill");
    }
}
toggleReBtn.onclick = () => {
    if(rePwField.type == "password"){
        rePwField.type = "text";
        reIcon.classList.replace("bi-eye-fill", "bi-eye-slash-fill")
    }
    else{
        rePwField.type = "password";
        reIcon.classList.replace("bi-eye-slash-fill", "bi-eye-fill");
    }
}
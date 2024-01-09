const form = document.querySelector("#signupform");
const submitBtn = document.querySelector("input[type=submit]");
const errorM = document.querySelector("#errorbox")

form.onsubmit = (e) => {
    e.preventDefault();
}

submitBtn.onclick = () => {
    let spaces = input.value.search(" ");
    if(spaces == -1){
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "../php/signup.php", true);
        xhr.onload = () => {
            if(xhr.readyState == XMLHttpRequest.DONE){
                if(xhr.status == 200){
                    let data = xhr.response;
                    if(data == "success"){
                        location.href = "../classrooms";
                    }
                    else{
                        errorM.textContent = data;
                        errorM.classList.remove("d-none");
                        window.scrollTo(0, 0);
                    }
                }
            }
        }
        let formData = new FormData(form);
        xhr.send(formData);    	
    }
    else{
        errorM.textContent = "Username cannot contain spaces!";
        errorM.classList.remove("d-none");
        window.scrollTo(0, 0);   
    }
}

//setup before functions
let typingTimer;                //timer identifier
const doneTypingInterval = 500;  //time in ms, 1 seconds for example
const input = document.querySelector("#username");
const validator = document.querySelector("#validator")

//on keyup, start the countdown
input.addEventListener('keyup', () => {
    clearTimeout(typingTimer);
    typingTimer = setTimeout(doneTyping, doneTypingInterval);
});

//on keydown, clear the countdown 
input.addEventListener('keydown', () => {
    clearTimeout(typingTimer);
});

//user is "finished typing," do something
function doneTyping () {
    let spaces = input.value.search(" ");
    if(spaces == -1){
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "../php/checkusername.php", true);
        xhr.onload = () => {
            if(xhr.readyState == XMLHttpRequest.DONE){
                if(xhr.status == 200){
                    let data = xhr.response;
                    if(data == "yes"){
                        validator.classList.replace("bi-question-circle-fill", "bi-check-circle-fill");
                        validator.classList.replace("bi-x-circle-fill", "bi-check-circle-fill");
                        validator.classList.replace("text-secondary", "text-success");
                        validator.classList.replace("text-danger", "text-success");
                        errorM.classList.add("d-none");
                    }
                    else{
                        validator.classList.replace("bi-check-circle-fill", "bi-x-circle-fill");
                        validator.classList.replace("bi-question-circle-fill", "bi-x-circle-fill");
                        validator.classList.replace("text-secondary", "text-danger");
                        validator.classList.replace("text-success", "text-danger");
                        errorM.classList.add("d-none");
                    }
                }
            }
        }
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.send("username=" + input.value);
    }
    else{
        errorM.textContent = "Username cannot contain spaces!";
        errorM.classList.remove("d-none");
        window.scrollTo(0, 0);
    }
}
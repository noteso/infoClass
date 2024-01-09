passform = document.querySelector("#resetpassform");
newpass = document.querySelector("#newpass");
repass = document.querySelector("#confpass");
passsubmit = document.querySelector("#passsubmit");
showpass = document.querySelector("#showpass");
errorM = document.querySelector("#errorbox");


passform.onsubmit = (e) =>{
    e.preventDefault();
}

showpass.onclick = () => {
    if(showpass.checked == true){
        newpass.type = "text";
        repass.type = "text";
    }else{
        newpass.type = "password";
        repass.type = "password";
    }
}

passsubmit.onclick = () => {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "../../php/newpass.php", true);
    xhr.onload = () => {
        if(xhr.readyState == XMLHttpRequest.DONE){
            if(xhr.status == 200){
                let data = xhr.response;
                if(data == "success"){
                    location.href = "../../signin";
                }else{
                    errorM.textContent = data;
                    errorM.classList.remove("d-none");
                    theDiv.scrollTop = 0;
                }
            }
        }
    }
    let formData = new FormData(passform);
    xhr.send(formData); 	
}
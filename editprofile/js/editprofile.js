function xhrreq(formdata){
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "../php/editprofile.php", true);
    xhr.onload = () => {
        if(xhr.readyState == XMLHttpRequest.DONE){
            if(xhr.status == 200){
                let data = xhr.response;
                if(data == "success"){
                    location.href = "";
                }else{
                    errorM.textContent = data;
                    errorM.classList.remove("d-none");
                    theDiv.scrollTop = 0;
                }
            }
        }
    }
    let formData = new FormData(formdata);
    xhr.send(formData); 
}


const photoform = document.querySelector("#photoform");
const photolabel = document.querySelector("#photolabel");
const abortphotosubmit = document.querySelector("#abortphotosubmit");
const photosubmitbtn = document.querySelector("#photosubmitbutton");
const errorM = document.querySelector("#errorbox");

photoform.onsubmit = (e) =>{
    e.preventDefault();
}

photolabel.onclick = () =>{
    photolabel.classList.add("d-none");
    photosubmitbtn.classList.remove("d-none");
    abortphotosubmit.classList.remove("d-none");
}

abortphotosubmit.onclick = () =>{
    photolabel.classList.remove("d-none");
    photosubmitbtn.classList.add("d-none");
    abortphotosubmit.classList.add("d-none");
}

photosubmitbtn.onclick = () => {
    xhrreq(photoform);   	
}



// Change profile name code...

const nameeditbtn = document.querySelector("#editname");
const namesubmitbtn = document.querySelector("#submitname");
const nameform = document.querySelector("#nameform");
const fnameinput = document.querySelector("#fname");
const lnameinput = document.querySelector("#lname");

nameform.onsubmit = (e) =>{
    e.preventDefault();
}

nameeditbtn.onclick = () =>{
    nameeditbtn.classList.add("d-none");
    namesubmitbtn.classList.remove("d-none");
    fnameinput.removeAttribute("readonly");
    lnameinput.removeAttribute("readonly");
}

namesubmitbtn.onclick = () => {
    xhrreq(nameform);   	
}


// Change username code...

const usernameeditbtn = document.querySelector("#editusername");
const usernamesubmitbtn = document.querySelector("#submitusername");
const usernameform = document.querySelector("#usernameform");
const usernameinput = document.querySelector("#username");
const theDiv = document.querySelector('#maindiv');

usernameform.onsubmit = (e) =>{
    e.preventDefault();
}

usernameeditbtn.onclick = () =>{
    usernameeditbtn.classList.add("d-none");
    usernamesubmitbtn.classList.remove("d-none");
    usernameinput.removeAttribute("readonly");
}

usernamesubmitbtn.onclick = () => {
    xhrreq(usernameform)   	
}


//change email

const emaileditbtn = document.querySelector("#editemail");
const emailsubmitbtn = document.querySelector("#submitemail");
const emailform = document.querySelector("#emailform");
const emailinput = document.querySelector("#email");

emailform.onsubmit = (e) =>{
    e.preventDefault();
}

emaileditbtn.onclick = () =>{
    emaileditbtn.classList.add("d-none");
    emailsubmitbtn.classList.remove("d-none");
    emailinput.removeAttribute("readonly");
}

emailsubmitbtn.onclick = () => {
    xhrreq(emailform)   	
}


// email visibility code
emailtoggle = document.querySelector("#emailpriv");

emailtoggle.onclick = () =>{
    if(emailtoggle.checked == true){
        is_toggled = 1;
    }else{
        is_toggled = 0;
    }

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "../php/editprofile.php", true);
    xhr.onload = ()=>{
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                let data = xhr.response; 
            }
        }
    }
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("emailprivate="+is_toggled); 
}

//edit password

passform = document.querySelector("#passform");
oldpass = document.querySelector("#oldpass");
newpass = document.querySelector("#newpass");
repass = document.querySelector("#repass");
passsubmit = document.querySelector("#passsubmit");
showpass = document.querySelector("#showpass");


passform.onsubmit = (e) =>{
    e.preventDefault();
}

showpass.onclick = () => {
    if(showpass.checked == true){
        oldpass.type = "text";
        newpass.type = "text";
        repass.type = "text";
    }else{
        oldpass.type = "password";
        newpass.type = "password";
        repass.type = "password";
    }
}

passsubmit.onclick = () => {
    xhrreq(passform);   	
}

// bio update code

const bioeditbtn = document.querySelector("#editbio");
const biosubmitbtn = document.querySelector("#submitbio");
const bioform = document.querySelector("#bioform");
const bioinput = document.querySelector("#bio");

bioform.onsubmit = (e) =>{
    e.preventDefault();
}

bioeditbtn.onclick = () =>{
    bioeditbtn.classList.add("d-none");
    biosubmitbtn.classList.remove("d-none");
    bioinput.removeAttribute("readonly");
}

biosubmitbtn.onclick = () => {
    xhrreq(bioform)   	
}



// bio visibility code
biotoggle = document.querySelector("#biopriv");

biotoggle.onclick = () =>{
    if(biotoggle.checked == true){
        is_toggled = 1;
    }else{
        is_toggled = 0;
    }

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "../php/editprofile.php", true);
    xhr.onload = ()=>{
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                let data = xhr.response; 
            }
        }
    }
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("bioprivate="+is_toggled); 
}
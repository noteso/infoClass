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
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "../php/classsettings.php", true);
    xhr.onload = () => {
        if(xhr.readyState == XMLHttpRequest.DONE){
            if(xhr.status == 200){
                let data = xhr.response;
                if(data == "success"){
                    location.href = "";
                }else{
                    errorM.textContent = data;
                    errorM.classList.remove("d-none");
                    window.scrollTo(0, 0);
                }
            }
        }
    }
    let formData = new FormData(photoform);
    xhr.send(formData);    	
}



// Change class name code...

const nameeditbtn = document.querySelector("#editname");
const namesubmitbtn = document.querySelector("#submitname");
const nameform = document.querySelector("#nameform");
const classnameinput = document.querySelector("#classname");

nameform.onsubmit = (e) =>{
    e.preventDefault();
}

nameeditbtn.onclick = () =>{
    nameeditbtn.classList.add("d-none");
    namesubmitbtn.classList.remove("d-none");
    classnameinput.removeAttribute("readonly");
}

namesubmitbtn.onclick = () => {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "../php/classsettings.php", true);
    xhr.onload = () => {
        if(xhr.readyState == XMLHttpRequest.DONE){
            if(xhr.status == 200){
                let data = xhr.response;
                if(data == "success"){
                    location.href = "";
                }else{
                    errorM.textContent = data;
                    errorM.classList.remove("d-none");
                    window.scrollTo(0, 0);
                }
            }
        }
    }
    let formData = new FormData(nameform);
    xhr.send(formData);    	
}


const memberlistbtn = document.querySelector("#memberlistbtn");
const membersbox = document.querySelector("#membersbox");
const classroom_id = document.querySelector("#classid");

memberlistbtn.onclick = () => {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "../php/classsettings.php", true);
    xhr.onload = ()=>{
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                let data = xhr.response;
                membersbox.innerHTML = data;
            }
        }
    }
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("classroom_members="+classroom_id.value);   	
}

//serach users form

const searchusersbox = document.querySelector("#searchusersbox");
const searchusersform = document.querySelector("#searchusersform");
const searchbtn = document.querySelector("#searchbtn");

searchusersform.onsubmit = (e) =>{
    e.preventDefault();
}

searchbtn.onclick = () => {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "../php/classsettings.php", true);
    xhr.onload = () => {
        if(xhr.readyState == XMLHttpRequest.DONE){
            if(xhr.status == 200){
                let data = xhr.response;
                searchusersbox.innerHTML = data;
            }
        }
    }
    let formData = new FormData(searchusersform);
    xhr.send(formData);    	
}

//adding users to classroom

function addmember(classid, userid){
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "../php/classsettings.php", true);
    xhr.onload = ()=>{
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                let data = xhr.response;
                if(data == "success"){
                    searchbtn.click();
                    memberlistbtn.click();
                }else{
                    errorM.textContent = data;
                    errorM.classList.remove("d-none");
                    window.scrollTo(0, 0);
                } 
            }
        }
    }
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("classid="+classid +"&userid="+userid); 
}

// removemember

function removemember(classid, userid){
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "../php/classsettings.php", true);
    xhr.onload = ()=>{
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                let data = xhr.response;
                if(data == "success"){
                    memberlistbtn.click();
                }else if(data == "kickout"){
                    location.href = "";
                }else{
                    errorM.textContent = data;
                    errorM.classList.remove("d-none");
                    window.scrollTo(0, 0);
                } 
            }
        }
    }
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("removeclassid="+classid +"&removeuserid="+userid); 
}
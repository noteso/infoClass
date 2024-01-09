const messageholder = document.querySelector("#messageholder");
const classid = document.querySelector("#classroomid");

setInterval(() =>{
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "../php/getchat.php", true);
    xhr.onload = ()=>{
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                let data = xhr.response;
                if(messageholder.innerHTML !== data){
                    messageholder.innerHTML = data;
                }
            }
        }
    }
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("classroom_id="+classid.value);
}, 1000);
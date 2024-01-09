const temp = window.location.search.split("=");
const classid = temp[1];
const testholder = document.querySelector("#testholder");


setInterval(() =>{
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "../php/gettest.php", true);
    xhr.onload = ()=>{
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                let data = xhr.response;
                if(testholder.innerHTML !== data){
                    testholder.innerHTML = data;
                } 
            }
        }
    }
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("classroom_id="+classid);
}, 500);
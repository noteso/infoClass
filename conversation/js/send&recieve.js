const form = document.querySelector("#messageform");
const sendBtn = document.querySelector("#sendbtn");
const currentdate = document.querySelector("#sendtime");
const messageholder = document.querySelector("#messageholder");
const messageinput = document.querySelector("#message");
const classid = document.querySelector("#classroomid");

form.onsubmit = (e)=>{
    e.preventDefault();
}

sendBtn.onclick = ()=>{
    messageinput.focus();
    if(messageinput !== ""){
        const date = new Date();
        const d = {
            year: date.getFullYear(),
            month: date.getMonth() + 1,
            day: date.getDate(),
            hour: date.getHours(),
            min: date.getMinutes(),
            sec: date. getSeconds()
        };
        const datestring = d.year + "-" + d.month + "-" + d.day + " " + d.hour + ":" + d.min + ":" + d.sec;
        currentdate.value = datestring;
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "../php/sendmessage.php", true);
        xhr.onload = ()=>{
            if(xhr.readyState === XMLHttpRequest.DONE){
                if(xhr.status === 200){
                    messageinput.value = "";
                    window.scrollTo(0, document.body.scrollHeight);
                    
                }
            }
        }
        let formData = new FormData(form);
        xhr.send(formData);
    }
}

setInterval(() =>{
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "../php/getmessage.php", true);
    xhr.onload = ()=>{
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                let data = xhr.response;
                messageholder.innerHTML = data;
            }
        }
    }
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("classroom_id="+classid.value);
}, 500);

/*
const form = document.querySelector("#messageform");
const sendBtn = document.querySelector("#sendbtn");
const currentdate = document.querySelector("#sendtime");
const messageholder = document.querySelector("#messageholder");
const messageinput = document.querySelector("#message");
const classid = document.querySelector("#classroomid");

form.onsubmit = (e)=>{
    e.preventDefault();
}

sendBtn.onclick = ()=>{
    messageinput.focus();
    if(messageinput !== ""){
        const date = new Date();
        const d = {
            year: date.getFullYear(),
            month: date.getMonth() + 1,
            day: date.getDate(),
            hour: date.getHours(),
            min: date.getMinutes(),
            sec: date. getSeconds()
        };
        const datestring = d.year + "-" + d.month + "-" + d.day + " " + d.hour + ":" + d.min + ":" + d.sec;
        currentdate.value = datestring;
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "../php/sendmessage.php", true);
        xhr.onload = ()=>{
            if(xhr.readyState === XMLHttpRequest.DONE){
                if(xhr.status === 200){
                    messageinput.value = "";
                    window.scrollTo(0, document.body.scrollHeight);
                    
                }
            }
        }
        let formData = new FormData(form);
        xhr.send(formData);
    }
}
*/
const form = document.querySelector("#booktestform");
const submitBtn = document.querySelector("#booktestbutton");
const errorM = document.querySelector("#errorbox");

form.onsubmit = (e) => {
    e.preventDefault();
}

submitBtn.onclick = () => {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "../php/booktest.php", true);
    xhr.onload = () => {
        if(xhr.readyState == XMLHttpRequest.DONE){
            if(xhr.status == 200){
                let data = xhr.response;
                if(data == "success"){
                    location.href = "";
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

const form = document.querySelector("#createnewclassform");
const submitBtn = document.querySelector("#createnewclassbtn");
const errorM = document.querySelector("#errorbox");

form.onsubmit = (e) => {
    e.preventDefault();
}

submitBtn.onclick = () => {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "../php/createnewclass.php", true);
    xhr.onload = () => {
        if(xhr.readyState == XMLHttpRequest.DONE){
            if(xhr.status == 200){
                let data = xhr.response;
                if(data.includes("../conversation/")){
                    location.href = data;
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
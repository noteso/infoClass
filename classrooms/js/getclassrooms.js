const classholder = document.querySelector("#classholder");

window.onload = () => {
    let xhr = new XMLHttpRequest();
    xhr.open("GET", "../php/getclassrooms.php", true);
    xhr.onload = ()=>{
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                let data = xhr.response;
                classholder.innerHTML = data;
            }
        }
    }
    xhr.send();
}
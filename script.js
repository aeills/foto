const video = document.getElementById("video");
const countdown = document.getElementById("countdown");
const frameOverlay = document.getElementById("frameOverlay");
const result = document.getElementById("result");

navigator.mediaDevices.getUserMedia({ video: true })
.then(stream => {
    video.srcObject = stream;
});

function selectFrame(img){
    frameOverlay.src = img.src;
}

function takePhoto(){

    let count = 3;

    countdown.style.display = "block";
    countdown.innerText = count;

    let interval = setInterval(() => {

        count--;

        countdown.innerText = count;

        if(count === 0){

            clearInterval(interval);

            countdown.style.display = "none";

            capture();

        }

    },1000);
}

function capture(){

    const canvas = document.createElement("canvas");

    canvas.width = video.videoWidth;
    canvas.height = video.videoHeight;

    const ctx = canvas.getContext("2d");

    ctx.drawImage(video,0,0);

    if(frameOverlay.src){

        const img = new Image();

        img.src = frameOverlay.src;

        img.onload = () => {

            ctx.drawImage(img,0,0,canvas.width,canvas.height);

            savePhoto(canvas);

        };

    } else {

        savePhoto(canvas);

    }

}

function savePhoto(canvas){

    const img = canvas.toDataURL("image/png");

    localStorage.setItem("photo", img);

    result.innerHTML = `
        <img src="${img}" width="200">
    `;
}

function retake(){
    result.innerHTML = "";
}
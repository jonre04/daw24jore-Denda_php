const audio = document.getElementById("audio");
const songNameLabel = document.getElementById("songName");


const songs = [
    "mp3/Monkey.mp3",
    "mp3/Monkeys Spinning Monkeys.mp3",
    "Santa Fe Klan.mp3"
];

let index = 0;


function loadSong(autoplay = false) {
    audio.src = songs[index];
    songNameLabel.textContent = songs[index]; 
    
    if (autoplay) {
        audio.play();
    }
}

function playAudio() {
    audio.play();
}


function stopAudio() {
    audio.pause();
}


function next() {
    index++;
 
    if (index >= songs.length) {
        index = 0;
    }
    loadSong(true);
}

function prev() {
    index--;
 
    if (index < 0) {
        index = songs.length - 1; 
    }
    loadSong(true); 
}


audio.addEventListener("ended", next);


loadSong(false);
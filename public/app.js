// Path: public\app.js

const alert = document.getElementById('alert');

if (alert) {
    setTimeout(() => {
        alert.classList.add('hidden');
    }, 3000);
}


const timer = document.getElementById('timer');
const sudokuGrid = document.getElementById('sudoku-grid');
const inputTimer = document.getElementById('input-timer');
let temps;
window.onload = () => {
    setInterval(start, 1000);
}

function start() {
    let time = timer.innerHTML;
    let timeArray = time.split(':');
    let seconds = parseInt(timeArray[2]);
    let minutes = parseInt(timeArray[1]);
    let hours = parseInt(timeArray[0]);
    seconds++;
    if (seconds === 60) {
        seconds = 0;
        minutes++;
    }
    if (minutes === 60) {
        minutes = 0;
        hours++;
    }
    if (seconds < 10) {
        seconds = '0' + seconds;
    }
    if (minutes < 10) {
        minutes = '0' + minutes;
    }
    if (hours < 10) {
        hours = '0' + hours;
    }
    timer.innerHTML = hours + ':' + minutes + ':' + seconds;
    temps = hours + ':' + minutes + ':' + seconds;
    // console.log(temps)
    inputTimer.value = temps;
}



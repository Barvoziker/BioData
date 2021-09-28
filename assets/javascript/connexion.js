let connectTriangle = document.getElementById('connectTriangle');
let connectContainer = document.getElementById('connectContainer');
let logoContainer = document.getElementsByClassName('logoContainer');
let input = document.querySelectorAll('input');

//change css elements with the correct mode, DOM imports are in switchDarkMode file
function Dark() {
    connectTriangle.style.borderBottom = "20px solid rgb(35, 40, 50)";
    connectContainer.style.backgroundColor = "rgb(35, 40, 50)";

    for (let i = 0; i < logoContainer.length; i++) {
        logoContainer[i].style.boxShadow = "inset 6.3em 6em rgb(59, 63, 71)";
    }

    for (let i = 0; i < input.length; i++) {
        input[i].style.color = "whitesmoke";
        input[i].style.backgroundColor = "rgb(59, 63, 71)";
        input[i].style.border = "5px solid rgb(59, 63, 71)";
    }

}

if (localStorage.getItem("mode") === "Dark") {
    Dark();
}
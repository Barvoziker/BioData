//change css elements with the correct colors and image changes, DOM imports are in switchDarkMode file
function Dark () {

    body.style.backgroundColor = "rgb(35, 40, 50)";
    document.getElementById('logoProteus').src = '../../assets/img/proteusWhite.png';
    document.getElementById('menuButton').src = '../../assets/img/menuWhite.png';

    for (let i = 0; i < menuText.length; i++){
        menuText[i].style.color = "whitesmoke";
    }
}

function Light () {

    body.style.backgroundColor = "white";
    document.getElementById('logoProteus').src = '../../assets/img/proteusDark.png';
    document.getElementById('menuButton').src = '../../assets/img/menuDark.png';

    for (let i = 0; i < menuText.length; i++){
        menuText[i].style.color = "rgb(35, 40, 50)";
    }
}
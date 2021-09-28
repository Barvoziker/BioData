function showInput(inputID, hideButtonID, showButtonID) {
    const input = document.getElementById(inputID)
    const hideButton = document.getElementById(hideButtonID)
    const showButton = document.getElementById(showButtonID)

    input.style.visibility = 'visible'
    hideButton.style.visibility = 'visible'
    showButton.style.visibility = 'hidden'
}

function hideInput(inputID, hideButtonID, showButtonID) {
    const input = document.getElementById(inputID)
    const hideButton = document.getElementById(hideButtonID)
    const showButton = document.getElementById(showButtonID)

    input.style.visibility = 'hidden'
    input.value = ''
    hideButton.style.visibility = 'hidden'
    showButton.style.visibility = 'visible'
}
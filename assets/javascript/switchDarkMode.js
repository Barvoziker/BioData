/* DOM elements */
let body = document.getElementsByTagName('body')[0];

/* portail.php */
let menuText = document.getElementsByClassName('menuText');

/* header.php */
let checkbox = document.getElementById('checkbox');

//check if local file key is set as Dark (other than default one White), this is use for launch
if (localStorage.getItem("mode") === "Dark") {
    try {
        document.getElementById("checkbox").checked = true;
    } catch (e) {
        console.log('switch not found')
    }
    try {
        Dark();
    } catch (e) {
        console.log('darkmode pas chargé')
    }

}

//listen if checkbox is checked or not and use it as a parameter for switchMode function
try {
    checkbox.addEventListener("click", function () {
        let result = checkbox.checked;
        switchMode(result)
    })
} catch (e) {
    console.log('switch not found')
}

//with the last function check if checkbox is true or false and apply the correct key & function
function switchMode(boolean) {
    if (boolean === true) {
        localStorage.setItem("mode", "Dark");
        Dark();
    } else if (boolean === false) {
        localStorage.setItem("mode", "Light");
        Light();
    }
}

/* Dark() & Light() functions in respective php files */







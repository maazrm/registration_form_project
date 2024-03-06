// const password = document.querySelector('#password');
// const confPassword = document.querySelector('#conf-password');



// console.log(password.value)

function checkPassword() {
    const password = document.querySelector('#password');
    const confPassword = document.querySelector('#conf-password')
    const passMessage = document.querySelector('.message')

    console.log(password.value)
    console.log(confPassword.value)

    console.log(confPassword.value)
    if (password.value == confPassword.value) {
        console.log("Password matches!")
        
        confPassword.style.border = "1px solid #ccc";
        passMessage.style.display = 'none';

    } else {
        confPassword.classList.add("rig-pass")
        console.log("Passwords don't match!")

        confPassword.style.border = "1px solid red";
        passMessage.style.display = 'block';

        // newSpan.innerText = "Password don't match"
        // confPasswordDiv.appendChild(newSpan)
    }
}

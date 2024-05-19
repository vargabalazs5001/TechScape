const passwordIcons = document.querySelectorAll('#togglePassword, #toggleConfirmPassword');
passwordIcons.forEach(icon => {
    icon.addEventListener('click', function () {
        const input = this.parentNode.querySelector('input');
        const isPassword = input.getAttribute('type') === 'password';
        if (isPassword) {
            input.setAttribute('type', 'text');
            this.querySelector('i').classList.remove('bxs-lock-alt');
            this.querySelector('i').classList.add('bxs-lock-open-alt');
        } else {
            input.setAttribute('type', 'password');
            this.querySelector('i').classList.remove('bxs-lock-open-alt');
            this.querySelector('i').classList.add('bxs-lock-alt');
        }
    });
});

function moveLabel(input) {
    input.parentNode.querySelector("label").style.top = "-5px";
}

function checkEmpty(input) {
    if (input.value === "") {
        input.parentNode.querySelector("label").style.top = "";
    }
}


